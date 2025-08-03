<div class="content-wrapper">
	<!-- Main content -->
	<section class="content container">
		<div class="row patient_form_section">
			<!-- experience area -->
			<div class="col-md-12">
				<div class="box add_area">
					<div class="box-header with-border">
				        <h3 class="box-title"><?php echo trans('doctors') ?> </h3>
				    </div>

					<div class="box-body table-responsive">
						<table class="table table-hover datatables" id="dg_table">
							<thead>
								<tr>
									<th>#</th>
									<th><?php echo trans('thumb') ?></th>
									<th>
										<?php echo trans('doctor-info') ?>
									</th>
									<th></th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($prescription as $key => $row): ?>
									<?php  $patient = get_name_by_id($row->patient_id,'patientses');?>
									<?php  $doctor = get_name_by_id($row->user_id,'users');?>
									<tr>
										<td><?= $key+1;?></td>
										<td><img class="rounded" width="80px" src="<?php echo base_url($doctor['thumb']) ?>"></td>
										<td>
											<h4><?php echo $doctor['name'] ?></h4>
											<p><?php echo $doctor['mobile'] ?></p>
											<p><?php echo $doctor['email'] ?></p>
										</td>

										<td>
											<?php  $rating = check_patient_rating($row->patient_id, $row->user_id);?>

											<?php if ($rating == FALSE): ?>
												
												
												<form id="cat-form" method="post" enctype="multipart/form-data" class="validate-form" action="<?php echo base_url('admin/patients/add_rating')?>" role="form" novalidate>
													
													<!-- <p><?php //echo trans('provide-your-feedback') ?></p> -->

													<div class="starrating risingstar d-flex justify-content-center flex-row-reverse pull-left">
											            <input type="radio" id="star5" name="rating" value="5"><label for="star5" title="5 star"></label>
											            <input type="radio" id="star4" name="rating" value="4"><label for="star4" title="4 star"></label>
											            <input type="radio" id="star3" name="rating" value="3"><label for="star3" title="3 star"></label>
											            <input type="radio" id="star2" name="rating" value="2"><label for="star2" title="2 star"></label>
											            <input type="radio" id="star1" name="rating" value="1"><label for="star1" title="1 star"></label>
											        </div>

													<textarea class="form-control" name="feedback" rows="2" required></textarea>

													<!-- csrf token -->
		          									<input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">

		          									<input type="hidden" name="user_id" value="<?php echo $row->user_id ?>">
		          									<input type="hidden" name="patient_id" value="<?php echo $row->patient_id ?>">

		          									<button type="submit" class="btn btn-primary pull-left"><i class="ficon flaticon-check"></i> <?php echo trans('submit') ?></button>
		          								</form>
											<?php else: ?>
												<h5><?php echo trans('your-feedback') ?></h5>
												
												<p class="mb-0">
													<?php for($i = 1; $i <= 5; $i++):?>
														<?php 
														if($i > $rating->rating){
															$star = '-o';
														}else{
															$star = '';
														}
														?>
														<i class="fa fa-star<?php echo $star;?> fa-2x text-warning"></i> 
													<?php endfor;?>
												</p>

												<p><?php echo $rating->feedback; ?></p>
											<?php endif ?>

										</td>
										
									</tr>
								<?php endforeach ?>
							</tbody>
						</table>

					</div>

				</div>
			</div>

			<div class="pagi m-auto text-center">
				<?= $this->pagination->create_links(); ?>
			</div>

		</div>
	</section>
</div>