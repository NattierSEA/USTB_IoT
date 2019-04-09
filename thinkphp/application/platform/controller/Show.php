<?php
namespace app\platform\controller;

use think\Controller;
use think\Db;
use think\Session;
use think\Validate;
use think\GatewayWorker\Lib\Gateway;

class Show extends Controller
{

    public function index(){
        return $this->fetch('login');
    }
	
	public function quicksort()
    {
		return $this->fetch();
    }
	
	public function select($serial='',$devicetype=0){
		if(session('username')==null)
		{
			$this->error('您未登录');
		}
		$se = $serial;
		$dvp = $devicetype;
		$typedata = Db::name('experiment_type_store')->where('id', $devicetype)->find();
		//print_r($typedata);
		$sheet = $typedata['datasheet'];
		$mapped = $typedata['name'];
		$show = $typedata['show'];
		$type = $typedata['typename'];
        $datas = Db::name($sheet)->where($mapped, $serial)->order('id desc')->paginate(10);
		$this->assign('datas', $datas);
		$this->assign('type', $type);
		$this->assign('serial', $serial);
		//GateWay::sendToAll("chakan");
		return $this->fetch($show);
	}
	
	public function map($latitude = 0,$longitude = 0)
    {
		if(session('username')==null)
		{
			$this->error('您未登录');
		}
		$la = 0.1;
		$lon = 0.1;
		$la = floor($latitude)+$latitude*1000000%1000000/600000;
		$lon = floor($longitude)+$longitude*1000000%1000000/600000;
		$x_pi = 3.14159265358979324 * 3000.0 / 180.0;
        $x = $lon + 0.0065;//$lon - 0.0065;
        $y = $la + 0.001;//$la - 0.006;
        $z = sqrt($x * $x + $y * $y) - 0.00002 * sin($y * $x_pi);
        $theta = atan2($y, $x) - 0.000003 * cos($x * $x_pi);
		$lon = $z * cos($theta);
        $la = $z * sin($theta);
        $this->assign('latitude', $la);
        $this->assign('longitude', $lon);
		return $this->fetch();
    }
	
	public function select1($serial='',$devicetype=0){//没啥用
		if(session('username')==null)
		{
			$this->error('您未登录');
		}
		$se = $serial;
		$dvp = $devicetype;
		switch($dvp)
		{
			case 1 :{
				$data = Db::name('sensor')->where('nodenum', $serial)->order('id desc')->paginate(10);
				$this->assign('datas', $data);
				return $this->fetch('show1');
				};break;
			case 2 : {
				$data = Db::name('nbbd')->where('device', $serial)->order('id desc')->paginate(10);
				$this->assign('datas', $data);
				return $this->fetch('show2');
				};break;
			case 3 : {
				$data = Db::name('tempandhum')->where('serial', $serial)->order('id desc')->paginate(10);
				$this->assign('datas', $data);
				return $this->fetch('show3');
				};break;
			case 4 : {
				$data = Db::name('tempandhum')->where('serial', $serial)->order('id desc')->paginate(10);
				$this->assign('datas', $data);
				return $this->fetch('show4');
				};break;
		}
	}
	
	public function deviceshow($aid)
	{
		if(session('username')==null)
		{
			$this->error('您未登录');
		}
		$data = Db::name('experiment_device')->where('aid', $aid)->order(['tid' => 'asc', 'id' => 'desc'])->paginate(10);
		$type = Db::name('experiment_type_store')->select();
        $this->assign('aid', $aid);
        $this->assign('devicelist', $data);
        $this->assign('type', $type);
		//print_r($type);
		return $this->fetch();
	}
	
	public function experimentalpanel($aid)
	{
		if(session('username')==null)
		{
			$this->error('您未登录');
		}
		$data = Db::name('experiment_device')->where('aid', $aid)->order(['tid' => 'asc', 'id' => 'desc'])->select();
		$type = Db::name('experiment_type_store')->select();
		$table = '';
		foreach($data as $k)
		{
			$typedata = Db::name('experiment_type_store')->where('id', $k['tid'])->find();
		    $sheet = $typedata['datasheet'];
		    $mapped = $typedata['name'];
		    $show = $typedata['show'];
		    $type = $typedata['typename'];
            $datas = Db::name($sheet)->where($mapped, $k['dserial'])->order('id desc')->find();
			$table=$table."<hr class=\"layui-bg-blue\">
			<table class=\"x-right\" style = \"width:400px\">
		<tr>
	            <td style = \"width:100px\">
				  <span class=\"x-right\">序列号:
				</td>
	            <td style = \"width:200px\">
				  <i class=\"i_count\">".$k['dserial']."</i></span>
				</td>
	            <td style = \"width:150px\">
				  <span class=\"x-right\">设备类型:
				</td>
	            <td style = \"width:250px\">
				  <i class=\"i_count\">".$type."</i></span>
				</td>
	        </tr>
		</table>";
		//if(count($datas) == 0) break;
			switch($k['tid'])
			{
				case 1 :
				{
					$table=$table."<table class=\"layui-table\">
        <thead>
          <tr>
            <th>设备名称</th>
            <th>时间</th>
            <th>温度</th>
            <th>湿度</th>
            <th>光照强度</th>
            <th>空气质量</th>
            <th>传输协议</th>
        </thead>
        <tbody>

        	<tr>
	            <td>". $k['devicename']."</td>
	            <td>". $datas['time']."</td>
	            <td><p>". $datas['temperature']."℃</p></td>
                <td><p>". $datas['humidity']."%</p></td>
	            <td><p>". $datas['light']."lx</p></td>
	            <td><p>". $datas['air']."ppm</p></td>
                <td>". $datas['msgtype']."</td>
	        </tr>
       
          </tbody>
        </table>";
				};break;
				case 2 :
				{
					$table=$table."<table class=\"layui-table\">
        <thead>
          <tr>
            <th>设备名称</th>
            <th>时间</th>
            <th>纬度</th>
            <th>经度</th>
            <th>温度</th>
            <th>湿度</th>
            <th>操作</th>
        </thead>
        <tbody>

        	<tr>
	            <td>". $k['devicename']."</td>
	            <td>". $datas['time']."</td>
	            <td><p>". $datas['ns'].$datas['latitude']."°</p></td>
                <td><p>". $datas['ew'].$datas['longitude']."°</p></td>
	            <td><p>". $datas['temperature']."℃</p></td>
	            <td><p>". $datas['humidity']."%</p></td>
	            <td>
	             	<button onclick=\"x_admin_show('地图显示','/platform/show/map/latitude/".$datas['latitude']."/longitude/".$datas['longitude']."',800,600)\" class=\"layui-btn layui-btn-mini\">查看</button>
	        </tr>
       
          </tbody>
        </table>";
				};break;
				case 3 :
				{
					$table=$table."<table class=\"layui-table\">
        <thead>
          <tr>
            <th>设备名称</th>
            <th>时间</th>
            <th>温度</th>
            <th>湿度</th>
            <th>传输协议</th>
        </thead>
        <tbody>

        	<tr>
	            <td>". $k['devicename']."</td>
	            <td>". $datas['time']."</td>
	            <td><p>". $datas['temp']."℃</p></td>
	            <td><p>". $datas['hum']."%</p></td>
	            <td>". $datas['msgtype']."</td>
	        </tr>
       
          </tbody>
        </table>";
				};break;
				case 4 :
				{
					if($datas['state'] == 1) $sta = "开"; else $sta = "关";
					$table=$table."<button onclick=\"On('".$k['dserial']."')\" class=\"layui-btn\">开</button>
		                           <button onclick=\"Off('".$k['dserial']."')\" class=\"layui-btn\">关</button>
		<table class=\"layui-table\">
        <thead>
          <tr>
            <th>设备名称</th>
            <th>时间</th>
            <th>开关状态</th>
            <th>传输协议</th>
        </thead>
        <tbody>

        	<tr>
	            <td>". $k['devicename']."</td>
	            <td>". $datas['time']."</td>
	            <td>".$sta."</td>
	            <td>". $datas['msgtype']."</td>
	        </tr>
       
          </tbody>
        </table>";
				};break;
				case 5 :
				{
					$table=$table."<table class=\"layui-table\">
        <thead>
          <tr>
            <th>设备名称</th>
            <th>时间</th>
            <th>温度</th>
            <th>传输协议</th>
        </thead>
        <tbody>

        	<tr>
	            <td>". $k['devicename']."</td>
	            <td>". $datas['time']."</td>
	            <td><p>". $datas['data']." ℃</p></td>
	            <td>". $datas['msgtype']."</td>
	        </tr>
       
          </tbody>
        </table>";
				};break;
				case 6 :
				{
					$table=$table."<table class=\"layui-table\">
        <thead>
          <tr>
            <th>设备名称</th>
            <th>时间</th>
            <th>湿度</th>
            <th>传输协议</th>
        </thead>
        <tbody>

        	<tr>
	            <td>". $k['devicename']."</td>
	            <td>". $datas['time']."</td>
	            <td><p>". $datas['data']." %</p></td>
	            <td>". $datas['msgtype']."</td>
	        </tr>
       
          </tbody>
        </table>";
				};break;
				case 7 :
				{
					$table=$table."<table class=\"layui-table\">
        <thead>
          <tr>
            <th>设备名称</th>
            <th>时间</th>
            <th>距离</th>
            <th>传输协议</th>
        </thead>
        <tbody>

        	<tr>
	            <td>". $k['devicename']."</td>
	            <td>". $datas['time']."</td>
	            <td><p>". $datas['data']." mm</p></td>
	            <td>". $datas['msgtype']."</td>
	        </tr>
       
          </tbody>
        </table>";
				};break;
				case 8 :
				{
					$table=$table."<table class=\"layui-table\">
        <thead>
          <tr>
            <th>设备名称</th>
            <th>时间</th>
            <th>光照度</th>
            <th>传输协议</th>
        </thead>
        <tbody>

        	<tr>
	            <td>". $k['devicename']."</td>
	            <td>". $datas['time']."</td>
	            <td><p>". $datas['data']." lx</p></td>
	            <td>". $datas['msgtype']."</td>
	        </tr>
       
          </tbody>
        </table>";
				};break;
				case 9 :
				{
					$table=$table."<table class=\"layui-table\">
        <thead>
          <tr>
            <th>设备名称</th>
            <th>时间</th>
            <th>频率</th>
            <th>传输协议</th>
        </thead>
        <tbody>

        	<tr>
	            <td>". $k['devicename']."</td>
	            <td>". $datas['time']."</td>
	            <td><p>". $datas['data']." 次/min</p></td>
	            <td>". $datas['msgtype']."</td>
	        </tr>
       
          </tbody>
        </table>";
				};break;
				case 10 :
				{
					$table=$table."<table class=\"layui-table\">
        <thead>
          <tr>
            <th>设备名称</th>
            <th>时间</th>
            <th>霍尔值</th>
            <th>传输协议</th>
        </thead>
        <tbody>

        	<tr>
	            <td>". $k['devicename']."</td>
	            <td>". $datas['time']."</td>
	            <td><p>". $datas['data']." GS</p></td>
	            <td>". $datas['msgtype']."</td>
	        </tr>
       
          </tbody>
        </table>";
				};break;
				case 11 :
				{
					$table=$table."<table class=\"layui-table\">
        <thead>
          <tr>
            <th>设备名称</th>
            <th>时间</th>
            <th>距离</th>
            <th>传输协议</th>
        </thead>
        <tbody>

        	<tr>
	            <td>". $k['devicename']."</td>
	            <td>". $datas['time']."</td>
	            <td><p>". $datas['data']." mm</p></td>
	            <td>". $datas['msgtype']."</td>
	        </tr>
       
          </tbody>
        </table>";
				};break;
				case 12 :
				{
					$table=$table."<table class=\"layui-table\">
        <thead>
          <tr>
            <th>设备名称</th>
            <th>时间</th>
            <th>角度</th>
            <th>传输协议</th>
        </thead>
        <tbody>

        	<tr>
	            <td>". $k['devicename']."</td>
	            <td>". $datas['time']."</td>
	            <td><p>". $datas['data']." °</p></td>
	            <td>". $datas['msgtype']."</td>
	        </tr>
       
          </tbody>
        </table>";
				};break;
				case 15 :
				{
					$table=$table."<table class=\"layui-table\">
        <thead>
          <tr>
            <th>设备名称</th>
            <th>时间</th>
            <th>气压</th>
            <th>传输协议</th>
        </thead>
        <tbody>

        	<tr>
	            <td>". $k['devicename']."</td>
	            <td>". $datas['time']."</td>
	            <td><p>". $datas['data']." kPa</p></td>
	            <td>". $datas['msgtype']."</td>
	        </tr>
       
          </tbody>
        </table>";
				};break;
				case 16 :
				{
					$table=$table."<table class=\"layui-table\">
        <thead>
          <tr>
            <th>设备名称</th>
            <th>时间</th>
            <th>PM2.5浓度</th>
            <th>传输协议</th>
        </thead>
        <tbody>

        	<tr>
	            <td>". $k['devicename']."</td>
	            <td>". $datas['time']."</td>
	            <td><p>". $datas['data']." μg/m3</p></td>
	            <td>". $datas['msgtype']."</td>
	        </tr>
       
          </tbody>
        </table>";
				};break;
				case 17 :
				{
					$table=$table."<table class=\"layui-table\">
        <thead>
          <tr>
            <th>设备名称</th>
            <th>时间</th>
            <th>气敏</th>
            <th>传输协议</th>
        </thead>
        <tbody>

        	<tr>
	            <td>". $k['devicename']."</td>
	            <td>". $datas['time']."</td>
	            <td><p>". $datas['data']." ppm</p></td>
	            <td>". $datas['msgtype']."</td>
	        </tr>
       
          </tbody>
        </table>";
				};break;
				case 18 :
				{
					$table=$table."<table class=\"layui-table\">
        <thead>
          <tr>
            <th>设备名称</th>
            <th>时间</th>
            <th>压力</th>
            <th>传输协议</th>
        </thead>
        <tbody>

        	<tr>
	            <td>". $k['devicename']."</td>
	            <td>". $datas['time']."</td>
	            <td><p>". $datas['data']." g</p></td>
	            <td>". $datas['msgtype']."</td>
	        </tr>
       
          </tbody>
        </table>";
				};break;
				case 19 :
				{
					$table=$table."<table class=\"layui-table\">
        <thead>
          <tr>
            <th>设备名称</th>
            <th>时间</th>
            <th>角度</th>
            <th>传输协议</th>
        </thead>
        <tbody>

        	<tr>
	            <td>". $k['devicename']."</td>
	            <td>". $datas['time']."</td>
	            <td><p>". $datas['data']." °</p></td>
	            <td>". $datas['msgtype']."</td>
	        </tr>
       
          </tbody>
        </table>";
				};break;
				case 20 :
				{
					$table=$table."<table class=\"layui-table\">
        <thead>
          <tr>
            <th>设备名称</th>
            <th>时间</th>
            <th>电压</th>
            <th>传输协议</th>
        </thead>
        <tbody>

        	<tr>
	            <td>". $k['devicename']."</td>
	            <td>". $datas['time']."</td>
	            <td><p>". $datas['data']." V</p></td>
	            <td>". $datas['msgtype']."</td>
	        </tr>
       
          </tbody>
        </table>";
				};break;
				case 21 :
				{
					$table=$table."<table class=\"layui-table\">
        <thead>
          <tr>
            <th>设备名称</th>
            <th>时间</th>
            <th>电流</th>
            <th>传输协议</th>
        </thead>
        <tbody>

        	<tr>
	            <td>". $k['devicename']."</td>
	            <td>". $datas['time']."</td>
	            <td><p>". $datas['data']." mA</p></td>
	            <td>". $datas['msgtype']."</td>
	        </tr>
       
          </tbody>
        </table>";
				};break;
				case 22 :
				{
					$table=$table."<table class=\"layui-table\">
        <thead>
          <tr>
            <th>设备名称</th>
            <th>时间</th>
            <th>紫外线</th>
            <th>传输协议</th>
        </thead>
        <tbody>

        	<tr>
	            <td>". $k['devicename']."</td>
	            <td>". $datas['time']."</td>
	            <td><p>". $datas['data']." UVI</p></td>
	            <td>". $datas['msgtype']."</td>
	        </tr>
       
          </tbody>
        </table>";
				};break;
				case 24 :
				case 25 :
				case 26 :
				case 27 :
				case 28 :
				case 29 :
				{
					if($datas['data'] == 0) $sta = "开"; else $sta = "关";
					$table=$table."<table class=\"layui-table\">
        <thead>
          <tr>
            <th>设备名称</th>
            <th>时间</th>
            <th>状态</th>
            <th>传输协议</th>
        </thead>
        <tbody>

        	<tr>
	            <td>". $k['devicename']."</td>
	            <td>". $datas['time']."</td>
	            <td>". $sta."</td>
	            <td>". $datas['msgtype']."</td>
	        </tr>
       
          </tbody>
        </table>";
				};break;
				case 30 :
				{
					$table=$table."<table class=\"layui-table\"  lay-skin=\"nob\">
        <tbody>
        	<tr>
	            <td>
				<input type=\"range\" id=\"p".$k['dserial']."\" value=\"50\" name=\"p".$k['dserial']."\" 
				onchange=\"javascript:document.getElementById('pwm".$k['dserial']."').value=document.getElementById('p".$k['dserial']."').value\" 
				max=\"100\" min=\"0\" lay-verify=\"required|dserial\" class=\"layui-input\">
				</td>
	            <td>
				<input type=\"text\" id=\"pwm".$k['dserial']."\" value=\"50\" name=\"pwm".$k['dserial']."\" 
				onchange=\"javascript:document.getElementById('p".$k['dserial']."').value=document.getElementById('pwm".$k['dserial']."').value\" 
				lay-verify=\"required|dserial\" class=\"layui-input\">
				</td>
				<td>
				<button onclick=\"managemotor('".$k['dserial']."')\" class=\"layui-btn layui-btn-big\">设置</button>
				</td>
	        </tr>
       
        </tbody>
		</table>
					<table class=\"layui-table\">
        <thead>
          <tr>
            <th>设备名称</th>
            <th>时间</th>
            <th>速度</th>
            <th>传输协议</th>
        </thead>
        <tbody>

        	<tr>
	            <td>". $k['devicename']."</td>
	            <td>". $datas['time']."</td>
	            <td>". $datas['data']."</td>
	            <td>". $datas['msgtype']."</td>
	        </tr>
       
          </tbody>
        </table>";
				};break;
				case 31 :
				{
					$table=$table."<table class=\"layui-table\"  lay-skin=\"nob\">
        <tbody>
        	<tr>
	            <td>
				<input type=\"range\" id=\"p".$k['dserial']."\" value=\"50\" name=\"p".$k['dserial']."\" 
				onchange=\"javascript:document.getElementById('pwm".$k['dserial']."').value=document.getElementById('p".$k['dserial']."').value\" 
				max=\"100\" min=\"0\" lay-verify=\"required|dserial\" class=\"layui-input\">
				</td>
	            <td>
				<input type=\"text\" id=\"pwm".$k['dserial']."\" value=\"50\" name=\"pwm".$k['dserial']."\" 
				onchange=\"javascript:document.getElementById('p".$k['dserial']."').value=document.getElementById('pwm".$k['dserial']."').value\" 
				lay-verify=\"required|dserial\" class=\"layui-input\">
				</td>
				<td>
				<button onclick=\"managesteer('".$k['dserial']."')\" class=\"layui-btn layui-btn-big\">设置</button>
				</td>
	        </tr>
       
        </tbody>
		</table>
					<table class=\"layui-table\">
        <thead>
          <tr>
            <th>设备名称</th>
            <th>时间</th>
            <th>速度</th>
            <th>传输协议</th>
        </thead>
        <tbody>

        	<tr>
	            <td>". $k['devicename']."</td>
	            <td>". $datas['time']."</td>
	            <td>". $datas['data']."</td>
	            <td>". $datas['msgtype']."</td>
	        </tr>
       
          </tbody>
        </table>";
				};break;
				case 32 :
				{
					$table=$table."<table class=\"layui-table\"  lay-skin=\"nob\">
        <tbody>
        	<tr>
	            <td>
				<input type=\"range\" id=\"R".$k['dserial']."\" value=\"128\" name=\"R".$k['dserial']."\" 
				onchange=\"javascript:document.getElementById('red".$k['dserial']."').value=document.getElementById('R".$k['dserial']."').value\" 
				max=\"255\" min=\"0\" lay-verify=\"required|dserial\" class=\"layui-input\">
				</td>
	            <td>
				<input type=\"range\" id=\"G".$k['dserial']."\" value=\"128\" name=\"G".$k['dserial']."\" 
				onchange=\"javascript:document.getElementById('green".$k['dserial']."').value=document.getElementById('G".$k['dserial']."').value\" 
				max=\"255\" min=\"0\" lay-verify=\"required|dserial\" class=\"layui-input\">
				</td>
	            <td>
				<input type=\"range\" id=\"B".$k['dserial']."\" value=\"128\" name=\"B".$k['dserial']."\" 
				onchange=\"javascript:document.getElementById('blue".$k['dserial']."').value=document.getElementById('B".$k['dserial']."').value\" 
				max=\"255\" min=\"0\" lay-verify=\"required|dserial\" class=\"layui-input\">
				</td>
	            <td rowspan=\"2\">
				<button onclick=\"manageled('".$k['dserial']."')\" class=\"layui-btn layui-btn-big\">设置</button>
				</td>
	        </tr>
        	<tr>
	            <td>
				<input type=\"text\" id=\"red".$k['dserial']."\" value=\"128\" name=\"red".$k['dserial']."\" 
				onchange=\"javascript:document.getElementById('R".$k['dserial']."').value=document.getElementById('red".$k['dserial']."').value\" 
				lay-verify=\"required|dserial\" class=\"layui-input\">
				</td>
	            <td>
				<input type=\"text\" id=\"green".$k['dserial']."\" value=\"128\" name=\"green".$k['dserial']."\" 
				onchange=\"javascript:document.getElementById('G".$k['dserial']."').value=document.getElementById('green".$k['dserial']."').value\" 
				lay-verify=\"required|dserial\" class=\"layui-input\">
				</td>
	            <td>
				<input type=\"text\" id=\"blue".$k['dserial']."\" value=\"128\" name=\"blue".$k['dserial']."\" 
				onchange=\"javascript:document.getElementById('B".$k['dserial']."').value=document.getElementById('blue".$k['dserial']."').value\" 
				lay-verify=\"required|dserial\" class=\"layui-input\">
				</td>
	        </tr>
       
        </tbody>
		</table>
					<table class=\"layui-table\">
        <thead>
          <tr>
            <th>设备名称</th>
            <th>时间</th>
            <th>R(Red)</th>
            <th>G(Green)</th>
            <th>B(Blue)</th>
            <th>传输协议</th>
        </thead>
        <tbody>

        	<tr>
	            <td>". $k['devicename']."</td>
	            <td>". $datas['time']."</td>
	            <td>". $datas['r']."</td>
	            <td>". $datas['g']."</td>
	            <td>". $datas['b']."</td>
	            <td>". $datas['msgtype']."</td>
	        </tr>
       
          </tbody>
        </table>";
				};break;
				case 33 :
				{
					if($datas['data'] == 0) $sta = "开"; else $sta = "关";
					$table=$table."<button onclick=\"managelock(0,'".$k['dserial']."')\" class=\"layui-btn\">开</button>
		                           <button onclick=\"managelock(1,'".$k['dserial']."')\" class=\"layui-btn\">关</button>
					<table class=\"layui-table\">
        <thead>
          <tr>
            <th>设备名称</th>
            <th>时间</th>
            <th>开关状态</th>
            <th>传输协议</th>
        </thead>
        <tbody>

        	<tr>
	            <td>". $k['devicename']."</td>
	            <td>". $datas['time']."</td>
	            <td>". $sta."</td>
	            <td>". $datas['msgtype']."</td>
	        </tr>
       
          </tbody>
        </table>";
				};break;
				case 34 :
				{
					$table=$table."<table class=\"layui-table\"  lay-skin=\"nob\">
        <tbody>
        	<tr>
	            <td>
				<input type=\"range\" id=\"p".$k['dserial']."\" value=\"50\" name=\"p".$k['dserial']."\" 
				onchange=\"javascript:document.getElementById('pwm".$k['dserial']."').value=document.getElementById('p".$k['dserial']."').value\" 
				max=\"100\" min=\"0\" lay-verify=\"required|dserial\" class=\"layui-input\">
				</td>
	            <td>
				<input type=\"text\" id=\"pwm".$k['dserial']."\" value=\"50\" name=\"pwm".$k['dserial']."\" 
				onchange=\"javascript:document.getElementById('p".$k['dserial']."').value=document.getElementById('pwm".$k['dserial']."').value\" 
				lay-verify=\"required|dserial\" class=\"layui-input\">
				</td>
				<td>
				<button onclick=\"managefan('".$k['dserial']."')\" class=\"layui-btn layui-btn-big\">设置</button>
				</td>
	        </tr>
       
        </tbody>
		</table>
					<table class=\"layui-table\">
        <thead>
          <tr>
            <th>设备名称</th>
            <th>时间</th>
            <th>速度</th>
            <th>传输协议</th>
        </thead>
        <tbody>

        	<tr>
	            <td>". $k['devicename']."</td>
	            <td>". $datas['time']."</td>
	            <td>". $datas['data']."</td>
	            <td>". $datas['msgtype']."</td>
	        </tr>
       
          </tbody>
        </table>";
				};break;
				case 35 :
				{
					if($datas['data'] == 0) $sta = "开"; else $sta = "关";
					$table=$table."<button onclick=\"managewarn(0,'".$k['dserial']."')\" class=\"layui-btn\">开</button>
		                           <button onclick=\"managewarn(1,'".$k['dserial']."')\" class=\"layui-btn\">关</button>
					<table class=\"layui-table\">
        <thead>
          <tr>
            <th>设备名称</th>
            <th>时间</th>
            <th>开关状态</th>
            <th>传输协议</th>
        </thead>
        <tbody>

        	<tr>
	            <td>". $k['devicename']."</td>
	            <td>". $datas['time']."</td>
	            <td>". $sta."</td>
	            <td>". $datas['msgtype']."</td>
	        </tr>
       
          </tbody>
        </table>";
				};break;
				case 36 :
				{
					if($datas['data'] == 0) $sta = "开"; else $sta = "关";
					$table=$table."<button onclick=\"managerelay(0,'".$k['dserial']."')\" class=\"layui-btn\">开</button>
		                           <button onclick=\"managerelay(1,'".$k['dserial']."')\" class=\"layui-btn\">关</button>
					<table class=\"layui-table\">
        <thead>
          <tr>
            <th>设备名称</th>
            <th>时间</th>
            <th>开关状态</th>
            <th>传输协议</th>
        </thead>
        <tbody>

        	<tr>
	            <td>". $k['devicename']."</td>
	            <td>". $datas['time']."</td>
	            <td>". $sta."</td>
	            <td>". $datas['msgtype']."</td>
	        </tr>
       
          </tbody>
        </table>";
				};break;
			}
			
		}
        $this->assign('aid', $aid);
        $this->assign('devicelist', $data);
        $this->assign('type', $type);
		$this->assign('table', $table);
		//print_r($type);
		return $this->fetch();
	}

	public function deletesensordatas()
    {
		if(session('username')==null)
		{
			$this->error('您未登录');
		}
        $datas = $this->request->post('datas');
		//foreach($datas as $k => $v)
		//{
		Db::name('sensor')->where('id', $datas)->delete();
		//}
		//$this->success($datas[0]);
		$this->success("全部删除成功");
    }
}
