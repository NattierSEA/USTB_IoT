<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:50:"C:\thinkphp/application/newdata\view\index\bd.html";i:1525446862;s:53:"C:\thinkphp/application/newdata\view\public\head.html";i:1528618687;s:53:"C:\thinkphp/application/newdata\view\public\foot.html";i:1525359662;}*/ ?>
﻿<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
<title>物联爱好者</title>
<link rel="stylesheet" type="text/css" href="__static__/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="__static__/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="__static__/css/edua-icons.css">
<link rel="stylesheet" type="text/css" href="__static__/css/animate.min.css">
<link rel="stylesheet" type="text/css" href="__static__/css/owl.carousel.css">
<link rel="stylesheet" type="text/css" href="__static__/css/owl.transitions.css">
<link rel="stylesheet" type="text/css" href="__static__/css/cubeportfolio.min.css">
<link rel="stylesheet" type="text/css" href="__static__/css/settings.css">
<link rel="stylesheet" type="text/css" href="__static__/css/bootsnav.css">
<link rel="stylesheet" type="text/css" href="__static__/css/style.css">
<link rel="stylesheet" type="text/css" href="__static__/css/loader.css">
<link rel="stylesheet" href="__module__/layui/css/layui.css">

<link rel="icon" href="__images__/pan.png">




<!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->
</head>

<body>
<a href="#" class="scrollToTop"><i class="fa fa-angle-up"></i></a>
<!--Loader-->
<div class="loader">
  <div class="bouncybox">
      <div class="bouncy"></div>
    </div>
</div>

<div class="topbar">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="pull-left">
        <span class="info"><a href="#.">帮助</a></span>
        <span class="info">18813128564</span>
        <span class="info">panqiushi_ustb@163.com</span>
        </div>
        <ul class="social_top pull-right">
          <?php if(\think\Session::get('username') == null): ?>
		  <span class="info"><a href="<?php echo url('index/index/user'); ?>">登 录</a></span>
		  <?php else: ?>
		  <span class="info">欢迎使用</span>
		  <span class="info"><a href="<?php echo url('admin/user/index'); ?>"><img src="<?php echo $userdata['propic']; ?>" style="height:20px;width:20px;border-radius:10px">
		   <?php echo \think\Session::get('username'); ?></a></span>
		   <span class="info"><a href="<?php echo url('index/index/logout'); ?>">注 销</a></span>
		  <?php endif; ?>
        </ul>
      </div>
    </div>
  </div>
</div>

<!--Header-->
<header>
  <nav class="navbar navbar-default navbar-fixed white no-background bootsnav">
    <div class="container"> 
       <div class="search_btn btn_common"><i class="icon-icons185"></i></div>
      <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-menu">
          <i class="fa fa-bars"></i>
        </button>
        <a class="navbar-brand" href="index/index/index"><img src="__images__/logo-white.png" alt="logo" class="logo logo-display">
        <img src="__images__/logo-black.png" class="logo logo-scrolled" alt="">
        </a>
      </div>
      <div class="collapse navbar-collapse" id="navbar-menu">
        <ul class="nav navbar-nav navbar-right" data-in="fadeInDown" data-out="fadeOut">
			<li><a href="<?php echo url('index/index/index'); ?>">主页</a></li>
			<li class="dropdown">
				<a href="#." class="dropdown-toggle" data-toggle="dropdown" >网络</a>
				<ul class="dropdown-menu">
					<li><a href="#.">网络</a></li>
					<li><a href="#.">TCP</a></li>
					<li><a href="#.">UDP</a></li>
					<li><a href="#.">COAP</a></li>
				</ul>
			</li>
			<li class="dropdown">
				<a href="<?php echo url('download/index/windows'); ?>" class="dropdown-toggle" data-toggle="dropdown" >WPF</a>
				<ul class="dropdown-menu">
				  <li><a href="<?php echo url('download/index/windows'); ?>">WPF</a></li>
				  <li><a href="#.">NB-IoT调试助手</a></li>
				  <li><a href="#.">网络通信</a></li>
				  <li><a href="#.">OBD解析监控</a></li>
				</ul>
			</li>
			<li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown" >终端</a>
				<ul class="dropdown-menu">
				  <li><a href="#.">网关</a></li>
				  <li><a href="#.">LoRa Node</a></li>
				  <li><a href="#.">NB-IoT Node</a></li>
				</ul>
			</li>
			<li><a href="http://112.124.41.198:8100/cpnsp/site/">Blog</a></li>
			<li><a href="<?php echo url('platform/user/index'); ?>">开发者平台</a></li>
			<li><a href="<?php echo url('admin/user/index'); ?>">用户管理</a></li>
        </ul>
      </div>
    </div>   
  </nav>
</header>


<!--Search-->
<div id="search">
  <button type="button" class="close">×</button>
  <form>
    <input type="search" value="" placeholder="Search here...."  required/>
    <button type="submit" class="btn btn_common blue">Search</button>
  </form>
</div>



<!--Page Header-->
<section class="page_header padding-top">
  <div class="container">
    <div class="row">
      <div class="col-md-12 page-content">
        <h1>北斗GPS双模数据</h1>
        <p>记录北斗模块的位置，可通过手机APP地图查看。</p>
        <div class="page_nav">
      <span>您的位置:</span> <a href="<?php echo url('newdata/user/index'); ?>">数据中心</a> <span><i class="fa fa-angle-double-right"></i>Location</span>
      </div>
      </div>
    </div>
  </div>
</section>
<!--Page Header-->


<div class="x-body" style="width:70%; margin: 0 auto">
        <button onclick="javascript:location.reload()" class="layui-btn layui-btn-small">刷新</button>
        <span class="x-right" style="line-height:40px">共有数据:<i class="i_count"><?php echo $data->total(); ?></i>条</span>
<table class="layui-table">
        <thead>
          <tr>
            <th>
              <div class="header layui-form-checkbox" lay-skin="primary"><i class="layui-icon">&#xe605;</i></div>
            </th>
            <th>时间</th>
            <th>设备序列号</th>
            <th>纬度</th>
            <th>经度</th>
            <th>温度</th>
            <th>湿度</th>
            <th>操作</th>
        </thead>
        <tbody>

        <?php if(is_array($data) || $data instanceof \think\Collection || $data instanceof \think\Paginator): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
        	<tr>
	            <td>
	              <div class="layui-form-checkbox" lay-skin="primary" data-id='2'><i class="layui-icon">&#xe605;</i></div>
	            </td>
	            <td><?php echo $vo['time']; ?></td>
	            <td><?php echo $vo['device']; ?></td>
	            <td><p><?php echo $vo['ns']; ?> <?php echo $vo['latitude']; ?>°</p></td>
                <td><p><?php echo $vo['ew']; ?> <?php echo $vo['longitude']; ?>°</p></td>
	            <td><p><?php echo $vo['temperature']; ?>℃</p></td>
	            <td><p><?php echo $vo['humidity']; ?>%</p></td>
	            <td>
	             	<button onclick="delData(this,<?php echo $vo['id']; ?>)" class="layui-btn layui-btn-mini layui-btn-danger">删除</button>
	           </td>
	        </tr>
        <?php endforeach; endif; else: echo "" ;endif; ?>
       
        </tbody>
      </table>
	      <div class="page">
	        <div>
	        	<?php echo $data->render(); ?>
	        </div>
	      </div>
    </div>	  
	<script>

      function delData(obj,id){
            //捉到所有被选中的，发异步进行删除
            $.post("<?php echo url('newdata/index/deletedata2'); ?>", {id: id}, function() {alert("删除成功");location.reload();});
      }
	  function delDatas(obj,id){
        var count = $(".i_count")[0].innerText;
        layer.confirm('确认要删除吗？',function(index){
            //捉到所有被选中的，发异步进行删除
            $.post("<?php echo url('newdata/index/deletedata'); ?>", {id: id}, function(data, textStatus, xhr) {
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
      }
    </script>	  
		  
		  
<!-- Courses ends -->
<!--FOOTER-->
<footer class="padding-top">
  <div class="container">
    <div class="row">
      <div class="col-md-4 col-sm-4 footer_panel bottom25">
        <h3 class="heading bottom25">关于我们<span class="divider-left"></span></h3>
        <a href="index/index/index" class="footer_logo bottom25"><img width="100" src="__images__/logo-white.png" alt="Edua"></a>
        <p>物联网与人工智能爱好者聚集地</p>
      </div>
      <div class="col-md-4 col-sm-4 footer_panel bottom25">
        <h3 class="heading bottom25">快速访问<span class="divider-left"></span></h3>
        <ul class="links">
          <li><a href="#."><i class="icon-chevron-small-right"></i>主页</a></li>
          <li><a href="#."><i class="icon-chevron-small-right"></i>学校</a></li>
          <li><a href="#."><i class="icon-chevron-small-right"></i>服务项目</a></li>
          <li><a href="#."><i class="icon-chevron-small-right"></i>团队</a></li>
          <li><a href="#."><i class="icon-chevron-small-right"></i>研究方向</a></li>
          <li><a href="#."><i class="icon-chevron-small-right"></i>社会活动</a></li>
          <li><a href="#."><i class="icon-chevron-small-right"></i>Blog</a></li>
          <li><a href="#."><i class="icon-chevron-small-right"></i>产品</a></li>
          <li><a href="#."><i class="icon-chevron-small-right"></i>微信主页</a></li>
          <li><a href="#."><i class="icon-chevron-small-right"></i>联系我们</a></li>
        </ul>
      </div>
      <div class="col-md-4 col-sm-4 footer_panel bottom25">
        <h3 class="heading bottom25">联系方式 <span class="divider-left"></span></h3>
        <p class=" address"><i class="icon-map-pin"></i>北京市海淀区学院路30号</p>
        <p class=" address"><i class="icon-phone"></i>18813128564</p>
        <p class=" address"><i class="icon-mail"></i><a href="panqiushi_ustb@163.com">panqiushi_ustb@163.com</a></p>
        <img src="__images__/footer-map.png" alt="we are here" class="img-responsive">
      </div>
    </div>
  </div>
</footer>
<div class="copyright">
  <div class="container">
    <div class="row">
      <div class="col-md-12 text-center">
        <p>Copyright &copy; 2018.USTB All rights reserved.<a target="_blank" href="#.">北京科技大学</a></p>
      </div>
    </div>
  </div>
</div>

<!--FOOTER ends-->
<script src="__static__/js/jquery-2.2.3.js"></script>
<script src="__static__/js/bootstrap.min.js"></script>
<script src="__static__/js/bootsnav.js"></script>
<script src="__static__/js/jquery.appear.js"></script>
<script src="__static__/js/jquery-countTo.js"></script>
<script src="__static__/js/jquery.parallax-1.1.3.js"></script>
<script src="__static__/js/owl.carousel.min.js"></script>
<script src="__static__/js/jquery.cubeportfolio.min.js"></script>
<script src="__static__/js/jquery.themepunch.tools.min.js"></script>
<script src="__static__/js/jquery.themepunch.revolution.min.js"></script>
<script src="__static__/js/revolution.extension.layeranimation.min.js"></script>
<script src="__static__/js/revolution.extension.navigation.min.js"></script>
<script src="__static__/js/revolution.extension.parallax.min.js"></script>
<script src="__static__/js/revolution.extension.slideanims.min.js"></script>
<script src="__static__/js/revolution.extension.video.min.js"></script>
<script src="__static__/js/wow.min.js"></script>
<script src="__static__/js/functions.js"></script>


</body>
</html>

