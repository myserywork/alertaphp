<?php

class Modal extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        validateRoutes(array('index', 'dashboard'));
    }

    public function getModalContent() {
        $viewPath = $this->input->get('viewPath');
        $modalContent = $this->load->view($viewPath, '', true);
        echo json_encode(array('content' => $modalContent));
      }

}