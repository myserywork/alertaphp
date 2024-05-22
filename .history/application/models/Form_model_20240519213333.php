<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Form_model extends CI_Model {

    public function get_all_forms() {
        return $this->db->get('form_forms')->result();
    }

    public function get_form($id) {
        return $this->db->get_where('form_forms', array('id' => $id))->row();
    }

    public function save_form($data) {
        $this->db->insert('form_forms', $data);
        return $this->db->insert_id();
    }

    public function get_form_fields($form_id) {
        return $this->db->get_where('form_fields', array('form_id' => $form_id))->result();
    }

    public function save_field($data) {
        $this->db->insert('form_fields', $data);
    }

    public function get_form_by_category($category_id) {
        return $this->db->get_where('form_forms', array('category_id' => $category_id))->row();
    }
}
?>
