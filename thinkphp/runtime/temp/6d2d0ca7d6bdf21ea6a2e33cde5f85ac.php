<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:56:"C:\thinkphp/application/admin\view\dc_manage\manage.html";i:1528874544;s:51:"C:\thinkphp/application/admin\view\public\head.html";i:1515723186;s:51:"C:\thinkphp/application/admin\view\public\foot.html";i:1515723186;}*/ ?>
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
    <div class="x-body" >
	<div>
        <button onclick="javascript:location.reload()" class="layui-btn">刷新</button>
		</div>
        <span class="x-right" style="line-height:40px">数据库表数量:<?php echo $count; ?></span>
    

    <table class="layui-table">
        <thead>
          <tr>
			<th style="width:100px">状态</th>
            <th>传感器类型</th>
            <th>操作</th>
        </thead>
        <tbody>
		<?php if(is_array($db_names) || $db_names instanceof \think\Collection || $db_names instanceof \think\Paginator): $i = 0; $__LIST__ = $db_names;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
            <tr>
				<td><?php if($vo['sta']==1) echo '<span class="layui-badge-dot layui-bg-green"></span>启用'; else echo '<span class="layui-badge-dot"></span>禁用'; ?></td>
                <td><?php echo $vo['typename']; ?></td>
                <td>
                    <button onclick="x_admin_show('设置','<?php echo url('admin/dc_manage/changename?id='.$vo['id']); ?>',500,350)" class="layui-btn layui-btn-mini">设置</button>
                    <button onclick="set1(<?php echo $vo['id']; ?>,'<?php echo $vo['typename']; ?>')" class="layui-btn layui-btn-mini layui-btn-normal">启用</button>
                    <button onclick="set0(<?php echo $vo['id']; ?>,'<?php echo $vo['typename']; ?>')" class="layui-btn layui-btn-mini layui-btn-danger">禁用</button>
                </td>
            </tr>
        <?php endforeach; endif; else: echo "" ;endif; ?>
        </tbody>
      </table>
	      <div class="page">
	        <div>

	        </div>
	      </div>
    </div>
</body>
	<script>
	  
	  function set1(id,typename){
        layer.confirm('确认启用&nbsp&nbsp'+typename+'&nbsp&nbsp类型的设备吗？',function(index){
            //捉到所有被选中的，发异步进行删除
            $.post("<?php echo url('admin/dc_manage/set'); ?>", {id: id,sta: 1}, function(data, textStatus, xhr) {
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
	  function set0(id,typename){
        layer.confirm('确认禁用&nbsp&nbsp'+typename+'&nbsp&nbsp类型的设备吗？',function(index){
            //捉到所有被选中的，发异步进行删除
            $.post("<?php echo url('admin/dc_manage/set'); ?>", {id: id,sta: 0}, function(data, textStatus, xhr) {
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
