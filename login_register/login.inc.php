<?php
	ob_start(); 
  session_start();
	if(isset($_POST['DangNhap']))
	{
		if(trim($_POST['mail']) != "" && trim($_POST['matkhau']) != "" )
		{
			include("../Connect/conn.php");

			$mail = $_POST['mail'];
			$matkhau = $_POST['matkhau'];

        	$sql = $db->prepare("SELECT MatKhau FROM usaccount WHERE Mail = ? or Tell = ?");
        	$sql -> bindValue(1,$mail,PDO::PARAM_STR );
        	$sql -> bindValue(2,$mail,PDO::PARAM_STR );
        	$sql -> execute();

        	$data = $sql->fetchAll();
        	foreach ($data as $key ) 
        	{
          		$pw = $key["MatKhau"];
          
          		if(password_verify($matkhau,$pw))
          		{
          			$_SESSION['Email'] = $mail;
            		header('Location: ../index.php');
            		die();
           		}
          		else
          		{
                $msg = "Email, số điện thoại hoặc mật khẩu không chính xác ";
                header('Location: ../index.php?msglogin='.$msg);
                die();
          		}
        	}
		}
		else
		{
			$msg = "Email, số điện thoại hoặc mật khẩu không thể để trống";
      header('Location: ../index.php?msglogin='.$msg);
      die();
		}
	}
	else
	{
		header("Location: ../index.php");
	}
?>