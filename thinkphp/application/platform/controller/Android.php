<?php
namespace app\platform\controller;

use \think\Controller;
use \think\Db;
use think\Session;
use think\Validate;
use think\GatewayWorker\Lib\Gateway;

class Android extends Controller
{

	public function huanjing()
    {
    	$serial = $this->request->post('serial');
		$data = Db::name('gongyehuanjing')->where('serial', $serial)->order(['id' => 'desc'])->find();
		if($data == null)
		{
			$result['state'] = 0;
		}
		else
		{
			$result['state'] = 1;
			$result['serial'] = $serial;
			$result['pm'] = intval(substr($data['data'], 0, 3));
			$result['temperature'] = floatval(substr($data['data'],3, 3)) / 10; 
			$result['humidity'] = floatval(substr($data['data'],6, 3)) / 10; 
			$result['rainfall'] = intval(substr($data['data'], 9, 3));
			$result['time'] = $data['time'];
			$result['msgtype'] = $data['msgtype'];
		}
		return json($result);
    }
}
