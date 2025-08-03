<?php
session_start();
error_reporting(1);

$db_config_path = '../application/config/database.php';

if (!isset($_SESSION["license_code"])) {
    $_SESSION["error"] = "Invalid purchase code!";
    header("Location: index.php");
    exit();
}

if (isset($_POST["btn_admin"])) {

    $_SESSION["db_host"] = $_POST['db_host'];
    $_SESSION["db_name"] = $_POST['db_name'];
    $_SESSION["db_user"] = $_POST['db_user'];
    $_SESSION["db_password"] = $_POST['db_password'];


    /* Database Credentials */
    defined("DB_HOST") ? null : define("DB_HOST", $_SESSION["db_host"]);
    defined("DB_USER") ? null : define("DB_USER", $_SESSION["db_user"]);
    defined("DB_PASS") ? null : define("DB_PASS", $_SESSION["db_password"]);
    defined("DB_NAME") ? null : define("DB_NAME", $_SESSION["db_name"]);

    /* Connect */
    $connection = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    $connection->query("SET CHARACTER SET utf8");
    $connection->query("SET NAMES utf8");

    /* check connection */
    if (mysqli_connect_errno()) {
        $error = 0;
    } else {
        
        mysqli_query($connection, "UPDATE settings SET version = '2.1' WHERE id = 1;");

        mysqli_query($connection, "ALTER TABLE `drugs` ADD `generic_name` VARCHAR(255) NULL AFTER `name`, ADD `brand_name` VARCHAR(255) NULL AFTER `generic_name`;");
        mysqli_query($connection, "ALTER TABLE `drugs` ADD `is_admin` INT NULL DEFAULT '0' AFTER `details`;");


        mysqli_query($connection, "ALTER TABLE `users` ADD `twillo_account_sid` VARCHAR(255) NULL AFTER `is_verified`, ADD `twillo_auth_token` VARCHAR(255) NULL AFTER `twillo_account_sid`, ADD `twillo_number` VARCHAR(255) NULL AFTER `twillo_auth_token`, ADD `enable_sms_notify` VARCHAR(255) NULL DEFAULT '0' AFTER `twillo_number`, ADD `enable_sms_alert` VARCHAR(255) NULL DEFAULT '0' AFTER `enable_sms_notify`;");

        mysqli_query($connection, "ALTER TABLE `settings` ADD `twillo_account_sid` VARCHAR(255) NULL AFTER `mail_password`, ADD `twillo_auth_token` VARCHAR(255) NULL AFTER `twillo_account_sid`, ADD `twillo_number` VARCHAR(255) NULL AFTER `twillo_auth_token`, ADD `global_twilio` VARCHAR(255) NULL DEFAULT '0' AFTER `twillo_number`, ADD `global_ultramsg` VARCHAR(255) NULL DEFAULT '0' AFTER `global_twilio`, ADD `ultramsg_instance_id` VARCHAR(255) NULL AFTER `global_ultramsg`, ADD `ultramsg_token` VARCHAR(255) NULL AFTER `ultramsg_instance_id`;");

        mysqli_query($connection, "ALTER TABLE `users` ADD `enable_whatsapp_msg` INT NOT NULL DEFAULT '0' AFTER `is_verified`, ADD `ultramsg_instance_id` VARCHAR(255) NULL AFTER `enable_whatsapp_msg`, ADD `ultramsg_token` VARCHAR(255) NULL AFTER `ultramsg_instance_id`;");

        mysqli_query($connection, "ALTER TABLE `patientses` CHANGE `mobile` `mobile` VARCHAR(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NULL DEFAULT NULL;");

        mysqli_query($connection, "ALTER TABLE `settings` ADD `enable_sms_verify` INT NOT NULL AFTER `enable_email_verify`;");

        mysqli_query($connection, "ALTER TABLE `users` ADD `phone_verified` INT NULL DEFAULT '0' AFTER `email_verified`;");




        mysqli_query($connection, "ALTER TABLE `blog_category` ADD `type` VARCHAR(255) NOT NULL AFTER `name`;");
        mysqli_query($connection, "ALTER TABLE `users` ADD `about_us` TEXT NULL AFTER `about_me`;");
        mysqli_query($connection, "ALTER TABLE `users` ADD `description` TEXT NULL AFTER `about_us`, ADD `meta_tags` VARCHAR(255) NULL AFTER `description`;");
        mysqli_query($connection, "ALTER TABLE `users` ADD `custom_js` TEXT NULL AFTER `description`;");
        mysqli_query($connection, "ALTER TABLE `settings` ADD `pwa_logo` VARCHAR(155) NULL AFTER `link`, ADD `enable_pwa` INT NULL DEFAULT '0' AFTER `pwa_logo`;");

        mysqli_query($connection, "INSERT INTO `features` (`id`, `name`, `slug`, `is_limit`, `basic`, `standared`, `premium`) VALUES (NULL, 'Blogs', 'blogs', '0', '-1', '-1', '-1');");
        mysqli_query($connection, "INSERT INTO `features` (`id`, `name`, `slug`, `is_limit`, `basic`, `standared`, `premium`) VALUES (NULL, 'Services', 'services', '0', '-1', '-1', '-1');");

        mysqli_query($connection, "INSERT INTO `feature_role` (`id`, `name`, `slug`) VALUES (NULL, 'Blogs', 'blogs');");
        mysqli_query($connection, "INSERT INTO `feature_role` (`id`, `name`, `slug`) VALUES (NULL, 'Services', 'services');");



       
        $query = '';
          $sqlScript = file('sql/feature_role.sql');
          foreach ($sqlScript as $line) {
            
            $startWith = substr(trim($line), 0 ,2);
            $endWith = substr(trim($line), -1 ,1);
            
            if (empty($line) || $startWith == '--' || $startWith == '/*' || $startWith == '//') {
              continue;
            }
              
            $query = $query . $line;
            if ($endWith == ';') {
              mysqli_query($connection, $query) or die('<div class="error-response sql-import-response">Problem in executing the SQL query <b>' . $query. '</b></div>');
              $query= '';   
            }
        }

        $query = '';
          $sqlScript = file('sql/services.sql');
          foreach ($sqlScript as $line) {
            
            $startWith = substr(trim($line), 0 ,2);
            $endWith = substr(trim($line), -1 ,1);
            
            if (empty($line) || $startWith == '--' || $startWith == '/*' || $startWith == '//') {
              continue;
            }
              
            $query = $query . $line;
            if ($endWith == ';') {
              mysqli_query($connection, $query) or die('<div class="error-response sql-import-response">Problem in executing the SQL query <b>' . $query. '</b></div>');
              $query= '';   
            }
        }

        $query = '';
          $sqlScript = file('sql/service_category.sql');
          foreach ($sqlScript as $line) {
            
            $startWith = substr(trim($line), 0 ,2);
            $endWith = substr(trim($line), -1 ,1);
            
            if (empty($line) || $startWith == '--' || $startWith == '/*' || $startWith == '//') {
              continue;
            }
              
            $query = $query . $line;
            if ($endWith == ';') {
              mysqli_query($connection, $query) or die('<div class="error-response sql-import-response">Problem in executing the SQL query <b>' . $query. '</b></div>');
              $query= '';   
            }
        }


        $query = '';
          $sqlScript = file('sql/staff_role_permissions.sql');
          foreach ($sqlScript as $line) {
            
            $startWith = substr(trim($line), 0 ,2);
            $endWith = substr(trim($line), -1 ,1);
            
            if (empty($line) || $startWith == '--' || $startWith == '/*' || $startWith == '//') {
              continue;
            }
              
            $query = $query . $line;
            if ($endWith == ';') {
              mysqli_query($connection, $query) or die('<div class="error-response sql-import-response">Problem in executing the SQL query <b>' . $query. '</b></div>');
              $query= '';   
            }
        }

     

        mysqli_query($connection, "INSERT INTO `lang_values` (`type`, `label`, `keyword`, `english`) VALUES
        ('admin', 'Online Meeting', 'online-meeting', 'Online Meeting'),
        ('user', 'Enable to send booking notification message to your customers, after make a appointment.', 'enable-booking-con-title', 'Enable to send booking notification message to your customers, after make a appointment.'),
        ('user', 'Twilio Sms Settings', 'twilio-sms-settings', 'Twilio Sms Settings'),
        ('admin', 'Account SID', 'account-sid', 'Account SID'),
        ('user', 'Twilio Auth Token', 'twilio-auth-token', 'Twilio Auth Token'),
        ('admin', 'Sender Number(Twilio)', 'sender-number-tw', 'Sender Number(Twilio)'),
        ('user', 'Enable Booking Confirmation SMS', 'enable-booking-confirmation-sms', 'Enable Booking Confirmation SMS'),
        ('admin', 'Enable Globally', 'enable-globally', 'Enable Globally'),
        ('admin', 'Enable twilio for globally', 'enable-globally-twilio', 'Enable twilio for globally'),
        ('admin', 'Instance Id', 'instance-id', 'Instance Id'),
        ('admin', 'Token', 'token', 'Token'),
        ('admin', 'Whatsapp', 'whatsapp', 'Whatsapp'),
        ('user', 'Whatsapp Settings', 'whatsapp-settings', 'Whatsapp Settings'),
        ('admin', 'Ultramsg API', 'ultramsg-api', 'Ultramsg API'),
        ('admin', 'booking is confirmed at', 'booking-is-confirmed-at', 'booking is confirmed at'),
        ('admin', 'Meeting for the booked appointment', 'meeting-for-the-booked-appointment', 'Meeting for the booked appointment'),
        ('admin', 'has added at', 'has-added-at', 'has added at'),
        ('admin', 'you can join the meeting using the following link', 'join-url', 'you can join the meeting using the following link'),
        ('admin', 'SMS Verification', 'sms-verification', 'SMS Verification'),
        ('admin', 'Enable to allow smsverification for registered users.', 'sms-verify-title', 'Enable to allow smsverification for registered users.'),
        ('admin', 'Note: If you want to enable sms verification please make sure you have disabled the email verification.', 'sms-note-title', 'Note: If you want to enable sms verification please make sure you have disabled the email verification.'),
        ('admin', 'We have send a verification code in your phone.', 'sms-verified-code', 'We have send a verification code in your phone.'),
        ('admin', 'Role Permissions', 'role-permissions', 'Role Permissions'),
        ('admin', 'Bulk Import Drugs', 'bulk-import-drugs', 'Bulk Import Drugs'),
        ('admin', 'Cancel', 'cancel', 'Cancel'),
        ('admin', 'Cancelled', 'cancelled', 'Cancelled'),
        ('admin', 'About', 'about', 'About'),
        ('admin', 'About Us', 'about-us', 'About Us'),
        ('admin', 'SEO Settings', 'seo-settings', 'SEO Settings'),
        ('admin', 'Facebook', 'facebook', 'Facebook'),
        ('admin', 'Twitter', 'twitter', 'Twitter'),
        ('admin', 'Linked in', 'linked-in', 'Linked in'),
        ('admin', 'Instagram', 'instagram', 'Instagram'),
        ('admin', 'Meta tags', 'meta-tags', 'Meta tags'),
        ('admin', 'Custom JS', 'custom-js', 'Custom JS'),
        ('admin', 'PWA Settings', 'pwa-settings', 'PWA Settings'),
        ('admin', 'Enable PWA (Progressive Web Apps)', 'enable-pwa', 'Enable PWA (Progressive Web Apps)'),
        ('admin', 'Enable to allow your users to install PWA on their phone', 'enable-pwa-title', 'Enable to allow your users to install PWA on their phone'),
        ('admin', 'Image size', 'image-size', 'Image size');");
        

      /* close connection */
      mysqli_close($connection);

      $redir = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") ? "https" : "http");
      $redir .= "://" . $_SERVER['HTTP_HOST'];
      $redir .= str_replace(basename($_SERVER['SCRIPT_NAME']), "", $_SERVER['SCRIPT_NAME']);
      $redir = str_replace('updates/v2.1/', '', $redir);
      header("refresh:5;url=" . $redir);
      $success = 1;
    }

}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Doxe &bull; Update Installer</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/libs/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Nunito+Sans:400,500,600,700&display=swap" rel="stylesheet">
    <script src="assets/js/jquery-1.12.4.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

    <div class="container">
        <div class="row">
            <div class="col-md-8 col-sm-12 col-md-offset-2">

                <div class="row">
                    <div class="col-sm-12 logo-cnt">
                        <p>
                           <img src="assets/img/logo.png" alt="">
                       </p>
                       <h1>Welcome to the update installer</h1>
                   </div>
               </div>

               <div class="row">
                <div class="col-sm-12">

                    <div class="install-box">

                        <div class="steps">
                            <div class="step-progress">
                                <div class="step-progress-line" data-now-value="100" data-number-of-steps="3" style="width: 100%;"></div>
                            </div>
                            <div class="step" style="width: 50%">
                                <div class="step-icon"><i class="fa fa-arrow-circle-right"></i></div>
                                <p>Start</p>
                            </div>
                            <div class="step active" style="width: 50%">
                                <div class="step-icon"><i class="fa fa-database"></i></div>
                                <p>Database</p>
                            </div>
                        </div>

                        <div class="messages">
                            <?php if (isset($message)) { ?>
                            <div class="alert alert-danger">
                                <strong><?php echo htmlspecialchars($message); ?></strong>
                            </div>
                            <?php } ?>
                            <?php if (isset($success)) { ?>
                            <div class="alert alert-success">
                                <strong>Completing Updates ... <i class="fa fa-spinner fa-spin fa-2x fa-fw"></i> Please wait 5 second </strong>
                            </div>
                            <?php } ?>
                        </div>

                        <div class="step-contents">
                            <div class="tab-1">
                                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                                    <div class="tab-content">
                                        <div class="tab_1">
                                            <h1 class="step-title">Database</h1>
                                            <div class="form-group">
                                                <label for="email">Host</label>
                                                <input type="text" class="form-control form-input" name="db_host" placeholder="Host"
                                                value="<?php echo isset($_SESSION["db_host"]) ? $_SESSION["db_host"] : 'localhost'; ?>" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="email">Database Name</label>
                                                <input type="text" class="form-control form-input" name="db_name" placeholder="Database Name" value="<?php echo @$_SESSION["db_name"]; ?>" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="email">Username</label>
                                                <input type="text" class="form-control form-input" name="db_user" placeholder="Username" value="<?php echo @$_SESSION["db_user"]; ?>" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="email">Password</label>
                                                <input type="password" class="form-control form-input" name="db_password" placeholder="Password" value="<?php echo @$_SESSION["db_password"]; ?>">
                                            </div>

                                        </div>
                                    </div>

                                    <div class="buttons">
                                        <a href="index.php" class="btn btn-success btn-custom pull-left">Prev</a>
                                        <button type="submit" name="btn_admin" class="btn btn-success btn-custom pull-right">Finish</button>
                                    </div>
                                </form>
                            </div>
                        </div>


                    </div>
                </div>
            </div>


        </div>


    </div>


</div>

<?php

unset($_SESSION["error"]);
unset($_SESSION["success"]);

?>

</body>
</html>

