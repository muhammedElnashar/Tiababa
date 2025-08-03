<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Department extends Home_Controller {

    public function __construct()
    {
        parent::__construct();
        //check auth

        if (is_staff()) {
            if (check_staff_permissions('department') != 1 ) {
                redirect(base_url('admin/dashboard/user'));
            }
            
        }

        if (!is_admin() && !is_user() && !is_staff()) {
            redirect(base_url());
        }
    }


    public function index()
    {
        $data = array();
        $data['page_title'] = 'Department';      
        $data['upage'] = 'User Settings';   
        $data['department'] = FALSE;
        $data['departments'] = $this->admin_model->get_by_user('chamber_category');
        $data['main_content'] = $this->load->view('admin/department',$data,TRUE);
        $this->load->view('admin/index',$data);
    }


    public function add()
    {	
        if($_POST)
        {   

            check_status();
            
            $id = $this->input->post('id', true);


            // check valid user 
            $check = $this->admin_model->check_department_name($this->input->post('name'));

            if ($check) {
                $this->session->set_flashdata('error', 'Name already exists, try new one!');
                redirect(base_url('admin/department'));
            }


            //validate inputs
            $this->form_validation->set_rules('name', trans('name'), 'required');

            if ($this->form_validation->run() === false) {
                $this->session->set_flashdata('error', validation_errors());
                redirect(base_url('admin/department'));
            } else {
               
                $data=array(
                    'user_id' => user()->id,
                    'name' => $this->input->post('name', true)
                );
                $data = $this->security->xss_clean($data);
                
                //if id available info will be edited
                if ($id != '') {
                    $this->admin_model->edit_option($data, $id, 'chamber_category');
                    $this->session->set_flashdata('msg', trans('updated-successfully')); 
                } else {
                    $id = $this->admin_model->insert($data, 'chamber_category');
                    $this->session->set_flashdata('msg', trans('inserted-successfully')); 
                }
                redirect(base_url('admin/department'));

            }
        }      
        
    }

    public function edit($id)
    {  
        $data = array();
        $data['page_title'] = 'Edit';   
        $data['department'] = $this->admin_model->select_option($id, 'chamber_category');
        $data['main_content'] = $this->load->view('admin/department',$data,TRUE);
        $this->load->view('admin/index',$data);
    }

    
    public function active($id) 
    {
        $data = array(
            'status' => 1
        );
        $data = $this->security->xss_clean($data);
        $this->admin_model->update($data, $id,'chamber_category');
        $this->session->set_flashdata('msg', trans('activate-successfully')); 
        redirect(base_url('admin/department'));
    }

    public function deactive($id) 
    {
        $data = array(
            'status' => 0
        );
        $data = $this->security->xss_clean($data);
        $this->admin_model->update($data, $id,'chamber_category');
        $this->session->set_flashdata('msg', trans('deactivate-successfully')); 
        redirect(base_url('admin/department'));
    }

    public function delete($id)
    {
        $this->admin_model->delete($id,'chamber_category'); 
        echo json_encode(array('st' => 1));
    }

}
	

