<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Pacientes_model extends CI_Model
{

  public function __construct()
  {
    parent::__construct();
  }

  public function get($id = null)
  {
    if ($id) {
      $this->db->where('id', $id);
    }

    $this->db->where('deleted_at', null);
    return $this->db->get('pacientes');
  }

  public function insert($data)
  {
    $this->db->insert('pacientes', $data);
    return $this->db->insert_id();
  }

  public function update($data, $id)
  {
    $this->db->where('id', $id);
    return $this->db->update('pacientes', $data);
  }

  public function delete($id)
  {
    $this->db->where('id', $id);
    return $this->db->delete('pacientes');
  }
}


?>
