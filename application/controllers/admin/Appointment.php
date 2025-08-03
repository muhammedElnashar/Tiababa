<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Appointment extends Home_Controller {

    public function __construct()
    {
        parent::__construct();
        //check auth
        if (!is_staff() && !is_user()) {
            redirect(base_url());
        }
    }

    public function index()
    {
        if (is_staff()) {
            if (check_staff_permissions('appointments') != 1 ) {
                redirect(base_url('admin/dashboard/user'));
            }

        }
        $data = array();

        if(user()->role == 'staff'){$user_id = user()->user_id;}else{$user_id = user()->id;}

        $data['my_days'] =$this->admin_model->get_my_days($user_id);

        $my_days = $this->admin_model->get_my_days($user_id);

        foreach ($my_days as $day) {
            if ($day['day'] != 0) {
                $myday[] = $day['day'];
            }
        }

        $days = "1,2,3,4,5,6,7";
        $days = explode(',', $days);
        $assign_days = $myday;

        $match = array();
        $nomatch = array();

        foreach($days as $v){
            if(in_array($v, $assign_days))
                $match[]=$v;
            else
                $nomatch[]=$v;
        }
        var_dump($nomatch);

        $data['not_available'] = $nomatch;

        $data['page'] = 'Appointment';
        $data['page_title'] = 'Appointments';
        $data['patientses'] = $this->admin_model->select_by_chamber('patientses');
        $data['appointments'] = $this->admin_model->get_appointments(user()->id);
        $data['main_content'] = $this->load->view('admin/appointments/add',$data,TRUE);
        $this->load->view('admin/index',$data);
    }

    public function add()
    {	
        

        if($_POST)
        {   
            if(user()->role == 'staff'){$user_id = user()->user_id;}else{$user_id = user()->id;}
            $user= $this->admin_model->get_single_user($user_id);
        	$patient_type = $this->input->post('patient_type');
        	if ($patient_type == 1) {
	            //validate inputs
                $this->form_validation->set_rules('date', trans('date'), 'required');
                $this->form_validation->set_rules('time', trans('time'), 'required');
	            $this->form_validation->set_rules('name', trans('patient-name'), 'required');
                $this->form_validation->set_rules('email', trans('email'), 'required');
	            $this->form_validation->set_rules('mobile', trans('phone'), 'required');
        	}else{
                $this->form_validation->set_rules('date', trans('date'), 'required');
                $this->form_validation->set_rules('time', trans('time'), 'required');
	            $this->form_validation->set_rules('patient_id', "Patient", 'required');
        	}

            if ($this->form_validation->run() === false) {
                $this->session->set_flashdata('error', validation_errors());
                redirect(base_url('admin/appointment'));
            } else {

                if ($patient_type == 1) {
                    
                    $user_data = array(
                        'chamber_id' => $this->chamber->uid,
                        'user_id' => $user_id,
                        'name' => $this->input->post('name', true),
                        'email' => $this->input->post('email', true),
                        'mr_number' => random_string('numeric',5),
                        'age' => $this->input->post('age', true),
                        'weight' => $this->input->post('weight', true),
                        'sex' => $this->input->post('sex', true),
                        'mobile' => $this->input->post('mobile', true),
                        'password' => hash_password('1234'),
                        'created_at' => my_date_now()
                    );
                    $user_data = $this->security->xss_clean($user_data);
                    $patient_id = $this->admin_model->insert($user_data, 'patientses');

                    $subject = 'Welcome to '.$this->settings->site_name;
                    $msg = 'Your account has been created successfully, now you can login to your account using below access <br> Username:'.$this->input->post('email').' , and Password: 1234';
                    $this->email_model->send_email($this->input->post('email'), $subject, $msg);
                    
                }else{
                    $patient_id = $this->input->post('patient_id');
                }
                
                $date = $this->input->post('date', true);
                $time = $this->input->post('time');
                $serial_id = $this->admin_model->get_last_serial($date);
            
                $check_exist = $this->admin_model->check_existing_patient($patient_id, $date);
                $data = array(
                    'chamber_id' => $this->chamber->uid,
                    'user_id' => $user_id,
                    'patient_id' => $patient_id,
                    'serial_id' => $serial_id,
                    'date' => $date,
                    'time' => $time,
                    'status' => 0,
                    'type' => $this->input->post('type'),
                    'created_at' => my_date_now()
                );
                if ($check_exist == 1) {
                    $this->session->set_flashdata('error', trans('patient-already-registered')); 
                    redirect(base_url('admin/appointment')); 
                }

                if (date('Y-m-d') > $date) {
                    $this->session->set_flashdata('error', trans('please-select-a-valid-date'));  
                    redirect(base_url('admin/appointment'));
                }

                $this->admin_model->insert($data, 'appointments');
                $this->session->set_flashdata('msg', trans('inserted-successfully'));
                $patient = $this->admin_model->get_by_id($patient_id, 'patientses');

                if ($user->enable_sms_notify == 1) {
                    $message = trans('appointment').' of '.$user->name.' '.trans('booking-is-confirmed-at').' '.$date.' '.$time;
                    $this->sms_model->send_user($patient->mobile, $message, $user_id); 
                }

                if ($user->enable_whatsapp_msg == 1) {
                    $message = trans('appointment').' of '.$user->name.' '.trans('booking-is-confirmed-at').' '.$date.' '.$time;
                    $this->sms_model->send_whatsapp_user($patient->mobile, $message, $user->ultramsg_instance_id, $user->ultramsg_token); 
                }
                redirect(base_url('admin/appointment'));

            }

        } 
        
    }


    public function empty_serial($date, $id)
    {   
        $lists = '1,3,5,10,15,20,25';
        $block_serial = explode(',', $lists);
        foreach ($block_serial as $value) {
            if ($value == $serial_id) {
                $this->empty_serial($date, $value);
                $serial_id = $serial_id+1;
            }else{
                $serial_id = $serial_id;
            }
        }
                
        if(user()->role == 'staff'){$user_id = user()->user_id;}else{$user_id = user()->id;}
        $data = array(
            'chamber_id' => $this->chamber->uid,
            'user_id' => $user_id,
            'patient_id' => 0,
            'serial_id' => $id,
            'date' => $date,
            'status' => 1,
            'created_at' => my_date_now()
        );
        $this->admin_model->insert($data, 'appointments');
    }


    public function list($date)
    {
        if (is_staff()) {
            if (check_staff_permissions('appointments') != 1 ) {
                redirect(base_url('admin/dashboard/user'));
            }

        }
        $data = array();
        $data['page'] = 'Appointment';
        $data['page_title'] = 'Appointment lists';
        $data['date'] = $date;
        $data['patientses'] = $this->admin_model->select_by_chamber('patientses');
        $data['appointments'] = $this->admin_model->get_appointments_by_date($date);
        $data['main_content'] = $this->load->view('admin/appointments/list',$data,TRUE);
        $this->load->view('admin/index',$data);
    }


    public function all_list()
    {   
        if (is_staff()) {
            if (check_staff_permissions('appointments') != 1 ) {
                redirect(base_url('admin/dashboard/user'));
            }
            
        }
        $data = array();
        $data['page'] = 'Appointment';
        $data['page_title'] = 'Appointments list';
        $data['appointments'] = $this->admin_model->get_all_appointments();
        $data['main_content'] = $this->load->view('admin/appointments/all_list',$data,TRUE);
        $this->load->view('admin/index',$data);
    }



    public function assign()
    {
        if (is_staff()) {
            if (check_staff_permissions('schedule') != 1 ) {
                redirect(base_url('admin/dashboard/user'));
            }
            
        }

        $data = array();
        $data['page'] = 'Appointment';
        $data['upage'] = 'User Settings';   
        $data['page_title'] = 'Appointment Schedule';
        
        if(user()->role == 'staff'){$user_id = user()->user_id;}else{$user_id = user()->id;}
        $data['user'] =$this->admin_model->get_by_id($user_id, 'users');
        $data['my_days'] =$this->admin_model->get_user_days();
        $data['main_content'] = $this->load->view('admin/appointments/assign',$data,TRUE);
        $this->load->view('admin/index',$data);
    }


    public function set_interval() 
    {
        $data = array(
            'intervals' => $this->input->post('intervals')
        );
        
        $this->admin_model->edit_option($data, user()->id, 'users');
        $this->session->set_flashdata('msg', trans('updated-successfully')); 
        redirect(base_url('admin/appointment/assign'));
    }

    
    public function set()
    {   
        check_status();
        
        if(user()->role == 'staff'){$user_id = user()->user_id;}else{$user_id = user()->id;}
        $this->admin_model->delete_assaign_days($user_id, 'assaign_days');
        $this->admin_model->delete_assaign_time($user_id, 'assign_time');

        if($_POST)
        {   
            for ($i=0; $i < 7; $i++) { 
                if(empty($this->input->post("day_".$i))){
                    $day = 0;
                }else{
                    $day = $this->input->post("day_".$i);
                }
                $data = array(
                    'user_id' => $user_id,
                    'day' => $day
                );
                $data = $this->security->xss_clean($data);
                $this->admin_model->insert($data, 'assaign_days');

                // insert times
                $start = $this->input->post("start_time_".$i);
                $end = $this->input->post("end_time_".$i);

                if ($day != 0) {
                    for ($a=0; $a < count($start); $a++) { 
                        $time_data = array(
                            'user_id' => $user_id,
                            'day_id' => $day,
                            'time' => $start[$a].'-'.$end[$a],
                            'start' => $start[$a],
                            'end' => $end[$a]
                        );
                        $time_data = $this->security->xss_clean($time_data);
                        $this->admin_model->insert($time_data, 'assign_time');
                    }
                }

            }

            $this->session->set_flashdata('msg', trans('schedule-assigned-successfully')); 
            redirect(base_url('admin/appointment/assign'));
        }      
        
    }


    public function set_time()
    {   

        $this->admin_model->delete_assaign_time($user_id, 'assaign_time');
        
        $data = array(
            'user_id' => $user_id,
            'day_id' => $day,
            'start' => $day,
            'end' => $day
        );
        $data = $this->security->xss_clean($data);
        $this->admin_model->insert($data, 'assaign_time');
    }


    public function delete_time($id)
    {
        $this->admin_model->delete($id,'assign_time'); 
        echo json_encode(array('st' => 1));
    }

    public function delete($id)
    {
        $this->admin_model->delete($id,'appointments'); 
        echo json_encode(array('st' => 1));
    }


}
	

