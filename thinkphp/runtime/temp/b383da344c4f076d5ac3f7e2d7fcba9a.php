<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:49:"C:\thinkphp/application/data\view\user\login.html";i:1526879374;}*/ ?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8"/>
<title>php</title>
<link href="__css__/loginstyle.css" rel='stylesheet' type='text/css' />
<link rel="stylesheet" type="text/css" href="__css__/style.css" tppabs="css/style.css" />
<meta name="description" content="lotusadmin">
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>

<style>
body{
	height:100%;
	background:#000000;
	overflow:hidden;
}
canvas{
	z-index:-1;
	position:absolute;
}
</style>
<script src="__js__/jquery.min.js"></script>
<script src="__module__/layer/layer.js"></script>
<script src="__js__/verificationNumbers.js" tppabs="js/verificationNumbers.js"></script>
<script src="__js__/Particleground.js" tppabs="js/Particleground.js"></script>

</head>
<body>
<?php  
	    $username = 	session('username');
		if(!empty($username )){  ?>	
		<script type="text/javascript">
				window.location.href="<?php echo url('data/index/index'); ?>";
		</script>
<?php  } ?>

<div class="main2">
<img src="__images__/ustbiotlogo.png" alt="">
</div>
<div class="main1">
<dl class="clear">
 <dd class="lable-2">
  <input type="text" name="username" id='username' placeholder="账号" class="text"/>
 </dd>
 <dd class="lable-2">
  <input type="password" name="password"  id="password" placeholder="密码" class="text"/>
 </dd>
 
 <dd>
  <input  onclick="login()" type="submit"  value="立即登陆" class="submit"/> </input>
 </dd>
 </dd>
</dl>

									<div class="clear"> </div>
</div>
<div class="copy-right">
						<p>技术支持 <a href="http://www.ustb.edu.cn/" target="_blank">北京科技大学</a> <a href="http://scce.ustb.edu.cn/article.action?categoryId=25&boardaId=105" target="_blank">物联网与电子工程系</a></p> 
					</div>
</body>
<script>
$(document).ready(function() {
  //粒子背景特效
  $('body').particleground({
    dotColor: '#46a9d0',
    lineColor: '#46a9d0'
  });
  //验证码
  createCode();
  //测试提交，对接程序删除即可
   $(".submit_btn").click(function(){
	  // location.href="javascrpt:"tpa=http://***index.html;\

	});
});


function login(){
	var username  = $('#username').val();
	var password  = $('#password').val();
	$.ajax({
	url: 'login',
	type: 'post',
	dataType: 'json',
		data:{
			username: username,
			password:password
			},
	})
	.done(function(data){
		console.log(data);
		if(data.code==0){
			layer.msg(data.msg,{});
		}else{
			layer.msg(data.msg,{icon:1,offset:'t'},function(){
				location.href = "index/index";
			});
			
		}
	})
}
document.onkeydown = function(e){ 
    var ev = document.all ? window.event : e;
    if(ev.keyCode==13) {
          login();
     }
}

//layer.msg('账号:admin  密码:123456',{time:6000,offset:'t'});

</script>
</html>
