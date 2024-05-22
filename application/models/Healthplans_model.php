<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Healthplans_model extends MY_Model
{

    public $table = 'healthplans';
    public $primary_key = 'id';
    public $timestamps = TRUE;
    public $soft_deletes = TRUE;
    public $protected = array('id');

    public $rules = array(
        'insert' => array(
            'username' => array(
                'field' => 'pacient_id',
                'label' => 'Paciente',
                'rules' => 'trim|required',
                'errors' => array(
                    'required' => 'É preciso informar o paciente',
                )
            ),
            'name' => array(
                'field' => 'name',
                'label' => 'Nome',
                'rules' => 'trim|required',
                'errors' => array(
                    'required' => 'É preciso informar o nome do plano de saúde',
                )
            ),
            'phone' => array(
                'field' => 'phone',
                'label' => 'Telefone',
                'rules' => 'trim|required',
                'errors' => array(
                    'required' => 'É preciso informar o telefone do plano de saúde',
                )
            ),
            'coverage' => array(
                'field' => 'coverage',
                'label' => 'Cobertura',
                'rules' => 'trim|required',
                'errors' => array(
                    'required' => 'É preciso informar a cobertura do plano de saúde',
                )
            ),
            'identification' => array(
                'field' => 'identification',
                'label' => 'Número de identificação',
                'rules' => 'trim|required',
                'errors' => array(
                    'required' => 'É preciso informar o número de identificação do plano de saúde do paciente',
                )
            ),
        ),
        'update' => array(
            'id' => array(
                'field' => 'id',
                'label' => 'ID',
                'rules' => 'trim|is_natural_no_zero|required'
            )
        )
    );

    function __construct()
    {

        $this->has_one['pacient'] = array('Pacient_model', 'id', 'pacient_id');

        parent::__construct();
    }

    public function getRules()
    {
        return $this->rules;
    }

}