<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Service_model extends CI_Model {

    // دالة لاسترجاع جميع الخدمات
    public function get_all_services() {
        if ($this->session->userdata('role') == 'user'|| $this->session->userdata('role') == 'admin') {
            $user_id = $this->session->userdata('id');
        }else{
            $user_id = $this->session->userdata('parent');
        }
        $query = $this->db->where('user_id',$user_id)
            ->get('servicess');
        return $query->result();
    }

    // دالة لإضافة خدمة جديدة
    public function add_service($data) {
        return $this->db->insert('servicess', $data);
    }

    // دالة لحذف خدمة
    public function delete_service($id) {
        $this->db->where('id', $id);
        $this->db->delete('servicess');
    }

    // دالة لاسترجاع خدمة بواسطة ID
    public function get_service_by_id($id) {
        $query = $this->db->get_where('servicess', array('id' => $id));
        return $query->row();
    }

    // دالة لتحديث خدمة
    public function update_service($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update('servicess', $data);
    }
}
