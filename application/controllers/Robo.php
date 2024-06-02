<?php

defined('BASEPATH') or exit('No direct script access allowed');

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
header("Access-Control-Allow-Headers: X-Requested-With");

class Robo extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

public function index($pacienteId = null) {
    
         $data['pin'] = '';
        $data['cpf'] = '';
    // Verifica se o ID do paciente foi fornecido
    if ($pacienteId === null) {
                return $this->load->view('robo/index', $data);
    }
    
  

    // Seleciona as colunas 'pin' e 'cpf' da tabela 'pacientes'
    $this->db->select('pin, cpf');
    $this->db->from('pacientes');
    $this->db->where('id', $pacienteId);
    $query = $this->db->get();

    // Verifica se um resultado foi encontrado
    if ($query->num_rows() === 1) {
        $data['pin'] = $query->row()->pin;
        $data['cpf'] = $query->row()->cpf;
    } else {
        return $this->load->view('robo/index', $data);
    }

    // Carrega a view 'robo/index' e passa os dados 'pin' e 'cpf' para a view
    return $this->load->view('robo/index', $data);
}


    function fetchOpenAIResponse($content) {
        $url = 'https://api.openai.com/v1/chat/completions';
        $data = [
            "model" => "gpt-4o",
            "messages" => [
                [
                    "role" => "system",
                    "content" => "Você é um assistente Analisa que pegará um BI e gerará um relatorio SUPER MEGA DETALHADO sobre o que te mandar,  sua função é analisar as perguntas e respostas e fornecer informações precisas e úteis. formatadas em HTML, dê relatorios de risco e respostas para os pacientes e tambem recomendações."
                ],
                [
                    "role" => "user",
                    "content" => $content
                ]
            ]
        ];

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
            'Authorization: ' . 'Bearer sk-proj-c1EMLEZ1pGVV6R2i0cxCT3BlbkFJeKbUpn6rHstH1MLacOvD' // Use environment variable for the API key
        ]);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

        $response = curl_exec($ch);
        curl_close($ch);

        $message = json_decode($response, true);
        return $message['choices'][0]['message']['content'];
    }

    public function relatorio() {
        $data = json_decode(file_get_contents('php://input'), true);
        $patient = $data['patient'];
        $responses = $data['responses'];
        $analysis = "Relatório de Análise de Saúde para " . $patient['nome'] . "\n\n";
        $highestRisk = 'baixo';

        foreach ($responses as $response) {
            $symptom = $response['symptom'];
            $userResponse = $response['userResponse'];
            $analysis .= "Sintoma: " . $symptom . "\nResposta: " . $userResponse . "\n\n";

            foreach ($patient['doencasCronicas'] as $disease) {
                foreach ($disease['sintomas'] as $sintoma) {
                    if ($sintoma['pergunta'] === $symptom && $userResponse === 'sim') {
                        if ($this->compareRiskLevels($sintoma['risco'], $highestRisk)) {
                            $highestRisk = $sintoma['risco'];
                        }
                    }
                }
            }
        }

        $analysisBlob = base64_encode($analysis);

        $openAIResponse = $this->fetchOpenAIResponse($analysis);

        $this->db->insert('alertas', [
            'paciente_id' => $patient['id'],
            'risco' => $highestRisk,
            'analise' => $analysisBlob,
            'analiseIA' => $openAIResponse,
        ]);

      

        $response = [
            'status' => 'success',
            'report' => [
                'paciente_id' => $patient['id'],
                'risco' => $highestRisk,
                'analise' => $analysis,
            ],
            'openAIResponse' => $openAIResponse
        ];

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($response));
    }

    private function compareRiskLevels($currentRisk, $highestRisk) {
        $riskLevels = ['baixo' => 1, 'medio' => 2, 'alto' => 3, 'urgente' => 4];

        return $riskLevels[$currentRisk] > $riskLevels[$highestRisk];
    }

    public function dashboard() {
        $this->db->select('a.id, a.paciente_id, a.risco, a.analise, a.analiseIA , p.nome as paciente_nome, p.foto as foto');
        $this->db->from('alertas a');
        $this->db->join('pacientes p', 'a.paciente_id = p.id');
        $this->db->order_by('a.id', 'DESC');
        $query = $this->db->get();
        $data['reports'] = $query->result();

        echo $this->loadBase(
            array(
                'title' => 'Relatorios',
                'content' => "robo/dashboard",
                'breadcumbs' => array("INÍCIO"),
                'reports' => $data['reports']
            )
        );
    }


    public function loadBase($context) {
        $user = loggedInUser();

        if (isset($context['breadcumbs'])) {
            $context['breadcumbs'] = generatePageBreadcrumb($context['title'], $context['breadcumbs']);
        }

        $context['user'] = $user;
        $context['notifications'] = $this->notifications_model->get($user->id, 5);
        $context['content'] = $this->load->view($context['content'], $context, true);
        return $this->load->view('dashboard/template/base_template_view', $context, TRUE);
    }
}
