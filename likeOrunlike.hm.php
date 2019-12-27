<?php
   require_once 'functions.php';
   require_once 'init.php';
if(isset($_GET['like'])&&isset($_GET['postid']))
{
	$like = $_GET['like'];
	if($like == 1)
	{
		unlike($_GET['postid'],$currentUser['id']);
	}
	if($like == 0)
	{
		likePost($_GET['postid'],$currentUser['id']);
	}
	header('Location:home.php');
}
else
{
	header('Location:home.php');
}