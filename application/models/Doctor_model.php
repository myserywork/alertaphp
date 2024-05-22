<?php
class Doctor_model extends CI_Model {
    public function __construct() {
        parent::__construct();
    }

    // Get all doctors
    public function get_all_doctors() {
        return $this->db->get('doctors')->result();
    }

    // Get a doctor by ID
    public function get_doctor_by_id($doctor_id) {
        return $this->db->get_where('doctors', array('doctorid' => $doctor_id))->row();
    }

    // Insert a new doctor
    public function insert_doctor($data) {
        return $this->db->insert('doctors', $data);
    }

    // Update a doctor
    public function update_doctor($doctor_id, $data) {
        $this->db->where('doctorid', $doctor_id);
        return $this->db->update('doctors', $data);
    }

    // Delete a doctor
    public function delete_doctor($doctor_id) {
        return $this->db->delete('doctors', array('doctorid' => $doctor_id));
    }

    // Get all attributes for a doctor
    public function get_attributes_by_doctor_id($doctor_id) {
        return $this->db->get_where('doctor_attribute_values', array('doctorid' => $doctor_id))->result();
    }

    // Insert a new attribute for a doctor
    public function insert_attribute($data) {
        return $this->db->insert('doctor_attribute_values', $data);
    }

    // Update an attribute for a doctor
    public function update_attribute($attribute_id, $data) {
        $this->db->where('attributeid', $attribute_id);
        return $this->db->update('doctor_attribute_values', $data);
    }

    // Delete an attribute for a doctor
    public function delete_attribute($attribute_id) {
        return $this->db->delete('doctor_attribute_values', array('attributeid' => $attribute_id));
    }
}
