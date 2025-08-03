
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
    /* خلفية الصفحة */
    body {
        background: linear-gradient(135deg, #f9f9f9, #e3eaf2);
        font-family: "Tajawal", sans-serif;
    }
    a{
        text-decoration: none;
    }
    .content-wrapper {
        padding: 40px 0;
    }

    /* صندوق الفواتير */
    .invoice-card {
        background: white;
        border-radius: 12px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        transition: transform 0.3s ease-in-out;
    }

    .invoice-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
    }

    /* رأس الجدول */
    .table thead {
        background: #e3eaf2;
        color: #333;
        font-weight: bold;
    }

    .table tbody tr:hover {
        background: rgba(227, 234, 242, 0.2);
    }

    /* الأزرار */
    .btn-custom {
        background: #6c757d;
        color: white;
        border-radius: 8px;
        transition: all 0.3s ease-in-out;
    }

    .btn-custom:hover {
        background: #5a6268;
        transform: scale(1.05);
    }

    /* الفلاتر الزمنية */
    .nav-pills .nav-link {
        border-radius: 8px;
        transition: all 0.3s ease-in-out;
    }

    .nav-pills .nav-link.active {
        background: #6c757d;
        color: white;
    }

    .nav-pills .nav-link:hover {
        background: #5a6268;
        color: white;
    }
</style>

<div class="content-wrapper">


    <section class="content">
        <div class="container">
            <div class="invoice-card p-4">
                <h2 class="text-center text-muted mb-4">📄 سجل الفواتير</h2>
                <?php if ($this->session->flashdata('success')) : ?>
                    <div class="alert alert-success fade-out">
                        <?= $this->session->flashdata('success'); ?>
                    </div>
                    <?php $this->session->unset_userdata('success'); ?> <!-- حذف الرسالة بعد عرضها -->
                <?php endif; ?>


                <?php
                $total = 0; // تهيئة المجموع قبل بدء الحساب
                if (!empty($invoices)) {
                    foreach ($invoices as $invoice) {
                        $total += $invoice->total_amount;
                    }
                }
                ?>

                <!-- عرض إجمالي المبلغ أعلى الجدول -->
                <?php if (!empty($invoices)): ?>
                    <div class="mb-4 text-center">
                        <h5 class="text-secondary">إجمالي المبلغ للفترة المحددة:
                            <strong class="text-success"><?= $total ?></strong> دينار عراقي
                        </h5>
                    </div>
                <?php endif; ?>


                <!-- Tabs لتحديد الفلتر الزمني -->
                <ul class="nav nav-pills justify-content-center mb-4">
                    <li class="nav-item">
                        <a class="nav-link <?= ($filter_type == 'all') ? 'active' : 'text-muted' ?>" href="<?= base_url('admin/InvoicePage/index?filter_type=all') ?>">جميع الفواتير</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= ($filter_type == 'daily') ? 'active' : 'text-muted' ?>" href="<?= base_url('admin/InvoicePage/index?filter_type=daily') ?>">يومي</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= ($filter_type == 'weekly') ? 'active' : 'text-muted' ?>" href="<?= base_url('admin/InvoicePage/index?filter_type=weekly') ?>">أسبوعي</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= ($filter_type == 'monthly') ? 'active' : 'text-muted' ?>" href="<?= base_url('admin/InvoicePage/index?filter_type=monthly') ?>">شهري</a>
                    </li>
                </ul>

                <!-- نموذج البحث مع تضمين قيمة الفلتر الحالي -->
                <form method="GET" action="<?= base_url('admin/InvoicePage/index') ?>" class="mb-4">
                    <input type="hidden" name="filter_type" value="<?= $filter_type ?>">
                    <div class="row g-2">
                        <div class="col-md-4" dir="rtl">
                            <input type="text" name="invoice_id" class="form-control border-muted" placeholder="بحث برقم الفاتورة" value="<?= isset($_GET['invoice_id']) ? $_GET['invoice_id'] : '' ?>">
                        </div>
                        <div class="col-md-4" dir="rtl">
                            <input type="text" name="phone_number" class="form-control border-muted" placeholder="بحث برقم الهاتف" value="<?= isset($_GET['phone_number']) ? $_GET['phone_number'] : '' ?>">
                        </div>
                        <div class="col-md-2" >
                            <button  type="submit" class="btn btn-custom w-100 ">بحث</button>
                        </div>
                    </div>
                </form>


                <!-- جدول الفواتير -->
                <div class="table-responsive">

                    <table class="table table-bordered text-center">
                        <thead>
                        <tr>
                            <th scope="col">رقم الفاتورة</th>
                            <th scope="col">اسم المريض</th>
                            <th scope="col">اسم العيادة</th>
                            <th scope="col">رقم الهاتف</th>
                            <th scope="col">المبلغ الكلي</th>
                            <th scope="col">تاريخ الإصدار</th>
                            <th scope="col">تعديل</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php if (!empty($invoices)): ?>
                            <?php foreach ($invoices as $invoice): ?>
                                <tr>
                                    <td><?= $invoice->Id ?></td>
                                    <td><?= $invoice->patient_name ?></td>
                                    <td><?= $invoice->clinic_name ?></td>
                                    <td><?= $invoice->phone_number ?></td>
                                    <td class="text-success"><?= $invoice->total_amount ?> دينار عراقي</td>
                                    <td><?= date('d-m-Y', strtotime($invoice->created_at)) ?></td>
                                    <td>
                                        <a href="<?= base_url('admin/InvoiceViews/edit/'. $invoice->Id)?>" class="btn btn-sm btn-info">تعديل</a>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="6" class="text-center text-muted">لا توجد فواتير حسب الفلاتر المحددة.</td>
                            </tr>
                        <?php endif; ?>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </section>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
