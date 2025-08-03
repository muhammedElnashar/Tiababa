<section class="pt-6">
    <div class="container">

        

        <div class="text-center mx-md-auto mb-5 mb-md-7 mb-lg-9">
            <h2 class="mb-0"><?php echo html_escape(settings()->site_name) ?> — <?php echo trans('experts') ?></h2>
            <p><?php echo trans('expert-title') ?></p>
        </div>

        <form method="get" class="sort_form" action="<?php echo base_url('users') ?>">
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <select name="country" class="form-control sort_department">
                            <option value=""><?php echo trans('country') ?></option>
                            <?php foreach ($countries as $country): ?>
                                <option value="<?php echo html_escape($country->id); ?>" 
                                  <?php if(isset($_GET['country']) && $_GET['country'] == $country->id){echo "selected";} ?>>
                                  <?php echo html_escape($country->name); ?>
                                </option>
                            <?php endforeach ?>
                        </select>
                    </div>
                </div>


                <?php if (empty($cities)): ?>
                <div class="col-md-2">
                    <div class="form-group">
                        <select name="city" class="form-control sort_department">
                            <option value=""><?php echo trans('city') ?></option>
                            <?php foreach ($cities as $usercity): ?>
                                <?php if (!empty($usercity->city)): ?>
                                    <option <?php if(isset($_GET['city']) && $_GET['city'] == $usercity->city){echo "selected";} ?> value="<?php echo html_escape($usercity->city); ?>"><?php echo html_escape($usercity->city); ?></option>
                                <?php endif ?>
                            <?php endforeach ?>
                        </select>
                    </div>
                </div>
                <?php endif ?>
                
                <div class="col-md-2">
                    <div class="form-group">
                        <select name="department" class="form-control sort_department">
                            <option value=""><?php echo trans('select-departments') ?></option>
                            <?php foreach ($all_users as $user): ?>
                                <?php if (!empty($user->specialist)): ?>
                                    <option <?php if(isset($_GET['department']) && $_GET['department'] == $department->id){echo "selected";} ?> value="<?php echo html_escape($user->specialist); ?>"><?php echo html_escape($user->specialist); ?></option>
                                <?php endif ?>
                            <?php endforeach ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <select name="experience" class="form-control sort_experience">
                            <option value=""><?php echo trans('select-experiences') ?></option>
                            <?php for ($i=1; $i < 51; $i++) { ?>
                                <option <?php if(isset($_GET['experience']) && $_GET['experience'] == $i){echo "selected";} ?> value="<?= $i ?>"><?= $i ?> <?php echo trans('years') ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-3 col-xs-12 pull-right">
                    <div class="input-group">
                        <input name="search" type="text" class="form-control" placeholder="<?php echo trans('search-by-name') ?>">
                        <div class="input-group-append">
                          <button class="btn btn-secondary" type="submit">
                            <i class="fa fa-search"></i>
                          </button>
                        </div>
                    </div>
                </div>  
            </div>
        </form>
        
        <?php if (empty($users)): ?>
            <div class="row">
                <div class="col-md-10 col-lg-9 col-xl-8 mx-md-auto">
                    <?php include'include/not_found_msg.php'; ?>
                </div>
            </div>
        <?php else: ?>

        <div class="row mt-4">
            <?php foreach ($users as $user): ?>

                <?php $pstatus = ""; ?>
                <?php if (settings()->site_info == 1): ?>
                        <?php $pstatus = ""; ?>
                <?php else: ?>
                    <?php if(settings()->enable_payment == 1): ?>
                        <?php if(user_payment_details($user->id)->status != 'verified'){$pstatus = "d-none";} ?>
                    <?php else: ?>
                        <?php $pstatus = ""; ?>
                    <?php endif; ?>
                <?php endif ?>

                <!-- Users -->
                <div class="col-sm-6 col-md-3 mb-5 mb-md-0 <?php echo html_escape($pstatus); ?>">
                    <div class="user-area">
                        <div class="team-img">
                            <?php if (empty($user->image)): ?>
                                <img src="<?php echo base_url('assets/images/avatar.png') ?>" alt="User Image">
                            <?php else: ?>
                                <img src="<?php echo base_url($user->image) ?>" alt="User Image">
                            <?php endif ?>
                        </div>
                        <div class="text-center bg-white shadow-light py-4 minh-150">
                          
                            <h6 class="h6 mb-1">
                            <?php if ($user->is_verified == 1): ?>
                                <span data-toggle="tooltip" data-title="<?php echo trans('account-verified') ?>"><img width="25px" class="vbadge" src="<?php echo base_url('assets/images/verify.png') ?>"></span>  

                            <?php endif ?>
                            <?php echo html_escape($user->name) ?>
                            </h6>

                            <p class="mb-0">
                                <?php if (!empty($user->specialist)): ?>
                                    <?php echo html_escape($user->specialist) ?>
                                <?php endif ?>
                            </p>
                            <p class="mb-1">
                                <?php if (!empty($user->exp_years)): ?>
                                    <?php echo html_escape($user->exp_years) ?> <?php echo trans('years-experience') ?>
                                <?php endif ?>
                            </p>

                            <?php $total_rating = total_rating($user->id); ?>

                            <?php if (!empty($total_rating)): ?>
                                <?php $average = number_format(total_rating_user($user->id)/$total_rating, 1) ?>
                            <?php else: ?>
                                <?php $average = 0 ?>
                            <?php endif ?>

                            
                            <?php if ($average != 0 && $user->enable_rating == 1): ?>
                                <p class="mb-1 mt-0">
                                    <?php for($i = 1; $i <= 5; $i++):?>
                                        <?php 
                                            if ( round($average - .25) >= $i) {
                                                echo "<i class='fas fa-star text-warning'></i>";
                                            } elseif (round($average + .25) >= $i) {
                                                echo "<i class='fas fa-star-half-alt text-warning'></i>";
                                            } else {
                                                echo "<i class='far fa-star text-warning'></i>";
                                            }
                                        ?>
                                    <?php endfor;?>
                                </p>
                            <?php endif ?>


                            <?php if (check_user_feature_access('custom-domain', $user->id) == TRUE): ?>
                              <?php if (!empty(get_user_domain($user->id))): ?>
                                <?php $user_domain = get_user_domain($user->id)->custom_domain; ?>
                              <?php else: ?>
                                <?php $user_domain = base_url('profile/'.$user->slug); ?>
                              <?php endif ?>
                            <?php else: ?>
                              <?php $user_domain = base_url('profile/'.$user->slug); ?>
                            <?php endif; ?>

                            <div class="row justify-content-center">
                                <?php if (check_user_feature_access('profile-page', $user->id) == TRUE): ?>
                                    <?php if (check_user_feature_access('appointments', $user->id) == TRUE): ?>
                                        <a href="<?php echo prep_url($user_domain) ?>" class="btn btn-light-primary btn-sm mt-2"><i class="flaticon-calendar"></i> <?php echo trans('book-appointment') ?></a>
                                    <?php else: ?>
                                        <a href="<?php echo prep_url($user_domain) ?>" class="btn btn-light-secondary btn-sm mt-2"><i class="icon-eye"></i> <?php echo trans('view-profile') ?></a>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </div>

                            

                        </div>
                    </div>
                </div>
            <?php endforeach ?>
        </div>

        <div class="col-md-12 text-center mt-4">
            <?php echo $this->pagination->create_links(); ?>
        </div>
        <!-- End Users -->
        <?php endif; ?>
    </div>
</section>