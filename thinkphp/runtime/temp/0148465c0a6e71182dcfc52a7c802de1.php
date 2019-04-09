<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:59:"C:\thinkphp/application/admin\view\user\changepassword.html";i:1528624600;s:51:"C:\thinkphp/application/admin\view\public\head.html";i:1515723186;s:51:"C:\thinkphp/application/admin\view\public\foot.html";i:1515723186;}*/ ?>
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


<div class="x-body">
<form class="layui-form" id='mainForm' method="post" action="<?php echo url('device/adddevice'); ?>">
            <table class="layui-table"  lay-skin="nob">
                <tbody>
                    <tr>
                        <th width="100px">
                            旧密码
                        </th>
                        <td width="500px">
                            <input type="password" id="old" value="" name="old" 
							lay-verify="required|dserial" placeholder="请输入原密码" 
							autocomplete="off" class="layui-input">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            新密码
                        </td>
                        <td>
                            <input type="password" id="new" value="" name="new" 
							lay-verify="required|dserial" placeholder="请输入新密码" 
							autocomplete="off" class="layui-input">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            确认新密码
                        </td>
                        <td>
                            <input type="password" id="confirm" value="" name="confirm" 
							lay-verify="required|dserial" placeholder="请输入新密码" 
							autocomplete="off" class="layui-input">
                        </td>
                    </tr>
					
                    <tr>
                        <td colspan="2">
		<div class="layui-form-item">
		    <div class="layui-input-block">
		      <button style="margin-left: 20%" class="layui-btn" lay-submit="" onclick="manage()">提交</button>
		      <button id="reset" type="reset" class="layui-btn layui-btn-primary">重置</button>
		    </div>
		</div>
                        </td>
                    </tr>
                    
                </tbody>
            </table>
        </div>
		</form>
    </fieldset>
    <blockquote class="layui-elem-quote layui-quote-nm">
        北京科技大学 物联网与电子工程系
    </blockquote>
</div>
<script>
	  function manage(){
	    var newpw = document.getElementById('new').value;
	    var oldpw = document.getElementById('old').value;
	    var confirmpw = document.getElementById('confirm').value;
		
        layer.confirm('确认修改密码吗？',function(index){
            //捉到所有被选中的，发异步进行删除
            $.post("<?php echo url('admin/user/changepw'); ?>", {old: oldpw, new: newpw, confirm: confirmpw}, function(data, textStatus, xhr) {
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
