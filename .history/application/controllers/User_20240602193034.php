<?php


defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('pacientes_model');
         $this->load->model('cadastro_model');
        $this->load->library('grocery_CRUD');
        // validateRoutes('index', 'dashboard');

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
        $this->load->model('user_model');
        $email = $this->input->post('email');
        $password = $this->input->post('password');

        $user = $this->user_model->getByEmail($email);

        if ($user && password_verify($password, $user->password)) {
            $this->session->set_userdata('user', $user);
            redirect('dashboard');
        } else {
            $this->session->set_flashdata('error', 'Usuário ou senha inválidos');
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