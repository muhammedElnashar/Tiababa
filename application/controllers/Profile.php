<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Profile extends Home_Controller {

    public function __construct()
    {
        parent::__construct();
        header('Access-Control-Allow-Origin: *');
    }

    public function check_domain()
    {
        $url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        $parse = parse_url($url);
        $domain = $parse['host'];
 
        $uer_domain = $this->common_model->check_user_domain($domain);
        if (!empty($uer_domain)) {
            $user = $this->common_model->get_by_id($uer_domain->user_id, 'users');
            $slug = $user->slug;
            return $slug;
        } else {
            redirect(base_url());
        }
    }

    public function index($slug){
        $this->user($slug);
    }


    public function user($slug='')
    {   
        
        $data = array();

        if (empty($slug)) {
            $slug = $this->check_domain();
            $data['is_cdomain'] = true;
            $data['slug'] = '';
        }else{
            $data['is_cdomain'] = false;
            $data['slug'] = '/'.$slug;
        }

        $data['user'] = $this->common_model->get_user_by_slug($slug);
        $user_id =  $data['user']->id;
        $data['my_days'] =$this->admin_model->get_my_days($user_id);

        $my_days = $this->admin_model->get_my_days($user_id);

        $myday = array();
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

        if (!empty($assign_days)) {
            foreach($days as $v){     
                if(in_array($v, $assign_days))
                    $match[]=$v;
                else
                    $nomatch[]=$v;
            }
        } else {
            $nomatch = '';
        }

        

        $data['not_available'] = $nomatch;
        $data['chambers'] = $this->common_model->get_my_chambers($user_id);
        $data['educations'] = $this->common_model->get_my_educations($user_id);
        $data['experiences'] = $this->common_model->get_my_experiences($user_id);
        $data['patients'] = $this->common_model->get_my_total_patients($user_id);
        $data['prescriptions'] = $this->common_model->get_my_total_prescriptions($user_id);

        $data['ratings'] = $this->common_model->get_all_ratings($user_id);
        $data['rating'] = $this->common_model->get_ratings_info($user_id);
        $data['report'] = $this->common_model->get_single_ratings($user_id);
        $data['page_title'] = $data['user']->name;
        $data['page'] = 'Profile';
        $data['menu'] = false;
        $data['slug'] = $slug;

        //echo '<pre>'; print_r($data['user']); exit();
        $data['main_content'] = $this->load->view('profile', $data, TRUE);
        $this->load->view('index', $data);
    }


    

    //send comment
    public function book_appointment($slug='')
    {    
        $data = array();
        if (empty($slug)) {
            $slug = $this->check_domain();
            $data['is_cdomain'] = true;
            $data['slug'] = '';
        }else{
            $data['is_cdomain'] = false;
            $data['slug'] = '/'.$slug;
        }
        
        $id = $this->input->post('id');
        $check_patient = $this->input->post('check_patient');
        $user = $this->common_model->get_by_md5_id($id, 'users');
        $date = $this->input->post('date');
        $date = date("Y-m-d", strtotime($date));
        
        if ($_POST) {

            $check = $this->admin_model->check_duplicate_email($this->input->post('email'));
            if (!empty($check)) {
                echo json_encode(array('st'=>5,'msg'=> trans('email-exist')));
                exit();
            }

            //check reCAPTCHA
            if (!$this->recaptcha_verify_request()) {
                echo json_encode(array('st'=>4)); exit();
            } else {

                if (date('Y-m-d') > $date) {  
                    echo json_encode(array('st'=>2)); exit();
                }
            
                $patient = $this->common_model->check_patient($this->input->post('user_name'));
                $chamber = $this->common_model->get_by_id($this->input->post('chamber'), 'chamber');

                if ($check_patient == FALSE) {

                    $this->form_validation->set_rules('email', trans('email'), 'required');
                    $this->form_validation->set_rules('mobile', trans('phone'), 'required');
                    $this->form_validation->set_rules('new_password', trans('password'), 'required');

                    if ($this->form_validation->run() === false) {
                        $error = strip_tags(validation_errors());
                        echo json_encode(array('st'=>3,'error'=> $error));
                        exit();
                    }
                    
                    $password = hash_password($this->input->post('new_password'));

                } else {
                    
                    if (empty($patient)) {
                        echo json_encode(array('st'=> 0)); exit();
                    }

                    $password = $patient->password;
                    $patient_id = $patient->id;
                }

                $newuser_data = array(
                    'chamber_id' => $chamber->uid,
                    'user_id' => $user->id,
                    'name' => $this->input->post('name', true),
                    'email' => $this->input->post('email', true),
                    'mr_number' => random_string('numeric',5),
                    'mobile' => $this->input->post('mobile', true),
                    'password' => $password,
                    'created_at' => my_date_now()
                );

                $newuser_data = $this->security->xss_clean($newuser_data);
                if ($check_patient == FALSE) {
                    $patient_id = $this->admin_model->insert($newuser_data, 'patientses');

                    $subject = 'Welcome to '.$this->settings->site_name;
                    $msg = 'Your account has been created successfully, now you can login to your account using below access <br> Username:'.$this->input->post('email').' , and Password: '.$this->input->post('new_password');
                    //$this->email_model->send_email($this->input->post('email'), $subject, $msg);
                }
                
                if (check_user_feature_access('online-consultation', $user->id) == TRUE && $this->input->post('type') == 1){
                    $consultation_type = 'online';
                }else{
                    $consultation_type = 'offline';
                }

                $serial_id = $this->common_model->get_my_last_serial($date, $chamber->uid, $user->id);
                $data = array(
                    'chamber_id' => $chamber->uid,
                    'user_id' => $user->id,
                    'patient_id' => $patient_id,
                    'serial_id' => $serial_id,
                    'date' => $date,
                    'time' => $this->input->post('time', true),
                    'status' => 0,
                    'type' => $consultation_type,
                    'created_at' => my_date_now()
                );
                $amp_id = $this->admin_model->insert($data, 'appointments');

                // booking confirmation for patients
                $patient_info = $this->admin_model->get_by_id($patient_id, 'patientses');
                $esubject = trans('appointment-confirmation');
                $emsg = trans('appointment-confirmation-pdetails');
                $this->email_model->send_email($patient_info->email, $esubject, $emsg);

                // booking confirmation for doctors
                $esubject = trans('appointment-confirmation');
                $emsg = $patient_info->name.' '.trans('booked-an-appointment-at').' '.my_date_show($date);
                $this->email_model->send_email($user->email, $esubject, $emsg);

                if ($user->enable_sms_notify == 1) {
                    $message_to_user = $patient_info->name.' '.trans('booked-an-appointment-at').' '.my_date_show($date);
                    $this->sms_model->send_user($user->phone, $message_to_user, $user->id); 
                }

                if ($user->enable_sms_notify == 1) {
                    $message_to_patient = trans('appointment').' of '.$user->name.' '.trans('booking-is-confirmed-at').' '.$date.' '.$time;
                    $this->sms_model->send_user($patient_info->mobile, $message_to_patient, $user->id); 
                }

                if ($user->enable_whatsapp_msg == 1) {
                    $message_to_user = $patient_info->name.' '.trans('booked-an-appointment-at').' '.my_date_show($date);
                    $this->sms_model->send_whatsapp_user($user->phone, $message_to_user, $user->ultramsg_instance_id, $user->ultramsg_token); 
                }

                if ($user->enable_whatsapp_msg == 1) {
                    $message_to_patient = trans('appointment').' of '.$user->name.' '.trans('booking-is-confirmed-at').' '.$date.' '.$time;
                    $this->sms_model->send_whatsapp_user($patient_info->mobile, $message_to_patient, $user->ultramsg_instance_id, $user->ultramsg_token); 
                }

                if ($check_patient == TRUE) {
                   
                    $exist_patient = $this->auth_model->validate_patient();

                    if(password_verify($this->input->post('password'), $exist_patient->password)){
                        $data = array(
                            'id' => $exist_patient->id,
                            'name' => $exist_patient->name,
                            'slug' => $exist_patient->slug,
                            'thumb' => $exist_patient->thumb,
                            'email' =>$exist_patient->email,
                            'role' =>$exist_patient->role,
                            'parent' => 0,
                            'logged_in' => TRUE
                        );
                        $data = $this->security->xss_clean($data);
                        $this->session->set_userdata($data);
                    
                        if (check_user_feature_access('online-consultation', $user->id) == TRUE){
    
                            if (evisit_settings($user->id)->price != 0) {
                                $url = base_url('admin/payment/patient/'.$amp_id);
                            } else {
                                $url = base_url('admin/dashboard/patient');
                            }
                            
                            
                        }else{
                            $url = base_url('admin/dashboard/patient');
                        }
                    
                        echo json_encode(array('st'=>1,'url'=> $url));
                    }else{ 
                        echo json_encode(array('st'=> 0)); exit();
                    }
                }else {

                    $register = $this->common_model->get_by_id($patient_id, 'patientses');
                    $data = array(
                        'id' => $register->id,
                        'name' => $register->name,
                        'slug' => $register->slug,
                        'thumb' => $register->thumb,
                        'email' =>$register->email,
                        'role' =>$register->role,
                        'parent' => 0,
                        'logged_in' => TRUE
                    );
                    $data = $this->security->xss_clean($data);
                    $this->session->set_userdata($data);
                    
                    if ($this->input->post('type') == 1){
                        if (evisit_settings($user->id)->price != 0) {
                            $url = base_url('admin/payment/patient/'.$amp_id);
                        } else {
                            $url = base_url('admin/dashboard/patient');
                        }
                    }else{
                        $url = base_url('admin/dashboard/patient');
                    }
                    
                    echo json_encode(array('st'=>1,'url'=> $url));
                }
                
                

            }
        }
    }


    // not found page
    public function error_404()
    {
        $data['page_title'] = "Error 404";
        $data['description'] = "Error 404";
        $data['keywords'] = "error,404";
        $this->load->view('error_404');
    }

    public function blogs($slug)
    {   
        $data = array();
        if (empty($slug)) {
            $slug = $this->check_domain();
            $data['is_cdomain'] = true;
            $data['slug'] = '';
        }else{
            $data['is_cdomain'] = false;
            $data['slug'] = '/'.$slug;
        }

        //initialize pagination
        $this->load->library('pagination');
        $config['base_url'] = base_url('profile/blogs/'.$slug);

        $data['user'] = $this->common_model->get_by_slug($slug,'users');
        $total_row = $this->common_model->get_user_blog_posts(1 , 0, 0, $data['user']->id);
        $config['total_rows'] = $total_row;
        $config['per_page'] = 12;
        $this->pagination->initialize($config);
        $page = $this->security->xss_clean($this->input->get('page'));
        if (empty($page)) {
            $page = 0;
        }
        if ($page != 0) {
            $page = $page - 1;
        }
        
        $data['page_title'] = 'Blogs';
        $data['page'] = 'Profile';
        $data['menu'] = false;

        $data['posts'] = $this->common_model->get_user_blog_posts(0 , $config['per_page'], $page * $config['per_page'],$data['user']->id);
        $data['main_content'] = $this->load->view('user_blog_posts', $data, TRUE);
        $this->load->view('index', $data);
    }

    public function post($user_slug, $post_slug)
    {   

        $data = array();

        if (empty($user_slug)) {
            $user_slug = $this->check_domain();
            $data['is_cdomain'] = true;
            $data['user_slug'] = '';
        }else{
            $data['is_cdomain'] = false;
            $data['user_slug'] = '/'.$user_slug;
        }

        $user_slug = $this->security->xss_clean($user_slug);
        $data['page_title'] = 'Blogs';
        $data['menu'] = false;
        $data['page'] = 'Profile';
        $data['user'] = $this->common_model->get_by_slug($user_slug,'users');
        $data['post'] = $this->common_model->get_post_details($post_slug);

        if (empty($data['post'])) {
            redirect(base_url());
        }
        $category_id = $data['post']->category_id;
        $post_id = $data['post']->id;
        $data['post_id'] = $post_id;
        $data['post_id'] = $post_id;
        $data['tags'] = $this->common_model->get_post_tags($post_id);
        $data['main_content'] = $this->load->view('user_single_post', $data, TRUE);
        $this->load->view('index', $data);
    }

     public function services($slug)
    {   
        
        $data = array();

        if (empty($slug)) {
            $slug = $this->check_domain();
            $data['is_cdomain'] = true;
            $data['slug'] = '';
        }else{
            $data['is_cdomain'] = false;
            $data['slug'] = '/'.$slug;
        }

        //initialize pagination
        $this->load->library('pagination');
        $config['base_url'] = base_url('profile/services/'.$slug);

        $data['user'] = $this->common_model->get_by_slug($slug,'users');
        $total_row = $this->common_model->get_user_blog_posts(1 , 0, 0, $data['user']->id);
        $config['total_rows'] = $total_row;
        $config['per_page'] = 2;
        $this->pagination->initialize($config);
        $page = $this->security->xss_clean($this->input->get('page'));
        if (empty($page)) {
            $page = 0;
        }
        if ($page != 0) {
            $page = $page - 1;
        }
        
        $data['page_title'] = 'Services';
        $data['page'] = 'Profile';
        $data['menu'] = false;

        $data['services'] = $this->common_model->get_user_services(0 , $config['per_page'], $page * $config['per_page'],$data['user']->id);
        //echo "<pre>"; print_r($data['services']); exit();
        $data['main_content'] = $this->load->view('user_services', $data, TRUE);
        $this->load->view('index', $data);
    }

    public function service_details($user_slug, $post_slug)
    {   

        $data = array();

        if (empty($user_slug)) {
            $user_slug = $this->check_domain();
            $data['is_cdomain'] = true;
            $data['user_slug'] = '';
        }else{
            $data['is_cdomain'] = false;
            $data['user_slug'] = '/'.$user_slug;
        }

        $user_slug = $this->security->xss_clean($user_slug);
        $data['page_title'] = 'Services';
        $data['menu'] = false;
        $data['page'] = 'Profile';
        $data['user'] = $this->common_model->get_by_slug($user_slug,'users');
        $data['service'] = $this->common_model->get_service_details($post_slug);

        $data['main_content'] = $this->load->view('service_details', $data, TRUE);
        $this->load->view('index', $data);
    }


    public function about($slug)
    {   
        $data = array();
        if (empty($slug)) {
            $slug = $this->check_domain();
            $data['is_cdomain'] = true;
            $data['slug'] = '';
        }else{
            $data['is_cdomain'] = false;
            $data['slug'] = '/'.$slug;
        }

        $data['page_title'] = 'About Us';
        $data['menu'] = false;
        $data['page'] = 'Profile';
        $data['user'] = $this->common_model->get_by_slug($slug,'users');
        $data['educations'] = $this->common_model->get_my_educations($data['user']->id);
        $data['experiences'] = $this->common_model->get_my_experiences($data['user']->id);
        $data['main_content'] = $this->load->view('about', $data, TRUE);
        $this->load->view('index', $data);
    }


    public function contact($slug)
    {   

        $data = array();
        if (empty($slug)) {
            $slug = $this->check_domain();
            $data['is_cdomain'] = true;
            $data['slug'] = '';
        }else{
            $data['is_cdomain'] = false;
            $data['slug'] = '/'.$slug;
        }

        $data['page_title'] = 'Contact';
        $data['menu'] = false;
        $data['page'] = 'Profile';
        $data['user'] = $this->common_model->get_by_slug($slug,'users');
        //echo '<pre>'; print_r($data['user']); exit();
        $data['main_content'] = $this->load->view('user_contact', $data, TRUE);
        $this->load->view('index', $data);
    }

    public function send_message()
    {     


        if ($_POST) {
            $data = array(
                'user_id' => $this->input->post('user_id', true),
                'name' => $this->input->post('name', true),
                'email' => $this->input->post('email', true),
                'message' => $this->input->post('message', true),
                'created_at' => my_date_now()
            );
            $data = $this->security->xss_clean($data);
           
           
            $this->common_model->insert($data, 'contacts');
            $this->session->set_flashdata('msg', trans('message-send-successfully'));
            
            redirect($_SERVER['HTTP_REFERER']);
        }
    }



}