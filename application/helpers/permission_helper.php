<?php

function hasPermission($permission)
{
    $ci = &get_instance();
    $ci->load->library('ion_auth');
    $ci->load->helper('url');

    if (!$ci->ion_auth->logged_in()) {
        return false;
    }

    $user = $ci->ion_auth->user()->row();

    if ($user === null) {
        return false;
    }

    if (!$ci->ion_auth->in_group($permission)) {
        return false;
    }

    return true;
}


function limitPermission($permission, $redirect = true)
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

    if (!$ci->ion_auth->in_group($permission)) {
        if ($redirect) {
            redirect_with_message('login', 'warning', 'Você não tem permissão para acessar essa página');
        }
        return false;
    }

    return true;
}