
<div class="content-wrapper">

  <!-- Main content -->
  <section class="content container">

    <div class="row">

      <div class="col-md-6">
        <h2 class="box-title pull-left mb-5"><?php echo trans('consultation-settings') ?></h2>
        <a href="<?php echo base_url('admin/live_consults') ?>" class="pull-right btn btn-light-secondary mt-2"><i class="icon-calendar"></i> <?php echo trans('consultations') ?>  </a>
      </div>

      <div class="col-md-12">
       
          <form method="post" enctype="multipart/form-data" class="validate-form" action="<?php echo base_url('admin/live_consults/evisit_settings')?>" role="form" novalidate>
          
            <div class="row">

              <div class="col-md-6">
                <div class="box">
                  <div class="box-body mt-30">
                    <div class="col-sm-12">
                      <div class="form-group">
                        <label><?php echo trans('consultation-fees') ?> <span class="text-danger">*</span></label>
                        <div class="input-group">
                          <span class="input-group-addon"><?php echo currency_to_symbol(user()->currency) ?></span>
                          <input type="text" class="form-control" required name="price" value="<?php echo evisit_settings(user()->id)->price; ?>" >
                        </div>
                      </div>
                    </div>

                    <div class="col-sm-12">
                      <div class="form-group">
                        <label><?php echo trans('active-video-meeting-option') ?> <span class="text-danger">*</span></label>
                        <select class="form-control" name="meet_type">
                          
                          <?php if (!empty(settings()->zoom_account_id) && !empty(settings()->zoom_client_id) && !empty(settings()->zoom_client_secret)): ?>
                            <option value="zoom" <?php if(evisit_settings(user()->id)->meet_type == 'zoom'){echo "selected";} ?>><?php echo trans('zoom') ?></option>
                          <?php endif ?>

                          <option value="meet" <?php if(evisit_settings(user()->id)->meet_type == 'meet'){echo "selected";} ?>><?php echo trans('google-meet') ?></option>
                        </select>
                        <p class="text-danger small text-italic"><i class="fa fa-info-circle"></i> <?php echo trans('active-video-meeting-option-info') ?></p>
                      </div>
                    </div>

                    <div class="col-sm-12">
                      <div class="form-group">
                        <label><?php echo trans('google-meet') ?> <?php echo trans('invitation-link') ?> <span class="text-danger">*</span></label>
                        <textarea rows="1" class="form-control" name="meet_invitation_link"><?php echo evisit_settings(user()->id)->meet_invitation_link; ?></textarea>
                      </div>
                    </div>

                    <div class="col-sm-12">
                      <div class="form-group">
                          <div class="custom-control custom-switch">
                              <input type="checkbox" name="status" class="custom-control-input" value="1" id="switch-2" <?php if(evisit_settings(user()->id)->status == 1){echo "checked";} ?>>
                              <label class="custom-control-label" for="switch-2"><?php echo trans('live-consultation') ?></label>
                              <p class="text-muted"><small><?php echo trans('enable-to-allow-consultation') ?></small></p>
                          </div>
                      </div>
                    </div>

                  </div>
                </div>
              </div>
            </div>

            <input type="hidden" name="settings_id" value="<?php if (!empty(evisit_settings(user()->id))){echo evisit_settings(user()->id)->id;}else{echo 0;} ?>">
            
            <!-- csrf token -->
            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">

            <div class="row">
              <div class="col-sm-12">
                  <button type="submit" class="btn btn-primary btn-md pull-left"><i class="ficon flaticon-check"></i> <?php echo trans('save-changes') ?></button>
              </div>
            </div>
          </form>

      </div>
  </section>
</div>
