<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    validateRoutes('index', 'dashboard');

  }


  public function index()
  {

    echo $this->loadBase(
      array(
        'title' => 'Dashboard',
        'content' => "dashboard/monit_view",
        'breadcumbs' => array("INÍCIO"),
      )
    );
    // show_alert('success', 'Teste de alerta', 'warning');
  }


  public function monit()
  {

    echo $this->loadBase(
      array(
        'title' => 'Dashboard',
        'content' => "dashboard/monit_view",
        'breadcumbs' => array("INÍCIO"),
      )
    );

    // show_alert('success', 'Teste de alerta', 'warning');
  }


  public function notifications()
  {

    echo $this->loadBase(
      array(
        'title' => 'Notificações',
        'content' => 'dashboard/notifications/notifications_view',
        'breadcumbs' => array("INÍCIO"),
      )
    );

  }


  public function loadBase($context)
  {

    $user = loggedInUser();

    if (isset($context['breadcumbs'])) {
      $context['breadcumbs'] = generatePageBreadcrumb($context['title'], $context['breadcumbs']);
    }

    $context['user'] = $user;

    $context['user'] = $user;
    $context['notifications'] = $this->notifications_model->get($user->id, 5);
    $context['content'] = $this->load->view($context['content'], $context, true);
    return $this->load->view('dashboard/template/base_template_view', $context, TRUE);
  }

}


/* End of file Dashboard.php and path \application\controllers\Dashboard\Dashboard.php */