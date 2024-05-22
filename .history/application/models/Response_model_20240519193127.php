<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Response_model extends CI_Model {

    public function get_all_responses() {
        $query = $this->db->get('form_responses');
        return $query->result();
    }

    public function get_responses_by_category($category_id) {
        $this->db->select('form_responses.*');
        $this->db->from('form_responses');
        $this->db->join('forms', 'forms.id = form_responses.form_id');
        $this->db->where('forms.category_id', $category_id);
        $query = $this->db->get();
        return $query->result();
    }

    public function get_response($response_id) {
        return $this->db->get_where('form_responses', array('id' => $response_id))->row();
    }
}
?>
