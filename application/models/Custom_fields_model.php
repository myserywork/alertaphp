<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Custom_fields_model extends CI_Model {

    public function get_fields_by_category($category_id) {
        $this->db->where('category_id', $category_id);
        $query = $this->db->get('custom_fields');
        return $query->result();
    }

    public function save_field_value($data) {
        return $this->db->insert('custom_fields_values', $data);
    }

    public function get_field_values($reference, $category_id) {
        $this->db->where('reference', $reference);
        $this->db->where('category_id', $category_id);
        $query = $this->db->get('custom_fields_values');
        return $query->result();
    }

    public function get_categories() {
        $query = $this->db->get('custom_fields_categories');
        return $query->result();
    }

    public function save_category($data) {
        return $this->db->insert('custom_fields_categories', $data);
    }

    public function save_field($data) {
        return $this->db->insert('custom_fields', $data);
    }
}
?>
