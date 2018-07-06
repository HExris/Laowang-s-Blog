<?php
	header('Content-type:text/json;charset=utf-8'); 
	error_reporting(E_ALL^E_NOTICE^E_WARNING^E_DEPRECATED);
	include 'mysql_connect.php';
	session_start();
	$username =  $_SESSION["username"];
	$userInfoSQL = "SELECT * FROM `tb_user` WHERE `username` = '$username'";
	$userInfoRes = mysqli_query($link,$userInfoSQL);
	$userInfoRow = mysqli_fetch_array($userInfoRes);
	mysqli_num_rows($userInfoRow);
	$json = array (
		'email' => $userInfoRow[7],
		'github'  => $userInfoRow[12],
		'weibo'   => $userInfoRow[13],
	);
	echo json_encode($json);