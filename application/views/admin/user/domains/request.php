<div class="content-wrapper">

  

  <!-- Main content -->
  <div class="content">
    <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
              <div class="card list_area">
                <h3 class="card-title pt-2 mb-3"><?php echo trans('domain-request') ?></h3>

                <div class="card-body table-responsive p-0">
                  <table class="table table-hover text-nowrap <?php if(is_countable($domains) && count($domains)  > 10){echo "datatable";} ?>">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th><?php echo trans('current-domain') ?></th>
                        <th><?php echo trans('custom-domain') ?></th>
                        <th><?php echo trans('date') ?></th>
                        <th><?php echo trans('status') ?></th>
                        <th><?php echo trans('action') ?></th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $i=1; foreach ($domains as $domain): ?>
                        <tr id="row_<?php echo html_escape($domain->id); ?>">
                          <td><?= $i; ?></td>
                          <td><?php echo html_escape($domain->current_domain) ?></td>
                          <td><?php echo html_escape($domain->custom_domain) ?></td>
                          <td><?php echo my_date_show($domain->date) ?></td>
                          <td>
                            <?php if ($domain->status == 0): ?>
                              <span class="badge badge-warning"><?php echo trans('pending') ?></span>
                            <?php elseif($domain->status == 1): ?>
                              <span class="badge badge-success"><?php echo trans('approved') ?></span>
                            <?php else: ?>
                               <span class="badge badge-danger"><?php echo trans('rejected') ?></span>
                            <?php endif ?>
                          </td> 
                          <td class="actions">
                            <div class="btn-group">
                              <button type="button" class="btn btn-tool" data-toggle="dropdown" aria-expanded="false">
                                <i class="fa fa-ellipsis-h"></i>
                              </button>
                              <div class="dropdown-menu dropdown-menu-right" role="menu" >
                                <a href="<?php echo base_url('admin/domain/request_approve/'.html_escape($domain->id));?>" class="dropdown-item"><?php echo trans('approve') ?>Approve</a>
                                
                                <a href="<?php echo base_url('admin/domain/request_reject/'.html_escape($domain->id));?>" class="dropdown-item"><?php echo trans('reject') ?>Reject</a>

                                <a data-val="Category" data-id="<?php echo html_escape($domain->id); ?>" href="<?php echo base_url('admin/domain/delete/'.html_escape($domain->id));?>" class="dropdown-item delete_item"><?php echo trans('delete') ?></a>
                              </div>
                            </div>
                          </td>
                        </tr>
                      <?php $i++; endforeach; ?>
                    </tbody>
                  </table>
                </div>
              </div>
          </div>
      </div>
    </div>
  </div>
</div>
