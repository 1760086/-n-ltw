<?php 
ob_start();

include "../PHPMailer/src/PHPMailer.php";
include "../PHPMailer/src/Exception.php";
include "../PHPMailer/src/OAuth.php";
include "../PHPMailer/src/POP3.php";
include "../PHPMailer/src/SMTP.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if(isset($_POST["reset-submit"])){

	$selector = bin2hex(random_bytes(8));
	$token = random_bytes(32);

	$url = "http://localhost:8637/LTW/resetPassword.php?selector=".$selector."&validator=".bin2hex($token);

	$expires = date("U") + 1800;

	include("../Connect/conn.php");

	$userEmail = $_POST["email"];

	$row =$db->exec( "DELETE FROM pwdReset WHERE pwdResetEmail= '$userEmail'");

	$hashedToken = password_hash($token, PASSWORD_DEFAULT);
	$row = $db->exec("INSERT INTO pwdReset(pwdResetEmail,pwdResetSelector,pwdResetToken,pwdResetExpires) VALUES ('$userEmail','$selector', '$hashedToken','$expires')");

	$to= $userEmail;

	$message = '<p>chung tôi đã gửi một link đặt lại mật khẩu cho bạn, hãy dùng nó để đặt lại mật khẩu cho bạn.</p>';
	$message .= '<p> Đây là link reset mật khẩu của bạn: </br>';
	$message .='<a href="'.$url.'">'.$url.'</a></p>';


	$mail = new PHPMailer(true);

	$mail->SMTPDebug = 2;
	$mail->isSMTP();

	$mail->Host = 'smtp.gmail.com';
	$mail->SMTPAuth = true;
	$mail->Username = 'facebookfake.1760086@gmail.com';
	$mail->Password = 'Facebook0123';
	$mail->SMTPSecure = 'tls';
	$mail->Port = 587;

	$mail->Charset = 'UTF-8';
	$mail->setFrom('lntkien.17ck1@gmail.com','Win');
	$mail->addAddress($to);

	$mail->isHTML(true);
	$mail->Subject = 'Win';
	$mail->Body = $message;
	$mail->AltBody ='';

	$mail->send();

	header("Location: ../forgotPassword.php?reset=success");
}
else
{
	header("Location: ../index.php");
}
