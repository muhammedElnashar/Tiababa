
<?php if (settings()->enable_wallet == 1): ?>
    <?php
        $paypal_url = ($settings->paypal_mode == 'sandbox')?'https://www.sandbox.paypal.com/cgi-bin/webscr':'https://www.paypal.com/cgi-bin/webscr';
        $paypal_id= html_escape($settings->paypal_email);

        $paypal_payment = settings()->paypal_payment;
        $stripe_payment = settings()->stripe_payment; 
        $razorpay_payment = settings()->razorpay_payment; 
        $paystack_payment = settings()->paystack_payment; 
        $mercado_payment = settings()->mercado_payment; 
        $currency_symbol = settings()->currency_symbol;
        $currency_code = settings()->currency_code;

        $razorpay_key_id = settings()->razorpay_key_id

    ?>
<?php else: ?>
    <?php
        $paypal_url = ($user->paypal_mode == 'sandbox')?'https://www.sandbox.paypal.com/cgi-bin/webscr':'https://www.paypal.com/cgi-bin/webscr';
        $paypal_id = html_escape($user->paypal_email);

        $paypal_payment = $user->paypal_payment;
        $stripe_payment = $user->stripe_payment; 
        $razorpay_payment = $user->razorpay_payment; 
        $paystack_payment = $user->paystack_payment; 
        $mercado_payment = $user->mercado_payment;  
        $currency_symbol = currency_symbol($user->currency);
        $currency_code = $user->currency;

        $razorpay_key_id = $user->razorpay_key_id
    ?>
<?php endif ?>

<?php $price = evisit_settings($user->id)->price; ?>


<div class="content-wrapper">
    <div class="content">
        <div class="container text-center">
            <div class="row">
                <div class="col-md-12">
                    
                    <div class="pay-boxss">


                        <div class="tabbable-panel mt-20">
                            <div class="tabbable-line">
                                
                                <ul class="nav nav-pills mb-3 mt-5 justify-content-center" id="pills-tab" role="tablist">
                                    <?php if ($paypal_payment == 1): ?>
                                        <li class="nav-item pi">
                                            <a href="#tab_default_1" data-toggle="tab" class="nav-link">
                                            <img width="60px" src="<?php echo base_url() ?>assets/admin/payment/paypal.svg"/> </a>
                                        </li>
                                    <?php endif ?>

                                    <?php if ($stripe_payment == 1): ?>
                                        <li class="nav-item pi">
                                            <a href="#tab_default_2" data-toggle="tab" class="nav-link">
                                            <img width="50px" src="<?php echo base_url() ?>assets/admin/payment/stripe.svg"/> </a>
                                        </li>
                                    <?php endif ?>

                                    <?php if ($razorpay_payment == 1): ?>
                                        <li class="nav-item pi">
                                            <a href="#tab_default_3" data-toggle="tab" class="nav-link">
                                            <img width="70px" src="<?php echo base_url() ?>assets/admin/payment/razorpay.svg"/> </a>
                                        </li>
                                    <?php endif ?>

                                    <?php if ($paystack_payment == 1): ?>
                                        <li class="nav-item pi">
                                            <a class="nav-link" data-toggle="tab" href="#tab_default_4"><img width="70px" src="<?php echo base_url() ?>assets/admin/payment/paystack.svg"/></a>
                                        </li>
                                    <?php endif ?>

                                    <?php if ($mercado_payment == 1): ?>
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
                                        <?php if ($paypal_payment == 1): ?>
                                            <div class="payment_area container" id="paypal">
                                               <div class="row">
                                                    <div class="box col-md-8 m-auto text-center">
                                                        
                                                        <div class="box-body text-center">

                                                            <div class="box-header">
                                                                <badge class="mb-0 badge badge-pill badge-info-soft">
                                                                <?php echo trans('price') ?>: <?php echo $currency_symbol; ?><?php echo html_escape($price) ?>
                                                                </badge>
                                                            </div>

                                                            <!-- PRICE ITEM -->
                                                            <form action="<?php echo html_escape($paypal_url); ?>" method="post" name="frmPayPal1">
                                                                <input type="hidden" name="business" value="<?php echo html_escape($paypal_id); ?>" readonly>
                                                                <input type="hidden" name="cmd" value="_xclick">
                                                                <input type="hidden" name="item_name" value="Book Appointment">
                                                                <input type="hidden" name="item_number" value="1">
                                                                <input type="hidden" name="amount" value="<?php echo html_escape($price) ?>" readonly>
                                                                <input type="hidden" name="no_shipping" value="1">
                                                                <input type="hidden" name="currency_code" value="<?php echo html_escape($currency_code);?>">
                                                                <input type="hidden" name="cancel_return" value="<?php echo base_url('admin/payment/payment_cancel/'.html_escape($appointment->id)) ?>">
                                                                <input type="hidden" name="return" value="<?php echo base_url('admin/payment/payment_success/'.html_escape($appointment->id)) ?>">  
                                                             
                                                                <div class="mt-30">
                                                                    <button class="btn btn-primary paypal-btn" href="#"><?php echo trans('pay-now') ?></button>
                                                                </div>
                                                            </form>
                                                            <!-- PRICE ITEM -->

                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        <?php endif ?>  
                                    </div>
                                
                                    <!-- stripe payment area -->
                                    <div class="tab-pane text-center" id="tab_default_2">
                                        <!-- stripe payment -->
                                        <?php if ($stripe_payment == 1): ?>
                                            <div class="payment_area container" id="stripe">
                                               <div class="row justify-content-center">
                                                    <div class="box col-md-8 m-auto text-center">

                                                        <div class="box-header mb-30">
                                                            <badge class="mb-0 badge badge-pill badge-info-soft">
                                                                <?php echo trans('price') ?>: <?php echo $currency_symbol; ?><?php echo html_escape($price) ?>
                                                            </badge>
                                                        </div>
                               
                                                        <div class="credit-card-box">
                                                            <h4 class="box-title text-left">Card Details 
                                                                <span><img class="img-responsive pull-right mt--5" width="40%" src="<?php echo base_url('assets/images/accept-cards.jpg') ?>"></span>
                                                            </h4>
                                                            <hr>
                                                            <div class="spacer py-1"></div>

                                                            <div class="box-body p-0">
                                                
                                                                <form role="form" action="<?php echo base_url('admin/payment/stripe_payment') ?>" method="post" class="require-validation" data-cc-on-file="false" data-stripe-publishable-key="<?php echo html_escape($user->publish_key); ?>" id="payment-form">
                                                                    
                                                                    <div class='row'>
                                                                        <div class='col-xs-12 col-md-6 form-group required text-left'>
                                                                        </div>
                                                                        <div class='col-xs-12 col-md-6 form-group required text-left'>
                                                                        </div>
                                                                    </div>

                                                                    <div class='row'>
                                                                        <div class='col-xs-12 col-md-12 form-group required text-left'>
                                                                            <input class='textfield textfield--grey' type='text' value="" placeholder="Cardholder's Name" size='12'>
                                                                        </div>
                                                                        <div class='col-xs-12 col-md-12 form-group required text-left'>
                                                                            <input autocomplete='off' class='textfield textfield--grey card-number'
                                                                                type='text' placeholder="Card Number" value="" size='12'>
                                                                        </div>
                                                                    </div>
                                                        

                                                                    <div class='form-row row'>
                                                                        <div class='col-xs-12 col-md-5 form-group expiration required text-left'>
                                                                            <input class='textfield textfield--grey card-expiry-month' placeholder='Expiration month MM' size='2'
                                                                                type='text' value="">
                                                                        </div>
                                                                        <div class='col-xs-12 col-md-5 form-group expiration required text-left'>
                                                                            <input class='textfield textfield--grey card-expiry-year' placeholder='Expiration Year YYYY' size='4'
                                                                                type='text' value="">
                                                                        </div>
                                                                        <div class='col-xs-12 col-md-2 form-group cvc required text-left'>
                                                                            <input autocomplete='off' class='textfield textfield--grey card-cvc' placeholder='CVC' size='4'
                                                                                type='text' value="">
                                                                        </div>
                                                                    </div>

                                                                    <div class="text-center text-success">
                                                                        <div class="payment_loader hide"><i class="fa fa-spinner fa-spin"></i> Loading....</div><br>
                                                                    </div>
                                                             
                                                                    <!-- csrf token -->
                                                                    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
                                                                    
                                                                    <input type="hidden" name="appointment_id" value="<?php echo $appointment_id; ?>">
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <div class="badge badge-pill badge-warning-soft mb-4"><i class="icon-lock"></i> All transactions are secure and encrypted. Credit card information is never stored.</div>
                                                                        </div>
                                                                        <div class="spacer py-2"></div>
                                                                        <div class="col-md-12 mb-30">
                                                                            <button class="btn btn-primary payment_btn" type="submit"><?php echo trans('pay-now') ?> </button>
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
                                        <!-- razorpay payment -->
                                        <?php if ($razorpay_payment == 1): ?>
                                            <div class="payment_area container" id="stripe">
                                               <div class="row justify-content-center">
                                                    <div class="box col-md-8 m-auto text-center">

                                                        <div class="box-header mb-30">
                                                            <badge class="mb-0 badge badge-pill badge-info-soft">
                                                                <?php echo trans('price') ?>: <?php echo $currency_symbol; ?><?php echo html_escape($price) ?>
                                                            </badge>
                                                        </div>

                                                        <?php
                                                            $productinfo = 'Consultation with '.$user->name;
                                                            $txnid = time();
                                                            $price = $price;
                                                            $surl = '';
                                                            $furl = '';
                                                            $key_id = $razorpay_key_id;
                                                            $currency_code =  $currency_code;         
                                                            $total = ($price * 100); 
                                                            $amount = $price;
                                                            $merchant_order_id = $appointment->id;
                                                            $card_holder_name = get_by_id($appointment->patient_id, 'patientses')->name;
                                                            $email = get_by_id($appointment->patient_id, 'patientses')->email;
                                                            $phone = get_by_id($appointment->patient_id, 'patientses')->mobile;
                                                            $name = get_by_id($appointment->patient_id, 'patientses')->name;
                                                            $return_url = base_url().'razorpay/user_payment';
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

                                                           <input type="hidden" name="appointment_id" value="<?php echo html_escape($appointment->id); ?>">
                                                           <input type="hidden" name="currency_code" value="<?php echo html_escape($currency_code);?>">
                                                          <!-- csrf token -->
                                                          <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
                                                        </form>

                                       
                                                        <div class="mt-4 mb-10">
                                                            <button id="submit-pay" type="submit" onclick="razorpaySubmit(this);" class="btn btn-primary"> <?php echo trans('pay-now') ?></button>
                                                        </div>
                                                      
                                                        <?php include APPPATH.'views/admin/include/razorpay-user-js.php'; ?>

                               
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endif ?>      
                                    </div>

                                    <!-- paystack payment area -->
                                    <?php if ($paystack_payment == 1): ?>
                                        <?php $paystack_type = 'user'; ?>
                                        <div class="tab-pane text-center" id="tab_default_4">
                                           <div class="row">
                                                <div class="box col-md-8 m-auto">
                                                    
                                                    <div class="box-body text-center">
                                                        <form method="post">
                                                            <div class="box-header mb-30">
                                                                <badge class="mb-0 badge badge-pill badge-info-soft">
                                                                    <?php echo trans('price') ?>: <?php echo $currency_symbol; ?><?php echo html_escape($price) ?>
                                                                </badge>
                                                            </div>

                                                            <script src="https://js.paystack.co/v1/inline.js"></script>
                                                            <button type="button" onclick="payWithPaystack()" class="btn btn-primary btn-md"> <?php echo trans('pay-now') ?> </button>
                                                        </form>

                                                    </div>

                                                </div>
                                            </div>
                                        </div>

                                        <?php include APPPATH.'views/admin/include/paystack-js.php'; ?>
                                    <?php endif ?> 

                                    <!-- paystack payment area -->
                                    <?php if ($mercado_payment == 1): ?>
                                        <div class="tab-pane text-center" id="tab_default_5">
                                           <div class="row">
                                                <div class="box col-md-8 m-auto">
                                                    <div class="box-body text-center">
                                                       
                                                        <div class="box-header mb-30">
                                                            <badge class="mb-0 badge badge-pill badge-info-soft">
                                                                <?php echo trans('price') ?>: <?php echo $currency_symbol; ?><?php echo html_escape($price) ?>
                                                            </badge>
                                                        </div>

                                                        <a href="<?= prep_url($init); ?>" class="btn btn-primary"><?php echo trans('pay-now') ?></a>
                                             
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endif ?> 

                                </div>
                            </div>
                        </div>

                    </div>

                </div>

            </div>
        </div>
    </div>
</div>