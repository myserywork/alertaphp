<?php

defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Prontuario_model');
        $this->load->model('Medicacao_model');
        $this->load->model('Cadastro_model');
    }


    public function index() {
        $this->login();
    }
    public function login() {
        echo $this->loadBase(
            array(
                'title' => 'Login',
                'content' => "frontend/user/login",
                'breadcumbs' => array("INÍCIO"),
                'noBody' => true,
            )
        );
    }

    public function verifyLogin() {
        $cpf = $this->input->post('cpf');
        $pin = $this->input->post('pin');

        $this->db->where('cpf', $cpf);
        $this->db->where('pin', $pin);
        $user = $this->db->get('pacientes')->row();

        if ($user != null) {
            $this->session->set_userdata('user', $user);
        }

        return printJson(array('success' => $user != null));
    }

    public function perfil(){
        $user = $this->loggedInUserX();
        $this->load->model('Alertas_model');

        $this->db->where('id', $user->id);
        $user = $this->db->get('pacientes')->row();

         $user = $this->Cadastro_model->get_paciente($user->id);

         if($user == null) {
            redirect('user/login');
        }

      

        // Get prontuarios and medicacoes
        $prontuarios = $this->Prontuario_model->get_by_paciente($user->id);
        $medicacoes = $this->Medicacao_model->get_by_paciente($user->id);

        echo $this->loadBase(
            array(
                'title' => 'Perfil',
                'content' => "frontend/user/perfil",
                'breadcumbs' => array("INÍCIO"),
                'paciente' => $user,
                'prontuarios' => $prontuarios,
                'medicacoes' => $medicacoes,
                'alertasCount' => $this->Alertas_model->get_alertas_count_by_risk($user->id),
                'noBody' => true,
                'user' => $user
            )
        );
    }

    public function loggedInUserX(){
        return $this->session->userdata('user');
    }

    public function setLoggedInUser(){
        $this->session->set_userdata('user', $user);
        return printJson(array('success' => true));
    }

    public function logout() {
        $this->session->unset_userdata('user');
        redirect(base_url('user/login'));
    }

    public function isUserLoggedIN(){
        return printJson(array('success' => loggedInUser() != null));
    }

    public function add_prontuario() {
        $data = array(
            'paciente_id' => $this->input->post('paciente_id'),
            'descricao' => $this->input->post('descricao'),
        );
        $this->Prontuario_model->insert($data);
        redirect('user/perfil');
    }

    public function delete_prontuario($id) {
        $this->Prontuario_model->delete($id);
        redirect('user/perfil');
    }

    public function add_medicacao() {
        $data = array(
            'paciente_id' => $this->input->post('paciente_id'),
            'nome' => $this->input->post('nome'),
            'quantidade' => $this->input->post('quantidade'),
            'horario' => $this->input->post('horario'),
            'tipo' => $this->input->post('tipo'),
            'dias_semana' => implode(', ', $this->input->post('dias_semana')),
            'duracao' => $this->input->post('duracao'),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        );
    
        $this->db->insert('medicacoes', $data);
        redirect('user/perfil/' . $data['paciente_id']);
    }
    

    public function delete_medicacao($id) {
        $this->Medicacao_model->delete($id);
        redirect('user/perfil');
    }

     public function save_mood() {
        $data = json_decode(file_get_contents('php://input'), true);

        // Verificar se o humor já foi registrado hoje
        $this->db->where('paciente_id', $data['paciente_id']);
        $this->db->where('data', $data['data']);
        $query = $this->db->get('moods');

        if ($query->num_rows() > 0) {
            return $this->output
                        ->set_content_type('application/json')
                        ->set_output(json_encode(['success' => false, 'message' => 'Você já registrou seu humor hoje.']));
        }

        // Inserir novo registro de humor
        if (isset($data['paciente_id']) && isset($data['humor']) && isset($data['valor_humor']) && isset($data['data'])) {
            $this->db->insert('moods', $data);
            return $this->output
                        ->set_content_type('application/json')
                        ->set_output(json_encode(['success' => true]));
        } else {
            return $this->output
                        ->set_content_type('application/json')
                        ->set_output(json_encode(['success' => false, 'message' => 'Dados inválidos']));
        }
    }

    public function get_moods() {
        $paciente_id = $this->input->get('paciente_id');
        $this->db->where('paciente_id', $paciente_id);
        $this->db->order_by('data', 'ASC');
        $moods = $this->db->get('moods')->result();
        return $this->output
                    ->set_content_type('application/json')
                    ->set_output(json_encode($moods));
    }

    private function loadBase($context) {
        if (isset($context['breadcumbs'])) {
            $context['breadcumbs'] = generatePageBreadcrumb($context['title'], $context['breadcumbs']);
        }

        $context['notifications'] = $this->notifications_model->get(1, 5);
        $context['content'] = $this->load->view($context['content'], $context, true);
        return $this->load->view('dashboard/template/base_template_view', $context, TRUE);
    }
}
?>
