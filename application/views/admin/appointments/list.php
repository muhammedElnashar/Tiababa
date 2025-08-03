
<div class="content-wrapper">
  <!-- Main content -->
  <section class="content container">

  <div class="row">
   
    <!-- experience area -->
    <div class="col-md-12">
      <div class="box add_area">
        <div class="box-header with-border">
            <h3 class="box-title"><?php echo trans('appointments') ?> - <?php echo my_date_show($date) ?> - <b><i class="icon-people"></i> <?php echo count($appointments) ?></h3>
            <div class="box-tools pull-right mt-15">
              <a href="<?php echo base_url('admin/appointment/all_list');?>" class="btn btn-light-secondary btn-sm pull-right" data-toggle="tooltip" data-placement="top" title=""> <?php echo trans('see-list') ?> <i class="fa fa-long-arrow-right"></i></a>

              <a href="#" class="btn btn-light-success btn-sm pull-right print_apn_list mr-10" data-toggle="tooltip" data-placement="top" title=""><i class="fa fa-print"></i> <?php echo trans('print') ?></a>
            </div>
        </div>

        <div class="box-body p-0" id="print_area">
          
          <div class="table-responsive mt-50">
            <div class="list-head text-center mb-20">
              <h3><?php echo trans('patients-serial-list') ?> </b></h3>
            </div>

            <table class="table table-hover tb">
                <thead>
                    <tr>
                        <th>#</th>
                        <th><?php echo trans('patient-info') ?></th>
                        <th><?php echo trans('consultation-type') ?></th>
                        <th><?php echo trans('schedule-info') ?></th>
                        <th><?php echo trans('payment') ?></th>
                        <th class="hide_pnts"><?php echo trans('status') ?></th>
                        <?php if (is_user()): ?>
                          <th class="hide_pnt"><?php echo trans('action') ?></th>
                        <?php endif; ?>
                        <th class="hide_pnt"></th>
                        <th class=""></th>
                    </tr>
                </thead>
                <tbody>
                  <?php $i=1; foreach ($appointments as $amp): ?>
                    <tr id="row_<?php echo html_escape($amp->id); ?>" style="background: #<?php if($amp->status == 1){echo "eefaf6";}else{echo "fff";} ?>">
                        <td width="2%"><?php echo html_escape($amp->serial_id); ?></td>
                        <td>
                          <p class="mb-0"><?php echo html_escape($amp->name); ?> (MR: #<?php echo html_escape($amp->mr_number); ?>)</p>
                          <p class="mb-0"><?php echo trans('phone') ?>: <?php echo html_escape($amp->mobile); ?></p>
                          <p><?php echo html_escape($amp->email); ?></p>
                        </td>
                        <td>
                          <?php if ($amp->type == 'online'): ?>
                            <label class="badge badge-danger-soft brd-20"><i class="fa fa-circle"></i> <?php echo trans('online') ?> </label>
                            <label class="badge badge-secondary-soft brd-20"><?php echo trans('fee') ?>  <?php echo currency_symbol(user()->currency); ?><?php echo html_escape(evisit_settings(user()->id)->price) ?> </label>
                          <?php else: ?>
                            <label class="badge badge-secondary-soft brd-20"><i class="fa fa-circle"></i> <?php echo trans('offline') ?></label>
                          <?php endif ?>
                        </td>
                        <td>
                          <label class="badge badge-primary-soft brd-20"><i class="fa fa-calendar"></i> <?php echo my_date_show($amp->date); ?></label><br>
                          <label class="badge badge-primary-soft brd-20"><i class="fa fa-clock-o"></i> <?php echo $amp->time; ?></label>
                        </td>
                        <td>
                          <?php $payment = check_appointment_payment($amp->id, $amp->user_id); ?>
                          <?php if ($payment == TRUE): ?>
                            <label class="badge badge-success-soft brd-20"><i class="fa fa-check-circle"></i> <?php echo trans('paid') ?></label>
                          <?php else: ?>
                            <label class="badge badge-danger-soft brd-20"><i class="fa fa-clock-o"></i> <?php echo trans('pending') ?></label>

                            <?php if (evisit_settings(user()->id)->price != 0): ?>
                              <br><a href="#paymentModal_<?= $i; ?>" class="brd-20 badge badge-success-soft" data-toggle="modal" title="Record Payment"><i class="fa fa-dollar"></i> <?php echo trans('record-payment') ?></a>
                            <?php endif ?>
                          <?php endif ?>
                        </td>

                        <td class="hide_pnts">
                          <?php if ($amp->status == 1): ?>
                            <span class="badge badge-success-soft"><i class="ficon flaticon-check"></i> <?php echo trans('visited') ?></span>
                          <?php else: ?>
                            <span class="badge badge-danger-soft"><i class="fa fa-eye-slash"></i> <?php echo trans('not-visited') ?></span>
                          <?php endif ?>
                        </td>
                        
                        <td class="actions hide_pnt">
                        	<?php if ($amp->status == 0): ?>
                              <?php if (is_user()): ?>
                            	   <a href="<?php echo base_url('admin/prescription?patient_id='.$amp->patient_id.'&appointment='.$amp->id);?>" class="btn btn-light-success btn-sm" data-toggle="tooltip" data-placement="top" title="<?php echo trans('create-prescription-for') ?> <?php echo html_escape($amp->name); ?>"><i class="icon-pencil"></i></a>

                                 <a data-id="<?php echo html_escape($amp->id); ?>" data-toggle="tooltip" data-placement="top" title="<?php echo trans('remove-this-patient') ?>" href="<?php echo base_url('admin/appointment/delete/'.$amp->id);?>" class="btn btn-light-danger btn-sm cancel_serial"><i class="icon-trash"></i></a>
                              <?php endif; ?>
                          <?php endif; ?>
                        </td>
                        <td></td>
                    </tr>
                    
                  <?php $i++; endforeach; ?>
                </tbody>
            </table>

          </div>
        </div>

      </div>
    </div>

  </div>

  </section>
</div>




<!-- Modal -->
<?php $i=1; foreach ($appointments as $amp): ?>
  <div id="paymentModal_<?= $i; ?>" class="modal fade" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"><?php echo trans('record-payment-for-patient') ?> - <?php echo html_escape($amp->name); ?></h4>
        </div>
          <form method="post" enctype="multipart/form-data" class="validate-form" action="<?php echo base_url('admin/payment/offline_payment/'.$amp->id)?>" role="form" novalidate>
            <div class="modal-body">
              <div class="form-group">
                <label><?php echo trans('consultation-fee') ?> <span class="text-danger">*</span></label>
                <input type="text" class="form-control" required name="price" value="<?php echo evisit_settings(user()->id)->price; ?>" disabled>
              </div>

              <!-- csrf token -->
              <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-light-danger mt-10" data-dismiss="modal"><?php echo trans('close') ?></button>
            <button type="submit" class="btn btn-primary pull-left mr-5"><i class="fa fa-plus"></i> <?php echo trans('add-payment') ?></button>
          </div>
        </form>
      </div>

    </div>
  </div>
<?php $i++; endforeach; ?>