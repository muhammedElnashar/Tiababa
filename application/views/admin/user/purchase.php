
<?php $settings = get_settings(); ?>
<?php
    $paypal_url = ($settings->paypal_mode == 'sandbox')?'https://www.sandbox.paypal.com/cgi-bin/webscr':'https://www.paypal.com/cgi-bin/webscr';
    $paypal_id= html_escape($settings->paypal_email);
?>

<div class="content-wrapper">
    <div class="content">
        <div class="container text-center">
            <div class="row">
                <div class="col-md-12">
                    
                    <div class="pay-boxss">

                        <?php if ($billing_type == 'monthly'): ?>
                            <?php 
                                $price = round($package->monthly_price); 
                                $frequency = 'Per month';
                                $billing_type = 'monthly';
                            ?>
                        <?php else: ?>
                            <?php 
                                $price = round($package->price); 
                                $frequency = 'Per year';
                                $billing_type = 'yearly';
                            ?>
                        <?php endif ?>


                        <div class="tabbable-panel mt-20">
                            <div class="tabbable-line">
                                <ul class="nav nav-pills mb-3 mt-5 justify-content-center" id="pills-tab" role="tablist">
                                    <?php if (settings()->paypal_payment == 1): ?>
                                        <li class="nav-item pi">
                                            <a href="#tab_default_1" data-toggle="tab" class="nav-link">
                                            <img width="60px" src="<?php echo base_url() ?>assets/admin/payment/paypal.svg"/> </a>
                                        </li>
                                    <?php endif ?>

                                    <?php if (settings()->stripe_payment == 1): ?>
                                        <li class="nav-item pi">
                                            <a href="#tab_default_2" data-toggle="tab" class="nav-link">
                                            <img width="50px" src="<?php echo base_url() ?>assets/admin/payment/stripe.svg"/> </a>
                                        </li>
                                    <?php endif ?>

                                    <?php if (settings()->razorpay_payment == 1): ?>
                                        <li class="nav-item pi">
                                            <a href="#tab_default_3" data-toggle="tab" class="nav-link">
                                            <img width="70px" src="<?php echo base_url() ?>assets/admin/payment/razorpay.svg"/> </a>
                                        </li>
                                    <?php endif ?>

                                    <?php if (settings()->paystack_payment == 1): ?>
                                        <li class="nav-item pi">
                                            <a class="nav-link" data-toggle="tab" href="#tab_default_4"><img width="70px" src="<?php echo base_url() ?>assets/admin/payment/paystack.svg"/></a>
                                        </li>
                                    <?php endif ?>

                                    <?php if (settings()->mercado_payment == 1): ?>
                                    <li class="nav-item pi">
                                        <a class="nav-link" data-toggle="tab" href="#tab_default_5"><img width="70px" src="<?php echo base_url() ?>assets/admin/payment/mercado_pago.svg"/></a>
                                    </li>
                                    <?php endif ?>

                                </ul> <br> <br>
                                <div class="tab-content">

                                    <div class="tab-pane container active">
                                        <div class="row">
                                            <div class="box col-md-6 m-auto">
                                                <div class="box-body text-center">
                                                    <h5 class="pt-15 pb-20"><?php echo trans('please-select-a-payment-method') ?></h5>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- paypal payment area -->
                                    <div class="tab-pane text-center" id="tab_default_1">
                                        <!-- paypal payment -->
                                        <?php if ($settings->paypal_payment == 1): ?>
                                            <div class="payment_area container" id="paypal" style="display: <?php if ($settings->paypal_payment == 1){echo "block";}else{echo "none";} ?>">
                                               <div class="row">
                                                    <div class="box col-md-8 m-auto text-center">
                                                        
                                                        <div class="box-body text-center padding-50">

                                                            <h3 class="">Paypal <?php echo trans('payment-upgrade-plan') ?></h3>
                                                            <h4 class="mb-0 text-center"><?php echo trans('plan') ?>: <?php echo html_escape($package->name);?> (<strong><?php echo html_escape($settings->currency_symbol); ?><?php echo html_escape($price) ?> <?php echo html_escape($frequency) ?></strong>)</h4><br>


                                                            <!-- PRICE ITEM -->
                                                            <form action="<?php echo html_escape($paypal_url); ?>" method="post" name="frmPayPal1">
                                                         
                                                                <input type="hidden" name="business" value="<?php echo html_escape($paypal_id); ?>" readonly>
                                                                <input type="hidden" name="cmd" value="_xclick">
                                                                <input type="hidden" name="item_name" value="<?php echo html_escape($package->name);?>">
                                                                <input type="hidden" name="item_number" value="1">
                                                                <input type="hidden" name="amount" value="<?php echo html_escape($price) ?>" readonly>
                                                                <input type="hidden" name="no_shipping" value="1">
                                                                <input type="hidden" name="currency_code" value="<?php echo html_escape($settings->currency_code);?>">
                                                                <input type="hidden" name="cancel_return" value="<?php echo base_url('admin/subscription/payment_cancel/'.$billing_type.'/'.html_escape($package->id).'/'.html_escape($payment_id)) ?>">
                                                                <input type="hidden" name="return" value="<?php echo base_url('admin/subscription/payment_success/'.$billing_type.'/'.html_escape($package->id).'/'.html_escape($payment_id)) ?>">  
                                                             
                                                                <div class="mt-30">
                                                                    <button class="btn btn-primary paypal-btn" href="#"><?php echo trans('pay-now') ?> <?php echo html_escape($settings->currency_symbol); ?><?php echo html_escape($price) ?></button>
                                                                </div>
                                                                
                                                            </form>
                                                            <!-- /PRICE ITEM -->

                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        <?php endif ?>  
                                    </div>
                                
                                    <!-- stripe payment area -->
                                    <div class="tab-pane text-center" id="tab_default_2">
                                        <!-- stripe payment -->
                                        <?php if ($settings->stripe_payment == 1): ?>
                                            <div class="payment_area container" id="stripe">
                                               <div class="row justify-content-center">
                                                    <div class="box col-md-8 m-auto text-center padding-50">

                                                        <h3 class="text-center">Stripe <?php echo trans('payment-upgrade-plan') ?></h3>
                                                        <h4 class="mb-20 text-center"><?php echo trans('plan') ?>: <?php echo html_escape($package->name);?> (<strong><?php echo html_escape($settings->currency_symbol); ?><?php echo html_escape($price) ?> <?php echo html_escape($frequency) ?></strong>)</h4><br>
                               
                                                        <div class="credit-card-box">
                                                            <h4 class="box-title text-left"><?php echo trans('payment-details') ?>
                                                                <span><img class="img-responsive pull-right mt--5" width="40%" src="<?php echo base_url('assets/images/accept-cards.jpg') ?>"></span>
                                                            </h4>
                                                            <hr>
                                                            <div class="spacer py-1"></div>

                                                            <div class="box-body p-0">
                                                
                                                                <form role="form" action="<?php echo base_url('admin/subscription/stripe_payment') ?>" method="post" class="require-validation" data-cc-on-file="false" data-stripe-publishable-key="<?php echo html_escape($settings->publish_key); ?>" id="payment-form">
                                                                    
                                                                    <div class='row'>
                                                                        <div class='col-xs-12 col-md-6 form-group required text-left'>
                                                                        </div>
                                                                        <div class='col-xs-12 col-md-6 form-group required text-left'>
                                                                        </div>
                                                                    </div>

                                                                    <div class='row'>
                                                                        <div class='col-xs-12 col-md-6 form-group required text-left'>
                                                                            <label class='control-label'><?php echo trans('name-card') ?></label> 
                                                                            <input class='textfield textfield--grey' type='text' value="" size='6'>
                                                                        </div>
                                                                        <div class='col-xs-12 col-md-6 form-group required text-left'>
                                                                            <label class='control-label'><?php echo trans('card-number') ?></label> 
                                                                            <input autocomplete='off' class='textfield textfield--grey card-number'
                                                                                type='text' value="" size='6'>
                                                                        </div>
                                                                    </div>
                                                        

                                                                    <div class='form-row row'>
                                                                        <div class='col-xs-12 col-md-4 form-group cvc required text-left'>
                                                                            <label class='control-label'>CVC</label> <input autocomplete='off'
                                                                                class='textfield textfield--grey card-cvc' placeholder='ex. 311' size='4'
                                                                                type='text' value="">
                                                                        </div>
                                                                        <div class='col-xs-12 col-md-4 form-group expiration required text-left'>
                                                                            <label class='control-label'><?php echo trans('expiration-month') ?></label> <input
                                                                                class='textfield textfield--grey card-expiry-month' placeholder='MM' size='2'
                                                                                type='text' value="">
                                                                        </div>
                                                                        <div class='col-xs-12 col-md-4 form-group expiration required text-left'>
                                                                            <label class='control-label'><?php echo trans('expiration-year') ?></label> <input
                                                                                class='textfield textfield--grey card-expiry-year' placeholder='YYYY' size='4'
                                                                                type='text' value="">
                                                                        </div>
                                                                    </div>

                                                                    <div class="text-center text-success">
                                                                        <div class="payment_loader hide"><i class="fa fa-spinner fa-spin"></i> Loading....</div><br>
                                                                    </div>
                                                             
                                                                    <!-- csrf token -->
                                                                    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">

                                                                    <input type="hidden" name="billing_type" value="<?php echo html_escape($billing_type); ?>" readonly>
                                                                    <input type="hidden" name="package_id" value="<?php echo html_escape($package->id); ?>" readonly>
                                                                    <input type="hidden" name="payment_id" value="<?php echo html_escape($payment_id); ?>" readonly>
                                                                    <div class="row">
                                                                        <div class="spacer py-2"></div>
                                                                        <div class="col-md-12">
                                                                            <button class="btn btn-primary payment_btn" type="submit"><?php echo trans('pay-now') ?> <?php echo html_escape($settings->currency_symbol); ?><?php echo html_escape($price) ?></button>
                                                                        </div>
                                                                    </div>
                                                                         
                                                                </form>
                                                            </div>
                                                        </div>        
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endif ?>      
                                    </div>


                                    <!-- razorpay payment area -->
                                    <div class="tab-pane text-center" id="tab_default_3">
                                        <!-- stripe payment -->
                                        <?php if ($settings->razorpay_payment == 1): ?>
                                            <div class="payment_area container" id="stripe">
                                               <div class="row justify-content-center">
                                                    <div class="box col-md-8 m-auto text-center padding-50">

                                                        <h3 class="text-center">Razorpay <?php echo trans('payment-upgrade-plan') ?></h3>
                                                        <h4 class="mb-20 text-center"><?php echo trans('plan') ?>: <?php echo html_escape($package->name);?> (<strong><?php echo html_escape($settings->currency_symbol); ?><?php echo html_escape($price) ?> <?php echo html_escape($frequency) ?></strong>)</h4><br>
                            
                                                        <?php
                                                            $productinfo = $package->name;
                                                            $txnid = time();
                                                            $price = $price;

                                                            $surl = base_url('admin/subscription/payment_success/'.$billing_type.'/'.html_escape($package->id).'/'.html_escape($payment_id).'/razorpay');

                                                            $furl = base_url('admin/subscription/payment_cancel/'.$billing_type.'/'.html_escape($package->id).'/'.html_escape($payment_id));

                                                            $key_id = settings()->razorpay_key_id;
                                                            $currency_code = settings()->currency_code;            
                                                            $total = ($price * 100); 
                                                            $amount = $price;
                                                            $merchant_order_id = $package->id;
                                                            $card_holder_name = user()->name;
                                                            $email = user()->email;
                                                            $phone = user()->phone;
                                                            $name = settings()->site_name;
                                                            $return_url = base_url().'razorpay/payment';
                                                        ?>

                                                        <form name="razorpay-form" id="razorpay-form" action="<?php echo $return_url; ?>" method="POST">
                                                          <input type="hidden" name="razorpay_payment_id" id="razorpay_payment_id" />
                                                          <input type="hidden" name="merchant_order_id" id="merchant_order_id" value="<?php echo $merchant_order_id; ?>"/>
                                                          <input type="hidden" name="merchant_trans_id" id="merchant_trans_id" value="<?php echo $txnid; ?>"/>
                                                          <input type="hidden" name="merchant_product_info_id" id="merchant_product_info_id" value="<?php echo $productinfo; ?>"/>
                                                          <input type="hidden" name="merchant_surl_id" id="merchant_surl_id" value="<?php echo $surl; ?>"/>
                                                          <input type="hidden" name="merchant_furl_id" id="merchant_furl_id" value="<?php echo $furl; ?>"/>
                                                          <input type="hidden" name="card_holder_name_id" id="card_holder_name_id" value="<?php echo $card_holder_name; ?>"/>
                                                          <input type="hidden" name="merchant_total" id="merchant_total" value="<?php echo $total; ?>"/>
                                                          <input type="hidden" name="merchant_amount" id="merchant_amount" value="<?php echo $amount; ?>"/>

                                                           <input type="hidden" name="billing_type" value="<?php echo html_escape($billing_type); ?>" readonly>
                                                          <!-- csrf token -->
                                                          <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
                                                        </form>

                                                        
                                                        <div class="col-12">
                                                            <div class="mt-4">
                                                                <input id="submit-pay" type="submit" onclick="razorpaySubmit(this);" value="Pay Now" class="btn btn-primary btn-md" />
                                                            </div>
                                                        </div>
                                                        <?php include APPPATH.'views/admin/include/razorpay-js.php'; ?>



                                                    </div>
                                                </div>
                                            </div>
                                        <?php endif ?>      
                                    </div>


                                    <?php if (settings()->paystack_payment == 1): ?>
                                        <div class="tab-pane text-center" id="tab_default_4">
                                           <div class="row">
                                                <div class="box col-md-8 m-auto">
                                                    
                                                    <div class="box-body text-center">
                                                        <form method="post">
                                                            <h3 class="text-center">Paystack <?php echo trans('payment-upgrade-plan') ?></h3>
                                                            <h4 class="mb-20 text-center"><?php echo trans('plan') ?>: <?php echo html_escape($package->name);?> (<strong><?php echo html_escape($settings->currency_symbol); ?><?php echo html_escape($price) ?> <?php echo html_escape($frequency) ?></strong>)</h4><br>

                                                            <script src="https://js.paystack.co/v1/inline.js"></script>
                                                            <button type="button" onclick="payWithPaystack()" class="btn btn-primary btn-md"> <?php echo trans('pay-now') ?> </button>
                                                        </form>

                                                    </div>

                                                </div>
                                            </div>
                                        </div>

                                        <?php include APPPATH.'views/admin/include/paystack-js.php'; ?>
                                    <?php endif ?> 

                     


                                    <?php if (settings()->mercado_payment == 1): ?>
                                        <div class="tab-pane text-center" id="tab_default_5">
                                           <div class="row">
                                                <div class="box col-md-8 m-auto">
                                                    <div class="box-body text-center">
                                                        <div class="payment_content text-center">
                                                            <h3 class="text-center">MercadoPago <?php echo trans('payment-upgrade-plan') ?></h3>
                                                            <h4 class="mb-20 text-center"><?php echo trans('plan') ?>: <?php echo html_escape($package->name);?> (<strong><?php echo html_escape($settings->currency_symbol); ?><?php echo html_escape($price) ?> <?php echo html_escape($frequency) ?></strong>)</h4><br>
                                                        
                                                            <a href="<?= prep_url($init); ?>" class="btn btn-primary btn-md"><?php echo trans('pay-now') ?></a>
                                                    
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endif; ?>


                                       

                                </div>
                            </div>
                        </div>

                    </div>

                </div>

            </div>
        </div>
    </div>
</div>