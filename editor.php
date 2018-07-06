<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>写文章 - 博客</title>
		<link rel="stylesheet" href="css/editor.css">
		<link rel="stylesheet" href="css/simplemde-for-editor.css">
		<link rel="stylesheet" href="css/highlight.css">
		<link rel="stylesheet" href="css/element-ui.css">
		<link rel="stylesheet" href="css/animate.css">
		<link rel="stylesheet" href="css/font-awesome.min.css">
	</head>
	<body>
		<?php
			error_reporting(E_ALL^E_NOTICE^E_WARNING^E_DEPRECATED);
			include 'php/mysql_connect.php';
			session_start();
			$username = $_SESSION["username"];
			$userInfoSQL = "SELECT * FROM `tb_user` WHERE username = '$username'";
			$userInfoRes = mysqli_query($link,$userInfoSQL);
			$userInfoRow = mysqli_fetch_row($userInfoRes);
			var_dump(userInfoRow);
			if(!empty($_SESSION['logout'])){
				header("Location: login.php?errno=1");
				exit();
			}else if(empty($_SESSION['username'])){
				header("Location: login.php?errno=0");
				exit();
			}else if (!$userInfoRow[14]) {
				header("Location: userspace.php?errno=0");
			}
		?>
		<div id="main">
			<div class="pre-article">
				<textarea  id="article-content"></textarea>
			</div>
			<div id="user-action">
				<div id="send" v-on:click="send()"><i class="fa fa-send-o"></i>发布博客</div>	
				<div id="home" v-on:click="home()"><i class="fa fa-home"></i>返回首页</div>
				<transition name="slide-hide">
					<input type="text" id="article-title" v-show="input_show_status" v-on:blur="hide()" v-model="title" v-focus>
				</transition>
				<a id="article-title-show" v-text="title?('标题：'+title):title_tips" v-on:click="show()" v-show="tips_show_status"></a>
			</div>
		</div>
		<script src="js/jquery-2.0.0.min.js"></script>
		<script src="js/highlight.js"></script>
		<script src="js/simplemde.js"></script>
		<script src="js/vue.js"></script>
		<script src="js/element-ui.js"></script>
		<script src="js/editor.js"></script>
	</body>
</html>