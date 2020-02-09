<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-CN">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>嘉兴手机商城管理后台</title>
    <link rel="stylesheet" href="/mobileShop/Public/admin/css/layui.css">
</head>
<body class="layui-layout-body">
    <div class="layui-layout layui-layout-admin">
        <div class="layui-header">
    <div class="layui-logo">Jx-Shop管理后台</div>
    <ul class="layui-nav layui-layout-left">
        <li class="layui-nav-item"><a href="">订单管理</a></li>
        <li class="layui-nav-item">
            <a href="javascript:;">商品管理</a>
            <dl class="layui-nav-child">
                <dd><a href="javascript:;">发布商品</a></dd>
                <dd><a href="javascript:;">商品列表</a></dd>
                <dd><a href="javascript:;">商品分类</a></dd>
                <dd><a href="javascript:;">品牌管理</a></dd>
            </dl>
        </li>
        <li class="layui-nav-item">
            <a href="javascript:;">用户管理</a>
            <dl class="layui-nav-child">
                <dd><a href="javascript:;">会员用户</a></dd>
                <dd><a href="javascript:;">管理员用户</a></dd>
            </dl>
        </li>
    </ul>
    <ul class="layui-nav layui-layout-right">
        <li class="layui-nav-item">
            <a href="javascript:;">
                <img src="/mobileShop/Public/admin/images/avatar.jpg" class="layui-nav-img">
                <?php echo (session('user_name')); ?>
            </a>
            <dl class="layui-nav-child">
                <dd><a href="">基本资料</a></dd>
                <dd><a href="">安全设置</a></dd>
            </dl>
        </li>
        <li class="layui-nav-item"><a href="<?php echo U('Logout/do');?>">退出</a></li>
    </ul>
</div>
        <div class="layui-side layui-bg-black">
    <div class="layui-side-scroll">
        <ul class="layui-nav layui-nav-tree" lay-filter="test">
            <li class="layui-nav-item"><a href="">订单管理</a></li>
            <li class="layui-nav-item">
                <a class="" href="javascript:;">商品管理</a>
                <dl class="layui-nav-child">
                    <dd><a href="javascript:;">发布商品</a></dd>
                    <dd><a href="javascript:;">商品列表</a></dd>
                    <dd><a href="javascript:;">商品分类</a></dd>
                    <dd><a href="javascript:;">品牌管理</a></dd>
                </dl>
            </li>
            <li class="layui-nav-item">
                <a href="javascript:;">用户管理</a>
                <dl class="layui-nav-child">
                    <dd><a href="javascript:;">会员用户</a></dd>
                    <dd><a href="javascript:;">管理员用户</a></dd>
                </dl>
            </li>
        </ul>
    </div>
</div>
<div class="layui-body">
    <!-- 内容主体区域 -->
    <div style="padding: 15px;">内容主体区域</div>
</div>
        <div class="layui-footer">
            © 许铭聪 - 1640225146
        </div>
    </div>
    <script src="/mobileShop/Public/admin/layui.js"></script>
    <script src="/mobileShop/Public/admin/js/common.js"></script>
</body>

</html>