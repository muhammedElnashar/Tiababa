<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Services extends Home_Controller {

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
        $data['page_title'] = 'Service';      
        $data['page'] = 'Service';   
        $data['service'] = FALSE;
        $data['services'] = $this->admin_model->select('product_services');
        $data['main_content'] = $this->load->view('admin/product_service',$data,TRUE);
        $this->load->view('admin/index',$data);
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
                redirect(base_url('admin/services'));
            } else {

                if (empty($this->input->post('orders'))) {
                    $orders = 0;
                }else{
                    $orders = $this->input->post('orders');
                }

                $data=array(
                    'name' => $this->input->post('name', true),
                    'orders' => $orders,
                    'details' => $this->input->post('details', true)
                );
                $data = $this->security->xss_clean($data);
                
                //if id available info will be edited
                if ($id != '') {
                    $this->admin_model->edit_option($data, $id, 'product_services');
                    $this->session->set_flashdata('msg', trans('updated-successfully')); 
                } else {
                    $id = $this->admin_model->insert($data, 'product_services');
                    $this->session->set_flashdata('msg', trans('inserted-successfully')); 
                }

                // insert photos
                if($_FILES['photo']['name'] != ''){
                    $up_load = $this->admin_model->upload_image('600');
                    $data_img = array(
                        'image' => $up_load['images'],
                        'thumb' => $up_load['thumb']
                    );
                    $this->admin_model->edit_option($data_img, $id, 'product_services');   
                }
                redirect(base_url('admin/services'));

            }
        }      
        
    }

    public function edit($id)
    {  
        $data = array();
        $data['page_title'] = 'Edit';   
        $data['service'] = $this->admin_model->select_option($id, 'product_services');
        $data['main_content'] = $this->load->view('admin/product_service',$data,TRUE);
        $this->load->view('admin/index',$data);
    }

    
    public function active($id) 
    {
        $data = array(
            'status' => 1
        );
        $data = $this->security->xss_clean($data);
        $this->admin_model->update($data, $id,'product_services');
        $this->session->set_flashdata('msg', trans('activate-successfully')); 
        redirect(base_url('admin/services'));
    }

    public function deactive($id) 
    {
        $data = array(
            'status' => 0
        );
        $data = $this->security->xss_clean($data);
        $this->admin_model->update($data, $id,'product_services');
        $this->session->set_flashdata('msg', trans('deactivate-successfully')); 
        redirect(base_url('admin/services'));
    }

    public function delete($id)
    {
        $this->admin_model->delete($id,'product_services'); 
        echo json_encode(array('st' => 1));
    }

    public function category()
    {
        $data = array();
        $data['page_title'] = 'Service Category';      
        $data['page'] = 'Service';   
        $data['category'] = FALSE;
        $data['categories'] = $this->admin_model->get_services_categories();
        $data['main_content'] = $this->load->view('admin/user/service_category',$data,TRUE);
        $this->load->view('admin/index',$data);
    }

     public function category_add()
    {   
        if($_POST)
        {   
            check_status();
            
            $id = $this->input->post('id', true);

            //validate inputs
            $this->form_validation->set_rules('name', trans('name'), 'required');

            
            if ($this->form_validation->run() === false) {
                $this->session->set_flashdata('error', validation_errors());
                
            } else {
               
                $data=array(
                    'name' => $this->input->post('name', true),
                    'slug' => str_slug(trim($this->input->post('name', true))),
                    'user_id' => $this->session->userdata('id'),
                    'status' => 1,
                    'created_at' => my_date_now(),
                );
                $data = $this->security->xss_clean($data);
                
                //if id available info will be edited
                if ($id != '') {
                    $this->admin_model->edit_option($data, $id, 'service_category');
                    $this->session->set_flashdata('msg', trans('updated-successfully')); 
                } else {
                    $id = $this->admin_model->insert($data, 'service_category');
                    $this->session->set_flashdata('msg', trans('inserted-successfully')); 
                }
                redirect(base_url('admin/services/category'));

            }
        }      
        
    }


    public function category_edit($id)
    {  
        $data = array();
        $data['page_title'] = 'Edit';   
        $data['category'] = $this->admin_model->select_option($id, 'service_category');
        $data['main_content'] = $this->load->view('admin/user/service_category',$data,TRUE);
        $this->load->view('admin/index',$data);
    }

    
    public function category_active($id) 
    {
        $data = array(
            'status' => 1
        );
        $data = $this->security->xss_clean($data);
        $this->admin_model->update($data, $id,'service_category');
        $this->session->set_flashdata('msg', trans('activate-successfully')); 
        redirect(base_url('admin/services/category'));
    }

    public function category_deactive($id) 
    {
        $data = array(
            'status' => 0
        );
        $data = $this->security->xss_clean($data);
        $this->admin_model->update($data, $id,'service_category');
        $this->session->set_flashdata('msg', trans('deactivate-successfully')); 
        redirect(base_url('admin/services/category'));
    }

    public function category_delete($id)
    {
        $this->admin_model->delete($id,'service_category'); 
        echo json_encode(array('st' => 1));
    }

    public function user()
    {
        $data = array();
        $data['page_title'] = 'User Service';      
        $data['page'] = 'Service';   
        $data['service'] = FALSE;
        $data['categories'] = $this->admin_model->get_services_categories();
        $data['services'] = $this->admin_model->get_all_services_by_user('services');
        $data['main_content'] = $this->load->view('admin/user/services',$data,TRUE);
        $this->load->view('admin/index',$data);
    }

    public function service_add()
    {   
        if($_POST)
        {   

            check_status();
            
            $id = $this->input->post('id', true);

            //validate inputs
            $this->form_validation->set_rules('title', trans('name'), 'required');
            
            if ($this->form_validation->run() === false) {
                $this->session->set_flashdata('error', validation_errors());
                redirect(base_url('admin/services'));
            } else {

               

                $data=array(
                    'user_id' => $this->session->userdata('id'),
                    'title' => $this->input->post('title', true),
                    'slug' => str_slug(trim($this->input->post('title', true))),
                    'category' => $this->input->post('category', true),
                    'price' => $this->input->post('price', true),
                    'details' => $this->input->post('details', true),
                    'status' => $this->input->post('status', true),
                    'created_at' => my_date_now(),
                );
                $data = $this->security->xss_clean($data);
                
                //if id available info will be edited
                if ($id != '') {
                    $this->admin_model->edit_option($data, $id, 'services');
                    $this->session->set_flashdata('msg', trans('updated-successfully')); 
                } else {
                    $id = $this->admin_model->insert($data, 'services');
                    $this->session->set_flashdata('msg', trans('inserted-successfully')); 
                }

                // insert photos
                if($_FILES['photo']['name'] != ''){
                    $up_load = $this->admin_model->upload_image('600');
                    $data_img = array(
                        'image' => $up_load['images'],
                        'thumb' => $up_load['thumb']
                    );
                    $this->admin_model->edit_option($data_img, $id, 'services');   
                }
                redirect(base_url('admin/services/user'));

            }
        }      
        
    }

     public function service_edit($id)
    {  
        $data = array();
        $data['page_title'] = 'Edit';
        $data['categories'] = $this->admin_model->get_services_categories();   
        $data['service'] = $this->admin_model->select_option($id, 'services');
        $data['main_content'] = $this->load->view('admin/user/services',$data,TRUE);
        $this->load->view('admin/index',$data);
    }

    public function service_delete($id)
    {
        $this->admin_model->delete($id,'services'); 
        echo json_encode(array('st' => 1));
    }


}
	

