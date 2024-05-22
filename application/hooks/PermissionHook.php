<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PermissionHook {
  protected $CI;
  
  public function __construct() {
    $this->CI =& get_instance();
  }
  
  public function check_permission() {
  
    // Obtém o controller e o método atual
    $controller = $this->CI->router->fetch_class();
    $method = $this->CI->router->fetch_method();
    // Obtém o ID do usuário logado, se disponível
    $user_id = $this->CI->session->userdata('user_id');

    if($controller == 'auth' OR $controller == 'store' OR $controller == 'logs') {
      return true;
    }

    // Verifica se o usuário está logado
    if (!empty($user_id)) {
      // Verifica se o usuário possui a permissão necessária
      $action_url = $controller . '/' . $method;
      $permission_slug = $controller . '/' .  $method;
      
      $this->CI->load->model('permissions_model');
      $has_permission = $this->CI->permissions_model->has_permission($user_id, $permission_slug);
      $permission = new stdClass();
      $permission->slug = $permission_slug;
      $permission->action_url = $action_url;
      $this->CI->permissions_model->create_permission($permission);
      if (!$has_permission) {
        // Redireciona o usuário ou mostra uma mensagem de erro
        redirect_with_message('/', 'error', 'Você não tem permissão para acessar esta página.');
      }
    } else {
      // Redireciona o usuário para a página de login ou mostra uma mensagem de erro
      redirect_with_message('login',  'error', 'Você não tem permissão para acessar esta página.');
    }
  }
}
