<?php if (isset($is_cdomain) && $is_cdomain == true): ?>
    <?php $site_url = settings()->site_url.'/';?>
<?php else: ?>
    <?php $site_url = base_url();?>
<?php endif; ?>

<?php include'include/profile_header.php'; ?>

<div class="jarallax min-height-lg-60vh h-500 py-9 py-lg-11 py-xl-15" data-jarallax data-speed="1" style="background-image: url(<?php echo base_url($post->image) ?>);"></div>

<section>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-9">
                <h2 class="mb-5"><?php echo html_escape($post->title) ?></h2>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-9">
                <article>
                    <p><?= ($post->details) ?></p>
					<?php if (!empty($tags)): ?>
						<div class="my-6 my-md-11">
							<div class="h5"><?php echo trans('tags') ?>:</div>
							<?php foreach ($tags as $tag): ?>
								<a href="#" class="badge badge-light">#<?php echo html_escape($tag->tag) ?></a>
							<?php endforeach ?>
						</div>
					<?php endif ?>
                </article>
            </div>
        </div>
    </div>
</section>




