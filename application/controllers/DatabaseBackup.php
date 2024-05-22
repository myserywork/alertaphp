<?php
defined('BASEPATH') or exit('No direct script access allowed');

class DatabaseBackup extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->dbutil();
        $this->load->dbforge();
    }

    public function do_backup()
    {
        // Configurações do backup
        $backupConfig = array(
            'tables' => array(),
            // Tabelas para backup, deixe vazio para backup de todas as tabelas
            'ignore' => array(),
            // Tabelas para ignorar no backup
            'filename' => 'backup.sql',
            // Nome do arquivo de backup
            'format' => 'txt',
            // Formato do backup (txt, zip, gzip)
            'add_drop' => TRUE,
            // Incluir comandos DROP TABLE no backup
            'add_insert' => TRUE,
            // Incluir comandos INSERT no backup
            'newline' => "\n" // Caractere de nova linha
        );

        // Realiza o backup
        $backup = $this->dbutil->backup($backupConfig);

        // Caminho completo para o arquivo de backup
        $backupPath = FCPATH . 'backup/' . md5($backupConfig['filename']) . '_' . date('Ymd_His') . '.' . $backupConfig['format'];

        // Salva o backup no arquivo
        $this->load->helper('file');
        write_file($backupPath, $backup);
        echo 'Backup do banco de dados realizado com sucesso!';
    }

    public function index()
    {
        $this->load->helper('file');
        $this->load->helper('directory');
        $this->load->helper('url');

        $path = FCPATH . 'backup/';
        $files = directory_map($path);

        // Organiza os backups por data de criação (últimos primeiro)
        $backupFiles = array();
        foreach ($files as $file) {
            $backupPath = $path . $file;
            if (is_file($backupPath)) {
                $backupFiles[filectime($backupPath)] = $file;
            }
        }
        krsort($backupFiles);

        // Define o fuso horário como "America/Sao_Paulo"
        date_default_timezone_set('America/Sao_Paulo');

        $data['files'] = array();
        foreach ($backupFiles as $timestamp => $file) {
            $data['files'][] = array(
                'file' => $file,
                'date' => strftime('%d/%m/%Y %H:%M:%S', $timestamp)
            );
        }
        $data['path'] = $path;

        $this->load->view('database/index_view', $data);
    }

    public function import_backup($backupFileName = null)
    {
        if (!$backupFileName) {
            // Importar backup enviado por formulário
            $config['upload_path'] = './backup/';
            $config['allowed_types'] = 'sql';
            $config['encrypt_name'] = true;

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('backupFile')) {
                $error = $this->upload->display_errors();
                echo $error;
                return;
            }

            $backupFileName = $this->upload->data('file_name');
        }

        // Backup atual da base de dados
        $backupPath = FCPATH . 'backup/' . $backupFileName;
        $backupContent = file_get_contents($backupPath);

        // Faz backup da base de dados atual antes de importar
        $currentBackupPath = FCPATH . 'backup/current_backup.sql';
        $this->do_backup();

        // Remove todas as tabelas da base de dados atual
        $tables = $this->db->list_tables();
        foreach ($tables as $table) {
            $this->dbforge->drop_table($table);
        }

        // Importa o backup para a base de dados
        $result = $this->db->query($backupContent);

        if ($result) {
            echo 'Backup importado com sucesso!';
        } else {
            echo 'Erro ao importar o backup.';
        }
    }

    public function drop_all_tables()
    {
        // Disable foreign key checks temporarily
        $this->db->query('SET FOREIGN_KEY_CHECKS = 0');

        // Get all table names
        $tables = $this->db->list_tables();

        // Drop each table
        foreach ($tables as $table) {
            $this->dbforge->drop_table($table);
        }

        // Enable foreign key checks again
        $this->db->query('SET FOREIGN_KEY_CHECKS = 1');

        echo 'All tables dropped successfully!';
    }
}