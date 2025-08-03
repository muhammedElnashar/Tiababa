<div class="content-wrapper">
  <!-- Main content -->
  <section class="content container">
    <div class="text-right">
      <a href="<?php echo base_url('admin/file/download/'.strtolower($type)) ?>" class="text-right btn btn-light-primary btn-sm mt-15 mr-2 mb-3"><i class="fa fa-cloud-download"></i> Download CSV Template</a>
    </div>

    <div class="box list_area mt-3">
      <div class="box-header with-border">
          <h3 class="box-title">Bulk Import <?php echo trans(strtolower($type)) ?> </h3>

          <div class="box-tools pull-right">
           <a href="<?php echo base_url('admin/drugs') ?>" class="text-right btn btn-light-secondary btn-sm mt-15"><i class="fa fa-bars"></i> <?php echo trans('drugs') ?></a>
          </div>
      </div>

      <div class="box-body p-4">
        <form id="cat-form" method="post" enctype="multipart/form-data" class="validate-form" action="<?php echo base_url('admin/file/import_file')?>" role="form" novalidate>

          <div class="form-group">
              <label>Upload csv file<?php echo trans('upload') ?></label>
              <input type="file" class="form-control" name="file" required>
          </div>

          <input type="hidden" name="type" value="<?php echo html_escape($type); ?>">
          <!-- csrf token -->
          <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">

          <div class="row m-t-30">
            <div class="col-sm-12">
                <button type="submit" class="btn btn-primary pull-left"><i class="fa fa-check-circle"></i> <?php echo trans('submit') ?></button>
            </div>
          </div>

        </form>
      </div>
    </div>
  </section>
</div>
