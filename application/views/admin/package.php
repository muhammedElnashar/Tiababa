<div class="content-wrapper">

  <!-- Main content -->
  <section class="content">

  <?php if (isset($page_title) && $page_title == "Package"): ?>

    <div class="container">
       <div class="row">
          <div class="col-md-12 text-left">
             <h2 class="main-head mb-4"><?php echo trans('manage-plans') ?></h2>
          </div>
        
          <?php $i=1; foreach ($packages as $package): ?>
            <div class="col-lg-4 col-sm-12 col-xs-12 text-center">

                <?php if ($package->status == 1): ?>
                  <div class="custom-control custom-switch mb-2 mt-4">
                      <input type="checkbox" name="enable_faq" class="custom-control-input plan_status" data-id="<?php echo html_escape($package->id) ?>" value="2" id="switch-<?= $package->id ?>" <?php if(settings()->enable_faq == 1){echo "checked";} ?>>
                      <label class="custom-control-label" for="switch-<?= $package->id ?>"><?php echo trans('hide') ?></label>
                      <p class="text-muted"><small><?php echo trans('disable-to-hide-this-plan') ?></small></p>
                  </div>
                <?php else: ?>
                  <div class="custom-control custom-switch mb-2 mt-4">
                      <input type="checkbox" name="enable_faq" class="custom-control-input plan_status" data-id="<?php echo html_escape($package->id) ?>" value="1" id="switch-<?= $package->id ?>">
                      <label class="custom-control-label" for="switch-<?= $package->id ?>"><?php echo trans('active') ?></label>
                      <p class="text-muted"><small><?php echo trans('enable-to-active-this-plan') ?></small></p>
                  </div>
                <?php endif ?>

               <div class="pricing-table purple text-center shadow-lg">

                  <?php if ($package->status == 1): ?>
                    <span class="badge badge-pill badge-secondary-soft font-weight-bold"><i class="icon-people"></i> <?php echo get_total_user_by_package($package->id) ?></span>

                    <label class="badge badge-success-soft brd-20"><i class="ficon flaticon-check"></i> <?php echo trans('active') ?></label>
                  <?php else: ?>
                    <span class="badge badge-pill badge-secondary-soft font-weight-bold"><i class="icon-people"></i> <?php echo get_total_user_by_package($package->id) ?></span>

                    <label class="badge badge-danger-soft brd-20"><i class="fa fa-eye-slash"></i> <?php echo trans('hidden') ?></label>
                  <?php endif ?>

                  <h1 class="mb-0 mt-2"><?php echo html_escape($package->name); ?></h1>
                  
                  
                  <!-- Price -->
                  <div class="price-tag mt-0">
                     <span class="symbol"><?php echo settings()->currency_symbol ?></span>
                     <span class="amount-sm"><?php echo round($package->monthly_price); ?></span>
                     <span class="after"><?php echo trans('per-month') ?></span>
                     &emsp;
                     |
                     &emsp;
                     <span class="symbol"><?php echo settings()->currency_symbol ?></span>
                     <span class="amount-sm"><?php echo round($package->price); ?></span>
                     <span class="after"><?php echo trans('per-year') ?></span>
                  </div>

                    <?php $package_slug = $package->slug; ?>
                  
                    <!-- Features -->
                    <div class="pricing-features">
                        <?php if (empty($package->features)): ?>
                          <?php echo trans('features-not-selected') ?>
                        <?php else: ?>
                          <?php foreach ($features as $all_feature): ?>

                            <?php foreach ($package->features as $feature): ?>
                                <?php if ($feature->feature_id == $all_feature->id): ?>
                                    <?php $icon = 'ficon flaticon-check text-success'; break; ?>
                                <?php else: ?>
                                    <?php $icon = 'ficon flaticon-cancel text-danger'; ?>
                                <?php endif ?>
                            <?php endforeach ?>

                            <?php $limit = get_feature_limit($all_feature->id)->$package_slug; ?>

                            <div class="feature"><div class="pull-left mr-10"><?php if(isset($limit) && $limit > 0){echo html_escape($limit);}else{ echo '<b>&#8734;</b>';}; ?></div><?php echo html_escape($all_feature->name) ?><span class="limit"><i class="<?php echo html_escape($icon); ?>"></i></span></div>
                          <?php endforeach ?>
                        <?php endif ?>
                    </div>
                  <!-- Button -->
                  <a class="btn btn-light-secondary btn-lg btn-block mt-30" href="<?php echo base_url('admin/package/edit/'.$package->id) ?>"><i class="fa fa-pencil"></i> <?php echo trans('edit-plan') ?></a>
               </div>
            </div>
          <?php endforeach ?>

       </div>
    </div>

  <?php endif; ?>


  <?php if (isset($page_title) && $page_title == "Edit"): ?>
 
      <div class="container">
      <div class="box">
        <form id="cat-form" method="post" enctype="multipart/form-data" class="validate-form" action="<?php echo base_url('admin/package/add')?>" role="form" novalidate>

    
          <div class="mb-30 box-header with-border">
            <h3 class="box-title"><?php echo trans('update-plan') ?> - <?php echo html_escape($package[0]['name']) ?></h3>
          </div>
       

          <div class="box-body">

            <div class="row">

              <div class="col-md-4">
                <h3 class="mb-0"><?php echo trans('plan') ?></h3>
                <p class="text-muted"><?php echo trans('manage-your-plan') ?></p>
              </div>

              <div class="col-md-8 mt-10">
                  <div class="form-group">
                    <label><?php echo trans('plan-name') ?> <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" required name="name" value="<?php echo html_escape($package[0]['name']); ?>" >
                  </div>

                  <div class="row">
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label><?php echo trans('monthly-price') ?> <span class="text-danger">*</span></label>
                        <input type="price" class="form-control" required name="monthly_price" value="<?php echo html_escape($package[0]['monthly_price']); ?>" >
                        <p><i class="fa fa-question-circle"></i> <?php echo trans('set-0-price-for-free-package') ?></p>
                      </div>
                    </div>

                    <div class="col-sm-6">
                      <div class="form-group">
                        <label><?php echo trans('yearly-price') ?> <span class="text-danger">*</span></label>
                        <input type="price" class="form-control" required name="price" value="<?php echo html_escape($package[0]['price']); ?>" >
                        <p><i class="fa fa-question-circle"></i> <?php echo trans('set-0-price-for-free-package') ?></p>
                      </div>
                    </div>
                  </div>
                  
              </div>
            </div>

              
            <div class="row mt-50">
              <div class="col-md-4">
                <h3 class="mb-0"><?php echo trans('plan-settings') ?></h3>
                <p class="text-muted"><?php echo trans('choose-which-features') ?></p>
              </div>


              <div class="col-md-8 p-20">

                  <?php $slug = $package[0]['slug'];?>
                  <?php $p=50; foreach ($features as $feature): ?>
                    <?php foreach ($assign_features as $asg_feature): ?>
                      <?php if ($asg_feature->feature_id == $feature->id): ?>
                          <?php $checked = 'checked'; break; ?>
                      <?php else: ?>
                          <?php $checked = ''; ?>
                      <?php endif ?>
                    <?php endforeach ?>

                    <div class="custom-control custom-switch">
                        <div class="row">
                           <div class="col-sm-6"> 
                              <input type="checkbox" name="features[]" value="<?php echo html_escape($feature->id); ?>" class="custom-control-input" id="switch-<?php echo html_escape($p);?>" <?php echo html_escape($checked); ?>>
                              <label class="custom-control-label" for="switch-<?php echo html_escape($p);?>"><?php echo html_escape($feature->name) ?></label>
                              <p class="text-muted"><small><?php echo trans('enable-access-to') ?> <?php echo html_escape($feature->name) ?> <?php echo trans('feature-in-this-plan') ?></small></p>
                           </div>

                           <div class="col-sm-6"> 
                              <?php if ($feature->is_limit == 1): ?>
                                <div class="form-group">
                                  <input type="number" class="form-control custom" name="limits[]" value="<?php if(isset($feature->$slug)){echo html_escape($feature->$slug);}else{echo "0";} ?>" placeholder="Set limit for <?php echo html_escape($feature->name) ?>">
                                  <input type="hidden" name="ids[]" value="<?php echo html_escape($feature->id) ?>">
                                  <small><?php echo trans('set-limit-1-for-unlimited') ?></small>
                                </div>
                              <?php endif ?>
                           </div>
                        </div>
                    </div>
                    
                  <?php $p++; endforeach ?>
              </div>
            </div>

          </div>


          <input type="hidden" name="id" value="<?php echo html_escape($package['0']['id']); ?>">
          <!-- csrf token -->
          <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">

          <div class="row">
            <div class="col-md-8 offset-md-4 p-50">
                <button type="submit" class="btn btn-light-primary btn-lg btn-block pull-left mb-20"><i class="fa fa-check"></i> <?php echo trans('save-changes') ?> </button>
            </div>
          </div>

        </form>
      </div>
      </div>
      
  <?php endif; ?>


  </section>
</div>
