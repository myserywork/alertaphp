<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Response_model extends CI_Model {

    public function get_all_responses() {
        return $this->db->get('new_form_responses')->result();
    }

    public function get_responses_by_category($category_id) {
        $this->db->select('new_form_responses.*, new_forms.name as form_name');
        $this->db->from('new_form_responses');
        $this->db->join('new_forms', 'new_form_responses.form_id = new_forms.id');
        $this->db->where('new_forms.category_id', $category_id);
        return $this->db->get()->result();
    }

    public function get_response($response_id) {
        $this->db->select('new_form_responses.*');
        $this->db->from('new_form_responses');
        $this->db->where('new_form_responses.id', $response_id);
        $response = $this->db->get()->row();

        if ($response) {
            $this->db->select('new_form_response_values.*, new_form_fields.name as field_name');
            $this->db->from('new_form_response_values');
            $this->db->join('new_form_fields', 'new_form_response_values.field_id = new_form_fields.id');
            $this->db->where('new_form_response_values.response_id', $response_id);
            $response->values = $this->db->get()->result();
        }

        return $response;
    }
}
?>
