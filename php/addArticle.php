<?php 
	header('Content-type:text/json;charset=utf-8'); 
	error_reporting(E_ALL^E_NOTICE^E_WARNING^E_DEPRECATED);
	include 'mysql_connect.php';
	session_start();
	$articleUsername = $_SESSION['username'];
	$articleFullname = $_SESSION['fullname'];
	$title = $_POST['title'];
	$content = $_POST['content'];
	$time = date("Y-m-d");
	$addArticleSQL = "INSERT INTO `tb_article`(`title`, `author`, `username`, `time`,`content`,`comment_count`) VALUES ('$title','$articleFullname','$articleUsername','$time','$content',0)";
	$addArticleRes = mysqli_query($link,$addArticleSQL);
	$addArticleRow = mysqli_fetch_row($addArticleRes);
	if (addArticleRow) {
		$json = array('status' => 1, );
	}else{
		$json = array('status' => 0, );
	}
	echo json_encode($json);