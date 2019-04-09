<?php
namespace app\admin\controller;

use think\Db;
use think\Session;
use think\Controller;
class DbManage extends Main
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
   function clear(){
	   $id = $this->request->post('id');
	   $days = $this->request->post('days');
	   $sheet = Db::name('experiment_type_store')->where('id',$id)->value('datasheet');
	   date_default_timezone_set('PRC'); 
	   $start = date('Y-m-d H:i:s', strtotime("-".$days." day"));
	   $end = date('Y-m-d H:i:s', time());
	   //$map['time'] = array('gt',$time) ;
	   //$map['time']=array(array('EGT',$start),array('ELT',$end));
	   $map['time'] =array('ELT',$start);
	   $res = Db::name($sheet)->where($map)->delete();
	   $count = count($res);
	   if($res == 0)
		   $count = 0;
	   $this->success("保留".$days."天数据，删除".$count."条数据");
  }
   function del(){
	   $id = $this->request->post('id');
	   $sheet = Db::name('experiment_type_store')->where('id',$id)->value('datasheet');
	   $mysqli = mysqli_connect("localhost", "root", "root", "tp5");
	   
	   if (mysqli_connect_errno()) {
		   printf("Connect failed: %s\n", mysqli_connect_error());
		   exit();
		   } else {
			   $sql = "TRUNCATE TABLE qs_".$sheet;
			   $res = mysqli_query($mysqli, $sql);
			   }

		mysqli_close($mysqli);
	   $this->success("数据已清空");
  }
}
