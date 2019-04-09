<?php
namespace app\platform\controller;

use think\Controller;
use think\Db;
use think\Session;
use think\Validate;

class Deletedatas extends Controller
{

    public function index(){
        return $this->fetch('login');
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
	
		public function deletenbbddatas()
    {
		if(session('username')==null)
		{
			$this->error('您未登录');
		}
        $datas = $this->request->post('datas');
		//foreach($datas as $k => $v)
		//{
		Db::name('nbbd')->where('id', $datas)->delete();
		//}
		//$this->success($datas[0]);
		$this->success("全部删除成功");
    }
	
		public function deletedata3()
    {
		if(session('username')==null)
		{
			$this->error('您未登录');
		}
        $datas = $this->request->post('id');
		//foreach($datas as $k => $v)
		//{
		Db::name('tempandhum')->where('id', $datas)->delete();
		//}
		//$this->success($datas[0]);
		$this->success("删除成功");
	}
	
		public function deletedatas3()
    {
		if(session('username')==null)
		{
			$this->error('您未登录');
		}
        $datas = $this->request->post('datas');
		//foreach($datas as $k => $v)
		//{
		Db::name('tempandhum')->where('id', $datas)->delete();
		//}
		//$this->success($datas[0]);
		$this->success("全部删除成功");
    }
	
		public function deletedata4()
    {
		if(session('username')==null)
		{
			$this->error('您未登录');
		}
        $datas = $this->request->post('id');
		//foreach($datas as $k => $v)
		//{
		Db::name('airfan')->where('id', $datas)->delete();
		//}
		//$this->success($datas[0]);
		$this->success("删除成功");
	}
	
		public function deleteserver()
    {
		if(session('username')==null)
		{
			$this->error('您未登录');
		}
        $id = $this->request->post('id');
		$serial = $this->request->post('serial');
		
		$device = Db::name('experiment_device')->where('dserial', $serial)->find();
		$devicetype = Db::name('experiment_type_store')->where('id', $device['tid'])->find();
		$name = '';
		$name = $devicetype['datasheet'];
		Db::name($name)->where('id', $id)->delete();
		
		$this->success("删除成功");
	}
	
		public function deleteservers()
    {
		if(session('username')==null)
		{
			$this->error('您未登录');
		}
        $id = $this->request->post('id');
		$serial = $this->request->post('serial');
		
		$device = Db::name('experiment_device')->where('dserial', $serial)->find();
		$devicetype = Db::name('experiment_type_store')->where('id', $device['tid'])->find();
		$name = '';
		$name = $devicetype['datasheet'];
		Db::name($name)->where('id', $id)->delete();
		
		$this->success("全部删除成功");
	}
}
