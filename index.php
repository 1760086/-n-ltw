
<?php session_start(); include 'header.php'; ?>
<html lang="en" dir="ltr">
  <header>
      <meta  charset="utf-8">
      <link rel="stylesheet" type="text/css" href="css/register-form.css">

      <title> WIN </title>
  </header>
  <body >
    <?php 
    if (!isset($_SESSION['Email'])){
    ?>
    <!-- form đăng nhập -->
    <div class="left" style="left: 15%;">
      <form action="login_register/login.inc.php" method="POST">
        <span style="color:#333; font-size:36px; font-family:Helvetica, Arial, sans-serif; font-weight:700;" >Đăng Nhập</span><br><br>
        <span style="color:#1d2129; font-size:19px; font-family:Helvetica, Arial, sans-serif;">Email hoặc số điện thoại: </span><br>
        <input class="registration_form" type="text"  name = "mail" ></input><br>
        <span style="color:#1d2129; font-size:19px; font-family:Helvetica, Arial, sans-serif;">Mật khẩu: </span><br>
        <input class="registration_form" type="password" name = "matkhau" ></input><br>
        <input class="submit" type="submit" name="DangNhap" value="Đăng Nhập"></input><br>
        <a href="forgotPassword.php" style="color:blue; text-decoration:none; position:relative;  top:5px; font-size: 18px;">Quên tài khoản?</a><br>
        <?php 
        if (isset($_GET['msglogin'])){ 
          echo '<a style="color:red; text-decoration:none; position:relative;  top:5px; font-size: 13px;">'.$_GET['msglogin'].'</a>';
        }?> 
      </form>
    </div>

    <!-- form đăng ký -->
    <div class="right" >
    <form action="login_register/register.inc.php" method="POST" >
      <span style="color:#333; font-size:36px; font-family:Helvetica, Arial, sans-serif; font-weight:700;" >Đăng Ký</span><br><br>

      <input class="registration_form" type="text" name="ho" placeholder="Họ"style="width:180px;"></input>
      <input class="registration_form" type="text" name = "ten" placeholder="Tên" style="width:180px;"></input><br>
      <input class="registration_form" type="text" name = "mail" placeholder="Email"style="width:397px;"></input><br>
      <input class="registration_form" type="text" name = "tell" placeholder="Số điện thoại"style="width:397px;"></input><br>
      <input class="registration_form" type="password" name = "matkhau" placeholder="Mật khẩu"style="width:397px;"></input><br><br>

      <span style="color:#1d2129; font-size:19px; font-family:Helvetica, Arial, sans-serif;">Ngày sinh</span><br><br>

      <select name = "ngay">
        <option selected disabled>Ngày</option>
        <?php for ($i = 1; $i <= 31 ; $i++) 
        { 
         echo '<option >'.$i.'</option>';
        } ?>
      </select>

      <select name = "thang">
       <option selected disabled>Tháng</option>
        <?php for ($i = 1; $i <= 12 ; $i++) 
        { 
          echo '<option >'.$i.'</option>';
       } ?>
      </select>

      <select name = "nam">
       <option selected disabled>Năm</option>
       <?php for ($i = 2019; $i >= 1905 ; $i--) 
         { 
          echo '<option >'.$i.'</option>';
        } ?>
      </select>

      <br><br><span style="color:#1d2129; font-size:19px; font-family:Helvetica, Arial, sans-serif;">Giới tính</span><br>

     <input type="radio" name = "gioitinh" value= "Nam"><label class="gender">Nam</label></input>
     <input type="radio" name = "gioitinh" valu = "Nữ"><label class="gender">Nữ</label></input>
     <br><br>
     <input class="submit" type="submit" name="register" value="Đăng Ký" > </input><br>
     <?php if (isset($_GET['msg'])) { echo '<a href="#" style="color:#FF0000; text-decoration:none; position:relative;  top:5px; font-size: 18px;">'.$_GET['msg'].'</a>';} ?>
   </form>
  </div>
  
  <?php } 
  else { ?>

  <div style="top: 100px">
    <span style="color:#333; font-size:36px; font-family:Helvetica, Arial, sans-serif; font-weight:700;" >Đăng Ký</span><br><br>
  </div>
  <?php


    $sql = $db->prepare("SELECT * FROM status ORDER BY  timeSTT DESC");
    $sql -> execute();
    $stt= $sql->fetchAll();
          
    foreach ($stt as $k )
    {
      $st = $k["status"];
      $tm = $k["timeSTT"];
      $imgstt = $k["img"];
      $usid = $k["usID"];

            
      $selectUrl = $db->prepare("SELECT urlavatar FROM usaccount WHERE ID = ?");
      $selectUrl -> bindValue(1,$usid,PDO::PARAM_STR );
      $selectUrl -> execute();

      $urlavatar="";
      $data = $selectUrl->fetchAll();
      foreach ($data as $key ) 
      {
        $urlavatar = $key["urlavatar"];
      }

      echo '
            <br><table style="width:60%;">
            <tr> 
            <td ><img src="'.$urlavatar.'" style=" width: 60px; height: 60px;"  border = 2></td>
            <td style="width:60%px">'.
            $st
            .'</td>
            <td width:200px"> - Ngày đăng: '.
            $tm
            .'</td>
            </tr>';
      if($imgstt != "non")
      {
        echo '<tr>
              <td></td>
              <td><img src="'.$imgstt.'" style=" width: 600px; height: auto;"  border = 2></td>
              <td></td>
              </tr>';
      } 

      echo '</table><br><br>';
    }
  }
  ?>

</body>
</html>