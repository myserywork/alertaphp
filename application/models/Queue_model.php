<?php
class Queue_model extends CI_Model {
    public function __construct() {
        parent::__construct();
    }

    // Get all queues
    public function get_all_queues() {
        return $this->db->get('queues')->result();
    }

    // Get a queue by ID
    public function get_queue_by_id($queue_id) {
        return $this->db->get_where('queues', array('queueid' => $queue_id))->row();
    }

    // Insert a new queue
    public function insert_queue($data) {
        return $this->db->insert('queues', $data);
    }

    // Update a queue
    public function update_queue($queue_id, $data) {
        $this->db->where('queueid', $queue_id);
        return $this->db->update('queues', $data);
    }

    // Delete a queue
    public function delete_queue($queue_id) {
        return $this->db->delete('queues', array('queueid' => $queue_id));
    }

    // Get all queues with their statuses
    public function get_queues_with_statuses() {
        $this->db->select('queues.*, queue_statuses.name as status_name, queue_statuses.description as status_description');
        $this->db->join('queue_statuses', 'queues.statusid = queue_statuses.id', 'left');
        return $this->db->get('queues')->result();
    }
}
