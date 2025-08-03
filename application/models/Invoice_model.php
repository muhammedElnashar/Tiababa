<?php

class Invoice_model extends CI_Model {

    // دالة لإضافة الفاتورة مع الخدمات
    public function insert_invoice($invoice_data, $services) {
        // إضافة تاريخ الإنشاء تلقائيًا
        $invoice_data['created_at'] = date('Y-m-d H:i:s');

        // إدخال البيانات في جدول الفاتورة
        $this->db->insert('invoice', $invoice_data);
        $invoice_id = $this->db->insert_id(); // إرجاع رقم الفاتورة



        // إدخال الخدمات المرتبطة بالفاتورة في جدول invoice_services
        foreach ($services as $service) {
            $service_id = $service['id'];
            $quantity = $service['quantity'];

            // إدخال البيانات في جدول `invoice_services`
            $this->db->insert('invoice_services', [
                'invoice_id' => $invoice_id,
                'services_id' => $service_id, // تأكد من أن اسم العمود صحيح في قاعدة البيانات
                'quantity' => $quantity,
            ]);

        }

        return $invoice_id; // إرجاع رقم الفاتورة
    }
    public function update_invoice($invoice) {
        if ($this->session->userdata('role') == 'user' || $this->session->userdata('role') == 'admin') {
            $user_id = $this->session->userdata('id');
        }else{
            $user_id = $this->session->userdata('parent');
        }
        if (!isset($invoice['id']) || empty($invoice['id'])) {
            return false;
        }

        $this->db->where('user_id', $user_id);
        $this->db->where('id', $invoice['id']);
        $this->db->update('invoice', $invoice);

        return true;
    }




    // استرجاع جميع الخدمات من جدول servicess
    public function get_services() {
        // استرجاع جميع الخدمات من جدول servicess
        $query = $this->db->get('servicess');  // اسم الجدول هنا هو servicess
        return $query->result();  // إرجاع جميع الخدمات
    }


    public function get_invoice_details($invoice_id) {
        // جلب بيانات الفاتورة
        $invoice_data = $this->db->get_where('invoice', ['id' => $invoice_id])->row();

        // إذا لم يتم العثور على الفاتورة، إرجاع مصفوفة فارغة
        if (!$invoice_data) {
            return ['invoice' => null, 'servicess' => []];
        }

        // جلب الخدمات المرتبطة بالفاتورة
        $this->db->select('invoice_services.quantity, servicess.service_name, servicess.price,servicess.nameDoctor');
        $this->db->from('invoice_services');
        $this->db->join('servicess', 'servicess.id = invoice_services.services_id', 'left');
        $this->db->where('invoice_services.invoice_id', $invoice_id);
        $services = $this->db->get()->result();

        // إرجاع بيانات الفاتورة والخدمات
        return [
            'invoice' => $invoice_data,
            'servicess' => $services
        ];
    }
    
    
       public function get_all_invoices()
    {
        // استرجاع الأعمدة المطلوبة فقط من جدول invoice
        $this->db->select('invoice.id, invoice.patient_name, invoice.clinic_name, invoice.phone_number, invoice.address, invoice.total_amount');
        $this->db->from('invoice');
        $this->db->order_by('invoice.created_at', 'DESC');  // ترتيب الفواتير حسب التاريخ
        $query = $this->db->get();

        return $query->result();  // إرجاع الفواتير
    }



    public function get_filtered_invoices($invoice_id, $phone_number, $filter_type)
    {
        if ($this->session->userdata('role') == 'user' || $this->session->userdata('role') == 'admin') {
            $user_id = $this->session->userdata('id');
        }else{
            $user_id = $this->session->userdata('parent');
        }
        $this->db->select('*')->where("user_id",$user_id);
        $this->db->from('invoice');

        // تطبيق الفلترة الزمنية فقط إذا لم يكن الفلتر "جميع الفواتير"
        if ($filter_type !== 'all') {
            $today = date('Y-m-d');
            switch ($filter_type) {
                case 'daily':
                    // تحديد بداية ونهاية اليوم الحالي
                    $start_date = $today . " 00:00:00";
                    $end_date   = $today . " 23:59:59";
                    break;
                case 'weekly':
                    // حساب بداية الأسبوع (من الإثنين) ونهايته (الأحد)
                    $start_date = date('Y-m-d 00:00:00', strtotime('monday this week'));
                    $end_date   = date('Y-m-d 23:59:59', strtotime('sunday this week'));
                    break;
                case 'monthly':
                    // تحديد أول وآخر يوم في الشهر الحالي
                    $start_date = date('Y-m-01 00:00:00');
                    $end_date   = date('Y-m-t 23:59:59');
                    break;
                default:
                    $start_date = null;
                    $end_date   = null;
                    break;
            }
            if ($start_date && $end_date) {
                $this->db->where('created_at >=', $start_date);
                $this->db->where('created_at <=', $end_date);
            }
        }

        // تطبيق فلترة البحث الإضافية (معرف الفاتورة ورقم الهاتف)
        if (!empty($invoice_id)) {
            $this->db->where('Id', $invoice_id);
        }
        if (!empty($phone_number)) {
            $this->db->where('phone_number', $phone_number);
        }

        // تنفيذ الاستعلام وإرجاع النتائج
        $query = $this->db->get();
        return $query->result();
    }

/*    public function get_total_amount($filter_type, $invoice_id = '', $phone_number = '')
    {
        $this->db->select_sum('total_amount');
        $this->db->from('invoice');

        // تطبيق الفلترة الزمنية فقط إذا لم يكن الفلتر "جميع الفواتير"
        if ($filter_type !== 'all') {
            $today = date('Y-m-d');
            switch ($filter_type) {
                case 'daily':
                    $start_date = $today . " 00:00:00";
                    $end_date   = $today . " 23:59:59";
                    break;
                case 'weekly':
                    $start_date = date('Y-m-d 00:00:00', strtotime('monday this week'));
                    $end_date   = date('Y-m-d 23:59:59', strtotime('sunday this week'));
                    break;
                case 'monthly':
                    $start_date = date('Y-m-01 00:00:00');
                    $end_date   = date('Y-m-t 23:59:59');
                    break;
                default:
                    $start_date = null;
                    $end_date   = null;
                    break;
            }
            if ($start_date && $end_date) {
                $this->db->where('created_at >=', $start_date);
                $this->db->where('created_at <=', $end_date);
            }
        }

        // تطبيق فلترة البحث الإضافية إذا تم تمريرها
        if (!empty($invoice_id)) {
            $this->db->where('Id', $invoice_id);
        }
        if (!empty($phone_number)) {
            $this->db->where('phone_number', $phone_number);
        }

        // تنفيذ الاستعلام وإرجاع مجموع المبلغ
        $query = $this->db->get();
        return $query->row()->total_amount;
    }*/

    
  public function get_last_invoice_id() {
        $this->db->select_max('id');  // الحصول على أعلى id موجود
        $query = $this->db->get('invoice');
        $result = $query->row();
        return $result ? $result->id : 0;  // إرجاع الرقم الأخير أو 0 إذا لم توجد فواتير
    }
}
