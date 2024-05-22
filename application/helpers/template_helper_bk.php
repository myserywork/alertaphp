<?php

function includeCSS($filePath)
{
    $CI =& get_instance();
    $CI->load->helper('url');
    $cssPath = (isLink($filePath)) ? $filePath : base_url($filePath);
    echo '<link rel="stylesheet" type="text/css" href="' . $cssPath . '">';
}


function includeJS($filePath, $type = "text/javascript")
{
    $CI =& get_instance();
    $CI->load->helper('url');
    $jsPath = (isLink($filePath)) ? $filePath : base_url($filePath);
    echo '<script type="' . $type . '" src="' . $jsPath . '"></script>';
}

function isLink($link)
{
    if (strpos($link, 'http://') !== false || strpos($link, 'https://') !== false) {
        return true;
    } else {
        return false;
    }
}


function generatePageBreadcrumb($pageTitle, $breadcrumbItems)
{
    $ci = &get_instance();
    $ci->load->helper('url');
    $url = base_url();
    $breadcrumbHtml = '<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">';
    $breadcrumbHtml .= '<div class="breadcrumb-title pe-3">' . $pageTitle . '</div>';
    $breadcrumbHtml .= '<div class="ps-3">';
    $breadcrumbHtml .= '<nav aria-label="breadcrumb">';
    $breadcrumbHtml .= '<ol class="breadcrumb mb-0 p-0 align-items-center">';

    $breadcrumbHtml .= '<li class="breadcrumb-item first-one">';
    $breadcrumbHtml .= '<ion-icon name="home-outline" role="img" class="md hydrated" aria-label="home outline"></ion-icon>';
    $breadcrumbHtml .= '</li>';

    foreach ($breadcrumbItems as $index => $item) {
        $isActive = ($index === count($breadcrumbItems) - 1) ? 'active' : '';
        $breadcrumbHtml .= '<li class="breadcrumb-item">';
        $breadcrumbHtml .= '<a href="'.$url.'dashboard">' . $item . '</a>';
        $breadcrumbHtml .= '</li>';
    }


    $breadcrumbHtml .= '</ol>';
    $breadcrumbHtml .= '</nav>';
    $breadcrumbHtml .= '</div>';
    /*
    $breadcrumbHtml .= '<div class="ms-auto">';
    $breadcrumbHtml .= '<div class="btn-group">';
    $breadcrumbHtml .= '<button type="button" class="btn btn-outline-primary">Settings</button>';
    $breadcrumbHtml .= '<button type="button" class="btn btn-outline-primary split-bg-primary dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown">';
    $breadcrumbHtml .= '<span class="visually-hidden">Toggle Dropdown</span>';
    $breadcrumbHtml .= '</button>';
    $breadcrumbHtml .= '<div class="dropdown-menu dropdown-menu-right dropdown-menu-lg-end">';
    $breadcrumbHtml .= '<a class="dropdown-item" href="javascript:;">Action</a>';
    $breadcrumbHtml .= '<a class="dropdown-item" href="javascript:;">Another action</a>';
    $breadcrumbHtml .= '<a class="dropdown-item" href="javascript:;">Something else here</a>';
    $breadcrumbHtml .= '<div class="dropdown-divider"></div>';
    $breadcrumbHtml .= '<a class="dropdown-item" href="javascript:;">Separated link</a>';
    $breadcrumbHtml .= '</div>';
    $breadcrumbHtml .= '</div>';
    $breadcrumbHtml .= '</div>';
    */
    $breadcrumbHtml .= '</div>';

    return $breadcrumbHtml;
}


function redirect_with_message($url, $level, $message)
{
    $CI =& get_instance();
    $CI->load->library('session');
    $CI->session->set_flashdata('message', array('message' => $message, 'level' => $level));
    redirect($url);
}

function jsAlert($message)
{
    echo '<script>alert("' . $message . '");</script>';
}
function show_alert($message, $title, $icon = null)
{
    echo '<script>swal({ title: "' . $title . '", text: "' . $message . '", icon: "' . $icon . '" });</script>';
}


function validateRoutes($protected_routes)
{

    $user = false;
    $ci = &get_instance();
    $ci->load->library('ion_auth');
    $ci->load->helper('url');

    if (!$ci->ion_auth->logged_in()) {
        redirect_with_message('login', 'warning', 'Você precisa estar logado para acessar essa página');
    } else {
        $user = $ci->ion_auth->user()->row();
    }

    if ($user == false) {

        // Verifica se a URL tem mais de um segmento e obtém o segundo segmento se existir
        $current_segment = $ci->uri->total_segments() > 1 ? $ci->uri->segment(2) : $ci->uri->segment(1);
        if (in_array($current_segment, $protected_routes)) {
            redirect_with_message('login', 'warning', 'Você precisa estar logado para acessar essa página');
        } else {
            return false; // Indica que a validação falhou e que o usuario tem acesso;
        }
    }
    return true; // Indica que a validação foi bem-sucedida
}


function time_ago($timestamp)
{
    $current_time = time();
    $time_diff = $current_time - $timestamp;

    $seconds = $time_diff;
    $minutes = round($time_diff / 60);
    $hours = round($time_diff / 3600);
    $days = round($time_diff / 86400);
    $weeks = round($time_diff / 604800);
    $months = round($time_diff / 2419200);
    $years = round($time_diff / 29030400);

    if ($seconds < 60) {
        return "agora mesmo";
    } elseif ($minutes == 1) {
        return "1 minuto atrás";
    } elseif ($minutes < 60) {
        return $minutes . " minutos atrás";
    } elseif ($hours == 1) {
        return "1 hora atrás";
    } elseif ($hours < 24) {
        return $hours . " horas atrás";
    } elseif ($days == 1) {
        return "1 dia atrás";
    } elseif ($days < 7) {
        return $days . " dias atrás";
    } elseif ($weeks == 1) {
        return "1 semana atrás";
    } elseif ($weeks < 4) {
        return $weeks . " semanas atrás";
    } elseif ($months == 1) {
        return "1 mês atrás";
    } elseif ($months < 12) {
        return $months . " meses atrás";
    } elseif ($years == 1) {
        return "1 ano atrás";
    } else {
        return $years . " anos atrás";
    }
}

function showModal($url, $w, $h)
{
    return 'onClick="openModal(\'' . $url . '\', \'' . $w . '%\', \'' . $h . '%\');"';
}

function replacePOST($fields)
{
    foreach ($fields as $k => $value) {
        if ($k == 'created_at' || $k == 'updated_at' || $k == 'deleted_at') {
            continue;
        }
        $_POST[$k] = $value;
    }

}