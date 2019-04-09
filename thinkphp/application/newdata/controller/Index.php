<?php
namespace app\newdata\controller;
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
	
    public function sensor()
    {
		if(session('username')!=null)
		{
			$uid=session('user_id');
			$userdata = Db::name('user')->where('id',$uid)->find();
			$this->assign('userdata', $userdata);
		}
		$data = Db::name('sensor')
            ->order('id desc')
            ->paginate(15);
		$this->assign('data', $data);
        return $this->fetch();
    }
	
    public function bd()
    {
		if(session('username')!=null)
		{
			$uid=session('user_id');
			$userdata = Db::name('user')->where('id',$uid)->find();
			$this->assign('userdata', $userdata);
		}
		$data = Db::name('nbbd')
            ->order('id asc')
            ->paginate(15);
		$this->assign('data', $data);
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
