<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CompressionHook {

    protected $CI;

    public function __construct() {
        $this->CI =& get_instance();
    }

    public function compress_output() {
        // Verifica se a compressão está habilitada
        if ($this->CI->config->item('compress_output')) {
            ob_start('ob_gzhandler');
        }
    }

}
