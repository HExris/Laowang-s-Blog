<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>博客-记录你的故事</title>
		<!--必要样式-->
		<link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon" />
		<link rel="stylesheet" href="css/reset.css" />
		<link rel="stylesheet" href="css/animate.css"/>
		<link rel="stylesheet" href="css/element-ui.css">
		<link rel="stylesheet" href="css/login.css" />
	</head>
	<body>
		<?php
			if(!empty($_GET['errno'])){
				if($_GET['errno']==0){
					echo "<script>alert('请登录！')</script>";
				}else if($_GET['errno']==1){
					session_start();
					$_SESSION["logout"] = "";
					unset($_SESSION['logout']);
					session_destroy();
				}
			}
		?>
		<div class="container demo-1">
			<div class="content">
				<div class="login-main-body">
					<div class="login-header">
						<h1>博 客</h1>
					</div>
					<div class="login-description">
						<p>记录你的故事与生活</p>
					</div>
					<div class="index-tab-navs">
						<a href="#signup" class="active" id="sign-tab">注册</a>
						<a href="#signin" class="" id="login-tab">登录</a>
						<span id="nav-tab"></span>
					</div>
					<div class="tab-box">
						<div class="view sign-up">
							<!--注册-->
							<form id="sign-form">
								<div class="group-inputs">
									<div class="name input-wrapper" id="signFullnameBox">
										<input v-model="signFullname" type="text" @input="fullnameCheck()" id="sign-fullname" placeholder="姓名 (中文至少2位)">
										<transition name="fade">
											<span class="tips" id="sign-fullname-tips" v-if="fullnameStatus" v-text="fullnameTips"></span>
										</transition>
									</div>
									<div class="username input-wrapper" id="signUsernameBox">
										<input v-model="signUsername" type="text" @input="usernameCheck()" id="sign-username" placeholder="用户名 (由英文或数字组成至少5位)">
										<transition name="fade">
											<span class="tips" id="sign-username-tips" v-if="usernameStatus" v-text="usernameTips"></span>
										</transition>
									</div>
									<div class="input-wrapper password" id="signPasswordBox">
										<input v-model="signPassword"  type="password"  @input="passwordCheck()" id="sign-password" placeholder="密码 (包含英文和数字组成至少6 位)" @keyup.enter="submitSign">
										<transition name="fade">
											<span class="tips" id="sign-password-tips" v-if="passwordStatus" v-text="passwordTips"></span>
										</transition>
									</div>
								</div>
								<input v-on:click="submitSign" type="button" id="sign" value="注册" />
							</form>
						</div>
						<!--登录-->
						<div class="view login-in">
							<form id="login-form">
								<div class="group-inputs">
									<div class="username input-wrapper">
										<input required="" type="text" class="account" id="username" placeholder="用户名" v-model="loginUsername">
									</div>
									<div class="input-wrapper password">
										<input required="" type="password"  aria-label="密码" placeholder="密码" v-model="loginPassword" @keyup.enter="submitLogin">
									</div>
								</div>
								<input type="button" id="login" value="登录" v-on:click="submitLogin"/>
							</form>
						</div>
					</div>
				</div>
				<div class="view"></div>
				<canvas id="demo-canvas" class="main-canvas"></canvas>
				<a id="powered">Powered By HExris</a>
			</div>
			<!--警告框-->
			<div class="danger alert" id="if-blank">
				<strong id="blank-msg">asd</strong>
			</div>
			<div class="warning alert" id="exist">
				<strong id="exist-msg"></strong>
			</div>
			<div class="success alert" id="success">
				<strong id="success-msg"></strong>
			</div>
		</div>
		<script src="js/TweenLite.min.js"></script>
		<script src="js/EasePack.min.js"></script>
		<script src="js/rAF.js"></script>
		<script src="js/canvas.js"></script>
		<script src="js/vue.js"></script>
		<script src="js/jquery-3.1.1.min.js"></script>
		<script src="js/loginAnimation.js"></script>
		<script src="js/element-ui.js"></script>
		<script src="js/login.js"></script>
	</body>
</html>