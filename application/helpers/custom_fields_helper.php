<?php

defined('BASEPATH') OR exit('No direct script access allowed');

if (!function_exists('generate_form')) {
    function generate_form($fields, $formData = array()) {

   
        $CI = &get_instance();
        $CI->load->helper('form');
        $CI->load->library('form_validation');
        
        $output = '';
        $stepSize = 5;
        $fieldCount = 0;

        
        
        foreach ($fields as $name => $field) {
            $label = $field['display'];
            $type = $field['type'];
            $validations = isset($field['validations']) ? $field['validations'] : '';
            
            if ($fieldCount % $stepSize === 0) {
                if ($fieldCount > 0) {
                    $output .= '</div>'; // Close previous step
                }
                $output .= '<div class="step">';
            }
            
            $output .= '<div class="form-group">';
            $output .= '<label for="'.$name.'">'.$label.'</label>';
            
            switch ($type) {
                case 'multiselect':
                    $options = $field['options'] ?? array();
                    $output .= '<select name="'.$name.'" multiple data-role="tagsinput">';
                    foreach ($options as $value => $option) {
                        $output .= '<option value="'.$value.'"';
                        if (isset($formData[$name]) && in_array($value, $formData[$name])) {
                            $output .= ' selected';
                        }
                        $output .= '>'.$option.'</option>';
                    }
                    $output .= '</select>';
                    break;
                case 'text':
                    $output .= form_input(array('name' => $name, 'class' => 'form-control', 'id' => $name, 'value' => isset($formData[$name]) ? $formData[$name] : ''));
                    break;
                case 'option':
                    $options = array();
                    foreach ($field['options'] as $option) {
                        $options[$option['value']] = $option['label'];
                    }
                    $output .= form_dropdown($name, $options, isset($formData[$name]) ? $formData[$name] : '', 'class="form-control" id="'.$name.'"');
                    break;
                case 'radio' :
                    $options = array();
                    foreach ($field['options'] as $option) {
                        $options[$option['value']] = $option['label'];
                    }
                    $output .= form_radio($name, $options, isset($formData[$name]) ? $formData[$name] : '', 'class="form-control" id="'.$name.'"');
                    break;
                case 'checkbox' :
                    $options = array();
                    foreach ($field['options'] as $option) {
                        $options[$option['value']] = $option['label'];
                    }
                    $output .= form_checkbox($name, $options, isset($formData[$name]) ? $formData[$name] : '', 'class="form-control" id="'.$name.'"');
                    break;  
                case 'textarea':
                    $output .= form_textarea(array('name' => $name, 'class' => 'form-control', 'id' => $name, 'value' => isset($formData[$name]) ? $formData[$name] : ''));
                    break;
                case 'date':
                    $output .= form_input(array('name' => $name, 'class' => 'form-control datepicker', 'id' => $name, 'value' => isset($formData[$name]) ? $formData[$name] : ''));
                    break;
                case 'datetime':
                    $output .= form_input(array('name' => $name, 'class' => 'form-control datetimepicker', 'id' => $name, 'value' => isset($formData[$name]) ? $formData[$name] : ''));
                    break;
                case 'file':
                    $output .= form_upload(array('name' => $name, 'class' => 'form-control', 'id' => $name));
                    break;
                default:
                    // Handle unsupported field types
                    $output .= 'Unsupported field type: '.$type;
                    break;
            }
            
            $output .= '</div>';
            
            $fieldCount++;
            
            // Apply validations
            if (!empty($validations)) {
                $CI->form_validation->set_rules($name, $label, $validations);
            }
        }
        
        if ($fieldCount > 0) {
            $output .= '</div>'; // Close last step
        }
        
        $output .= '<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>';

        
        return $output;
    }
    
   
}function generateForm($subject, $formData, $fields, $categoryId, $reference) {
    $output = '<div class="card">';
    $output .= '<div class="card-body">';
    $output .= '<div class="border p-3 rounded">';
    $output .= '<h6>'.$subject.'</h6>';
    $output .= '<hr>';

    $stepSize = 5; // Tamanho do grupo de campos por etapa
    $numFields = count($fields);
    $numSteps = ceil($numFields / $stepSize);

    $output .= '<div class="step-info">';
    $output .= '<span id="currentStep">Passo 1</span> de '.$numSteps;
    $output .= '</div>';

    for ($step = 1; $step <= $numSteps; $step++) {
        $output .= '<div class="step" id="step'.$step.'"'.($step > 1 ? ' style="display: none;"' : '').'>';
        $startIdx = ($step - 1) * $stepSize;
        $endIdx = min($startIdx + $stepSize - 1, $numFields - 1);

        $output .= '<form class="step-form" id="customFieldForm'.$step.'" enctype="multipart/form-data">';
        $output .= '<input type="hidden" name="reference" value="'.$reference.'">';
        $output .= '<input type="hidden" name="category_id" value="'.$categoryId.'">';
        for ($i = $startIdx; $i <= $endIdx; $i++) {
            $output .= generate_form_field($fields[$i], $formData);
        }
        $output .= '</form>';

        $output .= '<div class="step-buttons">';
        if ($step > 1) {
            $output .= '<button type="button" class="btn btn-secondary prev-step">Anterior</button>';
        }
        if ($step < $numSteps) {
            $output .= '<button type="button" class="btn btn-primary next-step">Próximo</button>';
        } else {
            $output .= '<button type="button" class="btn btn-primary" id="submitCustomField">Salvar</button>';
        }
        $output .= '</div>';

        $output .= '</div>';
    }

    $output .= '</div>';
    $output .= '</div>';
    $output .= '</div>';

    $output .= '<script>';
    $output .= 'function showStep(step) {';
    $output .= '    $(".step").hide();';
    $output .= '    $("#step"+step).show();';
    $output .= '    $("#currentStep").text("Passo "+step);';
    $output .= '}';
    $output .= 'function validateStep(step) {';
    $output .= '    var form = document.getElementById("customFieldForm"+step);';
    $output .= '    if (form.checkValidity()) {';
    $output .= '        return true;';
    $output .= '    } else {';
    $output .= '        $(form).addClass("was-validated");';
    $output .= '        return false;';
    $output .= '    }';
    $output .= '}';
    $output .= 'function ajax(url, data, type, redirect) {';
    $output .= '    var xhr = new XMLHttpRequest();';
    $output .= '    xhr.open(type, url);';
    $output .= '    xhr.onload = function() {';
    $output .= '        if (xhr.status === 200) {';
    $output .= '            var response = JSON.parse(xhr.responseText);';
    $output .= '            swal("Sucesso!", response.message, "success").then(() => {';
    $output .= '                parent.location.reload();';
    $output .= '            });';
    $output .= '        } else {';
    $output .= '            swal("Erro!", "Não foi possível salvar o campo personalizado.", "error");';
    $output .= '        }';
    $output .= '    };';
    $output .= '    xhr.onerror = function() {';
    $output .= '        swal("Erro!", "Não foi possível salvar o campo personalizado.", "error");';
    $output .= '    };';
    $output .= '    xhr.send(data);';
    $output .= '}';
    $output .= '$(document).ready(function() {';
    $output .= '    var currentStep = 1;';
    $output .= '    showStep(currentStep);';
    $output .= '    $(".next-step").click(function() {';
    $output .= '        if (validateStep(currentStep)) {';
    $output .= '            currentStep++;';
    $output .= '            showStep(currentStep);';
    $output .= '        }';
    $output .= '    });';
    $output .= '    $(".prev-step").click(function() {';
    $output .= '        currentStep--;';
    $output .= '        showStep(currentStep);';
    $output .= '    });';
    $output .= '    $("#submitCustomField").click(function() {';
    $output .= '        if (validateStep('.$numSteps.')) {';
    $output .= '            var form = document.getElementById("customFieldForm'.$numSteps.'");';
    $output .= '            var formData = new FormData(form);';
    $output .= '            var url = "'.base_url('customfields/saveForm').'";';
    $output .= '            var redirect = "'.base_url('fields').'";';
    $output .= '            var data = formData;';
    $output .= '            var type = "POST";';
    $output .= '            ajax(url, data, type, redirect);';
    $output .= '        }';
    $output .= '    });';
    $output .= '    $(".datepicker").datepicker();';
    $output .= '    $(".datetimepicker").datetimepicker();';
    $output .= '});';
    $output .= '</script>';

    return $output;
}


 function uploadFile($name){
    $CI = &get_instance();
    $CI->load->library('upload');
    $config['upload_path'] = './uploads/';
    $config['allowed_types'] = '*';
  
    $CI->upload->initialize($config);
    if (!$CI->upload->do_upload($name)) {
        $error = array('error' => $CI->upload->display_errors());
        return $error;
    } else {
        $data = array('upload_data' => $CI->upload->data());
        return $data;
    }
 }function generate_form_field($field, $formData) {
    $field->display = ucfirst($field->display);

    $required = ($field->required == 1 || $field->required == true) ? 'required' : '';

    switch ($field->type) {
        case 'text':
            $output = '<div class="form-group">';
            $output .= '<label for="'.$field->name.'#'.$field->id.'">'.$field->display.'</label>';
            $output .= '<input type="text" class="form-control" id="'.$field->name.'#'.$field->id.'" name="'.$field->name.'#'.$field->id.'" placeholder="'.$field->display.'" value="'.$field->value.'" '.$required.'>';
            $output .= '</div>';
            return $output;
        case 'textarea':
            $output = '<div class="form-group">';
            $output .= '<label for="'.$field->name.'#'.$field->id.'">'.$field->display.'</label>';
            $output .= '<textarea class="form-control" id="'.$field->name.'#'.$field->id.'" name="'.$field->name.'#'.$field->id.'" placeholder="'.$field->display.'" '.$required.'>'.$field->value.'</textarea>';
            $output .= '</div>';
            return $output;
        case 'select':
            $output = '<div class="form-group">';
            $output .= '<label for="'.$field->name.'#'.$field->id.'">'.$field->display.'</label>';
            $output .= '<select class="form-control" id="'.$field->name.'#'.$field->id.'" name="'.$field->name.'#'.$field->id.'" '.$required.'>';
            $output .= '<option value="">Selecione</option>';
            $options = explode(',', $field->options);
            foreach($options as $option) {
                $output .= '<option value="'.$option.'"';
                if ($field->value == $option) {
                    $output .= ' selected';
                }
                $output .= '>'.$option.'</option>';
            }
            $output .= '</select>';
            $output .= '</div>';
            return $output;
        case 'radio':
            $output = '<div class="form-group">';
            $output .= '<label for="'.$field->name.'#'.$field->id.'">'.$field->display.'</label>';
            $output .= '<div class="form-check">';
            
            $options = explode(',', $field->options);
            foreach($options as $option) {
                $output .= '<div class="form-check-inline">';
                $output .= '<input class="form-check-input" type="radio" name="'.$field->name.'#'.$field->id.'" id="'.$field->name.'#'.$field->id.'" value="'.$option.'"';
                
                if ($field->value == $option) {
                    $output .= ' checked';
                }
                
                $output .= ' '.$required.'>';
                $output .= '<label class="form-check-label" for="'.$field->name.'#'.$field->id.'">'.$option.'</label>&nbsp;&nbsp;&nbsp;';
                $output .= '</div>';
            }
            
            $output .= '</div>';
            $output .= '</div>';
            return $output;
        case 'checkbox':
            $output = '<div class="form-group">';
            $output .= '<label for="'.$field->name.'#'.$field->id.'">'.$field->display.'</label>';
            $output .= '<div class="form-check">';
            $options = explode(',', $field->options);
            foreach($options as $option) {
                $output .= '<input class="form-check-input" type="checkbox" name="'.$field->name.'#'.$field->id.'" id="'.$field->name.'#'.$field->id.'" value="'.$option.'"';
                if (in_array($option, explode(',', $field->value))) {
                    $output .= ' checked';
                }
                $output .= ' '.$required.'>';
                $output .= '<label class="form-check-label" for="'.$field->name.'#'.$field->id.'">'.$option.'</label><br>';
            }
            $output .= '</div>';
            $output .= '</div>';
            return $output;
        case 'date':
            $output = '<div class="form-group">';
            $output .= '<label for="'.$field->name.'#'.$field->id.'">'.$field->display.'</label>';
            $output .= '<input type="date" class="form-control" id="'.$field->name.'#'.$field->id.'" name="'.$field->name.'#'.$field->id.'" placeholder="'.$field->display.'" value="'.$field->value.'" '.$required.'>';
            $output .= '</div>';
            return $output;
        case 'datetime':
            $output = '<div class="form-group">';
            $output .= '<label for="'.$field->name.'#'.$field->id.'">'.$field->display.'</label>';
            $output .= '<input type="datetime-local" class="form-control" id="'.$field->name.'#'.$field->id.'" name="'.$field->name.'#'.$field->id.'" placeholder="'.$field->display.'" value="'.$field->value.'" '.$required.'>';
            $output .= '</div>';
            return $output;
        case 'file':
            $output = '<div class="form-group">';
            $output .= '<label for="'.$field->name.'#'.$field->id.'">'.$field->display.'</label>';
            $output .= '<input type="file" class="form-control" id="'.$field->name.'#'.$field->id.'" name="'.$field->name.'#'.$field->id.'" placeholder="'.$field->display.'" value="'.$field->value.'" '.$required.'>';
            $output .= '</div>';
            return $output;
        case 'multiselect':
            $output = '<div class="form-group">';
            $output .= '<label for="'.$field->name.'#'.$field->id.'">'.$field->display.'</label>';
            $output .= '<select class="form-control" id="'.$field->name.'#'.$field->id.'" name="'.$field->name.'#'.$field->id.'" multiple '.$required.'>';
            $output .= '<option value="">Selecione</option>';
            $options = explode(',', $field->options);
            foreach($options as $option) {
                $output .= '<option value="'.$option.'"';
                if (in_array($option, explode(',', $field->value))) {
                    $output .= ' selected';
                }
                $output .= '>'.$option.'</option>';
            }
            $output .= '</select>';
            $output .= '</div>';
            return $output;
        case 'hidden':
            $output = '<input type="hidden" name="'.$field->name.'#'.$field->id.'" value="'.$field->value.'">';
            return $output;
        case 'password':
            $output = '<div class="form-group">';
            $output .= '<label for="'.$field->name.'#'.$field->id.'">'.$field->display.'</label>';
            $output .= '<input type="password" class="form-control" id="'.$field->name.'#'.$field->id.'" name="'.$field->name.'#'.$field->id.'" placeholder="'.$field->display.'" '.$required.'>';
            $output .= '</div>';
            return $output;
        case 'email':
            $output = '<div class="form-group">';
            $output .= '<label for="'.$field->name.'#'.$field->id.'">'.$field->display.'</label>';
            $output .= '<input type="email" class="form-control" id="'.$field->name.'#'.$field->id.'" name="'.$field->name.'#'.$field->id.'" placeholder="'.$field->display.'" value="'.$field->value.'" '.$required.'>';
            $output .= '</div>';
            return $output;
        default:
            return '';
    }
}



function getViewTable($reference, $categoryId) {

    $CI = &get_instance();

    $CI->db->where('reference', $reference);
    $CI->db->where('category_id', $categoryId);
    $customFields = $CI->db->get('custom_fields_values')->result();

    $category = $CI->db->get_where('custom_fields_categories', array('id' => $categoryId))->row();


 
    echo '<div class="table-responsive">';
    echo '<table class="table table-striped table-bordered">';
    echo '<thead>';
    echo '<tr>';

   
    echo '</tr>';
    echo '</thead>';
    echo '<tbody>';

    foreach($customFields as $customField) {
        $customFieldDTO = $CI->db->get_where('custom_fields', array('id' => $customField->custom_field_id))->row();
        $customField->display = $customFieldDTO->display;
        echo '<tr>';
        echo '<td>'.$customField->display.'</td>';
        if($customFieldDTO->type == 'file') {
            echo '<td><a href="'.base_url('uploads/'.$customField->value).'" target="_blank">'.$customField->value.'</a></td>';
        } elseif ($customFieldDTO->type == 'multiselect' || $customFieldDTO->type == 'checkbox') {
            $options = explode(',', $customFieldDTO->options);
            $values = explode(',', $customField->value);
            $value = '';
            foreach($values as $val) {
                foreach($options as $option) {
                    if($option == $val) {
                        $value .= $option . ', ';
                    }
                }
            }
            echo '<td>'.substr($value, 0, -2).'</td>';
        } else {
            echo '<td>'.$customField->value.'</td>';
        }

        if($customFieldDTO->type == 'date') {
            echo '<td>'.date('d/m/Y', strtotime($customField->created_at)).'</td>';
        } else {
            echo '<td>'.$customField->created_at.'</td>';
        }

        echo '<td></td>';
        echo '</tr>';
    }
    
    echo '</tbody>';
    echo '</table>';
    echo '</div>';

}


function getViewTableMany($reference, $categoryId) {

    $CI = &get_instance();

    $CI->db->where('reference', $reference);
    $CI->db->where('category_id', $categoryId);
    $customFields = $CI->db->get('custom_fields_values')->result();

    $categories = $CI->db->get_where('custom_fields_categories', array('id' => $categoryId));

   

    echo '<div class="table-responsive">';
    echo '<table class="table table-striped table-bordered">';
    echo '<thead>';
    echo '<tr>';

   
    echo '</tr>';
    echo '</thead>';
    echo '<tbody>';


    foreach($customFields as $customField) {
        $customFieldDTO = $CI->db->get_where('custom_fields', array('id' => $customField->custom_field_id))->row();
        $customField->display = $customFieldDTO->display;
        echo '<tr>';
   
        echo '<td>'.$customField->display.'</td>';
        echo '<td>'.$customField->value.'</td>';
        echo '<td>';

        echo '</td>';
        echo '</tr>';
    }

    echo '</tbody>';
    echo '</table>';
    echo '</div>';

}