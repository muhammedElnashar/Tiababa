<div class="content-wrapper">

  <!-- Main content -->
  <section class="content container">


    <div class="box add_area <?php if(isset($page_title) && $page_title == "Edit"){echo "d-block";}else{echo "hide";} ?>">
      <div class="box-header with-border">
        <?php if (isset($page_title) && $page_title == "Edit"): ?>
          <h3 class="box-title"><?php echo trans('edit') ?></h3>
        <?php else: ?>
          <h3 class="box-title"><?php echo trans('add-new-service') ?> </h3>
        <?php endif; ?>

        <div class="box-tools pull-right">
          <?php if (isset($page_title) && $page_title == "Edit"): ?>
            <a href="<?php echo base_url('admin/service') ?>" class="pull-right btn btn-light-secondary btn-sm"><i class="fa fa-angle-left"></i> <?php echo trans('back') ?></a>
          <?php else: ?>
            <a href="#" class="text-right btn btn-light-secondary cancel_btn"><i class="fa fa-bars"></i> <?php echo trans('all-services') ?></a>
          <?php endif; ?>
        </div>
      </div>

      <div class="box-body">
        <form id="cat-form" method="post" enctype="multipart/form-data" class="validate-form" action="<?php echo base_url('admin/services/add')?>" role="form" novalidate>

          <div class="form-group">
            <label><?php echo trans('name') ?><span class="text-danger">*</span></label>
            <input type="text" class="form-control" required name="name" value="<?php echo html_escape($service[0]['name']); ?>" >
          </div>

          <div class="form-group">
              <?php if (isset($page_title) && $page_title == "Edit"): ?>
                  <img src="<?php echo base_url($service[0]['thumb']) ?>"> <br><br>
              <?php endif ?>
              <div class="input-group">
                  <span class="input-group-btn">
                      <span class="btn btn-light-secondary btn-file">
                        <i class="fa fa-upload"></i>  <?php echo trans('upload-image') ?> <input type="file" id="imgInp" name="photo">
                      </span>
                  </span>
              </div><br>
              <img width="200px" id='img-upload'/>
          </div>

          <div class="form-group">
            <label><?php echo trans('details') ?> <span class="text-danger">*</span></label>
            <textarea class="form-control" required name="details" rows="6"><?php echo html_escape($service[0]['details']); ?></textarea>
          </div>

          <div class="form-group">
            <label><?php echo trans('order') ?></label>
            <input type="number" placeholder="Example: 1 2 3" class="form-control" name="orders" value="<?php echo html_escape($service[0]['orders']); ?>">
          </div>

          <input type="hidden" name="id" value="<?php echo html_escape($service['0']['id']); ?>">
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
      <div class="box-header">
        <?php if (isset($page_title) && $page_title == "Edit"): ?>
          <h3 class="box-title">Edit service <a href="<?php echo base_url('admin/services') ?>" class="pull-right btn btn-light-secondary btn-sm mt-15"><i class="fa fa-angle-left"></i> <?php echo trans('back') ?></a></h3>
        <?php else: ?>
          <h3 class="box-title">All Services </h3>
        <?php endif; ?>

        <div class="box-tools pull-right">
         <a href="#" class="pull-right btn btn-light-secondary btn-sm add_btn"><i class="fa fa-plus"></i> <?php echo trans('add-new-service') ?> </a>
        </div>
      </div>

      <div class="box-body p-0 mt-20">
        
        <div class="col-md-12 col-sm-12 col-xs-12 scroll table-responsive">
            <table class="table table-hover" id="dg_table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th><?php echo trans('thumb') ?></th>
                        <th><?php echo trans('name') ?></th>
                        <th><?php echo trans('details') ?></th>
                        <th><?php echo trans('orders') ?></th>
                        <th><?php echo trans('action') ?></th>
                    </tr>
                </thead>
                <tbody>
                  <?php $i=1; foreach ($services as $service): ?>
                    <tr id="row_<?php echo html_escape($service->id); ?>">
                        
                        <td><?= $i; ?></td>
                        <td><img width="100px" src="<?php echo base_url($service->thumb) ?>"></td>
                        <td><?php echo html_escape($service->name); ?></td>
                        <td><?php echo character_limiter($service->details, 80); ?></td>

                        <td><span class="badge badge-pill badge-info"><?php echo html_escape($service->orders); ?></span></td>
                        
                        <td class="actions" width="12%">
                          <a href="<?php echo base_url('admin/services/edit/'.html_escape($service->id));?>" class="on-default edit-row" data-placement="top" title="<?php echo trans('edit') ?>"><i class="fa fa-pencil"></i></a> &nbsp; 

                          <a data-val="Category" data-id="<?php echo html_escape($service->id); ?>" href="<?php echo base_url('admin/services/delete/'.html_escape($service->id));?>" class="on-default remove-row delete_item" data-toggle="tooltip" data-placement="top" title="<?php echo trans('delete') ?>"><i class="fa fa-trash-o"></i></a> &nbsp;

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
