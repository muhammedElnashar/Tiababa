<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends Home_Controller {

	public function __construct()
    {
        parent::__construct();
    }

    
    public function index()
    {
        //$this->update_site_url();
        //check auth
        if (!is_admin()) {
            redirect(base_url());
        }
        $data = array();
        $data['page_title'] = 'Dashboard';
        $data['currency'] = settings()->currency_symbol;
        for ($i = 1; $i <= 13; $i++) {
            $months[] = date("Y-m", strtotime( date('Y-m-01')." -$i months"));
        }

        for ($i = 0; $i <= 11; $i++) {
            $income = $this->admin_model->get_admin_income_by_date(date("Y-m", strtotime( date('Y-m-01')." -$i months")));
            $months[] = array("date" => month_show(date("Y-m", strtotime( date('Y-m-01')." -$i months"))));
            $incomes[] = array("total" => $income);
        }

        $data['income_axis'] = json_encode(array_column($months, 'date'),JSON_NUMERIC_CHECK);
        $data['income_data'] = json_encode(array_column($incomes, 'total'),JSON_NUMERIC_CHECK);
        $data['net_income'] = $this->admin_model->get_admin_income_by_year();
        $data['upackages'] = $this->admin_model->get_users_packages();
        $data['users'] = $this->admin_model->get_latest_users();
        $data['user'] = $this->admin_model->get_user_total();
        $data['main_content'] = $this->load->view('admin/dash', $data, TRUE);
        $this->load->view('admin/index', $data);
    }

    public function update_site_url()
    {
        $data = array(
            'site_url' => get_current_domain()
        );
        $this->admin_model->edit_option($data, 1, 'settings');
    }

    //user dashboard
    public function user()
    {

        $data = array();
        $data['page_title'] = 'User Dashboard';
        if (is_user()|| is_staff()) {
            $data['currency'] = currency_symbol(user()->currency);
            for ($i = 1; $i <= 13; $i++) {
                $months[] = date("Y-m", strtotime( date('Y-m-01')." -$i months"));
            }

            for ($i = 0; $i <= 11; $i++) {
                $income = $this->admin_model->get_user_income_by_date(date("Y-m", strtotime( date('Y-m-01')." -$i months")));
                $months[] = array("date" => month_show(date("Y-m", strtotime( date('Y-m-01')." -$i months"))));
                $incomes[] = array("total" => $income);
            }
        }
        //echo "<pre>"; print_r($incomes); exit();
        $data['income_axis'] = json_encode(array_column($months, 'date'),JSON_NUMERIC_CHECK);
        $data['income_data'] = json_encode(array_column($incomes, 'total'),JSON_NUMERIC_CHECK);
        $data['net_income'] = $this->admin_model->get_user_income_by_year();
        $data['staffs'] = $this->admin_model->get_count_by_user_id('staffs', user()->id);
        $data['patients'] = $this->admin_model->get_count_by_user_id('patientses', user()->id);
        $data['serials'] = $this->admin_model->get_count_serials();
        $data['appointments'] = $this->admin_model->get_limit_appointments('10');
        $data['main_content'] = $this->load->view('admin/dash', $data, TRUE);
        $this->load->view('admin/index', $data);
        $this->disable_expire_serials();
    }


    //rating
    public function rating()
    {
        if (is_staff()) {
            if (check_staff_permissions('ratings-review') != 1 ) {
                redirect(base_url('admin/dashboard/user'));
            }
            
        }
        $data = array();
        $data['page_title'] = 'Ratings';
        $data['ratings'] = $this->admin_model->get_all_ratings();
        $data['rating'] = $this->admin_model->get_ratings_info();
        $data['report'] = $this->admin_model->get_single_ratings();
        $data['main_content'] = $this->load->view('admin/user/rating_report', $data, TRUE);
        $this->load->view('admin/index', $data);
    }

    //disable expire serials 
    public function rating_update($status)
    {
        $data = array(
            'enable_rating' => $status
        );
        $this->admin_model->edit_option($data, user()->id, 'users');
        echo json_encode(array('st'=>1));
    }


    //patient dashboard
    public function patient()
    {
        $data = array();
        $data['page_title'] = 'Patient Dashboard';
        $data['appointments'] = $this->admin_model->get_patient_appointments();
        $data['main_content'] = $this->load->view('admin/dash', $data, TRUE);
        $this->load->view('admin/index', $data);
    }

    //disable expire serials 
    public function disable_expire_serials()
    {
        $results = $this->admin_model->get_expire_appointments();
        foreach ($results as $value) {
            
            $data = array(
                'status' => 0
            );
            $this->admin_model->edit_option($data, $value->id, 'appointments');
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
            $user = $this->admin_model->get_by_id($id, 'users');

            if(password_verify($this->input->post('old_pass', true), $user->password)){
                if ($this->input->post('new_pass', true) == $this->input->post('confirm_pass', true)) {
                    $data=array(
                        'password' => hash_password($this->input->post('new_pass', true))
                    );
                    $data = $this->security->xss_clean($data);
                    $this->admin_model->edit_option($data, $id, 'users');
                    echo json_encode(array('st'=>1));
                } else {
                    echo json_encode(array('st'=>2));
                }
            } else {
                echo json_encode(array('st'=>0));
            }
        }
    }

}