<?php
	header('Content-type:text/json;charset=utf-8'); 
	error_reporting(E_ALL^E_NOTICE^E_WARNING^E_DEPRECATED);	
	include 'mysql_connect.php';
	session_start();
	$username = $_SESSION["username"];
	$identifyUserSQL = "SELECT * FROM `tb_user` WHERE username = '$username'";
	$identifyUserRes = mysqli_query($link,$identifyUserSQL);
	$identifyUserRow = mysqli_fetch_row($identifyUserRes);
	if ($identifyUserRow[14]) {
		// 老用户
		$json = array('status' => 1, );
		echo json_encode($json);
	}else {
		// 新用户
		$json = array('status' => 0, );
		echo json_encode($json);
	}