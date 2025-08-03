<?php


class DefaultValues_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    // دالة لتحديث القيم الافتراضية
    public function update_default_values($data) {
        // التحقق مما إذا كان هناك سجل موجود بالفعل
        $query = $this->db->get_where('default_values', ['user_id' => user()->id]);

        if ($query->num_rows() > 0) {
            // إذا كان السجل موجودًا، يتم تحديثه
            $this->db->where('user_id', user()->id);
            return $this->db->update('default_values', $data);
        } else {
            // إذا لم يكن السجل موجودًا، يتم إدخاله كقيمة جديدة
            return $this->db->insert('default_values', $data);
        }
    }


    // دالة للحصول على القيم الافتراضية
    public function get_default_values() {
        if ($this->session->userdata('role') == 'user' || $this->session->userdata('role') == 'admin') {
            $user_id = $this->session->userdata('id');
        }else{
            $user_id = $this->session->userdata('parent');
        }
        return $this->db->where("user_id",$user_id)->get('default_values')->row();
    }
}



?>