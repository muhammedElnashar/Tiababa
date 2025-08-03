
<div class="content-wrapper">

  <!-- Main content -->
  <section class="content container">

    <div class="box list_area">
      <div class="box-header with-border d-flex justify-content-between">
        <h3 class="box-title pl-25"><?php echo trans('account-verification') ?></h3>
        <div>
          <?php if (user()->is_verified == 0): ?>
            <span class="badge badge-danger-soft brd-20"><?php echo trans('pending') ?></span>
          <?php endif ?>
        </div>
      </div>

      <div class="box-body">

        <?php if (user()->is_verified == 0): ?>
          
  
          <?php if (check_user_verification(user()->id) == TRUE): ?>
            <div class="row">
              <div class="col-12 text-center pt-10">
                <h4 class="text-primary"><i class="fa fa-check-circle"></i> <?php echo trans('documents-submitted-successfully') ?>!</h4>
                <p><?php echo trans('verify-under-process-short') ?>.</p>
              </div>
            </div>
          <?php else: ?>
          
            <form method="post" enctype="multipart/form-data" class="validate-form" action="<?php echo base_url('admin/profile/upload_documents')?>" role="form" novalidate>
                
                <div class="row">
                    <?php $f=1; foreach (json_decode(settings()->verification_items) as $vitem): ?>
                        
                        <div class="report-upload col-md-3">
                            <h5 class="pl-10 text-primary"><?php echo $vitem ?></h5>
                            
                            <div class="upload-wrap">
                                <div class="uploadpreview <?php echo $f; ?>"></div>
                                <input id="<?php echo $f; ?>" type="file" name="files[]" accept="image/*">
                                <input type="hidden" name="name[]" value="<?php echo $vitem ?>">
                            </div>
                        </div>
                      
                    <?php $f++; endforeach; ?>
                </div>

                  <!-- csrf token -->
                  <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">

               
                <button type="submit" class="btn btn-primary pull-left mr-5 mt-15"><i class="fa fa-check-circle"></i> <?php echo trans('submit') ?></button>
           
            </form>

          <?php endif; ?>

        <?php else: ?>

          <div class="row">
            <div class="col-12 text-center pt-10">
              <h3 class="text-success"><i class="fa fa-check-circle"></i> <?php echo trans('verified') ?></h3>
              <p><?php echo trans('your-account-is-now-verified') ?>. </p>
            </div>
          </div>

        <?php endif ?>

        
      </div>

    </div>

  </section>
</div>
