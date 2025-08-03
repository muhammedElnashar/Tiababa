
<div class="content-wrapper">

  <!-- Main content -->
  <section class="content container">

    <div class="box add_area <?php if(isset($page_title) && $page_title == "Edit"){echo "d-block";}else{echo "hide";} ?>">
      <div class="box-header with-border">
        <?php if (isset($page_title) && $page_title == "Edit"): ?>
          <h3 class="box-title"><?php echo trans('edit') ?></h3>
          <?php else: ?>
            <h3 class="box-title"><?php echo trans('create-new') ?> </h3>
          <?php endif; ?>

          <div class="box-tools pull-right">
            <?php if (isset($page_title) && $page_title == "Edit"): ?>
              <a href="<?php echo base_url('admin/patients') ?>" class="pull-right btn btn-light-secondary mt-15 btn-sm"><i class="fa fa-angle-left"></i> <?php echo trans('back') ?></a>
              <?php else: ?>
                <a href="#" class="text-right btn btn-light-secondary btn-sm cancel_btn"><i class="fa fa-bars"></i> <?php echo trans('all-patients') ?></a>
              <?php endif; ?>
            </div>
          </div>

          <div class="box-body">
            <form id="cat-form" method="post" enctype="multipart/form-data" class="validate-form" action="<?php echo base_url('admin/patients/add')?>" role="form" novalidate>

              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label><?php echo trans('name') ?> <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" required name="name" value="<?php echo html_escape($patients[0]['name']); ?>" >
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label><?php echo trans('email') ?> <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" required name="email" value="<?php echo html_escape($patients[0]['email']); ?>">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label><?php echo trans('phone') ?> <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" required name="mobile" value="<?php echo html_escape($patients[0]['mobile']); ?>">
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label><?php echo trans('age') ?></label>
                    <input type="text" class="form-control" name="age" value="<?php echo html_escape($patients[0]['age']); ?>" >
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group">
                    <label><?php echo trans('weight') ?> </label>
                    <input type="text" class="form-control" name="weight" value="<?php echo html_escape($patients[0]['weight']); ?>" >
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group">
                    <label><?php echo trans('present-address') ?></label>
                    <textarea class="form-control" name="present_address" rows="6"><?php echo html_escape($patients[0]['present_address']); ?></textarea>
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group">
                    <label><?php echo trans('permanent-address') ?></label>
                    <textarea class="form-control" name="permanent_address" rows="6"><?php echo html_escape($patients[0]['permanent_address']); ?></textarea>
                  </div>
                </div>

                <div class="col-md-12">
                  <div class="form-group">
                    <label><?php echo trans('gender') ?> <span class="text-danger"></span></label>
                    <div class="radio radio-info radio-inline mt-10">
                      <input type="radio" id="inlineRadio1" checked="" <?php if($patients[0]['sex']==2){echo "checked";} ?> value="1" name="sex">
                      <label for="inlineRadio1"> <?php echo trans('male') ?> </label>
                      <input type="radio" id="inlineRadio2" <?php if($patients[0]['sex']==2){echo "checked";} ?>  value="2" name="sex">
                      <label for="inlineRadio2"> <?php echo trans('female') ?> </label>
                    </div>
                  </div>
                </div>

              </div>
              

              <input type="hidden" name="id" value="<?php echo html_escape($patients['0']['id']); ?>">
              <!-- csrf token -->
              <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">

              <div class="row m-t-30">
                <div class="col-sm-12">
                  <?php if (isset($page_title) && $page_title == "Edit"): ?>
                    <button type="submit" class="btn btn-primary pull-left"><i class="ficon flaticon-check"></i> <?php echo trans('save-changes') ?></button>
                    <?php else: ?>
                      <button type="submit" class="btn btn-primary pull-left"><i class="ficon flaticon-check"></i> <?php echo trans('save') ?></button>
                    <?php endif; ?>
                  </div>
                </div>

              </form>

            </div>

          </div>


          <?php if (isset($page_title) && $page_title != "Edit"): ?>

            <div class="box list_area">
              <div class="box-header with-border">
                <?php if (isset($page_title) && $page_title == "Edit"): ?>
                  <h3 class="box-title">Edit patients <a href="<?php echo base_url('admin/patients') ?>" class="pull-right btn btn-light-primary mt-15 btn-sm"><i class="fa fa-angle-left"></i> <?php echo trans('back') ?></a></h3>
                  <?php else: ?>
                    <h3 class="box-title"><?php echo trans('all-patients') ?> </h3>
                  <?php endif; ?>

                  <div class="box-tools pull-right">
                   <a href="#" class="pull-right btn btn-light-secondary btn-sm add_btn"><i class="fa fa-plus"></i> <?php echo trans('add-new-patients') ?></a>
                 </div>
               </div>

               <div class="box-body p-0">

                  <div class="col-md-12 col-sm-12 col-xs-12 scroll table-responsive">
                    <table class="table table-hover <?php if(count($patientses) > 10){echo "datatable";} ?>">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th><?php echo trans('mr.-no') ?></th>
                          <th><?php echo trans('name') ?></th>
                          <th><?php echo trans('age') ?></th>
                          <th><?php echo trans('phone') ?></th>
                          <th><?php echo trans('address') ?> </th>
                          <th><?php echo trans('prescriptions') ?></th>
                          <th><?php echo trans('action') ?></th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php $i=1; foreach ($patientses as $patients): ?>
                        <tr id="row_<?php echo html_escape($patients->id); ?>">

                          <td><?= $i; ?></td>
                          <td><?php echo html_escape($patients->mr_number); ?></td>
                          <td><?php echo html_escape($patients->name); ?></td>
                          <td><?php echo html_escape($patients->age); ?></td>
                          <td><?php echo html_escape($patients->mobile); ?></td>
                          <td><?php echo character_limiter($patients->present_address); ?></td>
                          
                          <td>
                            <a target="_blank" href="<?php echo base_url('admin/patients/all_prescriptions/'.html_escape($patients->id));?>" class="btn btn-light-primary btn-sm fs-12" data-placement="top" title=""><i class="fa fa-eye"></i> <?php echo trans('view') ?></a>
                          </td>

                          <td class="actions" width="13%">
                            <a href="<?php echo base_url('admin/patients/edit/'.html_escape($patients->id));?>" class="on-default edit-row" data-placement="top" title="<?php echo trans('edit') ?>"><i class="fa fa-pencil"></i></a> &nbsp; 

                            <a data-val="Category" data-id="<?php echo html_escape($patients->id); ?>" href="<?php echo base_url('admin/patients/delete/'.html_escape($patients->id));?>" class="on-default remove-row delete_item" data-toggle="tooltip" data-placement="top" title="<?php echo trans('delete') ?>"><i class="fa fa-trash-o"></i></a> &nbsp;
                          </td>
                        </tr>

                        <?php $i++; endforeach; ?>
                      </tbody>
                    </table>
                  </div>

              </div>

            </div>
          <?php endif; ?>

        </section>
      </div>
