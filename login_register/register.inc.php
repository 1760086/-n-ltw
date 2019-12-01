<?php
	ob_start();session_start(); 
	if(isset($_POST['register']))
	{
		if( trim($_POST['ho']) != "" && trim($_POST['ten']) != "" && trim($_POST['mail']) != "" && trim($_POST['matkhau']) != "" && isset($_POST['ngay'])
			&& isset($_POST['thang'])&& isset($_POST['nam'])&& isset($_POST['gioitinh']))
		{
			include("../Connect/conn.php");

			$ten = $_POST['ho']." ".$_POST['ten'];
			$mail = $_POST['mail'];
			$tell = $_POST['tell'];
			$matkhau = $_POST['matkhau'];
			$ngaysinh = $_POST['nam']."-".$_POST['thang']."-".$_POST['ngay'];
			$gioitinh = $_POST['gioitinh'];
			$urlavatar = "imgAvatar/avatar.jpg";
			echo $ten."   ".$mail."   ".$matkhau."   ".$ngaysinh."   ".$gioitinh;

			$pwHash = password_hash($matkhau, PASSWORD_DEFAULT);

        	$stmt = $db->prepare('INSERT INTO usaccount(HoTen, Mail,Tell, MatKhau, NgaySinh, GioiTinh,urlavatar)
									values (:HoTen, :Mail,:Tell, :MatKhau, :NgaySinh, :GioiTinh, :urlavatar)');
			$data = array('HoTen'=>$ten, 'Mail'=>$mail, 'Tell' => $tell,'MatKhau' => $pwHash, 'NgaySinh' => $ngaysinh,'GioiTinh' => $gioitinh,'urlavatar' => $urlavatar);
			$stmt->execute($data);

			$_SESSION['Email'] = $mail;
			header("Location: ../index.php");
		}
		else
		{
			$message = "Vui lòng điền đầy đủ thông tin";
			header("Location: ../index.php?msg=".$message);
		}
	}
	else
	{

		header("Location: ../index.php");
	}
?>