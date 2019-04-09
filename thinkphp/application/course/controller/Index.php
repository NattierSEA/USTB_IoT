<?php
namespace app\course\controller;
use think\Db;

class Index extends Main
{
    public function index()
    {
		if(session('username')!=null)
		{
			$uid=session('user_id');
			$userdata = Db::name('user')->where('id',$uid)->find();
			$this->assign('userdata', $userdata);
		}
        return $this->fetch();
    }
	
    public function course1()
    {
		if(session('username')!=null)
		{
			$uid=session('user_id');
			$userdata = Db::name('user')->where('id',$uid)->find();
			$this->assign('userdata', $userdata);
		}
		$courses = Db::name('course1')
            ->order('id asc')
            ->paginate(9);
		$this->assign('data', $courses);
        return $this->fetch();
    }
	
    public function study1($course)
    {
		if(session('username')!=null)
		{
			$uid=session('user_id');
			$userdata = Db::name('user')->where('id',$uid)->find();
			$this->assign('userdata', $userdata);
		}
		else
		{
			$this->error("您未登录");
		}
		$course = Db::name('course1')
            ->where('id', $course)
            ->find();
		$this->assign('data', $course);
        return $this->fetch();
    }
	
    public function course2()
    {
		if(session('username')!=null)
		{
			$uid=session('user_id');
			$userdata = Db::name('user')->where('id',$uid)->find();
			$this->assign('userdata', $userdata);
		}
		$courses = Db::name('course2')
            ->order('id asc')
            ->paginate(9);
		$this->assign('data', $courses);
        return $this->fetch();
    }
	
    public function study2($course)
    {
		if(session('username')!=null)
		{
			$uid=session('user_id');
			$userdata = Db::name('user')->where('id',$uid)->find();
			$this->assign('userdata', $userdata);
		}
		else
		{
			$this->error("您未登录");
		}
		$course = Db::name('course2')
            ->where('id', $course)
            ->find();
		$this->assign('data', $course);
        return $this->fetch();
    }
	
    public function child()
    {
        return $this->fetch();
    }

    public function main()
    {
        return $this->fetch();
    }

    public function welcome()
    {
        return $this->fetch();
    }
	
    public function deletedata()
    {
        $id = $this->request->post('id');
		$db = Db::name('sensor')
		->where('id', $id)
		->delete();
		$this->success('删除成功');
    }
	
    public function deletedata2()
    {
        $id = $this->request->post('id');
		$db = Db::name('nbbd')
		->where('id', $id)
		->delete();
		$this->success('删除成功');
    }

}
