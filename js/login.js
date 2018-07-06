var sign = new Vue({
	el:"#sign-form",
	data:{
		signFullname: "",
		signUsername: "",
		signPassword: "",
		fullnameTips: "请输入合法的姓名",
		fullnameStatus: false,
		usernameTips: "请输入合法的用户名",
		usernameStatus: false,
		passwordTips: "请输入合法的密码",
		passwordStatus: false,
		apiUrl:"php/addUser.php"
	},
	methods: {
		submitSign: function(){
			if(this.signFullname === "" || this.signFullname.length < 2 ||this.fullnameStatus){
				$("#sign-fullname").focus();
				this.signError(this.fullnameTips);
				return false;
			}else if(this.signUsername === "" || this.signUsername.length < 5||this.usernameStatus){
				$("#sign-username").focus();
				this.signError(this.usernameTips);
				return false;
			}else if(this.signPassword === "" || this.signPassword.length < 6||this.passwordStatus){
				$("#sign-password").focus();
				this.signError(this.passwordTips);
				return false;
			}else if(this.fullnameStatus===this.passwordStatus===this.usernameStatus===false){
				$.ajax({  
	                type:"POST",  
	                url:"php/addUser.php",  
	                dataType:"JSON",  
	                async: true,
	                //指定数据类型
	                data:{  
	                	"fullname":this.signFullname,
	                    "username":this.signUsername,  
	                    "password":this.signPassword,  
	                },  
	                success:function(data){
	                	console.log(data.status);
	                    switch(data.status){  
	                        case 0://用户已存在  
	                            signError("用户名已存在，请换一个用户名试试~");
	                            var timer = setTimeout(function(){
	                            	$("#exist").fadeOut();
	                            },2000);
	                            break;  
	                        case 1://注册成功
                        	   sign.signSuccess("注册成功，正在跳转！");
	                            var timer = setTimeout(function(){
	                            	window.location.href="index.php";  
	                            },2000);
	                            break;  
	                    }  
////						console.log(data)
	                },
	                error:function(data){
	                	alert("服务器响应错误，注册失败！"); 
	                	console.log(data)
	                }
	           });
			}else{
				$("#sign-password").focus();
				this.signError('请输入正确信息！');
				return false;
			}
		},
		fullnameCheck: function(){
			var reg = /[\u4e00-\u9fa5]/gm;
			var result = this.signFullname.match(reg);
			if (!this.signFullname) {
				this.fullnameStatus = false;
				console.log(1)
			}else if (result&&result.length >= 2) {
				this.fullnameStatus = false;
			}else{
				this.fullnameStatus = true;
			}
			// console.log(result);
		},
		usernameCheck: function(){
			var reg = /^[a-z0-9]+$/i;
			var result = this.signUsername.match(reg);
			if (!this.signUsername) {
				this.usernameStatus = false;
			}else if (result&&result[0].length >= 5) {
				this.usernameStatus = false;
			}else{
				this.usernameStatus = true;
			}
		},
		passwordCheck: function(){
			var reg = /^(?![a-zA-z]+$)(?!\d+$)(?![!@#$%^&*]+$)[a-zA-Z\d!@#$%^&*]+$/;
			var result = this.signPassword.match(reg);
			if (!this.signPassword) {
				this.passwordStatus = false;
			}else if (result&&result[0].length >= 6) {
				this.passwordStatus = false;
			}else{
				this.passwordStatus = true;
			}
			console.log(result);
		},
		signError: function(msg){
			this.$notify.error({
	          title: '错误',
	          message: msg
	        });
		},
		signSuccess: function(msg){
			this.$notify.success({
	          title: '成功',
	          message: msg
	        });
		},
	}
})
var login = new Vue({
	el:"#login-form",
	data:{
		loginUsername: "",
		loginPassword: "",
		apiUrl:"php/addUser.php",
		case0:"账号或密码错误，请重新登录~",
		case1:"登录成功,正在跳转！",
		case2:"用户名不存在"
	},
	methods:{
		submitLogin: function(){
			var timer = setTimeout(function(){
				$("#if-blank").fadeOut();
			},3000);
			if(this.loginUsername == ""){
				$("#login").focus();
				this.loginError("用户名不能为空");
				return false;
			}else if(this.loginPassword == ""){
				$("#sign-username").focus();
				this.loginError("密码不能为空");
				return false;
			}else{
				$.ajax({  
	                type:"POST",  
	                url:"php/loginProcess.php",  
	                dataType:"JSON",  
	                async: true,
	                //指定数据类型
	                data:{  
	                    "username":this.loginUsername,  
	                    "password":this.loginPassword,  
	                },  
	                success:function(data){
	                	console.log(data.status);
	                    switch(data.status){  
	                        case 0://账号或密码错误  
	                        	login.loginError(login.case0);
	                            break;  
	                        case 1://登录成功
	                        	login.loginSuccess(login.case1);
	                        	window.location.href = 'index.php';
	                            break;  
	                        case 2:
	                            login.loginError(login.case2);
	                        	break;
	                    }  
//						console.log(data)
	                },
	                error:function(data){
	                	alert("服务器响应错误，注册失败！"); 
	                	console.log(data)
	                }
	           });
			}
		},
		loginError: function(msg){
			this.$notify.error({
	          title: '登录失败',
	          message: msg
	        });
		},
		loginSuccess: function(msg){
			this.$notify.success({
	          title: '登录成功',
	          message: msg
	        });
		}
	}
})
