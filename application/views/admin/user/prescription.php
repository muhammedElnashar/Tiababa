<div class="content-wrapper">
  <!-- Main content -->
  <section class="content container w-1500">

    <div class="loader"></div>

  	<div class="row patient_form_section">
  		<!-- experience area -->
  		<div class="col-md-12">

        <form  method="post" enctype="multipart/form-data" id="prescription_form" class="validate-form" action="<?php echo base_url('admin/prescription/preview')?>" role="form" novalidate>

          <h3><?php echo trans('create-new-prescription') ?> <button type="submit" class="btn btn-primary preview_btn mb-10 pull-right"> <i class="icon-eye"></i> <?php echo trans('preview') ?></button> </h3>

    			<div class="box add_area">
    				<div class="box-body">
              
              <div class="prescription_headers">
                <div class="rows flex-between">
                  <div class="col-md-6s text-lefts pre_header">
                    <h3 class="mb-0"><?php echo html_escape(user()->name) ?></h3>
                    <p><?php echo html_escape(user()->email) ?></p>
                    <p><?php echo html_escape(user()->specialist) ?></p>
                    <p><?= user()->degree ?></p>
                    <p><?php echo html_escape(user()->phone) ?></p>
                  </div>
                  <div class="col-md-6s text-rights pl-20">
                    <?php if (!empty($this->chamber->logo)): ?>
                      <img class="chamber-img" src="<?php echo base_url($this->chamber->logo) ?>">
                    <?php endif ?>
                    <h4 class="mb-0"><?php echo html_escape($this->chamber->name) ?></h4>
                    <p class="mb-0"><?php echo html_escape($this->chamber->title) ?></p>
                    <p class="mb-0"><?php echo html_escape($this->chamber->address) ?></p>
                  </div>
                </div>
              </div>
                

  						<div class="row minh-800">
  							<div class="col-sm-3">
  								<div class="group">
  									<h5><?php echo trans('clinical-diagnosis') ?></h5>
                     <select name="diagonosis[]" class="form-control select2"  multiple="multiple" id="">
    									<?php $i=1; foreach ($diagonosises as $diagonosis): ?>
                        <option value="<?= $diagonosis->id?>"><?= html_escape($diagonosis->name)?></option>
    									<?php $i++; endforeach ?>
                    </select>
  								</div>

  								<div class="group">
  									<h5><?php echo trans('additional-advices') ?></h5>
                    <select name="ad_advices[]" class="form-control select2"  multiple="multiple" id="">
    									<?php $j=1; foreach ($additional_adviseses as $ad): ?>
                       <option value="<?= $ad->id?>"><?= html_escape($ad->name)?></option>
    									<?php $j++; endforeach ?>
                    </select>
  								</div>

  								<div class="group">
  									<h5><?php echo trans('advice') ?></h5>
                    <select name="advice[]" class="form-control select2"  multiple="multiple" id="">
      									<?php $k=1; foreach ($adviseses as $advice): ?>
        									<option value="<?= $advice->id?>"><?= html_escape($advice->name)?></option>
      									<?php $k++; endforeach ?>
                    </select>
  								</div>

                  <div class="group">
                    <h5><?php echo trans('diagnosis-tests') ?></h5>
                    <select name="investigation[]" class="form-control select2"  multiple="multiple" id="">
                        <?php $k=1; foreach ($advise_investigations as $advice): ?>
                          <option value="<?= $advice->id?>"><?= html_escape($advice->name)?></option>
                        <?php $k++; endforeach ?>
                    </select>
                  </div>

                  <div class="group">
                    <h5><?php echo trans('next-follow-up') ?></h5>
                    <div class="d_flex">
                      <select name="next_duration" class="form-control">
                        <option value=""><?php echo trans('select-days') ?></option>
                        <?php foreach (get_dates() as $dates): ?>
                          <option value="<?php echo html_escape($dates); ?>"><?php echo html_escape($dates); ?> </option>
                        <?php endforeach ?>
                      </select>
                      <select name="next_time" class="form-control" id="">
                          <option value=""><?php echo trans('select-time') ?> </option>
                          <option value="days"><?php echo trans('days') ?> </option>
                          <option value="months"><?php echo trans('months') ?></option>
                          <option value="years"><?php echo trans('years') ?> </option>
                      </select>
                    </div>
                  </div>


                  <div class="group">
                    <h5><?php echo trans('notes') ?></h5>
                    <textarea class="form-control" name="notes" rows="2"></textarea>
                  </div>

  							</div>
  							<div class="col-sm-9">
                  <div class="row m-t-20">
                    <div class="form-group col-sm-6 pateint_name">
                        <?php include'pateint_list.php'; ?>
                        <p class="patient_error_text error hide">* <?php echo trans('patient-is-required') ?></p>
                      </div>

                      <div class="form-group col-sm-4">
                        <label for=""></label>
                        <div class="flex-between mt-5">
                          <a href="#pateintModal" data-toggle="modal" class="add_patient  btn btn-light-secondary mr-5"><i class="ficon flaticon-medical"></i> <?php echo trans('add-new-patient') ?></a>
                          <a href="#drugModal" data-toggle="modal" class="add_patient btn btn-light-secondary"><i class="icon-plus"></i> <?php echo trans('add-new-drug') ?></a>     
                        </div>
                        
                      </div>
                  </div>
  								<div class="row m-t-10">
  									<div class="form-group col-sm-12 ajax_drug">
    										<!-- load durgs by ajax -->
                        <?php include 'ajax_drug.php'; ?>
                        <p class="drug_error_text error hide">* <?php echo trans('drug-is-required') ?></p>
    								</div>
                    </div>
                    <div class="row"> 
    									<div class="form-group col-sm-4">
                          <div class="d_flex_input">
                            <select name="time_periods0[]" class="form-control" id="">
                              <option value=""></option>
                              <option value="0">0 </option>
                              <option value="½">½ </option>
                              <option value="1">1 </option>
                              <option value="2">2 </option>
                              <option value="3">3</option>
                              <option value="4">4 </option>
                              <option value="0.5 ml">0.5 ml </option>
                              <option value="1 ml">1 ml </option>
                              <option value="2 ml">2 ml </option>
                              <option value="3 ml">3 ml </option>
                              <option value="4 ml">4 ml </option>
                              <option value="5 ml">5 ml </option>
                            </select>

                            <select name="time_periods0[]" class="form-control" id="">
                              <option value=""></option>
                              <option value="0">0 </option>
                              <option value="½">½ </option>
                              <option value="1">1 </option>
                              <option value="2">2 </option>
                              <option value="3">3</option>
                              <option value="4">4 </option>
                              <option value="0.5 ml">0.5 ml </option>
                              <option value="1 ml">1 ml </option>
                              <option value="2 ml">2 ml </option>
                              <option value="3 ml">3 ml </option>
                              <option value="4 ml">4 ml </option>
                              <option value="5 ml">5 ml </option>
                            </select>

                            <select name="time_periods0[]" class="form-control" id="">
                              <option value=""></option>
                              <option value="0">0 </option>
                              <option value="½">½ </option>
                              <option value="1">1 </option>
                              <option value="2">2 </option>
                              <option value="3">3</option>
                              <option value="4">4 </option>
                              <option value="0.5 ml">0.5 ml </option>
                              <option value="1 ml">1 ml </option>
                              <option value="2 ml">2 ml </option>
                              <option value="3 ml">3 ml </option>
                              <option value="4 ml">4 ml </option>
                              <option value="5 ml">5 ml </option>
                            </select>

                            <select name="time_periods0[]" class="form-control" id="">
                              <option value=""></option>
                              <option value="0">0 </option>
                              <option value="½">½ </option>
                              <option value="1">1 </option>
                              <option value="2">2 </option>
                              <option value="3">3</option>
                              <option value="4">4 </option>
                              <option value="0.5 ml">0.5 ml </option>
                              <option value="1 ml">1 ml </option>
                              <option value="2 ml">2 ml </option>
                              <option value="3 ml">3 ml </option>
                              <option value="4 ml">4 ml </option>
                              <option value="5 ml">5 ml </option>
                            </select>

                          </div>
    									</div>

                      <div class="form-group col-sm-3">
                        <div class="d_flex">
                          <select name="duration_text0[]" class="form-control" id="">
                              <option value=""><?php echo trans('select') ?></option>
                              <?php foreach (get_dates() as $dates): ?>
                                <option value="<?php echo html_escape($dates); ?>"><?php echo html_escape($dates); ?> </option>
                              <?php endforeach ?>
                          </select>

                          <select name="duration0[]" class="form-control" id="">
                            <option value=""><?php echo trans('time') ?></option>
                            <option value="Continue"><?php echo trans('continue') ?> </option>
                            <option value="Days"><?php echo trans('days') ?> </option>
                            <option value="Months"><?php echo trans('months') ?></option>
                            <option value="Years"><?php echo trans('years') ?> </option>
                          </select>
                        </div>
                      </div>

    									<div class="form-group col-sm-2">
    										<select name="medicine_time0[]" class="form-control" id="">
                          <option value=""><?php echo trans('beforeafter-meals') ?></option>
                          <option value="After Meal"><?php echo trans('after-meal') ?></option>
    											<option value="Before Meal"><?php echo trans('before-meal') ?> </option>
    										</select>
    									</div>

                      <div class="form-group col-sm-3">
                        <div class="d_flex">
                          <input type="text" name="note0[]" class="form-control" placeholder="Enter Note">
                          <button type="button" title="Add new row" class="btn btn-light-primary add_increase_button" data-id="0"><i class="fa fa-plus"></i></button>
                        </div>
                      </div>
  								</div><!-- row -->
                  <div class="drug_details_increase_field_0"></div>
  								<div class="input_fields_wrap"></div>


                    <input type="hidden" name="appoinment_id" value="<?php echo html_escape($appoinment_id); ?>">


                    <input type="hidden" name="id" value="0">
                    <input type="hidden" name="total_item" class="total_item" value="1">
                    <input type="hidden" name="follow_up" value="0">

                    <!-- csrf token -->
                    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">

  							</div>
  						</div><!-- row -->
    					
              <div class="prescription_headerss">
  
              </div>
    				</div>
    			</div>

          <div class="row m-t-10">
            <div class="col-sm-12 text-right">
              <button type="submit" class="btn btn-primary btn-lg preview_btn"> <i class="icon-eye"></i> <?php echo trans('preview') ?></button>
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
          <form id="pateint_form" method="post" enctype="multipart/form-data" class="validate-form" action="<?php echo base_url('admin/patients/add_pateint')?>" role="form" novalidate>
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

              <div class="form-group">
                <label><?php echo trans('gender') ?> <span class="text-danger"></span></label>
                <div class="radio radio-info radio-inline mt-10">
                  <input type="radio" id="inlineRadio1" checked=""  value="1" name="sex">
                  <label for="inlineRadio1"> <?php echo trans('male') ?> </label>
                  <input type="radio" id="inlineRadio2"  value="2" name="sex">
                  <label for="inlineRadio2"> <?php echo trans('female') ?> </label>
                </div>
              </div>

              <!-- csrf token -->
              <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-light-danger mt-10" data-dismiss="modal"><?php echo trans('close') ?></button>
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