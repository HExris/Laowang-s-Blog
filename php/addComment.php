<?php
	header('Content-type:text/json;charset=utf-8'); 
	error_reporting(E_ALL^E_NOTICE^E_WARNING^E_DEPRECATED);	
	include 'mysql_connect.php';
	$articleID = $_POST['articleID'];
	$fullname = $_POST['fullname'];
	$commentValue = $_POST['commentValue'];
	// $articleID = 1;
	// $fullname = "HExris";
	// $commentValue = "Hi!";
	$time = date("Y-m-d");
	$addCommentSQL = "INSERT INTO `tb_comment` (`comment`, `article_id`, `comment_author`, `time`) VALUES ('$commentValue',$articleID,'$fullname','$time')";
	if ($addCommentRes = mysqli_query($link,$addCommentSQL)) {
		$commentID = mysqli_insert_id();
		$updateCountSQL = "UPDATE `tb_article` SET `comment_count` = `comment_count`+1 WHERE `id` =  $articleID";
		$updateCountRes = mysqli_query($link,$updateCountSQL);
		$json = array(
			"commentID" => $commentID
		);	
	}else{
		$json = array(
			"insertStatus" => 0
		);	
	}
	
	echo json_encode($json);