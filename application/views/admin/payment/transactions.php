<div class="content-wrapper">

  <!-- Main content -->
  <section class="content container-fluid">

    <div class="box list_area">
      <div class="box-header with-border">
        <h3 class="box-title"><?php echo trans('payments') ?> </h3>
      </div>
    
     
      <div class="col-md-12 col-sm-12 col-xs-12 scroll table-responsive p-0">
          <table class="table table-hover <?php if(count($payments) > 10){echo "datatable";} ?> cushover" id="dg_table">
              <thead>
                  <tr>
                      <th>#</th>
                      <th></th>
                      <th><?php echo trans('user') ?></th>
                      <th><?php echo trans('plan') ?></th>
                      <th><?php echo trans('billing-cycle') ?></th>
                      <th><?php echo trans('price') ?></th>
                      <th><?php echo trans('status') ?></th>
                      <th><?php echo trans('date') ?></th>
                      <th class="text-right"><?php echo trans('action') ?></th>
                  </tr>
              </thead>
              <tbody>
                <?php $i=1; foreach ($payments as $payment): ?>

                  <?php if ($payment->amount != '0.00'): ?>
                    <tr id="row_<?php echo html_escape($payment->id); ?>">
                        
                        <td><?php echo $i; ?></td>
                        
                        <?php if ($payment->thumb == ''): ?>
                            <?php $avatar = 'assets/images/avatar.png'; ?> 
                        <?php else: ?>
                            <?php $avatar = $payment->thumb; ?>
                        <?php endif ?>
                        <td><img width="40px" class="img-circle" src="<?php echo base_url($avatar) ?>"></td>
                        <td>
                          <?php echo ucfirst($payment->user_name); ?><br>
                          <?php echo ucfirst($payment->email); ?>
                        </td>
                        <td><label class="badge badge-primary-soft  brd-20"><?php echo html_escape($payment->package_name); ?></label></td>
                        <td><?php echo html_escape($payment->billing_type); ?></td>
                        <td><?php echo html_escape(settings()->currency_symbol) ?><?php echo html_escape($payment->amount); ?></td>
                        <td>
                          <?php if ($payment->status == 'verified'): ?>
                            <label class="badge badge-success-soft brd-20"><?php echo ucfirst($payment->status); ?></label>
                          <?php else: ?>
                            <label class="badge badge-danger-soft brd-20"><?php echo ucfirst($payment->status); ?></label>
                          <?php endif ?>
                        </td>
                        <td><?php echo my_date_show($payment->created_at); ?> </td>
                        
                        <td class="actions" width="30%">
                          <a target="_blank" href="<?php echo base_url('admin/payment/receipt/'.$payment->puid) ?>" class="pull-right btn btn-light-success btn-sm brd-20"><i class="fa fa-file-text-o"></i> <?php echo trans('view') ?></a>
                        </td>
                    </tr>
                  <?php endif ?>
                  
                <?php $i++; endforeach; ?>
              </tbody>
          </table>
      </div>

     
    </div>
    

  </section>
</div>
