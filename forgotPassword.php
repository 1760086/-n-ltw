<?php ob_start(); ?>
<?php include 'header.php';?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Reset your password</title>
    <link rel="stylesheet" href="css/register-form.css">
  </head>
  <body>
<div class="left" style="left: 40%;">
  <h1 style="width: 400px;">Reset Your Password</h1>
  <p style="width: 400px;">Một e-mail sẽ được gửi cho bạn hướng dẫn về cách đặt lại mật khẩu của bạn.</p>
  <form action="includes/reset-request.inc.php" method="POST" style="width: 400px;">
    <div class="textbox">
    <i class="fas fa-envelope" style="font-size: 35px;"></i>
    <input class="registration_form" style="width: 300px;"  type="text" placeholder="Nhập vào địa chỉ email của bạn ......" name = "email">
    </div>
    <input class="submit" style="width: 400px;" type="submit" class="btn" value="Receive new password by email" name = "reset-submit">
    <?php
    if(isset($_GET["reset"])){
      if($_GET["reset"]=="success"){
        echo '<p> check your email !</p>';
      }
    }
    ?>
  </form>

</div>
</body>
</html>