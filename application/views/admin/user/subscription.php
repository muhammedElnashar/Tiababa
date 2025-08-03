<div class="content-wrapper">

  <section class="content">

    <div class="row">

          <div class="col-xl-3 col-lg-3">

            <!-- Profile Image -->
            <div class="box mt-84">
              <div class="box-header">
                <h3 class="box-title"><?php echo trans('subscription') ?></h3>
              </div>

                <div class="box-body box-profile py-4">
                  
                  <?php if (user()->user_type == 'trial'): ?>
                      <p class="mb-10"><?php echo trans('subscription') ?>: <b><?php echo settings()->trial_days; ?> <?php echo trans('days-free-trial') ?></b></p>

                      <p class="mb-10"><?php echo trans('expire') ?> : <strong><?php echo my_date_show(user()->trial_expire); ?></strong> 
                          <strong class="text-danger">(<?php echo date_dif(date('Y-m-d'), user()->trial_expire) ?> <?php echo trans('days-left') ?>)</strong>
                        </p>
                  <?php else: ?>

                      <p class="mb-10"><?php echo trans('subscription') ?>: <strong><?php echo trans(strtolower($user->package_name)) ?> <?php echo trans('plan') ?></strong></p>
                      <p class="mb-10"><?php echo trans('price') ?>: <strong><?php echo html_escape(settings()->currency_symbol) ?><?php echo html_escape($user->amount) ?> </strong></p>
                      <p class="mb-10"><?php echo trans('billing-cycle') ?> : <strong><?php echo trans($user->billing_type) ?></strong> </p>
                      <?php if (!empty($user->payment_method)): ?>
                        <p class="mb-10"><?php echo trans('payment-method') ?> : <strong><?php echo ucfirst($user->payment_method) ?></strong> </p>
                      <?php endif ?>

                      <?php if ($user->status != 'expire'): ?>
                        <p class="mb-10"><?php echo trans('last-billing') ?> : <strong><?php echo my_date_show($user->created_at) ?></strong> </p>
                        <p class="mb-10"><?php echo trans('expire') ?> : <strong><?php echo my_date_show($user->expire_on); ?></strong> 
                          <strong class="text-danger">(<?php echo date_dif(date('Y-m-d'), $user->expire_on) ?> <?php echo trans('days-left') ?>)</strong>
                        </p>
                      <?php endif ?>

                  <?php endif ?>
                </div>

                <?php if (number_format($user->amount, 0) != 0): ?>
                  <div class="box-header p-0">
                    <?php if (check_my_payment_status() == TRUE): ?>
                      <h5 class="text-center pay_status"><?php echo trans('payment-status') ?>: &nbsp; <i class="ficon flaticon-check"></i> <?php echo ucfirst($user->status);?></h5>
                      <?php else: ?>
                        <h5 class="text-center pay_pending"><?php echo trans('payment-status') ?>: &nbsp; <i class="fa fa-exclamation-circle"></i> <?php echo ucfirst($user->status);?></h5>
                      <?php endif ?>
                  </div>
                <?php endif ?>

              </div>
          </div>

          <div class="col-xl-9 col-lg-9">  
            <div class="text-center mb-40">
              <div class="btn-group btn-group-toggle" data-toggle="buttons">
                <label class="btn btn-outline-primary btn-lg custom-btngp mr-1 <?php if($user->billing_type == 'monthly'){echo 'active';} ?>">
                  <input type="radio" name="price_type" value="monthly" class="switch_price"> <?php echo trans('monthly') ?>
                </label>
                <label class="btn btn-outline-primary btn-lg custom-btngp <?php if($user->billing_type == 'yearly'){echo 'active';} ?>">
                  <input type="radio" name="price_type" value="yearly" class="switch_price"> <?php echo trans('yearly') ?>
                </label>
              </div>
            </div>

            <div class="row">

              <?php $i=1; foreach ($packages as $package): ?>
              <div class="col-md-<?php echo(12/count($packages)) ?>">
               <div class="pricing-table purple text-center shadow-lg">

                <h1 class="package_title">
                  <?php if (user()->user_type == 'registered'): ?>
                    <i class="<?php if ($user->package_id == $package->id){echo "icon-check";} ?> text-success"></i> <?php echo html_escape($package->name); ?> 
                  <?php endif; ?>
                </h1>
                <!-- Price -->
                <div class="price-tag mb-20 mt-20">
                 <div class="yearly_price" style="display: <?php if($user->billing_type == 'yearly'){echo 'block';}else{echo "none";} ?>">
                   <span class="symbol"><?php echo settings()->currency_symbol ?></span>
                   <span class="amount"><?php echo round($package->price); ?></span>
                   <span class="after"><?php echo trans('per-year') ?></span>
                 </div>

                 <div class="monthly_price" style="display: <?php if($user->billing_type == 'monthly'){echo 'block';}else{echo "none";} ?>;">
                   <span class="symbol"><?php echo settings()->currency_symbol ?></span>
                   <span class="amount"><?php echo round($package->monthly_price); ?></span>
                   <span class="after"><?php echo trans('per-month') ?> </span>
                 </div>
                </div>

               
                <!-- Features -->
                <div class="pricing-features mb-40">
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

                        <?php $package_slug = $package->slug; $limit = get_feature_limit($all_feature->id)->$package_slug; ?>

                        <div class="feature"><div class="pull-left mr-10"><?php if(isset($limit) && $limit > 0){echo html_escape($limit);}else{ echo '<b>&#8734;</b>';}; ?></div><?php echo trans($all_feature->slug) ?><span><i class="<?php echo html_escape($icon); ?>"></i></span></div>

                      <?php endforeach ?>
                    <?php endif ?>
                </div>

                  <!-- Button -->
                  <input type="hidden" name="billing_type" value="<?php if($user->billing_type == 'monthly'){echo "monthly";}else{echo "yearly";} ?>" class="billing_type">
                  
                  <?php if ($user->package_id == $package->id): ?>
                      <?php if (user()->user_type == 'registered'): ?>
                        <a class="btn btn-primary btn-lg btn-block package_btn" href="<?php echo base_url('admin/subscription/upgrade/'.$package->slug) ?>"> <?php echo trans('your-selected-plan') ?></a>
                      <?php else: ?>
                        <a class="btn btn-light-secondary btn-lg btn-block package_btn" href="<?php echo base_url('admin/subscription/upgrade/'.$package->slug) ?>"> <?php echo trans('select') ?></a>
                      <?php endif ?>
                    <?php else: ?>
                      <a class="btn btn-light-secondary btn-lg btn-block package_btn" href="<?php echo base_url('admin/subscription/upgrade/'.$package->slug) ?>"> <?php echo trans('select') ?></a>
                    <?php endif ?>

                </div>
              </div>
              <?php endforeach ?>

            </div>
          </div>

  </section>

</div>