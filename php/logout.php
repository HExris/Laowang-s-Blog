<?php
//	header('Content-type:text/json;charset=utf-8'); 
	error_reporting(E_ALL^E_NOTICE^E_WARNING^E_DEPRECATED);	
	if($_GET['action'] == "logout"){
//	unset($_SESSION['userid']);
	session_start();
	$_SESSION["username"] = "";
	$_SESSION["fullname"] = "";
	$_SESSION["logout"] = true;
	unset($_SESSION["username"]);
	unset($_SESSION["fullname"]);
	session_destroy();
//	echo "<script>alert('注销成功')</script>";
	exit();
	}