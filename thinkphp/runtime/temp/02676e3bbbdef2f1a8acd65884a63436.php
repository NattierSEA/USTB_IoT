<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:58:"C:\thinkphp/application/platform\view\show\deviceedit.html";i:1525705208;s:54:"C:\thinkphp/application/platform\view\public\head.html";i:1525600532;s:54:"C:\thinkphp/application/platform\view\public\foot.html";i:1515723186;}*/ ?>
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
</head>


<body>
<style type="text/css" media="screen">
header {
    color: black;
}
</style>


<div class="x-body" >
	<form class="layui-form" id='mainForm' method="post" action="<?php echo url('show/editsubmit'); ?>">

		<input type="hidden" name="id" value="<?php echo $devicedata['id']; ?>">
		
		<div class="layui-form-item">
                <label class="layui-form-label">
                    设备类型
                </label>
                <div class="layui-input-block">
                    <select  value="<?php echo $devicedata['tid']; ?>"  name="tid" id='tid'>
                        <?php 
                            foreach($experimenttype as $v){
                            	if($v['id']==$devicedata['tid']){  
                         ?> 
                           <option  value="<?php echo $v['id']; ?>" selected><?php echo $v['typename']; ?></option>
                            <?php 	}else{    ?>
 						    <option value="<?php echo $v['id']; ?>"><?php echo $v['typename']; ?></option>
                            <?php   }   }  ?>
                       
                    </select>
                </div>
        </div>

		<div class="layui-form-item">
		    <label class="layui-form-label">设备名称</label>
		    <div class="layui-input-block">
		    <input type="text" id="devicename" value="<?php echo $devicedata['devicename']; ?>"  name="devicename" lay-verify="required|devicename" autocomplete="off" placeholder="请输入设备名称" class="layui-input">
		    </div>
		  </div>

		<div class="layui-form-item">
		    <label class="layui-form-label">设备序列号</label>
		    <div class="layui-input-block">
		    <input type="text" id="dserial" value="<?php echo $devicedata['dserial']; ?>" name="dserial" lay-verify="required|dserial" placeholder="请输入设备序列号" autocomplete="off" class="layui-input">
		    </div>
		</div>
		
		<div class="layui-form-item">
                <label class="layui-form-label">
                    设备状态
                </label>
                <div class="layui-input-block">
                    <select  value="<?php echo $devicedata['sta']; ?>"  name="sta" id='sta'>
					
                           <option value="1" selected>启用</option>
						   
 						   <option value="0">禁用</option>
							
                       
                    </select>
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
		//监听提交
		form.on('submit(demo1)', function(data){
		      layer.alert(JSON.stringify(data.field), {
		      title: '最终的提交信息'
		    })
		    return false;
		  });
		  
	$(document).ready(function(){ 
	    	// var options = { 
	        // target:
	        // target element(s) to be updated with server response 
	        // beforeSubmit:  showRequest,  // pre-submit callback 
	        // success: function(data){
	        //  		console.log(data);
	        //  },  
	        // other available options: 
	        //url:       url         // override for form's 'action' attribute 
	        //type:      type        // 'get' or 'post', override for form's 'method' attribute 
	        //dataType:  null        // 'xml', 'script', or 'json' (expected server response type) 
	        //clearForm: true        // clear all form fields after successful submit 
	        //resetForm: true        // reset the form after successful submit 
	        // $.ajax options can be used here too, for example: 
	        //timeout:   3000 
	    // };
	    var options = {
		      type:'post',           //post提交
		      // url:'http://ask.tongzhuo100.com/server/****.php?='+Math.random(),   //url
		      dataType:"json",        //json格式
		      data:{},    //如果需要提交附加参数，视情况添加
		      clearForm: false,        //成功提交后，清除所有表单元素的值
		      resetForm: false,        //成功提交后，重置所有表单元素的值
		      cache:false,          
		      async:false,          //同步返回
		      success:function(data){
		      	console.log(data);
		      	if(data.code==0){
		      		layer.msg(data.msg);
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
	    $('#mainForm').ajaxForm(options).submit(function(data){}); 
	});
	
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

	  
    </script>
	<script>
	
	  function editData(obj,id){
        var count = $(".i_count")[0].innerText;
		var tid = document.getElementById("tid").value;
		var devicename = document.getElementById("devicename").value;
		var dserial = document.getElementById("dserial").value;
        layer.confirm('确认要修改吗？',function(index){
            //捉到所有被选中的，发异步进行删除
            $.post("<?php echo url('platform/index/editsubmit'); ?>", {id: id,tid: tid,devicename:devicename,dserial:dserial}, function(data, textStatus, xhr) {
          /*optional stuff to do after success */
              console.log(data);
              if(data.code==1){
                  layer.msg(data.msg,{icon:1,time:1000},function(){
                    $(obj).parents('tr').remove();
                    $(".i_count").html(count-1);
                  });
              }else{
                  layer.msg(data.msg,{icon:2,time:1000});
              }
            
            });
        });
      }</script>
<script src="__module__/layui/layui.all.js" charset="utf-8"></script>
</html>
