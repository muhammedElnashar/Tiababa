<?php 


class site_model extends CI_model {
    
    function get_data(){
        
        $this->db->get('servicess');
        return $query->result();
    }
}


?>