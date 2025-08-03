<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Workflow extends Home_Controller {

    public function __construct()
    {
        parent::__construct();
        //check auth
        if (!is_admin() && !is_user()) {
            redirect(base_url());
        }
    }


    public function index()
    {
        $data = array();
        $data['page_title'] = 'Workflow';      
        $data['page'] = 'Workflow';   
        $data['workflow'] = FALSE;
        $data['workflows'] = $this->admin_model->select_asc('workflow');
        $data['main_content'] = $this->load->view('admin/workflow',$data,TRUE);
        $this->load->view('admin/index',$data);
    }


    public function add()
    {	
        if($_POST)
        {   

            check_status();
            
            $id = $this->input->post('id', true);

            //validate inputs
            $this->form_validation->set_rules('title', trans('title'), 'required');

            if ($this->form_validation->run() === false) {
                $this->session->set_flashdata('error', validation_errors());
                redirect(base_url('admin/workflow'));
            } else {
               
                $data=array(
                    'title' => $this->input->post('title', true),
                    'details' => $this->input->post('details', true)
                );
                $data = $this->security->xss_clean($data);
                
                //if id available info will be edited
                if ($id != '') {
                    $this->admin_model->edit_option($data, $id, 'workflow');
                    $this->session->set_flashdata('msg', trans('updated-successfully')); 
                } else {
                    $id = $this->admin_model->insert($data, 'workflow');
                    $this->session->set_flashdata('msg', trans('inserted-successfully')); 
                }

                // insert photos
                if($_FILES['photo']['name'] != ''){
                    $up_load = $this->admin_model->upload_image('800');
                    $data_img = array(
                        'image' => $up_load['images']
                    );
                    $this->admin_model->edit_option($data_img, $id, 'workflow');   
                }

                redirect(base_url('admin/workflow'));

            }
        }      
        
    }

    public function edit($id)
    {  
        $data = array();
        $data['page_title'] = 'Edit';   
        $data['workflow'] = $this->admin_model->select_option($id, 'workflow');
        $data['main_content'] = $this->load->view('admin/workflow',$data,TRUE);
        $this->load->view('admin/index',$data);
    }


}
	

