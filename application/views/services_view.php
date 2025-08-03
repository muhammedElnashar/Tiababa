
<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>

<!-- تضمين ملفات CSS الخاصة بـ Bootstrap -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<!-- تضمين jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- تضمين ملفات JavaScript الخاصة بـ Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<style>
    .service-name{
        font-size: 24px;
        font-weight: bold;
        font-family: "IBM Plex Sans Arabic";
    }
    @import url('https://fonts.googleapis.com/css2?family=IBM+Plex+Sans+Arabic:wght@100;200;300;400;500;600;700&display=swap');
    .content{
        font-family: "IBM Plex Sans Arabic", serif;
    }
    a {
        text-decoration: none;
    }

    .bg {
        background: linear-gradient(#ffffff, #C7FBFF);
    }

    /* تحسين تنسيق الجدول */
    .table-responsive {
        border-radius: 10px;

    }

    .table th, .table td {

        padding: 15px;
        vertical-align: middle;
    }

    .table th {
        font-family: "IBM Plex Sans Arabic" !important;
        font-size: 30px;
        font-weight: bold !important;

    }
    .table td {
        font-family: "IBM Plex Sans Arabic";
        font-size: 17px;

    }


    /* تحسين قسم الإجمالي */
    .total-container {
        display: flex;
        justify-content: space-between;
        align-items: center;
        font-size: 1.2rem;
        font-weight: bold;
        background-color: #f8f9fa;
        padding: 15px;
        border-radius: 10px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }
    .currency {
        margin-left: 60px; /* تحكم في المسافة */
    }
    #checkoutBtn {
        background-color: #529ce0; /* لون أزرق هادئ */
        color: white;
        font-size: 1.1rem;
        font-weight: bold;
        padding: 12px;
        border-radius: 8px;
        border: none;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease-in-out;
    }

    #checkoutBtn:hover {
        background-color: #0056b3; /* لون أزرق أغمق عند التحويم */
        box-shadow: 0 6px 10px rgba(0, 0, 0, 0.15);
    }

    #checkoutBtn:focus {
        outline: none;
        box-shadow: 0 0 8px rgba(0, 123, 255, 0.5);
    }


</style>

<div class="content-wrapper" >
    <div class="h2 fw-bold text-end me-5 " style="font-family:'IBM Plex Sans Arabic'">صفحة الخدمات </div>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-8 " >
                <div class="container">
                    <div class="row g-3"> <!-- إضافة فاصل بين العناصر -->
                        <?php foreach ($services as $service): ?>
                            <div class="col-12 col-sm-6 col-md-4 col-lg-3 col-xl-2"> <!-- توزيع متجاوب مع جميع الشاشات -->
                                <div class="bg border shadow-sm rounded p-3 h-100 d-flex flex-column justify-content-between">
                                    <div class="d-flex justify-content-between">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="#cac9c9"
                                             class="icon icon-tabler icons-tabler-filled icon-tabler-star">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                            <path d="M8.243 7.34l-6.38 .925l-.113 .023a1 1 0 0 0 -.44 1.684l4.622 4.499l-1.09 6.355l-.013 .11a1 1 0 0 0 1.464 .944l5.706 -3l5.693 3l.1 .046a1 1 0 0 0 1.352 -1.1l-1.091 -6.355l4.624 -4.5l.078 -.085a1 1 0 0 0 -.633 -1.62l-6.38 -.926l-2.852 -5.78a1 1 0 0 0 -1.794 0l-2.853 5.78z"/>
                                        </svg>

                                        <div class="dropdown">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                 stroke="#656363" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                 class="icon icon-tabler icons-tabler-outline icon-tabler-menu-4"
                                                 data-bs-toggle="dropdown" aria-expanded="false" style="cursor: pointer;">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                <path d="M7 6h10"/>
                                                <path d="M4 12h16"/>
                                                <path d="M7 12h13"/>
                                                <path d="M7 18h10"/>
                                            </svg>

                                            <ul class="dropdown-menu p-2">
                                                <li class="mb-1">
                                                    <button class="dropdown-item text-center text-white bg-warning rounded"
                                                            data-bs-toggle="modal" data-bs-target="#editModal"
                                                            data-id="<?php echo $service->id; ?>"
                                                            data-service_name="<?php echo $service->service_name; ?>"
                                                            data-price="<?php echo $service->price; ?>"
                                                            data-name_doctor="<?php echo $service->nameDoctor; ?>"
                                                    >
                                                        تعديل
                                                    </button>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item text-white bg-danger rounded text-center"
                                                       href="<?php echo site_url('admin/ServicesView/delete_service/' . $service->id); ?>"
                                                       onclick="return confirm('هل أنت متأكد من حذف هذه الخدمة؟');">
                                                        حذف
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>

                                    <div class="col-12 py-4 text-center service-item" data-id="<?php echo $service->id; ?>" data-doctor="<?php echo $service->nameDoctor?>">
                                        <h3 class="fs-5 d-none"> <?php echo $service->id; ?> </h3>
                                        <h3 class="fs-5 d-none"> <?php echo $service->created_at; ?> </h3>
                                        <h3 class="fs-5 service-name"> <?php echo $service->service_name; ?> </h3>
                                        <h3 class="fs-5 service-price d-none"> <?php echo $service->price; ?> </h3>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>                    <div class=" mt-4">
                        <button class="btn btn-white border bg-white shadow w-100 py-3"
                                data-bs-toggle="modal" data-bs-target="#addModal">
                            اضف المزيد من الخدمات
                        </button>
                    </div>

                </div>
            </div>

            <div class="col-4 d-none">
                <div class="table-responsive">
                    <form action="<?php echo base_url('admin/InvoiceViews'); ?>" method="post">
                        <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>"
                               value="<?php echo $this->security->get_csrf_hash(); ?>" />

                        <table style="font-family:'IBM Plex Sans Arabic'" class="table" id="orderTable">
                            <thead class="text-end">
                            <tr>
                                <th>اسم الخدمة</th>
                                <th>الكمية</th>
                                <th>السعر</th>
                                <th>الإجمالي</th>
                                <th>إزالة</th>
                            </tr>
                            </thead>
                            <tbody class="text-end">
                            <!-- سيتم إضافة الطلبات هنا -->
                            </tbody>
                        </table>
                        <input type="hidden" name="grand_total" id="grandTotalInput">

                        <div class="d-flex col-12 mt-1 border-top py-4 total-container">
                            <div class="col-6 text-start" id="totalPrice">0</div>
                            <div class="col-6 text-end">الإجمالي</div>
                        </div>

                        <div class="text-center mt-3">
                            <button type="submit" class="btn w-100 py-3 mb-0" id="checkoutBtn">
                                Submit
                            </button>
                        </div>
                    </form>
                </div>
            </div>


            <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="addModalLabel">إضافة الخدمة</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="<?php echo site_url('admin/ServicesView'); ?>">
                                <?php echo form_open('ServicesView'); ?>

                                <label for="service_name">اسم الخدمة:</label>
                                <input type="text" id="service_name" name="service_name" class="form-control"
                                       required><br><br>

                                <label for="nameDoctor">اسم الطبيب:</label>
                                <input type="text" id="nameDoctor" name="nameDoctor" class="form-control" required><br><br>

                                <label for="price">السعر:</label>
                                <input type="number" id="price" name="price" class="form-control" required><br><br>

                                <button type="submit" class="btn btn-primary">إضافة</button>
                            </form>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إغلاق</button>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal التعديل -->
            <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editModalLabel">تعديل الخدمة</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <!-- نموذج التعديل داخل الـ Modal -->
                            <?php echo form_open('admin/ServicesView/edit_service'); ?> <!-- تعديل هنا -->

                            <input type="hidden" id="service_id" value="<?php ?>" name="service_id">
                            <div class="mb-3">
                                <label for="edit_service_name" class="form-label">اسم الخدمة</label>
                                <input type="text" class="form-control" id="edit_service_name" name="service_name"
                                       required>
                            </div>
                            <div class="mb-3">
                                <label for="nameDoctor" class="form-label">اسم الطبيب</label>
                                <input type="text" class="form-control" id="name_doctor" name="nameDoctor" required>
                            </div>
                            <div class="mb-3">
                                <label for="edit_price" class="form-label">السعر</label>
                                <input type="number" class="form-control" id="edit_price" name="price" required>
                            </div>
                            <button type="submit" class="btn btn-primary">تحديث</button>

                            <?php echo form_close(); ?> <!-- إغلاق form_open() -->
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>

</div>
<script src="https://kit.fontawesome.com/a076d05399.js"></script>
<script>
    $(document).ready(function () {
        let orderTableContainer = $(".col-4.d-none");

        $(".service-item").on("click", function () {
            let serviceName = $(this).find(".service-name").text();
            let serviceId = $(this).data("id"); // استخراج ID الخدمة
            let doctorName= $(this).data("doctor");

            let servicePrice = parseFloat($(this).find(".service-price").text());

            let existingRow = $("#orderTable tbody").find(`tr[data-name='${serviceName}']`);
            if (existingRow.length > 0) {
                let qtySpan = existingRow.find(".qty-span");
                let qtyInput = existingRow.find(".qty-input");
                let newQty = parseInt(qtySpan.text()) + 1;
                qtySpan.text(newQty);
                qtyInput.val(newQty); // ✅ تحديث قيمة الإدخال المخفي للكمية
                updateTotal(existingRow);
            } else {
                let newRow = `
                <tr data-name="${serviceName}" data-id="${serviceId}" data-doctor=${doctorName}>
                    <td>${serviceName}</td>
                    <td>
                        <a class="btn btn-sm btn-outline-dark decrease-btn">-</a>
                        <span class="qty-span mx-2">1</span>
                        <a class="btn btn-sm btn-outline-dark increase-btn">+</a>
                    </td>
                    <td class="service-price">${servicePrice.toFixed(2)}</td>
                    <td class="total-price">${servicePrice.toFixed(2)}</td>
                    <td><button class="btn btn-danger remove-btn"><i class="fa fa-trash"></i></button></td>

                    <input type="hidden" name="services[]" value="${serviceName}">
                     <input type="hidden" name="services_ids[]" value="${serviceId}">
                     <input type="hidden" name="nameDoctor[]" value="${doctorName}">
                    <input type="hidden" name="quantities[]" value="1" class="qty-input"> <!-- ✅ تأكد من تحديث هذه القيمة -->
                <input type="hidden" name="prices[]" value="${servicePrice.toFixed(2)}">
                <input type="hidden" name="totals[]" value="${servicePrice.toFixed(2)}" class="total-input">
                </tr>`;
                $("#orderTable tbody").append(newRow);
                }

                updateGrandTotal();
                toggleTableVisibility();
                });

                $(document).on("click", ".increase-btn", function () {
                let row = $(this).closest("tr");
                let qtySpan = row.find(".qty-span");
                let qtyInput = row.find(".qty-input");
                let newQty = parseInt(qtySpan.text()) + 1;
                qtySpan.text(newQty);
                qtyInput.val(newQty); // ✅ تحديث قيمة الإدخال المخفي للكمية
                updateTotal(row);
                });

                $(document).on("click", ".decrease-btn", function () {
                let row = $(this).closest("tr");
                let qtySpan = row.find(".qty-span");
                let qtyInput = row.find(".qty-input");
                let newQty = parseInt(qtySpan.text()) - 1;
                if (newQty >= 1) {
                qtySpan.text(newQty);
                qtyInput.val(newQty); // ✅ تحديث قيمة الإدخال المخفي للكمية
                updateTotal(row);
                }
                });

                $(document).on("click", ".remove-btn", function () {
                $(this).closest("tr").remove();
                updateGrandTotal();
                toggleTableVisibility();
                });

                function updateTotal(row) {
                let qty = parseInt(row.find(".qty-span").text());
                let price = parseFloat(row.find(".service-price").text());
                let total = qty * price;
                row.find(".total-price").text(total.toFixed(2));
                row.find(".total-input").val(total.toFixed(2)); // ✅ تحديث الإدخال المخفي للإجمالي
                updateGrandTotal();
                }

                function updateGrandTotal() {
                let grandTotal = 0;
                $(".total-price").each(function () {
                grandTotal += parseFloat($(this).text());
                });

                    // تحديث القيمة في العنصر المرئي
                $("#totalPrice").html(grandTotal.toFixed(2) + '<span class="currency"> IQD</span>');

                    // تحديث القيمة في الحقل المخفي لإرساله في الفاتورة
                $("#grandTotalInput").val(grandTotal.toFixed(2));
                }

                function toggleTableVisibility() {
                if ($("#orderTable tbody tr").length > 0) {
                orderTableContainer.removeClass("d-none");
                } else {
                orderTableContainer.addClass("d-none");
                }
                }
                });
</script>

<script>
    $(document).ready(function () {
        $('#editModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget); // الزر الذي تم النقر عليه
            var serviceId = button.data('id'); // جلب ID الخدمة
            var serviceName = button.data('service_name'); // جلب اسم الخدمة
            var price = button.data('price'); // جلب السعر
            var nameDoctor= button.data('name_doctor');

            var modal = $(this);
            modal.find('#service_id').val(serviceId);
            modal.find('#edit_service_name').val(serviceName);
            modal.find('#edit_price').val(price);
            modal.find('#name_doctor').val(nameDoctor);
        });
    });
</script>






