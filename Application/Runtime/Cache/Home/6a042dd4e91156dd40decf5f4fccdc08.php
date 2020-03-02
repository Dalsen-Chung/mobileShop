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
              <li><a href="<?php echo U('User/address');?>">收货地址</a></li>
              <li><a href="<?php echo U('User/top_up');?>">余额充值</a></li>
              <li role="separator" class="divider"></li>
              <li><a href="<?php echo U('User/logout');?>">退出登录</a></li>
            </ul>
          </li><?php endif; ?>
      </ul>
    </div>
  </div>
</nav>
<div class="user_info">
    <div class="container">
        <div class="page-header">
            <h3>我的信息</h3>
        </div>
        <form method="POST" id="editUserForm" action="save_info" style="width: 400px; margin: 0 auto;">
            <div class="form-group">
              <label for="edit_account">登录账号</label>
              <input type="text" name="account" value="<?php echo ($user_info["account"]); ?>" required class="form-control" readonly id="edit_account" placeholder="请输入账号">
            </div>
            <div class="form-group">
                <label for="edit_name">昵称</label>
                <input type="text" name="name" value="<?php echo ($user_info["name"]); ?>" required class="form-control" id="edit_name" placeholder="请输入昵称">
            </div>
            <div class="form-group">
                <label for="edit_tel">电话号码</label>
                <input type="tel" name="tel" value="<?php echo ($user_info["tel"]); ?>" required class="form-control" id="edit_tel" placeholder="请输入电话">
            </div>
            <div class="form-group dpFlex" style="align-items: center;">
                <label style="margin-bottom: 0; margin-right: 10px;">性别</label>
                <label class="radio-inline">
                    <?php switch(abs($user_info["sex"])): case "1": ?><input type="radio" name="sex" value="1" checked> 男<?php break;?>
                        <?php default: ?>
                            <input type="radio" name="sex" value="1" > 男<?php endswitch;?>
                </label>
                <label class="radio-inline">
                    <?php switch(abs($user_info["sex"])): case "2": ?><input type="radio" name="sex" value="2" checked> 女<?php break;?>
                        <?php default: ?>
                            <input type="radio" name="sex" value="2"> 女<?php endswitch;?>
                </label>
            </div>
            <div class="form-group">
                <label for="edit_balance">当前余额</label>
                <input type="text" name="balance" value="<?php echo ($user_info["balance"]); ?>" required readonly class="form-control" id="edit_balance">
            </div>
            <div class="form-group">
              <label for="edit_password">新密码</label>
              <input type="password" name="password" class="form-control" id="edit_password" placeholder="请输入要更改的密码">
              <p class="help-block">需要修改密码时填入即可</p>
            </div>
            <div class="form-group" style="text-align: center;">
                <button type="submit" class="btn btn-primary">保存</button>
            </div>
        </form>
    </div>
</div>
<script src="/mobileShop/Public/home/js/jquery-3.4.1.min.js"></script>
<script src="/mobileShop/Public/home/js/bootstrap.min.js"></script>
<script src="/mobileShop/Public/home/js/common.js"></script>
<script src="/mobileShop/Public/home/js/distpicker.min.js"></script>
</body>

</html>