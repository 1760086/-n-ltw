<?php ob_start(); ?>
<?php include 'header.php'; ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Đổi Mật Khẩu</title>
    <link rel="stylesheet" href="css/register-form.css">
  </head>
  <body>
  <div class="left" style="left: 40%;">
  <?php
    $selector = $_GET["selector"];
    $validator = $_GET["validator"];


    if(empty($selector) || empty($validator))
    {
      echo "Tôi khôn thể xác nhận yêu cầu của bạn!";
    }
    else{
      if(ctype_xdigit($selector) !== false && ctype_xdigit($validator) !== false){
        ?>
        <form action="includes/reset-password.inc.php" method="POST">
          <input type="hidden" name="selector" value="<?php echo $selector ?>">
          <input type="hidden" name="validator" value="<?php echo $validator ?>">

          <div class="textbox">
          <i class="fas fa-key"></i>
          <input  class="registration_form" style="width: 300px;"  type="password" placeholder="Nhập vào mật khẩu mới của bạn" name="pwd">
          </div>

          <div class="textbox">
          <i class="fas fa-key"></i>
          <input class="registration_form" style="width: 300px;"  type="password" placeholder="Nhập lại mật khẩu mới của bạn" name="pwd_repeat">
          </div>

          <input type="submit" class="submit" style="width: 200px;" value="Reset Password" name="reset-password-submit">
          <?php 
            if(isset($_GET["newpwd"])){
              if($_GET["newpwd"]=="empty"){
               echo '<p> Mật khẩu không được để trống.</p>';
              } else{
                if($_GET["newpwd"]=="pwdnotsame"){
                  echo '<p> Mật khẩu không khớp nhau. </p>';
                }
              }
            }
          ?>
        </form>

        <?php
      }
    }

  ?>
  </div>
  </body>
</html>