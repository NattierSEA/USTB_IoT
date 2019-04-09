<?php
namespace app\admin\controller;

use think\Db;
use think\Session;
use think\Controller;
class DcManage extends Main
{
  function index(){
    $db_names =  Db::getTables();
    $count = count($db_names);
    $this->assign('db_names',$db_names);
    $this->assign('count',$count);
    return $this->fetch();
  }
   function manage(){
    $db_names =  Db::name('experiment_type_store')->select();
    $count = count($db_names);
    $this->assign('db_names',$db_names);
    $this->assign('count',$count);
    return $this->fetch();
  }
   function set(){
    $id = $this->request->post('id');
	$sta = $this->request->post('sta');
	
	if ($sta == 1)
	{
		$db = Db::name('experiment_type_store')->where('id', $id)->update(['sta' => 1]);
		$this->success("设备启用成功");
	}
    if ($sta == 0)
	{
		$db = Db::name('experiment_type_store')->where('id', $id)->update(['sta' => 0]);
		$this->success("设备禁用成功");
	}
  }
  
   function changename($id){
	   $name = Db::name('experiment_type_store')->where('id', $id)->value('typename');
	   $this->assign('id',$id);
	   $this->assign('name',$name);
	   return $this->fetch();
  }
  
   function changenm(){
	   $id = $this->request->post('id');
	   $name = $this->request->post('name');
	   Db::name('experiment_type_store')->where('id', $id)->update(['typename' => $name]);
	   $this->success("设备设置成功");
  }
}
