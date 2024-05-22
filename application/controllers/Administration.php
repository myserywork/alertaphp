<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Administration extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        //validateRoutes(array('index', 'dashboard'));
    }


    public function index()
    {
        limitPermission('admin');
        echo $this->loadBase(
            array(
                'title' => 'Dashboard',
                'content' => "dashboard/administration/index_view",
                'breadcumbs' => array("ADMINISTRAÇÂO"),
            )
        );
    }

    public function cadastrar_pacientes()
    {
        limitPermission('admin');
        echo $this->loadBase(
            array(
                'title' => 'Dashboard',
                'content' => "dashboard/administration/index_view",
                'breadcumbs' => array("ADMINISTRAÇÂO"),
            )
        );
    }


    public function beforeFilter() {
       show_error('You are not allowed to access this page.', 403);
    }


    public function users()
    {
        limitPermission('admin');
        echo $this->loadBase(
            array(
                'title' => 'Usuários',
                'content' => "dashboard/administration/users_view",
                'breadcumbs' => array("ADMINISTRAÇÂO", "USUÁRIOS"),
                'users' => $this->users_model->get()
            )
        );
    }


    public function loadBase($context)
    {
        $user = loggedInUser();
        if (isset($context['breadcumbs'])) {
            $context['breadcumbs'] = generatePageBreadcrumb($context['title'], $context['breadcumbs']);
        }
        $context['user'] = $user;
        $context['notifications'] = $this->notifications_model->get(5);
        $context['content'] = $this->load->view($context['content'], $context, true);

        return $this->load->view('dashboard/template/base_template_view', $context, TRUE);
    }

}
?>