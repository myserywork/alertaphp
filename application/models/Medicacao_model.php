<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Medicacao_model extends CI_Model {

    public function get_by_paciente($paciente_id) {
        $this->db->where('paciente_id', $paciente_id);
        return $this->db->get('medicacoes')->result();
    }

    public function insert($data) {
        $this->db->insert('medicacoes', $data);
    }

    public function delete($id) {
        $this->db->where('id', $id);
        $this->db->delete('medicacoes');
    }
}

?>
