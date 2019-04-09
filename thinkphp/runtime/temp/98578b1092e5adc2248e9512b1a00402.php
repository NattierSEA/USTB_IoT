<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:53:"C:\thinkphp/application/admin\view\index\welcome.html";i:1544602130;s:51:"C:\thinkphp/application/admin\view\public\head.html";i:1515723186;s:51:"C:\thinkphp/application/admin\view\public\foot.html";i:1515723186;}*/ ?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>闻海南-ADMIN</title>
  <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,user-scalable=yes, minimum-scale=0.4, initial-scale=0.8" />
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <link rel="shortcut icon" href="__static__/favicon.ico" type="image/x-icon" />
    <link rel="stylesheet" href="__static__/css/font.css">
    <link rel="stylesheet" href="__module__/layui/css/layui.css">
    <link rel="stylesheet" href="__static__/css/xadmin.css">
    <script type="text/javascript" src="__js__/jquery.min.js"></script>
    <script src="__module__/layui/layui.all.js" charset="utf-8"></script>
    <script type="text/javascript" src="__static__/js/xadmin.js"></script>
    <script type="text/javascript" src="__static__/js/jquery.form.js"></script>
    <script type="text/javascript" src="__static__/js/jquery.form.js"></script>
</head>


<div class="x-body">




    <fieldset class="layui-elem-field">
        <legend>
            信息统计
        </legend>
        <div class="layui-field-box">
            <table class="layui-table" lay-even="">
                <thead>
                    <tr>
                        <th>
                            统计
                        </th>
                        <th>
                            资讯库
                        </th>
                        <th>
                            图片库
                        </th>
                        <th>
                            产品库
                        </th>
                        <th>
                            用户
                        </th>
                        <th>
                            管理员
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            总数
                        </td>
                        <td>
                            92
                        </td>
                        <td>
                            9
                        </td>
                        <td>
                            0
                        </td>
                        <td>
                            8
                        </td>
                        <td>
                            20
                        </td>
                    </tr>
                    <tr>
                        <td>
                            今日
                        </td>
                        <td>
                            0
                        </td>
                        <td>
                            0
                        </td>
                        <td>
                            0
                        </td>
                        <td>
                            0
                        </td>
                        <td>
                            0
                        </td>
                    </tr>
                    <tr>
                        <td>
                            昨日
                        </td>
                        <td>
                            0
                        </td>
                        <td>
                            0
                        </td>
                        <td>
                            0
                        </td>
                        <td>
                            0
                        </td>
                        <td>
                            0
                        </td>
                    </tr>
                    <tr>
                        <td>
                            本周
                        </td>
                        <td>
                            2
                        </td>
                        <td>
                            0
                        </td>
                        <td>
                            0
                        </td>
                        <td>
                            0
                        </td>
                        <td>
                            0
                        </td>
                    </tr>
                    <tr>
                        <td>
                            本月
                        </td>
                        <td>
                            2
                        </td>
                        <td>
                            0
                        </td>
                        <td>
                            0
                        </td>
                        <td>
                            0
                        </td>
                        <td>
                            0
                        </td>
                    </tr>
                </tbody>
            </table>
            <table class="layui-table">
                <thead>
                    <tr>
                        <th colspan="2" scope="col">
                            服务器信息
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th width="30%">
                            服务器域名
                        </th>
                        <td>
                            <?php echo $_SERVER['SERVER_NAME']; ?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            服务器IP地址
                        </td>
                        <td>
                            <?php echo gethostbyname($_SERVER['SERVER_NAME']); ?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            服务器内网地址
                        </td>
                        <td>
                            172.24.189.12
                        </td>
                    </tr>
                    <tr>
                        <td>
                            服务器端口
                        </td>
                        <td>
                            80,8901
                        </td>
                    </tr>
                    <tr>
                        <td>
                            服务器操作系统
                        </td>
                        <td>
                            <?php echo PHP_OS; ?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            服务器运行环境
                        </td>
                        <td>
                            <?php echo $_SERVER["SERVER_SOFTWARE"]; ?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            本文件所在文件夹
                        </td>
                        <td>
                            C:\thinkphp\
                        </td>
                    </tr>
                    <tr>
                        <td>
                            服务器时间
                        </td>
                        <td>
                            <?php echo date("Y年n月j日 H:i:s"); ?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            服务器的语言种类
                        </td>
                        <td>
                            Chinese (People's Republic of China)
                        </td>
                    </tr>
                  
                    <tr>
                        <td>
                            北京时间
                        </td>
                        <td>
                            <?php echo gmdate("Y年n月j日 H:i:s",time()+8*3600); ?>
                        </td>
                    </tr>
                  
                    <tr>
                        <td>
                            服务器上次启动到现在已运行
                        </td>
                        <td>
                            7210分钟
                        </td>
                    </tr>
                   
                    <tr>
                        <td>
                            CPU 总数
                        </td>
                        <td>
                            1
                        </td>
                    </tr>
                    <tr>
                        <td>
                            CPU 类型
                        </td>
                        <td>
                            x86 Family 6 Model 42 Stepping 1, GenuineIntel
                        </td>
                    </tr>
                    <tr>
                        <td>
                            当前在线人数
                        </td>
                        <td>
						<?php echo count($_SESSION); ?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            当前SessionID
                        </td>
                        <td>
                            <?php echo session_id(); ?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            当前用户名
                        </td>
                        <td>
                            <?php echo \think\Session::get('username'); ?>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </fieldset>
    <blockquote class="layui-elem-quote layui-quote-nm">
        百科荣创(北京)科技发展有限公司
    </blockquote>
</div>
<script src="__module__/layui/layui.all.js" charset="utf-8"></script>
</html>
