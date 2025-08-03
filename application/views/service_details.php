<?php if (isset($is_cdomain) && $is_cdomain == true): ?>
    <?php $site_url = settings()->site_url.'/';?>
<?php else: ?>
    <?php $site_url = base_url();?>
<?php endif; ?>

<?php include'include/profile_header.php'; ?>

<div class="jarallax min-height-lg-60vh h-500 py-9 py-lg-11 py-xl-15" data-jarallax data-speed="1" style="background-image: url(<?php echo base_url($service->image) ?>);"></div>

<section>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-9">
                <h2 class="mb-5"><?php echo html_escape($service->title) ?></h2>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-9">
                <article>
                    <p><?= ($service->details) ?></p>
                </article>
            </div>
        </div>
    </div>
</section>




