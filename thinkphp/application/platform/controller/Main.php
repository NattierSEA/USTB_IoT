<?php
namespace app\platform\controller;

use org\Auth;
use think\Controller;
use think\Db;
use think\Session;


class Main extends Controller
{

    public function _initialize()
    {
        $username  = session('username');
        if (empty($username)) {
            $this->redirect('platform/user/login');
        }
        //$this->checkAuth();
        $this->getMenu();
    }
    /**
     * 权限检查
     * @return bool
     */
    protected function checkAuth()
    {

        if (!Session::has('user_id')) {
            $this->redirect('platform/login/index');
        }

        $module     = $this->request->module();
        $controller = $this->request->controller();
        $action     = $this->request->action();
        // 排除权限
        $not_check = ['platform/Index/index','platform/Index/welcome', 'platform/AuthGroup/getjson', 'platform/System/clear'];

        if (!in_array($module . '/' . $controller . '/' . $action, $not_check)) {
            $auth     = new Auth();
            $admin_id = Session::get('user_id');
            if (!$auth->check($module . '/' . $controller . '/' . $action, $admin_id)) {
                $this->error('没有权限','');
            }
        }
    }
    
    /**
     * 获取侧边栏菜单
     */
    protected function getMenu()
    {
        $menu           = [];
        $uid       = Session::get('user_id');
        $application_list = Db::name('experiment_application')->where('uid', $uid)->order(['id' => 'ASC'])->select();
        foreach ($application_list as $value) {
			$aid = $value['id'];
			$device           = [];
			$device_list = Db::name('experiment_device')->where('aid', $aid)->order(['id' => 'ASC'])->select();
			//print_r($device_list);
			foreach ($device_list as $v) {
                $device[] = $v;
			}
			$value['children'] = $device;
            $menu[] = $value;
        }
        $this->assign('menu', $menu);
    }
}
