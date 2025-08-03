<div class="content-wrapper">
  <!-- Main content -->
  <section class="content container">
    <div class="box list_area">
      <div class="box-header with-border">
          <h3 class="box-title"><?php echo trans('set-theme') ?> </h3>
      </div>

      <div class="box-body">
        <form method="post" enctype="multipart/form-data" class="layout_form" action="<?php echo base_url('admin/settings/appearance')?>" role="form" novalidate>
          <div class="row">
              <div class="col-md-6 text-center">
                  <?php if (settings()->theme == 1): ?>
                    <p class="badge badge-success-soft brd-20"><i class="ficon flaticon-check"></i> <?php echo trans('active') ?></p>
                  <?php else: ?>
                    <p class="pt-6"></p>
                  <?php endif ?>
              </div>

              <div class="col-md-6 text-center">
                  <?php if (settings()->theme == 2): ?>
                    <p class="badge badge-success-soft brd-20"><i class="ficon flaticon-check"></i> <?php echo trans('active') ?></p>
                  <?php else: ?>
                    <p class="pt-6"></p>
                  <?php endif ?>
              </div>
            </div>
          <div class="row">
            <div class="col-md-6 text-center">
                <label class="radio-img <?php if(settings()->theme == 1){echo "active";} ?>">
                  <input type="radio" name="theme" class="layout" value="1" />
                  <img src="<?php echo base_url('assets/admin/images/theme_1.jpg') ?>">
                </label>
            </div>
            <div class="col-md-6 text-center">
                <label class="radio-img <?php if(settings()->theme == 2){echo "active";} ?>">
                  <input type="radio" name="theme" class="layout" value="2"/>
                  <img src="<?php echo base_url('assets/admin/images/theme_2.jpg') ?>">
                </label>
            </div>
          </div>

          <!-- csrf token -->
          <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
        </form>
      </div>
    </div>
  </section>
</div>
