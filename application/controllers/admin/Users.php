<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users extends Home_Controller {

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
        $this->all_users('all');
    }

    //all users list
    public function all_users($type)
    {

        $data = array();
        //initialize pagination
        $this->load->library('pagination');
        $config['base_url'] = base_url('admin/users/all_users/'.$type);
        $total_row = $this->admin_model->get_all_users(1 , 0, 0, $type);
        $config['total_rows'] = $total_row;
        $config['per_page'] = 10;
        $this->pagination->initialize($config);
        
        $page = $this->security->xss_clean($this->input->get('page'));
        if (empty($page)) {
            $page = 0;
        }
        if ($page != 0) {
            $page = $page - 1;
        }

        $data['page_title'] = 'Users';
        $data['packages'] = $this->admin_model->select('package');
        $data['countries'] = $this->admin_model->select_asc('country');
        $data['users'] = $this->admin_model->get_all_users(0 , $config['per_page'], $page * $config['per_page'], $type);
        $data['main_content'] = $this->load->view('admin/users', $data, TRUE);
        $this->load->view('admin/index', $data);
    }


    public function verify($user_id)
    {
        $data = array();
        $data['page_title'] = 'Verify';
        $data['user_id'] = $user_id;
        $data['files'] = $this->admin_model->get_by_user_id($user_id, 'verification_files');
        $data['main_content'] = $this->load->view('admin/verify', $data, TRUE);
        $this->load->view('admin/index', $data);
    }


    public function confirm_verification($user_id)
    {
        $udata = array(
            'is_verified' => 1
        );
        $udata = $this->security->xss_clean($udata);
        $this->admin_model->update($udata, $user_id, 'users');
        redirect(base_url('admin/users'));
    }


    //active or deactive post
    public function status_action($type, $id) 
    {
        check_status();
        
        $data = array(
            'status' => $type
        );
        $data = $this->security->xss_clean($data);
        $this->admin_model->update($data, $id,'users');

        if($type ==1):
            $this->session->set_flashdata('msg', trans('activate-successfully')); 
        else:
            $this->session->set_flashdata('msg', trans('deactivate-successfully')); 
        endif;
        redirect(base_url('admin/users'));
    }

    //change user role
    public function change_account($id) 
    {
        $data = array(
            'account_type' => $this->input->post('type', false)
        );
        $data = $this->security->xss_clean($data);
        $this->admin_model->edit_option($data, $id, 'users');
        $this->session->set_flashdata('msg', 'Updated Successfully');
        redirect(base_url('admin/users'));
    }


    public function update_plan()
    {   
        if($_POST)
        {   
            $package = $this->admin_model->get_by_id($this->input->post('package'), 'package');
            $payment = $this->admin_model->get_user_payment($this->input->post('user'));

            if($this->input->post('billing_type') =='monthly'):
                $amount = round($package->monthly_price); 
                $expire_on = date('Y-m-d', strtotime('+1 month'));
            else:
                $amount = round($package->price); 
                $expire_on = date('Y-m-d', strtotime('+12 month'));
            endif;
            
    
            $data=array(
                'user_id' => $this->input->post('user', true),
                'package_id' => $package->id,
                'billing_type' => $this->input->post('billing_type', true),
                'amount' => $amount,
                'status' => $this->input->post('status', true),
                'created_at' => my_date_now(),
                'expire_on' => $expire_on
            );
            $data = $this->security->xss_clean($data);

            if (empty($payment)) {
                $this->admin_model->insert($data, 'payment');
            } else {
                $this->admin_model->update_payment($data, $this->input->post('user'), 'payment');
            }

            $this->session->set_flashdata('msg', trans('updated-successfully')); 
            redirect(base_url('admin/users'));

            
        }      
        
    }



    public function delete($user_id)
    {
        check_status();
        
        $this->admin_model->delete_by_user($user_id,'payment'); 
        $this->admin_model->delete_by_user($user_id,'additional_advises');
        $this->admin_model->delete_by_user($user_id,'advises');
        $this->admin_model->delete_by_user($user_id,'diagonosis');
        $this->admin_model->delete_by_user($user_id,'advise_investigations');
        $this->admin_model->delete_by_user($user_id,'appointments');
        $this->admin_model->delete_by_user($user_id,'chamber');
        $this->admin_model->delete_by_user($user_id,'drugs');
        $this->admin_model->delete_by_user($user_id,'patientses');
        $this->admin_model->delete_by_user($user_id,'prescription');
        $this->admin_model->delete_by_user($user_id,'staffs');
        $this->admin_model->delete($user_id,'users'); 
        echo json_encode(array('st' => 1));
        
    }


}