<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class IPVerificationHook {

    protected $CI;

    public function __construct() {
        $this->CI =& get_instance();
    }

    public function check_ip() {
        // Obtém o IP do cliente
        $ip = $this->CI->input->ip_address();
        // Envia o IP para a função send_log()
        // send_log('IP do cliente: ' . $ip);
    }
}

