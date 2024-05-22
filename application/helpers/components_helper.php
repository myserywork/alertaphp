<?php

if (!function_exists('load_component')) {
    function load_component($componentName, $params = array()) {
        $CI =& get_instance();
        // Caminho do componente
        $componentPath = APPPATH . 'components/' . $componentName . '/';
        // Caminho da view do componente
        $viewPath = $componentPath . 'index_view.php';
        // Verifica se a view do componente existe
        if (file_exists($viewPath)) {
            extract($params); // Extrai os parâmetros para variáveis locais
            ob_start(); // Inicia o buffer de saída
            include($viewPath); // Inclui o arquivo da view
            $viewContent = ob_get_clean(); // Armazena o conteúdo da view do componente
            echo $viewContent; // Exibe o conteúdo da view
        } else {
            show_error('View do componente não encontrada: ' . $viewPath);
        }

        // Inclui o arquivo de estilo
        $stylePath = $componentPath . 'style.php';
        if (file_exists($stylePath)) {
            require_once($stylePath);
        }
        // Inclui o arquivo de script
        $scriptPath = $componentPath . 'scripts.php';
        if (file_exists($scriptPath)) {
            require_once($scriptPath);
        }
    }
}