$(function(){
	var signTab = document.getElementById("sign-tab");
	var loginTab = document.getElementById("login-tab");
	$("#login-tab").click(function(){
		$(".tab-box").addClass("show");
		$("#nav-tab").css("left",155);
	})
	$("#sign-tab").click(function(){
		$(".tab-box").removeClass("show");
		$("#nav-tab").css("left",102);
	})
})
