<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CachePageHook {

    protected $CI;

    public function __construct() {
        $this->CI =& get_instance();
    }

    public function cache_page() {
        // Verifica se o cache está habilitado
        if ($this->CI->config->item('cache_enabled')) {
            $cache_key = $this->CI->uri->uri_string();

            // Tenta obter a página em cache
            if ($output = $this->CI->cache->get($cache_key)) {
                // Exibe o conteúdo em cache
                echo $output;
                exit;
            }
        }
    }

    public function save_page_cache() {
        // Verifica se o cache está habilitado
        if ($this->CI->config->item('cache_enabled')) {
            $cache_key = $this->CI->uri->uri_string();

            // Armazena a página em cache por um determinado tempo
            $this->CI->cache->save($cache_key, $this->CI->output->get_output(), $this->CI->config->item('cache_duration'));
        }
    }
}
