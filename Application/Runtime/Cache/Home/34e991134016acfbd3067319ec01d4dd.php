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
<div class="cart">
    <div class="container">
        <div class="page-header">
            <h3>我的购物车</h3>
        </div>
        <?php if(!empty($cart_list)): ?><div class="table-responsive" style="margin-bottom: 20px;">
                <table class="table table-striped table-hover" style="text-align: center;">
                    <thead>
                        <tr>
                            <td>序号</td>
                            <td>商品名称</td>
                            <td>商品图片</td>
                            <td>品牌</td>
                            <td>分类</td>
                            <td>单价</td>
                            <td>数量</td>
                            <td>操作</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(is_array($cart_list)): $i = 0; $__LIST__ = $cart_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
                                <td><?php echo ($i); ?></td>
                                <td><?php echo ($vo["name"]); ?></td>
                                <td>
                                    <img src="/mobileShop/Uploads/<?php echo ($vo["photo"]); ?>" width="50">
                                </td>
                                <td><?php echo ($vo["brand_name"]); ?></td>
                                <td><?php echo ($vo["category_name"]); ?></td>
                                <td>¥<?php echo ($vo["price"]); ?></td>
                                <td>
                                    <?php if(($vo["num"]) <= "1"): ?><a href="<?php echo U('User/dec_cart_num');?>?cart_id=<?php echo ($vo["id"]); ?>" class="btn btn-link btn-xs disabled" role="button">-</a>
                                    <?php else: ?>
                                        <a href="<?php echo U('User/dec_cart_num');?>?cart_id=<?php echo ($vo["id"]); ?>" class="btn btn-link btn-xs" role="button">-</a><?php endif; ?>
                                    <?php echo ($vo["num"]); ?>
                                    <a href="<?php echo U('User/inc_cart_num');?>?cart_id=<?php echo ($vo["id"]); ?>" class="btn btn-link btn-xs" role="button">+</a>
                                </td>
                                <td>
                                    <a href="<?php echo U('User/delete_cart');?>?cart_id=<?php echo ($vo["id"]); ?>" class="btn btn-danger btn-xs" role="button">删除</a>
                                </td>
                            </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                    </tbody>
                </table>
            </div>
            <div class="cartInfo dpFlex">
                <span class="info">
                    <span style="margin-right: 10px;">共<?php echo ($num_count); ?>件商品</span>
                    <span style="color: gray;">合计：
                        <span class="c-orange" style="font-size: 0px;">
                            <span style="font-size: 15px;">¥</span>
                            <span style="font-size: 25px;"><?php echo ($price_count); ?></span>
                        </span>
                    </span>
                </span>
                <a href="<?php echo U('User/settle');?>" class="btn btn-primary" role="button">去结算</a>
            </div><?php endif; ?>
        <?php if(empty($cart_list)): ?><div>
                <span>暂未选购任何商品<a href="<?php echo U('Index/index');?>">点我</a>去选购吧！</span>
            </div><?php endif; ?>
    </div>
</div>
<script src="/mobileShop/Public/home/js/jquery-3.4.1.min.js"></script>
<script src="/mobileShop/Public/home/js/bootstrap.min.js"></script>
<script src="/mobileShop/Public/home/js/common.js"></script>
<script src="/mobileShop/Public/home/js/distpicker.min.js"></script>
</body>

</html>