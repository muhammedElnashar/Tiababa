
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Payment Invoice</title>
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/admin/css/master_style.css?var=1.9&time=<?=time();?>">
    <style>

      @import url('https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;700&display=swap');

      .br1{
        border: 1px solid #eee;
      }
      .main-box {
          min-height: 300px;
          max-width: 1000px;
          margin: auto;
          padding: 30px;
          border-radius: 10px;
          /*box-shadow: 0 0 10px rgba(0, 0, 0, .15);*/
          font-size: 16px;
          line-height: 24px;
          font-family: 'DM Sans', sans-serif;
          color: #181818;
      }

      .invoice-box {
          min-height: 300px;
          max-width: 1000px;
          margin: auto;
          padding: 30px;
          border-radius: 10px;
          line-height: 24px;
          color: #181818;
      }
      
      .invoice-box table {
          width: 100%;
          line-height: inherit;
          text-align: left;
      }

      .pwf{
        text-align: center;
        padding: 200px 0 0;
      }
      
      .invoice-box table td {
          padding: 5px;
          vertical-align: top;
      }
      
      .invoice-box table tr td:nth-child(2) {
          text-align: right;
      }
      
      .invoice-box table tr.top table td {
          padding-bottom: 20px;
      }
      
      .invoice-box table tr.top table td.title {
          font-size: 45px;
          line-height: 45px;
          color: #333;
      }
      
      .invoice-box table tr.information table td {
          padding-bottom: 40px;
      }
      
      .invoice-box table tr.heading td {
          background: #fafafa;
          border-bottom: 1px solid #f1f1f1;
          font-weight: bold;
      }
      
      .invoice-box table tr.details td {
          padding-bottom: 20px;
      }
      
      .invoice-box table tr.item td{
          border-bottom: 1px solid #eee;
      }
      
      .invoice-box table tr.item.last td {
          border-bottom: none;
      }
      
      .invoice-box table tr.total td:nth-child(2) {
          border-top: 2px solid #eee;
          font-weight: bold;
      }

      .brd-30{
        border-radius: 30px;
      }

      .p-10{
        padding: 10px;
      }
      
      @media only screen and (max-width: 600px) {
          .invoice-box table tr.top table td {
              width: 100%;
              display: block;
              text-align: center;
          }
          
          .invoice-box table tr.information table td {
              width: 100%;
              display: block;
              text-align: center;
          }
      }
      
      /** RTL **/
      .rtl {
          direction: rtl;
          font-family: 'DM Sans', sans-serif;
      }
      
      .rtl table {
          text-align: right;
      }
      
      .rtl table tr td:nth-child(2) {
          text-align: left;
      }
    </style>
</head>

<body>

  <div class="main-box">
    
   
    <div class="invoice-box print_area <?php if(isset($page_title) && $page_title != 'Export'){echo "br1 shadow-lg";} ?>">

        <table cellpadding="0" cellspacing="0">
            <tr class="top">
                <td colspan="3">
                    <table>
                        <tr>
                            <td class="title">
                                <img src="<?php echo base_url(settings()->logo) ?>" style="width:100%; max-width:200px;">
                            </td>
                            
                            <td>

                                <?php echo trans('invoice') ?> - <?php echo html_escape(sprintf('%02d', $user->id)) ?><br>
                                <?php echo trans('order').' '.trans('no') ?>: <?php echo html_escape($user->puid) ?> <br> 
                                <?php echo trans('date') ?>: <?php echo my_date_show($user->created_at) ?>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            
            <tr class="information">
                <td colspan="3">
                    <table>
                        <tr>
                            <td>
                                <?php echo html_escape(settings()->site_name) ?><br>
                                <?php echo html_escape(settings()->admin_email) ?>
                            </td>
                            
                            <td>
                                <strong><?php echo html_escape($user->user_name) ?></strong><br>
                                  <p class="mb-0"><?php echo html_escape($user->email) ?></p>
                                <?php if (!empty($user->phone)): ?>
                                  <p class="mb-0"><?php echo html_escape($user->phone) ?></p>
                                <?php endif ?>
                                <?php if (!empty($user->address)): ?>
                                  <p class="mb-0"><?php echo strip_tags($user->address) ?></p>
                                <?php endif ?>
                                
                                <?php if ($user->status == 'pending'): ?>
                                  <span class="float-right label label-light-danger brd-30" style="border-radius: 30px; padding: 8px 12px !important;"> <?php echo trans('payment') ?> - <?php echo trans('pending') ?></span>
                                <?php elseif ($user->status == 'verified'): ?>
                                  <span class="float-right label label-light-success brd-30 p-10" style="border-radius: 30px; padding: 8px 12px !important;"><?php echo trans('payment') ?> - <?php echo trans('verified') ?></span>
                                <?php endif ?>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            

            <tr class="heading">
                <td>
                    <?php echo trans('item') ?>
                </td>
                
                <td style="text-align: right">
                    <?php echo trans('price') ?>
                </td>

                <td style="text-align: right">
                    <?php echo trans('total') ?>
                </td>
            </tr>
            
            <tr class="item">
              <td>
                <?php echo html_escape($user->package_name) ?> <?php echo trans('plan') ?> / <small><?php echo trans('billing-cycle') ?> - <?php echo html_escape($user->billing_type) ?></small><br>
                
              </td>
              <td><?php echo settings()->currency_symbol; ?><?php echo html_escape($user->amount) ?></td>
              <td style="text-align: right"><?php echo settings()->currency_symbol; ?><?php echo html_escape($user->amount) ?></td>
            </tr>
            <tr class="item">
                <td></td>
                <td style="text-align: right"><strong><?php echo trans('sub-total') ?></strong></td>
                <td style="text-align: right"><span><strong><?php echo settings()->currency_symbol; ?><?php echo html_escape($user->amount) ?></strong></span></td>
            </tr>

            <tr class="total">
                <td></td>
                <td style="text-align: right"><strong><?php echo trans('total') ?></strong></td>
                <td style="text-align: right"><span><strong><?php echo settings()->currency_symbol; ?><?php echo html_escape($user->amount) ?></strong></span></td>
            </tr>

            <tr>
              <td></td>
            </tr>
            <tr>
              <td></td>
            </tr>
            <tr>
              <td></td>
            </tr>
            <tr>
              <td></td>
            </tr>

        </table>

        <div class="pwf">
          Powered by - <?php echo html_escape(settings()->site_name) ?>
        </div>
    </div>
  </div>



</body>
</html>
