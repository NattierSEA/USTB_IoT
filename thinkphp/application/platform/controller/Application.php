<?php
namespace app\platform\controller;

use think\Controller;
use think\Db;
use think\Session;
use think\GatewayWorker\Lib\Gateway;
use Exception;
use think\GatewayWorker\Protocols\GatewayProtocol;
use think\GatewayWorker\Workerman\Connection\TcpConnection;


class Application extends Controller
{

    public function index(){
        return $this->fetch('login');
    }
	
	public function applicationshow()
	{
		if(session('username')==null)
		{
			$this->error('您未登录');
		}
		$appdevice = [];
		$appindustry = [];
		$con = [];
		$uid = session('user_id');
		$applist = Db::name('experiment_application')->where('uid', $uid)->order('id asc')->paginate(10);
		
		foreach ($applist as $v)
		{
			$num = Db::name('experiment_device')->where('aid',$v['id'])->select();
			$appdevice[] = count($num);
			$industry = Db::name('experiment_industry')->where('id',$v['industry'])->find();
			$appindustry[] = $industry['industry'];
			$connecttype = Db::name('connect_type')->where('id',$v['connect'])->find();
			$con[] = $connecttype['name'];
		}
		
        $this->assign('appdevice', $appdevice);
        $this->assign('appindustry', $appindustry);
        $this->assign('applist', $applist);
        $this->assign('connect', $con);
		//GateWay::sendToAll("zhanshi\r\n");
		//Gateway::sendToClient('7f0000010b540000000e', "123\n");
		return $this->fetch();
	}
	
    //编辑页面
    public function applicationedit($id)
    {
		if(session('username')==null)
		{
			$this->error('您未登录');
		}
        $applicationdata = Db::name('experiment_application')
            ->where('id', $id)
            ->find();
        $industry = Db::name('experiment_industry')
        ->order('id asc')
        ->select();
        $connect = Db::name('connect_type')
        ->order('id asc')
        ->select();
        $this->assign('applicationdata', $applicationdata);
        $this->assign('industry', $industry);
        $this->assign('connect', $connect);
        $this->assign('aid', $id);
		//GateWay::sendToAll("bianji\r\n");
		
        return $this->fetch();
    }
	
	public function editsubmit()
    {
		if(session('username')==null)
		{
			$this->error('您未登录');
		}
		$id = $this->request->post('id');
		$industry = $this->request->post('industry');
		$appname = $this->request->post('appname');
		$connect = $this->request->post('connect');
		$sta = $this->request->post('sta');
		$db = Db::name('experiment_application')->where('id', $id)->update(['industry' => $industry,'appname' =>$appname,'sta' =>$sta,'connect' =>$connect]);
		$this->success('编辑成功');
    }
	
	
	public function deleteapplication()
    {
		if(session('username')==null)
		{
			$this->error('您未登录');
		}
        $id = $this->request->post('id');
		$db = Db::name('experiment_application')
		->where('id', $id)
		->delete();
		$db = Db::name('experiment_device')
		->where('aid', $id)
		->delete();
		$this->success('删除成功');
    }
	
	
    //打开新增界面
    public function addapplication()
    {
		if(session('username')==null)
		{
			$this->error('您未登录');
		}
        $industry = Db::name('experiment_industry')
        ->order('id asc')
        ->select();
        $connect = Db::name('connect_type')
        ->order('id asc')
        ->select();
		
        $this->assign('industry', $industry);
        $this->assign('connect', $connect);
		return $this->fetch();
    }
	
    public function addapp()
    {
		if(session('username')==null)
		{
			$this->error('您未登录');
		}
		$appname = $this->request->post('appname');
		$industry = $this->request->post('industry');
		$connect = $this->request->post('connect');
		$uid = session('user_id');
        date_default_timezone_set('PRC'); 
		$time = date('Y-m-d H:i:s', time());
		
		$db = Db::name('experiment_application')->insert(['uid'=> $uid,'industry' => $industry,'appname'=>$appname,'createtime'=>$time,'connect'=>$connect]);
		$lid = Db::name('experiment_application')->getLastInsID();
		$key = substr(md5($lid),0,8);
		$ndb = Db::name('experiment_application')->where('id', $lid)->update(['key' =>$key]);
		$this->success('添加成功');
    }
	
    public function changekey()
    {
		if(session('username')==null)
		{
			$this->error('您未登录');
		}
		$chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
		$key = "";
		$aid = $this->request->post('id');
		$uid = session('user_id');
		
		$app = Db::name('experiment_application')->where('id', $aid)->find();
		if($uid == $app['uid'])
		{
			for ( $i = 0; $i < 8; $i++ )
			{
				$key .= $chars[ mt_rand(0, strlen($chars) - 1) ];
			}
			Db::name('experiment_application')->where('id', $aid)->update(['key' =>$key]);
		}
		$this->success('重置成功');
    }

}
