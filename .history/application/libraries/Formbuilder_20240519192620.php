<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Formbuilder {

    protected $CI;

    public function __construct() {
        // Obter instância do CodeIgniter
        $this->CI =& get_instance();
        $this->CI->load->database();
        $this->CI->load->helper('form');
        $this->CI->load->library('form_validation');
    }

    public function generateForm($form_id, $formData = array()) {
        $form = $this->CI->db->get_where('forms', array('id' => $form_id))->row();
        $fields = $this->CI->db->get_where('form_fields', array('form_id' => $form_id))->result();

        $output = '<div class="card">';
        $output .= '<div class="card-body">';
        $output .= '<div class="border p-3 rounded">';
        $output .= '<h6>'.$form->name.'</h6>';
        $output .= '<p>'.$form->description.'</p>';
        $output .= '<hr>';

        foreach ($fields as $field) {
            $name = $field->name . '#' . $field->id;
            $label = $field->display;
            $type = $field->type;
            $validations = isset($field->validations) ? $field->validations : '';
            $value = isset($formData[$name]) ? $formData[$name] : '';

            $output .= '<div class="form-group">';
            $output .= '<label for="'.$name.'">'.$label.'</label>';
            
            switch ($type) {
                case 'multiselect':
                    $options = $field->options ? explode(',', $field->options) : array();
                    $output .= '<select name="'.$name.'" multiple data-role="tagsinput">';
                    foreach ($options as $option) {
                        $output .= '<option value="'.$option.'"';
                        if (in_array($option, (array)$value)) {
                            $output .= ' selected';
                        }
                        $output .= '>'.$option.'</option>';
                    }
                    $output .= '</select>';
                    break;
                case 'text':
                    $output .= form_input(array('name' => $name, 'class' => 'form-control', 'id' => $name, 'value' => $value));
                    break;
                case 'select':
                    $options = array();
                    foreach (explode(',', $field->options) as $option) {
                        $options[$option] = $option;
                    }
                    $output .= form_dropdown($name, $options, $value, 'class="form-control" id="'.$name.'"');
                    break;
                case 'radio':
                    $options = explode(',', $field->options);
                    foreach ($options as $option) {
                        $output .= '<div class="form-check">';
                        $output .= form_radio($name, $option, $value == $option, 'class="form-check-input" id="'.$name.'"');
                        $output .= '<label class="form-check-label" for="'.$name.'">'.$option.'</label>';
                        $output .= '</div>';
                    }
                    break;
                case 'checkbox':
                    $options = explode(',', $field->options);
                    foreach ($options as $option) {
                        $output .= '<div class="form-check">';
                        $output .= form_checkbox($name.'[]', $option, in_array($option, (array)$value), 'class="form-check-input" id="'.$name.'"');
                        $output .= '<label class="form-check-label" for="'.$name.'">'.$option.'</label>';
                        $output .= '</div>';
                    }
                    break;
                case 'textarea':
                    $output .= form_textarea(array('name' => $name, 'class' => 'form-control', 'id' => $name, 'value' => $value));
                    break;
                case 'date':
                    $output .= form_input(array('name' => $name, 'class' => 'form-control datepicker', 'id' => $name, 'value' => $value));
                    break;
                case 'datetime':
                    $output .= form_input(array('name' => $name, 'class' => 'form-control datetimepicker', 'id' => $name, 'value' => $value));
                    break;
                case 'file':
                    $output .= form_upload(array('name' => $name, 'class' => 'form-control', 'id' => $name));
                    break;
                default:
                    $output .= 'Unsupported field type: '.$type;
                    break;
            }
            
            $output .= '</div>';

            // Apply validations
            if (!empty($validations)) {
                $this->CI->form_validation->set_rules($name, $label, $validations);
            }
        }
        
        $output .= '</div>';
        $output .= '</div>';
        $output .= '</div>';

        $output .= '<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>';

        return $output;
    }

    public function saveFormResponse($form_id, $user_id, $formData) {
        // Verifique se o ID do usuário não é nulo
        if (!$user_id) {
            throw new Exception('User ID cannot be null');
        }

        $this->CI->db->insert('form_responses', array('form_id' => $form_id, 'user_id' => $user_id));
        $response_id = $this->CI->db->insert_id();

        $fields = $this->CI->db->get_where('form_fields', array('form_id' => $form_id))->result();

        foreach ($fields as $field) {
            $name = $field->name . '#' . $field->id;
            $value = isset($formData[$name]) ? $formData[$name] : '';

            if (is_array($value)) {
                $value = implode(',', $value);
            }

            if ($field->type == 'file') {
                $upload_data = $this->uploadFile($name);
                if (isset($upload_data['upload_data'])) {
                    $value = $upload_data['upload_data']['file_name'];
                } else {
                    $value = null; // ou trate o erro conforme necessário
                }
            }

            $data = [
                'response_id' => $response_id,
                'field_id' => $field->id,
                'value' => $value,
            ];

            $this->CI->db->insert('form_response_values', $data);
        }
    }

    public function uploadFile($name) {
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = '*';
      
        $this->CI->load->library('upload', $config);

        if (!$this->CI->upload->do_upload($name)) {
            $error = array('error' => $this->CI->upload->display_errors());
            return $error;
        } else {
            $data = array('upload_data' => $this->CI->upload->data());
            return $data;
        }
    }
}
?>
