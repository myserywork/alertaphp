<?php 


function listUserPerm($redirect = true)
{
    $ci = &get_instance();
    $ci->load->library('ion_auth');
    $ci->load->helper('url');

    if (!$ci->ion_auth->logged_in()) {
        if ($redirect) {
            redirect_with_message('login', 'warning', 'Você precisa estar logado para acessar essa página');
        }
        return false;
    }

    $user = $ci->ion_auth->user()->row();

    if ($user === null) {
        if ($redirect) {
            redirect_with_message('login', 'warning', 'Usuário não encontrado');
        }
        return false;
    }

    return true;
}