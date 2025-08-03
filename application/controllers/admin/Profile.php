<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Profile extends Home_Controller {

	public function __construct()
    {
        parent::__construct();
        //check auth
        if (is_staff()) {
            if (check_staff_permissions('doctor-profile') != 1 ) {
                redirect(base_url('admin/dashboard/user'));
            }
            
        }
        if (!is_staff() && !is_user()) {
            redirect(base_url());
        }
    }


    public function index()
    {
        if (is_staff()) {
            if (check_staff_permissions('doctor-profile') != 1 ) {
                redirect(base_url('admin/dashboard/user'));
            }
            
        }
        $data = array();
        $data['page_title'] = 'Profile';
        $data['user'] = $this->admin_model->get_user_info();
        $data['countries'] = $this->admin_model->select_asc('country');
        $data['main_content'] = $this->load->view('admin/user/profile/profile', $data, TRUE);
        $this->load->view('admin/index', $data);
    }


    public function verify()
    {
        $data = array();
        $data['page_title'] = 'Verify';
        $data['main_content'] = $this->load->view('admin/user/profile/verify', $data, TRUE);
        $this->load->view('admin/index', $data);
    }


     public function upload_documents()
    {   
        

        if(!empty($_FILES['files']['name'])){

            $filesCount = count($_FILES['files']['name']);
            
            for($i = 0; $i < $filesCount; $i++){
                
                $_FILES['file']['name']     = $_FILES['files']['name'][$i];
                $_FILES['file']['type']     = $_FILES['files']['type'][$i];
                $_FILES['file']['tmp_name'] = $_FILES['files']['tmp_name'][$i];
                $_FILES['file']['error']    = $_FILES['files']['error'][$i];
                $_FILES['file']['size']     = $_FILES['files']['size'][$i];
                
                $new_name = "files_".time().strtolower(uniqid().'.'.pathinfo($_FILES['files']['name'][$i], PATHINFO_EXTENSION));

                // File upload configuration
                $uploadPath = 'uploads/files/';
                $config['upload_path'] = $uploadPath;
                $config['file_name'] = $new_name;
                $config['allowed_types'] = 'jpg|jpeg|png';
                
                // Load and initialize upload library
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                $this->load->library('image_lib');

                // Upload file to server
                if($this->upload->do_upload('file')){

                    // resize image
                    $image_data =   $this->upload->data();
                    $configer =  array(
                      'image_library'   => 'gd2',
                      'source_image'    =>  $image_data['full_path'],
                      'maintain_ratio'  =>  TRUE,
                      'width'           =>  1200,
                      'height'          =>  1000,
                    );
                    $this->image_lib->clear();
                    $this->image_lib->initialize($configer);
                    $this->image_lib->resize();

                
                    $data = array(
                        'user_id' => user()->id,
                        'name' => $this->input->post('name')[$i],
                        'file' => 'uploads/files/'.$new_name,
                        'created_at' => my_date_now()
                    );
                    $data = $this->security->xss_clean($data);
                    $this->common_model->insert($data, 'verification_files');

                }
            }
            
        }


        $this->session->set_flashdata('msg', trans('documents-submitted-successfully'));
        redirect($_SERVER['HTTP_REFERER']);
       
    }



    public function qr_code()
    {
        if (is_staff()) {
            if (check_staff_permissions('qr-code') != 1 ) {
                redirect(base_url('admin/dashboard/user'));
            }
            
        }

        if (!is_user() && !is_staff()) {
            redirect(base_url());
        }

        if (user()->qr_code == '') {
            $this->generate_qucode(user()->slug);
        }

        $data = array();
        $data['page'] = 'Settings';
        $data['page_title'] = 'QR Settings';      
        $data['upage'] = 'User Settings';   
        $data['user'] = $this->admin_model->get_user_info();
        $data['main_content'] = $this->load->view('admin/user/generate_code', $data, TRUE);
        $this->load->view('admin/index', $data);
    }

    public function generate_qucode($slug)
    {
        $this->load->library('ciqrcode');
        $qr_image= 'qrcode_'.rand().'.png';
        $params['data'] = base_url().'profile/'.$slug;
        $params['level'] = 'H';
        $params['size'] = 8;
        $params['savename'] = FCPATH."uploads/files/".$qr_image;
        if($this->ciqrcode->generate($params))
        {
           $data = array(
            'qr_code' => 'uploads/files/'.$qr_image
           );
           $this->admin_model->edit_option($data, user()->id, 'users');
        }
    }

    public function download_qrcode()
    {
        $this->load->helper('download');
        $file_name = basename(user()->qr_code);
        $data = file_get_contents(user()->qr_code);
        $name = $file_name;

        force_download($name, $data);
    }


    public function upload_avatar($value='')
    {
        check_status();

        $data = $this->input->post('image');

        list($type, $data) = explode(';', $data);
        list(, $data)      = explode(',', $data);
     
        $data = base64_decode($data);
        $imageName = time().'.png';
        file_put_contents('uploads/medium/'.$imageName, $data);
        file_put_contents('uploads/thumbnail/'.$imageName, $data);

        $data_img = array(
            'image' => 'uploads/medium/'.$imageName,
            'thumb' => 'uploads/medium/'.$imageName
        );
        $this->admin_model->edit_option($data_img, user()->id, 'users');
        echo 'done';
    }

    //update user profile
    public function update(){
        
        check_status();

        if ($_POST) {

            if(!empty($this->input->post('enable_appointment', true))){ $enable_appointment = 1;}else{$enable_appointment = 0;}

            

            $data = array(
                'name' => $this->input->post('name', true),
                'specialist' => $this->input->post('specialist', true),
                'degree' => $this->input->post('degree', true),
                'address' => $this->input->post('address', true),
                'skype' => $this->input->post('skype', true),
                'whatsapp' => $this->input->post('whatsapp', true),
                'phone' => $this->input->post('phone', true),
                'exp_years' => $this->input->post('exp_years', true),
                'about_me' => $this->input->post('about_me', true),
                'about_us' => $this->input->post('about_us', true),
                'email' => $this->input->post('email', true),
                'country' => $this->input->post('country', true),
                'city' => $this->input->post('city', true),
                'facebook' => $this->input->post('facebook', true),
                'twitter' => $this->input->post('twitter', true),
                'linkedin' => $this->input->post('linkedin', true),
                'instagram' => $this->input->post('instagram', true),
                'description' => $this->input->post('description', true),
                'meta_tags' => $this->input->post('meta_tags', true),
                'custom_js' => base64_encode($this->input->post('custom_js')),
                'enable_appointment' => $enable_appointment
            );
            
            if(user()->role == 'staff'){$user_id = user()->user_id;}else{$user_id = user()->id;}

          
            // upload favicon image
            $data_pimg = $this->admin_model->do_upload('photo2');
            if($data_pimg){

                $data_img = array(
                    'image' => $data_pimg['thumb'],
                    'thumb' => $data_pimg['medium']
                );
                $this->admin_model->edit_option($data_img, $user_id, 'users');
            }


            // upload favicon image
            $data_img = $this->admin_model->do_upload('photo1');
            if($data_img){

                $data_img = array(
                    'signature' => $data_img['thumb']
                );
                $this->admin_model->edit_option($data_img, $user_id, 'users');
            }



            $data = $this->security->xss_clean($data);
            $this->admin_model->edit_option($data, $user_id, 'users');
            $this->session->set_flashdata('msg', trans('updated-successfully')); 
            redirect(base_url('admin/profile'));
        }
    }



    public function change_password()
    {
        $data = array();
        $data['page_title'] = 'Change Password';
        $data['main_content'] = $this->load->view('admin/change_password', $data, TRUE);
        $this->load->view('admin/index', $data);
    }
    

    //change password
    public function change()
    {   
        check_status();
        
        if($_POST){
            
            $id = user()->id;
            $user = $this->admin_model->get_by_id($id, 'staffs');

            if(password_verify($this->input->post('old_pass', true), $user->password)){
                if ($this->input->post('new_pass', true) == $this->input->post('confirm_pass', true)) {
                    $data=array(
                        'password' => hash_password($this->input->post('new_pass', true))
                    );
                    $data = $this->security->xss_clean($data);
                    $this->admin_model->edit_option($data, $id, 'staffs');
                    echo json_encode(array('st'=>1));
                } else {
                    echo json_encode(array('st'=>2));
                }
            } else {
                echo json_encode(array('st'=>0));
            }
        }
    }

    public function twilio_settings()
    {
        $data = array();
        $data['upage'] = 'User Settings';
        $data['page_title'] = 'Twilio Settings';
        $data['main_content'] = $this->load->view('admin/user/twilio_sms_settings', $data, TRUE);
        $this->load->view('admin/index', $data);
    }

    public function update_sms(){

        $data = array(
            'twillo_account_sid' => $this->input->post('twillo_account_sid', true),
            'twillo_auth_token' => $this->input->post('twillo_auth_token', true),
            'twillo_number' => $this->input->post('twillo_number', true),
            'enable_sms_notify' => $this->input->post('enable_sms_notify', true),
        );
  
        $data = $this->security->xss_clean($data);
        $this->admin_model->edit_option($data, user()->id, 'users');
        $this->session->set_flashdata('msg', trans('updated-successfully')); 
        redirect(base_url('admin/profile/twilio_settings'));
    }

    public function whatsapp()
    {
        $data = array();
        $data['upage'] = 'User Settings';
        $data['page_title'] = 'Whatsapp Settings';
        $data['main_content'] = $this->load->view('admin/user/whatsapp_settings', $data, TRUE);
        $this->load->view('admin/index', $data);
    }

    public function update_whatsapp(){
        
        if(!empty($this->input->post('enable_whatsapp_msg'))){$enable_whatsapp_msg = $this->input->post('enable_whatsapp_msg', true);}
        else{$enable_whatsapp_msg = 0;}

        $data = array(
            'ultramsg_instance_id' => $this->input->post('ultramsg_instance_id', true),
            'ultramsg_token' => $this->input->post('ultramsg_token', true),
            'enable_whatsapp_msg' => $enable_whatsapp_msg
        );
  
        $data = $this->security->xss_clean($data);
        $this->admin_model->edit_option($data, user()->id, 'users');
        $this->session->set_flashdata('msg', trans('updated-successfully')); 
        redirect(base_url('admin/profile/whatsapp'));
    }


}