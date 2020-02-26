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
<div class="user_settle">
    <div class="container">
        <div class="page-header">
            <h3>订单结算</h3>
        </div>
        <div class="settleInfo">
            <span class="info">
                <span style="margin-right: 10px;">共<?php echo ($num_count); ?>件商品</span>
                <span style="color: gray;">合计：
                    <span class="c-orange" style="font-size: 0px;">
                        <span style="font-size: 15px;">¥</span>
                        <span style="font-size: 25px;"><?php echo ($price_count); ?></span>
                    </span>
                </span>
            </span>
        </div>
        <h4>商品寄送地址</h4>
        <div class="address">
            <div class="info_row">
                <span class="key">收货人</span>
                <span class="value"><?php echo ($address["receiver"]); ?></span>
            </div>
            <div class="info_row">
                <span class="key">收货人电话</span>
                <span class="value"><?php echo ($address["tel"]); ?></span>
            </div>
            <div class="info_row">
                <span class="key">详细地址</span>
                <span class="value"><?php echo ($address["address"]); ?></span>
            </div>
            <div class="info_row">
                <span class="key">邮编</span>
                <span class="value"><?php echo ($address["postcode"]); ?></span>
            </div>
        </div>
        <a href="<?php echo U('User/do_settle');?>" class="btn btn-danger" role="button">立即付款</a>
    </div>
</div>
<script src="/mobileShop/Public/home/js/jquery-3.4.1.min.js"></script>
<script src="/mobileShop/Public/home/js/bootstrap.min.js"></script>
</body>

</html>