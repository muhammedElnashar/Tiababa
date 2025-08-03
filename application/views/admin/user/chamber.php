
<div class="content-wrapper">

  <!-- Main content -->
  <section class="content container">

    <div class="box add_area <?php if(isset($page_title) && $page_title == "Edit"){echo "d-block";}else{echo "hide";} ?>">
      <div class="box-header with-border">
        <?php if (isset($page_title) && $page_title == "Edit"): ?>
          <h3 class="box-title"><?php echo trans('edit') ?></h3>
        <?php else: ?>
          <h3 class="box-title"><?php echo trans('add-new-chamber') ?> </h3>
        <?php endif; ?>

        <div class="box-tools pull-right">
          <?php if (isset($page_title) && $page_title == "Edit"): ?>
            <a href="<?php echo base_url('admin/chamber') ?>" class="pull-right btn btn-light-primary btn-sm mt-15"><i class="fa fa-angle-left"></i> <?php echo trans('back') ?></a>
          <?php else: ?>
            <a href="#" class="text-right btn btn-light-secondary btn-sm cancel_btn"><i class="fa fa-bars"></i> <?php echo trans('all-chambers') ?></a>
          <?php endif; ?>
        </div>
      </div>

      <div class="box-body">
        <form id="cat-form" method="post" enctype="multipart/form-data" class="validate-form" action="<?php echo base_url('admin/chamber/add')?>" role="form" novalidate>

          <div class="form-group">
            <div class="avatar-uploadb text-center">
                  <div class="avatar-edit">
                      <input type='file' name="photo1" id="imageUpload" accept=".png, .jpg, .jpeg" />
                      <label for="imageUpload"></label>
                  </div>
                  <div class="avatar-preview">
                      <?php if (isset($page_title) && $page_title == "Edit"): ?>
                        <div id="imagePreview" style="background-image: url(<?php echo base_url($chamber[0]['logo']); ?>);">
                        </div>
                      <?php else: ?>
                        <div id="imagePreview">
                        <p class="upload-text"><i class="fa fa-plus"></i> <br> <?php echo trans('upload-logo') ?></p>
                        </div>
                      <?php endif; ?>
                      
                  </div>
              </div>
          </div>

          <div class="form-group">
              <label><?php echo trans('department') ?></label>
              <select class="selectfield textfield--grey col-sm-12 select2" name="category" required style="width: 100%">
                  <option value=""><?php echo trans('select') ?></option>
                  <?php foreach ($categories as $category): ?>
                      <option value="<?php echo html_escape($category->id); ?>" <?php if($category->id == $chamber[0]['category']){echo "selected";} ?>>
                          <?php echo html_escape($category->name); ?>
                      </option>
                  <?php endforeach ?>
              </select>
          </div>

          <div class="form-group">
            <label><?php echo trans('name') ?> <span class="text-danger">*</span></label>
            <input type="text" class="form-control" required name="name" value="<?php echo html_escape($chamber[0]['name']); ?>" >
          </div>

          <div class="form-group">
            <label><?php echo trans('title') ?> <span class="text-danger">*</span></label>
            <input type="text" class="form-control" required name="title" value="<?php echo html_escape($chamber[0]['title']); ?>" >
          </div>

          <div class="form-group">
            <label><?php echo trans('appointment-limit') ?></label>
            <input type="number" class="form-control" name="appoinment_limit" value="<?php echo html_escape($chamber[0]['appoinment_limit']); ?>" >
          </div>

          <div class="form-group">
            <label><?php echo trans('address') ?></label>
            <textarea class="form-control" name="address" rows="6"><?php echo html_escape($chamber[0]['address']); ?></textarea>
          </div>

          <input type="hidden" name="id" value="<?php echo html_escape($chamber['0']['id']); ?>">
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
          <h3 class="box-title"><?php echo trans('edit') ?> <a href="<?php echo base_url('admin/chamber') ?>" class="pull-right btn btn-light-secondary btn-sm"><i class="fa fa-angle-left"></i> <?php echo trans('back') ?></a></h3>
        <?php else: ?>
          <h3 class="box-title"><?php echo trans('all-chambers') ?></h3>
        <?php endif; ?>

        <div class="box-tools pull-right">
         <a href="#" class="pull-right btn btn-light-secondary btn-sm add_btn"><i class="fa fa-plus"></i> <?php echo trans('add-new-chamber') ?></a>
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
                        <th><?php echo trans('appointment-limit') ?></th>
                        <th><?php echo trans('status') ?></th>
                        <th><?php echo trans('action') ?></th>
                    </tr>
                </thead>
                <tbody>
                  <?php $i=1; foreach ($chambers as $chamber): ?>
                    <tr id="row_<?php echo html_escape($chamber->id); ?>">
                        
                        <td><?= $i; ?></td>
                        <td>
                            <?php if (!empty($chamber->logo)): ?>
                              <img width="120px" class="img-thumbnails min-w80 max-w80" src="<?php echo base_url($chamber->logo); ?>">
                            <?php else: ?>
                                <div class="avatar-circle-lg">
                                  <div class="circle-txt"><?php echo $chamber->name[0] ?></div>
                                </div>
                            <?php endif ?>
                        </td>
                        <td>
                            <h3 class="mt-0 mb-0"><?php echo html_escape($chamber->name); ?></h3>
                            <p class="mb-0"> <strong><?php echo html_escape($chamber->category_name) ?></strong></p>
                            <p class="mb-0"> <?php echo html_escape($chamber->address); ?></p>
                        </td>
                        <td><?php echo html_escape($chamber->appoinment_limit); ?></td>
                        <td>
                          <?php if ($chamber->is_primary == 1): ?>
                            <span class="badge brd-20 badge-success-soft" disabled data-toggle="tooltip" data-placement="top" title="This is your default chamber"><i class="ficon flaticon-check"></i> <?php echo trans('active') ?></span>
                          <?php else: ?>
                            <a data-val="<?php echo html_escape($chamber->name); ?>" data-id="<?php echo html_escape($chamber->id); ?>" href="<?php echo base_url('admin/chamber/set_primary/'.html_escape($chamber->id));?>" class="btn btn-light-primary primary_item brd-20" data-toggle="tooltip" data-placement="top" title="Set as a default chamber"><i class="fa fa-star"></i> <?php echo trans('set-default') ?></a>
                          <?php endif ?>
                        </td>
                        
                        <td class="actions" width="12%">
                          <a href="<?php echo base_url('admin/chamber/edit/'.md5($chamber->id));?>" class="on-default edit-row" data-placement="top" title="<?php echo trans('edit') ?>"><i class="fa fa-pencil"></i></a> &nbsp; 

                          <a data-val="Category" data-id="<?php echo html_escape($chamber->id); ?>" href="<?php echo base_url('admin/chamber/delete/'.html_escape($chamber->id));?>" class="on-default remove-row delete_item" data-toggle="tooltip" data-placement="top" title="<?php echo trans('delete') ?>"><i class="fa fa-trash-o"></i></a> &nbsp;
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
