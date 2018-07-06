<?php
	//连接数据库验证账号密码
	// $mysqli = new mysqli("localhost", "root", "password"); 
    // if($mysqli)  { 
	// 	echo"php env successful"; 
    // }else{ 
    //     echo"database error"; 
    // } 
	if ($link = mysqli_connect('localhost', 'root', 'root')){
		//防止中文乱码 让数据能在更多数据库和浏览器上正常显示
		mysqli_query($link,"SET NAMES 'UTF8'"); 
		// echo "Connect Success \n";	
		if(mysqli_select_db($link,'myblog')){
			// echo "Success to Select DB \n";
		}else{
			// echo "Fail to select DB \n" . mysqli_error();
		}
	}else{
		//失败时返回请求
		die('Could not connect: ' . mysqli_connect_errno());
	}