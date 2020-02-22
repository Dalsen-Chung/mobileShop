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
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
        data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">JxShop</a>
    </div>
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav navbar-right">
        <li><a href="#">注册</a></li>
        <li><a href="#">登录</a></li>
        <li><a href="#">购物车<span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span></a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
            aria-expanded="false">许铭聪 <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="#">我的订单</a></li>
            <li><a href="#">我的地址</a></li>
            <li><a href="#">个人信息</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="#">退出登录</a></li>
          </ul>
        </li>
      </ul>
      <!-- <form class="navbar-form navbar-center">
        <div class="form-group">
          <input type="text" class="form-control" placeholder="输入商品">
        </div>
        <button type="submit" class="btn btn-default">搜索</button>
      </form> -->
    </div>
  </div>
</nav>
<div class="searchWrapper">
  <div class="container content dpFlex">
    <img src="/mobileShop/Public/home/images/logo.png" width="120" />
    <div class="input-group input-group-lg">
      <input type="text" class="form-control" placeholder="请输入商品" aria-describedby="sizing-addon1">
      <span class="input-group-addon b-orange bd-orange" id="sizing-addon1">
        <span class="glyphicon glyphicon-search c-white" aria-hidden="true"></span>
      </span>
    </div>
  </div>
  <div class="container">
    <div class="condition dpFlex">
      <span class="title">类别</span>
      <div class="tags dpFlex">
        <span class="label label-primary">全部</span>
        <span class="label label-default">Default</span>
        <span class="label label-default">Default</span>
        <span class="label label-default">Default</span>
        <span class="label label-default">Default</span>
        <span class="label label-default">Default</span>
        <span class="label label-default">Default</span>
        <span class="label label-default">Default</span>
        <span class="label label-default">Default</span>
        <span class="label label-default">Default</span>
        <span class="label label-default">Default</span>
        <span class="label label-default">Default</span>
        <span class="label label-default">Default</span>
        <span class="label label-default">Default</span>
        <span class="label label-default">Default</span>
        <span class="label label-default">Default</span>
        <span class="label label-default">Default</span>
        <span class="label label-default">Default</span>
        <span class="label label-default">Default</span>
      </div>
    </div>
    <div class="condition dpFlex">
      <span class="title">品牌</span>
      <div class="tags dpFlex">
        <span class="label label-primary">全部</span>
        <span class="label label-default">Default</span>
        <span class="label label-default">Default</span>
        <span class="label label-default">Default</span>
        <span class="label label-default">Default</span>
        <span class="label label-default">Default</span>
        <span class="label label-default">Default</span>
        <span class="label label-default">Default</span>
        <span class="label label-default">Default</span>
        <span class="label label-default">Default</span>
        <span class="label label-default">Default</span>
        <span class="label label-default">Default</span>
        <span class="label label-default">Default</span>
        <span class="label label-default">Default</span>
        <span class="label label-default">Default</span>
        <span class="label label-default">Default</span>
        <span class="label label-default">Default</span>
        <span class="label label-default">Default</span>
        <span class="label label-default">Default</span>
      </div>
    </div>
  </div>
</div>
<div class="homeWrapper">
  <div class="container">
    <div class="row">
      <div class="col-sm-6 col-md-4">
        <div class="thumbnail">
          <img src="..." alt="...">
          <div class="caption">
            <h3>Thumbnail label</h3>
            <p>...</p>
            <p><a href="#" class="btn btn-primary" role="button">Button</a> <a href="#" class="btn btn-default" role="button">Button</a></p>
          </div>
        </div>
      </div>
      <div class="col-sm-6 col-md-4">
        <div class="thumbnail">
          <img src="..." alt="...">
          <div class="caption">
            <h3>Thumbnail label</h3>
            <p>...</p>
            <p><a href="#" class="btn btn-primary" role="button">Button</a> <a href="#" class="btn btn-default" role="button">Button</a></p>
          </div>
        </div>
      </div>
      <div class="col-sm-6 col-md-4">
        <div class="thumbnail">
          <img src="..." alt="...">
          <div class="caption">
            <h3>Thumbnail label</h3>
            <p>...</p>
            <p><a href="#" class="btn btn-primary" role="button">Button</a> <a href="#" class="btn btn-default" role="button">Button</a></p>
          </div>
        </div>
      </div>
      <div class="col-sm-6 col-md-4">
        <div class="thumbnail">
          <img src="..." alt="...">
          <div class="caption">
            <h3>Thumbnail label</h3>
            <p>...</p>
            <p><a href="#" class="btn btn-primary" role="button">Button</a> <a href="#" class="btn btn-default" role="button">Button</a></p>
          </div>
        </div>
      </div>
    </div>
    <nav class="pagNav" aria-label="Page navigation">
      <ul class="pagination">
        <li>
          <a href="#" aria-label="Previous">
            <span aria-hidden="true">&laquo;</span>
          </a>
        </li>
        <li><a href="#">1</a></li>
        <li><a href="#">2</a></li>
        <li><a href="#">3</a></li>
        <li><a href="#">4</a></li>
        <li><a href="#">5</a></li>
        <li>
          <a href="#" aria-label="Next">
            <span aria-hidden="true">&raquo;</span>
          </a>
        </li>
      </ul>
    </nav>
  </div>
</div>
<script src="/mobileShop/Public/home/js/jquery-3.4.1.min.js"></script>
<script src="/mobileShop/Public/home/js/bootstrap.min.js"></script>
</body>

</html>