<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:57:"C:\thinkphp/application/platform\view\show\quicksort.html";i:1551445987;s:54:"C:\thinkphp/application/platform\view\public\head.html";i:1529569052;s:54:"C:\thinkphp/application/platform\view\public\foot.html";i:1515723186;}*/ ?>
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


<script>

	  
	  function manage(){
	    var red = document.getElementById('red').value;
	    var green = document.getElementById('green').value;
	    var blue = document.getElementById('blue').value;
		
        layer.confirm('确认发送设置吗？',function(index){
            //捉到所有被选中的，发异步进行删除
            $.post("<?php echo url('platform/control/rgbled'); ?>", {red: red, green: green, blue: blue}, function(data, textStatus, xhr) {
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
	  function show(){
	  var chart= {
            backgroundColor: '#ffffff',
            type: 'column'
   };
   var title = {
       text: '数据'   
   };
   var xAxis = {
      
   };
   var yAxis = {
      title: {
         text: 'DATA'
      },
      plotLines: [{
         value: 0,
         width: 1,
         color: '#808080'
      }]
   };   

   var tooltip = {
   }

   var legend = {
      layout: 'vertical',
      align: 'right',
      verticalAlign: 'middle',
      borderWidth: 0
   };

   var series =  [
      {
         data: [6,3,8,6,4,2,9,5,6,3,1,0,8,1,-1,3,7,1],
		 tooltip: {
         valueSuffix: ' ℃'
		 }
      }
   ];
   
   var credits= {  
          enabled:false ,
   };
   

   var json = {};

   json.chart = chart;
   json.credits = credits;
   json.title = title;
   json.xAxis = xAxis;
   json.yAxis = yAxis;
   json.tooltip = tooltip;
   json.legend = legend;
   json.series = series;

   $('#container').highcharts(json);
	  }
    </script>
    <body>

<div class="x-body" style="width:70%; margin: 0 auto">
		
		<table class="layui-table"  lay-skin="nob">
        <tbody>
        	<tr>
	            <td>
				<input type="text" id="red" value="128" name="red" 
				lay-verify="required|dserial" class="layui-input">
				</td>
	            <td>
				<button onclick="manage()" class="layui-btn layui-btn-big">发送</button>
				</td>
	            <td>
				<button onclick="show()" class="layui-btn layui-btn-big">显示</button>
				</td>
	            <td>
				<button onclick="javascript:location.reload()" class="layui-btn layui-btn-big">刷新</button>
				</td>
	        </tr>
       
        </tbody>
		</table>
		
        <div id="container"></div>
       <?php
    //快速排序
    //待排序数组
	$nowarray = array(6,3,8,6,4,2,9,5,6,3,1,0,8,1,-1,3,7,1);
	$arrlen = count($nowarray);
	
	
		
		//echo "<script type='text/javascript'>show();</script>";
		sleep(5);
		echo "<script type='text/javascript'>show();</script>";
	
    //函数实现快速排序
    function quick_sort($nowarray,$leftnode,$rightnode)
    {
	
		
		
        //递归出口:数组长度为1，直接返回数组
        $length=$rightnode-$leftnode+1;
        $left=$right=array();
		
		$i = 1;
		$j = $length-1;
		$state = 0;
		
        while($i<=$j)
		{
					
		//sleep(1);
			if($state==0)
				if($nowarray[$leftnode+$i] >= $nowarray[$leftnode])
				{
					$state = 1;
				}
				else 
				{
					$i=$i+1;
				}
			else
				if($nowarray[$leftnode+$j] < $nowarray[$leftnode])
				{
					$temp = $nowarray[$leftnode+$i];
					$nowarray[$leftnode+$i] = $nowarray[$leftnode+$j];
					$nowarray[$leftnode+$j] = $temp;
					$state = 0;
				}
				else 
				{
					$j=$j-1;
				}
		}
		$temp = $nowarray[$leftnode+$j];
		$nowarray[$leftnode+$j]=$nowarray[$leftnode];
		$nowarray[$leftnode]=$temp;
		
		//print_r($nowarray);
		
		if($i-1>1)
		{
			$nowarray=quick_sort($nowarray,$leftnode,$leftnode+$i-2);
		}
	    if($length-1-$j>1)
		{
			$nowarray=quick_sort($nowarray,$leftnode+$i,$rightnode);
		}
		  
        return $nowarray;

        }
        //调用
        print_r(quick_sort($nowarray,0,$arrlen-1));
?>
        </div>

	</body>	
	
<script src="__module__/layui/layui.all.js" charset="utf-8"></script>
</html>