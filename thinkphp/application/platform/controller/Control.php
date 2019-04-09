<?php
namespace app\platform\controller;

use think\Controller;
use think\Db;
use think\Session;
use think\Validate;
use think\GatewayWorker\Lib\Gateway;

class Control extends Controller
{

    public function index(){
        return $this->fetch('login');
    }
	
	public function sendon()
    {
		if(session('username')==null)
		{
			$this->error('您未登录');
		}
        $id = $this->request->post('id');
		$client = Db::name('client')->where('serial', $id)->order('id desc')->find();
        date_default_timezone_set('PRC'); 
		$time = date('Y-m-d H:i:s', time());
		if($client == null)
			$this->error('该设备不在线');
		else
		{
			$client_id = $client['number'];
			Gateway::sendToClient($client_id, "1");
			Db::name('airfan')
                ->insert(['serial'=>$id,'state'=>1, 'time'=>$time, 'msgtype'=>'TCP']);
			$this->success('开启成功');
		}
    }
	
	public function sendoff()
    {
		if(session('username')==null)
		{
			$this->error('您未登录');
		}
        $id = $this->request->post('id');
		$client = Db::name('client')->where('serial', $id)->order('id desc')->find();
        date_default_timezone_set('PRC'); 
		$time = date('Y-m-d H:i:s', time());
		if($client == null)
			$this->error('该设备不在线');
		else
		{
			$client_id = $client['number'];
			Gateway::sendToClient($client_id, "0");
			Db::name('airfan')
                ->insert(['serial'=>$id,'state'=>0, 'time'=>$time, 'msgtype'=>'TCP']);
			$this->success('关闭成功');
		}
    }
	
	public function rgbled()
    {
		if(session('username')==null)
		{
			$this->error('您未登录');
		}
        $id = $this->request->post('id');
        $red = $this->request->post('red');
        $green = $this->request->post('green');
        $blue = $this->request->post('blue');
		$client = Db::name('client')->where('serial', $id)->order('id desc')->find();
        date_default_timezone_set('PRC'); 
		$time = date('Y-m-d H:i:s', time());
		if($client == null)
			$this->error('该设备不在线');
		else
		{
			$r = str_pad(''.$red,3,'0',STR_PAD_LEFT);
			$g = str_pad(''.$green,3,'0',STR_PAD_LEFT);
			$b = str_pad(''.$blue,3,'0',STR_PAD_LEFT);
			$client_id = $client['number'];
			Gateway::sendToClient($client_id, $r.$g.$b);
			Db::name('rgbled')
                ->insert(['serial'=>$id,'r'=>$red,'g'=>$green,'b'=>$blue, 'time'=>$time, 'msgtype'=>'TCP']);
			$this->success('发送成功');
		}
    }
	
	public function pwmmotor()
    {
		if(session('username')==null)
		{
			$this->error('您未登录');
		}
        $id = $this->request->post('id');
        $pwm = $this->request->post('pwm');
		$client = Db::name('client')->where('serial', $id)->order('id desc')->find();
        date_default_timezone_set('PRC'); 
		$time = date('Y-m-d H:i:s', time());
		if($client == null)
			$this->error('该设备不在线');
		else
		{
			$p = str_pad(''.$pwm,3,'0',STR_PAD_LEFT);
			$client_id = $client['number'];
			Gateway::sendToClient($client_id, $p);
			Db::name('zhiliudianji')
                ->insert(['serial'=>$id,'data'=>$pwm, 'time'=>$time, 'msgtype'=>'TCP']);
			$this->success('发送成功');
		}
    }
	
	public function steer()
    {
		if(session('username')==null)
		{
			$this->error('您未登录');
		}
        $id = $this->request->post('id');
        $pwm = $this->request->post('pwm');
		$client = Db::name('client')->where('serial', $id)->order('id desc')->find();
        date_default_timezone_set('PRC'); 
		$time = date('Y-m-d H:i:s', time());
		if($client == null)
			$this->error('该设备不在线');
		else
		{
			$p = str_pad(''.$pwm,3,'0',STR_PAD_LEFT);
			$client_id = $client['number'];
			Gateway::sendToClient($client_id, $p);
			Db::name('duoji')
                ->insert(['serial'=>$id,'data'=>$pwm, 'time'=>$time, 'msgtype'=>'TCP']);
			$this->success('发送成功');
		}
    }
	
	public function fan()
    {
		if(session('username')==null)
		{
			$this->error('您未登录');
		}
        $id = $this->request->post('id');
        $pwm = $this->request->post('pwm');
		$client = Db::name('client')->where('serial', $id)->order('id desc')->find();
        date_default_timezone_set('PRC'); 
		$time = date('Y-m-d H:i:s', time());
		if($client == null)
			$this->error('该设备不在线');
		else
		{
			$p = str_pad(''.$pwm,3,'0',STR_PAD_LEFT);
			$client_id = $client['number'];
			Gateway::sendToClient($client_id, $p);
			Db::name('diandongfengshan')
                ->insert(['serial'=>$id,'data'=>$pwm, 'time'=>$time, 'msgtype'=>'TCP']);
			$this->success('发送成功');
		}
    }
	
	public function lock()
    {
		if(session('username')==null)
		{
			$this->error('您未登录');
		}
        $id = $this->request->post('id');
        $m = $this->request->post('m');
		$client = Db::name('client')->where('serial', $id)->order('id desc')->find();
        date_default_timezone_set('PRC'); 
		$time = date('Y-m-d H:i:s', time());
		if($client == null)
			$this->error('该设备不在线');
		else
		{
			$client_id = $client['number'];
			Gateway::sendToClient($client_id, $m);
			Db::name('zhinengmensuo')
                ->insert(['serial'=>$id,'data'=>$m, 'time'=>$time, 'msgtype'=>'TCP']);
			$this->success('发送成功');
		}
    }
	
	public function warner()
    {
		if(session('username')==null)
		{
			$this->error('您未登录');
		}
        $id = $this->request->post('id');
        $m = $this->request->post('m');
		$client = Db::name('client')->where('serial', $id)->order('id desc')->find();
        date_default_timezone_set('PRC'); 
		$time = date('Y-m-d H:i:s', time());
		if($client == null)
			$this->error('该设备不在线');
		else
		{
			$client_id = $client['number'];
			Gateway::sendToClient($client_id, $m);
			Db::name('baojingqi')
                ->insert(['serial'=>$id,'data'=>$m, 'time'=>$time, 'msgtype'=>'TCP']);
			$this->success('发送成功');
		}
    }
	
	public function relay()
    {
		if(session('username')==null)
		{
			$this->error('您未登录');
		}
        $id = $this->request->post('id');
        $m = $this->request->post('m');
		$client = Db::name('client')->where('serial', $id)->order('id desc')->find();
        date_default_timezone_set('PRC'); 
		$time = date('Y-m-d H:i:s', time());
		if($client == null)
			$this->error('该设备不在线');
		else
		{
			$client_id = $client['number'];
			Gateway::sendToClient($client_id, $m);
			Db::name('diancijidianqi')
                ->insert(['serial'=>$id,'data'=>$m, 'time'=>$time, 'msgtype'=>'TCP']);
			$this->success('发送成功');
		}
    }
	
}
