<div class="content-wrapper">

  <section class="content container">

    <div class="row">
      <div class="col-xl-4 col-lg-4">

        <!-- Profile Image -->
        <div class="box">
          <div class="box-body box-profile text-center">
            <img class="profile-user-img rounded-circle img-fluid mx-auto d-block shadow-lg" src="<?php echo base_url($user->thumb); ?>" alt="User profile picture">

            <div class="d-none">
                <a href="#" class="badge badge-info mt-0 crop_avatar "><i class="fa fa-cloud-upload"></i> <?php echo trans('change-avatar') ?></a>
            </div>

            <h4 class="text-center mt-2"><?php echo html_escape($user->name) ?></h4>
            
            <p class="text-center mb-0"><?php echo html_escape($user->specialist) ?></p>
            <p class="text-center"><?= $user->degree ?></p>

            <div class="user-social-acount text-center">
                <?php if (!empty($user->facebook)): ?>
                  <a href="<?php echo html_escape($user->facebook) ?>" class="btn btn-circle btn-social-icon btn-facebook"><i class="fa fa-facebook"></i></a>
                <?php endif ?>

                <?php if (!empty($user->twitter)): ?>
                  <a href="<?php echo html_escape($user->twitter) ?>" class="btn btn-circle btn-social-icon btn-twitter"><i class="fa fa-twitter"></i></a>
                <?php endif ?>

                <?php if (!empty($user->instagram)): ?>
                  <a href="<?php echo html_escape($user->instagram) ?>" class="btn btn-circle btn-social-icon btn-instagram"><i class="fa fa-instagram"></i></a>
                <?php endif ?>

                <?php if (!empty($user->linkedin)): ?>
                  <a href="<?php echo html_escape($user->linkedin) ?>" class="btn btn-circle btn-social-icon btn-linkedin"><i class="fa fa-linkedin"></i></a>
                <?php endif ?>
            </div>
          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->
      </div>
      <!-- /.col -->

      <div class="box col-xl-8 col-lg-8">  

        <div class="crop_area" style="display: none;">
            <div class="row">
                <div class="col-md-12 text-center">
                    <input class="btn btn-default mb-4 mt-4" type="file" id="upload">
                    <div id="upload-demo" style="width:350px; margin: 0 auto"></div>

                    <button class="btn btn-primary upload-result mb-4"><i class="fa fa-check"></i><?php echo trans('save-changes') ?></button>
                </div>
            </div>
        </div>

        <div class="profile_form">
            <form method="post" enctype="multipart/form-data" action="<?php echo base_url('admin/profile/update') ?>" role="form" class="form-horizontal">
     
              <div class="nav-tabs-custom b-0">
                  <ul class="nav nav-tabs">
                      <li><a class="active" href="#content1" data-toggle="tab"><i class="fa fa-pencil-square"></i> <?php echo trans('update-info') ?></a></li>
                      <li><a href="#content4" data-toggle="tab"><i class="fa fa-cog"></i> <?php echo trans('social-settings') ?></a></li>
                      <li><a href="#content5" data-toggle="tab"><i class="fa fa-search"></i> <?php echo trans('seo-settings') ?></a></li>
                      <li><a href="#content6" data-toggle="tab"><i class="fa fa-cog"></i> <?php echo trans('custom-js') ?></a></li>
                  </ul>
                              
                  <div class="tab-content">
                    
                    <!-- tab 1 -->
                    <div class="active tab-pane" id="content1">

                      <div class="row">
                          <div class="col-md-12 mb-20">
                            
                         
                            <div class="form-group m-t-20">
                                <div class="row">
                                  <div class="col-sm-6">
                                    <div class="mih-100">
                                      <img width="150px" src="<?php echo base_url($user->thumb); ?>">
                                    </div>

                                    <div class="psr m-t-5">
                                      <a class='btn btn-light-secondary' href='javascript:;'>
                                        <i class="fa fa-cloud-upload"></i> <?php echo trans('upload-image') ?>
                                        <input type="file" class="upload_img_deg" name="photo2" size="40"  onchange='$("#upload-avatar").html($(this).val());'>
                                      </a>
                                      &nbsp;
                                      <span class='label label-default' id="upload-avatar"></span>
                                    </div>
                                  </div>

                                  <div class="col-sm-6">
                                    <div class="mih-100">
                                      <img width="150px" src="<?php echo base_url($user->signature); ?>">
                                    </div>

                                    <div class="psr m-t-5">
                                      <a class='btn btn-light-secondary' href='javascript:;'>
                                        <i class="fa fa-cloud-upload"></i> <?php echo trans('upload-signature') ?>
                                        <input type="file" class="upload_img_deg" name="photo1" size="40"  onchange='$("#upload-favicon").html($(this).val());'>
                                      </a>
                                      &nbsp;
                                      <span class='label label-default' id="upload-favicon"></span>
                                    </div>
                                  </div>
                                </div>
                            </div>
                

                            <div class="form-group m-t-20">
                                <label class="col-sm-12 control-label" for="example-input-normal"><?php echo trans('name') ?></label>
                                <div class="col-sm-12">
                                    <input type="text" name="name" value="<?php echo html_escape($user->name); ?>" class="form-control" >
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-12 control-label" for="example-input-normal"><?php echo trans('email') ?></label>
                                <div class="col-sm-12">
                                    <input type="email" name="email" class="form-control" value="<?php echo html_escape($user->email); ?>">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-12 control-label" for="example-input-normal"><?php echo trans('phone') ?></label>
                                <div class="col-sm-12">
                                    <input type="text" name="phone" class="form-control" value="<?php echo html_escape($user->phone); ?>">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-12 control-label" for="example-input-normal"><?php echo trans('country') ?></label>
                                <div class="col-sm-12">
                                  <select class="form-control single_select pt-0" id="country" name="country">
                                      <option value=""><?php echo trans('select') ?></option>
                                        <?php foreach ($countries as $country): ?>
                                            <option value="<?php echo html_escape($country->id); ?>" 
                                              <?php echo ($user->country == $country->id) ? 'selected' : ''; ?>>
                                              <?php echo html_escape($country->name); ?>
                                            </option>
                                        <?php endforeach ?>
                                  </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-12 control-label" for="example-input-normal"><?php echo trans('city') ?></label>
                                <div class="col-sm-12">
                                    <input type="text" name="city" class="form-control" value="<?php echo html_escape($user->city); ?>">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-12 control-label" for="example-input-normal"><?php echo trans('specialist') ?></label>
                                <div class="col-sm-12">
                                    <input type="text" name="specialist" class="form-control" value="<?php echo html_escape($user->specialist); ?>">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-12 control-label" for="example-input-normal"><?php echo trans('degree') ?></label>
                                <div class="col-sm-12">
                                    <!-- id="ckEditor1" -->
                                    <textarea  class="form-control" name="degree" rows="2"><?= $user->degree; ?></textarea>
                                </div>
                            </div>

                            <div class="form-group m-t-20">
                                <label class="col-sm-12 control-label" for="example-input-normal"><?php echo trans('experience-years') ?></label>
                                <div class="col-sm-12">
                                    <input type="number" name="exp_years" value="<?php echo html_escape($user->exp_years); ?>" class="form-control" >
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-12 control-label" for="example-input-normal"><?php echo trans('about-me') ?></label>
                                <div class="col-sm-12">
                                    <textarea class="form-control" name="about_me" rows="10"><?= $user->about_me; ?></textarea>
                                </div>
                            </div>



                            <div class="form-group">
                                <label class="col-sm-12 control-label" for="example-input-normal"><?php echo trans('about-us') ?></label>
                                <div class="col-sm-12">
                                    <textarea class="form-control" name="about_us" rows="10"><?= $user->about_us; ?></textarea>
                                </div>
                            </div>

                          </div>
                      </div>

                    </div>


                    <!-- tab 4 -->
                    <div class="tab-pane" id="content4" aria-hidden="false">
                        <div class="form-group m-t-20">
                            <label class="col-sm-12 control-label" for="example-input-normal"><?php echo trans('facebook') ?></label>
                            <div class="col-sm-12">
                                <input type="text" name="facebook" value="<?php echo html_escape($user->facebook); ?>" class="form-control" >
                            </div>
                        </div>
                        <div class="form-group m-t-20">
                            <label class="col-sm-12 control-label" for="example-input-normal"><?php echo trans('twitter') ?></label>
                            <div class="col-sm-12">
                                <input type="text" name="twitter" value="<?php echo html_escape($user->twitter); ?>" class="form-control" >
                            </div>
                        </div>
                        <div class="form-group m-t-20">
                            <label class="col-sm-12 control-label" for="example-input-normal"><?php echo trans('linked-in') ?></label>
                            <div class="col-sm-12">
                                <input type="text" name="linkedin" value="<?php echo html_escape($user->linkedin); ?>" class="form-control" >
                            </div>
                        </div>
                        <div class="form-group m-t-20">
                            <label class="col-sm-12 control-label" for="example-input-normal"><?php echo trans('instagram') ?></label>
                            <div class="col-sm-12">
                                <input type="text" name="instagram" value="<?php echo html_escape($user->instagram); ?>" class="form-control" >
                            </div>
                        </div>
                    </div>

                    <!-- tab 5 -->
                    <div class="tab-pane" id="content5" aria-hidden="false">
                        <div class="form-group m-t-20">
                            <label class="col-sm-12 control-label" for="example-input-normal"><?php echo trans('meta-tags') ?></label>
                            <div class="col-sm-12">
                                <input type="text" data-role="tagsinput" name="meta_tags" value="<?php echo html_escape($user->meta_tags); ?>" class="form-control" >
                            </div>
                        </div>
                        <div class="form-group m-t-20">
                            <label class="col-sm-12 control-label" for="example-input-normal"><?php echo trans('description') ?></label>
                            <div class="col-sm-12">
                                <input type="text" name="description" value="<?php echo html_escape($user->description); ?>" class="form-control" >
                            </div>
                        </div>
                    </div>


                    <!-- tab 6 -->
                    <div class="tab-pane" id="content6" aria-hidden="false">
                        <div class="form-group">
                            <label class="col-sm-12 control-label" for="example-input-normal"><?php echo trans('custom-js') ?></label>
                            <div class="col-sm-12">
                                <textarea class="form-control" name="custom_js" rows="10"><?= $user->custom_js; ?></textarea>
                            </div>
                        </div>
                    </div>
                    
                    <!-- csrf token -->
                    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">

                    <div class="box-bottom mb-20">
                        <div class="pull-left ">
                            <button type="submit" class="btn btn-primary btn-lg"><i class="ficon flaticon-check"></i> <?php echo trans('save-changes') ?></button>
                        </div>
                    </div>
                    

                  </div>

              </div>

            </form>
        </div>

      </div>

  </section>

</div>