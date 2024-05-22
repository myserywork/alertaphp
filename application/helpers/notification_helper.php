<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if (!function_exists('send_notification')) {
    function send_notification($type, $options = array()) {
        $CI =& get_instance();

        $defaultOptions = array(
            'pauseDelayOnHover' => true,
            'continueDelayOnInactiveTab' => false,
            'position' => 'top right',
            'icon' => 'bx bx-x-circle',
            'msg' => ''
        );

        $notificationOptions = array_merge($defaultOptions, $options);

        $notificationScript = "
            Lobibox.notify('$type', {
                pauseDelayOnHover: " . ($notificationOptions['pauseDelayOnHover'] ? 'true' : 'false') . ",
                continueDelayOnInactiveTab: " . ($notificationOptions['continueDelayOnInactiveTab'] ? 'true' : 'false') . ",
                position: '{$notificationOptions['position']}',
                icon: '{$notificationOptions['icon']}',
                msg: '{$notificationOptions['msg']}'
            });
        ";

        $CI->output->append_output("<script>
            document.addEventListener('DOMContentLoaded', function() {
                $notificationScript
            });
        </script>");
    }
}
