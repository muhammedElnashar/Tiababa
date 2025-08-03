<?php



defined('BASEPATH') or exit('No direct script access allowed');

class InvoicePage extends Home_Controller
{

    public function __construct()
    {
        parent::__construct();
        if (!is_admin() && !is_user() && !is_staff()) {
            redirect(base_url());
        }
    }

    public function index()
    {
        // استلام المدخلات من النموذج
        $filter_type = $this->input->get('filter_type');  // تحديد الفلتر الزمني
        $invoice_id = $this->input->get('invoice_id');
        $phone_number = $this->input->get('phone_number');

        // تحديد الفلتر الزمني الافتراضي (يومي)
        $filter_type = $filter_type ? $filter_type : 'daily';
        // إذا تم البحث برقم الفاتورة أو رقم الهاتف، يتم تغيير الفلتر إلى "all"
        if (!empty($invoice_id) || !empty($phone_number)) {
            $filter_type = 'all';
        }
        // تمرير الفلاتر إلى الموديل لاسترجاع البيانات بناءً على الفلتر الزمني
        $data['filter_type'] = $filter_type;
        $data['invoices'] = $this->Invoice_model->get_filtered_invoices($invoice_id, $phone_number, $filter_type);
        $data['page_title'] = 'Invoices';

        // حساب الإجمالي بناءً على الفلاتر
        /*        $data['total_amount'] = $this->Invoice_model->get_total_amount($filter_type);*/
        $data['main_content'] = $this->load->view("invoice_page", $data, TRUE);
        $this->load->view('admin/index', $data);
        // تحميل الـ View وتمرير البيانات إليها
    }
}
