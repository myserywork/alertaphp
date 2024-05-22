<?php
class Patient_model extends CI_Model {
    public function __construct() {
        parent::__construct();
    }

    // Get all patients
    public function get_all_patients() {
        return $this->db->get('patients')->result();
    }

    // Get a patient by ID
    public function get_patient_by_id($patient_id) {
        return $this->db->get_where('patients', array('patientid' => $patient_id))->row();
    }

    // Insert a new patient
    public function insert_patient($data) {
        return $this->db->insert('patients', $data);
    }

    // Update a patient
    public function update_patient($patient_id, $data) {
        $this->db->where('patientid', $patient_id);
        return $this->db->update('patients', $data);
    }

    // Delete a patient
    public function delete_patient($patient_id) {
        return $this->db->delete('patients', array('patientid' => $patient_id));
    }

    // Get all attributes for a patient (human or pet)
    public function get_attributes_by_patient_id($patient_id) {
        $this->db->where('patientid', $patient_id);
        $query = $this->db->get('patient_attribute_values');
        $attributes = $query->result();
        
        $this->db->where('patientid', $patient_id);
        $query = $this->db->get('pet_attribute_values');
        $pet_attributes = $query->result();
        
        return array_merge($attributes, $pet_attributes);
    }

    // Insert a new attribute for a patient (human or pet)
    public function insert_attribute($data) {
        if ($data['species'] === 'human') {
            return $this->db->insert('patient_attribute_values', $data);
        } elseif ($data['species'] === 'pet') {
            return $this->db->insert('pet_attribute_values', $data);
        }
    }

    // Update an attribute for a patient (human or pet)
    public function update_attribute($attribute_id, $data) {
        if ($data['species'] === 'human') {
            $this->db->where('attributeid', $attribute_id);
            return $this->db->update('patient_attribute_values', $data);
        } elseif ($data['species'] === 'pet') {
            $this->db->where('attributeid', $attribute_id);
            return $this->db->update('pet_attribute_values', $data);
        }
    }

    // Delete an attribute for a patient (human or pet)
    public function delete_attribute($attribute_id, $species) {
        if ($species === 'human') {
            return $this->db->delete('patient_attribute_values', array('attributeid' => $attribute_id));
        } elseif ($species === 'pet') {
            return $this->db->delete('pet_attribute_values', array('attributeid' => $attribute_id));
        }
    }
}
