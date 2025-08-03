<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

?>
<div class="content-wrapper">
  <!-- Main content -->
  <section class="content">

  <div class="row">
    <!-- experience area -->
    <div class="col-md-4">
      <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title"><?php echo trans('add-appointment') ?></h3>
        </div>

        <div class="box-body">
          <form id="cat-form" method="post" enctype="multipart/form-data" class="validate-form" action="<?php echo base_url('admin/appointment/add')?>" role="form" novalidate>

            <div class="form-group plr-10">
              <label><?php echo trans('date') ?></label>
              <div class="input-group mb-3">
                <input type="text" class="form-control" id="datepicker" name="date"  value="" autocomplete="off">
                <div class="input-group-append">
                  <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                </div>
              </div>
            </div>

            <div class="form-group">
              <div class="col-md-12 p-0 text-left" id="load_data">
              </div>
            </div>

            <div class="form-group plr-10">
              <label><?php echo trans('appointment-type') ?></label>
              <div class="radio radio-info radio-inline mt-10">
                <input type="radio" id="inlineRadio3" value="online" name="type">
                <label for="inlineRadio3"> <?php echo trans('online') ?></label>&emsp;

                <input type="radio" id="inlineRadio4" checked value="offline" name="type">
                <label for="inlineRadio4"> <?php echo trans('offline') ?></label> 
              </div>
            </div>

            <div class="form-group plr-10">
              <div class="radio radio-info radio-inline mt-10">
                <input type="radio" id="inlineRadio2" checked value="2" class="patient_type" name="patient_type">
                <label for="inlineRadio2"> <?php echo trans('old-patient') ?></label>&emsp;

                <input type="radio" id="inlineRadio1" value="1" class="patient_type" name="patient_type">
                <label for="inlineRadio1"> <?php echo trans('new-patient') ?></label> 
              </div>
            </div>

            <div class="old_patient_area plr-10">
              <div class="form-group">
                <label><?php echo trans('patient') ?> <span class="text-danger">*</span></label>
                  <select name="patient_id" id="patients" class="form-control select2">
                    <option value=""><?php echo trans('select') ?> </option>
                    <?php foreach ($patientses as $patient): ?>
                    <option  value="<?php echo html_escape($patient->id); ?>"><?= '<b>'.$patient->name.'</b> - '.$patient->mr_number.' - '.$patient->mobile;?></option>
                  <?php endforeach ?>
                </select>
              </div>
            </div>

            <div class="new_patient_area plr-10 hide">
              <div class="form-group">
                <label><?php echo trans('name') ?> <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="name">
              </div>

              <div class="form-group">
                <label><?php echo trans('email') ?> <span class="text-danger">*</span></label>
                <input type="email" class="form-control" name="email">
              </div>

              <div class="form-group">
                <label><?php echo trans('phone') ?> <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="mobile">
              </div>

              <div class="form-group">
                <label><?php echo trans('age') ?> </label>
                <input type="text" class="form-control" name="age">
              </div>

              <div class="form-group">
                <label><?php echo trans('weight') ?></label>
                <input type="text" class="form-control" name="weight">
              </div>

              <div class="form-group">
                <label><?php echo trans('gender') ?> <span class="text-danger"></span></label>
                <div class="radio radio-info radio-inline mt-10">
                  <input type="radio" id="inlineRadio11" checked value="1" name="sex">
                  <label for="inlineRadio11"> <?php echo trans('male') ?> </label>
                  <input type="radio" id="inlineRadio22" value="2" name="sex">
                  <label for="inlineRadio22"> <?php echo trans('female') ?> </label>
                </div>
              </div>
            </div>

            <!-- csrf token -->
            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
            
            <button type="submit" class="btn btn-primary btn-lg ml-0 mt-10"><i class="fa fa-check"></i> <?php echo trans('add-serial') ?></button>
          </form>
        </div>

      </div>
    </div>


    <!-- experience area -->
    <div class="col-md-8">
      <div class="box add_area">
        <div class="box-header with-border">
            <h3 class="box-title"><?php echo trans('appointments') ?> </h3>

            <div class="box-tools pull-right">
              <a href="<?php echo base_url('admin/appointment/all_list') ?>" class="btn btn-light-primary btn-sm pull-right mt-15"><i class="flaticon-calendar mr-1"></i> <?php echo trans('list-by-date') ?> </a>
            </div>
        </div>

        <div class="box-body table-responsive">
        
          <table class="table table-bordered <?php if(isset($appointments) && count($appointments) >= 2){echo "datatable";} ?>">
              <thead>
                  <tr>
                      <th>#</th>
                      <th><?php echo trans('serial-no') ?></th>
                      <th><?php echo trans('patient-info') ?></th>
                      <th><?php echo trans('schedule-info') ?></th>
                      <th><?php echo trans('consultation-type') ?></th>
                      <th><?php echo trans('action') ?></th>
                  </tr>
              </thead>
              <tbody>
                <?php $i=1; foreach ($appointments as $amp): ?>
                  <tr id="row_<?php echo html_escape($amp->id); ?>">
                      
                      <td><?= $i; ?></td>
                      <td><?php echo html_escape($amp->serial_id); ?></td>
                      <td>
                        <p class="mb-0"><?php echo html_escape($amp->name); ?> (<?php echo html_escape($amp->mr_number); ?>)</p>
                        <p class="mb-0"><?php echo html_escape($amp->mobile); ?></p>
                        <p><?php echo html_escape($amp->email); ?></p>
                      </td>

                      <td>
                        <label class="badge badge-primary-soft brd-20"><i class="fa fa-calendar"></i> <?php echo my_date_show($amp->date); ?></label><br>
                        <label class="badge badge-primary-soft brd-20"><i class="fa fa-clock-o"></i> <?php echo $amp->time; ?></label>
                      </td>

                      <td>
                        <?php if ($amp->type == 'online'): ?>
                          <label class="badge badge-danger-soft brd-20"><i class="fa fa-circle"></i> <?php echo trans('online') ?> </label>
                        <?php else: ?>
                          <label class="badge badge-secondary-soft brd-20"><i class="fa fa-circle"></i> <?php echo trans('offline') ?></label>
                        <?php endif ?>
                      </td>
                   

                      <td class="actions" width="15%">
                        <a data-val="experience" data-id="<?php echo html_escape($amp->id); ?>" href="<?php echo base_url('admin/appointment/delete/'.html_escape($amp->id));?>" class="on-default remove-row delete_item" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash-o"></i></a>
                      </td>
                  </tr>
                  
                <?php $i++; endforeach; ?>
              </tbody>
          </table>

        </div>

      </div>
    </div>

  </div>

  </section>
</div>
