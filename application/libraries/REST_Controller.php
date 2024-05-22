<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class REST_Controller extends CI_Controller {

    protected function api_response($data = null, $success = true, $message = '', $http_status = 200) {
        $ci =& get_instance();
        
        $response = array(
            'success' => $success,
            'message' => $message,
            'data' => $data
        );
        $ci->output
            ->set_status_header($http_status)
            ->set_content_type('application/json')
            ->set_output(json_encode($response));
    }

    protected function api_error_response($message, $http_status = 500) {
        $this->api_response(null, false, $message, $http_status);
    }

    protected function get_input_data() {
        return json_decode(file_get_contents('php://input'), true);
    }

    protected function validate_required_fields($data, $required_fields) {
        $missing_fields = array_diff($required_fields, array_keys($data));
        if (!empty($missing_fields)) {
            $this->api_error_response('Missing required fields: ' . implode(', ', $missing_fields), 400);
        }
    }
}
