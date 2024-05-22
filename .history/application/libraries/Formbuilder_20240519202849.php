<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Formbuilder {

    protected $CI;

    public function __construct() {
        $this->CI =& get_instance();
        $this->CI->load->model('form_model');
    }

    public function generateForm($form_id) {
        $form_fields = $this->CI->form_model->get_form_fields($form_id);
        $form_html = '<form action="'.site_url('forms/save_response').'" method="post">';
        $form_html .= '<input type="hidden" name="form_id" value="'.$form_id.'">';
        foreach ($form_fields as $field) {
            $form_html .= '<div class="form-group">';
            $form_html .= '<label for="'.$field->name.'">'.$field->display.'</label>';
            switch ($field->type) {
                case 'text':
                    $form_html .= '<input type="text" class="form-control" name="'.$field->name.'" id="'.$field->name.'">';
                    break;
                case 'textarea':
                    $form_html .= '<textarea class="form-control" name="'.$field->name.'" id="'.$field->name.'"></textarea>';
                    break;
                case 'select':
                    $form_html .= '<select class="form-control" name="'.$field->name.'" id="'.$field->name.'">';
                    $options = explode(',', $field->options);
                    foreach ($options as $option) {
                        $form_html .= '<option value="'.$option.'">'.$option.'</option>';
                    }
                    $form_html .= '</select>';
                    break;
                case 'radio':
                    $options = explode(',', $field->options);
                    foreach ($options as $option) {
                        $form_html .= '<div class="form-check">';
                        $form_html .= '<input class="form-check-input" type="radio" name="'.$field->name.'" id="'.$field->name.$option.'" value="'.$option.'">';
                        $form_html .= '<label class="form-check-label" for="'.$field->name.$option.'">'.$option.'</label>';
                        $form_html .= '</div>';
                    }
                    break;
                case 'checkbox':
                    $options = explode(',', $field->options);
                    foreach ($options as $option) {
                        $form_html .= '<div class="form-check">';
                        $form_html .= '<input class="form-check-input" type="checkbox" name="'.$field->name.'[]" id="'.$field->name.$option.'" value="'.$option.'">';
                        $form_html .= '<label class="form-check-label" for="'.$field->name.$option.'">'.$option.'</label>';
                        $form_html .= '</div>';
                    }
                    break;
                case 'file':
                    $form_html .= '<input type="file" class="form-control" name="'.$field->name.'" id="'.$field->name.'">';
                    break;
            }
            $form_html .= '</div>';
        }
        $form_html .= '<button type="submit" class="btn btn-primary">Enviar</button>';
        $form_html .= '</form>';
        return $form_html;
    }

    public function saveFormResponse($form_id, $user_id, $formData) {
        $this->CI->db->insert('new_form_responses', ['form_id' => $form_id, 'user_id' => $user_id]);
        $response_id = $this->CI->db->insert_id();

        foreach ($formData as $key => $value) {
            if ($key !== 'form_id') {
                $field = $this->CI->db->get_where('new_form_fields', ['name' => $key, 'form_id' => $form_id])->row();
                if ($field) {
                    $this->CI->db->insert('new_form_response_values', [
                        'response_id' => $response_id,
                        'field_id' => $field->id,
                        'value' => is_array($value) ? implode(',', $value) : $value
                    ]);
                }
            }
        }
    }
}
?>
