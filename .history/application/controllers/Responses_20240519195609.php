<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Responses extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('response_model');
        $this->load->helper('url');
    }

    public function index() {
        $responses = $this->response_model->get_all_responses();
        echo $this->loadBase(
            array(
                'title' => 'Respostas',
                'content' => "responses/index",
                'breadcumbs' => array("INÍCIO"),
                'responses' => $responses,
             
            )
        );
    }

    public function list_by_category($category_id) {
        $responses = $this->response_model->get_responses_by_category($category_id);
        echo $this->loadBase(
            array(
                'title' => 'Respostas da Categoria',
                'content' => "responses/list_by_category",
                'breadcumbs' => array("INÍCIO", "Respostas da Categoria"),
                'responses' => $responses,
             
            )
        );
    }

    public function view($response_id) {
        $response = $this->response_model->get_response($response_id);
        echo $this->loadBase(
            array(
                'title' => 'Visualizar Resposta',
                'content' => "responses/view",
                'breadcumbs' => array("INÍCIO", "Visualizar Resposta"),
                'response' => $response,
             
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
