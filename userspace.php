<!DOCTYPE HTML>
<meta charset="utf-8">
<html lang="en">
	<head>
		<title>用户中心</title>
		<meta charset="utf-8">
		<link rel="stylesheet" href="css/reset.css">
		<link rel="stylesheet" href="css/element-ui.css">
		<link rel="stylesheet" href="css/userInfo.css">
	</head>
	<body>
		<?php
			error_reporting(E_ALL^E_NOTICE^E_WARNING^E_DEPRECATED);
			require_once 'php/mysql_connect.php';
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
			}
		?>
		<div id="loading">
			
		</div>
		<div id="main">
			<el-steps :space="100" :active="1" finish-status="success" style="text-align: center;margin-bottom: 10px">
			  <el-step title="注册" icon="plus"></el-step>
			  <el-step title="填写"  icon="loading"></el-step>
			  <el-step title="发布" style="width: 50px" icon="edit"></el-step>
			</el-steps>
			<el-form ref="form" :model="this.form" label-width="100px" id="user" :rules="rules" label-position="left">
			  <el-form-item label="博客名称" prop="blogName">
			  	<el-col  :span="11">
			    <el-input type="input" v-model="form.blogName" v-on:change="blogNameChange"></el-input>
			    </el-col>
			  </el-form-item>

			  <el-form-item label="生日" prop="birthday">
			    <el-col :span="11">
			      <el-date-picker type="date" placeholder="选择日期" v-model="form.birthday" style="width: 100%;" format="yyyy-MM-dd" v-on:change="dateChange"></el-date-picker>
			    </el-col>
			  </el-form-item>

			  <el-form-item label="性别" prop="sex">
			    <el-radio-group v-model="form.sex" @change="sexChange">
			      <el-radio label="男">男</el-radio>
			      <el-radio label="女">女</el-radio>
			    </el-radio-group>
			  </el-form-item>

			  <el-form-item label="个人介绍" :row="10" prop="introduce">
			    <el-input type="textarea" v-model="form.introduce" placeholder="简单的介绍一下自己吧" :autosize="{ minRows: 2, maxRows: 4}" @change="introduceChange"></el-input>
			  </el-form-item>

			  <el-form-item label="座右铭" prop="description">
			    <el-input type="input" v-model="form.description" placeholder="您最喜欢的一句话"  @change="descriptionChange"></el-input>
			  </el-form-item>

			  <el-form-item label="地址">
			    <el-input type="input" v-model="address" placeholder="例：广东省深圳市"></el-input>
			  </el-form-item>

			  <el-form-item label="E-mail" prop="email">
			    <el-input type="input" v-model="form.email" placeholder="例：123456@domain.com"  @change="emailChange"></el-input>
			  </el-form-item>

			  <!-- <el-form-item label="Github" prop="github"> -->
			  <el-form-item label="Github" >
			    <el-input type="input" v-model="form.github" placeholder="例：github.com/HExris"  @change="githubChange"></el-input>
			  </el-form-item>

			  <!-- <el-form-item label="微博主页" prop="weibo"> -->
			  <el-form-item label="微博主页" >
			    <el-input type="input" v-model="form.weibo" placeholder="例：weibo.com/HExris0818"  @change="weiboChange"></el-input>
			  </el-form-item>
			  
			  <el-form-item>
			    <el-button type="primary" @click="onSubmit">保存修改</el-button>
			    <el-button v-if="newUser" @click="cancel">退出</el-button>
			    <el-button v-if="!newUser" @click="back">取消</el-button>
			  </el-form-item>
			</el-form>
		</div>
		<script type="text/javascript" src="js/jquery-1.9.1.min.js"></script>
		<script type="text/javascript" src="js/ThreeWebGL.js"></script>
		<script type="text/javascript" src="js/ThreeExtras.js"></script>
		<script type="text/javascript" src="js/Detector.js"></script>
		<script type="text/javascript" src="js/RequestAnimationFrame.js"></script>
		<script id="vs" type="x-shader/x-vertex">
			varying vec2 vUv;
			void main() {
				vUv = uv;
				gl_Position = projectionMatrix * modelViewMatrix * vec4( position, 1.0 );
			}
		</script>
		<script id="fs" type="x-shader/x-fragment">
			uniform sampler2D map;
			uniform vec3 fogColor;
			uniform float fogNear;
			uniform float fogFar;
			varying vec2 vUv;
			void main() {
				float depth = gl_FragCoord.z / gl_FragCoord.w;
				float fogFactor = smoothstep( fogNear, fogFar, depth );
				gl_FragColor = texture2D( map, vUv );
				gl_FragColor.w *= pow( gl_FragCoord.z, 20.0 );
				gl_FragColor = mix( gl_FragColor, vec4( fogColor, gl_FragColor.w ), fogFactor );
			}
		</script>
		<script type="text/javascript">
			if ( ! Detector.webgl ) Detector.addGetWebGLMessage();
			// Bg gradient
			var canvas = document.createElement( 'canvas' );
			canvas.width = 32;
			canvas.height = window.innerHeight;
			var context = canvas.getContext( '2d' );
			var gradient = context.createLinearGradient( 0, 0, 0, canvas.height );
			gradient.addColorStop(0, "#1e4877");
			gradient.addColorStop(0.5, "#4584b4");
			context.fillStyle = gradient;
			context.fillRect(0, 0, canvas.width, canvas.height);
			document.body.style.background = 'url(' + canvas.toDataURL('image/png') + ')';
			// Clouds
			var container;
			var camera, scene, renderer, sky, mesh, geometry, material,
			i, h, color, colors = [], sprite, size, x, y, z;
			var mouseX = 0, mouseY = 0;
			var start_time = new Date().getTime();
			var windowHalfX = window.innerWidth / 2;
			var windowHalfY = window.innerHeight / 2;
			init();
			animate();
			function init() {
				container = document.createElement( 'div' );
				document.body.appendChild( container );
				camera = new THREE.Camera( 30, window.innerWidth / window.innerHeight, 1, 3000 );
				camera.position.z = 6000;
				scene = new THREE.Scene();
				geometry = new THREE.Geometry();
				var texture = THREE.ImageUtils.loadTexture( 'img/cloud.png' );
				texture.magFilter = THREE.LinearMipMapLinearFilter;
				texture.minFilter = THREE.LinearMipMapLinearFilter;
				var fog = new THREE.Fog( 0x4584b4, - 100, 3000 );
				material = new THREE.MeshShaderMaterial( {
					uniforms: {
						"map": { type: "t", value:2, texture: texture },
						"fogColor" : { type: "c", value: fog.color },
						"fogNear" : { type: "f", value: fog.near },
						"fogFar" : { type: "f", value: fog.far },
					},
					vertexShader: document.getElementById( 'vs' ).textContent,
					fragmentShader: document.getElementById( 'fs' ).textContent,
					depthTest: false
				} );
				var plane = new THREE.Mesh( new THREE.Plane( 64, 64 ) );
				for ( i = 0; i < 8000; i++ ) {
					plane.position.x = Math.random() * 1000 - 500;
					plane.position.y = - Math.random() * Math.random() * 200 - 15;
					plane.position.z = i;
					plane.rotation.z = Math.random() * Math.PI;
					plane.scale.x = plane.scale.y = Math.random() * Math.random() * 1.5 + 0.5;
					GeometryUtils.merge( geometry, plane );
				}
				mesh = new THREE.Mesh( geometry, material );
				scene.addObject( mesh );
				mesh = new THREE.Mesh( geometry, material );
				mesh.position.z = - 8000;
				scene.addObject( mesh );
				renderer = new THREE.WebGLRenderer( { antialias: false } );
				renderer.setSize( window.innerWidth, window.innerHeight );
				container.appendChild( renderer.domElement );
				document.addEventListener( 'mousemove', onDocumentMouseMove, false );
				window.addEventListener( 'resize', onWindowResize, false );
			}
			function onDocumentMouseMove( event ) {
				mouseX = ( event.clientX - windowHalfX ) * 0.25;
				mouseY = ( event.clientY - windowHalfY ) * 0.15;
			}
			function onWindowResize( event ) {
				camera.aspect = window.innerWidth / window.innerHeight;
				camera.updateProjectionMatrix();
				renderer.setSize( window.innerWidth, window.innerHeight );
			}
			function animate() {
				requestAnimationFrame( animate );
				render();
			}
			function render() {
				position = ( ( new Date().getTime() - start_time ) * 0.03 ) % 8000;
				camera.position.x += ( mouseX - camera.target.position.x ) * 0.01;
				camera.position.y += ( - mouseY - camera.target.position.y ) * 0.01;
				camera.position.z = - position + 8000;
				camera.target.position.x = camera.position.x;
				camera.target.position.y = camera.position.y;
				camera.target.position.z = camera.position.z - 1000;
				renderer.render( scene, camera );
			}
		</script>
		<!-- 引入组件库 -->
		<script src="js/vue.js"></script>
		<script src="js/element-ui.js"></script>
		<script src="js/userInfo.js"></script>
	</body>
</html>