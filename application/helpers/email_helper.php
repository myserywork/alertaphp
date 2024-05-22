<?php
defined('BASEPATH') or exit('No direct script access allowed');

function send_email($to, $subject, $message, $cc)
{
    $CI =& get_instance();
    $CI->load->helper('url');
    $CI->load->config('sendgrid');

    // Obter as configurações do SendGrid do arquivo de configuração
    $api_key = $CI->config->item('sendgrid_api_key');
    $from_email = $CI->config->item('sendgrid_from_email');
    $from_name = $CI->config->item('sendgrid_from_name');

    // Montar o payload para a API SendGrid
    $payload = array(
        'personalizations' => array(
            array(
                'to' => array(
                    array('email' => $to)
                ),
                'cc' => array_map(function ($email) {
                    return array('email' => $email);
                }, $cc)
            )
        ),
        'from' => array(
            'email' => $from_email,
            'name' => $from_name
        ),
        'subject' => $subject,
        'content' => array(
            array(
                'type' => 'text/plain',
                'value' => $message
            )
        )
    );

    // Converter o payload para JSON
    $payload_json = json_encode($payload);

    // Configurar as opções da requisição cURL
    $curl_options = array(
        CURLOPT_URL => 'https://api.sendgrid.com/v3/mail/send',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_HTTPHEADER => array(
            'Authorization: Bearer ' . $api_key,
            'Content-Type: application/json'
        ),
        CURLOPT_POST => true,
        CURLOPT_POSTFIELDS => $payload_json
    );

    // Inicializar a requisição cURL
    $curl = curl_init();

    // Definir as opções da requisição cURL
    curl_setopt_array($curl, $curl_options);

    // Executar a requisição cURL e obter a resposta
    $response = curl_exec($curl);

    // Verificar se a requisição foi bem-sucedida
    $http_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);

    // Fechar a requisição cURL
    curl_close($curl);

    // Retornar true se o e-mail for enviado com sucesso, false caso contrário
    return ($http_code == 202);
}