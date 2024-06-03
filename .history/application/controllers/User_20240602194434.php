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

        if ($user != null) {
            $this->session->set_userdata('user', $user);
        }


       return printJson(array('success' => $user != null));
 
        
    }


    public function perfil(){
        $user = $this->loggedInUserX();

        $this->db->where('id', $user->id);
        $user = $this->db->get('pacientes')->row();
        echo $this->loadBase(
            array(
                'title' => 'Perfil',
                'content' => "frontend/user/perfil",
                'breadcumbs' => array("INÍCIO"),
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