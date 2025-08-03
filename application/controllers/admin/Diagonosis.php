<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Diagonosis extends Home_Controller {

    public function __construct()
    {
        parent::__construct();
        //check auth
        if (is_staff()) {
            if (check_staff_permissions('prescription-settings') != 1 ) {
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
        $data['page_title'] = 'Diagonosis';       
        $data['page'] = 'Prescription Settings';   
        $data['diagonosis'] = FALSE;
        $data['diagonosises'] = $this->admin_model->select_by_user('diagonosis');
        $data['main_content'] = $this->load->view('admin/user/diagonosis',$data,TRUE);
        $this->load->view('admin/index',$data);
    }


    public function add()
    {	
        if($_POST)
        {   
            $id = $this->input->post('id', true);

            //validate inputs
            $this->form_validation->set_rules('name', trans('name'), 'required');

            if ($this->form_validation->run() === false) {
                $this->session->set_flashdata('error', validation_errors());
                redirect(base_url('admin/diagonosis'));
            } else {

                if(user()->role == 'staff'){$user_id = user()->user_id;}else{$user_id = user()->id;}
                $data=array(
                    'user_id' => $user_id,
                    'name' => $this->input->post('name', true),
                    'details' => $this->input->post('details', true)
                );
                $data = $this->security->xss_clean($data);
                
                //if id available info will be edited
                if ($id != '') {
                    $this->admin_model->edit_option($data, $id, 'diagonosis');
                    $this->session->set_flashdata('msg', trans('updated-successfully')); 
                } else {
                    $id = $this->admin_model->insert($data, 'diagonosis');
                    $this->session->set_flashdata('msg', trans('inserted-successfully')); 
                }
                redirect(base_url('admin/diagonosis'));

            }
        }      
        
    }

    public function edit($id)
    {  
        $data = array();    
        $data['page'] = 'Prescription Settings';   
        $data['page_title'] = 'Edit';   
        $data['diagonosis'] = $this->admin_model->select_option($id, 'diagonosis');
        $data['main_content'] = $this->load->view('admin/user/diagonosis',$data,TRUE);
        $this->load->view('admin/index',$data);
    }

    
    public function active($id) 
    {
        $data = array(
            'status' => 1
        );
        $data = $this->security->xss_clean($data);
        $this->admin_model->update($data, $id,'diagonosis');
        $this->session->set_flashdata('msg', trans('activate-successfully')); 
        redirect(base_url('admin/diagonosis'));
    }

    public function deactive($id) 
    {
        $data = array(
            'status' => 0
        );
        $data = $this->security->xss_clean($data);
        $this->admin_model->update($data, $id,'diagonosis');
        $this->session->set_flashdata('msg', trans('deactivate-successfully')); 
        redirect(base_url('admin/diagonosis'));
    }

    public function delete($id)
    {
        $this->admin_model->delete($id,'diagonosis'); 
        echo json_encode(array('st' => 1));
    }

}
	

