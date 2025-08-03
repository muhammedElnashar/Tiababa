
<div class="content-wrapper">

  <!-- Main content -->
  <section class="content containers">

    <div class="row">

      <div class="col-md-12">
        
        <div class="box add_area <?php if(isset($page_title) && $page_title == "Edit"){echo "d-block";}else{echo "hide";} ?>">
          
          <div class="box-header with-border">
            <?php if (isset($page_title) && $page_title == "Edit"): ?>
              <h3 class="box-title"><?php echo trans('edit') ?></h3>
            <?php else: ?>
              <h3 class="box-title"><?php echo trans('add-new') ?> </h3>
            <?php endif; ?>

            <div class="box-tools pull-right">
              <?php if (isset($page_title) && $page_title == "Edit"): ?>
                <a href="<?php echo base_url('admin/live_consults') ?>" class="pull-right btn btn-light-primary mt-15 btn-sm"><i class="fa fa-angle-left"></i> <?php echo trans('back') ?></a>
              <?php else: ?>
                <a href="#" class="text-right btn btn-light-secondary cancel_btn"><i class="fa fa-circle"></i> <?php echo trans('consultations') ?></a>
              <?php endif; ?>
            </div>
          </div>

          <div class="box-body">
            <form id="cat-form" method="post" enctype="multipart/form-data" class="validate-form" action="<?php echo base_url('admin/live_consults/edit/'.$consult[0]['id'])?>" role="form" novalidate>

              <div class="form-group">
                <label><?php echo trans('date') ?> <span class="text-danger">*</span></label>
                <input type="date" class="form-control datepicker" required name="date" value="<?php echo html_escape($consult[0]['date']); ?>" >
              </div>

              <div class="form-group">
                <label><?php echo trans('time') ?> <span class="text-danger">*</span></label>
                <input type="text" class="form-control timepicker" required name="time" value="<?php echo html_escape($consult[0]['time']); ?>" >
              </div>

              <div class="form-group">
                <label><?php echo trans('meeting-notes') ?></label>
                <textarea class="form-control" rows="4" name="meeting_notes"><?php echo html_escape($consult[0]['meeting_notes']); ?></textarea>
              </div>
              

              <input type="hidden" name="id" value="<?php echo html_escape($consult['0']['id']); ?>">
              <input type="hidden" name="chamber_id" value="<?php echo html_escape($this->chamber->id); ?>">

              <!-- csrf token -->
              <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">

              <div class="row m-t-30">
                <div class="col-sm-12">
                  <?php if (isset($page_title) && $page_title == "Edit"): ?>
                    <button type="submit" class="btn btn-primary pull-left"><i class="ficon flaticon-check"></i> <?php echo trans('update') ?></button>
                  <?php else: ?>
                    <button type="submit" class="btn btn-primary btn-lg pull-left"><i class="ficon flaticon-check"></i> <?php echo trans('save') ?></button>
                  <?php endif; ?>
                </div>
              </div>

            </form>

          </div>

        </div>


        <?php if (isset($page_title) && $page_title != "Edit"): ?>
          <div class="box list_area">
            <div class="box-header with-border">
              <?php if (isset($page_title) && $page_title == "Edit"): ?>
                <h3 class="box-title"><?php echo trans('edit') ?> <a href="<?php echo base_url('admin/live_consults') ?>" class="pull-right btn btn-primary btn-sm"><i class="fa fa-angle-left"></i> <?php echo trans('back') ?></a></h3>
              <?php else: ?>
                <h3 class="box-title"><img src="<?php echo base_url('assets/images/video-call.png') ?>"> &nbsp; <?php echo trans('consultations') ?> </h3>
              <?php endif; ?>

              <div class="box-tools pull-right">
               <a target="_blank" href="http://doxe.originlabsoft.com/docs/#docs_zoom" class="pull-right btn btn-success mt-15 ml-2"><i class="icon-refresh"></i> <?php echo trans('zoom-integration-doc') ?></a>

               <a href="<?php echo base_url('admin/live_consults/settings') ?>" class="pull-right btn btn-primary mt-15"><i class="icon-settings"></i> <?php echo trans('settings') ?></a>
              </div>
            </div>

            <div class="box-body <?php if(count($appointments) > 10){echo 'p-10';}else{echo 'p-0';} ?>">
              
              <div class="col-md-12 p-0 col-sm-12 col-xs-12 scroll table-responsive ">
                  <?php if (empty($appointments)): ?>
                      <div class="mt-4 mb-4 text-center">
                        <h4><img src="<?php echo base_url('assets/images/not-found.png') ?>"></h4>
                        <h5><?php echo trans('data-not-found') ?>!</h5>
                      </div>
                  <?php else: ?>
                  
                  <table class="table table-hover <?php if(count($appointments) > 10){echo 'datatable';} ?>">
                      <thead>
                          <tr>
                              <th>#</th>
                              <th><?php echo trans('serial-no') ?></th>
                              <th><?php echo trans('patient-info') ?></th>
                              <th><?php echo trans('schedule-info') ?></th>
                              <th><?php echo trans('consultation-type') ?></th>
                              <th><?php echo trans('price') ?></th>
                              <th><?php echo trans('online-meeting') ?></th>
                              <th><?php echo trans('prescription') ?></th>
                              <th><?php echo trans('action') ?></th>
                          </tr>
                      </thead>
                      <tbody>
                        <?php $i=1; foreach ($appointments as $amp): ?>
                          <tr id="row_<?php echo html_escape($amp->id); ?>" style="background: #<?php if($amp->status == 1){echo "eefaf6";}else{echo "fff";} ?>">
                              
                              <td><?= $i; ?></td>
                              <td><?php echo html_escape($amp->serial_id); ?></td>
                              <td>
                                <p class="mb-0"><?php echo html_escape($amp->name); ?> (MR: #<?php echo html_escape($amp->mr_number); ?>)</p>
                                <p class="mb-0"><?php echo trans('phone') ?>: <?php echo html_escape($amp->mobile); ?></p>
                                <p><?php echo html_escape($amp->email); ?></p>
                              </td>

                              <td>
                                <label class="badge badge-primary-soft brd-20"><i class="fa fa-calendar"></i> <?php echo my_date_show($amp->date); ?></label><br>
                                <label class="badge badge-primary-soft brd-20"><i class="fa fa-clock-o"></i> <?php echo $amp->time; ?></label>
                              </td>

                              <td>
                                <?php if ($amp->type == 'online'): ?>
                                  <label class="badge badge-danger-soft brd-20"><i class="fa fa-circle"></i> <?php echo trans('online') ?> </label>
                                <?php else: ?>
                                  <label class="badge badge-secondary-soft brd-20"><i class="fa fa-circle"></i> <?php echo trans('offline') ?></label>
                                <?php endif ?>
                              </td>

                              <td>
                                <?php if (!empty(evisit_settings(user()->id)->price)): ?>
                                  <p><?php echo currency_symbol(user()->currency); ?><?php echo html_escape(evisit_settings(user()->id)->price) ?></p>
                                <?php endif ?>

                                <?php $payment = check_appointment_payment($amp->id, $amp->user_id); ?>
                                <?php if ($payment == TRUE): ?>
                                  <label class="badge badge-success-soft brd-20"><i class="fa fa-check-circle"></i> <?php echo trans('paid') ?></label>
                                <?php else: ?>

                                  <?php if (evisit_settings(user()->id)->price == 0): ?>
                                    <label class="badge badge-success-soft brd-20"><i class="fa fa-check-circle"></i> <?php echo trans('paid') ?></label>
                                  <?php else: ?>
                                    <label class="badge badge-danger-soft brd-20"><i class="fa fa-clock-o"></i> <?php echo trans('pending') ?></label>
                                  <?php endif ?>
                          
                                
                                  <?php if (evisit_settings(user()->id)->price != 0): ?>
                                    <br><a href="#paymentModal_<?= $i; ?>" class="brd-20 badge badge-success-soft" data-toggle="modal" title="Record Payment"><i class="fa fa-dollar"></i> <?php echo trans('record-payment') ?></a>
                                  <?php endif ?>
                                <?php endif ?>
                              </td>


                              <td>

                                  <?php if($amp->type == 'online'): ?>
                                    <a href="<?php echo base_url('auth/send_notify_mail/'.$amp->id);?>" class="btn btn-light-secondary btn-sm btn-block mb-1" data-toggle="tooltip" data-placement="top" title="<?php echo trans('send-notify-mail-for-joining-meeting') ?>"><i class="icon-paper-plane"></i></a>
                                  <?php endif; ?>

                                  <?php if(!empty($amp->host_url) && $amp->is_start == 0): ?>
                                    <?php if (evisit_settings(user()->id)->meet_type == 'zoom'): ?>
                                      <a href="<?php echo base_url('admin/live/zooms/'.html_escape($amp->id));?>" class="btn btn-light-success btn-sm btn-block start_meeting"><i class="fa fa-play-circle"></i> <?php echo trans('start-meeting') ?></a>
                                    <?php endif; ?>
                                  <?php endif; ?>

                                  <?php if (evisit_settings(user()->id)->meet_type == 'meet'): ?>
                                    <a target="_blank" href="<?php echo base_url('admin/live/meet/doctor/'.html_escape($amp->id));?>" class="btn btn-light-success btn-block btn-sm start_meeting"><i class="fa fa-play-circle"></i> <?php echo trans('start-meeting') ?></a>
                                  <?php endif; ?>
                                  
                                  <?php if(!empty($amp->host_url) && $amp->is_start == 1): ?>
                                    <?php if($amp->host_url && $amp->type == 'online'): ?> 
                                      <a target="_blank" href="<?= $amp->host_url ?>" class="btn btn-success btn-sm btn-block mt-2"><i class="fa fa-video-camera"></i> <?php echo trans('join-meeting') ?></a>
                                    <?php endif; ?>


                                    <a href="<?php echo base_url('admin/live/cancel_meeting/'.html_escape($amp->id));?>" class="btn btn-light-danger btn-block btn-sm mt-2"><i class="fa fa-times"></i> <?php echo trans('cancel-meeting') ?></a>
                                  <?php endif; ?>


                                  <?php if($amp->type == 'online' && empty($amp->host_url) && evisit_settings(user()->id)->meet_type == 'zoom'): ?>                         
                                      <?php if ($amp->date > date('Y-m-d') && !empty(settings()->zoom_account_id) && !empty(settings()->zoom_client_id) && !empty(settings()->zoom_client_secret)): ?>                        
                                      <a href="<?php echo base_url('admin/live_consults/add_meeting/'.html_escape($amp->id));?>" class="btn btn-primary btn-sm btn-block mt-2 create_meeting" ><i class="fa fa-plus-circle"></i> <?php echo trans('create-meeting') ?></a>
                                    <?php endif; ?>
                                  <?php endif; ?>
                              </td>

                              <td>
                                <?php if ($amp->status == 1): ?>
                                  <label class="badge badge-primary-soft brd-20"><i class="ficon flaticon-check"></i> <?php echo trans('created') ?></label>
                                <?php else: ?>
                                  <label class="badge badge-warning-soft brd-20" data-toggle="tooltip" data-placement="top" title="<?php echo trans('prescription-not-created-yet') ?>"><i class="fa fa-times"></i> <?php echo trans('not-created') ?></label>
                                <?php endif ?>
                                <?php if ($amp->status == 3): ?>
                                  <label class="badge badge-danger-soft brd-20"><i class="fa fa-times"></i> <?php echo trans('cancelled') ?></label>
                                <?php endif; ?>
                              </td>

                              <td class="action" width="20%">
                                <?php if($amp->status == 0): ?>
                                  <?php if($amp->type == 'online'): ?>
                                    
                                  <?php endif ?>

                                  <a target="_blank" href="<?php echo base_url('admin/prescription?patient_id='.$amp->patient_id.'&appointment='.$amp->id);?>" class="btn btn-light-success btn-sm" data-toggle="tooltip" data-placement="top" title="<?php echo trans('create-prescription-for') ?> <?php echo html_escape($amp->name); ?>"><i class="fa fa-plus-circle fs-18"></i></a>
                                <?php endif ?>

                                <a href="<?php echo base_url('admin/live_consults/edit/'.$amp->id);?>" class="btn btn-light-danger btn-sm" data-toggle="tooltip" data-placement="top" title="<?php echo trans('edit') ?>"><i class="icon-note"></i></a>

                                <?php if ($amp->status != 3): ?>
                                  <a href="<?php echo base_url('admin/live_consults/status_operation/'.'3'.'/'.$amp->id);?>" class="btn btn-light-danger btn-sm" data-toggle="tooltip" data-placement="top" title="<?php echo trans('cancel') ?>"><i class="fa fa-times"></i></a>
                                <?php endif; ?>

                              </td>
                          </tr>
                          
                        <?php $i++; endforeach; ?>
                      </tbody>
                  </table>

                  <?php endif ?>

              </div>

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
            
          </div>
        <?php endif; ?>

      </div>

    </div>

  </section>
</div>
