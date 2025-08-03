<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Educations extends Home_Controller {

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
        $data = array();
        $data['page_title'] = 'Educations';      
        $data['page'] = 'Educations';   
        $data['education'] = FALSE;
        $data['educations'] = $this->admin_model->select_by_user('educations');
        $data['main_content'] = $this->load->view('admin/user/profile/educations',$data,TRUE);
        $this->load->view('admin/index',$data);
    }


    public function add()
    {	
        if($_POST)
        {   
            $id = $this->input->post('id', true);

            //validate inputs
            $this->form_validation->set_rules('title', trans('title'), 'required');
            $this->form_validation->set_rules('years', trans('years'), 'required');
            $this->form_validation->set_rules('details', trans('details'), 'required');

            if ($this->form_validation->run() === false) {
                $this->session->set_flashdata('error', validation_errors());
                redirect(base_url('admin/educations'));
            } else {
                
                if(user()->role == 'staff'){$user_id = user()->user_id;}else{$user_id = user()->id;}

                $data=array(
                    'user_id' => $user_id,
                    'title' => $this->input->post('title', true),
                    'years' => $this->input->post('years', true),
                    'details' => $this->input->post('details', true)
                );
                $data = $this->security->xss_clean($data);
                
                //if id available info will be edited
                if ($id != '') {
                    $this->admin_model->edit_option($data, $id, 'educations');
                    $this->session->set_flashdata('msg', trans('updated-successfully')); 
                } else {
                    $id = $this->admin_model->insert($data, 'educations');
                    $this->session->set_flashdata('msg', trans('inserted-successfully')); 
                }
                redirect(base_url('admin/educations'));

            }
        }      
        
    }

    public function edit($id)
    {  
        $data = array();
        $data['page_title'] = 'Edit';   
        $data['education'] = $this->admin_model->select_option($id, 'educations');
        $data['main_content'] = $this->load->view('admin/user/profile/educations',$data,TRUE);
        $this->load->view('admin/index',$data);
    }

    
    public function active($id) 
    {
        $data = array(
            'status' => 1
        );
        $data = $this->security->xss_clean($data);
        $this->admin_model->update($data, $id,'drugs');
        $this->session->set_flashdata('msg', trans('activate-successfully')); 
        redirect(base_url('admin/drugs'));
    }

    public function deactive($id) 
    {
        $data = array(
            'status' => 0
        );
        $data = $this->security->xss_clean($data);
        $this->admin_model->update($data, $id,'drugs');
        $this->session->set_flashdata('msg', trans('deactivate-successfully')); 
        redirect(base_url('admin/drugs'));
    }

    public function delete($id)
    {
        $this->admin_model->delete($id,'educations'); 
        echo json_encode(array('st' => 1));
    }

}
	

