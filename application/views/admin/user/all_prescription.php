<div class="content-wrapper">
	<!-- Main content -->
	<section class="content container">
		<div class="row patient_form_section">
			<!-- experience area -->
			<div class="col-md-12">
				<div class="box add_area">
					<div class="box-header with-border">
				        <h3 class="box-title"><?php echo trans('prescriptions') ?> </h3>

				        <?php if (is_user()): ?>
					        <div class="box-tools pull-right">

					        	<!-- <form method="GET" action="<?php echo base_url('admin/prescription/all_prescription') ?>">
					        		<div class="input-group mt-3" style="margin-top: -3px !important">
									  <input type="text" class="form-control" placeholder="Patient name / mr number / phone" name="search" style="height: 30px">
									  <div class="input-group-append">
									    <button class="btn btn-primary br-0" type="submit"><i class="fa fa-search"></i> Search</button>
									  </div>
									</div>
					        	</form> -->

					         	<a href="<?php echo base_url('admin/prescription') ?>" class="pull-right btn btn-light-secondary mt-15 btn-sm"><i class="fa fa-plus"></i> <?php echo trans('create-new-prescription') ?></a>
					        </div>
				        <?php endif ?>
				    </div>

					<div class="box-body table-responsive">
						<table class="table table-hover datatables" id="dg_table">
							<thead>
								<tr>
									<th>#</th>
									<th><?php echo trans('mr.-no') ?></th>
									<th>
										<?php if (is_patient()): ?>
											<?php echo trans('doctor-info') ?>
										<?php else: ?>
											<?php echo trans('patient-name') ?>
										<?php endif ?>
									</th>
									<th><?php echo trans('phone') ?></th>
									<th><?php echo trans('email') ?></th>
									<th><?php echo trans('created') ?></th>
									<th></th>
									<th class="text-center"><?php echo trans('action') ?></th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($prescription as $key => $row): ?>
									<?php  $patient = get_name_by_id($row->patient_id,'patientses');?>
									<tr id="row_<?php echo html_escape($row->id); ?>">
										<td><?= $key+1;?></td>
										<td>#<?= $patient['mr_number'];?></td>
										<td>
											<p class="mb-1 font-weight-bold fs-15">
											<?php if (is_patient()): ?>
												<?php  $doctor = get_name_by_id($row->user_id,'users');?>
												<?php echo $doctor['name'] ?>
											<?php else: ?>
												<?= $patient['name']?>
												<?php if (!empty($patient['age'])): ?>
													<?= $patient['age'] ?> years
												<?php endif ?>
											
												<?php if (!empty($patient['weight'])): ?>
													<?= $patient['weight'] ?> kg
												<?php endif ?>
											<?php endif ?>
											</p>
											<?php if ($row->is_followup == 1): ?>
												<p class="badge badge-primary-soft badge-sm mb-0 badge-pill"><i class="fa fa-refresh"></i> Follow Up</p>
											<?php endif ?>
										</td>
										
										<td><?php echo $patient['mobile'] ?></td>
										<td><?php echo $patient['email'] ?></td>

										<td><?= my_date_show($row->created_at)?></td>

										<td class="text-center">
											<?php $reports = get_reports_by_prescription($row->id); ?>
									
											<?php if (!empty($reports) && $row->check_report == 1): ?>
												<label data-toggle="tooltip" data-title="<?php echo $row->feedback ?>" class="badge badge-success-soft brd-20"> <?php echo trans('feedback-available') ?></label>
											<?php endif ?>

											<?php if (!empty($reports) && $row->check_report != 1): ?>
												<label class="badge badge-secondary-soft brd-20"><i class="flaticon-check ficon"></i> <?php echo trans('report-submitted') ?></label><br>
												<label class="badge badge-danger-soft brd-20"> <?php echo trans('feedback-pending') ?></label>
											<?php endif ?>
										</td>

										<td class="text-center">
											<?php if (is_patient()): ?>
												<a href="<?php echo base_url('admin/patients/prescription/'.$row->id); ?>" data-toggle="tooltip" data-title="<?php echo trans('view-prescription') ?>" class="btn btn-primary"> <i class="fa fa-eye"></i></a>
											<?php else: ?>
												<a href="<?php echo base_url('admin/prescription/single_prescription/'.$row->id); ?>" class="btn btn-light-secondary" data-toggle="tooltip" data-title="<?php echo trans('view-prescription') ?>"> <i class="fa fa-eye"></i></a>

												<a href="<?php echo base_url('admin/prescription/edit/1/'.$row->id); ?>" class="btn btn-light-secondary" data-toggle="tooltip" data-title="<?php echo trans('edit-prescription') ?>"> <i class="fa fa-pencil"></i></a>

												<a href="<?php echo base_url('admin/prescription/edit/2/'.$row->id); ?>" class="btn btn-light-success"> <i class="fa fa-plus"></i> <?php echo trans('create-as-new') ?></a>

												<a data-toggle="tooltip" data-title="<?php echo trans('delete') ?>" data-id="<?php echo html_escape($row->id); ?>" href="<?php echo base_url('admin/prescription/delete/'.$row->id); ?>" class="btn btn-light-danger delete_item"> <i class="fa fa-trash-o"></i></a>
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