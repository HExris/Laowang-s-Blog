<?php
	header('Content-type:text/json;charset=utf-8'); 
	error_reporting(E_ALL^E_NOTICE^E_WARNING^E_DEPRECATED);
	require_once 'mysql_connect.php';
	session_start();
	$articleUsername = $_SESSION['username'];
	$articleFullname = $_SESSION['fullname'];
	$searchArticleList = "SELECT * FROM `tb_article` WHERE `username`='$articleUsername'";
	if($searchArticleListRes = mysqli_query($link,$searchArticleList)){
		$articleCount = mysqli_num_rows($searchArticleListRes);
	}
	//声明文章数组
	$articleID = [];
	$articleList = [];
	$articleTimeList = [];
	$articleTagList = [];
	$articleContentList = [];
	$articleCommentCount = [];
	$articleComment = [];
	$commentList = [];
	//遍历文章数组获取数据
	for($i = 0;$i<$articleCount;$i++){
		$searchArticleListRow[i] = mysqli_fetch_array($searchArticleListRes);
		array_push($articleID,$searchArticleListRow[i][0]);
		array_push($articleList,$searchArticleListRow[i][1]);
		array_push($articleTimeList,$searchArticleListRow[i][4]);
		array_push($articleTagList,$searchArticleListRow[i][5]);
		array_push($articleContentList,$searchArticleListRow[i][6]);
		array_push($articleCommentCount,$searchArticleListRow[i][7]);
		array_push($articleComment,$searchArticleListRow[i][8]);
	}
	for($k = 0;$k < $articleCount;$k++){
		getComments($k);
	}
	function getComments($k) {
		global $articleID;
		global $commentList;
		// echo $articleID[$k];
		$searchCommentList = "SELECT * FROM `tb_comment` WHERE `article_id`='$articleID[$k]'";
		// echo $searchCommentList;
		if($searchCommentRes = mysqli_query($link,$searchCommentList)){
			$commentsCount = mysqli_num_rows($searchCommentRes);
			// echo $commentsCount;
			// echo "\n";
			for($j = 0;$j < $commentsCount;$j++){
				$searchCommentListRow[$j] = mysqli_fetch_array($searchCommentRes);
				// echo $searchCommentListRow[$j][1];
				// echo "\n";
				// echo $searchCommentListRow[$j][3];
				// echo "\n";
				// echo $searchCommentListRow[$j][4];
				// echo "\n";
				// echo $j;
				$tempList = [];
				array_push($tempList,$searchCommentListRow[$j][0]);
				array_push($tempList,$searchCommentListRow[$j][1]);
				array_push($tempList,$searchCommentListRow[$j][3]);
				array_push($tempList,$searchCommentListRow[$j][4]);			
				array_push($commentList,$tempList);
			}
		}
	}
	// print_r($commentList);
	
	//声明创建JSON对象
	$json= array (
		'article_id' => $articleID,
		'author'  => $articleFullname,
		'count'   => mysqli_num_rows($searchArticleListRes),
		'title'   => $articleList,
		'time'    => $articleTimeList,
		'tag'     => $articleTagList,
		'content' => $articleContentList,
		'comment_count' => $articleCommentCount,
		'comment' => $commentList
	);
	//返回JSON对象
	echo json_encode($json);
?>