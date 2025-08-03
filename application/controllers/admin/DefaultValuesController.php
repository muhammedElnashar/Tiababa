<?php

defined('BASEPATH') or exit('No direct script access allowed');

class DefaultValuesController extends Home_Controller
{

    public function __construct()
    {
        parent::__construct();
        if (!is_admin() && !is_user()) {
            redirect(base_url());
        }
        $this->load->model('DefaultValues_model');  // تحميل النموذج
        $this->load->library('form_validation'); // تحميل مكتبة التحقق من البيانات
        $this->load->library('upload'); // تحميل مكتبة تحميل الصور
        $this->load->library('session'); // تحميل مكتبة الجلسات
    }

    public function index()
    {
        // جلب القيم الافتراضية من النموذج
        $data['default_values'] = $this->DefaultValues_model->get_default_values();
        $data['page_title']= 'Default Value';
        $data['main_content'] = $this->load->view("default_values_view", $data, TRUE);
        $this->load->view('admin/index', $data);
    }

    public function update_default_values()
    {
        // التحقق من صحة البيانات المدخلة
        $this->form_validation->set_rules('clinic_name', 'اسم المجمع', 'required');
        $this->form_validation->set_rules('address', 'العنوان', 'required');

        // إعداد مجلد الصور
        $upload_path = './uploads/default_values/';
        if (!is_dir($upload_path)) {
            mkdir($upload_path, 0777, true);
        }

        // إعداد القواعد الخاصة بتحميل الصور
        $config['upload_path'] = $upload_path;
        $config['allowed_types'] = 'jpg|jpeg|png|gif';
        $config['max_size'] = 2048;

        // تحميل الصور
        $this->upload->initialize($config);

        // جلب البيانات القديمة
        $old_data = $this->DefaultValues_model->get_default_values();
        $old_images = [
            'logo'   => $old_data->logo ?? null,
            'image1' => $old_data->image1 ?? null,
            'image2' => $old_data->image2 ?? null,
            'image3' => $old_data->image3 ?? null,
        ];

        if ($this->form_validation->run() === FALSE) {
            $data['default_values'] = $old_data;
            $data['main_content'] = $this->load->view("default_values_view", $data, TRUE);
            $this->load->view('admin/index', $data);
        } else {
            $images = array();

            // دالة لحذف الصورة القديمة
            function delete_old_image($old_image) {
                if ($old_image && file_exists($old_image)) {
                    unlink($old_image);
                }
            }

            // **استبدال الصور القديمة بالجديدة**
            if (!empty($_FILES['logo']['name']) && $this->upload->do_upload('logo')) {
                delete_old_image($old_images['logo']);
                $logo_data = $this->upload->data();
                $images['logo'] = 'uploads/default_values/' . $logo_data['file_name'];
            }

            if (!empty($_FILES['image1']['name']) && $this->upload->do_upload('image1')) {
                delete_old_image($old_images['image1']);
                $image1_data = $this->upload->data();
                $images['image1'] = 'uploads/default_values/' . $image1_data['file_name'];
            }

            if (!empty($_FILES['image2']['name']) && $this->upload->do_upload('image2')) {
                delete_old_image($old_images['image2']);
                $image2_data = $this->upload->data();
                $images['image2'] = 'uploads/default_values/' . $image2_data['file_name'];
            }

            if (!empty($_FILES['image3']['name']) && $this->upload->do_upload('image3')) {
                delete_old_image($old_images['image3']);
                $image3_data = $this->upload->data();
                $images['image3'] = 'uploads/default_values/' . $image3_data['file_name'];
            }

            // تحديث البيانات
            $data = array(
                'user_id' => user()->id,
                'clinic_name' => $this->input->post('clinic_name'),
                'address' => $this->input->post('address')
            );

            // دمج الصور الجديدة مع البيانات
            $data = array_merge($data, $images);

            if ($this->DefaultValues_model->update_default_values($data)) {
                $this->session->set_flashdata('success', 'تم تحديث القيم الافتراضية بنجاح');
            } else {
                $this->session->set_flashdata('error', 'حدث خطأ أثناء التحديث');
            }

            redirect(base_url('admin/DefaultValuesController'));
        }
    }

}

?>
