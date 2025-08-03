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
            <a href="<?php echo base_url('admin/workflow') ?>" class="pull-right btn btn-light-secondary btn-sm mt-15"><i class="fa fa-angle-left"></i> <?php echo trans('back') ?></a>
          <?php else: ?>
            <?php $required = 'required'; ?>
            <a href="#" class="text-right btn btn-light-secondary btn-sm cancel_btn"><i class="fa fa-bars"></i> <?php echo trans('workflow') ?></a>
          <?php endif; ?>
        </div>
      </div>

      <div class="box-body">
        <form id="cat-form" method="post" enctype="multipart/form-data" class="validate-form" action="<?php echo base_url('admin/workflow/add')?>" role="form" novalidate>

          <div class="form-group">
              <label><?php echo trans('title') ?></label>
              <input type="text" class="form-control" name="title" value="<?php echo html_escape($workflow[0]['title']); ?>" <?php echo html_escape($required); ?>>
          </div>

          <div class="form-group">
              <label><?php echo trans('description') ?></label>
              <textarea class="form-control" name="details"><?php echo html_escape($workflow[0]['details']); ?></textarea>
          </div>

          <div class="form-group">
              <?php if (isset($page_title) && $page_title == "Edit"): ?>
                  <img width="200px" src="<?php echo base_url($workflow[0]['image']) ?>"> <br><br>
              <?php endif ?>
              <div class="input-group">
                  <span class="input-group-btn">
                      <span class="btn btn-default btn-file">
                        <i class="fa fa-upload"></i><?php echo trans('upload-image') ?> <input type="file" id="imgInp" name="photo">
                      </span>
                  </span>
              </div><br>
              <img width="200px" id="img-upload"/>
          </div>


          <input type="hidden" name="id" value="<?php echo html_escape($workflow[0]['id']); ?>">
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
          <h3 class="box-title">Edit page <a href="<?php echo base_url('admin/workflow') ?>" class="pull-right btn btn-light-secondary btn-sm"><i class="fa fa-angle-left"></i> <?php echo trans('back') ?></a></h3>
        <?php else: ?>
          <h3 class="box-title"><?php echo trans('workflow') ?> </h3>
        <?php endif; ?>
      </div>

      <div class="box-bodys">
        
        <div class="col-md-12 col-sm-12 col-xs-12 scroll table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th><?php echo trans('image') ?></th>
                        <th><?php echo trans('title') ?></th>
                        <th><?php echo trans('details') ?></th>
                        <th><?php echo trans('action') ?></th>
                    </tr>
                </thead>
                <tbody>
                  <?php $i=1; foreach ($workflows as $row): ?>
                    <tr id="row_<?php echo ($row->id); ?>">
                        
                        <td width="5%"><?= $i; ?></td>
                        <td><img class="img-circle border-1" width="50px" src="<?php echo base_url($row->image) ?>"></td>
                        <td><?php echo html_escape($row->title); ?></td>
                        <td><?php echo character_limiter($row->details, 120); ?></td>

                        <td class="actions" width="12%">
                          <a href="<?php echo base_url('admin/workflow/edit/'.html_escape($row->id));?>" class="on-default edit-row" data-placement="top" title="Edit"><i class="fa fa-pencil"></i></a> 
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
