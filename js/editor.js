Vue.directive('focus',{
  // 当绑定元素插入到 DOM 中。
  inserted: function (el) {
    // 聚焦元素
    el.focus()
  },
  update: function(el){
  	// 聚焦元素
  	el.focus()
  }
})
var article = new Vue({
	el:"#main",
	data:{
		title:"",
		title_tips:"请输入标题：",
		content:"",
		input_show_status: true,
		tips_show_status: true
	},
	methods:{
		hide: function(){
			if (this.title) {
				this.input_show_status = false;
				this.tips_show_status = true;
			} else {
				this.input_show_status = true;
				this.tips_show_status = true;
			}
		},
		show: function(){
			this.input_show_status = true;
			this.tips_show_status = true;
		},
		send: function(){
			if (!(this.title&&this.content)) {
				if (!this.title) {
					this.sendError('请输入标题！');
					this.input_show_status = true;
				} else {
					this.sendError('文章内容不能为空！');
				}
			}else {
				$.ajax({
					type:"post",
					url:"php/addArticle.php",
					async: true,
					dataType:"JSON",
					data:{
						title : this.title,
						content : this.content
					},
					success: function(data){
						if (data.status) {
							setTimeout(function(){
								window.location.href = "index.php";
							},1600);
						}else {
							this.sendError('发送失败！');
						}
					},
					error: function(data){
						console.log(data.status);
					}
				});
				document.getElementById("paper").style.left = "-50%";
				var monitor = document.getElementById("monitor");
				monitor.style.right = "50%";
				monitor.style.transform = "translateX(50%)";
				monitor.style.animationDuration = '1s';
				setTimeout(function(){
					monitor.style.animationName = 'fadeOutUpBig';
					setTimeout(function(){
						console.log(1)
					},1000);
				},650);
				this.sendSuccess("发布成功！");
			}
		},
		home: function(){
			window.location.href = "index.php";
		},
		sendError(msg) {
        	this.$notify({
	        	title: '警告',
	        	message: msg,
	        	offset: 50,
	        	type: "warning"
	  		});
	    },
	    sendSuccess(msg) {
	    	this.$notify({
	        	title: '成功',
	        	message: msg,
	        	offset: 50,
	        	type: "success"
	  		});
	    }
	},
	created: function(){
	}
})

window.onload = function() {
	// 声明一个simpleMDE实例
	hljs.initHighlightingOnLoad();
	var simplemde = new SimpleMDE({ 
		element: document.getElementById("article-content"),
		toolbar: ["bold", "italic", "heading", "clean-block","quote","unordered-list","ordered-list","strikethrough","horizontal-rule","code","link","image","preview","side-by-side","fullscreen"],
		shortcuts: {
			"toggleFullScreen": null,
			"preview": null,
		},
		autoDownloadFontAwesome: false,
		renderingConfig: {
			singleLineBreaks: true,
			codeSyntaxHighlighting: true,
		},
		spellChecker: false,
		styleSelectedText: false
	 });
	simplemde.toggleSideBySide();
	document.body.addEventListener("keyup", function(){
		article.content = simplemde.value();
	})
}
