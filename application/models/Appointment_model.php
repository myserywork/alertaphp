<?php
class Appointment_model extends CI_Model {
    public function __construct() {
        parent::__construct();
    }

    // Get all appointments
    public function get_all_appointments() {
        return $this->db->get('appointments')->result();
    }

    // Get an appointment by ID
    public function get_appointment_by_id($appointment_id) {
        return $this->db->get_where('appointments', array('appointmentid' => $appointment_id))->row();
    }

    // Insert a new appointment
    public function insert_appointment($data) {
        return $this->db->insert('appointments', $data);
    }

    // Update an appointment
    public function update_appointment($appointment_id, $data) {
        $this->db->where('appointmentid', $appointment_id);
        return $this->db->update('appointments', $data);
    }

    // Delete an appointment
    public function delete_appointment($appointment_id) {
        return $this->db->delete('appointments', array('appointmentid' => $appointment_id));
    }

    // Get all appointments for a specific doctor
    public function get_appointments_by_doctor_id($doctor_id) {
        return $this->db->get_where('appointments', array('doctorid' => $doctor_id))->result();
    }

    // Get all appointments for a specific patient
    public function get_appointments_by_patient_id($patient_id) {
        return $this->db->get_where('appointments', array('patientid' => $patient_id))->result();
    }
}
