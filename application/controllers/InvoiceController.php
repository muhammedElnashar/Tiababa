<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class InvoiceController extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('InvoiceModel');
        $this->load->model('ServiceModel');  // تأكد أن الـ Model محدث
        $this->load->helper('url');
        $this->load->library('form_validation');
    }

    // عرض النموذج
    public function index()
    {
        $data['services'] = $this->ServiceModel->get_all_services();
        $this->load->view('invoice_view', $data);
    }

    // إضافة الفاتورة
    public function add_invoice()
    {
        $this->form_validation->set_rules('company_name', 'اسم المجمع', 'required');
        $this->form_validation->set_rules('phone_number', 'رقم الهاتف', 'required');
        $this->form_validation->set_rules('address', 'العنوان', 'required');
        $this->form_validation->set_rules('invoice_number', 'رقم الفاتورة', 'required');
        $this->form_validation->set_rules('services[]', 'الخدمات', 'required');

        if ($this->form_validation->run() == TRUE)
        {
            // رفع الصور
            $logo = $this->upload_image('logo');
            $image = $this->upload_image('image');

            // إدخال بيانات الفاتورة في قاعدة البيانات
            $invoice_data = [
                'logo' => $logo,
                'image' => $image,
                'company_name' => $this->input->post('company_name'),
                'phone_number' => $this->input->post('phone_number'),
                'address' => $this->input->post('address'),
                'social_media1' => $this->input->post('social_media1'),
                'social_media2' => $this->input->post('social_media2'),
                'social_media3' => $this->input->post('social_media3'),
                'invoice_number' => $this->input->post('invoice_number')
            ];

            // إدخال الفاتورة في قاعدة البيانات
            $invoice_id = $this->InvoiceModel->insert_invoice($invoice_data);

            // ربط الفاتورة بالخدمات
            $services = $this->input->post('services');
            foreach ($services as $service_id)
            {
                $service_data = [
                    'invoice_id' => $invoice_id,
                    'service_id' => $service_id,
                    'quantity' => 1,  // الكمية يمكن تعديلها لاحقًا حسب الحاجة
                    'price' => $this->ServiceModel->get_service_price($service_id)
                ];
                $this->InvoiceModel->add_service_to_invoice($service_data);
            }

            redirect('invoice/success');
        }
        else
        {
            $data['services'] = $this->ServiceModel->get_all_services();
            $this->load->view('invoice_form', $data);
        }
    }

    // رفع الصورة
    private function upload_image($field)
    {
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'jpg|png|jpeg';
        $this->load->library('upload', $config);

        if ($this->upload->do_upload($field))
        {
            $data = $this->upload->data();
            return $data['file_name'];
        }
        return NULL;
    }

    // عرض صفحة النجاح بعد إضافة الفاتورة
    public function success()
    {
        $this->load->view('invoice_success');
    }
}
