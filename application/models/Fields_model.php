<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Fields_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }



    public function getCategories() {
        $this->db->select('*');
        $this->db->from('custom_fields_categories');
        $this->db->where('deleted_at', NULL);
        $query = $this->db->get();
        return $query->result();
    }


    public function createCategory($data) {
        $this->db->insert('custom_fields_categories', $data);
        return $this->db->insert_id();
    }


    public function deleteCategory($id) {
        $this->db->where('id', $id);
        $this->db->update('custom_fields_categories', array('deleted_at' => date('Y-m-d H:i:s')));
        return $this->db->affected_rows();
    }


    public function getCategory($id) {
        $this->db->select('*');
        $this->db->from('custom_fields_categories');
        $this->db->where('id', $id);
        $query = $this->db->get();
        return $query->row();
    }

    public function updateCategory($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('custom_fields_categories', $data);
        return $this->db->affected_rows();
    }


    public function createCustomField($data) {
        $this->db->insert('custom_fields', $data);
        return $this->db->insert_id();
    }

    public function getCustomField($id) {
        $this->db->select('*');
        $this->db->from('custom_fields');
        $this->db->where('id', $id);
        $query = $this->db->get();
        return $query->row();
    }

    public function getCustomFields($categoryId){
        $this->db->select('*');
        $this->db->where('category_id', $categoryId);
        $this->db->from('custom_fields');
        $this->db->where('deleted_at', NULL);
        $query = $this->db->get();
        return $query->result();
    }

    public function getCustomFieldsValues($categoryId, $reference)
    {
        $query = $this->db->query("
            SELECT cfv.*, cfc.name AS category_name, cfc.display AS category_display, cf.*
            FROM custom_fields_values AS cfv
            JOIN custom_fields_categories AS cfc ON cfv.category_id = ".$categoryId."
            JOIN custom_fields AS cf ON cfv.custom_field_id = cf.id
            WHERE cfv.reference = '" . $this->db->escape_str($reference) . "'
        ");
    
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            $emptyValueQuery = $this->db->query("
                SELECT cf.*, cfc.name AS category_name, cfc.display AS category_display
                FROM custom_fields_categories AS cfc
                JOIN custom_fields AS cf ON cf.category_id = ".$categoryId."
                WHERE cfc.id = ".$categoryId."
            ");
    
            if ($emptyValueQuery->num_rows() > 0) {
                $result = $emptyValueQuery->result();
    
                foreach ($result as &$row) {
                    $row->value = ''; // Define o campo "value" como vazio
                }

    
                return $result;
            } else {
                return false;
            }
        }
    }
    

    public function updateCustomField($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('custom_fields', $data);
        return $this->db->affected_rows();
    }


    public function getCustomFieldsByCategoryId($category_id){
        $this->db->select('*');
        $this->db->from('custom_fields');
        $this->db->where('category_id', $category_id);
        $this->db->where('deleted_at', NULL);
        $query = $this->db->get();
        return $query->result();
    }

    public function getCustomFieldsByCategoryName($category_name){
        $this->db->select('*');
        $this->db->from('custom_fields');
        $this->db->where('category_name', $category_name);
        $this->db->where('deleted_at', NULL);
        $query = $this->db->get();
        return $query->result();
    }


    public function deleteCustomField($id) {
        $this->db->where('id', $id);
        $this->db->update('custom_fields', array('deleted_at' => date('Y-m-d H:i:s')));
        return $this->db->affected_rows();
    }


   



   


}