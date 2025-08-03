<div class="content-wrapper">

  <!-- Main content -->
  <section class="content container">

    <div class="box add_area <?php if(isset($page_title) && $page_title == "Edit"){echo "d-block";}else{echo "hide";} ?>">
      <div class="box-header with-border">
        <?php if (isset($page_title) && $page_title == "Edit"): ?>
          <h3 class="box-title"><?php echo trans('edit') ?></h3>
        <?php else: ?>
          <h3 class="box-title"><?php echo trans('add-new-test') ?></h3>
        <?php endif; ?>

        <div class="box-tools pull-right">
          <?php if (isset($page_title) && $page_title == "Edit"): ?>
            <a href="<?php echo base_url('admin/advise_investigation') ?>" class="pull-right btn btn-light-secondary btn-sm mt-15"><i class="fa fa-angle-left"></i> <?php echo trans('back') ?></a>
          <?php else: ?>
            <a href="#" class="text-right btn btn-light-secondary btn-sm cancel_btn"><i class="fa fa-bars"></i><?php echo trans('all-diagnosis-tests') ?></a>
          <?php endif; ?>
        </div>
      </div>

      <div class="box-body">
        <form id="cat-form" method="post" enctype="multipart/form-data" class="validate-form" action="<?php echo base_url('admin/advise_investigation/add')?>" role="form" novalidate>

          <div class="form-group">
            <label><?php echo trans('name') ?> <span class="text-danger">*</span></label>
            <input type="text" class="form-control" required name="name" value="<?php echo html_escape($advise_investigation[0]['name']); ?>" >
          </div>

          <div class="form-group">
            <label><?php echo trans('details') ?></label>
            <textarea id="ckEditor" class="form-control" name="details" rows="6"><?php echo html_escape($advise_investigation[0]['details']); ?></textarea>
          </div>

          <input type="hidden" name="id" value="<?php echo html_escape($advise_investigation['0']['id']); ?>">
          <!-- csrf token -->
          <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">

          <hr>

          <div class="row m-t-30">
            <div class="col-sm-12">
              <?php if (isset($page_title) && $page_title == "Edit"): ?>
                <button type="submit" class="btn btn-primary pull-left"><i class="ficon flaticon-check"></i> <?php echo trans('save-changes') ?></button>
              <?php else: ?>
                <button type="submit" class="btn btn-primary pull-left"><i class="ficon flaticon-check"></i> <?php echo trans('save-changes') ?></button>
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
          <h3 class="box-title"><?php echo trans('edit') ?> <a href="<?php echo base_url('admin/advise_investigation') ?>" class="pull-right btn btn-light-secondary btn-sm"><i class="fa fa-angle-left"></i> <?php echo trans('back') ?></a></h3>
        <?php else: ?>
          <h3 class="box-title"><?php echo trans('all-diagnosis-tests') ?> </h3>
        <?php endif; ?>

        <div class="box-tools pull-right">
         <a href="#" class="pull-right btn btn-light-secondary btn-sm add_btn"><i class="fa fa-plus"></i> <?php echo trans('add-new-test') ?></a>
        </div>
      </div>

      <div class="box-body">
        
        <div class="col-md-12 col-sm-12 col-xs-12 scroll table-responsive">
            <table class="table table-bordered <?php if(count($advise_investigations) > 10){echo 'datatable';} ?>" id="dg_table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th><?php echo trans('name') ?></th>
                        <th><?php echo trans('details') ?></th>
                        <th><?php echo trans('action') ?></th>
                    </tr>
                </thead>
                <tbody>
                  <?php $i=1; foreach ($advise_investigations as $advise_investigation): ?>
                    <tr id="row_<?php echo html_escape($advise_investigation->id); ?>">
                        
                        <td><?= $i; ?></td>
                        <td><?php echo html_escape($advise_investigation->name); ?></td>
                        <td><?php echo character_limiter($advise_investigation->details, 80); ?></td>
                        
                        <td class="actions" width="12%">
                          <a href="<?php echo base_url('admin/advise_investigation/edit/'.html_escape($advise_investigation->id));?>" class="on-default edit-row" data-placement="top" title="<?php echo trans('edit') ?>"><i class="fa fa-pencil"></i></a> &nbsp; 

                          <a data-val="Category" data-id="<?php echo html_escape($advise_investigation->id); ?>" href="<?php echo base_url('admin/advise_investigation/delete/'.html_escape($advise_investigation->id));?>" class="on-default remove-row delete_item" data-toggle="tooltip" data-placement="top" title="<?php echo trans('delete') ?>"><i class="fa fa-trash-o"></i></a> &nbsp;
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
