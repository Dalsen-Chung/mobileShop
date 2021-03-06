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
<div class="searchWrapper">
  <div class="container content dpFlex">
    <img src="/mobileShop/Public/home/images/logo.png" width="120" />
    <form action="" method="post">
      <div class="input-group input-group-lg">
        <input type="text" name="search" class="form-control" value="<?php echo ($search); ?>" autocomplete="off" placeholder="请输入商品">
        <span class="input-group-btn">
          <button class="btn b-orange bd-orange" type="submit">
            <span class="glyphicon glyphicon-search c-white" aria-hidden="true"></span>
          </button>
        </span>
      </div>
    </form>
  </div>
  <div class="container">
    <div class="condition dpFlex">
      <span class="title">类别</span>
      <div class="tags dpFlex">
        <a href="<?php echo U('Index/index');?>">
          <?php if(($query_cid == '')): ?><span class="label label-primary">全部</span>
            <?php else: ?>
            <span class="label label-default">全部</span><?php endif; ?>
        </a>
        <?php if(is_array($c_list)): $i = 0; $__LIST__ = $c_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><a href="<?php echo U('Index/index');?>?cid=<?php echo ($vo["id"]); ?>">
            <?php switch(abs($_GET['cid'])): case $vo["id"]: ?><span class="label label-primary"><?php echo ($vo["name"]); ?></span><?php break;?>
              <?php default: ?>
              <span class="label label-default"><?php echo ($vo["name"]); ?></span><?php endswitch;?>
          </a><?php endforeach; endif; else: echo "" ;endif; ?>
      </div>
    </div>
    <div class="condition dpFlex">
      <span class="title">品牌</span>
      <div class="tags dpFlex">
        <a href="<?php echo U('Index/index');?>">
          <?php if(($query_bid == '')): ?><span class="label label-primary">全部</span>
            <?php else: ?>
            <span class="label label-default">全部</span><?php endif; ?>
        </a>
        <?php if(is_array($b_list)): $i = 0; $__LIST__ = $b_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><a href="<?php echo U('Index/index');?>?bid=<?php echo ($vo["id"]); ?>">
            <?php switch(abs($_GET['bid'])): case $vo["id"]: ?><span class="label label-primary"><?php echo ($vo["name"]); ?></span><?php break;?>
              <?php default: ?>
              <span class="label label-default"><?php echo ($vo["name"]); ?></span><?php endswitch;?>
          </a><?php endforeach; endif; else: echo "" ;endif; ?>
      </div>
    </div>
  </div>
</div>
<div class="homeWrapper">
  <div class="container">
    <div class="row">
      <?php if(is_array($p_list)): $i = 0; $__LIST__ = $p_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="col-sm-6 col-md-4">
          <div class="thumbnail" style="padding-top: 20px;">
            <img src="/mobileShop/Uploads/<?php echo ($vo["photo"]); ?>" width="100" />
            <div class="caption">
              <h3><?php echo ($vo["name"]); ?></h3>
              <p><?php echo ($vo["intro"]); ?></p>
              <p class="saleInfo dpFlex">
                <span class="left">
                  <span class="price c-orange">
                    <span style="font-size: 14px;">¥</span><?php echo ($vo["price"]); ?>
                  </span>
                  <span class="sales"><?php echo ($vo["sales"]); ?>人付款</span>
                </span>
                <?php switch(abs($vo["is_hot"])): case "1": ?><span class="label label-danger">热卖中</span><?php break;?>
                  <?php default: endswitch;?>
              </p>
              <div style="text-align: right;">
                <a href="<?php echo U('Index/detail');?>?pid=<?php echo ($vo["id"]); ?>" class="btn btn-default btn-sm" role="button">查看详情</a>
                <a href="<?php echo U('User/add_cart');?>?pid=<?php echo ($vo["id"]); ?>" class="btn btn-primary btn-sm" role="button">加入购物车</a>
              </div>
            </div>
          </div>
        </div><?php endforeach; endif; else: echo "" ;endif; ?>
    </div>
    <nav class="pagNav">
      <div class="pages">
        <?php echo ($page); ?>
      </div>
    </nav>
    <?php if(sizeof($p_list) == 0): ?>暂无商品
      <?php else: endif; ?>
  </div>
</div>
<script src="/mobileShop/Public/home/js/jquery-3.4.1.min.js"></script>
<script src="/mobileShop/Public/home/js/bootstrap.min.js"></script>
<script src="/mobileShop/Public/home/js/common.js"></script>
<script src="/mobileShop/Public/home/js/distpicker.min.js"></script>
</body>

</html>