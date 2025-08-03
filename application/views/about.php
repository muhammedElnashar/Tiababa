<?php if (isset($is_cdomain) && $is_cdomain == true): ?>
    <?php $site_url = settings()->site_url.'/';?>
<?php else: ?>
    <?php $site_url = base_url();?>
<?php endif; ?>

<?php include'include/profile_header.php'; ?>

<section class="pt-6">
	<div class="container">
		
	
		<?php if (empty($user->about_us)): ?>
			<div class="row align-items-center justify-content-center">
				<div class="col-lg-10 col-xl-8 text-center">
               		<?php include'include/not_found_msg.php'; ?>
               	</div>
            </div>
		<?php else: ?>

		<div class="text-center mb-3">
			<h2 data-aos="fade-up"><?php echo trans('about-us') ?></h2>
		</div>	
		<div class="row">
			
			<p class="mb-5 w-90 w-md-70 mx-auto" data-aos="fade-up"><?php echo html_escape($user->about_us) ?></p>
		</div>

		<?php endif; ?>

	</div>
</section>

<?php if (!empty($educations)): ?>
    <section>
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <h2 class="text-center mb-6"><i class="icon-graduation" ></i> <?php echo trans('educations') ?></h2>

                    <div class="py-2">
                      <!-- timeline 1 -->
                      <?php $e=1; foreach ($educations as $education): ?>
                        <?php if ($e%2 == 0): ?>
                            <div class="row no-gutters">
                                <div class="col-sm"> <!--spacer--> </div>
                                
                                <!-- timeline item 1 center dot -->
                                <div class="col-sm-1 text-center flex-column d-none d-sm-flex">
                                  <div class="row h-50">
                                    <div class="col">&nbsp;</div>
                                    <div class="col">&nbsp;</div>
                                  </div>
                                  <h5 class="m-2">
                                    <span class="badge-round badge-pill badge-primary-soft border">&nbsp;</span>
                                  </h5>
                                  <div class="row h-50">
                                    <div class="col border-right">&nbsp;</div>
                                    <div class="col">&nbsp;</div>
                                  </div>
                                </div>

                                <!-- timeline item 1 event content -->
                                <div class="col-sm py-2">
                                  <div class="card shadow">
                                    <div class="card-body">
                                      <div class="float-right text-muted small"><?php echo html_escape($education->years) ?></div>
                                      <h5 class="card-title text-dark"><?php echo html_escape($education->title) ?></h5>
                                      <p class="card-text"><?php echo html_escape($education->details) ?></p>
                                    </div>
                                  </div>
                                </div>
                            </div>
                        <?php else: ?>
                            <div class="row no-gutters">
                                <div class="col-sm py-2">
                                  <div class="card shadow">
                                    <div class="card-body">
                                      <div class="float-right text-muted small"><?php echo html_escape($education->years) ?></div>
                                      <h5 class="card-title text-dark"><?php echo html_escape($education->title) ?></h5>
                                      <p class="card-text"><?php echo html_escape($education->details) ?></p>
                                    </div>
                                  </div>
                                </div>
                                <div class="col-sm-1 text-center flex-column d-none d-sm-flex">
                                  <div class="row h-50">
                                    <div class="col border-right">&nbsp;</div>
                                    <div class="col">&nbsp;</div>
                                  </div>
                                  <h5 class="m-2">
                                    <span class="badge-round badge-pill badge-primary-soft border">&nbsp;</span>
                                  </h5>
                                  <div class="row h-50">
                                    <div class="col border-right">&nbsp;</div>
                                    <div class="col">&nbsp;</div>
                                  </div>
                                </div>
                                <div class="col-sm"> <!--spacer--> </div>
                            </div>
                        <?php endif ?>
                      <?php $e++; endforeach ?>
                      <!--/row-->
                    </div>

                </div> 
            </div>
        </div>
    </section>
    <?php endif ?>


    <?php if (!empty($experiences)): ?>
    <section>
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <h2 class="text-center mb-6"><i class="icon-bulb" ></i> <?php echo trans('experiences') ?></h2>

                    <div class="py-2">
                      <!-- timeline 1 -->
                      <?php $e=1; foreach ($experiences as $experience): ?>
                        <?php if ($e%2 == 0): ?>
                            <div class="row no-gutters">
                                <div class="col-sm"> <!--spacer--> </div>
                                <!-- timeline item 1 center dot -->
                                <div class="col-sm-1 text-center flex-column d-none d-sm-flex">
                                  <div class="row h-50">
                                    <div class="col">&nbsp;</div>
                                    <div class="col">&nbsp;</div>
                                  </div>
                                  <h5 class="m-2">
                                    <span class="badge-round badge-pill badge-primary-soft border">&nbsp;</span>
                                  </h5>
                                  <div class="row h-50">
                                    <div class="col border-right">&nbsp;</div>
                                    <div class="col">&nbsp;</div>
                                  </div>
                                </div>
                                <!-- timeline item 1 event content -->
                                <div class="col-sm py-2">
                                  <div class="card shadow">
                                    <div class="card-body">
                                      <div class="float-right text-muted small"><?php echo html_escape($experience->years) ?></div>
                                      <h5 class="card-title text-dark"><?php echo html_escape($experience->title) ?></h5>
                                      <p class="card-text"><?php echo html_escape($experience->details) ?></p>
                                    </div>
                                  </div>
                                </div>
                            </div>
                        <?php else: ?>
                            <div class="row no-gutters">
                                <div class="col-sm py-2">
                                  <div class="card shadow">
                                    <div class="card-body">
                                      <div class="float-right text-muted small"><?php echo html_escape($experience->years) ?></div>
                                      <h5 class="card-title text-dark"><?php echo html_escape($experience->title) ?></h5>
                                      <p class="card-text"><?php echo html_escape($experience->details) ?></p>
                                    </div>
                                  </div>
                                </div>
                                <div class="col-sm-1 text-center flex-column d-none d-sm-flex">
                                  <div class="row h-50">
                                    <div class="col border-right">&nbsp;</div>
                                    <div class="col">&nbsp;</div>
                                  </div>
                                  <h5 class="m-2">
                                    <span class="badge-round badge-pill badge-primary-soft border">&nbsp;</span>
                                  </h5>
                                  <div class="row h-50">
                                    <div class="col border-right">&nbsp;</div>
                                    <div class="col">&nbsp;</div>
                                  </div>
                                </div>
                                <div class="col-sm"> <!--spacer--> </div>
                            </div>
                        <?php endif ?>
                      <?php $e++; endforeach ?>
                      <!--/row-->
                    </div>

                </div> 
            </div>
        </div>
    </section>
    <?php endif ?>