<?php
ob_start();
session_start();

if (isset($_SESSION['Email']))
 {
 	unset($_SESSION['Email']);
 	header('Location: ../index.php');

 }
 header('Location: ../index.php');
?>