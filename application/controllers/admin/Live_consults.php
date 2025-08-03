<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Live_consults extends Home_Controller {

    public function __construct()
    {
        parent::__construct();
        //check auth
        if (!is_staff() && !is_user()) {
            redirect(base_url());
        }
        $this->load->library('zoom/zoom');
    }


    public function index()
    {

        if (is_staff()) {
            if (check_staff_permissions('consultation') != 1 ) {
                redirect(base_url('admin/dashboard/user'));
            }
            
        }

        if (isset($_GET) && $_GET['cancel'] != '') {
            $edit_data = array(
                'is_start' => 0
            );
            $this->admin_model->edit_option($edit_data, $_GET['cancel'], 'appointments');
        }
        
        $data = array();
        $data['page_title'] = 'Consultations';      
        $data['page'] = 'Live consults';   
        $data['consult'] = FALSE;
        $data['appointments'] = $this->admin_model->get_appointments(user()->id);
        $data['patients'] = $this->admin_model->select_by_chamber('patientses');
        $data['main_content'] = $this->load->view('admin/user/live_consults',$data,TRUE);
        $this->load->view('admin/index',$data);
    }


   
    public function edit($id)
    {  
        if ($_POST) {
            $data=array(
                'date' => $this->input->post('date', true),
                'time' => $this->input->post('time', true),
                'meeting_notes' => $this->input->post('meeting_notes')
            );
            $this->admin_model->edit_option($data, $id, 'appointments');
            $this->session->set_flashdata('msg', trans('updated-successfully')); 
            redirect(base_url('admin/live_consults'));
        }
        $data = array();
        $data['page_title'] = 'Edit';   
        $data['consult'] = $this->admin_model->select_option($id, 'appointments');
        $data['patients'] = $this->admin_model->select_by_chamber('patientses');
        $data['main_content'] = $this->load->view('admin/user/live_consults',$data,TRUE);
        $this->load->view('admin/index',$data);
    }



    public function settings()
    {  
        if (is_staff()) {
            if (check_staff_permissions('consultation-settings') != 1 ) {
                redirect(base_url('admin/dashboard/user'));
            }
            
        }

        $data = array();
        $data['page_title'] = 'Consultation Settings';        
        $data['upage'] = 'User Settings';   
        $data['main_content'] = $this->load->view('admin/user/evisit_settings',$data,TRUE);
        $this->load->view('admin/index',$data);
    }


    public function evisit_settings() 
    {

        if (get_user_info() == FALSE) {
            $price = 0;
        }else{
            $price =  $this->input->post('price', true);
        }

        $id = $this->input->post('settings_id', true);
        $data = array(
            'zoom_meeting_id' => 0,
            'zoom_meeting_password' => 0,
            'user_id' => user()->id,
            'price' =>$price,
            'invitation_link' => '',
            'meet_invitation_link' => $this->input->post('meet_invitation_link', true),
            'meet_type' => $this->input->post('meet_type'),
            'allow_user' => 1,
            'status' => $this->input->post('status', true)
        );
        $data = $this->security->xss_clean($data);
        if ($id != 0) {
            $this->admin_model->edit_option($data, $id, 'evisit_settings');
            $this->session->set_flashdata('msg', trans('updated-successfully')); 
        } else {
            $id = $this->admin_model->insert($data, 'evisit_settings');
            $this->session->set_flashdata('msg', trans('inserted-successfully')); 
        }
        redirect(base_url('admin/live_consults/settings'));
    }


    public function add_meeting($id=""){

        $zoom = $this->admin_model->get('settings');
        $appointment = $this->db->get_where('appointments',['id'=>$id])->row();
        $patient = $this->db->get_where('patientses',['id'=>$appointment->patient_id])->row();
        $user = $this->db->get_where('users',['id'=>$appointment->user_id])->row();


        $time = explode('-', $appointment->time);
        $date = date('Y-m-d');

        if(count($time) && $appointment->date != null ){
            $time1 = $time[0];
            $time2 = $time[1];
        }

        $start_time = $date.' '.$time1;

        $agenda = 'Zoom Meeting Consultation';
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
            0 => array('name'=> $patient->name)
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
        if ($user->enable_sms_notify == 1) {
            $message_to_patient = trans('meeting-for-the-booked-appointment').' of '.$user->name.' '.trans('has-added-at').' '.$appointment->date.' '.$appointment->time.' '.trans('join-url').' '.$join_url;
            $this->sms_model->send_user($patient->mobile, $message_to_patient, $user->id); 
        }

        if ($user->enable_whatsapp_msg == 1) {
            $message_to_patient = trans('meeting-for-the-booked-appointment').' of '.$user->name.' '.trans('has-added-at').' '.$appointment->date.' '.$appointment->time.' '.trans('join-url').' '.$join_url;
            $this->sms_model->send_whatsapp_user($patient->mobile, $message_to_patient, $user->ultramsg_instance_id, $user->ultramsg_token); 
        } 
        redirect(base_url('admin/live_consults'));

    }

    
    public function status_operation($status, $id) 
    {
        $data = array(
            'status' => $status
        );
        $data = $this->security->xss_clean($data);
        $this->admin_model->update($data, $id,'appointments');
        $this->session->set_flashdata('msg', trans('updated-successfully')); 
        redirect(base_url('admin/live_consults'));
    }


    public function delete($id)
    {
        $this->admin_model->delete($id,'appointments'); 
        echo json_encode(array('st' => 1));
    }

}
	

