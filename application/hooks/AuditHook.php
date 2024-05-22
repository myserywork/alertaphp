<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AuditHook {
  
  protected $CI;
  
  public function __construct() {
    $this->CI =& get_instance();
    $this->CI->load->library('user_agent');
  }
  
  public function log_action() {
    // Obtém o método da requisição (POST, GET, etc.)
    $request_method = $this->CI->input->method(true);
    // Obtém o caminho da URL
    $url_path = $this->CI->uri->uri_string();
    // Obtém o IP do cliente
    $ip_address = $this->CI->input->ip_address();
    // Obtém o nome de usuário da sessão, se disponível
    $username = $this->CI->session->userdata('identity');
    // Obtém os dados da requisição
    $request_data = $this->CI->input->input_stream();
  
    // Obtém as informações do navegador
    $browser = $this->CI->agent->browser();
    $version = $this->CI->agent->version();
    $platform = $this->CI->agent->platform();
    // Prepara a mensagem de log
    $log_message = "Request Method: $request_method\nURL: $url_path\nIP Address: $ip_address\n";
    // Adiciona o nome de usuário à mensagem de log, se disponível
    if (!empty($username)) {
      $log_message .= "Username: $username\n";
    }
    // Adiciona as informações do navegador à mensagem de log
    $log_message .= "Browser: $browser\nVersion: $version\nPlatform: $platform\n";
    // Adiciona os dados da requisição à mensagem de log
    $log_message .= "Request Data: " . print_r($request_data, true) . "\n";
    // Envia a mensagem de log usando a função send_log()
    send_log($log_message);
  }
}
