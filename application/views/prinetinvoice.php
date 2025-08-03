<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>عرض الفاتورة</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .invoice-header {
            text-align: center;
            margin-bottom: 30px;
        }
        .invoice-details, .invoice-services {
            width: 100%;
            border-collapse: collapse;
        }
        .invoice-details th, .invoice-services th {
            background-color: #f0f0f0;
            padding: 10px;
        }
        .invoice-details td, .invoice-services td {
            padding: 8px;
            text-align: center;
            border: 1px solid #ddd;
        }
        .invoice-total {
            margin-top: 20px;
            text-align: right;
        }
    </style>
</head>
<body>
    <div class="invoice-header">
        <h2>فاتورة رقم: <?= $invoice_details['invoice']->invoice_number ?></h2>
        <p>اسم المريض: <?= $invoice_details['invoice']->patient_name ?></p>
        <p>اسم الطبيب: <?= $invoice_details['invoice']->name_docter ?></p>
    </div>

    <table class="invoice-details">
        <tr>
            <th>رقم الفاتورة</th>
            <th>اسم العيادة</th>
            <th>رقم الهاتف</th>
            <th>العنوان</th>
            <th>التاريخ</th>
        </tr>
        <tr>
            <td><?= $invoice_details['invoice']->invoice_number ?></td>
            <td><?= $invoice_details['invoice']->clinic_name ?></td>
            <td><?= $invoice_details['invoice']->phone_number ?></td>
            <td><?= $invoice_details['invoice']->address ?></td>
            <td><?= $invoice_details['invoice']->created_at ?></td>
        </tr>
    </table>

    <h3>الخدمات المضافة</h3>
    <table class="invoice-services">
        <tr>
            <th>اسم الخدمة</th>
            <th>الكمية</th>
            <th>السعر</th>
            <th>الإجمالي</th>
        </tr>

        <?php foreach ($invoice_details['services'] as $service): ?>
        <tr>
            <td><?= $service->service_name ?></td>
            <td><?= $service->quantity ?></td>
            <td><?= number_format($service->price, 2) ?> ج.م</td>
            <td><?= number_format($service->price * $service->quantity, 2) ?> ج.م</td>
        </tr>
        <?php endforeach; ?>
    </table>

    <div class="invoice-total">
        <h4>المجموع الكلي: <?= number_format($invoice_details['invoice']->total_amount, 2) ?> ج.م</h4>
    </div>

    <div class="invoice-footer">
        <p>شكراً لاختياركم خدماتنا!</p>
    </div>
</body>
</html>
