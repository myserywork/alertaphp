<?php


defined('BASEPATH') or exit('No direct script access allowed');

class Contato extends CI_Controller {

    public function __construct() {
        parent::__construct();
      
        $this->load->helper('url');
    }

    public function index() {
        echo $this->loadBase(
            array(
                'title' => 'Contato',
                'content' => "frontend/contato/index",
                'breadcumbs' => array("INÍCIO"),
                'noBody' => true,
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
