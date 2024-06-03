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
       $email = $this->input->post('email');
       $password = $this->input->post('password');


        
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