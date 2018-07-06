<?php
	header('Content-type:text/json charset=utf8'); 
	error_reporting(E_ALL^E_NOTICE^E_WARNING^E_DEPRECATED);
	require_once 'mysql_connect.php';
	session_start();
	$articleID = $_POST['article_id'];
//	$articleID = 1;
	$searchCommentList = "SELECT * FROM `tb_comment` WHERE `article_id`='$articleID'";
	if($searchCommentListRes = mysqli_query($link,$searchCommentList)){
		$commentCount = mysqli_num_rows($searchCommentListRes);
	}
	//声明评论数组
	$commentContent = [];
	$commentAuthor = [];
	$commentTime = [];
	//遍历文章数组获取数据
	for($i = 0;$i<$commentCount;$i++){
		$searchCommentListRow[i] = mysqli_fetch_array($searchCommentListRes);
		array_push($commentContent,$searchCommentListRow[i][1]);
		array_push($commentAuthor,$searchCommentListRow[i][3]);
		array_push($commentTime,$searchCommentListRow[i][4]);
	}
//	//声明创建JSON对象
	$json= array (
		'comment_count' => $commentCount,
		'comment_content'   => $commentContent,
		'author'  => $commentAuthor,
		'time'    => $commentTime,
	);
//	//返回JSON对象
	echo json_encode($json);
?>