
<div class="content-wrapper">
  <!-- Main content -->
  <section class="content container">
    <div class="row">
      
      <div class="col-md-4">
          <div class="box">
            <div class="box-body">
              <form method="post" class="validate-form" action="<?php echo base_url('admin/appointment/set_interval')?>" role="form" enctype="multipart/form-data">
                
                  <div class="form-group">
                      <label><?php echo trans('set-interval') ?></label>
                    <div class="input-group mb-3">
                      <input type="number" class="form-control" name="intervals" value="<?php echo $user->intervals ?>">
                      <div class="input-group-append">
                        <span class="input-group-text" id="basic-addon2"><?php echo trans('minutes') ?></span>
                      </div>
                    </div>
                  </div>

                  <!-- csrf token -->
                  <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
                  <button type="submit" class="btn btn-dark"><?php echo trans('update') ?></button>
                
              </form>
            </div>
          </div>
      </div>


      <div class="col-md-8">
        <div class="box">
          <div class="box-header with-border">
              <h3 class="box-title"><?php echo trans('set-appointments-schedule') ?></h3>
          </div>

          <?php $days = get_days();?>

          <div class="box-body">
            <form method="post" class="validate-form" action="<?php echo base_url('admin/appointment/set')?>" role="form" enctype="multipart/form-data">
              
            <div class="row main_item">
              <?php $i=1; foreach ($days as $day): ?>
                
                <?php $checks=0; ?>
                <?php foreach ($my_days as $asnday): ?>
                  <?php if ($asnday['day'] == $i) {
                    $check = 'checked';
                    $checks = $asnday['day'];
                    break;
                  } else {
                    $check = '';
                    $checks = 0;
                  }
                  ?>
                <?php endforeach ?>

                <div class="item-rows w-100 mb-20">
                  
                  <div class="form-group col-md-12 mb-0">
                      <div class="custom-control custom-switch ml-5 pt-10">
                          <input type="checkbox" value="<?= $i; ?>" name="day_<?= $i-1; ?>" class="custom-control-input day_option" id="switch-<?= $i;?>" <?php if(!empty($check)){echo html_escape($check);} ?>>
                          <label class="custom-control-label" for="switch-<?= $i;?>"><?php echo trans($day) ?></label>
                      </div>
                  </div>

                  <?php 
                    if ($this->session->userdata('role') == 'user') {
                        $user_id = $this->session->userdata('id');
                    } else {
                        $user_id = $this->session->userdata('parent');
                    }
                  ?>

                  <?php foreach (get_time_by_days($i, $user_id) as $time): ?>
                  <div class="hour-item col-md-12 hideable_<?= $i; ?>" id="row_<?= $time->id ?>">
                      <div class="row">
                          <div class="col-sm-5 pr-0 mb-2">
                                <div class="input-group">
                                  <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="icon-clock"></i></span>
                                  </div>
                                  <input type="text" class="form-control timepicker" name="start_time_<?= $i-1; ?>[]" value="<?php echo html_escape($time->start); ?>" placeholder="<?php echo trans('start-time') ?>" autocomplete="off">
                                </div>
                          </div>

                          <div class="col-sm-5 mb-2">
                              <div class="input-group">
                                  <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="icon-clock"></i></span>
                                  </div>
                                  <input type="text" class="form-control timepicker" name="end_time_<?= $i-1; ?>[]" value="<?php echo html_escape($time->end); ?>" placeholder="<?php echo trans('end-time') ?>" autocomplete="off">
                              </div>
                          </div>

                          <div class="col-sm-2 mb-2"><a data-id="<?= $time->id ?>" href="<?php echo base_url('admin/appointment/delete_time/'.$time->id) ?>" class="del_time_row delete_item text-danger"><i class="icon-trash"></i></a></div>
                      </div>
                  </div>
                  <?php endforeach ?>

                  <div class="houritem_<?= $i-1; ?> col-md-12"></div>

                  <div class="form-group col-sm-12 mt-2 hideable_<?= $i; ?>" style="display: <?php if($check == 'checked'){echo 'block';}else{echo "none";} ?>;">
                    <a href="#" data-id="<?= $i-1; ?>" class="add_time_row"><i class="fa fa-plus-circle"></i> Add new time</a>
                  </div>

                  <div class="day_highliter"></div>
                  <div class="day_divider"></div>
                </div>
             
              <?php $i++; endforeach ?>

            </div>



              <!-- csrf token -->
              <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
              
              <button type="submit" class="btn btn-light-primary btn-lg btn-block pull-right"><i class="ficon flaticon-check"></i> <?php echo trans('update') ?></button>
            </form>
          </div>

        </div>
      </div>
    </div>
  </section>
</div>
