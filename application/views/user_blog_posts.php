<?php if (isset($is_cdomain) && $is_cdomain == true): ?>
    <?php $site_url = settings()->site_url.'/';?>
<?php else: ?>
    <?php $site_url = base_url();?>
<?php endif; ?>

<?php include'include/profile_header.php'; ?>

<section class="pt-6">
	<div class="container">
		
	
		<?php if (empty($posts)): ?>
			<div class="row align-items-center justify-content-center">
				<div class="col-lg-10 col-xl-8 text-center">
               		<?php include'include/not_found_msg.php'; ?>
               	</div>
            </div>
		<?php else: ?>

		<div class="row align-items-center justify-content-center">
			<div class="col-lg-10 col-xl-8 text-center">
				<h2 class="mb-1" data-aos="fade-up"><?php echo trans('blog-news') ?></h2>
				<p class="mb-5 w-90 w-md-70 mx-auto" data-aos="fade-up"><?php echo trans('learn-more-empower-yourself') ?></p>
				
			</div>
		</div>

		<div class="row">
			<?php $p=1; foreach ($posts as $post): ?>
                <div class="col-md-6 col-lg-4 mb-4 mb-md-5 mb-lg-0 mt-6" data-aos="fade-up" data-aos-delay="<?php echo $p*100; ?>">
				    <article class="card shadow h-100 border-0">
				        <a href="<?php echo base_url('profile/post/'.$user->slug.'/'.$post->slug) ?>">
				            <img class="img-fluid card-img-top" src="<?php echo base_url($post->image) ?>" alt="Image">
				        </a>
				        <div class="card-body p-4 p-xl-6">
				            <div class="d-flex justify-content-between align-items-center mb-4">
				                <a href="#" class="badge badge-pill badge-primary-soft"><?php echo html_escape($post->category) ?></a>
				                <span class="small"><?php echo my_date_show($post->created_at) ?></span>
				            </div>
				            <h3 class="h5">
				                <a class="text-dark" href="<?php echo base_url('profile/post/'.$user->slug.'/'.$post->slug) ?>"><h5><?php echo html_escape($post->title) ?></h5></a>
				            </h3>
				        </div>
				    </article>
				</div>
            <?php $p++; endforeach ?>
		</div>

		<div class="mt-8 mt-lg-10">
			<?php echo $this->pagination->create_links(); ?>
		</div>

		<?php endif; ?>

	</div>
</section>