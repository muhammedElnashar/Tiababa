<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Live extends Home_Controller {

    public function __construct()
    {
        parent::__construct();
    }


    public function zoom($type='', $id)
    {
        $data = array();
        if ($type == 'patient') {
            $data['leave_url'] = base_url('admin/patients/appointments');  
        } else {
            $data['leave_url'] = base_url('admin/live_consults?cancel='.$id);
            $edit_data = array(
                'is_start' => 1
            );
            if ($id != 0) {
                $this->admin_model->edit_option($edit_data, $id, 'appointments');
            }
        }
        
        $data['page_title'] = 'Zoom Meeting';      
        $data['page'] = 'Live';
        $data['appointment'] = $this->admin_model->get_by_id($id, 'appointments');
        $data['patient'] = $this->admin_model->get_by_id($data['appointment']->patient_id, 'patientses');
        $data['user'] = $this->admin_model->get_by_id($data['appointment']->user_id, 'users');
        $data['main_content'] = $this->load->view('admin/user/zoom',$data);
    }


    public function add_meeting($id=""){

        $zoom = $this->admin_model->get('settings');
        $appointment = $this->db->get_where('appointments',['id'=>$id])->row();
        $time = explode('-', $appointment->time);
        $date = date('Y-m-d');

        if(count($time) && $appointment->date != null ){
            $time1 = $time[0];
            $time2 = $time[1];
        }

        $start_time = $date.' '.$time1;

        $agenda = 'patient meeting';
        $duration = 60;
        $password = mt_rand(1111,9999);;

        $fields = array(
            'agenda'=>$agenda,
            'default_password'=>false,
            'duration'=>$duration, //minutes
            'password'=> $password,
            'start_time'=>$start_time,
            'waiting_room'=>true
        );

        $result = $this->zoom->get_meeting($zoom->zoom_account_id, $zoom->zoom_client_id, $zoom->zoom_client_secret, $fields);

        $result = json_decode($result);

        $patients['attendees'] = array(
            0 => array('name'=>'Patient')
        );

        $invitation = $this->zoom->send_invitation($zoom->zoom_account_id, $zoom->zoom_client_id, $zoom->zoom_client_secret,$result->id, $patients);
        $host_url = $result->start_url;
        $join_url = null;

        if(isset($invitation->attendees)){
            $join_url = $invitation->attendees[0]->join_url;
        }


        $this->db->where('id',$id);
        $this->db->update('appointments',['join_url'=>$join_url,'host_url'=>$host_url,'zoom_password'=>$password]);

        $this->session->set_flashdata('msg','Meeting added successfully'); 
        redirect($_SERVER['HTTP_REFERER']);

    }



    public function zooms($id){
       
        $edit_data = array(
            'is_start' => 1
        );
        if ($id != 0) {
            $this->admin_model->edit_option($edit_data, $id, 'appointments');
        }
        redirect($_SERVER['HTTP_REFERER']);
        
    }


    public function meet($type='', $id){
       
        $edit_data = array(
            'is_start' => 1
        );
        if ($id != 0) {
            $this->admin_model->edit_option($edit_data, $id, 'appointments');
        }
        redirect(base_url('admin/live_consults'));
        
    }



    public function cancel_meeting($id)
    {
        $edit_data = array(
            'is_start' => 0
        );
        if ($id != 0) {
            $this->admin_model->edit_option($edit_data, $id, 'appointments');
        }
        $this->session->set_flashdata('msg', trans('meeting-canceled-successfully')); 
        redirect($_SERVER['HTTP_REFERER']);
    }



}
	

