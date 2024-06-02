<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Representante_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function insert($data) {
        $this->db->insert('representantes', $data);
        return $this->db->insert_id();
    }
}
