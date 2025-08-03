<div class="content-wrapper">
    
    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
    
            <div class="col-lg-9 pl-3">
                <div class="card">
                    <div class="card-body">
                        <p class="lead"><span class="badge badge-secondary-soft"><i class="fa fa-share-alt"></i> <?php echo trans('share-qr-code') ?></span></p>
                        <img class="img-thumbnail opacity-40" src="<?php echo base_url($user->qr_code) ?>">

                        <p class="mt-2"><a href="<?php echo base_url('admin/profile/download_qrcode') ?>" class="btn btn-primary btn-sm"><i class="fa fa-cloud-download"></i> <?php echo trans('download') ?></a></p>
                    </div>
                </div>
            </div>

        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
