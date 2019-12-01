<?php
ob_start(); 
if (isset($_POST["reset-password-submit"])){

	$selector = $_POST["selector"];
	$validator = $_POST["validator"];
	$password = $_POST["pwd"];
	$passwordRepeat = $_POST["pwd_repeat"];


	if(empty($password) || empty($passwordRepeat)){
		header("Location: ../create-new-password.php?newpwd=empty");
		exit();
	} else if($password != $passwordRepeat){
		header("Location: ../create-new-password.php?newpwd=pwdnotsame");
		exit();
	}
	$currentDate = date("U");

	include("../connect.php");

	$sql = $db->prepare("SELECT * FROM pwdreset WHERE pwdResetSelector = '$selector' AND pwdResetExpires >= '$currentDate'");
    $sql -> execute();
    $stt= $sql->fetchAll();
    $tokenBin = hex2bin($validator);

	foreach ($stt as $k )
    {
    	$tokenCheck = password_verify($tokenBin, $k["pwdResetToken"]);

    	if($tokenCheck === false)
    	{
    		echo "You need to re-submit your reset request.";
    		exit();
    	} elseif ($tokenCheck === true) {

    		$tokenEmail = $k['pwdResetEmail'];

    		$sql = $db->prepare("SELECT * FROM user WHERE mail = '$tokenEmail'");
    		$sql -> execute();
    		$user= $sql->fetchAll();

    		foreach ($user as $row )
    		{
    			$pwHash = password_hash($password, PASSWORD_DEFAULT);
    			$ID = $row['ID'];
    			$query =$db->exec("UPDATE user SET pass = '$pwHash' WHERE ID = '$ID' ");

    		}

    		$row =$db->exec( "DELETE FROM pwdReset WHERE pwdResetEmail= '$tokenEmail'");
    		header("Location: ../index?newpwd=passwordupdate");


    	}

    }


}
else
{
	header("Location: ../index.php");
}
