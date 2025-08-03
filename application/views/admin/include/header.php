<!DOCTYPE html>
<html lang="en" dir="<?php echo text_dir(); ?>">
<head>
  <?php $settings = get_settings(); ?>
  <?php $user = get_logged_user($this->session->userdata('id')); ?>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
  <meta name="description" content="">
  <meta name="author" content="Codericks">
  <link rel="icon" href="<?php echo base_url($settings->favicon) ?>">
  
  <title><?php echo html_escape($settings->site_name); ?> &bull; <?php if(isset($this->chamber->name)){echo html_escape($this->chamber->name).' &bull;';} ?> <?php if(isset($page_title)){echo html_escape($page_title);}else{echo "Dashboard";} ?></title>

  <!-- Bootstrap 4.3-->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/admin/css/bootstrap.min.css">

  <!-- Bootstrap extend 4.0-->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/admin/css/bootstrap-extend.css">
  
  <link href="<?php echo base_url() ?>assets/admin/css/toast.css" rel="stylesheet" />

  <link href="<?php echo base_url() ?>assets/admin/css/bootstrap-tagsinput.css" rel="stylesheet" />
  <link href="<?php echo base_url() ?>assets/admin/css/sweet-alert.css" rel="stylesheet" />
  <!-- DataTables -->
  <link href="<?php echo base_url() ?>assets/admin/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
  <!-- select 2 -->
  <link href="<?php echo base_url() ?>assets/admin/css/select2.css" rel="stylesheet" />
  <link href="<?php echo base_url() ?>assets/font/css/boxicons.min.css" rel="stylesheet" />

  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/admin/css/master_style.css?var=<?php echo settings()->version ?>&time=<?=time();?>">
  <?php if (settings()->theme == 2): ?>
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/admin/css/skins/theme_2.css?var=<?php echo settings()->version ?>&time=<?=time();?>">
  <?php else: ?>
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/admin/css/skins/theme_1.css?var=<?php echo settings()->version ?>&time=<?=time();?>">
  <?php endif ?>

  <!-- <link rel="stylesheet" href="<?php echo base_url() ?>assets/admin/css/skins/_all-skins.css">  --> 
  <link href="<?php echo base_url() ?>assets/admin/css/bootstrap-datepicker.min.css" rel="stylesheet">
  <link href="<?php echo base_url() ?>assets/admin/css/icons.css" rel="stylesheet">
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/front/css/simple-line-icons.css">
  <link href="<?php echo base_url() ?>assets/admin/css/bootstrap-switch.min.css" rel="stylesheet">
  <!-- <link href="<?php echo base_url() ?>assets/admin/css/timepicki.css" rel="stylesheet"> -->

  <!-- icons -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/admin/css/font-awesome.min.css">
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/font/flaticon.css">
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/front/css/aos.css">

  <link href="https://cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css" rel="stylesheet">
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/admin/css/croppie.css" />

  <?php if (isset($page_title) && $page_title != 'Doctors'): ?>
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/admin/css/radio.css" />
  <?php endif ?>

  
  <?php if (text_dir() == 'rtl'): ?>
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/admin/css/custom-rtl.css">
    <link rel="stylesheet" href="<?php echo base_url()?>assets/admin/css/bootstrap-rtl.min.css" crossorigin="anonymous">

    <style type="text/css">
      .radio input[type="radio"],
      .radio-inline input[type="radio"],
      .checkbox input[type="checkbox"],
      .checkbox-inline input[type="checkbox"] {
        margin-right: -20px !important;
      }
    </style>
  <?php endif ?>

  <!-- Color picker plugins css -->
  <link href="<?php echo base_url() ?>assets/admin/plugins/mjolnic-bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css" rel="stylesheet">

  <link href="<?php echo base_url() ?>assets/admin/css/bootstrap4-toggle.min.css" rel="stylesheet" />
  <link href="<?php echo base_url() ?>assets/admin/css/lightbox.min.css" rel="stylesheet" />
  
  <script type="text/javascript">
   var csrf_token = '<?php echo $this->security->get_csrf_hash(); ?>';
   var token_name = '<?php echo $this->security->get_csrf_token_name();?>'
 </script>

  <?php if (settings()->enable_captcha == 1 && settings()->captcha_site_key != ''): ?>
      <script src='https://www.google.com/recaptcha/api.js'></script>
  <?php endif; ?>

  </head>

  <body class="hold-transition skin-blue-light sidebar-mini">

    <!-- Site wrapper -->
    <div class="wrapper" data-aos="fade">

      <header class="main-header pt-csm-20">

        <?php if (is_admin()): ?>
          <a target="_blank" href="<?php echo base_url() ?>" class="switch_chambers logo text-center">
            <span class="logo-lg">
              <img width="30px" src="<?php echo base_url($settings->favicon) ?>" alt="<?php echo html_escape($settings->site_name); ?>">  <?php echo html_escape($settings->site_name); ?>
            </span>
          </a>
        <?php endif; ?>


        <?php if (is_patient()): ?>
          <a target="_blank" href="<?php echo base_url() ?>" class="switch_chambers logo text-center">
            <span class="logo-lg">
              <img width="30px" src="<?php echo base_url($settings->favicon) ?>" alt="<?php echo html_escape($settings->site_name); ?>">  <?php echo html_escape($settings->site_name); ?>
            </span>
          </a>
        <?php endif; ?>


        <?php if (is_user() || is_staff()): ?>

          <!-- <a href="#" class="switch_business smbuss dnone-lg">
            <img width="20px" src="<?php echo base_url($settings->favicon) ?>" alt="<?php echo html_escape($settings->site_name); ?>"> 
          </a> -->

          <a href="#" class="switch_business logo text-centers">
            <span class="logo-lg">
              <?php if (!empty($settings->favicon)): ?>
                <img width="30px" src="<?php echo base_url($settings->favicon) ?>" alt="<?php echo html_escape($settings->site_name); ?>"> 
              <?php endif ?>
              <span class="dnone-sms"><?php echo character_limiter($this->chamber->name, 12); ?> </span>
            </span> 
            <span class="buss-arrow pull-right"><i class="icon-arrow-right"></i></span>
          </a>

          <div class="business_switch_panel animate-ltr" style="display: none;">
            <div class="buss_switch_panel_header">
              <?php if (!empty($settings->favicon)): ?>
                <img width="30px" src="<?php echo base_url($settings->favicon) ?>" alt="<?php echo html_escape($settings->site_name); ?>"> 
              <?php endif ?>
              <span class="acc"><?php echo trans('your') ?> <?php echo html_escape($settings->site_name); ?> <?php echo trans('accounts') ?></span>
              <span class="business_close pull-right">×</span>
            </div>

            <div class="buss_switch_panel_body">
              <ul class="switcher_business_menu">
                <?php foreach (get_my_chambers() as $my_chm): ?>
                  <li class="business_menu_item <?php if($this->chamber->uid == $my_chm->uid){echo "default";} ?>">
                    <a class="business_menu_item_link" href="<?php echo base_url('admin/chamber/switch_chamber/'.$my_chm->uid) ?>">
                      <span class="business-menu_item_label">
                        <?php echo html_escape($my_chm->name) ?>
                        <?php if ($this->chamber->uid == $my_chm->uid): ?>
                          <span class="is_default pull-right"><i class="flaticon-check fa fa-check text-primary"></i></span>
                        <?php endif ?>
                      </span>
                    </a>
                  </li>
                <?php endforeach ?>
              </ul>

              <div class="seperater"></div>

              <?php if (is_user()): ?>
                <a class="new_business_link" href="<?php echo base_url('admin/chamber') ?>"><i class='bx bx-building-house' ></i> <span><?php echo trans('manage-chambers') ?></span></a>
              <?php endif; ?>
              <a class="new_business_link" href="<?php echo base_url('admin/profile') ?>"><i class="bx bx-user"></i> <span><?php echo trans('manage-profile') ?></span></a>
              <a class="new_business_link" href="<?php echo base_url('auth/logout') ?>"><i class='bx bx-log-out' ></i> <span><?php echo trans('sign-out') ?></span></a>
            </div>

            <div class="buss_switch_panel_footer"></div>
          </div>
        <?php endif; ?>



        <nav class="navbar navbar-static-top">
          <a href="#" class="sidebar-toggle cus" data-toggle="push-menu" role="button"> <i class='bx bx-menu bx-rotate-180' style='color:rgba(0,0,0,0.64)' ></i>
            <span class="sr-only">Toggle navigation</span>
          </a>

          <?php if (is_staff() || is_user()): ?>
            <div class="dropdown shortcut-menu mr-4 dnone-smss">
              <button type="button" class="btn btn-light-primary brd-20 dropdown-toggle" data-toggle="dropdown">
                <i class="fa fa-plus-circle"></i> <span class="dnone-sm"><?php echo trans('create-as-new') ?></span>
              </button>
              <div class="dropdown-menu shadow">
                
                <?php if (check_feature_access('prescription') == TRUE): ?>
                  <a class="dropdown-item" href="<?php echo base_url('admin/prescription') ?>"><?php echo trans('prescription') ?></a>
                <?php endif; ?>
                
                <?php if (check_my_payment_status() == TRUE): ?>
                  <?php if (check_feature_access('staffs') == TRUE): ?>
                    <a class="dropdown-item" href="<?php echo base_url('admin/staff') ?>"><?php echo trans('staff') ?></a>
                  <?php endif; ?>
                  <?php if (check_feature_access('patients') == TRUE): ?>
                    <a class="dropdown-item" href="<?php echo base_url('admin/patients') ?>"><?php echo trans('patient') ?></a>
                  <?php endif; ?>
                  <?php if (check_feature_access('appointments') == TRUE): ?>
                    <a class="dropdown-item" href="<?php echo base_url('admin/appointment') ?>"><?php echo trans('appointment') ?></a>
                  <?php endif; ?>
                <?php endif; ?>

                <a class="dropdown-item" href="<?php echo base_url('admin/drugs') ?>"><?php echo trans('drug') ?></a>
              </div>
            </div>
          <?php endif ?>

          <div class="navbar-custom-menu">
           
              <ul class="nav navbar-nav"> 
                  <li></li>
                  
                  <?php if (user()->role == 'admin' || user()->role == 'staff' || user()->role == 'patient'): ?>
                    <?php $avatar = $settings->favicon; ?>
                  <?php else: ?>
                    <?php $avatar = user()->thumb; ?>
                  <?php endif ?>

                  <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                      <img width="20px" src="<?php echo base_url($avatar) ?>" class="user-image rounded-circle" alt="User Image"> 
                      <span><span class="dnone-sm"><?php echo character_limiter(user()->name, 3) ?> </span> <i class="fa fa-angle-down"></i></span>
                    </a>

                    <ul class="dropdown-menu scale-up">
                      <!-- User image -->
                      <?php if (user()->role == 'admin'): ?>
                        <li class="user-header">
                          <img width="50%" src="<?php echo base_url($settings->logo) ?>" class="float-left admin-logo" alt="Admin Image">
                        </li>
                      <?php else: ?>
                        <li class="user-header pt-20">
                          <img src="<?php echo base_url($avatar) ?>" class="float-left rounded-circle" alt="User Image">
                          <p class="mt-0">
                            <small class="mt-0"><b><?php echo character_limiter(user()->name, 18); ?></b></small>
                            <small class="mb-5"><?php echo html_escape(user()->email); ?></small>
                          </p>
                        </li>
                      <?php endif ?>

                      <?php if (check_feature_access('custom-domain') == TRUE): ?>
                        <?php if (!empty(get_user_domain($this->session->userdata('id')))): ?>
                          <?php $user_domain = get_user_domain($this->session->userdata('id'))->custom_domain; ?>
                        <?php else: ?>
                          <?php $user_domain = base_url('profile/'.$this->session->userdata('slug')); ?>
                        <?php endif ?>
                      <?php else: ?>
                        <?php $user_domain = base_url('profile/'.$this->session->userdata('slug')); ?>
                      <?php endif; ?>

                      <!-- Menu Body -->
                      <li class="user-body">
                        <div class="rows no-gutters">
                          <div class="col-12 text-left user-link">
                            <?php if (user()->role == 'user'): ?>
                              <?php if (check_my_payment_status() == TRUE): ?>
                                <a target="_blank" href="<?php echo prep_url($user_domain) ?>"><i class="bx bx-user"></i> <?php echo trans('view-profile') ?></a>
                                
                                <a href="<?php echo base_url('admin/profile') ?>"><i class="icon-pencil"></i> <?php echo trans('update-profile') ?></a>
                              <?php endif ?>
                            <?php endif ?>
                            <a href="<?php echo base_url('admin/dashboard/change_password') ?>"><i class="icon-lock"></i> <?php echo trans('change-password') ?></a>
                          </div>

                          <div class="col-12 text-left">
                            <a href="<?php echo base_url('auth/logout') ?>"><i class="icon-power"></i> <?php echo trans('logout') ?></a>
                          </div>  
                        </div>
                        <!-- /.row -->
                      </li>
                    </ul>
                  </li>

                  <li><a href="#" data-toggle="control-sidebar"></a></li>
              </ul>
            <!-- <?php //endif; ?> -->
          </div>
        </nav>
      </header>


