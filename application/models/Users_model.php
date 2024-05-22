<?php

class Users_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function get($id = null)
    {
        if ($id) {
            $this->db->where('id', $id);
        }

        $this->db->order_by('id', 'DESC');
        return $this->db->get('users')->result();
    }

    public function update($id, $data)
    {
        $this->db->where('id', $id)
            ->update('users', $data);
    }

    public function getExtraInfo($user_id)
    {
        return $this->db->where('user_id', $user_id)
            ->get('user_extra_info')
            ->result();
    }

    public function addExtraInfo($user_id, $field_name, $field_value)
    {
        $data = array(
            'user_id' => $user_id,
            'field_name' => $field_name,
            'field_value' => $field_value
        );

        return $this->db->insert('user_extra_info', $data);
    }



    public function updateExtraInfo($extra_info_id, $field_value)
    {
        $data = array(
            'field_value' => $field_value,
            'updated_at' => date('Y-m-d H:i:s')
        );

        $this->db->where('id', $extra_info_id)
            ->update('user_extra_info', $data);
    }

    public function deleteExtraInfo($extra_info_id)
    {
        $this->db->where('id', $extra_info_id)
            ->delete('user_extra_info');
    }

    public function getUserWithExtraInfo($user_id)
    {
        $user = $this->db->where('id', $user_id)
            ->get('users')
            ->row();

        if ($user) {
            $user->extra_info = $this->getExtraInfo($user_id);
        }

        return $user;
    }

    public function getUsersWithFilteredExtraInfo($fields)
    {
        $this->db->select('users.*, user_extra_info.field_name, user_extra_info.field_value');
        $this->db->from('users');
        $this->db->join('user_extra_info', 'users.id = user_extra_info.user_id');

        if (!empty($fields)) {
            $this->db->where_in('user_extra_info.field_name', $fields);
        }

        $this->db->order_by('users.id', 'DESC');
        $query = $this->db->get();

        $users = array();

        foreach ($query->result() as $row) {
            if (!isset($users[$row->id])) {
                $users[$row->id] = $row;
                $users[$row->id]->extra_info = array();
            }

            $users[$row->id]->extra_info[] = array(
                'field_name' => $row->field_name,
                'field_value' => $row->field_value
            );
        }

        return array_values($users);
    }
}