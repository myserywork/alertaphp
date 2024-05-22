<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Response_model extends CI_Model {

    public function get_all_responses() {
        return $this->db->get('form_responses')->result();
    }

    public function get_responses_by_category($category_id) {
        $this->db->select('form_responses.*, forms.name as form_name');
        $this->db->from('form_responses');
        $this->db->join('forms', 'form_responses.form_id = forms.id');
        $this->db->where('forms.category_id', $category_id);
        return $this->db->get()->result();
    }

    public function get_response($response_id) {
        return $this->db->get_where('form_responses', ['id' => $response_id])->row();
    }
}
?>
