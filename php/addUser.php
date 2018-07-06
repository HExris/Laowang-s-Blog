<?php
	header('Content-type:text/json charset=utf-8'); 
	error_reporting(E_ALL^E_NOTICE^E_WARNING^E_DEPRECATED);	
	include('mysql_connect.php');
//	session_start();
	$fullname = $_POST['fullname'];
	$username = $_POST['username'];  
	$password = $_POST['password'];
	// $fullname = "何家";
	// $username = "Diana1";  
	// $password= "Diana123";
	if($fullname&&$username&&$password){
		$validUsernameSQL = "SELECT * FROM `tb_user` WHERE `username`='$username'";
		$addUserSQL = "INSERT INTO `tb_user`(`fullname`, `username`, `password`) VALUES ('$fullname','$username','$password')";
		//	echo $sql;
		if($validRes = mysqli_query($link,$validUsernameSQL)){
			//查询成功
			$row1 = mysqli_fetch_array($validRes);
			if($row1){
				//用户名已存在
				$json = array ('status'=>0);
				echo json_encode($json);
			}else{
				//注册成功
				$addUserRes = mysqli_query($link,$addUserSQL);
				session_start();//开启session
				$_SESSION['username'] = $username;
				$_SESSION['fullname'] = $fullname;
				$json= array ('status'=>1);
				echo json_encode($json);
			}
		}else{
			echo 'error';
			echo mysqli_error();
		}
	}
	//	echo $fullname;
	//	echo $username;
	//	echo $password;
	