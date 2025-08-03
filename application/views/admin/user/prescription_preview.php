<div class="row patient_section">
	<div class="col-md-9 m-auto">

    <form action="<?php echo base_url('admin/prescription/add')?>" method="post" id="preview">

      <h2 class="mb-10"><?php echo trans('prescription-preview') ?>
        <button type="button" class="prevr-btn btn btn-primary btn-lg prescription_edit pull-right"><i class="fa fa-pencil"></i> Edit</button>
        <button type="submit" class="prevr-btn btn btn-primary btn-lg pull-right mr-15"><i class="fa fa-save"></i> <?php echo trans('save-continue') ?></button>
      </h2>

      <div class="alert alert-info alert-line mb-20 mt-20">
        <i class="icon-info"></i> <?php echo trans('preview-pres-title') ?>
      </div>

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

  				<div class="row">
            <?php if(!empty(session('patient_id'))): ?>
    					<div class="col-sm-12">
    						<div class="top_status">
    							<div class="left_top">
                    <?php $patient = get_name_by_id(session('patient_id'),'patientses');?>
    								<i style="font-weight: bold;"><?php echo trans('name') ?> :</i> <i> <?= isset($patient['name'])?$patient['name']:'';?></i> 
    							</div>
    							<div class="right_top">
    								<ul>
    									<li><i><?php echo trans('age') ?>:</i> <?= html_escape($patient['age']);?> <?php echo trans('years') ?></li>
    									<li><i><?php echo trans('weight') ?>:</i> <?= html_escape($patient['weight']);?> Kg</li>
    									<li><i><?php echo trans('date') ?>:</i><?= my_date_show(session('prescription_date'))?></li>
    								</ul>
    							</div>
    						</div>
    					</div>	
            <?php endif ?>
  				</div>

  				<div class="row prescription_body">
  					<div class="col-sm-4">
  						<div class="left_prescription">
    					<?php if(!empty(session('diagonosis')[0]['diagonosis_id'])): ?>
  							<div class="single_left">
  								<div class="left_p_header">
  									<h4><?php echo trans('clinical-diagnosis') ?></h4>
  								</div>
  								<div class="left_p_details">
  									<ol>
  									<?php foreach (session('diagonosis') as $value): ?>
  										<li><?= get_name_by_id($value['diagonosis_id'],'diagonosis')['name'];?></li>	
                      <p><?= get_name_by_id($value['diagonosis_id'],'diagonosis')['details'];?></p>  
  									<?php endforeach ?>
  									</ol>
  								</div>
  							</div>
  					<?php endif ?>

  					<?php if(!empty(session('ad_advices')[0]['ad_advices_id'])): ?>
  							<div class="single_left">
  								<div class="left_p_header">
  									<h4><?php echo trans('additional-advices') ?></h4>
  								</div>
  								<div class="left_p_details">
  									<ol>
  									<?php foreach (session('ad_advices') as $value): ?>
  										<li><?= get_name_by_id($value['ad_advices_id'],'additional_advises')['name'];?></li>	
                      <p><?= get_name_by_id($value['ad_advices_id'],'additional_advises')['details'];?></p>  
  									<?php endforeach ?>
  									</ol>
  								</div>
  							</div>
  					<?php endif ?>

  					<?php if(!empty(session('advice')[0]['advice_id'])): ?>
  							<div class="single_left">
  								<div class="left_p_header">
  									<h4><?php echo trans('advices') ?></h4>
  								</div>
  								<div class="left_p_details">
  									<ol>
  									<?php foreach (session('advice') as $value): ?>
  										<li><?= get_name_by_id($value['advice_id'],'advises')['name'];?></li>	
                      <p><?= get_name_by_id($value['advice_id'],'advises')['details'];?></p> 
  									<?php endforeach ?>
  									</ol>
  								</div>
  							</div>
  					<?php endif ?>

            <?php if(!empty(session('investigation')[0]['investigation_id'])): ?>
                <div class="single_left">
                  <div class="left_p_header">
                    <h4><?php echo trans('diagnosis-tests') ?></h4>
                  </div>
                  <div class="left_p_details">
                    <ol>
                    <?php foreach (session('investigation') as $value): ?>
                      <li><?= get_name_by_id($value['investigation_id'],'advise_investigations')['name'];?></li> 
                     
                    <?php endforeach ?>
                    </ol>
                  </div>
                </div>
            <?php endif ?>

              <div class="single_left">
                  <?php if (!empty(session('notes'))) {
                    echo session('notes');
                  } ?>
              </div>

  						</div>
  					</div>
  					<div class="col-sm-8">
  						<div class="right_prescription">
  							<div class="rx_header mb-20"><h1>&#8478;.</h1></div>
  							<?php if(!empty(session('drugs'))): ?>
  								<div class="right_single p-l-5" style="padding-left: 20px;">
  									<?php $i=1; foreach (session('drugs') as $key => $value): ?>
                    <div class="left_p_header">
                      <h4 class="drug_name"><?= get_name_by_id($value['drugs_id'],'drugs')['name'];?></h4>
                      <div class="second_value">
                         <?php for($j=0;$j<= count($value['time_periods']);$j++): ?>
                                <p> 
                                  <b><?=  $j==1 && !empty($value['time_periods'][1])?"<span class='then'> Then </span> ":'';?></b>
                                  
                                  <?php if (!empty($value['time_periods'][$j])): ?>
                                    <?php $vale = $value['time_periods'][$j]; ?>
                                    <?php echo rtrim($vale, '+'); ?>
                                  <?php endif ?>
                                  <?= !empty($value['medicine_time'][$j])?"( ".$value['medicine_time'][$j]." )":'';?>
                                  
                                  <span><?= !empty($value['duration_text'][$j])?" --- ".$value['duration_text'][$j]:'   ';?>
                                   <?= !empty($value['duration'][$j])?$value['duration'][$j]:'';?> </span>
                                </p>
                               <p class="note_text"><?= !empty($value['note'][$j])?$value['note'][$j]:''?></p> 
                          <?php endfor ?>
                      </div>

                    </div><!-- left_p_header -->

    								<?php $i++; endforeach ?>
  								</div>
                  <p class="last_visit">
                    <?php if (!empty(session('next_visit'))) {
                      echo session('next_visit');
                    } ?>
                  </p>


  							<?php endif ?>
  						</div>
  					</div>
  				</div><!-- row -->

          <div class="prescription_headers">
          </div>

  			</div>
  		</div>

      <div class="row">
        <!-- csrf token -->
          <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
      </div>

    </form>
	</div>
</div>