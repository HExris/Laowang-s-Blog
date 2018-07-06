
var menu = new Vue({
	el:"#menu-btn",
	data:{
		status:false,
		line1:"line1-1",
		line2:"line2-1",
	},
	methods:{
		menuSwitch: function(){
			this.status = !this.status;
			if(this.status){
				$("#container").addClass("container-side");
				//控制按钮动画
				this.line1 = "line1";
				this.line2 = "line2";
			}else{
				$("#container").removeClass("container-side");
				//控制按钮动画
				this.line1 = "line1-1";
				this.line2 = "line2-1";
			}
		},
	}
});
//右侧菜单
var sideMenu = new Vue({
	el:"#side-menu",
	data:{
		email:"",
		github:"",
		weibo:"",
	},
	methods:{
		computedShow: function(){
			return menu.$data.status;
		}
	},
	created: function(){
		$.ajax({
			type:"post",
			url:"php/getUserInfo.php",
			async: true,
			dataType:"JSON",
			success:function(data){
				sideMenu.email = data.email;
				sideMenu.github = data.github;
				sideMenu.weibo = data.weibo;
			},
			error: function(data){
				console.log(data.status);
			}
		})
	}
});
//返回顶部
var backToTop = new Vue({
	el:"#back-top",
	data:{
		status: null
	},
	created: function(){
		window.onscroll = function(){
			if($("body").scrollTop() > 150) {
				return backToTop.$data.status = true;
			}else{
				return backToTop.$data.status = false;
			}
		}
	},
	methods:{
		scroll: function(){
			return this.status;
		},
		backTop: function(){
			//针对不同浏览器做出兼容
			window.requestAnimFrame = (function(){
			  return  window.requestAnimationFrame       ||
			          window.webkitRequestAnimationFrame ||
			          window.mozRequestAnimationFrame    ||
			          function( callback ){
			            window.setTimeout(callback, 1000 / 60);
			          };
			})();
			function back(){
				var backTop = document.body.scrollTop;
				var speed = backTop/2;
				document.body.scrollTop= backTop - speed;
				if (backTop > 0) {
				  requestAnimationFrame(back)
				}
			}
			window.requestAnimFrame(back);
		}
	}
})

// 文章模块

var article = new Vue({
	el:"#article-list",
	data:{
		articleList:[],
		comment_status : [],
		getComment : [],
		newUser:false,
	},
	methods:{
		showComment: function(index){
			console.log(index)
		},
		addComment: function(index){
			var commentValue = document.getElementById("add-comment-"+(index+1));
			if(commentValue.value){
				this.articleList[index]["0"].comment_count++;
				var articleID = this.articleList[index]['0'].articleID;
				var fullname = document.getElementById("user-info-fullname").innerText.trim();
				var id = null;
				$.ajax({
					type:"post",
					dataType:"JSON",
					url:"php/addComment.php",
					async: false,
					data:{
						articleID : articleID,
						commentValue : commentValue.value,
						fullname : fullname.trim(),
					},
					success: function(data){
						id = data.commentID;
					},
					error: function(data){
						console.log(data.status)
					}
				})
				this.articleList[index]["0"].commentList.push([id,commentValue.value,fullname,"2017-04-05"]);
				commentValue.value = "";
			}else {
				return false;
			}
		},
		deleteComment: function(index,index1){
			this.articleList[index]["0"].comment_count--;
			var articleID = this.articleList[index]["0"].articleID;
			var commentID = this.articleList[index]["0"].commentList[index1][0];
			console.log(this.articleList[index]["0"].commentList.splice(index1,1));
			console.log(commentID);
			$.ajax({
				type:"post",
				dataType:"JSON",
				url:"php/deleteComment.php",
				data:{
					articleID : articleID,
					commentID : commentID
				},
				success: function(data){
					console.log(data)
				},
				error: function(data){
					console.log(data.status)
				}
			})
		}
	},
	mounted: function(){
		function articleMaker(i){
			var simplemde = new SimpleMDE({ element: document.getElementById("article"+i),
				toolbar:false,
				autoDownloadFontAwesome: false,
				renderingConfig: {
					singleLineBreaks: true,
					codeSyntaxHighlighting: true,
				}
			 });
			simplemde.togglePreview();
		}
		setTimeout(function(){
			for (var i = 1; i <= article.articleList.length;i++) {
				articleMaker(i);
				console.log(1);
			}
		},100);
	},
})

var footer = new Vue({
	el:"footer",
	data:{
		newUser:"false"
	}
});
document.ready = function(){
//页面加载完毕后自动通过AJAX获取文章
	$.ajax({
		type:"post",
		url:"php/getArticle.php",
		async: true,
		dataType:"JSON",
		success:function(data){
			var len = data.count;
			var start = 0;
			if (len) {
				for (var i = 0;i < len ;i++) {
					var temp = [];
					temp.push({
						articleID:data.article_id[i],
						title: data.title[i], 
						author: data.author, 
						time:data.time[i],
						content: data.content[i],
						tag:data.tag[i],
						comment_count: data.comment_count[i],
						comment_status: false,
						commentList : []
					})
					article.articleList.push(temp);
					article.comment_status.push(false);
					article.getComment.push(false);
					if (i === 0) {
						start = 0;
					}else{
						start += Number(data.comment_count[i-1]);
					}
					// console.log("start:"+start);
					// console.log("length:"+Number(data.comment_count[i]));
					for (var j = start ; j < start+Number(data.comment_count[i]); j++) {
						article.articleList[i]["0"].commentList.push(data.comment[j]);
					}
				}	
			}else {
				article.newUser = true;
				footer.newUser = true;	
			}
			setTimeout(function(){
				menu.status = true;
				$("#container").addClass("container-side");
					//控制按钮动画
				menu.line1 = "line1";
				menu.line2 = "line2";
			},1500);
		},
		error: function(){
			console.log("error");
		}
	});
	$("#logout").click(function() {
		$("body").addClass("zoomOut");
		setTimeout(function(){
			$.get("php/logout.php", { action: "logout" }, function() {
				window.location.reload();
			});
		},600);
	})
	$("#edit-info").click(function() {
		$("body").addClass("zoomOut");
		window.location.href = "userspace.php";
	})
	$("#write").click(function() {
		$("body").addClass("zoomOut");
		window.location.href = "editor.php";
	})
}
