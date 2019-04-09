<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:65:"C:\thinkphp/application/platform\view\show\experimentalpanel.html";i:1529921792;s:54:"C:\thinkphp/application/platform\view\public\head.html";i:1529569052;s:54:"C:\thinkphp/application/platform\view\public\foot.html";i:1515723186;}*/ ?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>物联网爱好者</title>
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
	<script type="text/javascript" src="__static__/js/highcharts.js"></script>
</head>


    <body>

<div class="x-body" style="width:70%; margin: 0 auto">
        <button onclick="javascript:location.reload()" class="layui-btn layui-btn-small layui-btn-normal">刷新</button>
        
        
       <?php echo $table; ?>

        
       
          </tbody>
        </table>
        </div>

	</body>	
	<script>
	
	layui.use(['laydate','form'], function(){
        var laydate = layui.laydate;
        //执行一个laydate实例
        laydate.render({
          elem: '#start' //指定元素
        });
        //执行一个laydate实例
        laydate.render({
          elem: '#end' //指定元素
        });
      });

	  function On(id){
        layer.confirm('确认要打开吗？',function(index){
            //捉到所有被选中的，发异步进行删除
            $.post("<?php echo url('platform/control/sendon'); ?>", {id: id}, function(data, textStatus, xhr) {
          /*optional stuff to do after success */
              console.log(data);
              if(data.code==1){
                  layer.msg(data.msg,{icon:1,time:1000},function(){
				  location.replace(location);
                  });
              }else{
                  layer.msg(data.msg,{icon:2,time:1000});
              }
            
            });
        });
      }
	  function Off(id){
        layer.confirm('确认要关闭吗？',function(index){
            //捉到所有被选中的，发异步进行删除
            $.post("<?php echo url('platform/control/sendoff'); ?>", {id: id}, function(data, textStatus, xhr) {
          /*optional stuff to do after success */
              console.log(data);
              if(data.code==1){
                  layer.msg(data.msg,{icon:1,time:1000},function(){
				  location.replace(location);
                  });
              }else{
                  layer.msg(data.msg,{icon:2,time:1000});
              }
            
            });
        });
      }
	  
	  function managemotor(serial){
	    var pwm = document.getElementById('pwm'+serial).value;
		
        layer.confirm('确认发送设置吗？',function(index){
            //捉到所有被选中的，发异步进行删除
            $.post("<?php echo url('platform/control/pwmmotor'); ?>", {id: serial,pwm: pwm}, function(data, textStatus, xhr) {
          /*optional stuff to do after success */
              console.log(data);
              if(data.code==1){
			  layer.msg(data.msg,{icon:1,time:1000},function(){
			    location.reload();
                  });
			  }else{
                  layer.msg(data.msg,{icon:2,time:1000});
              }
            
            });
        });
      }
	  
	  function managesteer(serial){
	    var pwm = document.getElementById('pwm'+serial).value;
		
        layer.confirm('确认发送设置吗？',function(index){
            //捉到所有被选中的，发异步进行删除
            $.post("<?php echo url('platform/control/steer'); ?>", {id: serial,pwm: pwm}, function(data, textStatus, xhr) {
          /*optional stuff to do after success */
              console.log(data);
              if(data.code==1){
			  layer.msg(data.msg,{icon:1,time:1000},function(){
			    location.reload()
                  });  
              }else{
                  layer.msg(data.msg,{icon:2,time:1000});
              }
            
            });
        });
      }
	  function manageled(serial){
	    var red = document.getElementById('red'+serial).value;
	    var green = document.getElementById('green'+serial).value;
	    var blue = document.getElementById('blue'+serial).value;
		
        layer.confirm('确认发送设置吗？',function(index){
            //捉到所有被选中的，发异步进行删除
            $.post("<?php echo url('platform/control/rgbled'); ?>", {id: serial,red: red, green: green, blue: blue}, function(data, textStatus, xhr) {
          /*optional stuff to do after success */
              console.log(data);
              if(data.code==1){
			  layer.msg(data.msg,{icon:1,time:1000},function(){
                    location.reload();
                  });
              }else{
                  layer.msg(data.msg,{icon:2,time:1000});
              }
            
            });
        });
      }
	  function managelock(m,serial){
		
        layer.confirm('确认发送设置吗？',function(index){
            //捉到所有被选中的，发异步进行删除
            $.post("<?php echo url('platform/control/lock'); ?>", {id: serial,m: m}, function(data, textStatus, xhr) {
          /*optional stuff to do after success */
              console.log(data);
              if(data.code==1){
			  layer.msg(data.msg,{icon:1,time:1000},function(){
			    location.reload()
                  });
              }else{
                  layer.msg(data.msg,{icon:2,time:1000});
              }
            
            });
        });
      }
	  function managefan(serial){
	    var pwm = document.getElementById('pwm'+serial).value;
		
        layer.confirm('确认发送设置吗？',function(index){
            //捉到所有被选中的，发异步进行删除
            $.post("<?php echo url('platform/control/fan'); ?>", {id: serial,pwm: pwm}, function(data, textStatus, xhr) {
          /*optional stuff to do after success */
              console.log(data);
              if(data.code==1){
			  layer.msg(data.msg,{icon:1,time:1000},function(){
			    location.reload()
                  });
              }else{
                  layer.msg(data.msg,{icon:2,time:1000});
              }
            
            });
        });
      }
	  function managewarn(m,serial){
		
        layer.confirm('确认发送设置吗？',function(index){
            //捉到所有被选中的，发异步进行删除
            $.post("<?php echo url('platform/control/warner'); ?>", {id: serial,m: m}, function(data, textStatus, xhr) {
          /*optional stuff to do after success */
              console.log(data);
              if(data.code==1){
			  layer.msg(data.msg,{icon:1,time:1000},function(){
			    location.reload()
                  });
              }else{
                  layer.msg(data.msg,{icon:2,time:1000});
              }
            
            });
        });
      }
	  function managerelay(m,serial){
		
        layer.confirm('确认发送设置吗？',function(index){
            //捉到所有被选中的，发异步进行删除
            $.post("<?php echo url('platform/control/relay'); ?>", {id: serial,m: m}, function(data, textStatus, xhr) {
          /*optional stuff to do after success */
              console.log(data);
              if(data.code==1){
			  
			  layer.msg(data.msg,{icon:1,time:1000},function(){
			    location.reload();
                  });
			  
              }else{
                  layer.msg(data.msg,{icon:2,time:1000});
              }
            
            });
        });
      }
    </script> 
<script src="__module__/layui/layui.all.js" charset="utf-8"></script>
</html>