<section class="pt-6">


    <div class="container">

        <div class="row justify-content-center mb-5 mb-md-7">
            <div class="col-md-10 col-lg-6 text-center">
                <h2 class="line-height-base"><?php echo trans('get-in-touch') ?></h2>
            </div>
        </div>

        <!-- Form -->
        <div class="row justify-content-center">
            <div class="col-md-8">
                <form method="post" action="<?php echo base_url('home/send_message'); ?>">
                    <div class="row">
                        <div class="col-sm-6 mb-2">
                            <div class="form-group">
                                <label id="name"><?php echo trans('name') ?></label>
                                <input type="text" class="form-control" name="name">
                            </div>
                        </div>

                        <div class="col-sm-6 mb-2">
                            <div class="form-group">
                                <label id="email"><?php echo trans('email') ?></label>
                                <input type="text" class="form-control" name="email" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12 mb-2">
                            <label id="name1"><?php echo trans('message') ?></label>
                            <div class="form-group mb-1">
                                <textarea name="message" id="message" rows="6" class="form-control" required></textarea>
                            </div>
                        </div>
                    </div>

                    <?php if (settings()->enable_captcha == 1 && settings()->captcha_site_key != ''): ?>
                        <div class="row">
                            <div class="col-12 mb-2">
                                <div class="g-recaptcha pull-left" data-sitekey="<?php echo html_escape($settings->captcha_site_key); ?>"></div>
                            </div>
                        </div>
                    <?php endif ?>

                    <!-- csrf token -->
                    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
                    <button type="submit" class="btn btn-primary btn-md"><?php echo trans('submit') ?> </button>
                </form>
            </div>
        </div>
        <!-- End Form -->

    </div>

</section>
