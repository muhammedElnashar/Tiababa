
<div class="content-wrapper">
  <!-- Main content -->
  <section class="content container">

  <div class="row">
   
    <!-- experience area -->
    <div class="col-md-12">
      <div class="box add_area">
        <div class="box-header with-border">
            <h3 class="box-title"><?php echo trans('appointments-list-by-date') ?></h3>

            <div class="box-tools pull-right">
              <a href="<?= $_SERVER['HTTP_REFERER'];?>" class="btn btn-light-primary btn-sm pull-right mt-15" data-toggle="tooltip" data-placement="top" title=""><i class="fa fa-long-arrow-left"></i> <?php echo trans('back') ?></a>
            </div>
        </div>

        <div class="box-body p-0">
        
          <table class="table table-hover">
              <thead>
                  <tr>
                      <th><?php echo trans('date') ?></th>
                      <th><?php echo trans('patients') ?></th>
                      <th><?php echo trans('action') ?></th>
                  </tr>
              </thead>
              <tbody>
                <?php $i=1; foreach ($appointments as $amp): ?>
                  <tr id="row_<?php echo html_escape($amp->id); ?>">
                      <td><span class="badge badge-pill badge-primary-soft"><i class="flaticon-calendar mr-1"></i> <?php echo my_date_show($amp->date); ?></span></td>
                      <td>
                        <span class="badge badge-pill badge-secondary-soft cus fs-18"><i class="icon-people"></i> <b><?php echo html_escape($amp->total_patients); ?></b></span>
                      </td>
                      <td class="actions" width="15%">
                          <a href="<?php echo base_url('admin/appointment/list/'.$amp->date);?>" class="btn btn-light-secondary btn-sm" data-toggle="tooltip" data-placement="top" title=""><i class="icon-eye"></i> <?php echo trans('see-list') ?> </a>
                      </td>
                  </tr>
                  
                <?php $i++; endforeach; ?>
              </tbody>
          </table>

        </div>

      </div>
    </div>

  </div>

  </section>
</div>
