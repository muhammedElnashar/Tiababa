<?php


class InvoiceViews extends Home_Controller
{

    public function __construct()
    {
        parent::__construct();
        if (!is_admin() && !is_user() && !is_staff()) {
            redirect(base_url());
        }
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->library('upload');
    }

    public function index()
    {

        $data['page']='Service';

        $services = $this->input->post('services');
        $quantities = $this->input->post('quantities');
        $prices = $this->input->post('prices');
        $totals = $this->input->post('totals');
        $ids = $this->input->post('services_ids');
        $doctorName = $this->input->post('nameDoctor');
        $grand_total = $this->input->post('grand_total');
        $data['grand_total'] = $grand_total;
        $data['services'] = [];

        if (!empty($services) && is_array($services)) {
            foreach ($services as $key => $service) {

                $data['services'][] = [
                    'id' => $ids[$key] ?? 0,
                    'service' => $service,
                    "name_doctor" => $doctorName[$key],
                    'quantity' => $quantities[$key] ?? 0,
                    'price' => $prices[$key] ?? 0,
                    'total' => $totals[$key] ?? 0,

                ];

            }
        }


        // تحميل القيم الافتراضية من قاعدة البيانات
        $data['default_values'] = $this->DefaultValues_model->get_default_values();

        // الحصول على آخر رقم فاتورة (id)
        $last_invoice_id = $this->Invoice_model->get_last_invoice_id();
        $data['new_invoice_number'] = $last_invoice_id + 1;  // إضافة 1 إلى الرقم الأخير
        $data['page_title'] = 'InvoiceService';
        // تحميل العرض
        $data['main_content'] = $this->load->view("invoice_view", $data, TRUE);
        $this->load->view('admin/index', $data);
    }


    // إضافة الفاتورة
    public function add_invoice()
    {
        $services = json_decode($_POST['services'], true);

        $grand_total = $this->input->post('total_price');
        $patient_name = $this->input->post('patient_name');
        $phone_number = $this->input->post('phone_number');
        $new_invoice_number = $this->input->post('new_invoice_number');

        // التحقق من صحة البيانات
        $this->form_validation->set_rules('patient_name', 'اسم المريض', 'required');
        $this->form_validation->set_rules('phone_number', 'رقم الهاتف', 'required');
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('validation_errors', validation_errors());

            $data['new_invoice_number'] = $new_invoice_number;
            $data['patient_name'] = $patient_name;
            $data['phone_number'] = $phone_number;
            $data['services'] = $services;
            $data['grand_total'] = $grand_total;
            // تحميل القيم الافتراضية من قاعدة البيانات
            $data['default_values'] = $this->DefaultValues_model->get_default_values();
            $data['main_content'] = $this->load->view("invoice_view", $data, TRUE);
            $this->load->view('admin/index', $data);
        } else {
            if ($this->session->userdata('role') == 'user' || $this->session->userdata('role') == 'admin') {
                $user_id = $this->session->userdata('id');
            }else{
                $user_id = $this->session->userdata('parent');
            }
            // جمع البيانات المدخلة من النموذج
            $invoice_data = array(
                'id' => $this->input->post('new_invoice_number'),  // استخدام الرقم المحسوب
                'user_id' => $user_id,
                'patient_name' => $this->input->post('patient_name'),
                'clinic_name' => $this->input->post('clinic_name'),
                'phone_number' => $this->input->post('phone_number'),
                'total_amount' => $this->input->post('total_price'),

            );

            // رفع الصور
            $image1 = $this->upload_image('image1');
            $image2 = $this->upload_image('image2');
            $image3 = $this->upload_image('image3');
            $logo = $this->upload_image('logo'); // الشعار
            // التحقق من رفع الشعار
            if ($logo) {
                $invoice_data['logo'] = $logo;
            }
            if ($image1) {
                $invoice_data['image1'] = $image1;
            }
            if ($image2) {
                $invoice_data['image2'] = $image2;
            }
            if ($image3) {
                $invoice_data['image3'] = $image3;
            }


            // جمع الخدمات المختارة وكمياتها
            $services = json_decode($_POST['services'], true);


            $invoice_id = $this->Invoice_model->insert_invoice($invoice_data, $services);

            // إذا تم إدخال الفاتورة بنجاح
            if ($invoice_id) {
                $this->session->set_flashdata('success', 'تم إضافة الفاتورة بنجاح! رقم الفاتورة: ' . $this->input->post('id'));
                redirect(base_url("admin/InvoicePage"));  // إعادة توجيه إلى صفحة عرض الفواتير
            } else {
                echo "حدث خطأ أثناء إضافة الفاتورة!";
            }
        }
    }


    // دالة لتحميل الصور
// دالة لتحميل الصور مع حفظ المسار الكامل
    private function upload_image($field_name, $old_image = null)
    {
        $upload_path = './uploads/'; // تأكيد المسار الصحيح
        $config['upload_path'] = $upload_path;
        $config['allowed_types'] = 'jpg|jpeg|png|gif';
        $config['max_size'] = 2048; // الحد الأقصى للحجم (2MB)
        $config['file_name'] = time() . '_' . $_FILES[$field_name]['name']; // تغيير اسم الملف بناءً على الوقت

        // التحقق من وجود ملف
        if (empty($_FILES[$field_name]['name'])) {
            return $old_image; // الاحتفاظ بالصورة القديمة إذا لم يتم رفع صورة جديدة
        }

        $this->upload->initialize($config);

        if ($this->upload->do_upload($field_name)) {
            // حذف الصورة القديمة إذا كانت موجودة
            if ($old_image && file_exists(FCPATH . $old_image)) { // إضافة FCPATH لضمان الوصول للمسار الصحيح
                unlink(FCPATH . $old_image);
            }

            // الحصول على بيانات الملف المرفوع
            $uploaded_data = $this->upload->data();
            return 'uploads/' . $uploaded_data['file_name']; // تخزين المسار الجديد
        } else {
            // عرض الأخطاء أثناء رفع الصورة
            echo $this->upload->display_errors();
            return $old_image;
        }
    }

    public function edit($id)
    {

        $data['invoice'] = $this->Invoice_model->get_invoice_details($id);
        $data['services'] = $data['invoice']['servicess'];
        $data['invoice_details'] = $data['invoice']['invoice'];  // اجلب كائن الفاتورة
        $data['default_values'] = $this->DefaultValues_model->get_default_values();
        $data['page_title'] = 'تعديل فاتورة';
        $data['page']='Service';

        $data['main_content'] = $this->load->view('edit_invoice_view', $data, TRUE);
        $this->load->view('admin/index', $data);

    }
    public function update() {
        $invoice_id = $this->input->post('invoice_id');

        // التحقق من صحة البيانات
        $this->form_validation->set_rules('patient_name', 'اسم المريض', 'required');
        $this->form_validation->set_rules('phone_number', 'رقم الهاتف', 'required');

        if ($this->form_validation->run() == FALSE) {
            // تخزين الأخطاء في الجلسة
            $this->session->set_flashdata('validation_errors', validation_errors());
            redirect(base_url("admin/InvoiceViews/edit/" . intval($invoice_id)));
        } else {
            // جلب بيانات الفاتورة القديمة للحصول على مسارات الصور القديمة
            $old_invoice = $this->Invoice_model->get_invoice_details($invoice_id);

            // جمع البيانات المدخلة
            $invoice_data = array(
                'id' => $invoice_id,
                'patient_name' => $this->input->post('patient_name'),
                'phone_number' => $this->input->post('phone_number'),
            );

            // رفع الصور مع حذف القديمة إذا لزم الأمر
            $invoice_data['logo'] = $this->upload_image('logo', $old_invoice['invoice']->logo);
            $invoice_data['image1'] = $this->upload_image('image1', $old_invoice['invoice']->image1);
            $invoice_data['image2'] = $this->upload_image('image2', $old_invoice['invoice']->image2);
            $invoice_data['image3'] = $this->upload_image('image3', $old_invoice['invoice']->image3);

            // تحديث الفاتورة
            $update_status = $this->Invoice_model->update_invoice($invoice_data);

            if ($update_status) {
                $this->session->set_flashdata('success', 'تم تحديث الفاتورة بنجاح!');
            } else {
                $this->session->set_flashdata('error', 'لم يتم تحديث الفاتورة. ربما لم تقم بتغيير أي بيانات.');
            }

            redirect(base_url("admin/InvoicePage"));
        }
    }
}



?>
