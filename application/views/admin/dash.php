<div class="content-wrapper">

  <section class="content container">

    <!-- user dashboard area -->
    <?php if (isset($page_title) && $page_title == 'User Dashboard'): ?>
      <div class="row">
          <!-- Column -->
          <div class="col-lg-3 col-md-4" data-aos="fade-down" data-aos-duration="200">
              <a href="<?php echo base_url('admin/appointment/list/'.date('Y-m-d')) ?>">
                  <div class="card shadow-lg">
                      <div class="card-body bg-default">
                          <div class="d-flex flex-row">
                              <div class="round align-self-center bg-primary-soft"><i class="ficons flaticon-appointment"></i></div>
                              <div class="m-l-10 align-self-center mt-10">
                                  <h5 class="text-dark"><?php echo trans('todays-appointment') ?> </h5>
                                  <h4 class="m-0 text-dark"><?php echo count_todays_patient(date('Y-m-d')) ?></h4>
                              </div>
                          </div>
                      </div>
                  </div>
              </a>
          </div>
          <!-- Column -->

          <!-- Column -->
          <div class="col-lg-3 col-md-4" data-aos="fade-down" data-aos-duration="240">
              <a href="<?php echo base_url('admin/appointment/all_list') ?>">
                <div class="card shadow-lg">
                    <div class="card-body bg-default">
                        <div class="d-flex flex-row">
                            <div class="round align-self-center bg-success-soft"><i class="ficons flaticon-register"></i></div>
                            <div class="m-l-10 align-self-center mt-10">
                                <h5 class="text-dark"><?php echo trans('appointments') ?></h5>
                                <h4 class="m-0 text-dark"><?php echo html_escape($serials); ?></h4>
                            </div>
                        </div>
                    </div>
                </div>
              </a>
          </div>
          <!-- Column -->

          <!-- Column -->
          <div class="col-lg-3 col-md-4" data-aos="fade-down" data-aos-duration="280">
              <a href="<?php echo base_url('admin/staff') ?>">
                  <div class="card shadow-lg">
                      <div class="card-body bg-default">
                          <div class="d-flex flex-row">
                              <div class="round align-self-center bg-danger-soft"><i class="ficons flaticon-employee"></i></div>
                              <div class="m-l-10 align-self-center mt-10">
                                  <h5 class="text-dark"><?php echo trans('staffs') ?></h5>
                                  <h4 class="m-0 text-dark"><?php echo html_escape($staffs); ?></h4>
                              </div>
                          </div>
                      </div>
                  </div>
              </a>
          </div>
          <!-- Column -->

          <!-- Column -->
          <div class="col-lg-3 col-md-4" data-aos="fade-down" data-aos-duration="320">
              <a href="<?php echo base_url('admin/patients') ?>">
                  <div class="card shadow-lg">
                      <div class="card-body bg-default">
                          <div class="d-flex flex-row">
                              <div class="round align-self-center bg-warning-soft"><i class="ficons flaticon-group-2"></i></div>
                              <div class="m-l-10 align-self-center mt-10">
                                  <h5 class="text-dark"><?php echo trans('patients') ?></h5>
                                  <h4 class="m-0 text-dark"><?php echo html_escape($patients); ?></h4>
                              </div>
                          </div>
                      </div>
                  </div>
              </a>
          </div>
          <!-- Column -->
      </div>
  
      <div class="row p-0 mt-20">
        
        <?php //if (is_user() && check_feature_access('online-consultation') == TRUE): ?>
        <div class="col-md-6">
            <div class="box shadow-lg b-0" data-aos="fade-down" data-aos-duration="350">
                <div class="box-header-light with-border">
                    <h3 class="box-title"><?php echo trans('last-12-months-income') ?></h3>
                </div>
                <div class="box-body">
                    <div id="userIncomeChart" style="width:100%; height:280px;"></div>
                </div>
            </div>

            <div class="box b-0 shadow-lg" data-aos="fade-down" data-aos-duration="500">
                <div class="box-header-light with-border">
                    <h3 class="box-title"><?php echo trans('net-income') ?></h3>
                </div>
                <div class="box-body">
                    <div class="table-responsive">
                      <table class="table table-hover">
                        <thead>
                          <tr>
                            <th><?php echo trans('fiscal-year') ?> <i class="fa fa-info-circle" data-toggle="tooltip" data-title="<?php echo trans('fiscal-year-title') ?>"></i></th>
                            <?php foreach ($net_income as $netincome): ?>
                              <th><?php echo show_year($netincome->created_at) ?></th>
                            <?php endforeach ?>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td><?php echo trans('income') ?></td>
                            <?php foreach ($net_income as $netincome): ?>
                              <td><?php echo currency_symbol(user()->currency); ?><?php echo html_escape(round($netincome->total)) ?></td>
                            <?php endforeach ?>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6">
          <div class="box" data-aos="fade-down" data-aos-duration="350">
            <div class="box-header with-border">
                <h3 class="box-title"><?php echo trans('appointments-list-by-date') ?></h3>
            </div>

            <div class="box-body p-0">
              <table class="table table-hover">
                  <thead>
                      <tr>
                          <th><?php echo trans('date') ?></th>
                          <th><?php echo trans('patients') ?></th>
                          <th><?php echo trans('action') ?></th>
                      </tr>
                  </thead>
                  <tbody>
                    <?php $i=1; foreach ($appointments as $amp): ?>
                      <tr id="row_<?php echo html_escape($amp->id); ?>">
                          <td><span class="badge badge-pill badge-primary-soft"><i class="flaticon-calendar mr-1"></i> <?php echo my_date_show($amp->date); ?></span></td>
                          <td>
                            <span class="badge badge-pill badge-secondary-soft cus fs-15"><i class="bx bx-group"></i> <b><?php echo html_escape($amp->total_patients); ?></b></span>
                          </td>
                          <td class="actions">
                              <a href="<?php echo base_url('admin/appointment/list/'.$amp->date);?>" class="btn btn-light-secondary btn-sm" data-toggle="tooltip" data-placement="top" title=""> <?php echo trans('see-list') ?> <i class='fa fa-long-arrow-right' ></i></a>
                          </td>
                      </tr>
                      
                    <?php $i++; endforeach; ?>
                  </tbody>
              </table>

            </div>

          </div>
        </div>
        

      </div>
    <?php endif; ?>


    <!-- patient dashboard area -->
    <?php if (isset($page_title) && $page_title == 'Patient Dashboard'): ?>
      <div class="row p-0 mt-20">
        <div class="col-md-12">
          <div class="box add_area" data-aos="fade-down" data-aos-duration="400">
            <div class="box-header with-border">
                <h3 class="box-title"><i class="fa fa-clock-o"></i> <?php echo trans('upcoming-appointments') ?> </h3>
            </div>

            <div class="box-bodys p-10">

              <?php if (empty($appointments)): ?>
                  <div class="mt-4 mb-4 text-center">
                    <h4><img src="<?php echo base_url('assets/images/not-found.png') ?>"></h4>
                    <h5><?php echo trans('no-data-found') ?></h5>
                  </div>
              <?php else: ?>

              <table class="table table-hover">
                  <thead>
                      <tr>
                          <th><?php echo trans('serial-no') ?></th>
                          <th><?php echo trans('mr.-no') ?></th>
                          <th><?php echo trans('doctor-info') ?></th>
                          <th><?php echo trans('schedule-info') ?></th>
                          <th><?php echo trans('consultation-type') ?></th>
                      </tr>
                  </thead>
                  <tbody>
                    <?php $i=1; foreach ($appointments as $amp): ?>
                      <tr id="row_<?php echo html_escape($amp->id); ?>">
                          <td><?php echo html_escape($amp->serial_id); ?></td>
                          <td><label class="badge badge-pill badge-secondary-soft"># <?php echo html_escape($amp->mr_number); ?></label></td>
                          <td>
                            <b>
                              <?php echo html_escape($amp->dr_name); ?><br>
                              <?php echo html_escape($amp->chamber); ?><br>
                              <?php echo html_escape($amp->chamber_address); ?>
                            </b>
                          </td>
                          <td>
                            <label class="badge badge-secondary-soft brd-20"><i class="fa fa-calendar"></i> <?php echo my_date_show($amp->date); ?></label><br>
                            <label class="badge badge-secondary-soft brd-20"><i class="fa fa-clock-o"></i> <?php echo $amp->time; ?></label>
                          </td>
                          <td>
                            <?php if ($amp->type == 'online'): ?>
                              <label class="badge badge-danger-soft brd-20"><i class="fa fa-circle"></i> <?php echo trans('online') ?> </label>
                            <?php else: ?>
                              <label class="badge badge-secondary-soft brd-20"><i class="fa fa-circle"></i> <?php echo trans('offline-chamber') ?></label>
                            <?php endif ?>
                          </td>
                      </tr>
                    <?php $i++; endforeach; ?>
                  </tbody>
              </table>
              <?php endif; ?>
            </div>

          </div>
        </div>
      </div>
    <?php endif; ?>


    <!-- admin dashboard area -->
    <?php if (isset($page_title) && $page_title == 'Dashboard'): ?>


    <div class="row">
        <!-- Column -->
        <div class="col-lg-3 col-md-4" data-aos="fade-down" data-aos-duration="200">
            <a href="<?php echo base_url('admin/users') ?>">
                <div class="card shadow-lg">
                    <div class="card-body bg-default">
                        <div class="d-flex flex-row">
                            <div class="round align-self-center bg-primary-soft"><i class="icon-people"></i></div>
                            <div class="m-l-10 align-self-center mt-10">
                                <h5 class="text-dark"><?php echo trans('users') ?> </h5>
                                <h4 class="m-0 text-dark"><?php echo html_escape($user); ?></h4>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <!-- Column -->

        <!-- Column -->
        <div class="col-lg-3 col-md-4" data-aos="fade-down" data-aos-duration="230">
            <a href="javascript:;">
              <div class="card shadow-lg">
                  <div class="card-body bg-default">
                      <div class="d-flex flex-row">
                          <div class="round align-self-center bg-success-soft"><i class="icon-user-following"></i></div>
                          <div class="m-l-10 align-self-center mt-10">
                              <h5 class="text-dark"><?php echo trans('verified') ?></h5>
                              <h4 class="m-0 text-dark"><?php echo count_users_by_status('verified') ?></h4>
                          </div>
                      </div>
                  </div>
              </div>
            </a>
        </div>
        <!-- Column -->

        <!-- Column -->
        <div class="col-lg-3 col-md-4" data-aos="fade-down" data-aos-duration="260">
            <a href="javascript:;">
                <div class="card shadow-lg">
                    <div class="card-body bg-default">
                        <div class="d-flex flex-row">
                            <div class="round align-self-center bg-warning-soft"><i class="icon-user"></i></div>
                            <div class="m-l-10 align-self-center mt-10">
                                <h5 class="text-dark"><?php echo trans('pending') ?></h5>
                                <h4 class="m-0 text-dark"><?php echo count_users_by_status('pending') ?></h4>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <!-- Column -->

        <!-- Column -->
        <div class="col-lg-3 col-md-4" data-aos="fade-down" data-aos-duration="280">
            <a href="javascript:;">
                <div class="card shadow-lg">
                    <div class="card-body bg-default">
                        <div class="d-flex flex-row">
                            <div class="round align-self-center bg-danger-soft"><i class="icon-user-unfollow"></i></div>
                            <div class="m-l-10 align-self-center mt-10">
                                <h5 class="text-dark"><?php echo trans('expired') ?></h5>
                                <h4 class="m-0 text-dark"><?php echo count_users_by_status('expire') ?></h4>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <!-- Column -->
    </div>


    <div class="row mt-2">
      <div class="col-md-7">
          <div class="box shadow-lg b-0" data-aos="fade-down" data-aos-duration="350">
              <div class="box-header-light with-border">
                  <h3 class="box-title"><?php echo trans('last-12-months-income') ?></h3>
              </div>
              <div class="box-body">
                  <div id="adminIncomeChart" style="width:100%; height:280px;"></div>
              </div>
          </div>
      </div>

      <div class="col-md-5">
          <div class="box shadow-lg b-0" data-aos="fade-down" data-aos-duration="400">
              <div class="box-header-light with-border">
                  <h3 class="box-title"><?php echo trans('plans-by-user') ?></h3>
              </div>
              <div class="box-body">
                  <div id="packagePie" style="min-width: 210px; height: 280px; max-width: 600px; margin: 0 auto"></div>
              </div>
          </div>
      </div>
    </div>

    <div class="row mt-4">
      
      <div class="col-md-7">
        <div class="box b-0 shadow-lg" data-aos="fade-down" data-aos-duration="500">
            <div class="box-header-light with-border">
                <h3 class="box-title"><?php echo trans('recently-joined-users') ?></h3>
            </div>
            <div class="box-body p-0">
              <div class="media-list media-list-hover media-list-divided">
              
              <?php foreach ($users as $user): ?>
                <div class="media">
                  <span class="avatar avatar-sm bg-info"><i class="icon-user"></i></span>
                  <div class="media-body">
                  <p>
                    <a class="hover-primary" href="#"><strong><?php echo html_escape($user->name) ?></strong></a>
                    <time class="float-right" datetime="<?php echo my_date_show($user->created_at) ?>"><?php echo get_time_ago($user->created_at) ?></time>
                  </p>
                  <p><?php echo html_escape($user->email); ?></p>
                  <p>
                      <?php if ($user->payment_status == 'verified'): ?>
                          <label class="badge-sm badge-success-soft brd-20"><i class="fa fa-check-circle"></i> <?php echo trans('verified') ?></label>
                      <?php elseif ($user->payment_status == 'pending'): ?>
                          <label class="badge-sm badge-danger-soft brd-20"><i class="icon-user-unfollow"></i> <?php echo trans('pending') ?></label>
                      <?php endif ?>

                      <label class="badge-sm badge-primary-soft brd-20"><i class="fa fa-box"></i> <?php echo trans(strtolower($user->package)); ?></label>
                  </p>
                  </div>
                </div>
              <?php endforeach ?>
                <div class="text-center bt-1 border-light">
                  <a class="btn btn-light-default btn-block" href="<?php echo base_url('admin/users') ?>"><?php echo trans('see-all-users') ?> <i class="fa fa-long-arrow-right"></i></a>
                </div>
              </div>
            </div>
        </div>
      </div>

      <div class="col-md-5">
        <div class="box b-0 shadow-lg" data-aos="fade-down" data-aos-duration="600">
            <div class="box-header-light with-border">
                <h3 class="box-title"><?php echo trans('net-income') ?></h3>
            </div>
            <div class="box-body">
                <div class="table-responsive">
                  <table class="table table-hover">
                    <thead>
                      <tr>
                        <th><?php echo trans('fiscal-year') ?> <i class="fa fa-info-circle" data-toggle="tooltip" data-title="<?php echo trans('fiscal-year-title') ?>"></i></th>
                        <?php foreach ($net_income as $netincome): ?>
                          <th><?php echo show_year($netincome->created_at) ?></th>
                        <?php endforeach ?>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>Income</td>
                        <?php foreach ($net_income as $netincome): ?>
                          <td>$<?php echo html_escape(round($netincome->total)) ?></td>
                        <?php endforeach ?>
                      </tr>
                    </tbody>
                  </table>
                </div>
            </div>
        </div>
      </div>

    </div>

    <?php endif ?>

    

  </section>

</div>