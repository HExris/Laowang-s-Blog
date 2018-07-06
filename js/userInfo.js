var userInfo = new Vue({
	el:"#main",
	data:{
		form: {
			birthday : "",
			sex :""
	    },
		birthday : "",
		sex : '',
		blogName : "",
		introduce : "",
		description : "",
		address : "",
		email : "",
		github : "",
		weibo : "",
		newUser : 0,
		rules: {
          blogName: [
            { required: true, message: '请输入博客名称', trigger: 'change' },
            { min: 1, max: 5, message: '长度在 1 到 5 个字符', trigger: 'change' }
          ],
          birthday: [
            { type: 'date', required: true, message: '请选择日期', trigger: 'change' }
          ],
          sex: [
            { required: true, message: '请选择活动资源', trigger: 'change' }
          ],
          introduce: [
            { required: true, message: '请输入个人介绍', trigger: 'change' },
            { min: 5, max: 30, message: '长度在 5 到 30 个字符', trigger: 'change' }
          ],
          description: [
            { required: true, message: '请输入座右铭', trigger: 'change' },
            { min: 3, max: 30, message: '长度在 3 到 5 个字符', trigger: 'change' }
          ],
          email:[
          	{ required: true, message: '请输入邮箱地址', trigger: 'change'},
          	{ type:'email', message: '请正确的邮箱', trigger: 'change'},
          ],
          github:[
          	{ required: true, message: '请输入Github主页地址', trigger: 'change'},
          	{ type:'string', message: '请正确的邮箱', trigger: 'change'},
          ],
          weibo:[
          	{ required: true, message: '请输入微博主页地址', trigger: 'change'},
          	{ type:'string', message: '请正确的邮箱', trigger: 'change'},
          ],
        }
	},
	methods:{
		onSubmit: function() {
			// 验证表单
			if(document.getElementsByClassName("el-form-item__error")['0']||(this.sex&&this.blogName&&this.birthday&&this.introduce&&this.description&&this.email) == false){
				if((this.sex&&this.blogName&&this.birthday&&this.introduce&&this.description&&this.email) == false){
					var str =  "请输入必填项！";
					this.warmingTips(str);
				}else {	
					var str = "请输入正确的信息！";
					this.warmingTips(str);
				}
			}else {
			// 提交信息
				$.ajax({
					type:"post",
					url:"php/saveUserInfo.php",
					dataType:"JSON",
					async: true,
					data:{
						birthday : userInfo.birthday,
						sex : userInfo.sex,
						blogName : userInfo.blogName,
						introduce : userInfo.introduce,
						description : userInfo.description,
						address : userInfo.address,
						email : userInfo.email,
						github : userInfo.github,
						weibo : userInfo.weibo
					},
					success: function(data){
						switch (data.status) {
							case 1:
								userInfo.successTips();
								var time = setTimeout(function(){
									window.location.href = "index.php";
								},3000);
								time;
								break;
							case 0:
								userInfo.errorTips();
								break;
						}
					},
					error: function(data){
						console.log(data.status)
					}
				});
			}
    	},
    	// 同步Vue实例中数据
    	blogNameChange: function(val){
    		this.blogName = val;
    	},
    	dateChange: function(val){
    		this.birthday = val;
    	},
    	sexChange: function(val){
    		this.sex = val;
    	},
    	introduceChange: function(val){
    		this.introduce = val;
    	},
    	descriptionChange: function(val){
    		this.description = val;
    	},
    	emailChange: function(val){
    		this.email = val;
    	},
    	githubChange: function(val){
    		this.github = val;
    	},
    	weiboChange: function(val){
    		this.weibo = val;
    	},
    	// 取消录入
    	cancel: function(){
    		$.get("php/logout.php", { action: "logout" }, function() {
				window.location.reload();
			});
    	},
    	back: function(){
    		window.location.href = "index.php";
    	},
    	// ELEMENT 提示框
	    successTips() {
	        this.$message.success('修改信息成功');
	    },
	    errorTips() {
	        this.$message.error('服务器出错了哦');
	    },
	    warmingTips(str) {
	        this.$message.error(str);
	    }
	},
	created(){
		(function(){
			$.ajax({
				type:"post",
				url:"php/identifyNewUser.php",
				async:true,
				success:function(data){
					switch (data.status) {
						case 1:
							userInfo.newUser = 0;
							break;
						case 0:
							userInfo.newUser = 1;
							break;
					}
				},
				error:function(){

				}
			})
		})();
	}

});