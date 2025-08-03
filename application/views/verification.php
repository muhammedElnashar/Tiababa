<div class="d-flex align-items-center position-relative min-vh-100">

    <!-- Left content -->
    <div class="jarallax overlay overlay-primary overlay-70 col-lg-5 col-xl-4 d-none d-lg-flex align-items-center h-100vh px-0"
         data-jarallax data-speed="0.9"
         style="background-image: url(<?php echo base_url() ?>assets/front/img/vericla-cover.jpg);">

        <div class="w-100 p-5 text-center">

            <div class="position-relative">
                <a href="<?php echo base_url() ?>"><h1 class="text-white display-4 font-weight-normal"
                                                       data-aos="fade-up"
                                                       data-aos-duration="300"><?php echo html_escape(settings()->site_name); ?></h1>
                </a>
                <p class="lead text-white-90 mb-0 w-85 w-xl-70 mx-auto" data-aos="fade-up"
                   data-aos-duration="400"><?php echo html_escape(settings()->description) ?>
                </p>
            </div>

            <div class="position-absolute right-0 bottom-0 left-0 text-center text-white p-5">
                <div class="row">
                    <div class="col-6">
                        <p class="mb-0 mt-1"><span
                                    class="text-white-85"> <?php echo html_escape(settings()->copyright) ?></span></p>
                    </div>
                    <div class="col-6">
                        <ul class="list-inline-item mb-0">
                            <li class="list-inline-item"><a href="<?php echo base_url('page/privacy-policy') ?>"
                                                            class="text-white-85 hover-white"><?php echo trans('privacy') ?></a>
                            </li>
                            <li class="list-inline-item"><a href="<?php echo base_url('page/terms-of-service') ?>"
                                                            class="text-white-85 hover-white"><?php echo trans('terms') ?></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- End Left content -->


    <?php if (isset($page_title) && $page_title == 'Email Verification'): ?>
        <!-- email verify -->
        <div class="container">
            <div class="row justify-content-center justify-content-lg-start">
                <div class="col-md-8 col-lg-7 col-xl-5 offset-lg-2 offset-xl-3 my-5" data-aos="fade-down"
                     data-aos-duration="400">


                    <div class="mb-3 text-center">
                        <img class="mb-4" width="30%" src="<?php echo base_url('assets/front/img/verify.png') ?>">
                        <?php if (settings()->enable_email_verify == 1): ?>
                            <p class="lead"><?php echo trans('send-verification-code') ?></p>
                        <?php endif; ?>
                        <?php if (settings()->enable_sms_verify == 1): ?>
                            <p class="lead"><?php echo trans('sms-verified-code') ?></p>
                        <?php endif; ?>
                    </div>

                    <form id="verify_from" method="post" action="<?php echo base_url('auth/verify_account'); ?>">
                        <div class="row justify-content-center">
                            <div class="col-6 mb-2">
                                <div class="form-group">
                                    <input type="text" class="form-control text-center" name="code"
                                           placeholder="Enter Code here">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12 text-center">
                                <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>"
                                       value="<?php echo $this->security->get_csrf_hash(); ?>">
                                <button type="submit" class="btn btn-success btn-blocks mb-0 verify_btn"><i
                                            class="ficon flaticon-check"></i> <?php echo trans('verify-code') ?>
                                </button>
                            </div>
                        </div>


                        <div class="loader mb-2 mt-4 text-primary text-center hide"><?php echo trans('sending') ?> <i
                                    class="fa fa-spinner fa-spin"></i></div>

                        <div class="text-center text-small mt-2">
                            <span><?php echo trans('dont-received-code') ?>
                                <a class="resend_mail" href="<?php echo base_url('auth/resend') ?>"><?php echo trans('resend') ?></a></span>
                        </div>

                    </form>

                </div>
            </div>
        </div>
        <!-- End email verify -->
    <?php endif ?>
</div>






