
<div class="content-wrapper">

 <section class="content">
         
    <form method="post" enctype="multipart/form-data" action="<?php echo base_url('admin/referral/update_settings') ?>" role="form" class="form-horizontal pl-20">
                
      <div class="row">

        <?php if (settings()->type == 'demo'): ?>
          <div class="col-lg-8">
            <div class="card p-4 bg-danger-soft">
              <span><i class="fa fa-info-circle"></i> Affiliate module is only available with Extended License</span>
            </div>
          </div>
        <?php endif ?>


        <div class="col-md-6">
          <div class="card">

            <div class="card-header with-border">
                <h3 class="card-title"><?php echo trans('affiliate-settings') ?></h3>
              </div>

            <div class="card-body">

              <div class="form-group">
                <div class="custom-control custom-switch prefrence-item ml-00 mt-15">
                    <input type="checkbox" name="enable_referral" class="custom-control-input" value="1" id="switch-pp" <?php if($settings->is_enable == 1){echo "checked";} ?>>
                    <label class="custom-control-label" for="switch-pp"> <?php echo trans('enable-referral') ?></label>
                    <p class="text-muted mb-2"></p>
                </div>
              </div>
             
              <div class="form-group mb-4 hide">
                <label><?php echo trans('referral-policy') ?></label>
                <select class="form-control" name="referral_policy" >
                    <option value=""><?php echo trans('choose-referral-policy') ?></option>
                    <option value="1"<?php if($settings->referral_policy == 1){echo "selected";} ?>><?php echo trans('commission-only-on-first-purchase') ?></option>
                    <option selected value="2"<?php if($settings->referral_policy == 2){echo "selected";} ?>><?php echo trans('commission-on-every-purchase') ?></option>
                </select>
              </div>

              <div class="form-group mb-4 ">
                <label><?php echo trans('commision-rate') ?></label>
                <input class="form-control" type="number" name="commision_rate" value="<?php echo html_escape($settings->commision_rate) ?>">
              </div>

              <div class="form-group mb-4">
                <label><?php echo trans('minimum-payout') ?></label>
                <div class="input-group">
                  <span class="input-group-addon"><?php echo settings()->currency_symbol ?></span>
                  <input class="form-control" type="number" name="minimum_payout" value="<?php echo html_escape($settings->minimum_payout) ?>">
                </div>
              </div>

              <div class="form-group mb-4">
                <label><?php echo trans('payment-method') ?></label>
                <input class="form-control" type="text" name="payment_method" placeholder="<?php echo trans('paypal').' / '.trans('bank') ?>" value="<?php echo html_escape($settings->payment_method) ?>">
              </div>

              <div class="form-group">
                <label><?php echo trans('refferal-guidelines') ?></label>
                <textarea id="ckEditor" class="form-control" name="referral_guideline"><?php echo $settings->referral_guideline ?></textarea>
            </div>

              <input type="hidden" name="id" value="<?php echo html_escape($settings->id); ?>">
              <!-- csrf token -->
              <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
              <button type="submit" class="btn btn-primary mt-2"><?php echo trans('save-changes') ?></button>

            </div>
          </div>
        </div>
      </div>
    </form>
  </section>
</div>




