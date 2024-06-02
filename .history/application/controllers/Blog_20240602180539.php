<?php


defined('BASEPATH') or exit('No direct script access allowed');

class Blog extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('blog_model');
    }

    public function index() {
        $posts = $this->blog_model->get()->result();

        echo $this->loadBase(
            array(
                'title' => 'Blog',
                'content' => "frontend/blog/index",
                'breadcumbs' => array("INÍCIO"),
                'posts' => $posts,
                'noBody' => true,
            )
        );
    }

}

/*
begin posts structure mytsql insert 

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

*/
?>