<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Verification</title>
    <style>
        body { background-color: #f4f4f4; font-family: Arial, sans-serif; text-align: center; padding: 20px; }
        .container { background-color: #ffffff; padding: 20px; border-radius: 10px; max-width: 500px; margin: auto; box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1); }
        .logo img { max-width: 150px; height: auto; margin-bottom: 20px; }
        .header { font-size: 24px; font-weight: bold; color: #333; }
        .message { font-size: 16px; color: #555; margin: 20px 0; }
        .code-box { background-color: #007bff; color: #fff; padding: 15px 20px; font-size: 22px; font-weight: bold; border-radius: 5px; display: inline-block; margin-top: 10px; }
        .footer { color: #999; font-size: 12px; margin-top: 20px; }
    </style>
</head>
<body>
<div class="container">
    <a href="<?= base_url() ?>" class="logo">
        <img src="<?= base_url(settings()->logo) ?>" alt="Site Logo">
    </a>
    <div class="header">Email Verification</div>
    <p class="message">
        Thank you for registering on <strong><?= settings()->site_name ?></strong>.<br>
        Please use the code below to verify your email:
    </p>
    <div class="code-box"><?= $verification_code ?></div>
    <p class="message">If you did not request this, please ignore this email.</p>
    <p class="footer">&copy; <?= date("Y") ?> <?= settings()->site_name ?>. All rights reserved.</p>
</div>
</body>
</html>
