<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:53:"C:\thinkphp/application/newdata\view\index\index.html";i:1525922206;s:53:"C:\thinkphp/application/newdata\view\public\head.html";i:1528618688;s:53:"C:\thinkphp/application/newdata\view\public\foot.html";i:1525359664;}*/ ?>
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
        <h1>低功耗广域网数据中心</h1>
        <p>我们为嵌入式设备提供了强大的后台支持。</p>
        <div class="page_nav">
      <span>您的位置:</span> <a href="<?php echo url('newdata/index/index'); ?>">数据中心</a> <span><i class="fa fa-angle-double-right"></i>主页</span>
      </div>
      </div>
    </div>
  </div>
</section>



<!--BLOG SECTION-->
<section id="blog" class="padding">
  <div class="container">
    <h2 class="hidden">Our Blog</h2>
    <div class="row">
      <div class="col-md-9">
        <article class="blog_item heading_space wow fadeInLeft" data-wow-delay="300ms">
          <div class="row">
            <div class="col-md-5 col-sm-5 heading_space">
              <div class="image"><img src="__images__/newdata1.jpg" alt="blog" class="border_radius"></div>
            </div>
            <div class="col-md-7 col-sm-7 heading_space">
              <h2>环境监测传感器数据</h2>
              <ul class="comment margin10">
                <li><a href="">2017.07-2017.08</a></li>
                <li><a href="">研发</a></li>
              </ul>
              <p class="margin10">搭载温湿度、光照强度和空气质量三种传感器，使用STM32F103作为主MCU，将传感器采集到的数据通过NB-IoT模块发送出去。支持UDP和COAP两种协议，并且分别对应相关的服务，将数据接收并处理。
              </p>
              <p class="margin10">UDP可以直接将数据通过socket通信发送到服务器上，而COAP需要经过电信运营商的云平台转发，在云服务器上搭建HTTPS服务器，通过Java编写的RESTful接口接收数据。
              </p>
              <a class=" btn_common btn_border margin10 border_radius" href="<?php echo url('newdata/index/sensor'); ?>">进入</a>
            </div>
          </div>
        </article>
        <article class="blog_item heading_space wow fadeInLeft" data-wow-delay="400ms">
          <div class="row">
            <div class="col-md-5 col-sm-5 heading_space">
              <div class="image"><img src="__images__/newdata2.jpg" alt="blog" class="border_radius"></div>
            </div>
            <div class="col-md-7 col-sm-7 heading_space">
              <h2>北斗GPS双模数据</h2>
              <ul class="comment margin10">
                <li><a href="">2018.04</a></li>
                <li><a href="">研发</a></li>
              </ul>
              <p class="margin10">搭载北斗和GPS双模定位模块，使定位结果更加准确。搭配温湿度模块，在监控目标位置的同时可以同时监控温度。可应用于海量目标的定位追踪，相邻两次数据上报时间间隔较长，因此数据量也比较小。
			  </p>
              <p class="margin10">通讯模块提供了NB-IoT和GPRS两种模块，同一时间仅可使用一种，接口可替换。两种通讯技术分别可通过TCP和COAP发送数据，数据格式是兼容的，可记录到同一数据库中。
              </p>
              <a class=" btn_common btn_border margin10 border_radius" href="<?php echo url('newdata/index/bd'); ?>">进入</a>
            </div>
          </div>
        </article>
        <article class="blog_item heading_space wow fadeInLeft" data-wow-delay="500ms">
          <div class="row">
            <div class="col-md-5 col-sm-5 heading_space">
              <div class="image"><img src="__images__/newdata3.jpg" alt="blog" class="border_radius"></div>
            </div>
            <div class="col-md-7 col-sm-7 heading_space">
              <h2>旧版入口</h2>
              <ul class="comment margin10">
                <li><a href="">2017.08</a></li>
                <li><a href="">研发</a></li>
              </ul>
              <p class="margin10">以AJAX动态加载网页的形式，读取数据库中的数据并显示。可以读取TCP、UDP和COAP协议接收到的数据，既可以作为实验数据平台使用，也可以作为网络协议的测试工具使用。
              </p>
              <p class="margin10">作为实验平台使用时，可以检测传感器、执行器和RFID识别模块的数据，尤其是对传感器监测时，可以按照不同的传感器数据进行排序，并以图标的形式显示出来，可具体到单个节点。
              </p>
              <a class=" btn_common btn_border margin10 border_radius" href="<?php echo url('data/user/index'); ?>">进入</a>
            </div>
          </div>
        </article>
      </div>
      <div class="col-md-3">
        <aside class="sidebar bg_grey border-radius wow fadeIn" data-wow-delay="300ms">
          <div class="widget heading_space">
            <form class="widget_search border-radius">
              <div class="input-group">
                <input type="search" class="form-control" placeholder="输入以搜索服务" required>
                <i class="input-group-addon icon-icons185"></i>
              </div>
            </form>
          </div>
          <div class="widget heading_space">
            <h3 class="bottom20">关键词搜索</h3>
            <ul class="tags">
              <li><a href="#.">4G</a></li>
              <li><a href="<?php echo url('data/user/index'); ?>">LoRa</a></li>
              <li><a href="<?php echo url('newdata/index/sensor'); ?>">NB-IoT</a></li>
              <li><a href="<?php echo url('newdata/index/bd'); ?>">北斗</a></li>
              <li><a href="<?php echo url('newdata/index/bd'); ?>">GPS</a></li>
              <li><a href="<?php echo url('newdata/index/sensor'); ?>">环境监测</a></li>
              <li><a href="<?php echo url('newdata/index/bd'); ?>">房车</a></li>
              <li><a href="<?php echo url('newdata/index/sensor'); ?>">低功耗广域网</a></li>
              <li><a href="<?php echo url('newdata/index/sensor'); ?>">传感器</a></li>
              <li><a href="<?php echo url('data/user/index'); ?>">UDP</a></li>
              <li><a href="<?php echo url('data/user/index'); ?>">TCP</a></li>
              <li><a href="<?php echo url('newdata/index/bd'); ?>">COAP</a></li>
            </ul>
          </div>
        </aside>
      </div>
    </div>
  </div>
</section>
<!--BLOG SECTION-->

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



