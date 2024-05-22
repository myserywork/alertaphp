<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category_model extends CI_Model {

    public function get_all_categories() {
        return $this->db->get('form_categories')->result();
    }

    public function get_category($id) {
        return $this->db->get_where('form_categories', array('id' => $id))->row();
    }

    public function save_category($data) {
        $this->db->insert('form_categories', $data);
    }

    public function update_category($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('form_categories', $data);
    }

    public function delete_category($id) {
        $this->db->where('id', $id);
        $this->db->delete('form_categories');
    }
}
?>
