<?php
namespace app\platform\controller;

use think\Controller;
use think\Db;
use think\Session;
use think\Validate;

class Device extends Controller
{

    public function index(){
		if(session('username')==null)
		{
			$this->error('您未登录');
		}
        return $this->fetch('login');
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
	
    //编辑页面
    public function deviceedit($id)
    {
		if(session('username')==null)
		{
			$this->error('您未登录');
		}
        
        $devicedata = Db::name('experiment_device')
            ->where('id', $id)
            ->find();
        $experimenttype = Db::name('experiment_type_store')
		->where('sta', 1)
        ->order('id asc')
        ->select();
        $this->assign('devicedata', $devicedata);
        $this->assign('experimenttype', $experimenttype);
        //$this->assign('aid', 4);
		
        return $this->fetch('deviceedit');
    }
	
	public function editsubmit()
    {
		if(session('username')==null)
		{
			$this->error('您未登录');
		}
		$id = $this->request->post('id');
		$devicename = $this->request->post('devicename');
		$dserial = $this->request->post('dserial');
		$tid = $this->request->post('tid');
		$sta = $this->request->post('sta');
		$res = Db::name('experiment_device')->where('dserial', $dserial)->find();
		if($res==null || $res['dserial'] == $dserial)
		{
			if(strlen($dserial) == 8)
			{
				$db = Db::name('experiment_device')->where('id', $id)->update(['devicename' => $devicename,'dserial' =>$dserial,'tid' =>$tid,'sta' =>$sta]);
				$this->success('编辑成功');
			}
			else
				$this->error('序列号长度必须是8位');
		    
		}
		else
		{
			$this->error('序列号已存在');
		}
    }
	

	
	
	public function deletedevice()
    {
		if(session('username')==null)
		{
			$this->error('您未登录');
		}
		if(session('username')==null)
		{
			$this->error('您未登录');
		}
        $id = $this->request->post('id');
		$db = Db::name('experiment_device')
		->where('id', $id)
		->delete();
		$this->success('删除成功');
    }
	
	
    //打开新增界面
    public function addshow($aid)
    {
		if(session('username')==null)
		{
			$this->error('您未登录');
		}
		$chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
		$serial = '';
		$devicetype = Db::name('experiment_type_store')->where('sta', 1)->order('id asc')->select();
		do{
			$serial = "";
			for ( $i = 0; $i < 8; $i++ )
			{
				$serial .= $chars[ mt_rand(0, strlen($chars) - 1) ];
				}
			$res = Db::name('experiment_device')->where('dserial', $serial)->find();
		}while($res != null);

		
        $this->assign('devicetype', $devicetype);
        $this->assign('serial', $serial);
        $this->assign('aid', $aid);
		return $this->fetch('addshow');
    }
	
    public function adddevice()
    {
		if(session('username')==null)
		{
			$this->error('您未登录');
		}
		$aid = $this->request->post('aid');
		$tid = $this->request->post('tid');
		$devicename = $this->request->post('devicename');
		$dserial = $this->request->post('dserial');
        date_default_timezone_set('PRC'); 
		$time = date('Y-m-d H:i:s', time());
		
		$res = Db::name('experiment_device')->where('dserial', $dserial)->find();
		if($res==null)
		{
			if(strlen($dserial)==8)
			{
				$db = Db::name('experiment_device')->insert(['aid'=> $aid,'tid' => $tid,'devicename'=>$devicename,'dserial'=>$dserial,'createtime'=>$time]);
			    $this->success('添加成功');
			}
			else
				$this->error('序列号长度必须是8位');
		}
		else
		{
			$this->error('序列号已存在');
		}
    }

}
