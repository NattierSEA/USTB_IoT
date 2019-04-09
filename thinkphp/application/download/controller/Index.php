<?php
namespace app\download\controller;

use think\Controller;
use think\Db;

class Index extends Controller
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
	
	public function windows()
    {
		$data = Db::name('downloadwindowsfile')
            ->order('id asc')
            ->paginate(6);
		if(session('username')!=null)
		{
			$uid=session('user_id');
			$userdata = Db::name('user')->where('id',$uid)->find();
			$this->assign('userdata', $userdata);
		}
		$this->assign('data', $data);
        return $this->fetch();
    }
	
	public function android()
    {
		$data = Db::name('downloadandroidfile')
            ->order('id asc')
            ->paginate(12);
		if(session('username')!=null)
		{
			$uid=session('user_id');
			$userdata = Db::name('user')->where('id',$uid)->find();
			$this->assign('userdata', $userdata);
		}
		$this->assign('data', $data);
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
	public function download($fileid=''){  
	    $new_name='';
		$file_url=Db::name('downloadwindowsfile')
            ->where('name', $fileid)
            ->value('address');
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
	public function downloads($fileid=''){  
	    $new_name='';
		$file_url=Db::name('downloadandroidfile')
            ->where('name', $fileid)
            ->value('address');
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

}
