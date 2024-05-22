<?php
class Uploaded_file_model extends CI_Model {
    public function __construct() {
        parent::__construct();
    }

    // Get all uploaded files
    public function get_all_uploaded_files() {
        return $this->db->get('uploaded_files')->result();
    }

    // Get an uploaded file by ID
    public function get_uploaded_file_by_id($file_id) {
        return $this->db->get_where('uploaded_files', array('fileid' => $file_id))->row();
    }

    // Insert a new uploaded file
    public function insert_uploaded_file($data) {
        return $this->db->insert('uploaded_files', $data);
    }

    // Update an uploaded file
    public function update_uploaded_file($file_id, $data) {
        $this->db->where('fileid', $file_id);
        return $this->db->update('uploaded_files', $data);
    }

    // Delete an uploaded file
    public function delete_uploaded_file($file_id) {
        return $this->db->delete('uploaded_files', array('fileid' => $file_id));
    }
}
