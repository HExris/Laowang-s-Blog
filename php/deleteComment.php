<?php
	header('Content-type:text/json;charset=utf-8'); 
	error_reporting(E_ALL^E_NOTICE^E_WARNING^E_DEPRECATED);
	require_once('mysql_connect.php');
	$commentID = $_POST['commentID'];
	$articleID = $_POST['articleID'];
	// $commentID = 5;
	$deleteCommentSQL = "DELETE FROM `tb_comment` WHERE `id` = '$commentID'";
	
	if ($deleteCommentRes = mysqli_query($link,$deleteCommentSQL)) {
		$commentcountSQL = "UPDATE `tb_article` SET `comment_count`= `comment_count`-1 WHERE `id` = $articleID";
		$commentcountRes = mysqli_query($link,$commentcountSQL);
		$json = array(
			"deleteStatus" => 1
		);	
	}else{
		$json = array(
			"deleteStatus" => 0
		);	
	}
	
	echo json_encode($json);