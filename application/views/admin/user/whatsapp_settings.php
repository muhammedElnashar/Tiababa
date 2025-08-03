<div class="content-wrapper">

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">

            <div class="col-lg-9 pl-3">
                <div class="card">
                    <form method="post" enctype="multipart/form-data" action="<?php echo base_url('admin/profile/update_whatsapp') ?>" role="form" class="form-horizontal pl-20">
                        <div class="card-body">
                            <h3 class="mt-3"><?php echo trans('whatsapp-settings') ?></h3>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                      <p><?php echo trans('whatsapp') ?>(<b><a class="text-success" target="_blank" href="https://ultramsg.com"><?php echo trans('ultramsg-api') ?></a></b>)</p>
                                    </div>

                                    <div class="form-group">
                                      <label><?php echo trans('instance-id') ?></label>
                                        <input type="text" name="ultramsg_instance_id" value="<?php echo html_escape(user()->ultramsg_instance_id); ?>" class="form-control" >
                                    </div>

                                    <div class="form-group">
                                      <label><?php echo trans('token') ?></label>
                                        <input type="text" name="ultramsg_token" value="<?php echo html_escape(user()->ultramsg_token); ?>" class="form-control" >
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group col-md-12 mb-2">
                                        <div class="custom-control custom-switch pt-10">
                                          <input type="checkbox" value="1" name="enable_whatsapp_msg" class="custom-control-input" id="switch-1" <?php if(user()->enable_whatsapp_msg == 1){echo 'checked';} ?>>
                                          <label class="custom-control-label" for="switch-1"><?php echo trans('enable-booking-confirmation-sms') ?></label>
                                          <p class="small text-muted"><?php echo trans('enable-booking-con-title') ?>.</p>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="mt-2 mb-5">
                                <input type="hidden" name="id" value="<?php echo html_escape(user()->id); ?>">
                                <!-- csrf token -->
                                <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
                                <button type="submit" class="btn btn-primary"> <?php echo trans('save-changes') ?></button>
                            </div>
                        </div>

                        
                    </form>
                </div>
            </div>

        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
