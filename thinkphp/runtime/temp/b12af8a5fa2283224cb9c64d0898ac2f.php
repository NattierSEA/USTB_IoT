<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:53:"C:\thinkphp/application/platform\view\device\map.html";i:1527603283;}*/ ?>
﻿<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!-->
<html lang="en">
<!--<![endif]-->

<head>

<!-- Basic Page Needs
  ================================================== -->
<meta charset="utf-8">
<meta name="description" content="">
<meta name="author" content="">
<!--[if lt IE 9]>
		<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->

<!-- Mobile Specific Metas
  ================================================== -->
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">

<!-- CSS
  ================================================== -->

<!--[if IE 7]>
        <link rel="stylesheet" href="stylesheets/ie7.css">
    <![endif]-->

<!-- Favicons
	================================================== -->
<link rel="shortcut icon" href="images/favicon.ico">
<link rel="apple-touch-icon" href="images/apple-touch-icon.png">
<link rel="apple-touch-icon" sizes="72x72" href="images/apple-touch-icon-72x72.png">
<link rel="apple-touch-icon" sizes="114x114" href"images/apple-touch-icon-114x114.png">

<style> 
#container{ overflow:hidden;width:100%;height:500px} 
</style>
<script type="text/javascript" src="http://webapi.amap.com/maps?v=1.3&key=b1abe25a6887d839ae4425caae403e6e"></script>
</head>

<body>



<div id="container" ></div>


</body>
<script type="text/javascript">
var map = new AMap.Map('container',{  //初始化地图

    resizeEnable: true,

    zoom: 10,  //缩放比例

    center: [116.397428, 39.90923],  //你要打标注的点的位置

    mapStyle:'amap://styles/d6bf8c1d69cea9f5c696185ad4ac4c86'

});
function addMarker(j,w){

    marker = new AMap.Marker({

        icon:new AMap.Icon({

            image: "images/timg.png",  //自己做的一个标注图！！

            size: new AMap.Size(23, 29),  //图标大小

            imageSize: new AMap.Size(23,29)

        }),

        position:new AMap.LngLat(j,w) //标注位置（经纬度）

    });

    marker.setMap(map);  //在地图上添加点

    //鼠标点击marker弹出自定义的信息窗体

    AMap.event.addListener(marker, 'click', function() {

        infoWindow.open(map, marker.getPosition());

    });

}
 addMarker(116.397428, 39.90923);   //实例化
    </script>
</html>