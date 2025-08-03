<div class="content-wrapper">

  <section class="content">


    <div class="container">

      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title"><i class="flaticon-settings"></i> <?php echo trans('manage-settings') ?></h3>
        </div>

        <div class="box-body">
          <div class="row">
            <div class="col-md-3 mb-3">
              <ul class="nav nav-pills flex-column" id="myTab" role="tablist">
                <li class="nav-item mt-2">
                  <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true"><i class="fa fa-cog"></i> <?php echo trans('website-settings') ?></a>
                </li>
                <li class="nav-item mt-2">
                  <a class="nav-link" id="prefrences-tab" data-toggle="tab" href="#prefrences" role="tab" aria-controls="prefrences" aria-selected="false"><i class="fa fa-paint-brush"></i> <?php echo trans('preferences') ?></a>
                </li>
                <li class="nav-item mt-2">
                  <a class="nav-link" id="zoom-tab" data-toggle="tab" href="#zoom" role="tab" aria-controls="zoom" aria-selected="false"><i class="fa fa-video-camera"></i> Zoom <?php echo trans('settings') ?></a>
                </li>
                <li class="nav-item mt-2">
                  <a class="nav-link" id="mail-tab" data-toggle="tab" href="#mail" role="tab" aria-controls="mail" aria-selected="false"><i class="fa fa-envelope"></i> <?php echo trans('email-settings') ?></a>
                </li>
                <li class="nav-item mt-2">
                  <a class="nav-link" id="captcha-tab" data-toggle="tab" href="#captcha" role="tab" aria-controls="captcha" aria-selected="false"><i class="fa fa-check-circle"></i> reCaptcha V2 <?php echo trans('settings') ?></a>
                </li>
                <li class="nav-item mt-2">
                  <a class="nav-link" id="social-tab" data-toggle="tab" href="#social" role="tab" aria-controls="social" aria-selected="false"><i class="fa fa-facebook-official"></i> <?php echo trans('social-settings') ?></a>
                </li>
                <li class="nav-item mt-2">
                  <a class="nav-link" id="verification-tab" data-toggle="tab" href="#verification" role="tab" aria-controls="verification" aria-selected="false"><i class="fa fa-check-circle"></i> <?php echo trans('doctors-verification') ?></a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" id="whatsapp-tab" data-toggle="tab" href="#whatsapp" role="tab" aria-controls="whatsapp" aria-selected="false"><i class="fa fa-whatsapp mr-1"></i> <?php echo trans('whatsapp').' '.trans('settings') ?></a>
                </li>
                <li class="nav-item mt-2">
                  <a class="nav-link" id="twilio-tab" data-toggle="tab" href="#twilio" role="tab" aria-controls="twilio" aria-selected="false"><i class="fa fa-comment mr-1"></i> <?php echo trans('twilio-sms-settings') ?></a>
                </li>
                <li class="nav-item mt-2">
                  <a class="nav-link" id="pwa-tab" data-toggle="tab" href="#pwa" role="tab" aria-controls="pwa" aria-selected="false"><i class="fa fa-mobile pr-2"> </i> <?php echo trans('pwa-settings') ?></a>
                </li>
              </ul>
            </div>

            <!-- col-md-4 -->
            
              <div class="col-md-9">
                <form method="post" enctype="multipart/form-data" action="<?php echo base_url('admin/settings/update') ?>" role="form" class="form-horizontal pl-20">
                  <div class="tab-content" id="myTabContent">
                    
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
              
                        <div class="row mb-4">
                            <div class="col-sm-4">
                                <div class="form-group m-t-20">
                                  <div class="col-sm-12">
                                    <div class="mih-100">
                                      <img width="50px" src="<?php echo base_url($settings->favicon); ?>">
                                    </div>

                                    <div class="psr m-t-5">
                                      <a class='btn btn-light-secondary' href='javascript:;'>
                                        <i class="fa fa-cloud-upload"></i> <?php echo trans('upload-favicon') ?>
                                        <input type="file" class="upload_img_deg" name="photo1" size="40"  onchange='$("#upload-favicon").html($(this).val());'>
                                      </a>
                                      &nbsp;
                                      <span class='label label-default' id="upload-favicon"></span>
                                    </div>
                                  </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group m-t-20">
                                  <div class="col-sm-12">
                                    <div class="mih-100">
                                    <img width="150px" src="<?php echo base_url($settings->logo); ?>">
                                  </div>

                                    <div class="psr m-t-5">
                                      <a class='btn btn-light-secondary' href='javascript:;'>
                                        <i class="fa fa-cloud-upload"></i> <?php echo trans('upload-logo') ?>
                                        <input type="file" class="upload_img_deg" name="photo2" size="40"  onchange='$("#upload-logo").html($(this).val());'>
                                      </a>
                                      &nbsp;
                                      <span class='label label-default' id="upload-logo"></span>
                                    </div>
                                  </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group m-t-20">
                                  <div class="col-sm-12">
                                    <div class="mih-100">
                                    <img width="100px" src="<?php echo base_url($settings->hero_img); ?>">
                                  </div>

                                    <div class="psr m-t-5">
                                      <a class='btn btn-light-secondary' href='javascript:;'>
                                        <i class="fa fa-cloud-upload"></i> <?php echo trans('upload-home-image') ?>
                                        <input type="file" class="upload_img_deg" name="photo3" size="40"  onchange='$("#upload-hero").html($(this).val());'>
                                      </a>
                                      &nbsp;
                                      <span class='label label-default' id="upload-hero"></span>
                                    </div>
                                  </div>
                                </div>
                            </div>
                        </div>



                        <div class="form-group m-t-20">
                          <label class="col-sm-12 control-label" for="example-input-normal"><?php echo trans('application-name') ?></label>
                          <div class="col-sm-12">
                            <input type="text" name="site_name" value="<?php echo html_escape($settings->site_name); ?>" class="form-control" >
                          </div>
                        </div>

                        <div class="form-group m-t-20">
                          <label class="col-sm-12 control-label" for="example-input-normal"><?php echo trans('application-title') ?></label>
                          <div class="col-sm-12">
                            <input type="text" name="site_title" value="<?php echo html_escape($settings->site_title); ?>" class="form-control" >
                          </div>
                        </div>

                        <div class="form-group">
                          <label class="col-sm-12 control-label" for="example-input-normal"><?php echo trans('keywords') ?></label>
                          <div class="col-sm-12">
                            <input type="text" data-role="tagsinput" name="keywords" value="<?php echo html_escape($settings->keywords); ?>" class="form-control" >
                          </div>
                        </div>

                        <div class="form-group">
                          <label class="col-sm-12 control-label" for="example-input-normal"><?php echo trans('description') ?></label>
                          <div class="col-sm-12">
                            <textarea class="form-control" name="description" rows="4"><?php echo html_escape($settings->description); ?></textarea>
                          </div>
                        </div>


                        <div class="form-group">
                          <label class="col-sm-12 control-label" for="example-input-normal"><?php echo trans('footer-about') ?></label>
                          <div class="col-sm-12">
                            <textarea class="form-control" name="footer_about"><?php echo html_escape($settings->footer_about); ?></textarea>
                          </div>
                        </div>

                        <div class="form-group">
                          <label class="col-sm-12 control-label" for="example-input-normal"><?php echo trans('admin-email') ?></label>
                          <div class="col-sm-12">
                            <input type="text" name="admin_email" class="form-control" value="<?php echo html_escape(user()->email); ?>">
                          </div>
                        </div>

                        <div class="form-group">
                          <label class="col-sm-12 control-label" for="example-input-normal"><?php echo trans('copyright') ?></label>
                          <div class="col-sm-12">
                            <input type="text" name="copyright" class="form-control" value="<?php echo html_escape($settings->copyright); ?>">
                          </div>
                        </div>

                        <div class="form-group m-b-20">
                          <label class="col-sm-12 control-label" for="example-input-normal"><?php echo trans('set-trial-days') ?></label>
                          <div class="col-sm-12">
                            <input type="number" name="trial_days" class="form-control" value="<?php echo html_escape($settings->trial_days); ?>">
                            <p class="smalls text-danger"><i class="fa fa-info-circle"></i> <?php echo trans('set-trial-info') ?></p>
                          </div>
                        </div>

                        <div class="form-group m-b-20">
                          <label class="col-sm-12 control-label" for="example-input-normal"><?php echo trans('email-before-the-plan-ends') ?></label>
                          <div class="col-sm-12">
                            <input type="number" name="expire_reminder" class="form-control" value="<?php echo html_escape($settings->expire_reminder); ?>">
                            <p class="smalls text-danger"><i class="fa fa-info-circle"></i> <?php echo trans('set-0-to-disable-this-option') ?></p>
                          </div>
                        </div>

                        <div class="form-group m-b-20">
                            <label class="col-sm-12 control-label" for="example-input-normal"><?php echo trans('currency') ?></label>
                            <div class="col-sm-12">
                              <select class="form-control single_select pt-0" id="country" name="country">
                                  <option value=""><?php echo trans('select') ?></option>
                                  <?php foreach ($currencies as $currency): ?>
                                      <?php if (!empty($currency->currency_name)): ?>
                                        <option value="<?php echo html_escape($currency->id); ?>" 
                                          <?php echo (settings()->country == $currency->id) ? 'selected' : ''; ?>>
                                          <?php echo html_escape($currency->name.'  -  '.$currency->currency_code.' ('.$currency->currency_symbol.')'); ?>
                                        </option>
                                      <?php endif ?>
                                  <?php endforeach ?>
                              </select>
                            </div>
                        </div>
                    </div>


                    <!-- zoom tab -->
                    <div class="tab-pane fade" id="zoom" role="tabpanel" aria-labelledby="zoom-tab">


                          <div class="row">
                            <?php if (empty(settings()->zoom_account_id) && empty(settings()->zoom_client_id) && empty(settings()->zoom_client_secret)): ?>
                              <div class="col-md-12 p-0" data-aos="fade-down" data-aos-duration="100">
                                <div class="form-group mt-20 p-10">
                                  <div class="bg-warning-soft text-dark mb-20" style="border-radius: 4px; border: 2px solid #ffc107;">
                                    <p class="p-20"><b class="text-warning"><i class="icon-info"></i> Warning:</b> As of September 8, 2023, the Zoom JWT app type has been deprecated. We migrated JWT to Server-to-Server OAuth app in Doxe, Please re-generate zoom api keys to follow the new documentation here - <a target="_blank" href="http://doxe.originlabsoft.com/docs/#docs_zoom">Zoom Integration Guide</a></p>
                                  </div>
                                </div>
                              </div>
                            <?php endif; ?>
                          </div>


                          <div class="alert bg-success-soft conn_info hide brd-2" role="alert">
                       
                          </div>

             
                          <div class="alert bg-danger-soft conn_error hide brd-2" role="alert">
                    
                          </div>
                       

                        <div class="form-group mt-20 p-10">
                            <p class=""><a class="pull-left badge badge-danger-soft brd-20" target="_blank" href="https://marketplace.zoom.us/"><i class="fa fa-plus-circle"></i> <?php echo trans('create-zoom-app') ?></a>

                            <a class="pull-right badge badge-success-soft brd-20" target="_blank" href="http://doxe.originlabsoft.com/docs/#docs_zoom"><i class="fa fa-question-circle"></i> <?php echo trans('zoom-integration-doc') ?></a></p>
                        </div>

                        <div class="form-group mt-20">
                          <label class="col-sm-12 control-label" for="example-input-normal"><?php echo trans('zoom-account-id') ?></label>
                          <div class="col-sm-12">
                            <input type="text" name="zoom_account_id" value="<?php echo html_escape($settings->zoom_account_id); ?>" class="form-control">
                          </div>
                        </div>
                        <div class="form-group m-t-20">
                          <label class="col-sm-12 control-label" for="example-input-normal"><?php echo trans('zoom-client-id') ?></label>
                          <div class="col-sm-12">
                            <input type="text" name="zoom_client_id" value="<?php echo html_escape($settings->zoom_client_id); ?>" class="form-control">
                          </div>
                        </div>

                        <div class="form-group m-t-20">
                          <label class="col-sm-12 control-label" for="example-input-normal"><?php echo trans('zoom-client-secret') ?></label>
                          <div class="col-sm-12">
                            <input type="password" name="zoom_client_secret" value="<?php echo html_escape($settings->zoom_client_secret); ?>" class="form-control">
                          </div>
                        </div>


                        <div class="form-group mb-5">
                          <div class="col-sm-12">
                            <?php if (!empty(settings()->zoom_account_id) && !empty(settings()->zoom_client_id) && !empty(settings()->zoom_client_secret)): ?>    
                              <a class="btn btn-danger pull-right mb-5 check_zoom_api" href="#"><i class="fa fa-refresh"></i> <?php echo trans('check-api-connection') ?></a><br><br>
                            <?php endif; ?>
                          </div>
                        </div>

                    </div>

                    <!-- prefrences tab -->
                    <div class="tab-pane fade" id="prefrences" role="tabpanel" aria-labelledby="prefrences-tab">
                        <div class="form-group">
                            <div class="col-sm-12 mt-15">

                              <div class="custom-control custom-switch ml-10">
                                  <input type="checkbox" name="enable_multilingual" class="custom-control-input" value="1" id="switch-8" <?php if($settings->enable_multilingual == 1){echo "checked";} ?>>
                                  <label class="custom-control-label" for="switch-8"><?php echo trans('multilingual-system') ?></label>
                                  <p class="text-muted"><small><?php echo trans('enable-multilingual') ?>.</small></p>
                              </div>
                              
                              <div class="custom-control custom-switch ml-10 mt-25">
                                  <input type="checkbox" name="enable_registration" class="custom-control-input" value="1" id="switch-2" <?php if($settings->enable_registration == 1){echo "checked";} ?>>
                                  <label class="custom-control-label" for="switch-2"><?php echo trans('registration-system') ?></label>
                                  <p class="text-muted"><small><?php echo trans('registration-title') ?>.</small></p>
                              </div>

                              <div class="custom-control custom-switch ml-10 mt-25 <?php if(get_user_info() == false){echo 'd-none';} ?>">
                                  <input type="checkbox" name="enable_payment" class="custom-control-input" value="1" id="switch-9" <?php if($settings->enable_payment == 1){echo "checked";} ?>>
                                  <label class="custom-control-label" for="switch-9"><?php echo trans('payments') ?></label>
                                  <p class="text-muted"><small><?php echo trans('enable') ?>/<?php echo trans('disable').' '.trans('payments') ?></small></p>
                              </div>

                              <div class="custom-control custom-switch ml-10 mt-25">
                                  <input type="checkbox" name="enable_captcha" class="custom-control-input" value="1" id="switch-1" <?php if($settings->enable_captcha == 1){echo "checked";} ?>>
                                  <label class="custom-control-label" for="switch-1">reCaptcha</label>
                                  <p class="text-muted"><small><?php echo trans('recaptcha-title') ?></small></p>
                              </div>

                              <div class="custom-control custom-switch ml-10 mt-25">
                                  <input type="checkbox" name="enable_email_verify" class="custom-control-input" value="1" id="switch-3" <?php if($settings->enable_email_verify == 1){echo "checked";} ?>>
                                  <label class="custom-control-label" for="switch-3"><?php echo trans('email-verification') ?></label>
                                  <p class="text-muted"><small><?php echo trans('email-verify-title') ?></small></p>
                              </div>

                              <div class="custom-control custom-switch ml-10 mt-25">
                                  <input type="checkbox" name="enable_sms_verify" class="custom-control-input" value="1" id="sms-verify" <?php if($settings->enable_sms_verify == 1){echo "checked";} ?>>
                                  <label class="custom-control-label" for="sms-verify"><?php echo trans('sms-verification') ?></label>
                                  <p class="text-muted"><small><?php echo trans('sms-verify-title') ?></small></p>
                                  <p class="text-danger mb-0 mt-0"><small><?php echo trans('sms-note-title') ?>.</small></p>
                              </div>

                              <div class="custom-control custom-switch ml-10 mt-25">
                                  <input type="checkbox" name="enable_users" class="custom-control-input" value="1" id="switch-4" <?php if($settings->enable_users == 1){echo "checked";} ?>>
                                  <label class="custom-control-label" for="switch-4"><?php echo trans('users') ?></label>
                                  <p class="text-muted"><small><?php echo trans('users-title') ?></small></p>
                              </div>

                              <div class="custom-control custom-switch ml-10 mt-25">
                                  <input type="checkbox" name="enable_blog" class="custom-control-input" value="1" id="switch-5" <?php if($settings->enable_blog == 1){echo "checked";} ?>>
                                  <label class="custom-control-label" for="switch-5"><?php echo trans('blogs') ?></label>
                                  <p class="text-muted"><small><?php echo trans('blogs-title') ?></small></p>
                              </div>

                              <div class="custom-control custom-switch ml-10 mt-25">
                                  <input type="checkbox" name="enable_faq" class="custom-control-input" value="1" id="switch-6" <?php if($settings->enable_faq == 1){echo "checked";} ?>>
                                  <label class="custom-control-label" for="switch-6"><?php echo trans('faqs') ?></label>
                                  <p class="text-muted"><small><?php echo trans('faq-title') ?></small></p>
                              </div>

                              <div class="custom-control custom-switch ml-10 mt-25">
                                  <input type="checkbox" name="enable_workflow" class="custom-control-input" value="1" id="switch-7" <?php if($settings->enable_workflow == 1){echo "checked";} ?>>
                                  <label class="custom-control-label" for="switch-7"><?php echo trans('workflow') ?></label>
                                  <p class="text-muted"><small><?php echo trans('workflow-enable') ?></small></p>
                              </div>

                            </div>
                        </div>
                    </div>


                    <!-- mail tab -->
                    <div class="tab-pane fade" id="mail" role="tabpanel" aria-labelledby="mail-tab">
                        
                      <div class="col-sm-12 mt-15">

                          <div class="callout callout-default">
                              <h4><i class="fa fa-envelope-o"></i> Gmail Smtp</h4>

                              <p>Gmail Host:&nbsp;&nbsp;smtp.gmail.com <br>
                              Gmail Port:&nbsp;&nbsp;465</p>

                              <p class="text-success mb-5"><b><i class="fa fa-info-circle"></i> <?php echo trans('mail-info-title') ?></b></p>
                              <p><i class="fa fa-long-arrow-right"></i> <?php echo trans('two-factor-off') ?> <br>
                              <i class="fa fa-long-arrow-right"></i> <?php echo trans('less-secure-app-on') ?></p>
                          </div>

                          <div class="form-group">
                              <label class="control-label"><?php echo trans('mail-type') ?></label>
                              <select name="mail_protocol" class="form-control custom-select">
                                  <option value="smtp" <?php echo ($settings->mail_protocol == "smtp") ? "selected" : ""; ?>>smtp</option>
                                  <option value="mail" <?php echo ($settings->mail_protocol == "mail") ? "selected" : ""; ?>>mail</option>
                              </select>
                          </div>

                          <div class="form-group">
                              <label class="control-label"><?php echo trans('mail-title') ?></label>
                              <input type="text" class="form-control" name="mail_title"
                                     value="<?php echo html_escape($settings->mail_title); ?>">
                          </div>

                          <div class="form-group">
                              <label class="control-label"><?php echo trans('mail-host') ?></label>
                              <input type="text" class="form-control" name="mail_host"
                                     value="<?php echo html_escape($settings->mail_host); ?>">
                          </div>

                          <div class="form-group">
                              <label class="control-label"><?php echo trans('mail-port') ?></label>
                              <input type="text" class="form-control" name="mail_port"
                                      value="<?php echo html_escape($settings->mail_port); ?>">
                          </div>

                          <div class="form-group">
                              <label class="control-label"><?php echo trans('mail-username') ?></label>
                              <input type="text" class="form-control" name="mail_username"
                                      value="<?php echo html_escape($settings->mail_username); ?>" autocomplete="off">
                          </div>

                          <div class="form-group">
                              <label class="control-label"><?php echo trans('mail-password') ?></label>
                              <input type="password" class="form-control" name="mail_password"
                                      value="<?php echo base64_decode($settings->mail_password); ?>" autocomplete="off">
                          </div>

                          <div class="form-group">
                              <label class="control-label"><?php echo trans('mail-encryption') ?></label>
                              <select name="mail_encryption" class="form-control custom-select">
                                  <option value="ssl" <?php echo ($settings->mail_encryption == "ssl") ? "selected" : ""; ?>>SSL</option>
                                  <option value="tls" <?php echo ($settings->mail_encryption == "tls") ? "selected" : ""; ?>>TLS</option>
                              </select>
                              <p class="small"><i class="fa fa-info-circle"></i> <?php echo trans('mail-port-help') ?> </p>
                          </div>

                          <div class="form-group">
                          <a target="_blank" href="<?php echo base_url('auth/test_mail') ?>" class="btn btn-light-secondary btn-lg mb-50 pull-left"><i class="fa fa-paper-plane"></i> <?php echo trans('send-test-mail') ?></a>
                        </div>
                      </div>

                    </div>

                    <!-- social tab -->
                    <div class="tab-pane fade" id="social" role="tabpanel" aria-labelledby="social-tab">
                        <div class="form-group m-t-20">
                          <label class="col-sm-12 control-label" for="example-input-normal">Facebook</label>
                          <div class="col-sm-12">
                            <input type="text" name="facebook" value="<?php echo html_escape($settings->facebook); ?>" class="form-control" >
                          </div>
                        </div>
                        <div class="form-group m-t-20">
                          <label class="col-sm-12 control-label" for="example-input-normal">Twitter</label>
                          <div class="col-sm-12">
                            <input type="text" name="twitter" value="<?php echo html_escape($settings->twitter); ?>" class="form-control" >
                          </div>
                        </div>
                        <div class="form-group m-t-20">
                          <label class="col-sm-12 control-label" for="example-input-normal">Instagram</label>
                          <div class="col-sm-12">
                            <input type="text" name="instagram" value="<?php echo html_escape($settings->instagram); ?>" class="form-control" >
                          </div>
                        </div>
                        <div class="form-group m-t-20">
                          <label class="col-sm-12 control-label" for="example-input-normal">Linkedin</label>
                          <div class="col-sm-12">
                            <input type="text" name="linkedin" value="<?php echo html_escape($settings->linkedin); ?>" class="form-control" >
                          </div>
                        </div>

                        <div class="form-group">
                          <label class="col-sm-12 control-label" for="example-input-normal">Google Analytics</label>
                          <div class="col-sm-12">
                            <textarea class="form-control" name="google_analytics" rows="8"><?php echo base64_decode($settings->google_analytics) ?></textarea>
                          </div>
                        </div>
                    </div>


                    <!-- verification tab -->
                    <div class="tab-pane fade" id="verification" role="tabpanel" aria-labelledby="verification-tab">
                        <div class="row main_item p-15">
                          <div class="col-md-12">

                            <div class="custom-control custom-switch ml-10">
                                <input type="checkbox" name="profile_verification" class="custom-control-input" value="1" id="switch-dv" <?php if($settings->profile_verification == 1){echo "checked";} ?>>
                                <label class="custom-control-label" for="switch-dv"><?php echo trans('enable-verification') ?></label>
                                <p class="text-muted"><small><?php echo trans('enable-verification-details') ?></small></p>
                            </div>

                            
                            <div class="form-group mt-2 hideable">
                              <a href="#" data-id="0" class="add_verification_row btn btn-secondary"><i class="fa fa-plus-circle"></i> Add New</a>
                            </div>

                            <div class="houritem"></div>

                            <?php foreach (json_decode(settings()->verification_items) as $vitem): ?>
                              <div class="row new_item_row">
                                <div class="col-md-5 pr-0 mb-2">
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="verification_items[]" value="<?php echo $vitem ?>">
                                    </div>
                                </div>

                              
                                <div class="col-sm-2 mb-2">
                                  <a href="javascript:void(0);" class="remove_time_row text-danger"><i class="icon-trash"></i></a>
                                </div>
                                
                              </div>
                            <?php endforeach ?>

                            <p class="mt-10"><i class="fa fa-info-circle"></i> <?php echo trans('enable-verification-suggestion') ?> </p>
                          </div>
                        </div>
                    </div>



                    <!-- captcha tab -->
                    <div class="tab-pane fade" id="captcha" role="tabpanel" aria-labelledby="captcha-tab">

                        <div class="form-group p-5 mb-50">
                          <label class="col-sm-12 control-label" for="example-input-normal">reCaptcha Result</label>
                          <?php if (settings()->captcha_site_key != ''): ?>
                              <div class="g-recaptcha pull-left m-10" data-sitekey="<?php echo html_escape(settings()->captcha_site_key); ?>"></div>
                          <?php endif ?>
                        </div>

                        <div class="form-group mt-20">
                          <label class="col-sm-12 control-label" for="example-input-normal">Captcha Site key</label>
                          <div class="col-sm-12">
                            <input type="text" name="captcha_site_key" value="<?php echo html_escape($settings->captcha_site_key); ?>" class="form-control" >
                          </div>
                        </div>
                        <div class="form-group m-t-20">
                          <label class="col-sm-12 control-label" for="example-input-normal">Captcha Secret key</label>
                          <div class="col-sm-12">
                            <input type="text" name="captcha_secret_key" value="<?php echo html_escape($settings->captcha_secret_key); ?>" class="form-control" >
                          </div>
                        </div>
                    </div>


                    <!-- whatsapp tab -->
                    <div class="tab-pane fade pl-4" id="whatsapp" role="tabpanel" aria-labelledby="whatsapp-tab">
                            
                      <div class="form-group">
                          <div class="custom-control custom-switch prefrence-item pt-10">
                            <input type="checkbox" <?php if($settings->global_ultramsg == 1){echo "checked";} ?> value="1" name="global_ultramsg" class="custom-control-input" id="switch-wg" aria-invalid="false">
                            <label class="custom-control-label" for="switch-wg"><?php echo trans('enable-globally') ?></label>
                            <p class="small text-muted"><?php echo trans('enable-globally-whatsapp') ?></p>
                          </div>
                      </div>

                      <div class="form-group">
                        <p><?php echo trans('whatsapp') ?> (<b><a class="text-success" target="_blank" href="https://ultramsg.com"><?php echo trans('ultramsg-api') ?></a></b>)</p>
                      </div>

                      <div class="form-group">
                        <label><?php echo trans('instance-id') ?></label>
                          <input type="text" name="ultramsg_instance_id" value="<?php echo html_escape($settings->ultramsg_instance_id); ?>" class="form-control" >
                      </div>

                      <div class="form-group">
                        <label><?php echo trans('token') ?></label>
                          <input type="text" name="ultramsg_token" value="<?php echo html_escape($settings->ultramsg_token); ?>" class="form-control" >
                      </div>
                    </div>

                    <!-- Twilio tab -->
                    <div class="tab-pane fade pl-4" id="twilio" role="tabpanel" aria-labelledby="sms-tab">

                        <div class="form-group">
                            <div class="custom-control custom-switch prefrence-item pt-10">
                              <input type="checkbox" <?php if($settings->global_twilio == 1){echo "checked";} ?> value="1" name="global_twilio" class="custom-control-input" id="switch-tg" aria-invalid="false">
                              <label class="custom-control-label" for="switch-tg"><?php echo trans('enable-globally') ?></label> <br>
                              <p class="small text-muted"><?php echo trans('enable-globally-twilio') ?></p>
                            </div>
                        </div>

                        <div class="form-group">
                          <label><?php echo trans('account-sid') ?></label>
                            <input type="text" name="twillo_account_sid" value="<?php echo html_escape($settings->twillo_account_sid); ?>" class="form-control" >
                        </div>

                        <div class="form-group">
                          <label><?php echo trans('twilio-auth-token') ?></label>
                            <input type="text" name="twillo_auth_token" value="<?php echo html_escape($settings->twillo_auth_token); ?>" class="form-control" >
                        </div>

                        <div class="form-group">
                          <label><?php echo trans('sender-number-tw') ?></label>
                            <input type="text" name="twillo_number" value="<?php echo html_escape($settings->twillo_number); ?>" class="form-control" >
                        </div>
                    </div>


                    <!-- pwa tab -->
                    <div class="tab-pane fade pl-4" id="pwa" role="tabpanel" aria-labelledby="pwa-tab">
                            
                      <div class="form-group">
                        <div class="custom-control custom-switch prefrence-item ml-10 mt-25">
                            <input type="checkbox" name="enable_pwa" class="custom-control-input" value="1" id="switch-pwa" <?php if($settings->enable_pwa == 1){echo "checked";} ?>>
                            <label class="custom-control-label" for="switch-pwa"><?php echo trans('enable-pwa') ?></label>
                            <p class="text-muted mb-2"><small><?php echo trans('enable-pwa-title') ?></small></p>
                        </div>
                      </div>

                      <div class="form-group">
                          <div class="col-sm-4">
                            <div class="mih-100">
                              <?php $pwa_thumb = !empty(settings()->pwa_logo)? settings()->pwa_logo :"assets/pwa/logo-bk.png"; ?>
                              <img class="m-auto" width="100px" src="<?php echo base_url($pwa_thumb); ?>">
                            </div>

                          <div class="form-group">
                              <div class="custom-file">
                                <input type="file" class="custom-file-input" name="pwa_logo" id="customFile">
                                <label class="custom-file-label" for="customFile"><?php echo trans('upload-logo') ?></label>
                              </div>
                              <p class="mt-1 small text-danger"><i class="bi bi-info-circle"></i> Image size 512x512</p>
                          </div>
                        </div>
                      </div>

                  </div>

                  <!-- csrf token -->
                  <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">

                  <div class="pr-30 mt-30">
                    <button type="submit" class="btn btn-light-primary btn-lg btn-block ml-15 mb-50 pull-left"><i class="fa fa-check"></i> <?php echo trans('save-changes') ?></button>
                  </div>
                    
                </form>
              </div>
            
          </div>
        </div>
      </div>

    </div>

  </section>

</div>

