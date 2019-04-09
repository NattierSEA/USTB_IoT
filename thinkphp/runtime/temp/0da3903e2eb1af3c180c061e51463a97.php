<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:51:"C:\thinkphp/application/platform\view\show\map.html";i:1527604546;s:54:"C:\thinkphp/application/platform\view\public\head.html";i:1529569052;s:54:"C:\thinkphp/application/platform\view\public\foot.html";i:1515723186;}*/ ?>
﻿<!doctype html>
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
<style> 
#container{ overflow:hidden;width:100%;height:800px} 
</style>
<script type="text/javascript" src="http://webapi.amap.com/maps?v=1.3&key=b1abe25a6887d839ae4425caae403e6e"></script>


<div id="container" ></div>



<script type="text/javascript">
var map = new AMap.Map('container',{  //初始化地图

    resizeEnable: true,

    zoom: 10,  //缩放比例

    center: [<?php echo $longitude; ?>, <?php echo $latitude; ?>],  //你要打标注的点的位置

    mapStyle:'amap://styles/d6bf8c1d69cea9f5c696185ad4ac4c86'

});
function addMarker(j,w){

    marker = new AMap.Marker({

        icon:new AMap.Icon({

            image: "__images__/timg.png",  //自己做的一个标注图！！

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
 addMarker(<?php echo $longitude; ?>, <?php echo $latitude; ?>);   //实例化
    </script>
	</body>
<script src="__module__/layui/layui.all.js" charset="utf-8"></script>
</html>