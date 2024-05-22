<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Forms extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('formbuilder');
        $this->load->model('form_model');
        $this->load->helper(array('url', 'form', 'file'));
    }

    public function index() {
        $forms = $this->form_model->get_all_forms();
        echo $this->loadBase(
            array(
                'title' => 'Formulários',
                'content' => "forms/index",
                'breadcumbs' => array("INÍCIO"),
                'forms' => $forms,
                'noBody' => false,
            )
        );
    }

    public function create() {
        $categories = $this->form_model->get_categories();
        echo $this->loadBase(
            array(
                'title' => 'Criar Formulário',
                'content' => "forms/create",
                'breadcumbs' => array("INÍCIO", "Criar Formulário"),
                'categories' => $categories,
                'noBody' => false,
            )
        );
    }

    public function save() {
        $data = [
            'name' => $this->input->post('name'),
            'description' => $this->input->post('description'),
            'category_id' => $this->input->post('category_id') // Certifique-se de que o category_id é passado corretamente
        ];
        $form_id = $this->form_model->save_form($data);
        redirect('forms/edit/'.$form_id);
    }

    public function edit($form_id) {
        $form = $this->form_model->get_form($form_id);
        $fields = $this->form_model->get_form_fields($form_id);

        echo $this->loadBase(
            array(
                'title' => 'Editar Formulário',
                'content' => "forms/edit",
                'breadcumbs' => array("INÍCIO", "Editar Formulário"),
                'form' => $form,
                'fields' => $fields,
                'noBody' => false,
            )
        );
    }

    public function add_field($form_id) {
        echo $this->loadBase(
            array(
                'title' => 'Adicionar Campo',
                'content' => "forms/add_field",
                'breadcumbs' => array("INÍCIO", "Adicionar Campo"),
                'form_id' => $form_id,
                'noBody' => false,
            )
        );
    }

    public function save_field() {
        $data = [
            'form_id' => $this->input->post('form_id'),
            'name' => $this->input->post('name'),
            'display' => $this->input->post('display'),
            'type' => $this->input->post('type'),
            'options' => $this->input->post('options'),
            'required' => $this->input->post('required') ? 1 : 0,
            'validations' => implode('|', $this->input->post('validations'))
        ];
        $this->form_model->save_field($data);
        redirect('forms/edit/'.$data['form_id']);
    }

    public function load_form_by_category($category_id, $user_id = null) {
        $form = $this->form_model->get_form_by_category($category_id);
        if ($form) {
            $form_html = $this->formbuilder->generateForm($form->id, $user_id);

            echo $this->loadBase(
                array(
                    'title' => 'Preencher Formulário',
                    'content' => "forms/fill",
                    'breadcumbs' => array("INÍCIO", "Preencher Formulário"),
                    'form_html' => $form_html,
                    'form' => $form,
                    'noBody' => false,
                )
            );
        } else {
            show_404();
        }
    }

    public function save_response() {
        $form_id = $this->input->post('form_id');
        $user_id = $this->input->post('user_id'); // Certifique-se de que o usuário está logado
        $formData = $this->input->post();

        $this->formbuilder->saveFormResponse($form_id, $user_id, $formData);
        redirect('forms');
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
