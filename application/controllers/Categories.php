<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Categories extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('category_model');
        $this->load->helper(array('url', 'form'));
    }

    public function index() {
        $categories = $this->category_model->get_all_categories();
        echo $this->loadBase(
            array(
                'title' => 'Categorias',
                'content' => "categories/index",
                'breadcumbs' => array("INÍCIO"),
                'categories' => $categories
            )
        );
    }

    public function create() {
        echo $this->loadBase(
            array(
                'title' => 'Criar Categoria',
                'content' => "categories/create",
                'breadcumbs' => array("INÍCIO", "Criar Categoria")
            )
        );
    }

    public function save() {
        $data = [
            'title' => $this->input->post('title'),
            'description' => $this->input->post('description')
        ];
        $this->category_model->save_category($data);
        redirect('categories');
    }

    public function edit($id) {
        $category = $this->category_model->get_category($id);

        echo $this->loadBase(
            array(
                'title' => 'Editar Categoria',
                'content' => "categories/edit",
                'breadcumbs' => array("INÍCIO", "Editar Categoria"),
                'category' => $category
            )
        );
    }

    public function update($id) {
        $data = [
            'title' => $this->input->post('title'),
            'description' => $this->input->post('description')
        ];
        $this->category_model->update_category($id, $data);
        redirect('categories');
    }

    public function delete($id) {
        $this->category_model->delete_category($id);
        redirect('categories');
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
