<?php defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $global_data['settings'] = $this->common_model->get_settings();
        $this->settings = $global_data['settings'];

        $global_data['selected_lang'] = $this->settings->lang;
        $this->selected_lang = $global_data['selected_lang'];
        $this->lang->load('website', $global_data['settings']->lang_slug);
        $this->load->vars($global_data);
        
        $active_chamber = $this->session->userdata('active_chamber');
        if (empty($active_chamber)) {
            $global_data['chamber'] = $this->admin_model->get_chamber_row(0);
        } else {
            $global_data['chamber'] = $this->admin_model->get_chamber_row($active_chamber);
        }

        $this->chamber = $global_data['chamber'];
        $this->load->vars($global_data);
        $this->db->query("SET sql_mode=''");

    }

}


class Home_Controller extends MY_Controller
{
    public function __construct()
    {

        parent::__construct();
        $global_data['settings'] = $this->common_model->get_settings();
        $this->settings = $global_data['settings'];

        if (get_lang() == '') {
            $this->lang->load('website', $this->settings->lang_slug);
        }else{
            $this->lang->load('website', get_lang());
        }
        $this->load->vars($global_data);
    }

    //verify recaptcha
    public function recaptcha_verify_request()
    {
        if ($this->settings->enable_captcha == 0) {
            return true;
        }

        $this->load->library('recaptcha');
        $recaptcha = $this->input->post('g-recaptcha-response');
        if (!empty($recaptcha)) {
            $response = $this->recaptcha->verifyResponse($recaptcha);
            if (isset($response['success']) && $response['success'] === true) {
                return true;
            }
        }
        return false;
    }

}