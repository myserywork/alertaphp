<?php
defined('BASEPATH') or exit('No direct script access allowed');

class AutoDeploy extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->load->helper('form');
        $this->load->view('autodeploy/index_view');
    }

    public function deploy()
    {
        // Realiza o backup do banco de dados
        $this->load->helper('url');
        $this->load->library('curl');

        $backupUrl = site_url('databasebackup/do_backup');
        $this->curl->get($backupUrl);

        // Recebe a mensagem do formulário
        $message = $this->input->post('message');

        // Executa os comandos do Git
        $output = shell_exec('git add .');
        $output .= shell_exec('git commit -m "' . $message . '"');
        $output .= shell_exec('git push origin main');

        // Exibe o resultado
        echo '<pre>' . $output . '</pre>';
    }
}