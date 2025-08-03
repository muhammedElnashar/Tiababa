<?php if (check_my_payment_status() == TRUE): ?>

  <li class="treeview <?php if(isset($upage) && $upage == "User Settings"){echo "active";} ?>">
    <a href="#"><i class='bx bx-cog'></i>
      <span><?php echo trans('settings') ?></span>
      <span class="pull-right-container">
        <i class="fa fa-angle-right pull-right"></i>
      </span>
    </a>

    <ul class="treeview-menu">
      <?php if(check_staff_permissions('department') == 1):  ?>
        <li class="<?php if(isset($page_title) && $page_title == "Department"){echo "active";} ?>">
          <a href="<?php echo base_url('admin/department') ?>">
            <i class='bx bx-home' ></i> <span><?php echo trans('departments') ?></span>
          </a>
        </li>
      <?php endif; ?>

      <?php if(check_staff_permissions('schedule') == 1):  ?>
        <li class="<?php if(isset($page_title) && $page_title == "Appointment Schedule"){echo "active";} ?>">
          <a href="<?php echo base_url('admin/appointment/assign') ?>"><i class='bx bx-time' ></i> <?php echo trans('set-schedule') ?>
          </a>
        </li>
      <?php endif; ?>
      
      <?php if (check_feature_access('online-consultation') == TRUE): ?>
        <?php if (settings()->enable_wallet == 0): ?>
          <li class="<?php if(isset($page_title) && $page_title == "Payment Settings"){echo "active";} ?> <?= $uval; ?>">
            <a href="<?php echo base_url('admin/payment/user') ?>">
              <i class='bx bx-dollar-circle' ></i> <span><?php echo trans('payment-settings') ?></span>
            </a>
          </li>
        <?php endif ?>

        <?php if(check_staff_permissions('consultation-settings') == 1):  ?>
          <li class="<?php if(isset($page_title) && $page_title == "Consultation Settings"){echo "active";} ?>">
            <a href="<?php echo base_url('admin/live_consults/settings') ?>">
              <i class='bx bxs-cog' ></i> <span><?php echo trans('consultation-settings') ?></span>
            </a>
          </li>
        <?php endif; ?>
      <?php endif; ?>

      <?php if(check_staff_permissions('qr-code') == 1):  ?>
        <li class="<?php if(isset($page_title) && $page_title == "QR Settings"){echo "active";} ?>">
          <a class="" href="<?php echo base_url('admin/profile/qr_code') ?>">
            <i class='bx bx-qr' ></i> <span><?php echo trans('qr-code') ?></span>
          </a>
        </li>
      <?php endif; ?>

    </ul>
  </li>


  <?php if(check_staff_permissions('custom-domain') == 1):  ?>
    <?php if (check_feature_access('patients') == TRUE): ?>
      <li class="<?php if(isset($page_title) && $page_title == "Domain"){echo "active";} ?>">
        <a href="<?php echo base_url('admin/domain') ?>">
          <i class='bx bx-globe'></i> <span><?php echo  trans('custom-domain') ?></span>
        </a>
      </li>
    <?php endif; ?>
  <?php endif; ?>


  <?php if (settings()->enable_wallet == 1): ?>
    <?php if(check_staff_permissions('payouts') == 1):  ?>
      <li class="treeview <?php echo $uval ?> <?php if(isset($page) && $page == "Payouts"){echo "active";} ?>">
        <a href="#"><i class='bx bx-wallet' ></i>
          <span><?php echo trans('payouts') ?></span>
          <span class="pull-right-container">
            <i class="fa fa-angle-right pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
            <li class="<?php if(isset($page_title) && $page_title == "Set Payout Account"){echo "active";} ?>"><a class="" href="<?php echo base_url('admin/payouts/setup_account') ?>"><i class='bx bx-right-arrow-alt' ></i><?php echo trans('set-payout-account') ?> </a></li>

            <li class="<?php if(isset($page_title) && $page_title == "Payouts"){echo "active";} ?>"><a class="" href="<?php echo base_url('admin/payouts/user ') ?>"><i class='bx bx-right-arrow-alt' ></i><?php echo trans('payouts') ?></a></li>
        </ul>
      </li>
    <?php endif; ?>
  <?php endif; ?>


  <?php if (affiliate_settings()->is_enable == 1): ?>
    <?php if(check_staff_permissions('affiliate') == 1):  ?>
      <li class="treeview <?php echo $uval ?> <?php if(isset($page) && $page == "Affiliate"){echo "active";} ?>">
        <a href="#"><span><i class="fa fa-share-alt pl-0 pr-0 mr-0"></i></span>
          <span><?php echo trans('affiliate') ?></span>
          <span class="pull-right-container">
            <i class="fa fa-angle-right pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
            <li class="<?php if(isset($page_title) && $page_title == "Home"){echo "active";} ?>"><a href="<?php echo base_url('admin/referral/user') ?>"><i class='bx bx-right-arrow-alt' ></i><?php echo trans('home') ?></a></li>

            <li class="<?php if(isset($page_title) && $page_title == "Referral"){echo "active";} ?>"><a href="<?php echo base_url('admin/referral/my_referrals') ?>"><i class='bx bx-right-arrow-alt' ></i><?php echo trans('my-referrals') ?></a></li>

            <li class="<?php if(isset($page_title) && $page_title == "Payouts"){echo "active";} ?>"><a href="<?php echo base_url('admin/referral/payouts ') ?>"><i class='bx bx-right-arrow-alt' ></i><?php echo trans('payouts') ?></a></li>
        </ul>
      </li>
    <?php endif; ?>
  <?php endif; ?>


  <?php if (check_feature_access('online-consultation') == TRUE): ?>
    <?php if(check_staff_permissions('consultation') == 1):  ?>
      <li class="<?php if(isset($page_title) && $page_title == "Consultations"){echo "active";} ?>">
        <a href="<?php echo base_url('admin/live_consults') ?>">
         <i class='bx bxs-videos' ></i> <span> <?php echo trans('consultations') ?> </span>
        </a>
      </li>
    <?php endif ?>
  <?php endif ?>

  <?php if(check_staff_permissions('prescription-settings') == 1):  ?>
    <?php include'left_sideber_settings.php'; ?>
  <?php endif; ?>
  
  <?php if(check_staff_permissions('patients') == 1):  ?>
    <?php if (check_feature_access('patients') == TRUE): ?>
      <li class="<?php if(isset($page_title) && $page_title == "Patients"){echo "active";} ?>">
        <a href="<?php echo base_url('admin/patients') ?>">
          <i class='bx bx-user-plus' ></i> <span><?php echo trans('patients') ?></span>
        </a>
      </li>
    <?php endif; ?>
  <?php endif; ?>

  <?php if(check_staff_permissions('appointments') == 1):  ?>
    <?php if (check_feature_access('appointments') == TRUE): ?>
      <li class="treeview <?php if(isset($page) && $page == "Appointment"){echo "active";} ?>">
        <a href="#"><i class='bx bx-calendar' ></i>
          <span><?php echo trans('appointments') ?></span>
          <span class="pull-right-container">
            <i class="fa fa-angle-right pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li class="<?php if(isset($page_title) && $page_title == "Appointments"){echo "active";} ?>"><a href="<?php echo base_url('admin/appointment') ?>"><i class='bx bx-right-arrow-alt' ></i><?php echo trans('create-new') ?></a></li>
          
          <li class="<?php if(isset($page_title) && $page_title == "Appointments list"){echo "active";} ?>"><a href="<?php echo base_url('admin/appointment/all_list') ?>"><i class='bx bx-right-arrow-alt' ></i><?php echo trans('list-by-date') ?></a></li>
          
        </ul>
      </li> 
    <?php endif; ?>
  <?php endif; ?>
  
  <?php if(check_staff_permissions('drugs') == 1):  ?>
    <li class="treeview <?php if(isset($page_title) && $page_title == "Drugs"){echo "active";} ?>">
      <a href="#"><i class='bx bx-capsule' ></i>
        <span><?php echo trans('drugs') ?></span>
        <span class="pull-right-container">
          <i class="fa fa-angle-right pull-right"></i>
        </span>
      </a>
      <ul class="treeview-menu">
        <li class="<?php if(isset($page_title) && $page_title == "Drugs"){echo "active";} ?>"><a href="<?php echo base_url('admin/drugs') ?>"><i class='bx bx-right-arrow-alt' ></i><?php echo trans('drugs') ?></a></li>

        <li class="<?php if(isset($page_title) && $page_title == "Import"){echo "active";} ?>"><a href="<?php echo base_url('admin/file/import/drugs') ?>"><i class='bx bx-right-arrow-alt' ></i><?php echo trans('bulk-import-drugs') ?></a></li>
      </ul>
    </li>
  <?php endif; ?>


  <?php if (check_staff_permissions('blogs') == 1): ?>
    <li class="treeview <?php if(isset($page_title) && $page_title == "Blog " || isset($page) && $page == "Blog"){echo "active";} ?>">
      <a href="#"><i class='bx bx-book-content' ></i>
        <span class="adminm"><?php echo trans('blogs') ?></span>
        <span class="pull-right-container">
          <i class="fa fa-angle-right pull-right"></i>
        </span>
      </a>
      <ul class="treeview-menu">
        <li><a href="<?php echo base_url('admin/blog_category') ?>"><i class='bx bx-right-arrow-alt' ></i><?php echo trans('add-category') ?> </a></li>
        <li><a href="<?php echo base_url('admin/blog') ?>"><i class='bx bx-right-arrow-alt' ></i><?php echo trans('blog-posts') ?></a></li>
      </ul>
    </li>
  <?php endif; ?>


  <?php if (check_staff_permissions('services') == 1): ?>
    <li class="treeview <?php if(isset($page_title) && $page_title == "Service" || isset($page) && $page == "Service"){echo "active";} ?>">
      <a href="#"><i class='bx bx-book-content' ></i>
        <span class="adminm"><?php echo trans('services') ?></span>
        <span class="pull-right-container">
          <i class="fa fa-angle-right pull-right"></i>
        </span>
      </a>
      <ul class="treeview-menu">
        <li class="<?php if(isset($page_title) && $page_title == "Invoice Service"){echo "active";} ?>"><a href="<?php echo base_url('admin/ServicesView') ?>"><i class='bx bx-right-arrow-alt' ></i><?php echo trans('invoice-services') ?></a></li>
      </ul>
    </li>
  <?php endif; ?>
  <?php if (check_staff_permissions('invoice_view') == 1): ?>
        <li class="<?php if(isset($page_title) && $page_title == "Invoices"){echo "active";} ?>">
            <a href="<?php echo base_url('admin/InvoicePage'); ?>">
                <i class='bx bx-briefcase-alt'></i> <span class="adminm"><?php echo trans('invoice') ?></span>
            </a>
        </li>
  <?php endif; ?>


  <?php if(check_staff_permissions('doctor-profile') == 1):  ?>
    <?php if (check_feature_access('profile-page') == TRUE): ?>
      <li class="treeview <?php if(isset($page_title) && $page_title == "Profile" || isset($page_title) && $page_title == "Educations" || isset($page_title) && $page_title == "Experience"){echo "active";} ?>">
        <a href="#"><i class='bx bx-user-circle' ></i>
          <span><?php echo trans('profile') ?></span>
          <span class="pull-right-container">
            <i class="fa fa-angle-right pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li><a href="<?php echo base_url('admin/profile') ?>"><i class='bx bx-right-arrow-alt' ></i> <?php echo trans('personal-info') ?> </a></li>
          <li><a href="<?php echo base_url('admin/educations') ?>"><i class='bx bx-right-arrow-alt' ></i><?php echo trans('manage-education') ?></a></li>
          <li><a href="<?php echo base_url('admin/experiences') ?>"><i class='bx bx-right-arrow-alt' ></i><?php echo trans('manage-experiences') ?></a></li>
        </ul>
      </li> 
    <?php endif; ?>
  <?php endif; ?>


  <?php if(check_staff_permissions('prescription') == 1):  ?>
    <?php if (check_feature_access('prescription') == TRUE): ?>
      <li class="treeview <?php if(isset($page_title) && $page_title == "Prescription"){echo "active";} ?>">
        <a href="#"><i class='bx bx-file' ></i>
          <span><?php echo trans('prescription') ?></span>
          <span class="pull-right-container">
            <i class="fa fa-angle-right pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <?php if (check_feature_access('prescription') == TRUE): ?>
            <li><a href="<?php echo base_url('admin/prescription') ?>"><i class='bx bx-right-arrow-alt' ></i><?php echo trans('create-new') ?> </a></li>
          <?php endif; ?>

          <li><a href="<?php echo base_url('admin/prescription/all_prescription') ?>"><i class='bx bx-right-arrow-alt' ></i><?php echo trans('prescriptions') ?></a></li>
        </ul>
      </li> 
    <?php endif; ?>
  <?php endif; ?>

  <?php if(check_staff_permissions('ratings-review') == 1):  ?>
    <li class="<?php if(isset($page_title) && $page_title == "Ratings"){echo "active";} ?>">
      <a href="<?php echo base_url('admin/dashboard/rating') ?>">
        <i class='bx bx-star'></i> <span><?php echo trans('rating-reviews') ?></span>
      </a>
    </li>
  <?php endif; ?>
<?php endif ?>