<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Patients extends Home_Controller {

    public function __construct()
    {
        parent::__construct();
        //check auth
        if (is_staff()) {
            if (check_staff_permissions('patients') != 1 ) {
                redirect(base_url('admin/dashboard/user'));
            }
            
        }
        if (!is_staff() && !is_user() && !is_patient()) {
            redirect(base_url());
        }
    }


    public function index()
    {
        $data = array();
        $data['page_title'] = 'Patients';      
        $data['page'] = 'patients';   
        $data['patients'] = FALSE;
        $data['patientses'] = $this->admin_model->select_by_chamber('patientses');
        $data['main_content'] = $this->load->view('admin/user/patients',$data,TRUE);
        $this->load->view('admin/index',$data);
    }

    public function appointments()
    {
        $data = array();
        $data['page_title'] = 'Appointments';
        $data['appointments'] = $this->admin_model->get_patient_appointments();
        $data['main_content'] = $this->load->view('admin/appointments/patient_lists',$data,TRUE);
        $this->load->view('admin/index',$data);
    }


    public function doctors()
    {

        $data = array();
        //initialize pagination
        $this->load->library('pagination');
        $config['base_url'] = base_url('admin/patients/doctors');
        $total_row = $this->admin_model->get_doctors_by_patient(1 , 0, 0);
        $config['total_rows'] = $total_row;
        $config['per_page'] = 18;
        $this->pagination->initialize($config);
        $page = $this->security->xss_clean($this->input->get('page'));
        if (empty($page)) {
            $page = 0;
        }
        if ($page != 0) {
            $page = $page - 1;
        }

        $data['page_title'] = 'Doctors';
        $data['page'] = 'Doctors';
        $data['prescription'] = $this->admin_model->get_doctors_by_patient(0 , $config['per_page'], $page * $config['per_page']);
        $data['main_content'] = $this->load->view('admin/user/doctors',$data,TRUE);
        $this->load->view('admin/index',$data);
    }


    public function prescriptions()
    {
        $data = array();

        //initialize pagination
        $this->load->library('pagination');
        $config['base_url'] = base_url('admin/patients/prescriptions');
        $total_row = $this->admin_model->get_prescription_by_patient(1 , 0, 0);
        $config['total_rows'] = $total_row;
        $config['per_page'] = 18;
        $this->pagination->initialize($config);
        $page = $this->security->xss_clean($this->input->get('page'));
        if (empty($page)) {
            $page = 0;
        }
        if ($page != 0) {
            $page = $page - 1;
        }

        $data['page_title'] = 'Prescription';
        $data['page'] = 'Prescription';
        $data['prescription'] = $this->admin_model->get_prescription_by_patient(0 , $config['per_page'], $page * $config['per_page']);
        $data['main_content'] = $this->load->view('admin/user/all_prescription',$data,TRUE);
        $this->load->view('admin/index',$data);
    }


    public function all_prescriptions($id)
    {
        $data = array();

        //initialize pagination
        $this->load->library('pagination');
        $config['base_url'] = base_url('admin/patients/prescriptions');
        $total_row = $this->admin_model->get_patient_history(1 , 0, 0, $id);
        $config['total_rows'] = $total_row;
        $config['per_page'] = 48;
        $this->pagination->initialize($config);
        $page = $this->security->xss_clean($this->input->get('page'));
        if (empty($page)) {
            $page = 0;
        }
        if ($page != 0) {
            $page = $page - 1;
        }

        $data['page_title'] = 'Prescription';
        $data['page'] = 'Prescription';
        $data['prescription'] = $this->admin_model->get_patient_history(0 , $config['per_page'], $page * $config['per_page'], $id);
        $data['main_content'] = $this->load->view('admin/user/all_prescription',$data,TRUE);
        $this->load->view('admin/index',$data);
    }


    public function prescription($id)
    {
        $data = array();
        $data['page_title'] = 'Prescription';
        $data['page'] = 'Prescription';
        $data['prescription'] = $this->admin_model->get_prescription($id);
        $data['drugs'] = $this->admin_model->get_user_prescription($id,'prescription_items');
        $data['pre_ad_advices'] = $this->admin_model->select_by_prescription_id($id,'pre_ad_advices');
        $data['pre_diagonosis'] = $this->admin_model->select_by_prescription_id($id,'pre_diagonosis');
        $data['pre_advice'] = $this->admin_model->select_by_prescription_id($id,'pre_advice');
        $data['pre_investigation'] = $this->admin_model->select_by_prescription_id($id,'pre_investigation');
        $data['appointments'] = $this->admin_model->select_by_prescription_id($id,'appointments');
        $data['appointment'] = $data['appointments'][0];
        $data['main_content'] = $this->load->view('admin/user/single_prescription',$data,TRUE);
        $this->load->view('admin/index',$data);
    }


    public function add_report($prescription_id)
    {   
        
        $tests = $this->admin_model->select_by_prescription_id($prescription_id,'pre_investigation');
        $prescription = $this->admin_model->get_by_id($prescription_id,'prescription');

        $pdata = array(
            'check_report' => 0
        );
        $pdata = $this->security->xss_clean($pdata);
        $this->admin_model->update($pdata, $prescription_id, 'prescription');


        $a=1;
        foreach ($tests as $value) {
            
            if(!empty($_FILES['files'.$a]['name'])){

                $filesCount = count($_FILES['files'.$a]['name']);
                
                for($i = 0; $i < $filesCount; $i++){
                    
                    $_FILES['file']['name']     = $_FILES['files'.$a]['name'][$i];
                    $_FILES['file']['type']     = $_FILES['files'.$a]['type'][$i];
                    $_FILES['file']['tmp_name'] = $_FILES['files'.$a]['tmp_name'][$i];
                    $_FILES['file']['error']    = $_FILES['files'.$a]['error'][$i];
                    $_FILES['file']['size']     = $_FILES['files'.$a]['size'][$i];
                    
                    $new_name = "reports_".time().strtolower(uniqid().'.'.pathinfo($_FILES['files'.$a]['name'][$i], PATHINFO_EXTENSION));
                    //echo $_FILES['files'.$a]['name'][$i]; exit();

                    // File upload configuration
                    $uploadPath = 'uploads/files/';
                    $config['upload_path'] = $uploadPath;
                    $config['file_name'] = $new_name;
                    $config['allowed_types'] = 'jpg|jpeg|png|gif';
                    
                    // Load and initialize upload library
                    $this->load->library('upload', $config);
                    $this->upload->initialize($config);
                    $this->load->library('image_lib');

                    // Upload file to server
                    if($this->upload->do_upload('file')){

                        // resize image
                        $image_data =   $this->upload->data();
                        $configer =  array(
                          'image_library'   => 'gd2',
                          'source_image'    =>  $image_data['full_path'],
                          'maintain_ratio'  =>  TRUE,
                          'width'           =>  1200,
                          'height'          =>  1000,
                        );
                        $this->image_lib->clear();
                        $this->image_lib->initialize($configer);
                        $this->image_lib->resize();

                    
                        $data = array(
                            'user_id' => $prescription->user_id,
                            'patient_id' => $prescription->patient_id,
                            'prescription_id' => $prescription_id,
                            'diagnosis_id' => $value['investigation_id'],
                            'file' => 'uploads/files/'.$new_name,
                            'status' => 0,
                            'created_at' => my_date_now()
                        );
                        $data = $this->security->xss_clean($data);
                        $this->common_model->insert($data, 'diagnosis_reports');
                    }
                }
                
            }

        $a++;   
        }

        $this->session->set_flashdata('msg', trans('inserted-successfully'));
        redirect($_SERVER['HTTP_REFERER']);
       
    }


    public function live_consults()
    {
        $data = array();
        $data['page_title'] = 'Live consults';  
        $data['consults'] = $this->admin_model->get_patient_live_consults();
        $data['main_content'] = $this->load->view('admin/user/patient_consult_lists',$data,TRUE);
        $this->load->view('admin/index',$data);
    }


    public function add()
    {	
        if($_POST)
        {   

            $id = $this->input->post('id', true);

            $check = $this->admin_model->check_duplicate_email($this->input->post('email', true));

            if (!empty($check) && $id == '') {
                $this->session->set_flashdata('error', trans('email-exist'));
                redirect(base_url('admin/patients'));
            }

            //validate inputs
            $this->form_validation->set_rules('name', trans('name'), 'required|max_length[100]');
            $this->form_validation->set_rules('mobile', trans('phone'), 'required');

            if ($this->form_validation->run() === false) {
                $this->session->set_flashdata('error', validation_errors());
                redirect(base_url('admin/patients'));
            } else {
                
                if(user()->role == 'staff'){$user_id = user()->user_id;}else{$user_id = user()->id;}

                $patient = $this->admin_model->get_by_id($id, 'patientses');
                if($id != ''){$password = $patient->password;}else{$password = hash_password('1234');}

                $data=array(
                    'chamber_id' => $this->chamber->uid,
                    'user_id' => $user_id,
                    'name' => $this->input->post('name', true),
                    'email' => $this->input->post('email', true),
                    'mr_number' => random_string('numeric',5),
                    'age' => $this->input->post('age', true),
                    'weight' => $this->input->post('weight', true),
                    'sex' => $this->input->post('sex', true),
                    'mobile' => $this->input->post('mobile', true),
                    'password' => $password,
                    'present_address' => $this->input->post('present_address', true),
                    'permanent_address' => $this->input->post('permanent_address', true),
                    'created_at' => my_date_now()
                );
                $data = $this->security->xss_clean($data);
                
                //if id available info will be edited
                if ($id != '') {
                    $this->admin_model->edit_option($data, $id, 'patientses');
                    $this->session->set_flashdata('msg', trans('updated-successfully')); 
                } else {

                    $total = get_total_value('patientses');
                    if (ckeck_plan_limit('patients', $total) == FALSE) {
                        $this->session->set_flashdata('error', trans('reached-maximum-limit'));
                        redirect(base_url('admin/patients'));
                        exit();
                    }
            
                    $id = $this->admin_model->insert($data, 'patientses');

                    $subject = 'Welcome to '.$this->settings->site_name;
                    $msg = 'Your account has been created successfully, now you can login to your account using below access <br> Username:'.$this->input->post('email').' , and Password: 1234';
                    $this->email_model->send_email($this->input->post('email'), $subject, $msg);

                    
                    $this->session->set_flashdata('msg', trans('activate-successfully')); 
                }
                redirect(base_url('admin/patients'));

            }
        }      
        
    }


    // add patient from prescription
    public function add_pateint()
    {   
        if($_POST)
        {   

            $check = $this->admin_model->check_duplicate_email($this->input->post('email'));
            if (!empty($check)) {
                echo json_encode(array('st'=>0,'msg'=> trans('email-exist')));
                exit();
            }

            //validate inputs
            $this->form_validation->set_rules('name', trans('name'), 'required');
            $this->form_validation->set_rules('mobile', trans('phone'), 'required');

            if ($this->form_validation->run() === false) {
                 echo json_encode(array('st'=>0,'msg'=>validation_errors()));
            } else {

                $patients = $this->admin_model->select_by_chamber('patientses');
                if (ckeck_plan_limit('patients', count($patients)) == FALSE) {
                    echo json_encode(array('st'=>0,'msg'=> trans('reached-maximum-limit')));
                    exit();
                }
               
                $data=array(
                    'chamber_id' => $this->chamber->uid,
                    'user_id' => user()->id,
                    'name' => $this->input->post('name', true),
                    'email' => $this->input->post('email', true),
                    'mr_number' => random_string('numeric',5),
                    'age' => $this->input->post('age', true),
                    'weight' => $this->input->post('weight', true),
                    'sex' => $this->input->post('sex', true),
                    'mobile' => $this->input->post('mobile', true),
                    'password' => hash_password('1234'),
                    'present_address' => $this->input->post('present_address', true),
                    'permanent_address' => $this->input->post('permanent_address', true),
                    'created_at' => my_date_now()
                );
                $data = $this->security->xss_clean($data);
                $insert = $this->admin_model->insert($data, 'patientses');
            
                if ($insert) {
                    echo json_encode(array('st'=>1,'msg'=> trans('inserted-successfully')));
                } else {
                    echo json_encode(array('st'=>0,'msg'=> trans('something-wrong')));
                }

            }
        }      
        
    }


    //change password
    public function change()
    {   
        if($_POST){
            
            $id = user()->id;
            $user = $this->admin_model->get_by_id($id, 'patientses');

            if(password_verify($this->input->post('old_pass', true), $user->password)){
                if ($this->input->post('new_pass', true) == $this->input->post('confirm_pass', true)) {
                    $data=array(
                        'password' => hash_password($this->input->post('new_pass', true))
                    );
                    $data = $this->security->xss_clean($data);
                    $this->admin_model->edit_option($data, $id, 'patientses');
                    echo json_encode(array('st'=>1));
                } else {
                    echo json_encode(array('st'=>2));
                }
            } else {
                echo json_encode(array('st'=>0));
            }
        }
    }


    public function edit($id)
    {  
        $data = array();
        $data['page_title'] = 'Edit';   
        $data['patients'] = $this->admin_model->select_option($id, 'patientses');
        $data['main_content'] = $this->load->view('admin/user/patients',$data,TRUE);
        $this->load->view('admin/index',$data);
    }

    
    public function active($id) 
    {
        $data = array(
            'status' => 1
        );
        $data = $this->security->xss_clean($data);
        $this->admin_model->update($data, $id,'patientses');
        $this->session->set_flashdata('msg', trans('activate-successfully')); 
        redirect(base_url('admin/patients'));
    }

    public function add_rating() 
    {
        if ($_POST) {
           
            $data = array(
                'user_id' => $this->input->post('user_id'),
                'patient_id' => $this->input->post('patient_id'),
                'rating' => $this->input->post('rating'),
                'feedback' => $this->input->post('feedback'),
                'created_at' => my_date_now()
            );
            $data = $this->security->xss_clean($data);
            $this->admin_model->insert($data, 'ratings');
            $this->session->set_flashdata('msg', trans('inserted-successfully')); 
            redirect(base_url('admin/patients/doctors'));

        }
    }

    public function deactive($id) 
    {
        $data = array(
            'status' => 0
        );
        $data = $this->security->xss_clean($data);
        $this->admin_model->update($data, $id,'patientses');
        $this->session->set_flashdata('msg', trans('deactivate-successfully')); 
        redirect(base_url('admin/patients'));
    }

    public function delete($id)
    {
        $this->admin_model->delete($id,'patientses'); 
        echo json_encode(array('st' => 1));
    }


    public function submit_report_feedback($id) 
    {
        $data = array(
            'check_report' => 1,
            'feedback' => $this->input->post('feedback')
        );
        $data = $this->security->xss_clean($data);
        $this->admin_model->update($data, $id,'prescription');
        $this->session->set_flashdata('msg', trans('summited-successfully')); 
        redirect($_SERVER['HTTP_REFERER']);
    }

    //delete image
    public function delete_report($id)
    {   

        $report = $this->common_model->get_by_id($id, 'diagnosis_reports');
        delete_image_from_server($report->file);
        $this->common_model->delete($report->id, 'diagnosis_reports');
        echo json_encode(array('st' => 1));
    }


}
	

