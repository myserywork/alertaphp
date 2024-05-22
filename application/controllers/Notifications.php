<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Notifications extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    validateRoutes(array('index', 'notifications'));
  }

  public function index()
  {
    echo $this->loadBase(
      array(
        'title' => 'Notificações',
        'content' => 'dashboard/notifications/notifications_view',
        'notificationData' => $this->notifications_model->get_all(loggedInUser()->id),
        'breadcumbs' => array("INICIO", "NOTIFICAÇÕES"),
      )
    );
  }

  public function markAsRead($id)
  {
    $this->notifications_model->update($id, array('status' => 'read'));
    redirect_with_message('notifications', 'success', 'Notificação marcada como lida com sucesso!');
  }

  public function markAllAsRead()
  {
    $this->notifications_model->markAllAsRead(loggedInUser()->id);
    redirect_with_message('notifications', 'success', 'Todas as notificações foram marcadas como lidas com sucesso!');
  }

  public function delete($id)
  {
    $this->notifications_model->delete($id);
    redirect_with_message('notifications', 'success', 'Notificação excluída com sucesso!');
  }


  public function createFakeNotifications()
  {
    $this->notifications_model->createFakeNotifications(loggedInUser()->id, 10);
    redirect_with_message('notifications', 'success', 'Notificações criadas com sucesso!');
  }


  public function loadBase($context)
  {

    $user = loggedInUser();

    if (isset($context['breadcumbs'])) {
      $context['breadcumbs'] = generatePageBreadcrumb($context['title'], $context['breadcumbs']);
    }

    $context['user'] = $user;
    $context['notifications'] = $this->notifications_model->get($user->id, 5);
    $context['content'] = $this->load->view($context['content'], $context, true);

    return $this->load->view('dashboard/template/base_template_view', $context, TRUE);
  }




}

?>