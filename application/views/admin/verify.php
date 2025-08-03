
<div class="content-wrapper">

  <!-- Main content -->
  <section class="content container">

    <div class="box list_area">
      <div class="box-header with-border d-flex justify-content-between">
        <h3 class="box-title pl-25"><?php echo trans('doctors-verification') ?></h3>
        <div><span class="badge badge-danger-soft brd-20"><?php echo trans('pending') ?></span></div>
      </div>

      <div class="box-body">
        
          <div class="row">
              <?php $f=1; foreach ($files as $item): ?>

                  <div class="col-md-3">
                      <h5 class="pl-10 badge badge-success-soft"><?php echo $item->name ?></h5><br>

                      <a href="<?php echo base_url($item->file) ?>" data-lightbox="image-1" data-title="<?php echo $item->name ?>">
                        <div class="uvimg" style="background-image: url(<?php echo base_url($item->file) ?>)">

                        </div>
                      </a>
                  </div>

              <?php $f++; endforeach; ?>
          </div><br><br>

         
          <a href="<?php echo base_url('admin/users/confirm_verification/'.$user_id) ?>" class="btn btn-primary pull-left mr-5 mt-15 confirm_verify"><i class="fa fa-check-circle"></i> <?php echo trans('verify-profile') ?></a>
       
       
      </div>

    </div>

  </section>
</div>
