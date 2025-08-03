<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
<link rel="stylesheet" href="../css/style.css">
<style>
    a{
        color: #007bff;
        text-decoration: none;
        transition: color 0.3s ease;
    }
</style>
<div class="content-wrapper">
    <section class="content">
        <div class="col-12   px-3  rounded py-5">
            <h2 class="text-center mb-4">البيانات الاساسية  </h2>
            <?php if ($this->session->flashdata('success')): ?>
                <div class="alert alert-success flash-message">
                    <?php echo $this->session->flashdata('success'); ?>
                </div>
                <?php $this->session->unset_userdata('success'); ?>
            <?php endif; ?>

            <?php if ($this->session->flashdata('error')): ?>
                <div class="alert alert-danger flash-message">
                    <?php echo $this->session->flashdata('error'); ?>
                </div>
                <?php $this->session->unset_userdata('error'); ?>
            <?php endif; ?>


                        <?php echo validation_errors(); ?>

            <!-- نموذج تحديث القيم الافتراضية -->
            <form action="<?php echo site_url('admin/DefaultValuesController/update_default_values'); ?>" method="post" enctype="multipart/form-data">
                <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
                <div class="row">


                    <div class="col-md-6 mb-3">
                        <label for="clinic_name" class="form-label">اسم المجمع</label>
                        <input type="text" class="form-control" name="clinic_name" id="clinic_name" value="<?php echo set_value('clinic_name', $default_values->clinic_name ?? ""); ?>" required placeholder="أدخل اسم المجمع">

                    </div>

                <div class="col-md-6 mb-3">
                    <label for="address" class="form-label">العنوان</label>
                    <input type="text" class="form-control" name="address" id="address" value="<?php echo set_value('address', $default_values->address ?? ""); ?>"  placeholder="أدخل العنوان">
                </div>

                <div class="col-md-6 mb-3">
                    <label for="logo" class="form-label">الشعار</label>
                    <input type="file" class="form-control" name="logo" id="logo">
                    <?php if (!empty($default_values->logo)): ?>
                        <img src="<?php echo base_url($default_values->logo); ?>"
                             alt="الشعار" width="100" style="border: 1px solid #ddd; padding: 5px;">
                    <?php endif; ?>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="image1" class="form-label">الصورة 1</label>
                    <input type="file" class="form-control" name="image1" id="image1">
                    <?php if (!empty($default_values->image1)): ?>
                        <img src="<?php echo base_url($default_values->image1); ?>" alt="الصورة 1" width="100">
                    <?php endif; ?>
                </div>

                <div class=" col-md-6 mb-3">
                    <label for="image2" class="form-label">الصورة 2</label>
                    <input type="file" class="form-control" name="image2" id="image2">
                    <?php if (!empty($default_values->image2)): ?>
                        <img src="<?php echo base_url($default_values->image2); ?>" alt="الصورة 2" width="100">
                    <?php endif; ?>
                </div>

                <div class="mb-3 col-md-6">
                    <label for="image3" class="form-label">الصورة 3</label>
                    <input type="file" class="form-control" name="image3" id="image3">
                    <?php if (!empty($default_values->image3)): ?>
                        <img src="<?php echo base_url($default_values->image3); ?>" alt="الصورة 3" width="100">
                    <?php endif; ?>
                </div>

                <div class="col-12 mb-3">
                    <button class="btn btn-success w-100" type="submit">تحديث البيانات الاساسية </button>
                </div>
            </form>
        </div>

    </section>

</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        setTimeout(function () {
            var flashMessages = document.querySelectorAll(".flash-message");
            flashMessages.forEach(function (message) {
                message.style.transition = "opacity 0.5s ease";
                message.style.opacity = "0";
                setTimeout(function () {
                    message.remove();
                }, 500);
            });
        }, 3000);
    });
</script>
