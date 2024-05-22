<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pacient_model extends MY_Model
{
    public $table = 'pacients';
    public $primary_key = 'id';
    public $timestamps = TRUE;
    public $soft_deletes = TRUE;
    public $protected = array('id');


    function __construct()
    {

        $this->has_one['healthplans'] = array('Healthplans_model', 'pacient_id', 'id');
        $this->has_many['contacts'] = array('Contacts_model', 'pacient_id', 'id');
        $this->has_one['devices'] = array('Devices_model', 'pacient_id', 'id');
        $this->has_many['attendances'] = array('Attendances_model', 'pacient_id', 'id');
        parent::__construct();
    }

    public $rules = array(
        'insert' => array(
            'username' => array(
                'field' => 'username',
                'label' => 'Username',
                'rules' => 'trim|required'
            ),
            'email' => array(
                'field' => 'email',
                'label' => 'Email',
                'rules' => 'trim|valid_email|required',
                'errors' => array(
                    'required' => 'Error Message rule "required" for field email',
                    'trim' => 'Error message for rule "trim" for field email',
                    'valid_email' => 'Error message for rule "valid_email" for field email'
                )
            )
        ),
        'update' => array(
            'username' => array(
                'field' => 'username',
                'label' => 'Username',
                'rules' => 'trim|required'
            ),
            'email' => array(
                'field' => 'email',
                'label' => 'Email',
                'rules' => 'trim|valid_email|required',
                'errors' => array(
                    'required' => 'Error Message rule "required" for field email',
                    'trim' => 'Error message for rule "trim" for field email',
                    'valid_email' => 'Error message for rule "valid_email" for field email'
                )
            ),
            'id' => array(
                'field' => 'id',
                'label' => 'ID',
                'rules' => 'trim|is_natural_no_zero|required'
            )
        )
    );


    public function saveAnamnese($pacientId, $anamnese)
    {
       $this->db->where('id', $pacientId);
         return $this->db->update('pacients', array(
              'anamnese' => json_encode($anamnese),
         ));
    }

    public function deleteAnamnese($pacientId)
    {
        $this->update($pacientId, array(
            'anamnese' => null,
        ));
    }

    public function saveBodyParams($pacientId, $bodyParams)
    {
      $this->db->where('id', $pacientId);
        return $this->db->update('pacients', array(
             'bodyparams' => json_encode($bodyParams),
        ));
    }

    public function deleteBodyParams($pacientId)
    {
        $this->update($pacientId, array(
            'bodyparams' => null,
        ));
    }

    public function saveHealthPlan($pacientId, $healthPlan)
    {
        $existingHealthPlan = $this->db->get_where('healthplans', ['pacient_id' => $pacientId])->row();
    
        if ($existingHealthPlan) {
            // Health plan exists, update it
            $this->db->where('id', $existingHealthPlan->id);
            return $this->db->update('healthplans', $healthPlan);
        } else {
            // Health plan doesn't exist, create a new one
            $healthPlan['pacient_id'] = $pacientId;
            return $this->db->insert('healthplans', $healthPlan);
        }
    }
    
    public function saveEmergencyContact($pacientId, $contact)
    {
      return $this->db->insert('contacts', array(
          'pacient_id' => $pacientId,
          'name' => $contact['name'],
          'phone' => $contact['phone'],
          'kinship' => $contact['kinship'],
      ));
    }

    public function deleteContact($contactId)
    {
        $this->db->where('id', $contactId);
        return $this->db->delete('contacts');
    }


}