<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Settings extends Home_Controller {

    public function __construct()
    {
        parent::__construct();
        //check auth
        
        if (!is_admin()) {
            redirect(base_url());
        }
    }

    
    public function index()
    {
        $data = array();
        $data['page_title'] = 'Settings';
        $data['settings'] = $this->admin_model->get('settings');

        $data['currencies'] = $this->admin_model->select_asc('country');
        $data['main_content'] = $this->load->view('admin/settings', $data, TRUE);
        $this->load->view('admin/index', $data);
    }


    //set default language
    public function set_language()
    {
        check_status();
        
        if ($_POST) {
            $data = array(
                'lang' => $this->input->post('language', true)
            );
            $data = $this->security->xss_clean($data);
            $this->admin_model->edit_option($data, 1, 'settings');
            $this->session->set_flashdata('msg', trans('updated-successfully')); 
            redirect(base_url('admin/language'));
        }
    }

    public function appearance(){

        $data = array();
        $data['page_title'] = 'Appearance';
        $data['main_content'] = $this->load->view('admin/appearance', $data, TRUE);
        $this->load->view('admin/index', $data);

        if ($_POST) {
            $data = array(
                'theme' => $this->input->post('theme', true)
            );
            $data = $this->security->xss_clean($data);
            $this->admin_model->edit_option($data, 1, 'settings');
            $this->session->set_flashdata('msg', trans('updated-successfully')); 
            redirect(base_url('admin/settings/appearance'));
        }
    }



    //update settings
    public function update(){

        check_status();
        
        if ($_POST) {

            $this->pwa_logo_upload();

            if(!empty($this->input->post('enable_multilingual'))){$enable_multilingual = $this->input->post('enable_multilingual', true);}
            else{$enable_multilingual = 0;}

            if(!empty($this->input->post('enable_registration'))){$enable_registration = $this->input->post('enable_registration', true);}
            else{$enable_registration = 0;}

            if(!empty($this->input->post('enable_email_verify'))){$enable_email_verify = $this->input->post('enable_email_verify', true);}
            else{$enable_email_verify = 0;}

            if(!empty($this->input->post('enable_sms_verify')) && empty($this->input->post('enable_email_verify')))
                {$enable_sms_verify = $this->input->post('enable_sms_verify', true);}
            else{$enable_sms_verify = 0;}

            if(!empty($this->input->post('enable_captcha'))){$enable_captcha = $this->input->post('enable_captcha', true);}
            else{$enable_captcha = 0;}

            if(!empty($this->input->post('enable_payment'))){$enable_payment = $this->input->post('enable_payment', true);}
            else{$enable_payment = 0;}

            if(!empty($this->input->post('enable_blog'))){$enable_blog = $this->input->post('enable_blog', true);}
            else{$enable_blog = 0;}

            if(!empty($this->input->post('enable_faq'))){$enable_faq = $this->input->post('enable_faq', true);}
            else{$enable_faq = 0;}

            if(!empty($this->input->post('enable_users'))){$enable_users = $this->input->post('enable_users', true);}
            else{$enable_users = 0;}

            if(!empty($this->input->post('enable_workflow'))){$enable_workflow = $this->input->post('enable_workflow', true);}
            else{$enable_workflow = 0;}

            if(!empty($this->input->post('global_twilio'))){$global_twilio = $this->input->post('global_twilio', true);}
            else{$global_twilio = 0;}

            if(!empty($this->input->post('global_ultramsg'))){$global_ultramsg = $this->input->post('global_ultramsg', true);}
            else{$global_ultramsg = 0;}

            if(!empty($this->input->post('profile_verification'))){$profile_verification = $this->input->post('profile_verification', true);}
            else{$profile_verification = 0;}

            if(!empty($this->input->post('enable_pwa', true))){$enable_pwa = $this->input->post('enable_pwa', true);}
            else{$enable_pwa = 0;}

            
            $data = array(
                'site_name' => $this->input->post('site_name', true),
                'site_title' => $this->input->post('site_title', true),
                'keywords' => $this->input->post('keywords', true),
                'description' => $this->input->post('description', true),
                'footer_about' => $this->input->post('footer_about', true),
                'admin_email' => $this->input->post('admin_email', true),
                'copyright' => $this->input->post('copyright', true),
                'verification_items' => json_encode($this->input->post('verification_items')),
                'profile_verification' => $this->input->post('profile_verification'),
                'pagination_limit' => 0,
                'expire_reminder' => $this->input->post('expire_reminder', true),
                'trial_days' => $this->input->post('trial_days', true),
                'facebook' => $this->input->post('facebook', true),
                'twitter' => $this->input->post('twitter', true),
                'instagram' => $this->input->post('instagram', true),
                'linkedin' => $this->input->post('linkedin', true),
                'enable_multilingual' => $enable_multilingual,
                'enable_registration' => $enable_registration,
                'enable_captcha' => $enable_captcha,
                'enable_payment' => $enable_payment,
                'enable_blog' => $enable_blog,
                'enable_faq' => $enable_faq,
                'enable_users' => $enable_users,
                'enable_workflow' => $enable_workflow,
                'enable_email_verify' => $enable_email_verify,
                'enable_sms_verify' => $enable_sms_verify,
                'enable_pwa' => $enable_pwa,
                'google_analytics' => base64_encode($this->input->post('google_analytics')),
                'country' => $this->input->post('country', true),
                'site_color' => '#ddd',
                'site_font' => 'Alata',
                'layout' => 0,
                'captcha_site_key' => $this->input->post('captcha_site_key', true),
                'captcha_secret_key' => $this->input->post('captcha_secret_key', true),
                'zoom_account_id' => $this->input->post('zoom_account_id', true),
                'zoom_client_id' => $this->input->post('zoom_client_id', true),
                'zoom_client_secret' => $this->input->post('zoom_client_secret', true),
                'twillo_account_sid' => $this->input->post('twillo_account_sid', true),
                'twillo_auth_token' => $this->input->post('twillo_auth_token', true),
                'twillo_number' => $this->input->post('twillo_number', true),

                'global_twilio' => $global_twilio,
                'global_ultramsg' => $global_ultramsg,
                'ultramsg_instance_id' => $this->input->post('ultramsg_instance_id', true),
                'ultramsg_token' => $this->input->post('ultramsg_token', true),

                'mail_protocol' => $this->input->post('mail_protocol', true),
                'mail_title' => $this->input->post('mail_title', true),
                'mail_host' => $this->input->post('mail_host', true),
                'mail_port' => $this->input->post('mail_port', true),
                'mail_username' => $this->input->post('mail_username', true),
                'mail_password' => base64_encode($this->input->post('mail_password')),
                'mail_encryption' => $this->input->post('mail_encryption') 
            );
            
            // upload signature image
            $data_img = $this->admin_model->do_upload('photo1');
            if($data_img){

                $data_img = array(
                    'favicon' => $data_img['thumb']
                );
                $this->admin_model->edit_option($data_img, 1, 'settings'); 
             }

            // upload logo
            $data_img2 = $this->admin_model->do_upload('photo2');
            if($data_img2){
                $data_img = array(
                    'logo' => $data_img2['medium']
                );            
                $this->admin_model->edit_option($data_img, 1, 'settings');
            }

            // upload home hero image
            $data_img3 = $this->admin_model->do_upload('photo3');
            if($data_img3){
                $data_img = array(
                    'hero_img' => $data_img3['medium']
                );            
                $this->admin_model->edit_option($data_img, 1, 'settings');
            }

            $user_data = array(
                'email' => $this->input->post('admin_email', true)        
            );
            
            $user_data = $this->security->xss_clean($user_data);
            $this->admin_model->edit_option($user_data, user()->id, 'users');

            $data = $this->security->xss_clean($data);
            $this->admin_model->edit_option($data, 1, 'settings');
            $this->session->set_flashdata('msg', trans('updated-successfully')); 
            redirect($_SERVER['HTTP_REFERER']);
        }
    }


    public function pwa_logo_upload() {
        if (!empty($_FILES['pwa_logo']['name'])) {
            $config['upload_path']          = './uploads/files'; //file save path
            $config['allowed_types']        = 'jpg|png|jpeg';
            $config['max_size']             = 512;
            $config['encrypt_name']         = TRUE;

            $this->load->library('upload', $config);
            if ( ! $this->upload->do_upload('pwa_logo')){
                // Upload failed, display error
                $error = array('error' => $this->upload->display_errors());
                $this->session->set_flashdata('error', $error);
            } else {
                // Upload success, check image dimensions
                $upload_data = $this->upload->data();
                $file_path = $upload_data['full_path'];
                $file_name = $upload_data['file_name'];
                list($width, $height) = getimagesize($file_path);
                //echo $width.' = '.$height; exit();
                // Check dimensions here
                if ($width != 512 && $height != 512) {
                    unlink($file_path);
                    $error = "Image dimensions should not exceed 512 x 512 pixels.";
                    $this->session->set_flashdata('error', $error); 
                } else {
                    $cdata=array(
                        'pwa_logo' => 'uploads/files/'.$file_name
                    );
                    $cdata = $this->security->xss_clean($cdata);
                    $this->admin_model->edit_option($cdata, 1, 'settings');
                }
            }
        }
    }


    public function test_zoom_connection(){

        $this->load->library('zoom');
        $date = date('Y-m-d');
        $start_time = $date.' 10:00';

        $agenda = 'Zoom Meeting Test Connection';
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

        $result = $this->zoom->get_meeting(settings()->zoom_account_id, settings()->zoom_client_id, settings()->zoom_client_secret, $fields);
        $result = json_decode($result);

        if (!empty($result->start_url)) {
            echo json_encode(array('st' => 1, 'msg' => '<i class="fa fa-check-circle"></i> Zoom api connected successfully'));
        }else{
            echo json_encode(array('st' => 2, 'msg' => '<i class="fa fa-times-circle"></i> '.$result->message));
        }

    }


}