<!doctype html>
<html lang="en">
	<head>
		<meta charset="UTF-8" />
		<title>主页</title>
		<!-- <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css"> -->
		<link rel="stylesheet" type="text/css" href="css/font-awesome.min.css" />
		<link rel="stylesheet" type="text/css" href="css/reset.css" />
		<link rel="stylesheet" type="text/css" href="css/animate.css" />
		<link rel="stylesheet" type="text/css" href="css/index.css" />
		<link rel="stylesheet" href="css/simplemde-for-editor.css">
	</head>
	<body>
		<script type="text/javascript" src="js/canvas-nest.js"></script>
		<?php
			error_reporting(E_ALL^E_NOTICE^E_WARNING^E_DEPRECATED);
			include 'php/mysql_connect.php';
			session_start();
			$username = $_SESSION["username"];
			$userInfoSQL = "SELECT * FROM `tb_user` WHERE username = '$username'";
			$userInfoRes = mysqli_query($link,$userInfoSQL);
			$userInfoRow = mysqli_fetch_row($userInfoRes);
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
		<div class="main-container" id="container">
			<header id="header">
				<div class="header-inner">
					<div class="blog-title-box">
						<div id="blog-title">
							<div id="blog-title-text">
								<?php
									$searchUsername = $_SESSION['username'];
									$searchUser = "SELECT * FROM `tb_user` WHERE `username`='$searchUsername'";
									if($searchRes = mysqli_query($link,$searchUser)){
										//查询成功
										$row = mysqli_fetch_array($searchRes);
										if($row){
											echo $row[14];
										}else{
											echo "error";
										}
									}
								?>
							</div>
						</div>
					</div>
					<div id="blog-des">
						“<span>
							<?php
								$searchUsername = $_SESSION['username'];
								$searchUser = "SELECT * FROM `tb_user` WHERE `username`='$searchUsername'";
								if($searchRes = mysqli_query($link,$searchUser)){
									//查询成功
									$row = mysqli_fetch_array($searchRes);
									if($row){
										echo $row[11];
									}else{
										echo "error";
									}
								}
							?>
						</span> ”
					</div>
				</div>
			</header>
			<!--文章列表-->
			<div id="main">
				<ul class="article-list" id="article-list">
				<div id="user-tips" v-if="newUser">
					<template>
						<h1>
							您还没有文章，<a href="editor.php">点击</a>发布第一篇文章
						</h1>	
						<footer id="footer1">
							<div id="footer-info" >
								<span id="footer-author-time">
									©2017
								</span>
								<span class="love">
									<i class="fa fa-heart">
									</i>
								</span>
								<span id="footer-author-nickname">
									<?php
										echo $_SESSION['fullname'];
									?>
								</span>
							</div>
						</footer>
					</template>
				</div>
					<template>
					<li v-for="(item,index) in articleList" class="article-item">
						<div class="article-title">
							<h1 v-text="item['0'].title"></h1>
						</div>
						<div class="article-time-box">
							<div class="article-time" v-text="'发布于 '+item['0'].time">
								<span></span>
							</div>
						</div>
						<div class="pre-article">
							<textarea v-text="item['0'].content" v-bind:id="'article'+(index+1)"></textarea>
						</div>
						<div class="show-comment">
							<span v-text="' '+item['0'].comment_count>0?item['0'].comment_count+' 条评论':''" v-on:click="showComment(index)"></span>
						</div>
						<div class="comment" v-for="(item1,index1) in item['0'].commentList">
							<transition  name="fade">
								<div class="comment-box">
									<div class="comment-author">
										{{item['0'].commentList[index1][2]}}
									</div>
									<div class="comment-content">
										<span>:</span>
										{{item['0'].commentList[index1][1]}}
									</div>
									<div class="delete" v-on:click="deleteComment(index,index1)">
										X
									</div>
								</div>
							</transition>
						</div>
						<div class="add-comment">
							<input type="text" class="add-comment-input" :id="'add-comment-'+(index+1)"/>
							<div class="add-btn" v-on:click="addComment(index)">评论</div>
						</div>
						<footer><span class="post-eof"></span></footer>
					</li>
					</template>
				</ul>
			</div>
			<!--菜单开关-->
			<div class="floatBtn" id="menu-btn" @click="menuSwitch">
				<div class="line-box">
					<span class="line" v-bind:id="line1"></span>
					<span class="line"></span>
					<span class="line" v-bind:id="line2"></span>
				</div>
			</div>
			<!--右侧菜单-->
			<transition id="side-menu" name="slide-fade">
				<div v-show="computedShow()" id="side-menu-inner">
					<div class="user">
						<div class="user-inner">
							<div class="user-info">
								<img src="img/2.jpg" alt="" />
								<p id="user-info-fullname">
									<?php
										session_start();
										echo $_SESSION['fullname'];
									?>
								</p>
								<p id="user-info-introduce">
									<?php
									$searchUsername = $_SESSION['username'];
									$searchUser = "SELECT * FROM `tb_user` WHERE `username`='$searchUsername'";
									if($searchRes = mysqli_query($link,$searchUser)){
									//查询成功
									$row = mysqli_fetch_array($searchRes);
										if($row){
											echo $row[10];
										}else{
											echo "error";
										}
									}
									?>
								</p>
								
							</div>
							<div class="user-action-box">
								<button class="user-action-button" id="edit-info">修改信息</button>
								<button class="user-action-button" id="write">发布博客</button>
								<button class="user-action-button" id="logout">退出登录</button>	
							</div>
							<div class="links-of-author motion-element" style="opacity: 1; display: block; transform: translateX(0px);">
								<span class="links-of-author-item" v-if="this.github">
									<a :href="this.github" target="_blank" title="GitHub">
										<i class="fa fa-fw fa-github"></i>
										GitHub
									</a>
								</span>
								<span class="links-of-author-item" v-if="this.weibo">
									<a :href="this.weibo" target="_blank" title="Weibo">
										<i class="fa fa-fw fa-weibo"></i>
										Weibo
									</a>
								</span>
								<span class="links-of-author-item" v-if="this.email">
									<a :href="'mailto:'+this.email" target="_blank" title="Email">
										<i class="fa fa-fw fa-globe"></i>
										Email
									</a>
								</span>
							</div>
						</div>
					</div>
					
				</div>
			</transition>
			<!--返回顶部-->
			<transition id="back-top" name="zoom">
				<div v-show="status" v-on:click="backTop" class="floatBtn" id="back-top-btn"><i class="fa fa-chevron-up" as></i></div>
			</transition>
			<!--底部-->
			<footer id="footer" v-if="!newUser">
				<template>
					<div id="footer-info" >
						<span id="footer-author-time">
							©2017
						</span>
						<span class="love">
							<i class="fa fa-heart">
							</i>
						</span>
						<span id="footer-author-nickname">
							<?php
								echo $_SESSION['fullname'];
							?>
						</span>
					</div>
				</template>
			</footer>
		</div>
		<script src="./js/vue.js" type="text/javascript" charset="utf-8"></script>
		<script src="./js/jquery-2.0.0.min.js"></script>
		<script src="./js/simplemde.js"></script>
		<script src="./js/index.js" type="text/javascript" charset="utf-8"></script>
	</body>
</html>