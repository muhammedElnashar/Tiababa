<!-- Footer -->
<?php if (isset($menu) && $menu == TRUE): ?>
<footer class="pt-8 pt-lg-10 border-top border-light">

    <div class="container">
        <div class="row pb-8 pb-lg-10">
            <div class="col-sm-5 col-lg-5 mb-5 mb-lg-0">
                <img src="<?php echo base_url(settings()->logo) ?>" class="w-md-30 mb-4" alt="logo">
                <p class="display-10 line-height-lg"><?php echo html_escape(settings()->footer_about) ?></p>
                <ul class="list-unstyled social-icon2 mb-0">
                    <?php if (!empty($settings->facebook)) : ?>
                        <li><a target="_blank" href="<?php echo html_escape($settings->facebook) ?>"><i class="fab fa-facebook-f"></i></a></li>
                    <?php endif ?>

                    <?php if (!empty($settings->twitter)) : ?>
                        <li><a target="_blank" href="<?php echo html_escape($settings->twitter) ?>"><i class="fab fa-twitter"></i></a></li>
                    <?php endif ?>

                    <?php if (!empty($settings->linkedin)) : ?>
                        <li><a target="_blank" href="<?php echo html_escape($settings->linkedin) ?>"><i class="fab fa-linkedin-in"></i></a></li>
                    <?php endif ?>

                    <?php if (!empty($settings->instagram)) : ?>
                        <li><a target="_blank" href="<?php echo html_escape($settings->instagram) ?>"><i class="fab fa-instagram"></i></a></li>
                    <?php endif ?>
                </ul>
            </div>

            <div class="col-sm-1 col-lg-1 mb-5 mb-sm-0"></div>

            <div class="col-sm-3 col-lg-3 mb-5 mb-sm-0">
                <?php if (!empty(get_pages())): ?>
                <h3 class="h4"><?php echo trans('pages') ?></h3>
                <ul class="footer-list-style-two">
                    <?php foreach (get_pages() as $page): ?>
                        <li><a href="<?php echo base_url('page/'.$page->slug) ?>"><?php echo html_escape($page->title) ?></a></li>
                    <?php endforeach ?>
                </ul>
                <?php endif ?>
            </div>

            <div class="col-sm-3 col-lg-3 mb-5 mb-lg-0">
                <h3 class="h4"><?php echo trans('resources') ?></h3>
                <ul class="footer-list-style-two">
                    <li><a href="<?php echo base_url('pricing') ?>"><?php echo trans('pricing') ?></a></li>
                    <?php if (settings()->enable_blog == 1): ?>
                    <li><a href="<?php echo base_url('blogs') ?>"><?php echo trans('blogs') ?></a></li>
                    <?php endif ?>

                    <?php if (settings()->enable_faq == 1): ?>
                    <li><a href="<?php echo base_url('faqs') ?>"><?php echo trans('faqs') ?></a></li>
                    <?php endif ?>
                    <li><a href="<?php echo base_url('contact') ?>"><?php echo trans('contact') ?></a></li>
                </ul>
            </div>

        </div>
    </div>

    <div class="text-center border-top border-light">
        <div class="container">
            <div class="row py-4">
                <div class="col-md-12">
                    <p class="mb-0"><?php echo html_escape(settings()->copyright) ?>.</p>
                </div>
            </div>
        </div>
    </div>

</footer>

<?php else: ?>
    <?php if (isset($page) && $page == 'Profile'): ?>
        <div class="text-center border-top border-light">
            <div class="container">
                <div class="row py-4">
                    <div class="col-md-12">
                        <p class="mb-0">Powrered by <a target="_blank" href="<?php echo base_url() ?>"><img width="80px" src="<?php echo base_url(settings()->logo) ?>"></a> </p>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
<?php endif; ?>
<!-- End Footer -->

</div>
    
    <?php if (settings()->enable_pwa == 1): ?>
        <a class="btn btn-primary bg-primary-soft" id="installPwa" href="#" style="display: none"><i class="bi bi-arrow-down-circle-fill fs-15"></i> Install PWA</a>
    <?php endif; ?>

    <?php include'js_msg_list.php'; ?>
    
    <input type="hidden" id="base_url" value="<?php echo base_url(); ?>">
    <?php $success = $this->session->flashdata('msg'); ?>
    <?php $error = $this->session->flashdata('error'); ?>
    <input type="hidden" id="success" value="<?php echo html_escape($success); ?>">
    <input type="hidden" id="error" value="<?php echo html_escape($error);?>">
    <a href="javascript:void(0)" class="scroll-to-top"><i class="fa fa-angle-up"></i></a>
    
    <!-- Global JS -->
    <script src="<?php echo base_url() ?>assets/front/libs/jquery/dist/jquery.min.js"></script>
    <script src="<?php echo base_url() ?>assets/front/libs/jquery/dist/jquery-migrate.min.js"></script>
    <script src="<?php echo base_url() ?>assets/front/libs/popper.js/dist/umd/popper.min.js"></script>
    <script src="<?php echo base_url() ?>assets/front/libs/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url() ?>assets/front/libs/svg-injector/dist/svg-injector.min.js"></script>
    <script src="<?php echo base_url() ?>assets/front/libs/jarallax/dist/jarallax.min.js"></script>
    <script src="<?php echo base_url() ?>assets/front/libs/svg-injector/dist/svg-injector.min.js"></script>
    <script src="<?php echo base_url() ?>assets/front/libs/owl-carousel/dist/js/owl.carousel.min.js"></script>
    <!-- Custom JS -->
    <script src="<?php echo base_url() ?>assets/front/js/template.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url() ?>assets/front/js/custom.js"></script>
    <script src="<?php echo base_url() ?>assets/admin/js/toast.js"></script>
    <script src="<?php echo base_url()?>assets/admin/js/sweet-alert.min.js"></script>
    <script src="<?php echo base_url() ?>assets/admin/js/validation.js"></script>
    <script src="<?php echo base_url() ?>assets/admin/js/select2.min.js"></script>
    <!-- animation js -->
    <script src="<?php echo base_url() ?>assets/front/js/aos.js"></script>
    <script src="<?php echo base_url() ?>assets/admin/js/timepicki.js"></script>
    <script src="<?php echo base_url() ?>assets/front/js/intlInputPhone.js"></script>

    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.3/themes/smoothness/jquery-ui.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.3/jquery-ui.min.js"></script>


    <script>
        $('.timepicker').timepicki();

        $(document).ready(function() {
           $(".disabled").attr("disabled", true);
         });
    </script>
    <script type="text/javascript">
        $('.input-phone').intlInputPhone();
    </script>

    <?php if (isset($page) && $page == 'Profile'): ?>
        <input type="hidden" id="user_id" value="<?php if(isset($user)){echo $user->id;} ?>">

        <script>

            var base_url = $('#base_url').val();
            var user_id = $('#user_id').val();
            var arrayFromPHP = <?php echo json_encode($not_available) ?>;

            $("#datepicker").datepicker({
                // changeMonth: true,
                // changeYear: true,
                showOtherMonths: true,
                selectOtherMonths: true,
                changeMonth: true,
                changeYear: true,
                showButtonPanel: true,
                minDate: 0,
                dateFormat: 'yy-mm-dd',
                onSelect: function(){
                    var date = $(this).val();
                    
                    var url = base_url+'home/get_time/'+date+'/'+user_id;
                    var post_data = {
                        'csrf_test_name' : csrf_token
                    };

                    $('#load_data').html('<span class="spinner-border spinner-border-sm"></span>');
 
                    $.ajax({
                        type: "POST",
                        url: url,
                        dataType: 'json',
                        data: post_data,
                        success: function(data) {
                            $('#load_data').html(data.result);
                        }
                    })

                },

                beforeShowDay: function(date) {
                   var show = true;
                    //foreach
                    $.each(arrayFromPHP, function (i, elem) {
                        if(date.getDay() == elem-1) show = false
                    });
                   
                   return [show];
                }

            });

        </script>
    <?php endif ?>

    <?php if (settings()->enable_pwa == 1): ?>
        <?php include 'pwa_footer_js.php'; ?>
    <?php endif; ?>


</body>


</html>