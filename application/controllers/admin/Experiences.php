<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Experiences extends Home_Controller {

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
        $data = array();
        $data['page_title'] = 'Experience';      
        $data['page'] = 'Experience';   
        $data['experience'] = FALSE;
        $data['experiences'] = $this->admin_model->select_by_user('experiences');
        $data['main_content'] = $this->load->view('admin/user/profile/experiences',$data,TRUE);
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
                redirect(base_url('admin/experiences'));
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
                    $this->admin_model->edit_option($data, $id, 'experiences');
                    $this->session->set_flashdata('msg', trans('updated-successfully')); 
                } else {
                    $id = $this->admin_model->insert($data, 'experiences');
                    $this->session->set_flashdata('msg', trans('inserted-successfully')); 
                }
                redirect(base_url('admin/experiences'));

            }
        }      
        
    }

    public function edit($id)
    {  
        $data = array();
        $data['page_title'] = 'Edit';   
        $data['experience'] = $this->admin_model->select_option($id, 'experiences');
        $data['main_content'] = $this->load->view('admin/user/profile/experiences',$data,TRUE);
        $this->load->view('admin/index',$data);
    }

    
    public function active($id) 
    {
        $data = array(
            'status' => 1
        );
        $data = $this->security->xss_clean($data);
        $this->admin_model->update($data, $id,'experiences');
        $this->session->set_flashdata('msg', trans('activate-successfully')); 
        redirect(base_url('admin/experiences'));
    }

    public function deactive($id) 
    {
        $data = array(
            'status' => 0
        );
        $data = $this->security->xss_clean($data);
        $this->admin_model->update($data, $id,'experiences');
        $this->session->set_flashdata('msg', trans('deactivate-successfully')); 
        redirect(base_url('admin/experiences'));
    }

    public function delete($id)
    {
        $this->admin_model->delete($id,'experiences'); 
        echo json_encode(array('st' => 1));
    }

}
	

