<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CustomFields extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('custom_fields_model');
        $this->load->helper('custom_form');
    }

    public function index() {
        $categories = $this->custom_fields_model->get_categories();

        echo $this->loadBase(
            array(
                'title' => 'Categorias de Campos Personalizados',
                'content' => "custom_fields/index",
                'breadcumbs' => array("INÍCIO"),
                'categories' => $categories,
                'noBody' => false,
            )
        );
    }

    public function create_category() {
        echo $this->loadBase(
            array(
                'title' => 'Criar Categoria',
                'content' => "custom_fields/create_category",
                'breadcumbs' => array("INÍCIO", "Criar Categoria"),
                'noBody' => false,
            )
        );
    }

    public function save_category() {
        $data = [
            'name' => $this->input->post('name')
        ];
        $this->custom_fields_model->save_category($data);
        redirect('customfields');
    }

    public function create_field($category_id) {
        echo $this->loadBase(
            array(
                'title' => 'Criar Campo',
                'content' => "custom_fields/create_field",
                'breadcumbs' => array("INÍCIO", "Criar Campo"),
                'category_id' => $category_id,
                'noBody' => false,
            )
        );
    }

    public function save_field() {
        $data = [
            'name' => $this->input->post('name'),
            'display' => $this->input->post('display'),
            'type' => $this->input->post('type'),
            'options' => $this->input->post('options'),
            'required' => $this->input->post('required') ? 1 : 0,
            'validations' => $this->input->post('validations'),
            'category_id' => $this->input->post('category_id')
        ];
        $this->custom_fields_model->save_field($data);
        redirect('customfields');
    }

    public function create($category_id) {
        $fields = $this->custom_fields_model->get_fields_by_category($category_id);
        $form = generateForm('Formulário Dinâmico', [], $fields, $category_id, uniqid());

        echo $this->loadBase(
            array(
                'title' => 'Criar Formulário',
                'content' => "custom_fields/form",
                'breadcumbs' => array("INÍCIO", "Criar Formulário"),
                'form' => $form,
                'noBody' => false,
            )
        );
    }
    
      public function loadBase($context) {
        $user = loggedInUser();

        if (isset($context['breadcumbs'])) {
            $context['breadcumbs'] = generatePageBreadcrumb($context['title'], $context['breadcumbs']);
        }

        $context['user'] = $user;
        $context['notifications'] = $this->notifications_model->get(1, 5);
        $context['content'] = $this->load->view($context['content'], $context, true);
        return $this->load->view('dashboard/template/base_template_view', $context, TRUE);
    }


    public function save() {
        $reference = $this->input->post('reference');
        $category_id = $this->input->post('category_id');
        $fields = $this->custom_fields_model->get_fields_by_category($category_id);

        foreach ($fields as $field) {
            $value = $this->input->post($field->name . '#' . $field->id);
            if ($field->type == 'file') {
                $upload_data = uploadFile($field->name . '#' . $field->id);
                $value = $upload_data['upload_data']['file_name'];
            }
            $data = [
                'reference' => $reference,
                'category_id' => $category_id,
                'custom_field_id' => $field->id,
                'value' => $value,
            ];
            $this->custom_fields_model->save_field_value($data);
        }

        $this->session->set_flashdata('success', 'Formulário salvo com sucesso!');
        redirect('customfields');
    }

    public function view($reference, $category_id) {
        $fields = $this->custom_fields_model->get_field_values($reference, $category_id);

        echo $this->loadBase(
            array(
                'title' => 'Visualizar Campos Personalizados',
                'content' => "custom_fields/view",
                'breadcumbs' => array("INÍCIO", "Visualizar Campos Personalizados"),
                'fields' => $fields,
                'reference' => $reference,
                'category_id' => $category_id,
                'noBody' => false,
            )
        );
    }


}
?>
