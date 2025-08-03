<section class="pt-6">
    <div class="container">

        <div class="text-center mx-md-auto mb-5 mb-md-7 mb-lg-9">
            <h2 class="mb-1" data-aos="fade-up"><?php echo trans('pricing-title') ?></h2>
            <p data-aos="fade-up"><?php echo trans('pricing-desc') ?></p>

            <div class="btn-group btn-group-toggle mt-4" data-toggle="buttons" data-aos="fade-up">
              <label class="btn btn-outline-primary custom-btngp active">
                <input type="radio" name="price_type" value="monthly" class="switch_price"> <?php echo trans('monthly') ?>
              </label>
              <label class="btn btn-outline-primary custom-btngp">
                <input type="radio" name="price_type" value="yearly" class="switch_price" checked> <?php echo trans('yearly') ?>
              </label>
            </div>

        </div>

        <!-- Blog -->
        <div class="row">
            <?php $i=1; foreach ($packages as $package): ?>
              <div class="col-md-4 m-auto" data-aos="fade-up" data-aos-delay="<?php echo $i*100; ?>">
                 <div class="pricing-table purple">

                  <h1 class="package_title badge badge-pill badge-<?php if($i == 2){echo "primary";}else{echo "secondary";} ?>-soft"><?php echo html_escape($package->name); ?></h1>

                    <!-- Price -->
                    <div class="price-tag m-0 text-left">
                       <div class="yearly_price">
                           <span class="text-dark symbol"><?php echo settings()->currency_symbol ?></span>
                           <span class="amount text-dark"><?php echo round($package->price); ?></span>
                           <span class="text-small text-muted"><?php echo trans('yearly') ?></span>
                       </div>

                       <div class="monthly_price" style="display: none;">
                           <span class="text-dark symbol"><?php echo settings()->currency_symbol ?></span>
                           <span class="amount text-dark"><?php echo round($package->monthly_price); ?></span>
                           <span class="text-small text-muted"><?php echo trans('monthly') ?></span>
                       </div>
                    </div>
                    
                    <!-- Features -->
                      <div class="pricing-features text-center">
                          <?php if (empty($package->features)): ?>
                            <?php echo trans('features-not-selected') ?>
                          <?php else: ?>
                            <?php foreach ($features as $all_feature): ?>

                              <?php foreach ($package->features as $feature): ?>
                                  <?php if ($feature->feature_id == $all_feature->id): ?>
                                      <?php $icon = 'fa fa-check-circle text-success'; break; ?>
                                  <?php else: ?>
                                      <?php $icon = 'fa fa-times-circle text-danger'; ?>
                                  <?php endif ?>
                              <?php endforeach ?>

                              <?php $package_slug = $package->slug; $limit = get_feature_limit($all_feature->id)->$package_slug; ?>
                              <div class="feature">
                                <span class="icon"><?php if(isset($limit) && $limit > 0){echo html_escape($limit);}else{ echo '<i class="fa fa-infinity"></i>';}; ?> </span> 
                                <span class="limit mr-2"><i class="<?php echo html_escape($icon); ?>"></i></span> <?php echo trans($all_feature->slug) ?>
                              </div>
                            <?php endforeach ?>
                          <?php endif ?>
                      </div>
                    <!-- Button -->
                    <input type="hidden" name="billing_type" value="yearly" class="billing_type">
                    <a class="btn btn-<?php if($i == 2){echo "primary";}else{echo "light-primary";} ?> btn-block package_btn" href="<?php echo base_url('register?plan='.$package->slug) ?>"><?php echo trans('select-plan') ?></a>
                 </div>
              </div>
            <?php $i++; endforeach ?>
        </div>
        <!-- End Blog -->

    </div>
</section>
