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



    public function show($id) {
        $post = $this->blog_model->get($id)->row();

        echo $this->loadBase(
            array(
                'title' => $post->title,
                'content' => "frontend/blog/show",
                'breadcumbs' => array("INÍCIO", "POSTS", $post->title),
                'post' => $post,
                'noBody' => true,
            )
        );
    }

    private function loadBase($context) {
        $user = loggedInUser();

        if (isset($context['breadcumbs'])) {
            $context['breadcumbs'] = generatePageBreadcrumb($context['title'], $context['breadcumbs']);
        }

        $context['user'] = $user;
        $context['notifications'] = $this->notifications_model->get(1, 5);
        $context['content'] = $this->load->view($context['content'], $context, true);
        return $this->load->view('dashboard/template/base_template_view', $context, TRUE);
    }

}

?>