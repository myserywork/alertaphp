<?php


defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller {

    public function __construct() {
        parent::__construct();

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

         if ($user) {
              $this->session->set_userdata('user', $user);
              redirect('dashboard');
         } else {
              $this->session->set_flashdata('error', 'CPF ou PIN inválidos');
              redirect('login');
         }
         
         


        
    }

    




    private function loadBase($context) {
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

?>