<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:50:"C:\thinkphp/application/admin\view\user\email.html";i:1528787216;s:51:"C:\thinkphp/application/admin\view\public\head.html";i:1515723186;s:51:"C:\thinkphp/application/admin\view\public\foot.html";i:1515723186;}*/ ?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>闻海南-ADMIN</title>
  <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,user-scalable=yes, minimum-scale=0.4, initial-scale=0.8" />
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <link rel="shortcut icon" href="__static__/favicon.ico" type="image/x-icon" />
    <link rel="stylesheet" href="__static__/css/font.css">
    <link rel="stylesheet" href="__module__/layui/css/layui.css">
    <link rel="stylesheet" href="__static__/css/xadmin.css">
    <script type="text/javascript" src="__js__/jquery.min.js"></script>
    <script src="__module__/layui/layui.all.js" charset="utf-8"></script>
    <script type="text/javascript" src="__static__/js/xadmin.js"></script>
    <script type="text/javascript" src="__static__/js/jquery.form.js"></script>
    <script type="text/javascript" src="__static__/js/jquery.form.js"></script>
</head>


<body>
<style type="text/css" media="screen">
header {
    color: black;
}

</style>


<div class="x-body" >
	<form class="layui-form" id='mainForm' method="post" action="email">

		<div class="layui-form-item">
		    <label class="layui-form-label">邮&nbsp;&nbsp;&nbsp;箱</label>
		    <div class="layui-input-block">
		    <input type="text" id="email" name="email"  lay-verify="required|email"  placeholder="请输入注册邮箱" autocomplete="off" class="layui-input">
		    </div>
		</div>




		<div class="layui-form-item">
		    <div class="layui-input-block">
		      <button style="margin-left: 20%" class="layui-btn" lay-submit="" lay-filter="toSubmit">提交</button>
		      <button id="reset" type="reset" class="layui-btn layui-btn-primary">重置</button>
		    </div>
		</div>


	</form>
</div>
</body>

<script type="text/javascript">
		var form = layui.form;
		var layer = layui.layer;
			  //自定义验证规则
			  form.verify({
			    username: function(value){
			      if(value.length < 5){
			        return '用户名至少得5个字符啊';
			      }
			    }
			  });
		//监听提交
		form.on('submit(demo1)', function(data){
		      layer.alert(JSON.stringify(data.field), {
		      title: '最终的提交信息'
		    })
		    return false;
		  });

	$(document).ready(function(){ 
	     var options = {
		      type:'post',           //post提交
		      //url:'http://ask.tongzhuo100.com/server/****.php?='+Math.random(),   //url
		      dataType:"json",        //json格式
		      data:{},    //如果需要提交附加参数，视情况添加
		      clearForm: false,        //成功提交后，清除所有表单元素的值
		      resetForm: false,        //成功提交后，重置所有表单元素的值
		      cache:false,          
		      async:false,          //同步返回
		      success:function(data){
		      	console.log(data);
		      	if(data.code==0){
		      		layer.msg(data.msg,{icon:2,time:500});
		      	}else{
		      		layer.msg(data.msg,{icon:1,time:500},function(){
		      			$("#reset").click();
		      			x_admin_close();
		      			parent.location.reload();
		      		});
		      	}
		      //服务器端返回处理逻辑
		      	},
		      	error:function(XmlHttpRequest,textStatus,errorThrown){
		        	layer.msg('操作失败:服务器处理失败');
		      }
		    }; 
	    // bind form using 'ajaxForm' 
	    $('#mainForm').ajaxForm(options).submit(function(data){
	    	//无逻辑
	    }); 

	});
	
</script>
<script src="__module__/layui/layui.all.js" charset="utf-8"></script>
</html>
