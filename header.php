<!DOCTYPE html>
<html>
  <header>
  	  <title> WIN </title>
      <meta  charset="utf-8">
      <link rel="stylesheet" type="text/css" href="css/header.css">
  </header>
  <body >
  		<nav>
  			<div class="main">
  				<div class="logo">
  					<img src="logo.png">
  				</div>
          <?php
            if (isset($_SESSION['Email']))
            {
              include("Connect/conn.php");

              $mail = $_SESSION['Email'];
              
              $sql = $db->prepare("SELECT HoTen,urlavatar FROM usaccount WHERE Mail = ? or Tell = ?");
              $sql -> bindValue(1,$mail,PDO::PARAM_STR );
              $sql -> bindValue(2,$mail,PDO::PARAM_STR );
              $sql -> execute();

              $name = "";
              $urlavatar = "";
              $data = $sql->fetchAll();

              foreach ($data as $key ) 
              {
                $name = $key["HoTen"];
                $urlavatar = $key["urlavatar"];
              }
             
            ?>

  				<ul>
            <?php
            
  					 echo '<li><a href="mypage.php" style="font-size: 30px;" ><img src="'.$urlavatar.'" alt="avatar" width="35px" height="35px" align="center" />'." ".$name.'</a></li>';
            ?>
  					<li ><a href="index.php" style="font-size: 30px;"  >Trang chủ</a></li>
  					<li ><a href="login_register/logout.inc.php" style="font-size: 30px;" >Đăng xuất </a></li> 
  				</ul>
          <?php } ?>
  			</div>
  		</nav>
  </body>
 </html>

