<?php

class Notifications_model extends CI_Model
{

    function get($user_id, $quantity = null)
    {
        $this->db->where('user_id', $user_id);
        $this->db->where('status', "unread");
        $this->db->order_by('id', 'DESC');
        if ($quantity != null) {
            $this->db->limit($quantity);
        }
        return $this->db->get('notifications')->result();
    }

    function get_all($user_id)
    {
        $this->db->where('user_id', $user_id);
        $this->db->order_by('id', 'DESC');
        $this->db->where('status !=', "deleted");
        return $this->db->get('notifications')->result();
    }

    function createFakeNotifications($user_id,$quantity) {
        for($i = 0; $i < $quantity; $i++) {
            $this->db->insert('notifications', array(
                'user_id' => $user_id,
                'title' => 'Notificação de teste',
                'description' => 'Esta é uma notificação de teste',
                'status' => 'unread',
                'created_at' => date('Y-m-d H:i:s')
            )
            );
        }
      
    }

    function update($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('notifications', $data);
    }

    function delete($id)
    {
        $this->db->where('id', $id);
        return $this->db->update('notifications', array('status' => 'deleted'));
    }

    function markAllAsRead($user_id)
    {
        $this->db->where('user_id', $user_id);
        $this->db->where('status', "unread");
        return $this->db->update('notifications', array('status' => 'read'));
    }

}
?>