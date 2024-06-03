<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Prontuario_model extends CI_Model {

    public function get_by_paciente($paciente_id) {
        $this->db->where('paciente_id', $paciente_id);
        return $this->db->get('prontuarios')->result();
    }

    public function insert($data) {
        $this->db->insert('prontuarios', $data);
    }

    public function delete($id) {
        $this->db->where('id', $id);
        $this->db->delete('prontuarios');
    }
}

?>
