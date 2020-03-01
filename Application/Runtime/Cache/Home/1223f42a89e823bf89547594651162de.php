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
<div class="pd_detail">
  <div class="container">
    <div class="page-header">
        <h3>
            <button type="button" class="btn btn-link" onclick="history.go(-1);">
                <span class="glyphicon glyphicon-chevron-left"></span>
            </button>
            商品详情
        </h3>
    </div>
    <div id="myCarousel" class="carousel slide">
        <!-- 轮播（Carousel）指标 -->
        <ol class="carousel-indicators">
            <?php if(is_array($photo_list)): $i = 0; $__LIST__ = $photo_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li
                    data-target="#myCarousel"
                    data-slide-to="<?php echo ($i-1); ?>"
                    style="margin-right: 5px;"
                    class="<?php echo ($i-1 === 0 ? 'active' : ''); ?>">
                </li><?php endforeach; endif; else: echo "" ;endif; ?>
        </ol>   
        <!-- 轮播（Carousel）项目 -->
        <div class="carousel-inner">
            <?php if(is_array($photo_list)): $i = 0; $__LIST__ = $photo_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="item <?php echo ($i-1 === 0 ? 'active' : ''); ?>">
                    <img src="/mobileShop/Uploads/<?php echo ($vo); ?>" />
                </div><?php endforeach; endif; else: echo "" ;endif; ?>
        </div>
        <!-- 轮播（Carousel）导航 -->
        <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
          </a>
          <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
    <div class="panel panel-default">
        <div class="panel-body">
            <h3 style="margin-top: 10px;"><?php echo ($product["name"]); ?></h3>
            <blockquote>
                <footer><?php echo ($product["intro"]); ?></footer>
            </blockquote>
            <div class="well"><?php echo ($product["content"]); ?></div>
            <ul class="list-group" style="width: 400px;margin: 0 auto;">
                <li class="list-group-item">
                    商品单价
                    <span class="badge b-orange">¥<?php echo ($product["price"]); ?></span>
                </li>
                <li class="list-group-item">
                    商品分类
                    <span class="badge"><?php echo ($product["category_name"]); ?></span>
                </li>
                <li class="list-group-item">
                    商品品牌
                    <span class="badge"><?php echo ($product["brand_name"]); ?></span>
                </li>
                <li class="list-group-item">
                    商品库存
                    <span class="badge" style="background-color: green;"><?php echo ($product["stock"]); ?></span>
                </li>
                <li class="list-group-item">
                    商品已售
                    <span class="badge b-orange"><?php echo ($product["sales"]); ?></span>
                </li>
                <li class="list-group-item">
                    上架日期
                    <span class="badge"><?php echo ($product["addtime"]); ?></span>
                </li>
            </ul>
            <div style="text-align: right;">
                <a href="<?php echo U('User/add_cart');?>?pid=<?php echo ($product["id"]); ?>" class="btn btn-primary" role="button">加入购物车</a>
            </div>
        </div>
      </div>
  </div>
</div>
<script src="/mobileShop/Public/home/js/jquery-3.4.1.min.js"></script>
<script src="/mobileShop/Public/home/js/bootstrap.min.js"></script>
<script src="/mobileShop/Public/home/js/common.js"></script>
<script src="/mobileShop/Public/home/js/distpicker.min.js"></script>
</body>

</html>