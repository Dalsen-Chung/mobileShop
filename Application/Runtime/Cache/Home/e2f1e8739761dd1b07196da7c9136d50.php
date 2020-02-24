<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-CN">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>嘉兴手机商城</title>
  <link rel="stylesheet" href="/mobileShop/Public/home/css/bootstrap.min.css">
  <link rel="stylesheet" href="/mobileShop/Public/home/css/common.css">
  <script>
    // const USER_ID = '<?php echo (session('user_id')); ?>';
    // const UPLOAD_URL = '/mobileShop/Uploads/';
  </script>
</head>

<body>
<nav class="navbar navbar-default navbar-fixed-top">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
        data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="<?php echo U('Index/index');?>">JxShop手机商城</a>
    </div>
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav navbar-right">
        <?php if(empty($_SESSION['member_id'])): ?><li><a href="<?php echo U('Index/register');?>">注册</a></li>
          <li><a href="<?php echo U('Index/login');?>">登录</a></li><?php endif; ?>

        <?php if(!empty($_SESSION['member_id'])): ?><li>
            <a href="<?php echo U('User/cart');?>" class="dpFlex" style="align-items: center;">
              购物车<span class="badge b-orange" style="margin-left: 2px;"><?php echo ($cart_counts); ?></span>
            </a>
          </li><?php endif; ?>

        <?php if(!empty($_SESSION['member_avatar'])): ?><li>
            <a style="padding-top: 13px;" href="<?php echo U('User/info');?>">
              <img width="20" height="20" src="/mobileShop/Uploads/<?php echo (session('member_avatar')); ?>" style="object-fit: cover;">
            </a>
          </li><?php endif; ?>

        <?php if(!empty($_SESSION['member_id'])): ?><li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
              aria-expanded="false"><?php echo (session('member_name')); ?> <span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li><a href="<?php echo U('User/order');?>">我的订单</a></li>
              <li><a href="<?php echo U('User/info');?>">个人信息</a></li>
              <li role="separator" class="divider"></li>
              <li><a href="<?php echo U('User/logout');?>">退出登录</a></li>
            </ul>
          </li><?php endif; ?>
      </ul>
    </div>
  </div>
</nav>
<div class="register">
    <div class="container">
        <div class="page-header">
            <h3>用户注册</h3>
        </div>
        <form method="POST" action="do_register" enctype="multipart/form-data" style="width: 400px; margin: 0 auto;">
            <div class="form-group">
                <label for="reg_name">昵称</label>
                <input type="text" name="name" required class="form-control" id="reg_name" placeholder="请输入昵称">
            </div>
            <div class="form-group">
              <label for="reg_account">登录账号</label>
              <input type="text" name="account" required class="form-control" id="reg_account" placeholder="请输入账号">
            </div>
            <div class="form-group">
              <label for="reg_password">登录密码</label>
              <input type="password" name="password" required class="form-control" id="reg_password" placeholder="请输入密码">
            </div>
            <div class="form-group">
              <label for="reg_tel">电话号码</label>
              <input type="tel" name="tel" required class="form-control" id="reg_tel" placeholder="请输入电话">
            </div>
            <div class="form-group dpFlex" style="align-items: center;">
                <label style="margin-bottom: 0; margin-right: 10px;">性别</label>
                <label class="radio-inline">
                    <input type="radio" name="sex" value="1" checked> 男
                </label>
                <label class="radio-inline">
                    <input type="radio" name="sex" value="2"> 女
                </label>
            </div>
            <div class="form-group">
              <label for="avatar">用户头像</label>
              <input type="file" required name="avatar" id="avatar" accept="image/*">
              <p class="help-block">请点击上传</p>
            </div>
            <div class="form-group" style="text-align: center;">
                <button type="submit" class="btn btn-success">立即注册</button>
            </div>
        </form>
    </div>
</div>
<script src="/mobileShop/Public/home/js/jquery-3.4.1.min.js"></script>
<script src="/mobileShop/Public/home/js/bootstrap.min.js"></script>
</body>

</html>