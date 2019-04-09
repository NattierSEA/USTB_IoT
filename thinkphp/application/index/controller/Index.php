<?php
namespace app\index\controller;

use \think\Controller;
use \think\Db;
use think\Session;
use think\Validate;

class Index extends Controller
{
    public function index(){
		if(session('username')!=null)
		{
			$uid=session('user_id');
			$userdata = Db::name('user')->where('id',$uid)->find();
			$this->assign('userdata', $userdata);
		}
		$event = Db::name('event')->order('id asc')->select();
        $this->assign('event', $event);
        return $this->fetch();
    }

    public function testGet(){
    	$get = $this->request->get();
    	return json($get);
    }
    public function testPost(){
    	$post = $this->request->post();
    	return json($post);
    }
	public function download($file_url="public\\downloads\\windows\\cktszsbkb.zip",$new_name=''){  
        if(!isset($file_url)||trim($file_url)==''){  
            echo '500';  
        }  
        if(!file_exists($file_url)){ //检查文件是否存在  
            echo '404';  
        } 
        $file_name=basename($file_url);  
        $file_type=explode('.',$file_url);  
        $file_type=$file_type[count($file_type)-1];  
        $file_name=trim($new_name=='')?$file_name:urlencode($new_name);  
        $file_type=fopen($file_url,'r'); //打开文件  
        //输入文件标签 
        header("Content-type: application/octet-stream");  
        header("Accept-Ranges: bytes");  
        header("Accept-Length: ".filesize($file_url));  
        header("Content-Disposition: attachment; filename=".$file_name);  
        //输出文件内容  
        echo fread($file_type,filesize($file_url));  
        fclose($file_type); 
    }
	
	public function user(){
        return $this->fetch('login');
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
	
	public function logout()
    {
        session('username', null);
        $this->redirect('index/index/index');
    }

}
