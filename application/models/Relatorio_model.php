<?php

class Relatorio_model extends CI_Model {
    public function __construct() {
        parent::__construct();
    }

public function get_relatorios_by_paciente($paciente_id) {
    $this->db->where('paciente_id', $paciente_id);
    $query = $this->db->get('alertas');
    return $query->result();
}

}