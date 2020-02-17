<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-CN">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>嘉兴手机商城管理后台</title>
    <link rel="stylesheet" href="/mobileShop/Public/admin/css/layui.css">
    <link rel="stylesheet" href="/mobileShop/Public/admin/css/common.css">
    <script>
      const USER_ID = '<?php echo (session('user_id')); ?>';
      const UPLOAD_URL = '/mobileShop/Uploads/';
    </script>
</head>
<body class="layui-layout-body">
    <div class="layui-layout layui-layout-admin">
        <div class="layui-header">
    <div class="layui-logo">Jx-Shop管理后台</div>
    <ul class="layui-nav layui-layout-left">
        <li class="layui-nav-item <?php echo $Think.CONTROLLER_NAME === 'Order' ? 'layui-this': '';?>"><a href="<?php echo U('Order/index');?>">订单管理</a></li>
        <li class="layui-nav-item <?php echo $Think.CONTROLLER_NAME === 'Product' ? 'layui-this': '';?>">
            <a href="javascript:;">商品管理</a>
            <dl class="layui-nav-child">
                <dd class="<?php echo $Think.ACTION_NAME === 'publish' ? 'layui-this': '';?>"><a href="<?php echo U('Product/publish');?>">发布商品</a></dd>
                <dd class="<?php echo $Think.ACTION_NAME === 'list' ? 'layui-this': '';?>"><a href="<?php echo U('Product/list');?>">商品列表</a></dd>
                <dd class="<?php echo $Think.ACTION_NAME === 'classify' ? 'layui-this': '';?>"><a href="<?php echo U('Product/classify');?>">商品分类</a></dd>
                <dd class="<?php echo $Think.ACTION_NAME === 'brand' ? 'layui-this': '';?>"><a href="<?php echo U('Product/brand');?>">品牌管理</a></dd>
            </dl>
        </li>
        <li class="layui-nav-item <?php echo $Think.CONTROLLER_NAME === 'User' ? 'layui-this': '';?>">
            <a href="javascript:;">用户管理</a>
            <dl class="layui-nav-child">
                <dd class="<?php echo $Think.ACTION_NAME === 'member' ? 'layui-this': '';?>"><a href="<?php echo U('User/member');?>">会员用户</a></dd>
                <dd class="<?php echo $Think.ACTION_NAME === 'admin' ? 'layui-this': '';?>"><a href="<?php echo U('User/admin');?>">管理员用户</a></dd>
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
            <li class="layui-nav-item <?php echo $Think.CONTROLLER_NAME === 'Order' ? 'layui-this': '';?>"><a href="<?php echo U('Order/index');?>">订单管理</a></li>
            <li class="layui-nav-item <?php echo $Think.CONTROLLER_NAME === 'Product' ? 'layui-nav-itemed': '';?>">
                <a class="" href="javascript:;">商品管理</a>
                <dl class="layui-nav-child">
                    <dd class="<?php echo $Think.ACTION_NAME === 'publish' ? 'layui-this': '';?>"><a href="<?php echo U('Product/publish');?>">发布商品</a></dd>
                    <dd class="<?php echo $Think.ACTION_NAME === 'list' ? 'layui-this': '';?>"><a href="<?php echo U('Product/list');?>">商品列表</a></dd>
                    <dd class="<?php echo $Think.ACTION_NAME === 'classify' ? 'layui-this': '';?>"><a href="<?php echo U('Product/classify');?>">商品分类</a></dd>
                    <dd class="<?php echo $Think.ACTION_NAME === 'brand' ? 'layui-this': '';?>"><a href="<?php echo U('Product/brand');?>">品牌管理</a></dd>
                </dl>
            </li>
            <li class="layui-nav-item <?php echo $Think.CONTROLLER_NAME === 'User' ? 'layui-nav-itemed': '';?>">
                <a href="javascript:;">用户管理</a>
                <dl class="layui-nav-child">
                    <dd class="<?php echo $Think.ACTION_NAME === 'member' ? 'layui-this': '';?>"><a href="<?php echo U('User/member');?>">会员用户</a></dd>
                    <dd class="<?php echo $Think.ACTION_NAME === 'admin' ? 'layui-this': '';?>"><a href="<?php echo U('User/admin');?>">管理员用户</a></dd>
                </dl>
            </li>
        </ul>
    </div>
</div>
        <div class="layui-body main-content">
<div class="product-list" style="padding: 15px;">
  <div class="layui-card">
    <div class="layui-card-header">
      <span>商品列表</span>
      <a href="<?php echo U('publish');?>" class="layui-btn layui-btn-sm">
        <i class="layui-icon">&#xe609;</i> 发布商品
      </a>
    </div>
    <div class="layui-card-body">
      <table id="pdList" lay-filter="pdListTb"></table>
      <script type="text/html" id="pdBar">
        <a class="layui-btn layui-btn-xs" lay-event="edit">编辑</a>
        <a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="del">删除</a>
      </script>
      <script type="text/html" id="pdTpl">
        <img src="/mobileShop/Uploads/{{d.icon}}" style="width: 50px;" />
      </script>
    </div>
  </div>
</div>
        </div>
        <div class="layui-footer footer">
            © 许铭聪 - 1640225146
        </div>
    </div>
    <script src="/mobileShop/Public/home/js/jquery-3.4.1.min.js"></script>
    <script src="/mobileShop/Public/admin/layui.js"></script>
    <script src="/mobileShop/Public/admin/js/common.js"></script>
    <script src="/mobileShop/Public/admin/js/brand.js"></script>
    <script src="/mobileShop/Public/admin/js/classify.js"></script>
    <script src="/mobileShop/Public/admin/js/member.js"></script>
    <script src="/mobileShop/Public/admin/js/publish.js"></script>
    <script src="/mobileShop/Public/admin/js/pdlist.js"></script>
    <script src="/mobileShop/Public/admin/js/admin_user.js"></script>
</body>

</html>

<!-- 编辑商品表单 -->
<form class="layui-form" id="editPd" lay-filter="editPd" style="display: none; padding: 30px;">
  <div class="layui-form-item">
    <label class="layui-form-label">商品名称</label>
    <div class="layui-input-block">
      <input type="text" name="name" placeholder="请输入" lay-verify="required" autocomplete="off" class="layui-input">
    </div>
  </div>
  <div class="layui-form-item">
    <label class="layui-form-label">商品封面</label>
    <div class="layui-input-block">
      <img src="" id="pd_edit_cover" width="80" style="display: none;">
      <button type="button" class="layui-btn layui-btn-normal uploadBtn" id="pd_eidt_cover_btn">
        <i class="layui-icon">&#xe67c;</i>上传单张封面
      </button>
      <input type="hidden" name="photo" id="pd_edit_cover_url" lay-verify="required" lay-reqText="请上传封面" class="layui-input">
    </div>
  </div>
  <div class="layui-form-item">
    <label class="layui-form-label">商品单价(¥)</label>
    <div class="layui-input-block">
      <input type="number" name="price" placeholder="请输入价格" lay-verify="required|number" autocomplete="off"
        class="layui-input">
    </div>
  </div>
  <div class="layui-form-item">
    <label class="layui-form-label">库存量(台)</label>
    <div class="layui-input-block">
      <input type="number" name="stock" placeholder="请输入数量" lay-verify="required|number" autocomplete="off"
        class="layui-input">
    </div>
  </div>
  <div class="layui-form-item">
    <label class="layui-form-label">商品品牌</label>
    <div class="layui-input-block">
      <select name="bid" lay-verify="required">
        <option value="">请选择品牌</option>
        <?php if(is_array($b_list)): $i = 0; $__LIST__ = $b_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["id"]); ?>"><?php echo ($vo["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
      </select>
    </div>
  </div>
  <div class="layui-form-item">
    <label class="layui-form-label">商品分类</label>
    <div class="layui-input-block">
      <select name="cid" lay-verify="required">
        <option value="">请选择分类</option>
        <?php if(is_array($c_list)): $i = 0; $__LIST__ = $c_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["id"]); ?>"><?php echo ($vo["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
      </select>
    </div>
  </div>
  <div class="layui-form-item layui-form-text">
    <label class="layui-form-label">广告语</label>
    <div class="layui-input-block">
      <textarea placeholder="请输入" name="intro" lay-verify="required" class="layui-textarea"></textarea>
    </div>
  </div>
  <div class="layui-form-item layui-form-text">
    <label class="layui-form-label">商品详情</label>
    <div class="layui-input-block">
      <textarea placeholder="请输入" name="content" lay-verify="required" class="layui-textarea"></textarea>
    </div>
  </div>
  <div class="layui-form-item">
    <label class="layui-form-label">详情图片</label>
    <div class="layui-input-block">
      <div class="pd_edit_img_list"></div>
      <button type="button" class="layui-btn layui-btn-warm" id="pd_edit_imgs_btn">
        <i class="layui-icon">&#xe67c;</i>上传多张图片
      </button>
      <button type="button" class="layui-btn layui-btn-danger" id="pd_clear_btn">
        <i class="layui-icon">&#xe640;</i>清空当前图片
      </button>
      <input type="hidden" name="photo_list" id="pd_edit_imgs_url" lay-verify="required" lay-reqText="请上传详情图片" class="layui-input">
    </div>
  </div>
  <div class="layui-form-item">
    <label class="layui-form-label">上架状态</label>
    <div class="layui-input-block">
      <input type="radio" name="status" value="1" title="上架" checked>
      <input type="radio" name="status" value="0" title="下架">
    </div>
  </div>
  <div class="layui-form-item">
    <label class="layui-form-label">是否热卖</label>
    <div class="layui-input-block">
      <input type="checkbox" name="is_hot" value="1" lay-skin="switch" lay-text="是|否">
    </div>
  </div>
  <div class="layui-form-item">
    <div class="layui-input-block">
      <button class="layui-btn" lay-submit lay-filter="publishPd">立即发布</button>
      <button type="reset" class="layui-btn layui-btn-primary">重置</button>
    </div>
  </div>
</form>

<!-- 添加商品品牌表单 -->
<form class="layui-form" id="addProductBrand" lay-filter="addProductBrand" style="display: none; padding: 30px;">
  <div class="layui-form-item">
    <label class="layui-form-label">品牌名称</label>
    <div class="layui-input-block">
      <input type="text" name="name" placeholder="请输入" required lay-verify="required" autocomplete="off"
        class="layui-input">
    </div>
  </div>
  <div class="layui-form-item">
    <label class="layui-form-label">品牌图标</label>
    <div class="layui-input-block">
      <img src="" id="add_brand_icon" width="80" style="display: none;">
      <button type="button" class="layui-btn layui-btn-normal uploadBtn" id="addIconUpload">
        <i class="layui-icon">&#xe67c;</i>上传图标
      </button>
      <input type="hidden" name="icon" id="add_icon_path" required lay-verify="required" lay-reqText="请上传图标"
        class="layui-input">
    </div>
  </div>
  <div class="layui-form-item">
    <div class="layui-input-block">
      <button class="layui-btn" lay-submit lay-filter="brandAddSave">保存</button>
      <button type="reset" class="layui-btn layui-btn-primary">重置</button>
    </div>
  </div>
</form>