
<div class="content-wrapper">

  <!-- Main content -->
  <section class="content container">

    <div class="col-md-10 offset-md-1">
      
      <div class="box add_area <?php if(isset($page_title) && $page_title == "Edit"){echo "d-block";}else{echo "hide";} ?>">
        
        <div class="box-header with-border">
          <?php if (isset($page_title) && $page_title == "Edit"): ?>
            <h3 class="box-title"><?php echo trans('edit') ?></h3>
          <?php else: ?>
            <h3 class="box-title"><?php echo trans('add-new-staff') ?> </h3>
          <?php endif; ?>

          <div class="box-tools pull-right">
            <?php if (isset($page_title) && $page_title == "Edit"): ?>
              <a href="<?php echo base_url('admin/staff') ?>" class="pull-right btn btn-light-primary mt-15 btn-sm"><i class="fa fa-angle-left"></i> <?php echo trans('back') ?></a>
            <?php else: ?>
              <a href="#" class="text-right btn btn-light-secondary cancel_btn"><i class="fa fa-users"></i> <?php echo trans('all-staffs') ?></a>
            <?php endif; ?>
          </div>
        </div>

        <div class="box-body">
          <form id="cat-form" method="post" enctype="multipart/form-data" class="validate-form" action="<?php echo base_url('admin/staff/add')?>" role="form" novalidate>

            <div class="form-group">
              <div class="avatar-upload text-center">
                    <div class="avatar-edit">
                        <input type='file' name="photo" id="imageUpload" accept=".png, .jpg, .jpeg" />
                        <label for="imageUpload"></label>
                    </div>
                    <div class="avatar-preview">
                        <div id="imagePreview" style="background-image: url(<?php echo base_url($staff[0]['thumb']); ?>);">
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label><?php echo trans('chambers') ?></label>
                <select class="selectfield textfield--grey col-sm-12 select2 w-100" name="chamber_id" required>
                    <option value=""><?php echo trans('select') ?></option>
                    <option <?php if($staff[0]['chamber_id'] == '0'){echo "selected";} ?> value="all"><?php echo trans('all-chamber') ?></option>
                    <?php foreach ($chambers as $chamber): ?>
                        <option value="<?php echo html_escape($chamber->id); ?>" <?php if($chamber->id == $staff[0]['chamber_id']){echo "selected";} ?>>
                            <?php echo html_escape($chamber->name); ?>
                        </option>
                    <?php endforeach ?>
                </select>
            </div>

            <div class="form-group">
              <label><?php echo trans('name') ?> <span class="text-danger">*</span></label>
              <input type="text" class="form-control" required name="name" value="<?php echo html_escape($staff[0]['name']); ?>" >
            </div>

            <div class="form-group">
              <label><?php echo trans('designation') ?> <span class="text-danger">*</span></label>
              <input type="text" class="form-control" required name="designation" value="<?php echo html_escape($staff[0]['designation']); ?>" >
            </div>

            <div class="form-group">
              <label><?php echo trans('email').' ('.trans('username').')' ?> <span class="text-danger">*</span></label>
              <input type="text" class="form-control" required name="email" value="<?php echo html_escape($staff[0]['email']); ?>" >
            </div>

            <div class="form-group <?php if(isset($page_title) && $page_title == 'Edit'){echo 'hide';} ?>">
              <label><?php echo trans('password') ?> <span class="text-danger">*</span></label>
              <input type="text" class="form-control" <?php if(isset($page_title) && $page_title != 'Edit'){echo 'required';} ?> name="password" value="<?php echo html_escape($staff[0]['password']); ?>" >
            </div><br>

            <h3 class="mt-5"><?php echo trans('role-permissions') ?></h3>

            <div class="row">
              <?php $f=1; foreach ($features as $feature): ?>
                <div class="col-md-4">
                  <div class="permission_list">
                        <div class="form-group">
                          <input type="checkbox" id="md_checkbox_<?php echo $f; ?>" class="filled-in chk-col-blue view_only_<?php //echo $i; ?>" value="<?php echo $feature->id; ?>" name="features[]"  <?php if(check_role_assign_features($staff[0]['id'], $staff[0]['chamber_id'], $feature->id) == 1){echo "checked";} ?>>
                          <label class="pl-3" for="md_checkbox_<?php echo $f; ?>"> <?php echo ($feature->name); ?></label>

                        </div>
                  </div>  
                </div>
              <?php $f++; endforeach ?> 

            </div>
            

            <input type="hidden" name="id" value="<?php echo html_escape($staff['0']['id']); ?>">
            <!-- csrf token -->
            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">

            <div class="row m-t-30">
              <div class="col-sm-12">
                <?php if (isset($page_title) && $page_title == "Edit"): ?>
                  <button type="submit" class="btn btn-primary pull-left"><i class="ficon flaticon-check"></i> <?php echo trans('save-changes') ?></button>
                <?php else: ?>
                  <button type="submit" class="btn btn-primary btn-lg pull-left"><i class="ficon flaticon-check"></i> <?php echo trans('save') ?></button>
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
              <h3 class="box-title"><?php echo trans('edit') ?> <a href="<?php echo base_url('admin/staff') ?>" class="pull-right btn btn-primary btn-sm"><i class="fa fa-angle-left"></i> <?php echo trans('back') ?></a></h3>
            <?php else: ?>
              <h3 class="box-title"><?php echo trans('staff') ?> </h3>
            <?php endif; ?>

            <div class="box-tools pull-right">
             <a href="#" class="pull-right btn btn-light-secondary add_btn"><i class="fa fa-plus"></i> <?php echo trans('add-new-staff') ?> </a>
            </div>
          </div>

          <div class="box-body p-0">
            
            <div class="col-md-12 col-sm-12 col-xs-12 scroll table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th><?php echo trans('thumb') ?></th>
                            <th><?php echo trans('informations') ?></th>
                            <th></th>
                            <th><?php echo trans('action') ?></th>
                        </tr>
                    </thead>
                    <tbody>
                      <?php $i=1; foreach ($staffs as $staff): ?>
                        <tr id="row_<?php echo html_escape($staff->id); ?>">
                            
                            <td><?= $i; ?></td>
                            <td>
                                <?php if (!empty($staff->thumb)): ?>
                                  <img width="120px" class="round min-w80 max-w80" src="<?php echo base_url($staff->thumb); ?>">
                                <?php else: ?>
                                  <div class="avatar-circle">
                                    <div class="circle-txt"><?php echo $staff->name[0] ?></div>
                                  </div>
                                <?php endif ?>
                            </td>
                            <td>
                                <h3 class="mt-0 mb-0"><?php echo html_escape($staff->name); ?></h3>
                                <b>
                                  <?php if ($staff->chamber_id == 0): ?>
                                    <?php echo trans('all-chambers') ?>
                                  <?php else: ?>
                                    <?php echo get_by_id($staff->chamber_id, 'chamber')->name; ?>
                                  <?php endif ?>
                                </b>
                                <p class="mb-0"><?php echo html_escape($staff->email); ?></p>
                                <p class="mb-0"><?php echo html_escape($staff->designation); ?></p>
                            </td>

                            <td>
                              
                            </td>
                            
                            <td class="actions" width="12%">
                              <a href="<?php echo base_url('admin/staff/edit/'.html_escape($staff->id));?>" class="on-default edit-row" data-placement="top" title="<?php echo trans('edit') ?>"><i class="fa fa-pencil"></i></a> &nbsp; 

                              <a data-val="Category" data-id="<?php echo html_escape($staff->id); ?>" href="<?php echo base_url('admin/staff/delete/'.html_escape($staff->id));?>" class="on-default remove-row delete_item" data-toggle="tooltip" data-placement="top" title="<?php echo trans('delete') ?>"><i class="fa fa-trash-o"></i></a> &nbsp;
                            </td>
                        </tr>
                        
                      <?php $i++; endforeach; ?>
                    </tbody>
                </table>
            </div>

          </div>

          
        </div>
      <?php endif; ?>

    </div>
  </section>
</div>
