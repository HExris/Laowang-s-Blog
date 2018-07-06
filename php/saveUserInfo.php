<?php
	header('Content-type:text/json;charset=utf-8'); 
	error_reporting(E_ALL^E_NOTICE^E_WARNING^E_DEPRECATED);	
	include 'mysql_connect.php';
	session_start();
	$username = $_SESSION["username"];
	// echo $username;
	$birthday = $_POST["birthday"];
	$sex = $_POST["sex"];
	$blogName = $_POST["blogName"];
	$introduce = $_POST["introduce"];
	$description = $_POST["description"];
	$address = $_POST["address"];
	$email = $_POST["email"];
	$github = $_POST["github"];
	$weibo = $_POST["weibo"];
	// $birthday = "2017-12-1";
	// $sex = "男";
	// $blogName = "freedom";
	// $introduce = "i m you";
	// $description = "nothing";
	// $address = "shenzhen city nanshan";
	// $email = "864123319@qq.com";
	// $github = "hexris";
	// $weibo = "weibo";

	$userInfoSQL = "UPDATE `tb_user` SET `brithday`= '$birthday',`sex`='$sex',`address`='$address',`email`='$email',`introduce`='$introduce',`description`='$description',`github`='$github',`weibo`='$weibo',`blog_name`='$blogName' WHERE username='$username'";
	if ($userInfoRes = mysqli_query($link,$userInfoSQL)) {
		$json = array(
			'status' => 1
		);
	}else{
		$json = array(
			'status' => 0
		);
	}
	echo json_encode($json);