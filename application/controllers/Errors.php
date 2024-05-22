<?php
defined('BASEPATH') or exit('No direct script access allowed');

class HTTPErrors extends CI_Controller
{
    function page_missing()
    {
        $this->load->view('errors/html/error_404');
    }
}

?>