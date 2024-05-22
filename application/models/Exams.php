<?php
class Exam_model extends CI_Model {
    public function __construct() {
        parent::__construct();
    }

    // Get all exams
    public function get_all_exams() {
        return $this->db->get('exams')->result();
    }

    // Get an exam by ID
    public function get_exam_by_id($exam_id) {
        return $this->db->get_where('exams', array('examid' => $exam_id))->row();
    }

    // Insert a new exam
    public function insert_exam($data) {
        return $this->db->insert('exams', $data);
    }

    // Update an exam
    public function update_exam($exam_id, $data) {
        $this->db->where('examid', $exam_id);
        return $this->db->update('exams', $data);
    }

    // Delete an exam
    public function delete_exam($exam_id) {
        return $this->db->delete('exams', array('examid' => $exam_id));
    }

    // Get all exams for a specific patient
    public function get_exams_by_patient_id($patient_id) {
        return $this->db->get_where('exams', array('patientid' => $patient_id))->result();
    }

    // Get all exams for a specific doctor
    public function get_exams_by_doctor_id($doctor_id) {
        return $this->db->get_where('exams', array('doctorid' => $doctor_id))->result();
    }
}
