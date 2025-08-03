<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class File extends Home_Controller 
{

    public function __construct()
    {
        parent::__construct();
    }


    public function import($type)
    {
        $data = array();
        $data['page_title'] = 'Import';      
        $data['page'] = 'File';
        $data['type'] = $type;
        $data['main_content'] = $this->load->view('admin/files/import',$data,TRUE);
        $this->load->view('admin/index',$data);
    }


    public function download($type)
    {
        if (is_staff()) {
            if (check_staff_permissions('drugs') != 1 ) {
                redirect(base_url('admin/dashboard/user'));
            }
            
        }
        $this->load->helper('download');
        $path = base_url('uploads/files/'.$type.'_csv_template.csv');
        $data = file_get_contents($path);
        $pathinfo = pathinfo($path);
        $file_name = $type.'_csv_template.csv';
        force_download($file_name, $data);
    }


    //import csv file
    public function import_file(){
       
        $data = array();
        
        // If import request is submitted
        if($_POST){

            $table = $this->input->post('type');
            if (user()->role == 'admin') {
                $is_admin = 1;
            }else{
                $is_admin = 0;
            }

            // Form field validation rules
            $this->form_validation->set_rules('file', 'CSV file', 'callback_file_check');
            
            // Validate submitted form data
            if($this->form_validation->run() == true){
                
                // If file uploaded
                if(is_uploaded_file($_FILES['file']['tmp_name'])){
                    // Load CSV reader library
                    $this->load->library('CSVReader');
                    
                    // Parse data from CSV file
                    $csvData = $this->csvreader->parse_csv($_FILES['file']['tmp_name']);
                    
                    // Insert/update CSV data into database
                    if(!empty($csvData)){
                        
                        $last_id = $this->common_model->get_last_id($table);

                        $insertCount = $last_id+1;
                        foreach($csvData as $row){ 
                            
                            // Prepare data for DB insertion
                            $importData = array(
                                'id' => $insertCount,
                                'user_id' => user()->id,
                                'name' => $row['Name'],
                                'details' => $row['Details'],
                                'generic_name' => $row['Generic'],
                                'brand_name' => $row['Brand'],
                                'is_admin' => $is_admin,
                            );
                            
                            // Insert member data
                            $insert = $this->common_model->insert($importData, $table);
                            
                            if($insert){
                                $insertCount++;
                            }
                        }
                        $this->session->set_flashdata('msg', 'Data Imported Successfully');
                    
                    }
                }else{
                    $this->session->set_flashdata('error', 'Error on file upload, please try again.');
                }
            }else{
            	$this->session->set_flashdata('error', 'Invalid file, please select only CSV file');
            }
        }
        redirect('admin/file/import/'.$table);
    }

    //check file
    public function file_check($str){
        $allowed_mime_types = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain');
        if(isset($_FILES['file']['name']) && $_FILES['file']['name'] != ""){
            $mime = get_mime_by_extension($_FILES['file']['name']);
            $fileAr = explode('.', $_FILES['file']['name']);
            $ext = end($fileAr);
            if(($ext == 'csv') && in_array($mime, $allowed_mime_types)){
                return true;
            }else{
                $this->form_validation->set_message('file_check', 'Please select only CSV file to upload.');
                return false;
            }
        }else{
            $this->form_validation->set_message('file_check', 'Please select a CSV file to upload.');
            return false;
        }
    }


}

