<?php
class Blog_model extends CI_Model {
    public function __construct() {
        parent::__construct();
    }

    // Get all posts
    public function get() {
        return $this->db->get('posts');
    }

}