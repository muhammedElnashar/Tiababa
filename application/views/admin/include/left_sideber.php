 <aside class="main-sidebar">
  <section class="sidebar mt-10">
    <ul class="sidebar-menu" data-widget="tree">
      <!-- admin sections -->
      <?php if(get_user_info() == TRUE){$uval = 'd-block';}else{$uval = 'd-none';} ?>
      <?php if (is_admin()): ?>
        <li class="<?php if(isset($page_title) && $page_title == "Dashboard"){echo "active";} ?>">
          <a href="<?php echo base_url('admin/dashboard') ?>">
            <i class='bx bxs-dashboard'></i> <span class="adminm"><?php echo trans('dashboard') ?></span>
          </a>
        </li>

        <li class="<?php if(isset($page_title) && $page_title == "Settings"){echo "active";} ?>">
          <a href="<?php echo base_url('admin/settings') ?>">
            <i class='bx bx-cog' ></i> <span class="adminm"><?php echo trans('settings') ?></span>
          </a>
        </li>

        <li class="treeview <?php if(isset($page_title) && $page_title == "Payment Settings " || isset($page) && $page == "Payment"){echo "active";} ?>">
          <a href="#"><i class='bx bx-dollar-circle' ></i>
            <span class="adminm"><?php echo trans('payment-settings') ?></span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="<?= $uval; ?>"><a href="<?php echo base_url('admin/payment/settings/online') ?>"><i class='bx bx-right-arrow-alt' ></i><?php echo trans('online') ?> <?php echo trans('payments') ?></a></li>

            <li><a href="<?php echo base_url('admin/payment/settings/offline') ?>"><i class='bx bx-right-arrow-alt' ></i><?php echo trans('offline') ?> <?php echo trans('payments') ?></a></li>
          </ul>
        </li>


        <li class="treeview <?= $uval; ?> <?php if(isset($page_title) && $page_title == "Payouts" || isset($page) && $page == "Payouts"){echo "active";} ?>">
          <a href="#"><i class='bx bx-wallet' ></i>
            <span class="adminm"><?php echo trans('payouts') ?></span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">

            <li class="<?php if(isset($page_title) && $page_title == "Payout Settings"){echo "active";} ?>"><a href="<?php echo base_url('admin/payouts/settings') ?>"><i class='bx bx-right-arrow-alt' ></i><?php echo trans('payout-settings') ?></a></li>

            <li class="<?php if(isset($page_title) && $page_title == "Add Payout"){echo "active";} ?>"><a href="<?php echo base_url('admin/payouts/add') ?>"><i class='bx bx-right-arrow-alt' ></i><?php echo trans('add-payouts') ?> </a></li>

            <li class="<?php if(isset($page_title) && $page_title == "Payout Requests"){echo "active";} ?>"><a href="<?php echo base_url('admin/payouts/requests') ?>"><i class='bx bx-right-arrow-alt' ></i><?php echo trans('payout-requests') ?></a></li>

            <li class="<?php if(isset($page_title) && $page_title == "Payout Completed"){echo "active";} ?>"><a href="<?php echo base_url('admin/payouts/completed') ?>"><i class='bx bx-right-arrow-alt' ></i><?php echo trans('completed') ?></a></li>
          </ul>
        </li>



        <li class="treeview <?= $uval; ?> <?php if(isset($page_title) && $page_title == "Affiliate" || isset($page) && $page == "Affiliate"){echo "active";} ?>">
          <a href="#"> <span><i class='fa fa-share pl-0'></i></span>
            <span class="adminm"><?php echo trans('affiliate') ?></span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">

            <li class="<?php if(isset($page_title) && $page_title == "Referral_Settings"){echo "active";} ?>"><a href="<?php echo base_url('admin/referral/settings') ?>"><i class='bx bx-right-arrow-alt' ></i><?php echo trans('referral-settings') ?></a></li>

            <li class="<?php if(isset($page_title) && $page_title == "Payout Request"){echo "active";} ?>"><a  href="<?php echo base_url('admin/referral/payout_request') ?>"><i class='bx bx-right-arrow-alt' ></i><?php echo trans('payout-requests') ?></a></li>

            <li class="<?php if(isset($page_title) && $page_title == "Completed Payout"){echo "active";} ?>"><a  href="<?php echo base_url('admin/referral/completed_payout') ?>"><i class='bx bx-right-arrow-alt' ></i><?php echo trans('completed') ?></a></li>
          </ul>
        </li>


        <li class="treeview <?php if(isset($page_title) && $page_title == "Domain" || isset($page) && $page == "Domain"){echo "active";} ?>">
          <a href="#"><i class='bx bx-world' ></i>
            <span class="adminm"><?php  echo trans('custom-domain') ?></span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="<?php if(isset($page_title) && $page_title == "Request"){echo "active";} ?>"><a href="<?php echo base_url('admin/domain/request') ?>"><i class='bx bx-right-arrow-alt' ></i><?php  echo trans('request') ?></a></li>
            <li><a class="<?php if(isset($page_title) && $page_title == "Settings"){echo "active";} ?>" href="<?php echo base_url('admin/domain/settings') ?>"><i class='bx bx-right-arrow-alt' ></i><?php  echo trans('settings') ?></a></li>
          </ul>
        </li>


        <li class="<?php if(isset($page_title) && $page_title == "Appearance"){echo "active";} ?>">
          <a href="<?php echo base_url('admin/settings/appearance') ?>">
           <i class='bx bx-brush' ></i> <span class="adminm"><?php echo trans('appearance') ?></span>
          </a>
        </li>

        <li class="<?php if(isset($page_title) && $page_title == "Language"){echo "active";} ?>">
          <a href="<?php echo base_url('admin/language') ?>">
            <i class='bx bx-world' ></i> <span class="adminm"><?php echo trans('language') ?></span>
          </a>
        </li>

        <li class="<?php if(isset($page_title) && $page_title == "Package"){echo "active";} ?>">
          <a href="<?php echo base_url('admin/package') ?>">
            <i class='bx bx-package' ></i> <span class="adminm"><?php echo trans('plans') ?></span>
          </a>
        </li>

        <li class="<?php if(isset($page_title) && $page_title == "Transactions"){echo "active";} ?>">
          <a href="<?php echo base_url('admin/payment/transactions') ?>">
            <i class='bx bx-money-withdraw' ></i> <span class="adminm"><?php echo trans('transactions') ?></span>
          </a>
        </li>

        <li class="<?php if(isset($page_title) && $page_title == "Department"){echo "active";} ?>">
          <a href="<?php echo base_url('admin/department') ?>">
            <i class='bx bx-buildings'></i> <span class="adminm"><?php echo trans('departments') ?></span>
          </a>
        </li>

        <li class="<?php if(isset($page_title) && $page_title == "Users"){echo "active";} ?>">
          <a href="<?php echo base_url('admin/users') ?>">
            <i class='bx bx-group' ></i> <span class="adminm"><?php echo trans('users') ?></span>
          </a>
        </li>

        <li class="treeview <?php if(isset($page_title) && $page_title == "Drugs"){echo "active";} ?>">
            <a href="#"><i class='bx bx-capsule' ></i>
              <span><?php echo trans('drugs') ?></span>
              <span class="pull-right-container">
                <i class="fa fa-angle-right pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li class="<?php if(isset($page_title) && $page_title == "Drugs"){echo "active";} ?>"><a href="<?php echo base_url('admin/drugs') ?>"><i class='bx bx-right-arrow-alt' ></i><?php echo trans('drugs') ?></a></li>

              <li class="<?php if(isset($page_title) && $page_title == "Import"){echo "active";} ?>"><a href="<?php echo base_url('admin/file/import/drugs') ?>"><i class='bx bx-right-arrow-alt' ></i>Bulk Import Drugs</a></li>
            </ul>
          </li>

        <li class="treeview <?php if(isset($page_title) && $page_title == "Blog " || isset($page) && $page == "Blog"){echo "active";} ?>">
          <a href="#"><i class='bx bx-book-content' ></i>
            <span class="adminm"><?php echo trans('blog') ?></span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo base_url('admin/blog_category') ?>"><i class='bx bx-right-arrow-alt' ></i><?php echo trans('add-category') ?> </a></li>
            <li><a href="<?php echo base_url('admin/blog') ?>"><i class='bx bx-right-arrow-alt' ></i><?php echo trans('blog-posts') ?></a></li>
          </ul>
        </li>

        <li class="<?php if(isset($page_title) && $page_title == "Workflow"){echo "active";} ?>">
          <a href="<?php echo base_url('admin/workflow') ?>">
            <i class='bx bx-layer'></i> <span class="adminm"><?php echo trans('workflow') ?></span>
          </a>
        </li>

        <li class="<?php if(isset($page_title) && $page_title == "Service"){echo "active";} ?>">
          <a href="<?php echo base_url('admin/services') ?>">
            <i class='bx bx-briefcase'></i> <span class="adminm"><?php echo trans('services') ?></span>
          </a>
        </li>
          <li class="<?php if(isset($page_title) && $page_title == "Invoice Service"){echo "active";} ?>">
              <a href="<?php echo base_url('admin/ServicesView'); ?>">
                  <i class='bx bxs-server'></i> <span class="adminm"><?php echo trans('invoice-services') ?></span>
              </a>
          </li>
        <li class="<?php if(isset($page_title) && $page_title == "Invoices"){echo "active";} ?>">
          <a href="<?php echo base_url('admin/InvoicePage'); ?>">
            <i class='bx bx-briefcase-alt'></i> <span class="adminm"><?php echo trans('invoice') ?></span>
          </a>
        </li>

        <li class="<?php if(isset($page_title) && $page_title == "Pages"){echo "active";} ?>">
          <a href="<?php echo base_url('admin/pages') ?>">
            <i class='bx bx-windows' ></i> <span class="adminm"><?php echo trans('pages') ?></span>
          </a>
        </li>

        <li class="<?php if(isset($page_title) && $page_title == "Faqs"){echo "active";} ?>">
          <a href="<?php echo base_url('admin/faq') ?>">
            <i class='bx bx-help-circle'></i> <span class="adminm"><?php echo trans('faqs') ?></span>
          </a>
        </li>

        <li class="<?php if(isset($page_title) && $page_title == "Contact"){echo "active";} ?>">
          <a href="<?php echo base_url('admin/contact') ?>">
            <i class='bx bx-envelope' ></i> <span class="adminm"><?php echo trans('contact') ?></span>
          </a>
        </li>
          <li class="<?php if(isset($page_title) && $page_title == "Default Value"){echo "active";} ?>">
              <a href="<?php echo base_url('admin/DefaultValuesController') ?>">
                  <i class='bx bx-vertical-center' ></i> <span><?php echo trans('default-value') ?></span>
              </a>
          </li>

      <?php endif; ?>


      <!-- user sections -->
      <?php if (is_user()): ?>

        <li class="<?php if(isset($page_title) && $page_title == "User Dashboard"){echo "active";} ?>">
          <a href="<?php echo base_url('admin/dashboard/user') ?>">
            <i class='bx bxs-dashboard'></i> <span><?php echo trans('dashboard') ?></span>
          </a>
        </li>

        <li class="<?php if(isset($page_title) && $page_title == "Subscription"){echo "active";} ?>">
          <a href="<?php echo base_url('admin/subscription') ?>">
            <i class='bx bx-time-five'></i> <span><?php echo trans('subscription') ?></span>
          </a>
        </li>

        <li class="treeview <?php if(isset($upage) && $upage == "User Settings"){echo "active";} ?>">
          <a href="#"><i class='bx bx-cog'></i>
            <span><?php echo trans('settings') ?></span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>

          <ul class="treeview-menu">
            <li class="<?php if(isset($page_title) && $page_title == "Department"){echo "active";} ?>">
              <a href="<?php echo base_url('admin/department') ?>">
                <i class='bx bx-home' ></i> <span><?php echo trans('departments') ?></span>
              </a>
            </li>

            <li class="<?php if(isset($page_title) && $page_title == "Appointment Schedule"){echo "active";} ?>">
              <a href="<?php echo base_url('admin/appointment/assign') ?>"><i class='bx bx-time' ></i> <?php echo trans('set-schedule') ?>
              </a>
            </li>

            <?php if (check_feature_access('online-consultation') == TRUE): ?>
              <?php if (settings()->enable_wallet == 0): ?>
                <li class="<?php if(isset($page_title) && $page_title == "Payment Settings"){echo "active";} ?> <?= $uval; ?>">
                  <a href="<?php echo base_url('admin/payment/user') ?>">
                    <i class='bx bx-dollar-circle' ></i> <span><?php echo trans('payment-settings') ?></span>
                  </a>
                </li>
              <?php endif ?>

              <li class="<?php if(isset($page_title) && $page_title == "Consultation Settings"){echo "active";} ?>">
                <a href="<?php echo base_url('admin/live_consults/settings') ?>">
                  <i class='bx bxs-cog' ></i> <span><?php echo trans('consultation-settings') ?></span>
                </a>
              </li>
            <?php endif; ?>

            <li class="<?php if(isset($page_title) && $page_title == "QR Settings"){echo "active";} ?>">
              <a class="" href="<?php echo base_url('admin/profile/qr_code') ?>">
                <i class='bx bx-qr' ></i> <span><?php echo trans('qr-code') ?></span>
              </a>
            </li>

            <li class="<?php if(isset($page_title) && $page_title == "Twilio Settings"){echo "active";} ?>">
              <a class="" href="<?php echo base_url('admin/profile/twilio_settings') ?>">
                <i class='bx bx-comment' ></i> <span><?php echo trans('twilio-sms-settings') ?></span>
              </a>
            </li>

            <li class="<?php if(isset($page_title) && $page_title == "Whatsapp Settings"){echo "active";} ?>">
              <a class="" href="<?php echo base_url('admin/profile/whatsapp') ?>">
                <i class="fa fa-whatsapp pr-0"></i> <span><?php echo trans('whatsapp-settings') ?></span>
              </a>
            </li>

          </ul>
        </li>

        <!-- Check payment status -->
        <?php if (check_my_payment_status() == TRUE): ?>

          <li class="<?php if(isset($page_title) && $page_title == "Payment list"){echo "active";} ?> <?= $uval; ?>">
            <a href="<?php echo base_url('admin/payment/lists') ?>">
              <i class='bx bx-credit-card' ></i> <span><?php echo trans('transactions') ?></span>
            </a>
          </li>

          <?php if (check_feature_access('patients') == TRUE): ?>
            <li class="<?php if(isset($page_title) && $page_title == "Domain"){echo "active";} ?>">
              <a href="<?php echo base_url('admin/domain') ?>">
                <i class='bx bx-globe'></i> <span><?php echo  trans('custom-domain') ?></span>
              </a>
            </li>
          <?php endif; ?>

          <?php if (settings()->enable_wallet == 1): ?>
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

          <?php if (affiliate_settings()->is_enable == 1): ?>
            <li class="treeview <?php echo $uval ?> <?php if(isset($page) && $page == "Affiliate"){echo "active";} ?>">
              <a href="#"><span><i class="fa fa-share pl-0 pr-0 mr-0"></i></span>
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

          <?php if (check_feature_access('online-consultation') == TRUE): ?>

          <li class="<?php if(isset($page_title) && $page_title == "Consultations"){echo "active";} ?>">
            <a href="<?php echo base_url('admin/live_consults') ?>">
             <i class='bx bxs-videos' ></i> <span> <?php echo trans('consultations') ?> </span>
            </a>
          </li>
          <?php endif ?>

          <?php if (check_feature_access('staffs') == TRUE): ?>
            <li class="<?php if(isset($page_title) && $page_title == "Staff"){echo "active";} ?>">
              <a href="<?php echo base_url('admin/staff') ?>">
                <i class='bx bxs-group' ></i> <span><?php echo trans('staff') ?></span>
              </a>
            </li>
          <?php endif ?>


          <?php include'left_sideber_settings.php'; ?>

          <?php if (check_my_payment_status() == TRUE): ?>

          <?php if (check_feature_access('patients') == TRUE): ?>
            <li class="<?php if(isset($page_title) && $page_title == "Patients"){echo "active";} ?>">
              <a href="<?php echo base_url('admin/patients') ?>">
                <i class='bx bx-user-plus' ></i> <span><?php echo trans('patients') ?></span>
              </a>
            </li>
          <?php endif; ?>



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


          <li class="treeview <?php if(isset($page_title) && $page_title == "Drugs"){echo "active";} ?>">
            <a href="#"><i class='bx bx-capsule' ></i>
              <span><?php echo trans('drugs') ?></span>
              <span class="pull-right-container">
                <i class="fa fa-angle-right pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li class="<?php if(isset($page_title) && $page_title == "Drugs"){echo "active";} ?>"><a href="<?php echo base_url('admin/drugs') ?>"><i class='bx bx-right-arrow-alt' ></i><?php echo trans('drugs') ?></a></li>

              <li class="<?php if(isset($page_title) && $page_title == "Import"){echo "active";} ?>"><a href="<?php echo base_url('admin/file/import/drugs') ?>"><i class='bx bx-right-arrow-alt' ></i>Bulk Import Drugs</a></li>
            </ul>
          </li>


          <?php if (check_feature_access('blogs') == TRUE): ?>
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


          <?php if (check_feature_access('services') == TRUE): ?>
            <li class="treeview <?php if(isset($page_title) && $page_title == "Service " || isset($page) && $page == "Service"){echo "active";} ?>">
              <a href="#"><i class='bx bx-book-content' ></i>
                <span class="adminm"><?php echo trans('services') ?></span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-right pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li class="<?php if(isset($page_title) && $page_title == "Service Category"){echo "active";} ?>"><a href="<?php echo base_url('admin/services/category') ?>"><i class='bx bx-right-arrow-alt' ></i><?php echo trans('add-category') ?> </a></li>
                <li class="<?php if(isset($page_title) && $page_title == "User Service"){echo "active";} ?>"><a href="<?php echo base_url('admin/services/user') ?>"><i class='bx bx-right-arrow-alt' ></i><?php echo trans('services') ?></a></li>
              </ul>
            </li>

                      <li class="<?php if(isset($page_title) && $page_title == "Invoice Service"){echo "active";} ?>">
                          <a href="<?php echo base_url('admin/ServicesView'); ?>">
                              <i class='bx bxs-server'></i> <span class="adminm"><?php echo trans('invoice-services') ?></span>
                          </a>
                      </li>
                      <li class="<?php if(isset($page_title) && $page_title == "Invoices"){echo "active";} ?>">
                          <a href="<?php echo base_url('admin/InvoicePage'); ?>">
                              <i class='bx bx-briefcase-alt'></i> <span class="adminm"><?php echo trans('invoice') ?></span>
                          </a>
                      </li>

          <?php endif; ?>



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

        <?php endif ?>


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

          <li class="<?php if(isset($page_title) && $page_title == "Ratings"){echo "active";} ?>">
            <a href="<?php echo base_url('admin/dashboard/rating') ?>">
              <i class='bx bx-star'></i> <span><?php echo trans('rating-reviews') ?></span>
            </a>
          </li>

          <li class="<?php if(isset($page_title) && $page_title == "Contact"){echo "active";} ?>">
            <a href="<?php echo base_url('admin/contact/user') ?>">
              <i class='bx bx-envelope' ></i> <span class="adminm"><?php echo trans('contact') ?></span>
            </a>
          </li>



        <?php endif; ?>
        <!-- end check payment status -->
          <li class="<?php if(isset($page_title) && $page_title == "Default Value"){echo "active";} ?>">
              <a href="<?php echo base_url('admin/DefaultValuesController') ?>">
                  <i class='bx bx-vertical-center' ></i> <span><?php echo trans('default-value') ?></span>
              </a>
          </li>
      <?php endif; ?>
      <!-- end user sections -->








      <?php if (is_staff()): ?>
        <?php include 'staff_left_sidebar.php'; ?>
      <?php endif ?>





    <!-- patient sections -->
    <?php if (is_patient()): ?>
      <li class="<?php if(isset($page_title) && $page_title == "Patient Dashboard"){echo "active";} ?>">
        <a href="<?php echo base_url('admin/dashboard/patient') ?>">
          <i class="flaticon-dashboard-2"></i> <span><?php echo trans('dashboard') ?></span>
        </a>
      </li>

      <li class="<?php if(isset($page_title) && $page_title == "Doctors"){echo "active";} ?>">
        <a href="<?php echo base_url('admin/patients/doctors') ?>"><i class="flaticon-user"></i> <?php echo trans('rating-reviews') ?></a>
      </li>

      <li class="<?php if(isset($page_title) && $page_title == "Appointments"){echo "active";} ?>">
        <a href="<?php echo base_url('admin/patients/appointments') ?>"><i class="flaticon-calendar"></i> <?php echo trans('appointments') ?></a>
      </li>

      <li class="<?php if(isset($page_title) && $page_title == "Prescription"){echo "active";} ?>">
        <a href="<?php echo base_url('admin/patients/prescriptions') ?>"><i class="flaticon-prescription-1"></i> <?php echo trans('prescriptions') ?></a>
      </li>
    <?php endif; ?>
    <!-- end patient sections -->

    <li class="<?php if(isset($page_title) && $page_title == "Change Password"){echo "active";} ?>">
      <a href="<?php echo base_url('change_password') ?>">
        <i class='bx bx-lock-open' ></i> <span><?php echo trans('change-password') ?></span>
      </a>
    </li>

    <li class="">
      <a href="<?php echo base_url('auth/logout') ?>">
        <i class='bx bx-log-out' ></i> <span><?php echo trans('logout') ?></span>
      </a>
    </li>

  </ul>
</section>
</aside>