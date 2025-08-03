
    <section class="border-bottom border-light py-8 py-lg-10">
        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-md-12 col-lg-6 order-md-1 pr-lg-5 pr-xl-0 mb-7 mb-lg-0">
                    <span class="badge badge-pill badge-primary-soft mb-3" data-aos="zoom-in">One platform for all doctors</span>
                    <h1 data-aos="fade-left" data-aos-delay="150" class="display-4 font-weight-bold mb-4"><?php echo html_escape(settings()->site_title) ?></h1>
                    <p data-aos="fade-left" data-aos-delay="250" class="text-dark line-height-sm mb-4 mb-lg-4"><?php echo html_escape(settings()->description) ?></p>
                    <div>
                        <?php if ($this->session->userdata('logged_in') != TRUE): ?>
                            <?php if (settings()->trial_days != 0): ?>
                                <a href="<?php echo base_url('register?trial=start') ?>" class="btn btn-primary btn-pill mr-2" data-aos="fade-left" data-aos-delay="400"><?php echo settings()->trial_days; ?> <?php echo trans('days-free-trial') ?></a>
                            <?php endif ?>
                        <?php endif ?>
                    </div>
                </div>

                <div class="col-md-12 col-lg-6 order-md-2">
                    <div class="banner-img" data-aos="zoom-in" data-aos-delay="100">
                        <img src="<?php echo base_url(settings()->hero_img) ?>" class="text-right" alt="Hero Image">
                    </div>
                </div>

            </div>
        </div>
    </section>


    <!-- Workflow -->
    <?php if (settings()->enable_workflow == 1): ?>
    <section class="py-6">
        <div class="container">

            <div class="w-md-80 w-lg-50 text-center mx-auto mb-8 mb-lg-10" data-aos="fade-up">
                <h3><?php echo trans('workflow') ?></h3>
                <p><?php echo trans('workflow-title') ?></p>
            </div>

            <?php if (!empty($workflows)): ?>
                <div class="row">
                    <?php foreach ($workflows as $workflow): ?>
                        <div class="col-md-4 mb-7 mb-md-0" data-aos="zoom-in-up" data-aos-delay="150">
                            <div class="text-center">
                                <div class="mb-5 workflow-img"><img class="display-5" src="<?php echo base_url($workflow->image) ?>" alt=""></div>
                                <h5><?php echo html_escape($workflow->title) ?></h5>
                                <p class="mb-0 mx-auto w-95 w-lg-85 display-9 line-height-lg"><?php echo html_escape($workflow->details) ?></p>
                            </div>
                        </div>
                    <?php endforeach ?>
                </div>
            <?php else: ?>
                <div class="row">

                    <div class="col-md-4 mb-7 mb-md-0" data-aos="zoom-in-up" data-aos-delay="150">
                        <div class="text-center">
                            <div class="mb-5 workflow-img"><img class="display-5" src="<?php echo base_url() ?>assets/front/img/plan.svg" alt="..."></div>
                            <h5><?php echo trans('choose-plan') ?></h5>
                            <p class="mb-0 mx-auto w-95 w-lg-85 display-9 line-height-lg"><?php echo trans('choose-your-confortable-plan') ?></p>
                        </div>
                    </div>

                    <div class="col-md-4 mb-7 mb-md-0" data-aos="zoom-in-up" data-aos-delay="200">
                        <div class="text-center">
                            <div class="mb-5 workflow-img"><img class="display-5" src="<?php echo base_url() ?>assets/front/img/payment.svg" alt="..."></div>
                            <h5><?php echo trans('get-paid') ?></h5>
                            <p class="mb-0 mx-auto w-95 w-lg-85 display-9 line-height-lg"><?php echo trans('get-paid-title') ?></p>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="text-center" data-aos="zoom-in-up" data-aos-delay="250">
                            <div class="mb-5 workflow-img"><img class="display-5" src="<?php echo base_url() ?>assets/front/img/work.svg" alt="..."></div>
                            <h5><?php echo trans('start-working') ?></h5>
                            <p class="mb-0 mx-auto w-95 w-lg-85 display-9 line-height-lg"><?php echo trans('start-working-title') ?></p>
                        </div>
                    </div>

                </div>
            <?php endif ?>


        </div>
    </section>
    <?php endif; ?>
    <!-- End Workflow -->


    <!-- features -->
    <?php if (!empty($features)): ?>
        <section class="pt-8 pt-md-5 pt-xl-0 mt-9">

            <div class="text-center mx-auto mb-6 mt-6 w-lg-40">
                <h3 data-aos="fade-up"><?php echo trans('feature-home-title') ?></h3>
                <p data-aos="fade-up" data-aos-delay="150"><?php echo trans('using') ?> <?php echo html_escape(settings()->site_name) ?> <?php echo trans('feature-home-desc') ?></p>
            </div>

            <div class="container">
                <?php $i=1; foreach ($features as $feature): ?>
                    <div class="row align-items-center justify-content-center mt-6 mb-6" data-aos="fade-<?php if ($i % 2 == 0){echo 'left';}else{echo 'right';} ?>">
                        <?php if ($i % 2 == 0): ?>
                            <div class="col-10 col-sm-9 col-md-6 col-lg-7 text-center pr-md-5 pr-lg-10 mb-5 mb-md-0">
                                <img src="<?php echo base_url($feature->image) ?>" class="screen-one" alt="Feature Image">
                            </div>

                            <div class="col-md-6 col-lg-5">
                                <h4 class="h3 mb-4"><?php echo html_escape($feature->name); ?></h4>
                                <p class="lead mb-6"><?php echo html_escape($feature->details); ?></p>
                            </div>
                        <?php else: ?>
                            <div class="col-md-6 col-lg-5 order-2 order-md-1">
                                <h4 class="h3 mb-4"><?php echo html_escape($feature->name); ?></h4>
                                <p class="lead mb-6"><?php echo html_escape($feature->details); ?></p>
                            </div>

                            <div class="col-10 col-sm-9 col-md-6 col-lg-7 text-center mb-5 mb-md-0 pl-md-5 pl-lg-10 order-1 order-md-2">
                                <img src="<?php echo base_url($feature->image) ?>" class="screen-one" alt="Feature Image">
                            </div>
                        <?php endif ?>
                    </div>
                <?php $i++; endforeach; ?>
            </div>
        </section>
    <?php endif; ?>
    <!-- features -->



    <!-- Blog -->
    <?php if (settings()->enable_blog == 1 && !empty($posts)): ?>
        <section class="bg-light pt-6">
            <div class="container">
                <div class="text-center mb-5 mt-5 mb-lg-7 mt-0 mt-lg-5 mt-xl-0" data-aos="fade-up">
                    <h3 class="h2 mb-6 mt-6"><?php echo trans('learn-more-empower-yourself') ?></h3>
                </div>

                <div class="row">
                    <?php $p=1; foreach ($posts as $post): ?>
                        <?php include'include/blog_post_item.php'; ?>
                    <?php $p++; endforeach ?>
                </div>
            </div>
        </section>
    <?php endif ?>
    <!-- End Blog -->



    <section class="pt-6 get_started">
        <div class="container">
            <div class="row justify-content-center">
            <div class="text-center col-md-6 mb-5 mt-5 mb-lg-7 mt-0 mt-lg-5 mt-xl-0">
                <h3 data-aos="fade-up" class="h1 mb-2 mt-4 text-light font-weight-normal"><?php echo trans('start-using') ?> <?php echo html_escape(settings()->site_name) ?> <?php echo trans('account') ?></h3>
                <p data-aos="fade-up" data-aos-delay="150" class="text-light"><?php echo trans('home-intro-desc') ?></p>
                <a data-aos="fade-up" data-aos-delay="250" href="<?php echo base_url('register') ?>" class="badge badge-light badge-pill py-3"><?php echo trans('get-started') ?> <i class="fas fa-long-arrow-alt-right"></i></a>
            </div>
            </div>
        </div>
    </section>