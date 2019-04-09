<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:49:"C:\thinkphp/application/admin\view\user\user.html";i:1528786172;s:51:"C:\thinkphp/application/admin\view\public\head.html";i:1515723186;s:51:"C:\thinkphp/application/admin\view\public\foot.html";i:1515723186;}*/ ?>
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

            <table class="layui-table"  lay-skin="nob">
                <thead>
                    <tr>
                        <th colspan="3" scope="col">
                            您的信息
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th width="100px">
                            用户名
                        </th>
                        <td width="200px">
                            <?php echo $user['username']; ?>
                        </td>
                        <td>
                        </td>
                    </tr>
                    <tr ondblclick="tClick(1)" id="1">
                        <td>
                            头像
                        </td>
                        <td class="url">
                            <img src="<?php echo $user['propic']; ?>" style="height:100px;width:100px">
                        </td>
                        <td>
                            <button class="layui-btn" 
							onclick="x_admin_show('上传头像','upload.html',500,500)">
							更改</button>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            注册邮箱
                        </td>
                        <td>
                            <?php echo $user['email']; ?>
                        </td>
                        <td>
                            <button class="layui-btn" 
							onclick="x_admin_show('更改邮箱','email.html',500,350)">
							更改</button>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            创建时间
                        </td>
                        <td>
                            <?php echo $user['create_time']; ?>
                        </td>
                        <td>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            最新登录时间
                        </td>
                        <td>
                            <?php echo $user['last_login_time']; ?>
                        </td>
                        <td>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            最新登录IP
                        </td>
                        <td>
                            <?php echo $user['last_login_ip']; ?>
                        </td>
                        <td>
                        </td>
                    </tr>
                    
                </tbody>
            </table>
        </div>
    </fieldset>
    <blockquote class="layui-elem-quote layui-quote-nm">
        北京科技大学 物联网与电子工程系
    </blockquote>
</div>
<script>

      function tClick(id){
          var url = $('#'+id).children('td').children('img').attr('src');
          //页面层
          layer.open({
            type: 1,
            skin: '', //加上边框
            area: ['900px', '648px'], //宽高
            content: "<center style='margin-top:40px;'><img src="+url+"></center>"
          });
      }
</script>
<script src="__module__/layui/layui.all.js" charset="utf-8"></script>
</html>
