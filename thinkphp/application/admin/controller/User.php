<?php
namespace app\admin\controller;

use think\Controller;
use think\Db;
use think\Session;
use think\Validate;

class User extends Controller
{

    public function index(){
        return $this->fetch('login');
    }

    public function user(){
		$uid = session('user_id');
		$userdata = Db::name('user')->where('id', $uid)->find();
        //return $this->fetch('login');
		$this->assign('user', $userdata);
		return $this->fetch();
    }
	
	public function login()
    {
        $post     = $this->request->post();
        if(empty($post)){
            $this->redirect('user/index');
        }
        $validate = validate('User');
        $validate->scene('login');
        $username  =  $post['username'];
        $user_id = Db::name('user')
            ->where('username', $username)
            ->value('id');
        if (!$validate->check($post)) {
            $this->error($validate->getError());
        } else {
            $sql_password = Db::name('user')
                ->where('username', $post['username'])
                ->value('password');
            if ($post['password'] !== $sql_password) {
                $this->error('密码错误');
            } else {
                session('username', $post['username']);
                session('user_id', $user_id);
                Db::name('user')
                    ->where('username',$post['username'])
                    ->update(['last_login_ip'=>$_SERVER['REMOTE_ADDR'],'last_login_time'=>date('Y-m-d h:i:s',time())]);
                $this->success('登陆成功', 'index/index');
            }
        }
    }
    //注销
    public function logout()
    {
        session('username', null);
        $this->redirect('admin/user/index');
    }

    public function userlist()
    {
        $data = Db::name('User')
            ->order('id asc')
            ->paginate(12);
        $this->assign('users', $data);
        return $this->fetch();
    }
    //打开新增界面
    public function showAdd()
    {
        $auth_group = Db::name('auth_group')
        ->field('id,title')
        ->order('id desc')
        ->select();
        return $this->fetch('add',['auth_group'=>$auth_group]);
    }
    //增加用户
    public function addUser()
    {
        $post     = $this->request->post();
        $group_id = $post['group_id'];
        unset($post['group_id']);
        //$validate = validate('User');
        //$res      = $validate->check($post);
        //if ($res !== true) {
            //$this->error($validate->getError());
        //} else {
            unset($post['check_password']);
            $post['password'] = $post['password'];
            $post['last_login_ip'] = '0.0.0.0';
            $post['create_time']   = date('Y-m-d h:i:s', time());
            $db = Db::name('user')
                ->insert($post);
            $userId = Db::name('user')->getLastInsID();
             Db::name('auth_group_access')
                ->insert(['uid'=>$userId,'group_id'=>$group_id]);
            $this->success('success');
        //}
    }
    //编辑页面
    public function edit($id)
    {
        
        $data = Db::name('User')
            ->alias('a')
            ->join('auth_group_access b','b.uid=a.id','left')
            ->field('a.*,b.group_id')
            ->where('id', $id)
            ->find();
        $auth_group = Db::name('auth_group')
        ->field('id,title')
        ->order('id desc')
        ->select();
        $this->assign('auth_group', $auth_group);
        $this->assign('data', $data);
        return $this->fetch();
    }
    //编辑提交
    public function editUser()
    {
        $post     = $this->request->post();
        if($post['id']==1){
            $this->error('系统管理员无法修改');
        }
        $group_id = $post['group_id'];
        unset($post['group_id']);
        $validate = validate('User');
        if (empty($post['password']) && empty($post['check_password'])) {
            $res = $validate->scene('edit')->check($post);
            if ($res !== true) {
                $this->error($validate->getError());
            } else {
                unset($post['password']);
                unset($post['check_password']);
                $db = Db::name('user')
                    ->where('id', $post['id'])
                    ->update(
                        [
                            'username' => $post['username'],
                            'email'    => $post['email'],
                        ]);
                Db::name('auth_group_access')
                ->where('uid',$post['id'])
                ->update(['group_id'=>$group_id]);
                $this->success('编辑成功');
            }
        } else {
            $res = $validate->scene('editPassword')->check($post);
            if ($res !== true) {
                $this->error($validate->getError());
            } else {
                unset($post['check_password']);
                $post['password'] = $post['password'];
                $db               = Db::name('user')
                    ->where('id', $post['id'])
                    ->update($post);
                $this->success('编辑成功');
            }
        }
    }
    //删除用户
    public function deleteUser()
    {
        $id = $this->request->post('id');
        $username =  Db::name('user')
            ->where('id',$id)
            ->value('username');
        if ((int) $id !== 1) {
            if($username!==session('username')){
                 $db = Db::name('user')
                ->where('id', $id)
                ->delete();
                $this->success('删除成功');
            }else{
                 $this->error('无法删除当前登录用户');
            }
        } else {
            $this->error('超级管理员无法删除');
        }
    }
	
    //上传头像
    function upload(){
        if($this->request->isPost()){
             $file = $this->request->file('file');//file是传文件的名称，这是webloader插件固定写入的。因为webloader插件会写入一个隐藏input，不信你们可以通过浏览器检查页面
             $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');
             $size = $info->getSize();
			 $uid = session('user_id');
			 
			 $userdata = Db::name('user')->where('id',$uid)->find();
			 $url = $userdata['propic'];
			 if($url != '\public\uploads\20180610\08460bb9489443328a8f69eea6176e4d.jpg' && $url != '')
			 {
				 unlink('.'.$url);
			 }
			 
             Db::name('user')->where('id',$uid)
                ->update(['propic'=> DS.'public' . DS . 'uploads'.DS.$info->getSaveName()]);
             $this->success('头像更换成功');
        }else{
            return $this->fetch();
        }
    }
	
    //修改密码界面
    function changepassword(){
		return $this->fetch();
    }
	
	//修改邮箱界面
    function email(){
		
        if($this->request->isPost()){
			$email = $this->request->post('email');
			$uid = session('user_id');
			 
		    $res = Db::name('user')->where('email',$email)->find();
			if($res == null)
			{
				Db::name('user')->where('id',$uid)
                ->update(['email'=>$email]);
                $this->success('邮箱更换成功');
			}
			else{
				$this->error('邮箱已被注册');
			}
            
        }else{
            return $this->fetch();
        }
    }
	
    //修改密码
    function changepw(){
		$new = '';
		$confirm = '';
		$uid = session('user_id');
		$old = $this->request->post('old');
		$new = $this->request->post('new');
		$confirm = $this->request->post('confirm');
		if($old == null)
			$this->error('旧密码不能为空');
		if($new == null)
			$this->error('新密码不能为空');
		if(strlen($new) < 6)
			$this->error('新密码长度至少6位');
		if(strcmp($new,$confirm) != 0)
			$this->error('新密码两次输入不一样');
		
		$password = ''.Db::name('user')->where('id',$uid)->value('password');
		if(strcmp($old,$password) == 0)
		{
			Db::name('user')->where('id',$uid)->update(['password'=> $new]);
			$this->success('密码修改成功');
		}
		else $this->error($uid);
    }

}
