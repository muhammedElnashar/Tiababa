<div class="content-wrapper">

  <!-- Main content -->
  <section class="content container">


    <div class="box add_area <?php if(isset($page_title) && $page_title == "Edit"){echo "d-block";}else{echo "hide";} ?>">
      <div class="box-header with-border">
        <?php if (isset($page_title) && $page_title == "Edit"): ?>
          <h3 class="box-title"><?php echo trans('edit-page') ?></h3>
        <?php else: ?>
          <h3 class="box-title"><?php echo trans('add-new-page') ?> </h3>
        <?php endif; ?>

        <div class="box-tools pull-right">
          <?php if (isset($page_title) && $page_title == "Edit"): ?>
            <?php $required = ''; ?>
            <a href="<?php echo base_url('admin/pages') ?>" class="pull-right btn btn-light-secondary btn-sm mt-15"><i class="fa fa-angle-left"></i> <?php echo trans('back') ?></a>
          <?php else: ?>
            <?php $required = 'required'; ?>
            <a href="#" class="text-right btn btn-light-secondary btn-sm cancel_btn"><i class="fa fa-bars"></i> <?php echo trans('pages') ?></a>
          <?php endif; ?>
        </div>
      </div>

      <div class="box-body">
        <form id="cat-form" method="post" enctype="multipart/form-data" class="validate-form" action="<?php echo base_url('admin/pages/add')?>" role="form" novalidate>

          <div class="form-group">
              <label><?php echo trans('title') ?></label>
              <input type="text" class="form-control" name="title" value="<?php echo html_escape($page[0]['title']); ?>" <?php echo html_escape($required); ?>>
          </div>

          <div class="form-group">
              <label><?php echo trans('slug') ?></label>
              <input type="text" class="form-control" name="slug" <?php if($page[0]['id'] == 1 || $page[0]['id'] == 2){echo "readonly";} ?> value="<?php echo html_escape($page[0]['slug']); ?>" <?php echo html_escape($required); ?>>
          </div>
         
          <div class="form-group">
              <label><?php echo trans('description') ?></label>
              <textarea id="ckEditor" class="form-control" name="details"><?php echo html_escape($page[0]['details']); ?></textarea>
          </div>

          <input type="hidden" name="id" value="<?php echo html_escape($page['0']['id']); ?>">
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
          <h3 class="box-title">Edit page <a href="<?php echo base_url('admin/pages') ?>" class="pull-right btn btn-light-secondary btn-sm"><i class="fa fa-angle-left"></i> <?php echo trans('back') ?></a></h3>
        <?php else: ?>
          <h3 class="box-title"><?php echo trans('pages') ?> </h3>
        <?php endif; ?>

        <div class="box-tools pull-right">
         <a href="#" class="pull-right btn btn-light-secondary  btn-sm add_btn"><i class="fa fa-plus"></i> <?php echo trans('add-new-page') ?></a>
        </div>
      </div>

      <div class="box-bodys">
        
        <div class="col-md-12 col-sm-12 col-xs-12 scroll table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th><?php echo trans('title') ?></th>
                        <th><?php echo trans('details') ?></th>
                        <th><?php echo trans('action') ?></th>
                    </tr>
                </thead>
                <tbody>
                  <?php $i=1; foreach ($pages as $row): ?>
                    <tr id="row_<?php echo ($row->id); ?>">
                        
                        <td width="5%"><?= $i; ?></td>
                        <td><?php echo html_escape($row->title); ?></td>
                        <td><?php echo character_limiter($row->details, 120); ?></td>

                        <td class="actions" width="12%">
                          <a href="<?php echo base_url('admin/pages/edit/'.html_escape($row->id));?>" class="on-default edit-row" data-placement="top" title="Edit"><i class="fa fa-pencil"></i></a> &nbsp; 

                          <?php if ($row->id != 1 && $row->id != 2): ?>
                          <a data-val="page" data-id="<?php echo html_escape($row->id); ?>" href="<?php echo base_url('admin/pages/delete/'.html_escape($row->id));?>" class="on-default remove-row delete_item" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash-o"></i></a> &nbsp;
                          <?php endif ?>

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
