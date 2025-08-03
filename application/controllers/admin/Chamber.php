<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Chamber extends Home_Controller {

	public function __construct()
    {
        parent::__construct();
        //check auth
        if (!is_user() && !is_staff()) {
            redirect(base_url());
        }
    }

    public function index()
    {

        $data = array();
        $data['page_title'] = 'Chambers';
        $data['page'] = 'Chamber';
        $data['chamber'] = FALSE;
        $data['chambers'] = $this->admin_model->get_chamber(0);
        $data['total'] = (is_array($data['chamber'])) ? count($data['chamber']) : 0;
        $data['categories'] = $this->admin_model->select_asc('chamber_category');
        $data['main_content'] = $this->load->view('admin/user/chamber',$data,TRUE);
        $this->load->view('admin/index',$data);
    }

    //switch chamber
    public function switch_chamber($chamber = "")
    {   
        $chamber = ($chamber != "") ? $chamber : $this->chamber->uid;
        $active_chamber = array('active_chamber' => $chamber);
        $this->session->set_userdata($active_chamber);
        redirect(base_url('admin/dashboard/user'));
    }


    public function add()
    {   
        if($_POST)
        {   
            check_status();

            $id = $this->input->post('id', true);

            //validate inputs
            $this->form_validation->set_rules('name', trans('name'), 'required');

            if ($this->form_validation->run() === false) {
                $this->session->set_flashdata('error', validation_errors());
                redirect(base_url('admin/chamber'));
            } else {

                if ($id != '') {
                    $chamber = $this->admin_model->get_single_chamber($id);
                    $uid = $chamber[0]['uid'];
                }else{
                    $uid = random_string('numeric',5);
                }

                $data=array(
                    'user_id' => user()->id,
                    'uid' => $uid,
                    'title' => $this->input->post('title', true),
                    'appoinment_limit' => $this->input->post('appoinment_limit', true),
                    'name' => $this->input->post('name', true),
                    'address' => $this->input->post('address', true),
                    'category' => $this->input->post('category', true),
                    'status' => 1,
                    'created_at' => my_date_now()
                );
                $data = $this->security->xss_clean($data);
                if ($id != '') {
                    $this->admin_model->edit_option($data, $id, 'chamber');
                    $this->session->set_flashdata('msg', trans('inserted-successfully')); 
                } else {

                    $total = get_total_value('chamber');
                    if (ckeck_plan_limit('chambers', $total) == FALSE) {
                        $this->session->set_flashdata('error', trans('reached-maximum-limit'));
                        redirect(base_url('admin/chamber'));
                        exit();
                    }
            
                    $id = $this->admin_model->insert($data, 'chamber');
                    $this->session->set_flashdata('msg', trans('inserted-successfully')); 
                }

                // upload logo
                $data_img = $this->admin_model->do_upload('photo1');
                if($data_img){
                    $data_img = array(
                        'logo' => $data_img['medium']
                    );
                    $this->admin_model->edit_option($data_img, $id, 'chamber'); 
                 }

                redirect(base_url('admin/chamber'));
            }
        }      
        
    }


    public function edit($id)
    {  
        $data = array();
        $data['page_title'] = 'Edit';   
        $data['page'] = 'chamber';
        $data['categories'] = $this->admin_model->select_asc('chamber_category');
        $data['chamber'] = $this->admin_model->get_single_chamber_md5($id);
        $data['main_content'] = $this->load->view('admin/user/chamber',$data,TRUE);
        $this->load->view('admin/index',$data);
    }


    public function set_primary($id) 
    {
        check_status();

        $chamber = $this->admin_model->get_primary_chamber();
        if (!empty($chamber)) {
            $udata = array(
                'is_primary' => 0
            );
            $this->admin_model->update($udata, $chamber->id,'chamber');
        }

        $data = array(
            'is_primary' => 1
        );
        $data = $this->security->xss_clean($data);
        $this->admin_model->update($data, $id,'chamber');
        echo json_encode(array('st' => 1));
    }


    public function invoice_customize() 
    {
        if($_POST)
        {   
            $data = array(
                'template_style' => $this->input->post('template_style', true),
                'color' => $this->input->post('color', true),
                'footer_note' => $this->input->post('footer_note')
            );
            $this->admin_model->update($data, $this->chamber->id, 'chamber');
            $this->session->set_flashdata('msg', trans('msg-updated')); 
            redirect($_SERVER['HTTP_REFERER']);
        }
        $data = array();
        $data['page_title'] = 'Invoice Customization';   
        $data['page'] = 'Invoice';   
        $data['chamber'] = $this->admin_model->get_chamber(0);
        $data['main_content'] = $this->load->view('admin/user/invoice_customize',$data,TRUE);
        $this->load->view('admin/index',$data);
    }


    public function categories()
    {  
        $data = array();
        $data['page_title'] = 'Categories';   
        $data['page'] = 'chamber';
        $data['category'] = FALSE;
        $data['categories'] = $this->admin_model->select('chamber_category');
        $data['main_content'] = $this->load->view('admin/user/chamber_category',$data,TRUE);
        $this->load->view('admin/index',$data);
    }


    public function add_category()
    {   
        if($_POST)
        {   

            check_status();
            
            $id = $this->input->post('id', true);

            //validate inputs
            $this->form_validation->set_rules('name', trans('name'), 'required');

            if ($this->form_validation->run() === false) {
                $this->session->set_flashdata('errors', validation_errors());
                redirect(base_url('admin/chamber/categories'));
            } else {
                $data=array(
                    'name' => $this->input->post('name', true)
                );
                $data = $this->security->xss_clean($data);
                if ($id != '') {
                    $this->admin_model->edit_option($data, $id, 'chamber_category');
                    $this->session->set_flashdata('msg', trans('updated-successfully')); 
                } else {
                    $id = $this->admin_model->insert($data, 'chamber_category');
                    $this->session->set_flashdata('msg', trans('inserted-successfully')); 
                }

                // upload logo
                $data_img = $this->admin_model->do_upload('photo1');
                if($data_img){
                    $data_img = array(
                        'logo' => $data_img['medium']
                    );
                    $this->admin_model->edit_option($data_img, $id, 'chamber'); 
                 }

                redirect(base_url('admin/chamber/categories'));
            }
        }      
        
    }


    public function edit_category($id)
    {  
        $data = array();
        $data['page_title'] = 'Edit';   
        $data['page'] = 'chamber';
        $data['category'] = $this->admin_model->select_option($id, 'chamber_category');
        $data['main_content'] = $this->load->view('admin/user/chamber_category',$data,TRUE);
        $this->load->view('admin/index',$data);
    }

  

    
    public function active($id) 
    {
        $data = array(
            'status' => 1
        );
        $data = $this->security->xss_clean($data);
        $this->admin_model->update($data, $id,'chamber');
        $this->session->set_flashdata('msg', trans('activate-successfully')); 
        redirect(base_url('admin/chamber'));
    }

    public function deactive($id) 
    {
        $data = array(
            'status' => 0
        );
        $data = $this->security->xss_clean($data);
        $this->admin_model->update($data, $id,'chamber');
        $this->session->set_flashdata('msg', trans('deactivate-successfully')); 
        redirect(base_url('admin/chamber'));
    }

    public function delete($id)
    {
        $this->admin_model->delete($id,'chamber'); 
        echo json_encode(array('st' => 1));
    }

    public function delete_category($id)
    {
        $this->admin_model->delete($id,'chamber_category'); 
        echo json_encode(array('st' => 1));
    }


}