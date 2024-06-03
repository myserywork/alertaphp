<?php


defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
       

        echo $this->loadBase(
            array(
                'title' => 'Login',
                'content' => "frontend/user/index",
                'breadcumbs' => array("INÍCIO"),
 
                'noBody' => true,
            )
        );
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