<div class="content-wrapper">
	<!-- Main content -->
	<section class="content container">
		<div class="row patient_form_section">
			<!-- experience area -->
		
			<div class="col-md-9">
				<div class="box add_area">
					<div class="box-header with-border">
				        <h3 class="box-title"><?php echo trans('rating-reviews') ?></h3>

			            <div class="custom-control custom-switch pull-right h-0 p-1">
			            	<?php if (user()->enable_rating == 1): ?>
			                    <input type="checkbox" name="enable_registration" class="custom-control-input rating_system" value="0" id="switch-2" <?php if(user()->enable_rating == 1){echo "checked";} ?>>
			                    <label class="custom-control-label" for="switch-2"><?php echo trans('disable').' '.trans('rating-in-frontend') ?></label>
			                <?php else: ?>
			                    <input type="checkbox" name="enable_registration" class="custom-control-input rating_system" value="1" id="switch-2">
			                    <label class="custom-control-label" for="switch-2"><?php echo trans('enable').' '.trans('rating-in-frontend') ?></label>
			            	<?php endif ?>
		                </div>
					</div>

					<div class="box-body">
						<div class="row">

							<?php $average = number_format($rating->total_point/$rating->total_user, 1) ?>
							<?php if ($average != 0): ?>
							
								<div class="col-sm-4">
									<div class="rating-block">
										<h4><?php echo trans('average-rating') ?></h4>
										<h2 class="bold"><?php echo $average; ?><small>/5</small></h2>
										 <?php for($i = 1; $i <= 5; $i++):?>
											<?php 
												if ( round($average - .25) >= $i) {
											        $star = "";
											    } elseif (round($average + .25) >= $i) {
											        $star = "-half-o";
											    } else {
											        $star = "-o";
											    }
											?>
											<i class="fa fa-star<?php echo $star;?> fa-2x text-warning"></i> 
										<?php endfor;?>
									</div>
								</div>

								<div class="col-sm-6">
									<h4><?php echo trans('ratings-by-users') ?></h4>
									
									<div class="pull-left">
										<div class="pull-left" style="width:35px; line-height:1;">
											<div style="height:9px; margin:5px 0;">5 <span class="fa fa-star text-warning"></span></div>
										</div>
										<div class="pull-left" style="width:180px;">
											<div class="progress" style="height:9px; margin:8px 0;">
											  <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="5" aria-valuemin="0" aria-valuemax="5" style="width: <?php echo $report->five/$report->total_user*100; ?>%">
												<span class="sr-only"></span>
											  </div>
											</div>
										</div>
										<div class="pull-right" style="margin-left:10px;"><?php echo $report->five ?></div>
									</div>

									<div class="pull-left">
										<div class="pull-left" style="width:35px; line-height:1;">
											<div style="height:9px; margin:5px 0;">4 <span class="fa fa-star text-warning"></span></div>
										</div>
										<div class="pull-left" style="width:180px;">
											<div class="progress" style="height:9px; margin:8px 0;">
											  <div class="progress-bar progress-bar-primary" role="progressbar" aria-valuenow="4" aria-valuemin="0" aria-valuemax="5" style="width: <?php echo $report->four/$report->total_user*100; ?>%">
												<span class="sr-only"></span>
											  </div>
											</div>
										</div>
										<div class="pull-right" style="margin-left:10px;"><?php echo $report->four ?></div>
									</div>

									<div class="pull-left">
										<div class="pull-left" style="width:35px; line-height:1;">
											<div style="height:9px; margin:5px 0;">3 <span class="fa fa-star text-warning"></span></div>
										</div>
										<div class="pull-left" style="width:180px;">
											<div class="progress" style="height:9px; margin:8px 0;">
											  <div class="progress-bar progress-bar-secondary" role="progressbar" aria-valuenow="3" aria-valuemin="0" aria-valuemax="5" style="width: <?php echo $report->three/$report->total_user*100; ?>%">
												<span class="sr-only"></span>
											  </div>
											</div>
										</div>
										<div class="pull-right" style="margin-left:10px;"><?php echo $report->three ?></div>
									</div>

									<div class="pull-left">
										<div class="pull-left" style="width:35px; line-height:1;">
											<div style="height:9px; margin:5px 0;">2 <span class="fa fa-star text-warning"></span></div>
										</div>
										<div class="pull-left" style="width:180px;">
											<div class="progress" style="height:9px; margin:8px 0;">
											  <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="2" aria-valuemin="0" aria-valuemax="5" style="width: <?php echo $report->two/$report->total_user*100; ?>%">
												<span class="sr-only"></span>
											  </div>
											</div>
										</div>
										<div class="pull-right" style="margin-left:10px;"><?php echo $report->two ?></div>
									</div>

									<div class="pull-left">
										<div class="pull-left" style="width:35px; line-height:1;">
											<div style="height:9px; margin:5px 0;">1 <span class="fa fa-star text-warning"></span></div>
										</div>
										<div class="pull-left" style="width:180px;">
											<div class="progress" style="height:9px; margin:8px 0;">
											  <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="1" aria-valuemin="0" aria-valuemax="5" style="width: <?php echo $report->one/$report->total_user*100; ?>%">
												<span class="sr-only"></span>
											  </div>
											</div>
										</div>
										<div class="pull-right" style="margin-left:10px;"><?php echo $report->one ?></div>
									</div>
								</div>	

							<?php else: ?>
								<div class="col-sm-12 text-center">
									<?php echo trans('no-data-found') ?>
								<div class="col-sm-6">
							<?php endif ?>

						</div>			
						
						<div class="row">
							<div class="col-sm-12">
								<hr/>
								<div class="review-block">
									<?php foreach ($ratings as $rating): ?>
										<div class="row">
											<div class="col-sm-2">
												<?php if (empty($rating->patient_thumb)): ?>
													<?php $avatar = 'assets/front/img/avatar.png'; ?>
												<?php else: ?>
													<?php $avatar = $rating->patient_thumb; ?>
												<?php endif ?>
												<img src="<?php echo base_url($avatar) ?>" class="img-thumbnail">
												<div class="review-block-name mt-5"><a href="#"><?php echo $rating->patient_name ?></a></div>
												<div class="review-block-date"><?php echo my_date_show($rating->created_at) ?></div>
											</div>
											<div class="col-sm-10 pl-0">
												<?php for($i = 1; $i <= 5; $i++):?>
													<?php 
													if($i > $rating->rating){
														$star = '-o';
													}else{
														$star = '';
													}
													?>
													<i class="fa fa-star<?php echo $star;?> text-warning"></i> 
												<?php endfor;?>
												<div class="review-block-description mt-10"><?php echo $rating->feedback ?></div>
											</div>
										</div><hr/>
									<?php endforeach ?>
								</div>
							</div>
						</div>
					</div>

				</div>
			</div>

			<div class="pagi m-auto text-center">
				<?= $this->pagination->create_links(); ?>
			</div>

		</div>
	</section>
</div>