<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if (!function_exists('write_log')) {
    /**
     * Registra uma mensagem de log no arquivo de logs.
     *
     * @param string $message A mensagem de log a ser registrada.
     * @return void
     */
    function write_log($message) {
        $CI =& get_instance();

        $log_dir = FCPATH . 'application/logs/';
        $log_file = $log_dir . date('Y-m-d') . '.log';
        $timestamp = date('Y-m-d H:i:s');
        $log_message = "[{$timestamp}] {$message}\n";

        // Verifica se o diretório de logs existe, caso contrário, cria-o
        if (!file_exists($log_dir)) {
            mkdir($log_dir, 0777, true);
        }
       

        // Adiciona a mensagem de log ao arquivo
        file_put_contents($log_file, $log_message, FILE_APPEND);
    }
}

if (!function_exists('list_logs')) {
    /**
     * Lista e exibe os arquivos de log disponíveis para um determinado dia.
     *
     * @param string $date A data no formato 'Y-m-d' dos arquivos de log a serem listados.
     * @return void
     */
    function list_logs($date) {
        $log_dir = FCPATH . 'application/logs/';
        $log_files = glob($log_dir . $date . '*.log');

        echo '<h2>Logs Disponíveis para o Dia: ' . $date . '</h2>';

        if (!empty($log_files)) {
            foreach ($log_files as $log_file) {
                $filename = basename($log_file);
                $link = site_url('logs/view/' . $filename);

                echo '<p><a href="' . $link . '">' . $filename . '</a></p>';
            }
        } else {
            echo '<p>Nenhum log disponível para esta data.</p>';
        }
    }
}


if (!function_exists('send_log')) {
    /**
     * Envia uma mensagem de log para uma API externa.
     *
     * @param string $message A mensagem de log a ser enviada.
     * @return bool Retorna true se o log foi enviado com sucesso, caso contrário, retorna false.
     */
    function send_log($message) {
        // Configuração da API de logs
        $api_url = 'https://in.logs.betterstack.com';
        $api_key = 'rzmwFuESm8Ujnti4CHJkotgp';

        // Monta os dados a serem enviados
        $log_data = array(
            'dt' => gmdate('Y-m-d H:i:s e'),
            'message' => $message
        );

        // Converte os dados em JSON
        $json_data = json_encode($log_data);

        // Configura as opções do cURL
        $curl_options = array(
            CURLOPT_URL => $api_url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'Authorization: Bearer ' . $api_key
            ),
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => $json_data,
            CURLOPT_SSL_VERIFYPEER => false // Remova esta linha se o servidor de logs tiver um certificado SSL válido
        );

        // Inicializa o cURL
        $curl = curl_init();

        // Define as opções do cURL
        curl_setopt_array($curl, $curl_options);

        // Executa a requisição cURL
        $response = curl_exec($curl);

        // Verifica se ocorreu algum erro na requisição
        if ($response === false) {
            // Ocorreu um erro na requisição
            $error_message = curl_error($curl);
            curl_close($curl);

            // Registra o erro no log de erros do CodeIgniter
            log_message('error', 'Erro na requisição cURL: ' . $error_message);

            return false;
        }

        // Verifica o código de status da resposta
        $http_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);

        // Verifica se a requisição foi bem-sucedida (código 2xx)
        if ($http_code >= 200 && $http_code < 300) {
            return true;
        } else {
            // A requisição não foi bem-sucedida
            log_message('error', 'Erro na requisição cURL: código ' . $http_code);

            return false;
        }
    }
}
