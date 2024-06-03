<?php
class Alertas_model extends CI_Model {
    public function get_alertas_count_by_risk($pacienteId) {
        $this->db->select('risco, COUNT(*) as count');
        $this->db->where('paciente_id', $pacienteId);
        $this->db->group_by('risco');
        $query = $this->db->get('alertas');

        $alertasCount = array(
            'baixo' => 0,
            'medio' => 0,
            'alto' => 0,
            'urgente' => 0
        );

        foreach ($query->result() as $row) {
            $alertasCount[$row->risco] = $row->count;
        }

        return $alertasCount;
    }
}
