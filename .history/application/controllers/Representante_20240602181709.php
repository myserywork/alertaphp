<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Representante extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Representante_model');
        $this->load->helper('url');
        $this->load->library('form_validation');
    }

    public function create() {
        $this->form_validation->set_rules('nome', 'Nome', 'required');
        $this->form_validation->set_rules('cpf', 'CPF', 'required');
        $this->form_validation->set_rules('profissao', 'Profissão', 'required');
        $this->form_validation->set_rules('sexo', 'Sexo', 'required');
        $this->form_validation->set_rules('data_nascimento', 'Data de Nascimento', 'required');
        $this->form_validation->set_rules('estado', 'Estado', 'required');
        $this->form_validation->set_rules('cidade', 'Cidade', 'required');
        $this->form_validation->set_rules('telefone', 'Telefone', 'required');
        $this->form_validation->set_rules('whatsapp', 'WhatsApp', 'required');
        $this->form_validation->set_rules('cep', 'CEP', 'required');

        if ($this->form_validation->run() == FALSE) {
            $response = array(
                'success' => false,
                'message' => validation_errors()
            );
        } else {
            $data = array(
                'nome' => $this->input->post('nome'),
                'cpf' => $this->input->post('cpf'),
                'profissao' => $this->input->post('profissao'),
                'sexo' => $this->input->post('sexo'),
                'data_nascimento' => date('Y-m-d', strtotime(str_replace('/', '-', $this->input->post('data_nascimento')))),
                'estado' => $this->input->post('estado'),
                'cidade' => $this->input->post('cidade'),
                'telefone' => $this->input->post('telefone'),
                'whatsapp' => $this->input->post('whatsapp'),
                'cep' => $this->input->post('cep')
            );

            $insert_id = $this->Representante_model->insert($data);

            if ($insert_id) {
                $response = array(
                    'success' => true,
                    'representante' => $insert_id
                );
            } else {
                $response = array(
                    'success' => false,
                    'message' => 'Erro ao realizar o cadastro'
                );
            }
        }

        echo json_encode($response);
    }
}
