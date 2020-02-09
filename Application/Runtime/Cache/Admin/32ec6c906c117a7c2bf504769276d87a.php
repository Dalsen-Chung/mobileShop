<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-CN">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>嘉兴手机商城管理后台</title>
    <link rel="stylesheet" href="/mobileShop/Public/admin/css/layui.css">
    <link rel="stylesheet" href="/mobileShop/Public/admin/css/login/index.css">
</head>

<body class="layui-layout-body">
    <div class="login-wrapper layui-anim layui-anim-scale">
        <h1>JxShop管理后台</h1>
        <form class="layui-form" method="POST" action="<?php echo U('Admin/Login/do');?>">
            <div class="layui-form-item">
                <label class="layui-form-label">账号</label>
                <div class="layui-input-block">
                    <input type="text" name="account" required lay-verify="required" placeholder="请输入管理员账号"
                        autocomplete="off" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">密码</label>
                <div class="layui-input-block">
                    <input type="password" name="password" required lay-verify="required" placeholder="请输入密码"
                        autocomplete="off" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">验证码</label>
                <div class="layui-input-inline">
                    <input type="text" name="verify_code" required lay-verify="required" placeholder="请输入验证码"
                        autocomplete="off" class="layui-input">
                </div>
                <img onclick="this.src=this.src+'?'+Math.random()" class="code-img" src="<?php echo U('Admin/Login/get_captcha');?>" alt="">
            </div>
            <div class="layui-form-item">
                <div class="layui-input-block">
                    <button type="reset" class="layui-btn layui-btn-primary">重置</button>
                    <button class="layui-btn" lay-submit lay-filter="loginForm">
                        登录<i class="layui-icon">&#xe602;</i>
                    </button>
                </div>
            </div>
        </form>
    </div>
    <script src="/mobileShop/Public/admin/layui.js"></script>
    <script src="/mobileShop/Public/admin/js/login/index.js"></script>
</body>

</html>