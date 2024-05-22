<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if (!function_exists('generate_tab_pills')) {
    function generate_tab_pills($data, $customClasses = '') {
        $CI =& get_instance();
        $id = 'tabs_' . uniqid(); // Gerar um ID único para evitar interferência entre os componentes
        echo '<div class="card '.$customClasses.'">';
        echo '    <div class="card-body">';
        echo '        <ul class="nav nav-pills mb-3" role="tablist">';
        foreach ($data as $key => $tab) {
            $isActive = $key === 0 ? 'active' : '';

            echo '            <li class="nav-item" role="presentation">';
            echo '                <a class="nav-link ' . $isActive . '" data-bs-toggle="pill" href="#' . $id . '-' . $key . '" role="tab" aria-selected="true">';
            echo '                    <div class="d-flex align-items-center">';
            echo '                        <div class="tab-icon"><ion-icon name="' . $tab['icon'] . '" class="me-1"></ion-icon></div>';
            echo '                        <div class="tab-title">' . $tab['title'] . '</div>';
            echo '                    </div>';
            echo '                </a>';
            echo '            </li>';
        }

        echo '        </ul>';
        echo '        <div class="tab-content" id="' . $id . '-tabContent">';
        foreach ($data as $key => $tab) {
            $isActive = $key === 0 ? 'show active' : '';
            echo '            <div class="tab-pane fade ' . $isActive . '" id="' . $id . '-' . $key . '" role="tabpanel">';
            echo '                <p>' . $tab['content'] . '</p>';
            echo '            </div>';
        }

        echo '        </div>';
        echo '    </div>';
        echo '</div>';

        echo '<script>
            $(document).ready(function() {
                $("#' . $id . '-tabContent .nav-link").click(function(e) {
                    e.preventDefault();
                    var target = $(this).attr("href");
                    $(this).tab("show");
                    $(target).addClass("show active").siblings().removeClass("show active");
                });
            });
        </script>';
    }
}
