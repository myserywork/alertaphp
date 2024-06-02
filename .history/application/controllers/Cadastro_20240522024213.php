<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Cadastro extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('pacientes_model');
        $this->load->model('cadastro_model');
        $this->load->library('grocery_CRUD');
        $this->load->library('form_validation');
        $this->form_validation->set_message('required', 'O campo {field} é obrigatório.');
        $this->form_validation->set_message('valid_email', 'O campo {field} deve conter um endereço de e-mail válido.');
        $this->form_validation->set_message('min_length', 'O campo {field} deve ter pelo menos {param} caracteres.');
        $this->form_validation->set_message('matches', 'O campo {field} deve corresponder ao campo {param}.');
        $this->form_validation->set_message('exact_length', 'O campo {field} deve ter exatamente {param} caracteres.');
   
        // validateRoutes('index', 'dashboard');
    }

    public function index() {
        $pacientes = $this->pacientes_model->get()->result();

        echo $this->loadBase(
            array(
                'title' => 'Paciente',
                'content' => "frontend/cadastro/index",
                'breadcumbs' => array("INÍCIO"),
                'doencas' => $this->db->get('doencascronicas')->result(),
                'pacientes' => $pacientes,
                'noBody' => true,
            )
        );
    }
      public function create() {
        // Definir regras de validação
        $this->form_validation->set_rules('nome', 'Nome', 'required');
        $this->form_validation->set_rules('doencas_cronicas[]', 'Doenças Crônicas', 'required');
        $this->form_validation->set_rules('mobilidade', 'Mobilidade', 'required');
        $this->form_validation->set_rules('data_nascimento', 'Data de Nascimento', 'required');
        $this->form_validation->set_rules('cpf', 'CPF', 'required|callback_valid_cpf');
        $this->form_validation->set_rules('email', 'E-mail', 'required|valid_email');
        $this->form_validation->set_rules('telefone', 'Celular com DDD', 'required');
        $this->form_validation->set_rules('cep', 'CEP', 'required');
        $this->form_validation->set_rules('endereco', 'Endereço', 'required');
        $this->form_validation->set_rules('numero', 'Número', 'required');
        $this->form_validation->set_rules('cidade', 'Cidade', 'required');
        $this->form_validation->set_rules('estado', 'Estado', 'required');
        $this->form_validation->set_rules('pin', 'PIN', 'required|exact_length[4]');
        $this->form_validation->set_rules('passwordConfirm', 'Confirmação do PIN', 'required|matches[pin]');
        $this->form_validation->set_rules('altura', 'Altura', 'required');
        $this->form_validation->set_rules('peso', 'Peso', 'required');
        $this->form_validation->set_rules('days[]', 'Dias da Semana', 'required');

        if ($this->form_validation->run() == FALSE) {
            $errors = validation_errors();
            
            // remover tags dos erros de validação
            $errors = strip_tags($errors);
            
            echo json_encode(['success' => false, 'message' => $errors]);
        } else {
            $dados = $this->input->post();
            $result = $this->cadastro_model->insert($dados);

            if ($result) {
                echo json_encode(['success' => true, 'pacient' => $result]);
            } else {
                echo json_encode(['success' => false, 'message' => 'Erro ao inserir dados.']);
            }
        }
    }


        public function valid_cpf($cpf) {
            $cpf = preg_replace('/[^0-9]/', '', $cpf);
            if (strlen($cpf) != 11 || preg_match('/(\d)\1{10}/', $cpf)) {
                $this->form_validation->set_message('valid_cpf', 'O CPF não é válido.');
                return false;
            }
            for ($t = 9; $t < 11; $t++) {
                for ($d = 0, $c = 0; $c < $t; $c++) {
                    $d += $cpf[$c] * (($t + 1) - $c);
                }
                $d = ((10 * $d) % 11) % 10;
                if ($cpf[$c] != $d) {
                    $this->form_validation->set_message('valid_cpf', 'O CPF não é válido.');
                    return false;
                }
            }
            return true;
        }

        public function loadBase($context) {
        $user = loggedInUser();

        if (isset($context['breadcumbs'])) {
            $context['breadcumbs'] = generatePageBreadcrumb($context['title'], $context['breadcumbs']);
        }

        $context['user'] = $user;
        $context['notifications'] = $this->notifications_model->get(1, 5);
        $context['content'] = $this->load->view($context['content'], $context, true);
        return $this->load->view('dashboard/template/base_template_view', $context, TRUE);
    }


 }