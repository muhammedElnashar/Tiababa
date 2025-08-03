<?php if (isset($is_cdomain) && $is_cdomain == true): ?>
    <?php $site_url = settings()->site_url.'/';?>
<?php else: ?>
    <?php $site_url = base_url();?>
<?php endif; ?>

<?php include'include/profile_header.php'; ?>

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
                <form method="post" action="<?php echo base_url('send-message'); ?>">
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

                    <!-- csrf token -->
                    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
                    <input type="hidden" name="user_id" value="<?php echo html_escape($user->id) ?>">
                    <button type="submit" class="btn btn-primary btn-md"><?php echo trans('submit') ?> </button>
                </form>
            </div>
        </div>
        <!-- End Form -->

    </div>

</section>
