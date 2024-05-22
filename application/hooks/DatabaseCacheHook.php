<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DatabaseCacheHook {

    protected $CI;

    public function __construct() {
        $this->CI =& get_instance();
    }

    public function cache_database_queries() {
        // Verifica se o cache de banco de dados está habilitado
        if ($this->CI->config->item('db_cache_enabled')) {
            $cache_key = 'db_' . md5($this->CI->db->last_query());

            // Tenta obter o resultado da consulta em cache
            if ($cached_result = $this->CI->cache->get($cache_key)) {
                // Retorna o resultado em cache
                $this->CI->db->store_result($cached_result);
                return;
            }
        }
    }

    public function save_database_query_cache() {
        // Verifica se o cache de banco de dados está habilitado
        if ($this->CI->config->item('db_cache_enabled')) {
            $cache_key = 'db_' . md5($this->CI->db->last_query());

            // Armazena o resultado da consulta em cache por um determinado tempo
            $this->CI->cache->save($cache_key, $this->CI->db->get_cache(), $this->CI->config->item('db_cache_duration'));
        }
    }
}
