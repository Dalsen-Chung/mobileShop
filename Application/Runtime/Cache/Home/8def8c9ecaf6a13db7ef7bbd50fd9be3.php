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
<div class="user_order">
  <div class="container">
    <div class="page-header">
      <h3>我的订单</h3>
    </div>
    <?php if(!empty($order_list)): ?><div class="table-responsive" style="margin-bottom: 20px;">
        <table class="table table-striped table-hover" style="text-align: center;">
          <thead>
            <tr>
              <td style="width: 50px;">序号</td>
              <td>订单号</td>
              <td>商品描述</td>
              <td>订单总价</td>
              <td style="width: 80px;">商品数量</td>
              <td style="width: 80px;">订单状态</td>
              <td>收货地址</td>
              <td style="min-width: 80px;">快递单号</td>
              <td style="width: 150px;">下单时间</td>
              <td style="width: 50px;">操作</td>
            </tr>
          </thead>
          <tbody>
            <?php if(is_array($order_list)): $i = 0; $__LIST__ = $order_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
                <td><?php echo ($i); ?></td>
                <td><?php echo ($vo["order_sn"]); ?></td>
                <td><?php echo ($vo["desc"]); ?></td>
                <td>¥<?php echo ($vo["price"]); ?></td>
                <td><?php echo ($vo["product_num"]); ?></td>
                <td><?php echo ($vo["status_text"]); ?></td>
                <td><?php echo ($vo["address"]); ?></td>
                <td><?php echo ($vo["tracking_num"]); ?></td>
                <td><?php echo ($vo["addtime"]); ?></td>
                <td>
                  <?php if(($vo["status"]) == "1"): ?><a href="<?php echo U('User/cancel_order');?>?order_sn=<?php echo ($vo["order_sn"]); ?>" class="btn btn-danger btn-xs" role="button">取消订单</a><?php endif; ?>
                </td>
              </tr><?php endforeach; endif; else: echo "" ;endif; ?>
          </tbody>
        </table>
      </div><?php endif; ?>
    <?php if(empty($order_list)): ?><div>
        <span>未有任何订单<a href="<?php echo U('Index/index');?>">点我</a>去选购吧！</span>
      </div><?php endif; ?>
  </div>
</div>
<script src="/mobileShop/Public/home/js/jquery-3.4.1.min.js"></script>
<script src="/mobileShop/Public/home/js/bootstrap.min.js"></script>
<script src="/mobileShop/Public/home/js/common.js"></script>
<script src="/mobileShop/Public/home/js/distpicker.min.js"></script>
</body>

</html>