<?php
	header('Content-type:text/json charset=utf8'); 
	error_reporting(E_ALL^E_NOTICE^E_WARNING^E_DEPRECATED);	
	include 'mysql_connect.php';
	$username = $_POST['username'];  
	$password=$_POST['password'];
	//验证密码
	$searchUser = "SELECT * FROM `tb_user` WHERE `username`='$username'";
	if($username&&$password){
		if($searchRes = mysqli_query($link,$searchUser)){
			//查询成功
			$row = mysqli_fetch_array($searchRes);
			if($row){
				//密码是否正确
				if($password == $row[3]){
					$fullname = $row[1];
					$json = array ('status'=>1);
	//				echo "登录成功";
					session_start();//开启session
					$_SESSION['fullname'] = $fullname;
					$_SESSION['username'] = $username;
					echo json_encode($json);
				}else{
					$json= array ('status'=>0);
	//				echo "账号或密码错误";
					echo json_encode($json);
				}
			}else{
				//用户名不存在
				$json= array ('status'=>2);
	//			echo "用户名不存在";
				echo json_encode($json);
			}
		}else{
			echo mysqli_error();
		}
	}
