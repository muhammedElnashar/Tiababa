<div class="content-wrapper">
  <!-- Main content -->
  <section class="content container w-1500">
    <div class="loader"></div>
    <div class="row patient_form_section">
      <!-- experience area -->
      <div class="col-md-12">

       
        <form  method="post" enctype="multipart/form-data" id="prescription_form" class="validate-form" action="<?php echo base_url('admin/prescription/preview')?>" role="form" novalidate>

           <h3><?php echo trans('edit-prescription') ?> <button type="submit" class="btn btn-primary btn-lg preview_btn pull-right mb-10"> <i class="fa fa-eye"></i> <?php echo trans('preview') ?></button> </h3>


          <div class="box add_area">
            <div class="box-body">
              
              <div class="prescription_headers">
                <div class="row">
                  <div class="col-md-6 text-left pre_header">
                    <h3><?php echo html_escape(user()->name) ?></h3>
                    <p><?php echo html_escape(user()->specialist) ?></p>
                    <p><?= user()->degree ?></p>
                    <p><?php echo html_escape(user()->email) ?></p>
                  </div>
                  <div class="col-md-6 text-right">
                    <?php if (!empty($this->chamber->logo)): ?>
                      <img class="chamber-img" src="<?php echo base_url($this->chamber->logo) ?>">
                    <?php endif ?>
                    <h4 class="mb-0"><?php echo html_escape($this->chamber->name) ?></h4>
                    <p class="mb-0"><?php echo html_escape($this->chamber->title) ?></p>
                    <p class="mb-0"><?php echo html_escape($this->chamber->address) ?></p>
                  </div>
                </div>
              </div>
                
              <div class="row mih-800">
                <div class="col-sm-3">
                  <div class="group">
                    <h5><?php echo trans('clinical-diagnosis') ?></h5>
                     <select name="diagonosis[]" class="form-control select2"  multiple="multiple" id="">
                      <?php $i=1; foreach ($diagonosises as $diagonosis): ?>
                          <?php $selected = ''; ?>
                          <?php foreach ($pre_diagonosis as $pre_diag): ?>
                              <?php if ($diagonosis->id == $pre_diag['diagonosis_id']): ?>
                                <?php $selected = 'selected'; break;?>
                              <?php else: ?>
                                <?php $selected = ''; ?>
                              <?php endif ?>
                          <?php endforeach ?>
                          
                          <option <?= $selected; ?> value="<?= $diagonosis->id?>"><?= $diagonosis->name?></option>
                      <?php $i++; endforeach ?>
                    </select>
                  </div>

                  <div class="group">
                    <h5><?php echo trans('additional-advices') ?></h5>
                    <select name="ad_advices[]" class="form-control select2"  multiple="multiple" id="">
                      <?php $j=1; foreach ($additional_adviseses as $ad): ?>
                          <?php $selected = ''; ?>
                          <?php foreach ($pre_ad_advices as $pre_adv): ?>
                              <?php if ($ad->id == $pre_adv['ad_advices_id']): ?>
                                <?php $selected = 'selected'; break;?>
                              <?php else: ?>
                                <?php $selected = ''; ?>
                              <?php endif ?>
                          <?php endforeach ?>

                       <option <?= $selected; ?> value="<?= $ad->id?>"><?= $ad->name?></option>
                      <?php $j++; endforeach ?>
                    </select>
                  </div>

                  <div class="group">
                    <h5><?php echo trans('advice') ?></h5>
                    <select name="advice[]" class="form-control select2"  multiple="multiple" id="">
                        <?php $k=1; foreach ($adviseses as $advice): ?>
                          <?php $selected = ''; ?>
                          <?php foreach ($pre_advice as $pre_ad): ?>
                              <?php if ($advice->id == $pre_ad['advice_id']): ?>
                                <?php $selected = 'selected'; break;?>
                              <?php else: ?>
                                <?php $selected = ''; ?>
                              <?php endif ?>
                          <?php endforeach ?>

                          <option <?= $selected; ?> value="<?= $advice->id?>"><?= $advice->name?></option>
                        <?php $k++; endforeach ?>
                    </select>
                  </div>

                  <div class="group">
                    <h5><?php echo trans('diagnosis-tests') ?></h5>
                    <select name="investigation[]" class="form-control select2"  multiple="multiple" id="">
                        <?php $k=1; foreach ($advise_investigations as $advice): ?>
                          <?php $selected = ''; ?>
                          <?php foreach ($pre_investigation as $pre_inv): ?>
                              <?php if ($advice->id == $pre_inv['investigation_id']): ?>
                                <?php $selected = 'selected'; break; ?>
                              <?php else: ?>
                                <?php $selected = ''; ?>
                              <?php endif ?>
                          <?php endforeach ?>

                          <option <?= $selected; ?> value="<?= $advice->id?>"><?= $advice->name?></option>
                        <?php $k++; endforeach ?>
                    </select>
                  </div>

                  <div class="group">
                    <h5>Next Visit Date</h5>
                    <div class="d_flex">
                      <?php $duration_string = explode(' ',trim($prescription['next_visit'])); ?>

                      <select name="next_duration" class="form-control">
                        <option value=""></option>
                        <?php foreach (get_dates() as $dates): ?>
                          <option <?php if(isset($duration_string[0]) && $duration_string[0] == $dates){echo "selected";} ?> value="<?= $dates; ?>"><?= $dates; ?> </option>
                        <?php endforeach ?>
                      </select>

                      <select name="next_time" class="form-control" id="">
                          <option value="">Select time </option>
                          <option <?php if(isset($duration_string[1]) && $duration_string[1] == 'Days'){echo "selected";} ?> value="Days">Days </option>
                          <option <?php if(isset($duration_string[1]) && $duration_string[1] == 'Months'){echo "selected";} ?> value="Months">Months</option>
                          <option <?php if(isset($duration_string[1]) && $duration_string[1] == 'Years'){echo "selected";} ?> value="Years">Years </option>
                      </select>
                    </div>
                  </div>

                  <div class="group">
                    <h5><?php echo trans('notes') ?></h5>
                    <textarea class="form-control" name="notes" rows="2"><?php echo html_escape($prescription['notes']) ?></textarea>
                  </div>

                </div>


                <div class="col-sm-9">
                    <div class="row m-t-20">
                        <div class="form-group col-sm-6 pateint_name">
                          <?php include'pateint_list.php'; ?>
                        </div>

                        <div class="form-group col-sm-4">
                          <label for=""></label>
                          <div class="d_flex_space">
                            <a href="#pateintModal" data-toggle="modal" class="add_patient btn btn-light-secondary mr-20"><i class="fa fa-user-plus"></i> Add New Patient</a>
                            <a href="#drugModal" data-toggle="modal" class="add_patient btn btn-light-secondary"><i class="fa fa-plus"></i> Add New Drug</a>     
                          </div>
                          
                        </div>
                    </div>

                    <?php $p=0; foreach ($pre_items as $item): ?>
                      
                      <div id="group_<?= $p ?>">

                        <div class="row m-t-10">
                          <div class="form-group col-sm-12 ajax_drug">
                              <!-- load durgs by ajax -->
                              <?php include 'ajax_drug.php'; ?>
                          </div>
                        </div>
                        
                        <?php $t=0; foreach ($item['prescription_items'] as $pvalue): ?>
                          
                          <?php $time_string = explode('+',trim($pvalue['time_periods'])); ?>

                          <div class="row" id="row_<?= $t.$p ?>"> 
                            <div class="form-group col-sm-4">
                                <div class="d_flex_input">
                                  
                                  <select name="time_periods<?= $p ?>[]" class="form-control" id="">
                                    <option value=""></option>
                                    <option <?php if($time_string[0] == '0'){echo "selected";} ?> value="0">0 </option>
                                    <option <?php if($time_string[0] == '½'){echo "selected";} ?> value="½">½ </option>
                                    <option <?php if($time_string[0] == '1'){echo "selected";} ?> value="1">1 </option>
                                    <option <?php if($time_string[0] == '2'){echo "selected";} ?> value="2">2 </option>
                                    <option <?php if($time_string[0] == '3'){echo "selected";} ?> value="3">3</option>
                                    <option <?php if($time_string[0] == '4'){echo "selected";} ?> value="4">4 </option>
                                    <option <?php if($time_string[0] == '0.5 ml'){echo "selected";} ?> value="0.5 ml">0.5 ml </option>
                                    <option <?php if($time_string[0] == '1 ml'){echo "selected";} ?> value="1 ml">1 ml </option>
                                    <option <?php if($time_string[0] == '2 ml'){echo "selected";} ?> value="2 ml">2 ml </option>
                                    <option <?php if($time_string[0] == '3 ml'){echo "selected";} ?> value="3 ml">3 ml </option>
                                    <option <?php if($time_string[0] == '4 ml'){echo "selected";} ?> value="4 ml">4 ml </option>
                                    <option <?php if($time_string[0] == '5 ml'){echo "selected";} ?> value="5 ml">5 ml </option>
                                  </select>

                                  <select name="time_periods<?= $p ?>[]" class="form-control" id="">
                                    <option value=""></option>
                                    <option <?php if($time_string[1] == '0'){echo "selected";} ?> value="0">0 </option>
                                    <option <?php if($time_string[1] == '½'){echo "selected";} ?> value="½">½ </option>
                                    <option <?php if($time_string[1] == '1'){echo "selected";} ?> value="1">1 </option>
                                    <option <?php if($time_string[1] == '2'){echo "selected";} ?> value="2">2 </option>
                                    <option <?php if($time_string[1] == '3'){echo "selected";} ?> value="3">3</option>
                                    <option <?php if($time_string[1] == '4'){echo "selected";} ?> value="4">4 </option>
                                    <option <?php if($time_string[1] == '0.5 ml'){echo "selected";} ?> value="0.5 ml">0.5 ml </option>
                                    <option <?php if($time_string[1] == '1 ml'){echo "selected";} ?> value="1 ml">1 ml </option>
                                    <option <?php if($time_string[1] == '2 ml'){echo "selected";} ?> value="2 ml">2 ml </option>
                                    <option <?php if($time_string[1] == '3 ml'){echo "selected";} ?> value="3 ml">3 ml </option>
                                    <option <?php if($time_string[1] == '4 ml'){echo "selected";} ?> value="4 ml">4 ml </option>
                                    <option <?php if($time_string[1] == '5 ml'){echo "selected";} ?> value="5 ml">5 ml </option>
                                  </select>

                                  <select name="time_periods<?= $p ?>[]" class="form-control" id="">
                                    <option value=""></option>
                                    <option <?php if($time_string[2] == '0'){echo "selected";} ?> value="0">0 </option>
                                    <option <?php if($time_string[2] == '½'){echo "selected";} ?> value="½">½ </option>
                                    <option <?php if($time_string[2] == '1'){echo "selected";} ?> value="1">1 </option>
                                    <option <?php if($time_string[2] == '2'){echo "selected";} ?> value="2">2 </option>
                                    <option <?php if($time_string[2] == '3'){echo "selected";} ?> value="3">3</option>
                                    <option <?php if($time_string[2] == '4'){echo "selected";} ?> value="4">4 </option>
                                    <option <?php if($time_string[2] == '0.5 ml'){echo "selected";} ?> value="0.5 ml">0.5 ml </option>
                                    <option <?php if($time_string[2] == '1 ml'){echo "selected";} ?> value="1 ml">1 ml </option>
                                    <option <?php if($time_string[2] == '2 ml'){echo "selected";} ?> value="2 ml">2 ml </option>
                                    <option <?php if($time_string[2] == '3 ml'){echo "selected";} ?> value="3 ml">3 ml </option>
                                    <option <?php if($time_string[2] == '4 ml'){echo "selected";} ?> value="4 ml">4 ml </option>
                                    <option <?php if($time_string[2] == '5 ml'){echo "selected";} ?> value="5 ml">5 ml </option>
                                  </select>

                                  <select name="time_periods<?= $p ?>[]" class="form-control" id="">
                                    <option value=""></option>
                                    <option <?php if($time_string[3] == '0'){echo "selected";} ?> value="0">0 </option>
                                    <option <?php if($time_string[3] == '½'){echo "selected";} ?> value="½">½ </option>
                                    <option <?php if($time_string[3] == '1'){echo "selected";} ?> value="1">1 </option>
                                    <option <?php if($time_string[3] == '2'){echo "selected";} ?> value="2">2 </option>
                                    <option <?php if($time_string[3] == '3'){echo "selected";} ?> value="3">3</option>
                                    <option <?php if($time_string[3] == '4'){echo "selected";} ?> value="4">4 </option>
                                    <option <?php if($time_string[3] == '0.5 ml'){echo "selected";} ?> value="0.5 ml">0.5 ml </option>
                                    <option <?php if($time_string[3] == '1 ml'){echo "selected";} ?> value="1 ml">1 ml </option>
                                    <option <?php if($time_string[3] == '2 ml'){echo "selected";} ?> value="2 ml">2 ml </option>
                                    <option <?php if($time_string[3] == '3 ml'){echo "selected";} ?> value="3 ml">3 ml </option>
                                    <option <?php if($time_string[3] == '4 ml'){echo "selected";} ?> value="4 ml">4 ml </option>
                                    <option <?php if($time_string[3] == '5 ml'){echo "selected";} ?> value="5 ml">5 ml </option>
                                  </select>

                                </div>
                            </div>

                            <div class="form-group col-sm-3">
                              <div class="d_flex">
                      
                                <select name="duration_text<?= $p ?>[]" class="form-control" id="">
                                  <option value=""></option>
                              
                                  <?php foreach (get_dates() as $dates): ?>
                                    <option <?php if($pvalue['duration_text'] == $dates){echo "selected";} ?> value="<?php echo html_escape($dates); ?>"><?= $dates; ?> </option>
                                  <?php endforeach ?>

                                </select>

                                <select name="duration<?= $p ?>[]" class="form-control" id="">
                                  <option value="">Time</option>
                                  <option <?php if($pvalue['duration'] == 'Continue'){echo "selected";} ?> value="Continue">Continue </option>
                                  <option <?php if($pvalue['duration'] == 'Days'){echo "selected";} ?> value="Days">Days </option>
                                  <option <?php if($pvalue['duration'] == 'Months'){echo "selected";} ?> value="Months">Months</option>
                                  <option <?php if($pvalue['duration'] == 'Years'){echo "selected";} ?> value="Years">Years </option>
                                </select>
                              </div>
                            </div>

                            <div class="form-group col-sm-2">
                              <select name="medicine_time<?= $p ?>[]" class="form-control" id="">
                                <option value="">Before/After Meals</option>
                                <option <?php if($pvalue['medicine_time'] == 'After Meal'){echo "selected";} ?> value="After Meal">After Meal </option>
                                <option <?php if($pvalue['medicine_time'] == 'Before Meal'){echo "selected";} ?> value="Before Meal">Before Meal </option>
                              </select>
                            </div>

                            <div class="form-group col-sm-3">
                              <div class="d_flex">
                                <input type="text" name="note<?= $p ?>[]" class="form-control" value="<?php echo html_escape($pvalue['note']) ?>">
                                
                                <?php if ($t==0): ?>
                                  <button type="button" title="Add new row" class="btn btn-primary add_increase_button" data-id="<?= $p ?>"><i class="fa fa-plus"></i></button>
                                <?php else: ?>
                                  <button class="btn btn-light-danger remove_this_row" data-id="<?= $t.$p ?>"><i class="fa fa-close"></i></button>
                                <?php endif ?>

                              </div>
                            </div>
                          </div><!-- row -->

                        <?php $t++; endforeach ?>
                        
                        <div class="drug_details_increase_field_<?= $p ?>"></div>

                      </div>

                    <?php $p++; endforeach ?>


                    
                    
                    <div class="input_fields_wrap"></div>


                    <input type="hidden" name="id" value="0">
                    <input type="hidden" name="total_item" class="total_item" value="<?php echo count($pre_items) ?>">

                    <div id="load_hide_id">
                      
                    </div>

                    <?php if ($type == 1): ?>
                    <input type="hidden" name="prescription_id" value="<?php echo html_escape($prescription['id']) ?>">
                    <?php else: ?>
                    <input type="hidden" name="prescription_id" value="0">
                    <?php endif ?>

                    <?php if ($type == 2): ?>
                      <input type="hidden" name="follow_up" value="1">
                    <?php else: ?>
                      <input type="hidden" name="follow_up" value="0">
                    <?php endif ?>

                    <!-- csrf token -->
                    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">

                </div>
              </div><!-- row -->
              
              <div class="prescription_headerss">
                <!-- <img src="<?php echo base_url() ?>/assets/admin/img/footer.jpg"> -->
              </div>
            </div>
          </div>

        </form>

      </div>
    </div>
  
    <div class="prescription_preview"></div>
    
  </section>
</div>





  <!-- Modal -->
  <div id="pateintModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"><?php echo trans('add-patient') ?></h4>
        </div>
          <form id="pateint_form" method="post" enctype="multipart/form-data" class="validate-form" action="<?php echo base_url('admin/patientses/add_pateint')?>" role="form" novalidate>
            <div class="modal-body">
              
              <div class="form-group">
                <label><?php echo trans('name') ?> <span class="text-danger">*</span></label>
                <input type="text" class="form-control" required name="name">
              </div>

              <div class="form-group">
                <label><?php echo trans('email') ?> <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="email" required value="">
              </div>

              <div class="form-group">
                <label><?php echo trans('phone') ?> <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="mobile" required value="">
              </div>

              <div class="row p-0">
                <div class="col-md-6">
                  <div class="form-group">
                    <label><?php echo trans('age') ?></label>
                    <input type="text" class="form-control" name="age" >
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label><?php echo trans('weight') ?></label>
                    <input type="text" class="form-control" name="weight" >
                  </div>
                </div>
              </div>

              <!-- csrf token -->
              <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo trans('close') ?></button>
            <button type="submit" class="btn btn-primary pull-left mr-5"><i class="fa fa-check"></i> <?php echo trans('add-patient') ?></button>
          </div>
        </form>
      </div>

    </div>
  </div>



   <!-- Modal -->
  <div id="drugModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"><?php echo trans('add-new-drug') ?></h4>
        </div>
          <form id="drug_form" method="post" enctype="multipart/form-data" class="validate-form" action="<?php echo base_url('admin/prescription/add_drug')?>" role="form" novalidate>
            <div class="modal-body">
              
              <div class="form-group">
                <label><?php echo trans('name') ?> <span class="text-danger">*</span></label>
                <input type="text" class="form-control" required name="name">
              </div>

              <!-- csrf token -->
              <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-light-danger mt-10" data-dismiss="modal"><?php echo trans('close') ?></button>
            <button type="submit" class="btn btn-primary pull-left mr-5"><i class="fa fa-check"></i> <?php echo trans('add-drug') ?></button>
          </div>
        </form>
      </div>

    </div>
  </div>