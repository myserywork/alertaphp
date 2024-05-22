<?php
class Telemedicine_model extends CI_Model {
    public function __construct() {
        parent::__construct();
    }

    // Get all telemedicine sessions
    public function get_all_sessions() {
        return $this->db->get('telemedicine_sessions')->result();
    }

    // Get a telemedicine session by ID
    public function get_session_by_id($session_id) {
        return $this->db->get_where('telemedicine_sessions', array('sessionid' => $session_id))->row();
    }

    // Insert a new telemedicine session
    public function insert_session($data) {
        return $this->db->insert('telemedicine_sessions', $data);
    }

    // Update a telemedicine session
    public function update_session($session_id, $data) {
        $this->db->where('sessionid', $session_id);
        return $this->db->update('telemedicine_sessions', $data);
    }

    // Delete a telemedicine session
    public function delete_session($session_id) {
        return $this->db->delete('telemedicine_sessions', array('sessionid' => $session_id));
    }

    // Get all messages for a specific session
    public function get_messages_by_session_id($session_id) {
        return $this->db->get_where('session_messages', array('sessionid' => $session_id))->result();
    }

    // Insert a new message for a specific session
    public function insert_message($data) {
        return $this->db->insert('session_messages', $data);
    }

    // Get all media files for a specific session
    public function get_media_by_session_id($session_id) {
        return $this->db->get_where('session_media', array('sessionid' => $session_id))->result();
    }

    // Insert a new media file for a specific session
    public function insert_media($data) {
        return $this->db->insert('session_media', $data);
    }

    // Get all prescriptions for a specific session
    public function get_prescriptions_by_session_id($session_id) {
        return $this->db->get_where('session_prescriptions', array('sessionid' => $session_id))->result();
    }

    // Insert a new prescription for a specific session
    public function insert_prescription($data) {
        return $this->db->insert('session_prescriptions', $data);
    }
}
