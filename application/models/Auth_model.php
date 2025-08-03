<?php
class Auth_model extends CI_Model {

    public function edit_option_md5($action, $id, $table)
    {
        $this->db->where('md5(id)',$id);
        $this->db->update($table,$action);
        return;
    }


    //is logged in
    public function is_logged_in()
    {
        //check if user logged in
        if ($this->session->userdata('logged_in') == TRUE && !empty($this->get_user($this->session->userdata('id')))) {
            return true;
        } else {
            return false;
        }
    }

    //is logged in
    public function is_logged_staff()
    {
        //check if user logged in
        if ($this->session->userdata('logged_in') == TRUE && !empty($this->get_staff($this->session->userdata('id')))) {
            return true;
        } else {
            return false;
        }
    }

    //is logged in
    public function is_logged_patient()
    {
        //check if user logged in
        if ($this->session->userdata('logged_in') == TRUE && !empty($this->get_patient($this->session->userdata('id')))) {
            return true;
        } else {
            return false;
        }
    }


    //function get user
    public function get_logged_user()
    {   
        if ($this->session->userdata('role') == 'staff') {
            if ($this->is_logged_staff()) {
                $this->db->where('id', $this->session->userdata('id'));
                $query = $this->db->get('staffs');
                return $query->row();
            }
        }elseif ($this->session->userdata('role') == 'patient') {
            if ($this->is_logged_patient()) {
                $this->db->where('id', $this->session->userdata('id'));
                $query = $this->db->get('patientses');
                return $query->row();
            }
        } else {
            if ($this->is_logged_in()) {
                $this->db->where('id', $this->session->userdata('id'));
                $query = $this->db->get('users');
                return $query->row();
            }
        }
    }

    //get user by id
    public function get_user($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->get('users');
        return $query->row();
    }

    //get user by id
    public function get_staff($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->get('staffs');
        return $query->row();
    }

    //get user by id
    public function get_patient($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->get('patientses');
        return $query->row();
    }

    //is admin
    public function is_admin()
    {
        //get_header_info();
        //check logged in
        if (!$this->is_logged_in()) {
            return false;
        }

        //check role
        if (user()->role == 'admin') {
            return true;
        } else {
            return false;
        }
    }

    //is user
    public function is_user()
    {   
        //get_header_info();
        //check logged in
        if (!$this->is_logged_in()) {
            return false;
        }

        //check role
        if (user()->role == 'user') {
            return true;
        } else {
            return false;
        }
    }


    //is staff
    public function is_staff()
    {   
        //get_header_info();
        //check logged in
        if (!$this->is_logged_staff()) {
            return false;
        }

        //check role
        if (user()->role == 'staff') {
            return true;
        } else {
            return false;
        }
    }


    //is staff
    public function is_patient()
    {   
        //get_header_info();
        //check logged in
        if (!$this->is_logged_patient()) {
            return false;
        }

        //check role
        if (user()->role == 'patient') {
            return true;
        } else {
            return false;
        }
    }



    //is pro user
    public function is_pro_user()
    {
        //check logged in
        if (!$this->is_logged_in()) {
            return false;
        }

        //check role
        if (user()->role == 'user' && user()->account_type == 'pro') {
            return true;
        } else {
            return false;
        }
    }



    //logout
    public function logout()
    {
        //unset user data
        $this->session->unset_userdata('logged_in');
        $this->session->unset_userdata('admin_logged_in');
        $this->session->unset_userdata('app_key');
    }

    // check post email
    public function check_email($email)
    {
        $this->db->select('*');
        $this->db->from('users');
        $this->db->where('email', $email); 
        $this->db->limit(1);
        $query = $this->db->get();
        if($query->num_rows() == 1) {                 
            return $query->result();
        }else{
            return false;
        }
    }


    // check post email
    public function check_multiuser_email($type, $email)
    {
        $this->db->select('*');
        $this->db->from($type);
        $this->db->where('email', $email); 
        $this->db->limit(1);
        $query = $this->db->get();
        if($query->num_rows() == 1) {                 
            return $query->result();
        }else{
            return false;
        }
    }


    // check valid user by id
    public function validate_id($id)
    {
        $this->db->select('*');
        $this->db->from('users');
        $this->db->where('md5(id)', $id); 
        $this->db->limit(1);
        $query = $this->db->get();
        if($query -> num_rows() == 1)
    {                 
            return $query->row();
        }
        else{
            return false;
        }
    }



    // check valid user
    function validate_user()
    {         
        $this->db->select('*');
        $this->db->from('users');
        $this->db->where('email', $this->input->post('user_name'));
        $this->db->or_where('user_name', $this->input->post('user_name'));
        $this->db->limit(1);
        $query = $this->db->get();   
        
        if($query->num_rows() == 1)
        {                 
           return $query->row();
        }else{
            $result = $this->validate_staff();
            return $result;
        }
    }


    // check valid staff
    function validate_staff()
    {   
        $this->db->select('s.*, c.uid, c.name as chamber_name');
        $this->db->from('staffs s');
        $this->db->where('s.email', $this->input->post('user_name'));
        $this->db->join('chamber c', 'c.id = s.chamber_id', 'LEFT');
        $this->db->limit(1);
        $query = $this->db->get();   
        if($query->num_rows() > 0)
        {                 
           return $query->row();
        }
        else{
            $result = $this->validate_patient();
            return $result;
        }
    }


    // check valid patient
    function validate_patient()
    {   
        $this->db->select('p.*');
        $this->db->from('patientses p');
        $this->db->where('p.mobile', $this->input->post('user_name'));
        $this->db->or_where('p.email', $this->input->post('user_name'));
        $this->db->limit(1);
        $query = $this->db->get();   
        if($query->num_rows() > 0)
        {                 
           return $query->row();
        }
        else{
            return FALSE;
        }
    }



    public function send_email($to, $subject, $message)
    {
        $this->load->library('email');

        $settings = get_settings();

        if ($settings->mail_protocol == "mail") {
            $config = Array(
                'protocol' => 'mail',
                'smtp_host' => $settings->mail_host,
                'smtp_port' => $settings->mail_port,
                'smtp_user' => $settings->mail_username,
                'smtp_pass' => $settings->mail_password,
                'smtp_timeout' => 100,
                'mailtype' => 'html',
                'charset' => 'utf-8',
                'wordwrap' => TRUE
            );
        } else {
            $config = Array(
                'protocol' => 'smtp',
                'smtp_host' => $settings->mail_host,
                'smtp_port' => $settings->mail_port,
                'smtp_user' => $settings->mail_username,
                'smtp_pass' => $settings->mail_password,
                'smtp_timeout' => 100,
                'mailtype' => 'html',
                'charset' => 'utf-8',
                'wordwrap' => TRUE
            );
        }


        //initialize
        $this->email->initialize($config);

        //send email
        $this->email->from($settings->mail_username, $settings->application_name);
        $this->email->to($to);
        $this->email->subject($subject);
        $this->email->message($message);

        $this->email->set_newline("\r\n");

        return $this->email->send();
    }



}