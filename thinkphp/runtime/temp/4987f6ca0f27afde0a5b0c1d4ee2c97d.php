<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:56:"C:\thinkphp/application/download\view\index\windows.html";i:1527136024;s:54:"C:\thinkphp/application/download\view\public\head.html";i:1544601714;s:54:"C:\thinkphp/application/download\view\public\foot.html";i:1544601774;}*/ ?>
﻿<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
<title>百科荣创云平台</title>
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
        <span class="info">010-68949731/32</span>
        <span class="info">bjbkrc@r8c.com</span>
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
			<li><a href="<?php echo url('index/index/index'); ?>">首页</a></li>
			<li><a href="http://www.r8c.com/">官网</a></li>
			<li class="dropdown">
				<a href="<?php echo url('download/index/index'); ?>" class="dropdown-toggle" data-toggle="dropdown" >下载中心</a>
				<ul class="dropdown-menu">
					<li><a href="<?php echo url('download/index/index'); ?>">文档</a></li>
					<li><a href="<?php echo url('download/index/windows'); ?>">软件</a></li>
					<li><a href="<?php echo url('download/index/android'); ?>">安卓APP</a></li>
				</ul>
			</li>
			<li><a href="<?php echo url('course/index/index'); ?>">视频学习</a></li>
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
        <h1>WPF桌面应用</h1>
        <p>使用WPF基于.Net 4.0开发的桌面应用，免安装并可快速进行实验，请确保您的电脑装有.Net framework 4.0。</p>
        <div class="page_nav">
      <span>您的位置:</span> <a href="<?php echo url('download/index/index'); ?>">下载中心</a> <span><i class="fa fa-angle-double-right"></i>Windows</span>
      </div>
      </div>
    </div>
  </div>
</section>
<!--Page Header-->

<!-- Courses -->
<section id="course_all" class="padding-bottom">
  <div class="container">
    <div class="row">
	
	<?php if(is_array($data) || $data instanceof \think\Collection || $data instanceof \think\Paginator): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
      <div class="col-sm-6 col-md-4">
        <div class="course margin_top wow fadeIn" data-wow-delay="400ms">
          <div class="image bottom25">
            <img src="<?php echo $v['picture']; ?>" alt="Course" class="border_radius">
          </div>
          <h3 class="bottom10"><a href="<?php echo url('download/index/index'); ?>"><?php echo $v['name']; ?></a></h3>
          <p class="bottom20" style="height:120px"><?php echo $v['brief']; ?></p>
          <a class="btn_common yellow border_radius" href="<?php echo url('download/index/download?fileid='.$v['name']); ?>">下载</a>
        </div>
      </div>
    <?php endforeach; endif; else: echo "" ;endif; ?>
	  <div class="page">
            <div>
                <?php echo $data->render(); ?>
            </div>
       </div>
    </div>
  </div>
</section>
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
        <p class=" address"><i class="icon-map-pin"></i>北京市海淀区四季青路8号郦城工作区</p>
        <p class=" address"><i class="icon-phone"></i>010-68949731/32</p>
        <p class=" address"><i class="icon-mail"></i><a href="bjbkrc@r8c.com">bjbkrc@r8c.com</a></p>
        <img src="__images__/footer-map.png" alt="we are here" class="img-responsive">
      </div>
    </div>
  </div>
</footer>
<div class="copyright">
  <div class="container">
    <div class="row">
      <div class="col-md-12 text-center">
        <p>Copyright © 2018 <a target="_blank" href="http://www.r8c.com/">百科荣创(北京)</a> 京ICP备11009601号</p>
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


