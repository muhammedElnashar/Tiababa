<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ServicesView extends Home_Controller
{

    // Constructor لتحميل الموديل
    public function __construct()
    {

        parent::__construct();
        if (!is_admin() && !is_user() && !is_staff()) {
            redirect(base_url());
        }
        // تحميل مكتبة التحقق من البيانات
        $this->load->library('form_validation');
    }

    // دالة عرض صفحة الخدمات
    public function index()
    {
        $data['invoice'] = FALSE;
        // استرجاع جميع الخدمات من قاعدة البيانات
        $data['services'] = $this->Service_model->get_all_services();
        /*    print_r( $data['services']);
            die();*/
        // التحقق من وجود بيانات POST لإضافة خدمة جديدة
        if ($this->input->post()) {
            // التحقق من البيانات المدخلة
            $this->form_validation->set_rules('service_name', 'اسم الخدمة', 'required');
            $this->form_validation->set_rules('price', 'السعر', 'required|numeric');
            $this->form_validation->set_rules('nameDoctor', 'اسم الدكتور', 'required');

            if ($this->form_validation->run() === TRUE) {
                if ($this->session->userdata('role') == 'user' || $this->session->userdata('role') == 'admin') {
                    $user_id = $this->session->userdata('id');
                }else{
                    $user_id = $this->session->userdata('parent');
                }
                // جمع البيانات المدخلة
                $service_data = array(
                    'user_id' => $user_id,
                    'service_name' => $this->input->post('service_name'),
                    'nameDoctor' => $this->input->post('nameDoctor'),
                    'price' => $this->input->post('price'),
                    'created_at' => date('Y-m-d H:i:s'),
                );

                // إضافة الخدمة إلى قاعدة البيانات

                $this->Service_model->add_service($service_data);
                // إعادة تحميل البيانات بعد إضافة الخدمة

                redirect(base_url('admin/ServicesView'));
            }
        }


        // تحميل الـ View مع البيانات
        $data['page_title'] = 'Invoice Service';
        $data['page'] = 'Service';

        $data['main_content'] = $this->load->view("services_view", $data, TRUE);
        $this->load->view('admin/index', $data);

    }

    // دالة لحذف خدمة
    public function delete_service($id)
    {
        $this->Service_model->delete_service($id);
        redirect(base_url('admin/ServicesView'));
    }

    // دالة لتحديث خدمة
    public function edit_service()
    {
        // استلام البيانات من النموذج
        $service_id = $this->input->post('service_id');
        $service_name = $this->input->post('service_name');
        $nameDoctor = $this->input->post('nameDoctor');
        $price = $this->input->post('price');

        // التحقق من صحة البيانات
        $this->form_validation->set_rules('service_name', 'اسم الخدمة', 'required');
        $this->form_validation->set_rules('price', 'السعر', 'required|numeric');
        $this->form_validation->set_rules('nameDoctor', 'اسم الدكتور', 'required');

        if ($this->form_validation->run() === TRUE) {

            // بيانات الخدمة المعدلة
            $service_data = array(
                'service_name' => $service_name,
                'price' => $price,
                'nameDoctor' => $nameDoctor,
            );

            // تحديث الخدمة في قاعدة البيانات
            $this->Service_model->update_service($service_id, $service_data);

            // إعادة توجيه إلى الصفحة الرئيسية بعد التعديل
            redirect(base_url('admin/ServicesView'));
        } else {
            // في حالة وجود خطأ في البيانات
            $this->index(); // إعادة تحميل الصفحة مع عرض الأخطاء
        }
    }
}
