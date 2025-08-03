
<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

<style>

    a {
        text-decoration: none;
    }

    /* إضافة مسافة بين القسمين */
    .container-fluid .col-6 {
        margin-right: 20px; /* مسافة بين القسم الأيمن والأيسر */
    }

    .container-fluid .col-5 {
        margin-left: 40px; /* مسافة بين القسم الأيسر والأيمن */
    }

    /* تحسين الاستايل العام */
    .container-fluid {
        padding: 20px;
    }


    /* تحسين حقول الإدخال */
    .form-control {
        border-radius: 8px;
        border: 1px solid #ddd;
        padding: 10px;
        font-size: 14px;
    }

    /* تحسين الأزرار */
    .btn-primary {
        background-color: #007bff;
        border: none;
        border-radius: 8px;
        padding: 10px 20px;
        font-size: 16px;
        transition: background-color 0.3s ease;
    }

    .btn-primary:hover {
        background-color: #0056b3;
    }

    /* تحسين الأيقونات */
    .file-upload-icon {
        color: #007bff;
    }

    .table {
        border-radius: 10px;
        overflow: hidden;
    }

    .table th {
        background: linear-gradient(45deg, #f8f9fa, #e9ecef);
        font-weight: bold;
        color: #333;
        text-align: center;
        padding: 14px;
    }

    .table td {
        text-align: center;
        padding: 12px;
        font-size: 16px;
    }

    .table tbody tr:hover {
        background: #0f65a5;
        transition: 0.3s;
        color: white;
    }

    /* تحسين الإجمالي */
    .total-container {
        font-size: 20px;
        font-weight: bold;
        background: linear-gradient(45deg, #f8f9fa, #e9ecef);
        border-radius: 10px;
        padding: 15px;
    }


    /* تحسين قسم QR Code */
    .file-upload-text {
        color: #666;
        font-size: 14px;
    }

    .file-upload-text span {
        color: #007bff;
        cursor: pointer;
    }


    #logoPreview img {
        width: 100px;
        height: 100px;
        object-fit: cover; /* يضمن أن الصورة تملأ المساحة بدون تشويه */
        border-radius: 50%; /* يجعل الصورة دائرية */
        border: 3px solid white; /* إضافة إطار أبيض جميل */
        box-shadow: 0 0 10px rgba(255, 255, 255, 0.5); /* تأثير ظل خفيف */
    }


    #clinic_name_display {
        font-size: 24px;
        font-weight: bold;
        color: #333;
    }

    #invoice_number_display, #patient_name_display {
        font-size: 18px;
        color: #555;
    }

    #todayDate {
        font-size: 16px;
        color: #555;
    }

    .qr-code-box {
        width: 130px;
        height: 130px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 10px;
    }

    .qr-code-box img {
        max-width: 100%;
        max-height: 100%;
        object-fit: contain;
        border-radius: 5px;
    }

    @media print {
        .qr {
            display: none;
        }

        body * {
            visibility: hidden;
        }

        #clinic_name_display {
            font-size: 50px !important;
        }

        #patient_name_display, #phone_number_display, #todayDate, #invoice_number_display {
            font-size: 25px !important;
            margin-top: 10px;

        }

        #invoice-section, #invoice-section * {
            font-family: "IBM Plex Sans Arabic";
            visibility: visible;
        }

        #invoice-section {
            position: relative;
            right: 450px;
            top: 0;
            width: 100%;
            height: 100%;
            max-width: 100%;
            max-height: 100%;
            margin: 0 !important;
            background: #fff !important;
            border: none !important;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            font-family: "Arial", sans-serif;
            color: #222;
            box-shadow: none !important;
        }

        /* تحسين العناوين */
        h6 {
            text-align: center;
            font-size: 20px !important;
            font-weight: bold;
            color: rgba(142, 149, 155, 0.55);
            margin-bottom: 10px;
        }

        h2 {
            text-align: center;
            font-size: 24px;
            font-weight: bold;
            color: #555;
            margin-bottom: 10px;
        }

        h3 {
            text-align: center;
            font-size: 22px;
            font-weight: bold;
            color: #777;
            margin-bottom: 10px;
        }

        .invoice-info {
            width: 100%;
            margin-bottom: 20px;
            display: flex;
            justify-content: space-between;
            font-size: 20px;
            font-weight: bold;
            padding: 10px;
            border-radius: 5px;
            background: #f8f9fa;
        }

        .invoice-info div {
            flex: 1;
            text-align: center;
        }

        .invoice-info strong {
            color: #007bff;
        }

        /* تحسين الجدول */
        table {
            width: 100%;
            border-collapse: collapse;
            border-spacing: 0;
            table-layout: fixed;
            background: #fdfdfd;
            margin-top: 20px;
        }


        th, td {
            padding: 15px;
            text-align: center;
            font-size: 18px;
            font-weight: bold;
            word-wrap: break-word;
        }

        th {
            background-color: #007bff;
            color: white;
            font-size: 20px !important;
            font-weight: bold !important;
            border-bottom: 2px solid #0056b3;
        }

        td {
            background: #ffffff;
            font-size: 18px !important;
        }

        .total-container {
            margin-top: 20px;
            font-size: 25px;
            font-weight: bold;
            text-align: center;
        }

        /* تحسين حجم الورقة وتنسيقها */
        @page {
            size: A4 portrait;
        }

        /* منع الفاتورة من الانقسام إلى صفحات متعددة */
        #invoice-section {
            page-break-inside: avoid;
        }

        /* منع الجدول من الانقسام */
        table {
            page-break-inside: avoid;
        }

        /* تحسين تنسيق الصور */
        .invoice-logo {
            max-width: 140px;
            max-height: 140px;
            display: block;
            margin: 10px auto;
            box-shadow: none !important;

        }

        .qr-code {
            max-width: 200px;
            max-height: 200px;
            margin: 10px auto;

        }


        /* إخفاء الأزرار والعناصر غير الضرورية */
        .btn-print, .no-print {
            display: none !important;
        }
    }


</style>
<?php

/* echo "<pre>";
 print_r($invoice_details);
 echo "</pre>";*/

?>

<div class="content-wrapper">
    <section class="content">
        <div class="container-fluid  d-flex   ">
            <div class="col-6 bg-light  shadow rounded py-5">
                <?php if ($this->session->flashdata('validation_errors')) : ?>
                    <div class="alert alert-danger" id="error-message">
                        <?= $this->session->flashdata('validation_errors'); ?>
                    </div>
                    <?php $this->session->unset_userdata('validation_errors'); ?> <!-- حذف الرسالة بعد عرضها -->
                <?php endif; ?>
                <form action="<?php echo site_url('admin/InvoiceViews/update'); ?>" method="post"
                      enctype="multipart/form-data" id="invoiceForm">
                    <?php echo form_open(); ?>
                    <!-- Hidden Input-->
                    <input type="hidden" name="invoice_id" value="<?= $invoice_details->Id ?>">
                    <!-- تحسين تصميم حقل تحميل الشعار -->
                    <div class="col-12 mb-4" dir="rtl">
                        <label for="formFileLogo" class="form-label ms-3">الشعار</label>
                        <div class="file-upload-wrapper text-center p-4 border rounded bg-white shadow-sm">
                            <i class="file-upload-icon fas fa-cloud-upload-alt fa-3x text-muted mb-3"></i>
                            <div class="file-upload-text">
                                <label for="formFileLogo" class="fs-6 fw-light text-muted">
                                    اسحب وأفلت الصورة هنا أو
                                    <span class="text-primary text-decoration-underline">اختر من مجلدك</span>
                                </label>
                                <input class="form-control d-none" type="file" id="formFileLogo" name="logo"
                                       value="<?php echo isset($default_values->logo) ? $default_values->logo : ''; ?>">
                            </div>
                        </div>
                    </div>

                    <div class="mb-4" dir="rtl">
                        <label for="name" class="form-label">اسم المريض</label>
                        <input type="text" class="form-control shadow-sm" value="<?= $invoice_details->patient_name  ?>" name="patient_name" id="patient_name"
                               placeholder="أدخل اسم المريض">
                    </div>

                    <div class="mb-4" dir="rtl">
                        <label for="tel" class="form-label">رقم الهاتف</label>
                        <input type="text" class="form-control shadow-sm" name="phone_number" value="<?= $invoice_details->phone_number ?>" id="phone_number"
                               placeholder="أدخل رقم الهاتف">
                    </div>


                    <!-- تحسين قسم الخدمات -->

                    <!-- تحسين قسم QR Code -->
                    <div class="mb-4">
                        <label class="form-label">QR Codes</label>
                        <div class="d-flex flex-wrap ">
                            <!-- QR Code 1 -->
                            <div class="col-md-4 col-12 border rounded p-3 text-center bg-white shadow-sm">
                                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24"
                                     fill="#757575" class="icon icon-tabler icons-tabler-filled icon-tabler-file mb-3">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                    <path d="M12 2l.117 .007a1 1 0 0 1 .876 .876l.007 .117v4l.005 .15a2 2 0 0 0 1.838 1.844l.157 .006h4l.117 .007a1 1 0 0 1 .876 .876l.007 .117v9a3 3 0 0 1 -2.824 2.995l-.176 .005h-10a3 3 0 0 1 -2.995 -2.824l-.005 -.176v-14a3 3 0 0 1 2.824 -2.995l.176 -.005h5z"/>
                                    <path d="M19 7h-4l-.001 -4.001z"/>
                                </svg>
                                <div class="file-upload-text">
                                    <label for="formFileImage1" class="fs-6 fw-light text-muted">
                                        ضع QR Code هنا
                                    </label>
                                    <input class="form-control d-none" type="file" id="formFileImage1" name="image1"
                                           accept="image/*" onchange="showImagePreview(event, 1)">
                                </div>
                            </div>

                            <!-- QR Code 2 -->
                            <div class="col-md-4 col-12 border rounded p-3 text-center bg-white shadow-sm">
                                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24"
                                     fill="#757575" class="icon icon-tabler icons-tabler-filled icon-tabler-file mb-3">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                    <path d="M12 2l.117 .007a1 1 0 0 1 .876 .876l.007 .117v4l.005 .15a2 2 0 0 0 1.838 1.844l.157 .006h4l.117 .007a1 1 0 0 1 .876 .876l.007 .117v9a3 3 0 0 1 -2.824 2.995l-.176 .005h-10a3 3 0 0 1 -2.995 -2.824l-.005 -.176v-14a3 3 0 0 1 2.824 -2.995l.176 -.005h5z"/>
                                    <path d="M19 7h-4l-.001 -4.001z"/>
                                </svg>
                                <div class="file-upload-text">
                                    <label for="formFileImage2" class="fs-6 fw-light text-muted">
                                        ضع QR Code هنا
                                    </label>
                                    <input class="form-control d-none" type="file" id="formFileImage2" name="image2"
                                           accept="image/*" onchange="showImagePreview(event, 2)">
                                </div>
                            </div>

                            <!-- QR Code 3 -->
                            <div class="col-md-4 col-12 border rounded p-3 text-center bg-white shadow-sm">
                                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24"
                                     fill="#757575" class="icon icon-tabler icons-tabler-filled icon-tabler-file mb-3">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                    <path d="M12 2l.117 .007a1 1 0 0 1 .876 .876l.007 .117v4l.005 .15a2 2 0 0 0 1.838 1.844l.157 .006h4l.117 .007a1 1 0 0 1 .876 .876l.007 .117v9a3 3 0 0 1 -2.824 2.995l-.176 .005h-10a3 3 0 0 1 -2.995 -2.824l-.005 -.176v-14a3 3 0 0 1 2.824 -2.995l.176 -.005h5z"/>
                                    <path d="M19 7h-4l-.001 -4.001z"/>
                                </svg>
                                <div class="file-upload-text">
                                    <label for="formFileImage3" class="fs-6 fw-light text-muted">
                                        ضع QR Code هنا
                                    </label>
                                    <input class="form-control d-none" type="file" id="formFileImage3" name="image3"
                                           accept="image/*" onchange="showImagePreview(event, 3)">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- تحسين زر الإرسال -->
                    <div class="col-12 col-md-12 justify-content-center">
                        <button class="btn btn-primary w-100 py-3 shadow-sm" type="submit">إضافة الفاتورة</button>
                    </div>

                </form>
            </div>

            <!-- عرض البيانات المدخلة -->
            <div class="col-5 rounded border shadow px-3 " id="invoice-section">
                <div class="col-12 py-3 d-flex justify-content-center overflow-hidden border-bottom ">
                    <div class="rounded-circle bg-dark text-white d-flex align-items-center justify-content-center"
                         id="logoPreview" style="width: 150px; height: 150px; overflow: hidden;">
                        <?php if (!empty($invoice_details->logo)) : ?>
                            <img src="<?= base_url($invoice_details->logo); ?>" alt="الشعار"
                                 style="width: 100%; height: 100%; object-fit: cover;">
                        <?php elseif (!empty($default_values->logo)) : ?>
                            <img src="<?= base_url($default_values->logo); ?>" alt="الشعار"
                                 style="width: 100%; height: 100%; object-fit: cover;">
                        <?php endif; ?>

                    </div>


                </div>
                <div class="col-12 border-bottom py-3">
                    <h2 class="text-center fs-4 fw-bold"
                        id="clinic_name_display"><?= ($default_values->clinic_name) ?></h2>
                </div>

                <div class="col-12 d-flex flex-wrap flex-row-reverse py-3 ">

                    <!-- رقم الفاتورة -->
                    <div class="col-md-4 d-flex flex-column align-items-center text-center">
                        <h6 class="mb-1 fw-bold">رقم الفاتورة</h6>
                        <div id="invoice_number_display" class="px-3 py-1 rounded fw-bold">
                            <?php if (isset($invoice_details->Id)) {
                            echo $invoice_details->Id;
                            } ?>
                        </div>
                    </div>

                    <!-- رقم الهاتف -->
                    <div class="col-md-4 d-flex flex-column align-items-center text-center">
                        <h6 class="mb-1 fw-bold">رقم الهاتف</h6>
                        <div id="phone_number_display"  class="px-3 py-1 fw-bold"><?php if (isset($invoice_details->phone_number)) {
                                echo $invoice_details->phone_number;
                            } ?></div>
                    </div>

                    <!-- التاريخ -->
                    <div class="col-md-4 d-flex flex-column align-items-center text-center ">
                        <h6 class="mb-1 fw-bold">التاريخ</h6>
                        <p id="todayDate" class="px-3 py-1 fw-bold mb-0">
                            <?php if (isset($invoice_details->created_at)) {
                            echo date('d/m/Y', strtotime($invoice_details->created_at));
                            } ?>
                        </p>
                    </div>


                </div>
                <div class="col-12 d-flex flex-wrap flex-row-reverse py-3 ">

                    <!-- اسم المريض -->
                    <div class="col-12 d-flex flex-column align-items-center text-center">
                        <div id="patient_name_display" class=" py-1 fw-bold"><?php if (isset($invoice_details->patient_name)) {
                                echo $invoice_details->patient_name;
                            } ?></div>
                    </div>


                </div>

                <div class="col-12 py-4">
                    <table class="table table-borderless" id="servicesTable">
                        <thead>
                        <tr>
                            <th scope="col">المجموع</th>
                            <th scope="col">العدد</th>
                            <th scope="col">السعر</th>
                            <th scope="col"> اسم الطبيب</th>
                            <th scope="col"> اسم الخدمة</th>

                        </tr>
                        </thead>
                        <tbody id="service_list">
                        <?php if (!empty($services)) :

                            ?>
                            <?php foreach ($services as $service) :
                            ?>
                                <tr>
                                    <td style="width: 15%;"><?=number_format( $service->price * $service->quantity,2,".") ?></td>
                                    <td style="width: 10%;"><?= $service->quantity ?></td>
                                    <td style="width: 15%;"><?=number_format( $service->price ,2,".")?></td>
                                    <td class="doctor-name-display" style="width: 35%;"><?= $service->nameDoctor ?></td>
                                    <td style="width: 25%;" <!--data-id="--><?= $service->service_name; ?>">
                                        <?=  $service->service_name; ?>
                                    </td>
                                </tr>

                            <?php endforeach; ?>
                        <?php endif; ?>
                        </tbody>

                    </table>
                    <div class="d-flex col-12 mt-1 border-top py-4 total-container">
                        <div class="col-6 text-start" id="totalPrice"><?= number_format($invoice_details->total_amount, 2, ".", ",") ?></div>
                        <div class="col-6 text-end">الإجمالي</div>
                    </div>
                    <!-- قسم عرض صور QR في الفاتورة -->
                    <div class="col-12 py-3 border-top ms-3">
                        <div class="row justify-content-center">
                            <div class="col-md-4 col-12 text-center">
                                <div class="qr-code-box" id="qrCode1Preview">

                                    <?php if (!empty($invoice_details->image1)) : ?>
                                        <img src="<?= base_url($invoice_details->image1); ?>" alt="QR Code 1">
                                    <?php elseif (!empty($default_values->image1)) : ?>
                                        <img src="<?= base_url($default_values->image1); ?>" alt="QR Code 1">
                                    <?php else: ?>
                                        <p class="text-muted">لا توجد صورة</p>
                                    <?php endif; ?>

                                </div>
                            </div>

                            <div class="col-md-4 col-12 text-center">
                                <div class="qr-code-box" id="qrCode2Preview">
                                    <?php if (!empty($invoice_details->image2)) : ?>
                                        <img src="<?= base_url($invoice_details->image2); ?>" alt="QR Code 2">
                                    <?php elseif (!empty($default_values->image2)) : ?>
                                        <img src="<?= base_url($default_values->image2); ?>" alt="QR Code 2">
                                    <?php else: ?>
                                        <p class="text-muted">لا توجد صورة</p>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <div class="col-md-4 col-12 text-center">
                                <div class="qr-code-box" id="qrCode3Preview">
                                    <?php if (!empty($invoice_details->image3)) : ?>
                                        <img src="<?= base_url($invoice_details->image3); ?>" alt="QR Code 3">
                                    <?php elseif (!empty($default_values->image3)) : ?>
                                        <img src="<?= base_url($default_values->image3); ?>" alt="QR Code 3">
                                    <?php else: ?>
                                        <p class="text-muted">لا توجد صورة</p>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>


                    <button class="btn btn-primary btn-print" id="printButton"
                    ">طباعة الفاتورة</button>
                </div>

            </div>

        </div>

    </section>

</div>


<script>
    document.addEventListener("DOMContentLoaded", function () {
        // استهداف حقول الإدخال والاستماع إلى التغييرات
        document.getElementById("patient_name").addEventListener("input", function () {
            document.getElementById("patient_name_display").textContent = this.value || " ";
        });
        document.getElementById("phone_number").addEventListener("input", function () {
            document.getElementById("phone_number_display").textContent = this.value || " ";
        });
        // تحديث الشعار عند اختيار صورة جديدة
        document.getElementById("formFileLogo").addEventListener("change", function (event) {
            let file = event.target.files[0];
            let reader = new FileReader();

            reader.onload = function (e) {
                let img = document.createElement("img");
                img.src = e.target.result;
                img.style.width = "100%";
                img.style.height = "100%";
                img.style.objectFit = "cover";
                let logoPreview = document.getElementById("logoPreview");
                logoPreview.innerHTML = ""; // مسح المحتوى القديم
                logoPreview.appendChild(img);
            };

            if (file) {
                reader.readAsDataURL(file);
            }
        });
        document.getElementById("printButton").addEventListener("click", function (event) {
            let patientName = document.getElementById("patient_name").value.trim();
            let phoneNumber = document.getElementById("phone_number").value.trim();

            if (patientName === "" || phoneNumber === "") {
                alert("يرجى إدخال اسم المريض ورقم الهاتف قبل طباعة الفاتورة.");
            } else {
                window.print(); // تنفيذ الطباعة إذا كانت القيم موجودة
            }
        });

    });

</script>
<script>
    function showImagePreview(event, number) {
        let file = event.target.files[0]; // الحصول على الملف المحدد
        let reader = new FileReader();

        reader.onload = function (e) {
            // التحقق مما إذا كان هناك صورة حالية
            let previewDiv = document.getElementById(`qrCode${number}Preview`);
            previewDiv.innerHTML = ""; // مسح أي محتوى قديم

            let img = document.createElement("img");
            img.src = e.target.result;
            img.width = 100; // تحديد العرض
            img.alt = `QR Code ${number}`;

            previewDiv.appendChild(img);
        };

        if (file) {
            reader.readAsDataURL(file); // قراءة الملف وعرضه مباشرة
        }
    }
</script>
<script>
    setTimeout(function() {
        var errorMessage = document.getElementById("error-message");
        if (errorMessage) {
            errorMessage.style.transition = "opacity 0.5s";
            errorMessage.style.opacity = "0";
            setTimeout(() => errorMessage.style.display = "none", 500);
        }
    }, 3000); // 3000ms = 3 ثواني
</script>