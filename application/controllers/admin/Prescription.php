<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Prescription extends Home_Controller {

    public function __construct()
    {
        parent::__construct();
        //check auth
        if (is_staff()) {
            if (check_staff_permissions('prescription') != 1 ) {
                redirect(base_url('admin/dashboard/user'));
            }
            
        }
        if (!is_admin() && !is_user() && !is_staff()) {
            redirect(base_url());
        }
    }

    public function index(){
        $this->add_prescription();
    }


    public function add_prescription()
    {
        $data = array();
        $data['page_title'] = 'Prescription';
        $data['page'] = 'Prescription';
        $data['page_sub'] = 'Create';
        $data['diagonosises'] = $this->admin_model->select_by_user('diagonosis');
        $data['additional_adviseses'] = $this->admin_model->select_by_user('additional_advises');
        $data['adviseses'] = $this->admin_model->select_by_user('advises');
        $data['advise_investigations'] = $this->admin_model->select_by_user('advise_investigations');
        $data['drugs'] = $this->admin_model->get_drugs('drugs');
        $data['patients'] = $this->admin_model->select_by_chamber('patientses');
        $data['user'] = $this->admin_model->get_user_info();
        if(isset($_GET['p_id'])){
            $id =  $_GET['p_id'];
            $data['patient'] = $this->admin_model->get_patient_info($id);
        }else{
           $data['patient']=FALSE;  
        }

        if (isset($_GET['patient_id']) ) {
            $data['patient_id'] = $_GET['patient_id'];
            $data['appoinment_id'] = $_GET['appointment'];
        }else{
            $data['patient_id'] = 0;
            $data['appoinment_id'] = 0;
        }

        $total = get_total_value('prescription');
        if (ckeck_plan_limit('prescription', $total) == FALSE) {
            $this->session->set_flashdata('error', trans('reached-maximum-limit'));
            redirect(base_url('admin/prescription/all_prescription'));
            exit();
        }

        $data['main_content'] = $this->load->view('admin/user/prescription',$data,TRUE);
        $this->load->view('admin/index',$data);
    }



    public function all_prescription()
    {
        $data = array();
        //initialize pagination
        $this->load->library('pagination');
        $config['base_url'] = base_url('admin/prescription/all_prescription');
        $total_row = $this->admin_model->get_prescription_by_user(1 , 0, 0);
        $config['total_rows'] = $total_row;
        $config['per_page'] = 12;
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
        $data['prescription'] = $this->admin_model->get_prescription_by_user(0 , $config['per_page'], $page * $config['per_page']);
        $data['main_content'] = $this->load->view('admin/user/all_prescription',$data,TRUE);
        $this->load->view('admin/index',$data);
    }


    public function single_prescription($id)
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
        $data['main_content'] = $this->load->view('admin/user/single_prescription',$data,TRUE);
        $this->load->view('admin/index',$data);
    }


    public function edit($type, $id)
    {
        $data = array();
        $data['page_title'] = 'Edit Prescription';
        $data['page'] = 'Prescription';
        $data['page_sub'] = 'Edit';
        $data['type'] = $type;
        $data['patients'] = $this->admin_model->select_by_chamber('patientses');
        $data['prescription'] = $this->admin_model->get_prescription($id);
        $data['drugs'] = $this->admin_model->get_drugs('drugs');
        $data['pre_items'] = $this->admin_model->get_user_prescription($id,'prescription_items');
        $data['pre_ad_advices'] = $this->admin_model->select_by_prescription_id($id,'pre_ad_advices');
        $data['pre_diagonosis'] = $this->admin_model->select_by_prescription_id($id,'pre_diagonosis');
        $data['pre_advice'] = $this->admin_model->select_by_prescription_id($id,'pre_advice');
        $data['pre_investigation'] = $this->admin_model->select_by_prescription_id($id,'pre_investigation');
        $data['diagonosises'] = $this->admin_model->select_by_user('diagonosis');
        $data['additional_adviseses'] = $this->admin_model->select_by_user('additional_advises');
        $data['adviseses'] = $this->admin_model->select_by_user('advises');
        $data['advise_investigations'] = $this->admin_model->select_by_user('advise_investigations');
        $data['main_content'] = $this->load->view('admin/user/edit_prescription',$data,TRUE);
        $this->load->view('admin/index',$data);
    }

    

    public function preview()
    {   

        $remove_session = array(
            'diagonosis' => false,
            'ad_advices' => false,
            'advice' => false,
            'investigation' => false,
            'patient_id' => false,
            'drugs' => false,
        );
        $this->session->set_userdata($remove_session); 
        $this->session->set_userdata('prescription_id', $this->input->post('prescription_id')); 
        $this->session->set_userdata('appoinment_id', $this->input->post('appoinment_id')); 
        $this->session->set_userdata('old_items', $this->input->post('old_items')); 
      
        if ($this->input->post('prescription_id') == 0) {
            $this->session->set_userdata('prescription_date', date('Y-m-d')); 
        } else {
            $prescription = $this->admin_model->get_prescription_by_id($this->input->post('prescription_id'));
            $this->session->set_userdata('prescription_date', $prescription->created_at); 
        }
        
        $diagonosis =  $this->input->post('diagonosis', true);
        $ad_advices =  $this->input->post('ad_advices', true);
        $advice =  $this->input->post('advice');
        $investigation =  $this->input->post('investigation', true);
        $hide =  $this->input->post('hide', true);
        $drugs =  $this->input->post('drugs', true);

        if(isset($diagonosis) && !empty($diagonosis)):
             $i=0;
             foreach ($diagonosis as $value_1) {
                 $data_1[] = array(
                    'diagonosis_id' => $value_1,
                 );
                $i++; 
             }
              $this->session->set_userdata('diagonosis', $data_1);
        endif;

        if(isset($ad_advices) && !empty($ad_advices)):
             $j=0;
             foreach ($ad_advices as $value_2) {
                 $data_2[] = array(
                    'ad_advices_id' => $value_2,
                 );
                $j++; 
             }
              $this->session->set_userdata('ad_advices', $data_2);
        endif;


        if(isset($advice) && !empty($advice)):
             $k=0;
             foreach ($advice as $value_3) {
                 $data_3[] = array(
                    'advice_id' => $value_3,
                 );
                $k++; 
             }
              $this->session->set_userdata('advice', $data_3);
        endif;

        if(isset($investigation) && !empty($investigation)):
             $l=0;
             foreach ($investigation as $value_4) {
                 $data_4[] = array(
                    'investigation_id' => $value_4,
                 );
                $l++; 
             }
              $this->session->set_userdata('investigation', $data_4);
        endif;

        if (!empty($this->input->post('next_duration')) && !empty($this->input->post('next_time'))) {
            $this->session->set_userdata('next_visit', $this->input->post('next_duration').' '.$this->input->post('next_time').' later');
        }else{
            $this->session->set_userdata('next_visit', '');
        }


        $this->session->set_userdata('follow_up', $this->input->post('follow_up')); 
        $this->session->set_userdata('notes', $this->input->post('notes')); 
        $this->session->set_userdata('patient_id', $this->input->post('patient_name'));


        if(isset($hide) && !empty($hide)){
            $hide_array  = $hide;
        }else{
            $hide_array  = '';
        }

        if(isset($drugs) && !empty($drugs)):
          
            $i=0;

            foreach ($drugs as $value_4) {
           
                $count = count($this->input->post('time_periods'.$i))/4;
                $array[] =  $this->input->post('time_periods'.$i);

       
                for($p=1; $p<=$count; $p++){
                    
                    if($p==1){
                        for($q=0;$q<=3;$q++){
                            $get_data1[] = $array[$i][$q];
                        }
                        $time_periods[$i][] = implode('+', array_slice($get_data1, -4));
                    }

                    if($p==2){
                        for($q=4;$q<=7;$q++){
                            $get_data2[] = $array[$i][$q];
                        }
                        $time_periods[$i][] = implode('+', array_slice($get_data2, -4));
                    }

                    if($p==3){
                        for($q=8;$q<=11;$q++){
                            $get_data3[] = $array[$i][$q];
                        }
                        $time_periods[$i][] = implode('+', array_slice($get_data3, -4));
                    }

                }


                if (empty($hide_array)) {
                    $drug_items[] = array(
                        'drugs_id' => $value_4,
                        'time_periods' => $time_periods[$i],
                        'duration_text' => $this->input->post('duration_text'.$i),
                        'duration' => $this->input->post('duration'.$i),
                        'medicine_time' => $this->input->post('medicine_time'.$i),
                        'note' => $this->input->post('note'.$i)
                    );
                
                } else {
                   
                    if (in_array($i, $hide_array)){
                      
                    }
                    else{
                        $drug_items[] = array(
                            'drugs_id' => $value_4,
                            'time_periods' => $time_periods[$i],
                            'duration_text' => $this->input->post('duration_text'.$i),
                            'duration' => $this->input->post('duration'.$i),
                            'medicine_time' => $this->input->post('medicine_time'.$i),
                            'note' => $this->input->post('note'.$i)
                        );
                        
                    }
                }
              
                $i++; 
            }
        

           $this->session->set_userdata('drugs', $drug_items);
          
            
        endif;

        $preview = $this->load->view('admin/user/prescription_preview',$this->session->all_userdata(),TRUE);
        echo json_encode(array('st'=>1,'data'=>$preview));
    }



    public function store_hide_data($id)
    {   

        $hide_data = array(
            'hide_data[]' => $id
        );

        $this->session->set_userdata($hide_data);
        echo json_encode(array('st' => 1));
    }



    public function make_complete($prescription_id, $patient_id, $appoinment_id)
    {
        $data = array(
            'prescription_id' => $prescription_id, 
            'patient_id' => $patient_id,
            'status' => 1
        );
        if ($appoinment_id != 0) {
            $this->admin_model->edit_option($data,$appoinment_id, 'appointments');
        }
        
    }


    public function add()
    {	
       
       $prescription_id = session('prescription_id');
        if (is_staff()) {
            $user_id = session('parent');
        }
        if (is_user()) {
            $user_id = session('id');
        }

       if ($prescription_id == 0) {
            $data = array(
                'chamber_id' => $this->chamber->uid,
                'patient_id' => session('patient_id'),
                'next_visit' => session('next_visit'),
                'is_followup' => session('follow_up'),
                'notes' => session('notes'),
                'user_id' => $user_id,
                'created_at' => my_date_now(),
           );
           $prescription_id = $this->admin_model->insert($data,'prescription');
       }else{
            $data = array(
                'patient_id' => session('patient_id'),
                'next_visit' => session('next_visit'),
                'is_followup' => session('follow_up'),
                'notes' => session('notes'),
                'user_id' => $user_id
            );
           $this->admin_model->edit_option($data, $prescription_id, 'prescription');
       }

       $this->make_complete($prescription_id, session('patient_id'), session('appoinment_id'));

       $this->add_prescription_items($prescription_id);
        
    }

    public function add_prescription_items($id){
        
        if ($id != 0) {
            $this->admin_model->delete_by_prescription_id($id, 'pre_diagonosis');
            $this->admin_model->delete_by_prescription_id($id, 'pre_ad_advices');
            $this->admin_model->delete_by_prescription_id($id, 'pre_advice');
            $this->admin_model->delete_by_prescription_id($id, 'pre_investigation');
            $this->admin_model->delete_by_prescription_id($id, 'prescription_items');
        }

        if(!empty(session('diagonosis'))):
             $i=0;
             foreach (session('diagonosis') as $value_1) {
                 $data_1 = array(
                    'prescription_id' => $id,
                    'diagonosis_id' => $value_1['diagonosis_id'],
                 );
                $i++; 
                $this->admin_model->insert($data_1,'pre_diagonosis');
             }
              
        endif; 

        if(!empty(session('ad_advices'))):
             $j=0;
             foreach (session('ad_advices') as $value_2) {
                 $data_2 = array(
                    'prescription_id' => $id,
                    'ad_advices_id' => $value_2['ad_advices_id'],
                 );
                $j++; 
                $this->admin_model->insert($data_2,'pre_ad_advices');
             }
              
        endif;

        if(!empty(session('advice'))):
             $k=0;
             foreach (session('advice') as $value_3) {
                 $data_3 = array(
                    'prescription_id' => $id,
                    'advice_id' => $value_3['advice_id'],
                 );
                $k++; 
                 $this->admin_model->insert( $data_3,'pre_advice');
             }
             
        endif;

        if(!empty(session('investigation'))):
             $l=0;
             foreach (session('investigation') as $value_4) {
                 $data_4 = array(
                    'prescription_id' => $id,
                    'investigation_id' => $value_4['investigation_id'],
                 );
                $l++; 
                 $this->admin_model->insert($data_4,'pre_investigation');
             }
             
        endif;

        foreach (session('drugs') as $key => $drug) {
            for($d=0;$d<=count($drug['time_periods']); $d++){
                $data = array(
                    'prescription_id'=>$id,
                    'drug_id'=>$drug['drugs_id'],
                    'time_periods'=> !empty($drug['time_periods'][$d])?$drug['time_periods'][$d]:'',
                    'medicine_time'=> !empty($drug['medicine_time'][$d])?$drug['medicine_time'][$d]:'',
                    'duration_text'=>!empty($drug['duration_text'][$d])?$drug['duration_text'][$d]:'',
                    'duration' => !empty($drug['duration'][$d])?$drug['duration'][$d]:'',
                    'note' => !empty($drug['note'][$d])?$drug['note'][$d]:'',
                );
                if(!empty($drug['time_periods'][$d]) || !empty($drug['medicine_time'][$d]) || !empty($drug['duration_text'][$d])
                 || !empty($drug['duration'][$d]) || !empty($drug['note'][$d])):
                   $pre_id =  $this->admin_model->insert($data,'prescription_items');
                endif;
            }

        }

        if($pre_id){
            $data['prescription'] = $this->admin_model->get_prescription($id);
            $data['drugs'] = $this->admin_model->get_user_prescription($id,'prescription_items');
            $data['pre_ad_advices'] = $this->admin_model->select_by_prescription_id($id,'pre_ad_advices');
            $data['pre_advice'] = $this->admin_model->select_by_prescription_id($id,'pre_advice');
            $data['pre_diagonosis'] = $this->admin_model->select_by_prescription_id($id,'pre_diagonosis');
            $data['pre_investigation'] = $this->admin_model->select_by_prescription_id($id,'pre_investigation');
            $load = $this->load->view('admin/user/include/prescription_details', $data, TRUE);
            echo json_encode(array('st'=>1,'data'=>$load));
        }
    }

    public function get_patient_name()
    {
       $data = array();
       $data['patients'] = $this->admin_model->select_by_chamber('patientses'); 
       $load_view = $this->load->view('admin/user/pateint_list', $data, TRUE);
       $response = ['status'=>1, 'data'=>$load_view,];
       echo json_encode($response);
    }

    public function add_fields($id=0)
    {
       $data = array();
       $data['id'] = $id;
       $data['drugs'] = $this->admin_model->select_by_user('drugs'); 
       $load_view = $this->load->view('admin/user/ajax_field', $data, TRUE);
       $response = ['st'=>1, 'data'=>$load_view,'id'=>$id,];
       echo json_encode($response);
    }

    public function add_drug()
    {   
        if($_POST)
        {   

            //validate inputs
            $this->form_validation->set_rules('name', trans('name'), 'required');
            $this->form_validation->set_rules('details', trans('age'), 'trim');

            if ($this->form_validation->run() === false) {
                 echo json_encode(array('st'=>0,'msg'=>validation_errors()));
            } else {
               
                $data=array(
                    'user_id' => user()->id,
                    'name' => $this->input->post('name', true),
                    'details' => $this->input->post('details', true),
                );
                $data = $this->security->xss_clean($data);
                $insert = $this->admin_model->insert($data, 'drugs');
                //if id available info will be edited
                if ($insert) {
                    $data['drugs'] = $this->admin_model->select_by_user('drugs');
                    $load = $this->load->view('admin/user/ajax_drug', $data, TRUE);
                    echo json_encode(array('st'=>1,'data' => $load,'msg'=> trans('inserted-successfully')));
                } else {
                    echo json_encode(array('st'=>0,'msg'=> trans('something-wrong')));
                }
                

            }
        }      
        
    }


    public function delete($id)
    {
        $this->admin_model->delete($id,'prescription'); 
        echo json_encode(array('st' => 1));
    }

}
	

