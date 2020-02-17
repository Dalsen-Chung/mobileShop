<?php
namespace Admin\Controller;
use Common\Controller\AdminBaseController;
class ProductController extends AdminBaseController {

  public function publish () {  //  渲染发布商品页面
    $category = M('category');  //..实例化category模型
    $brand = M('brand');  //..实例化product模型
    $c_list = $category->order('addtime desc')->select();
    $b_list = $brand->order('addtime desc')->select();
    
    $this->assign('c_list',$c_list);
    $this->assign('b_list',$b_list);
    $this->display();
  }

  public function upload_pd_img () {  //  上传单张商品封面图
    $upload = new \Think\Upload();// 实例化上传类
    $upload->maxSize   =     5242880 ;// 设置附件上传大小 5m
    $upload->exts      =     array('jpg', 'png', 'jpeg');// 设置附件上传类型
    $upload->rootPath  =     './Uploads/'; // 设置附件上传根目录
    $upload->savePath  =     'images/cover/'; // 设置附件上传（子）目录
    $upload->saveName  =     array('uniqid','');

    // 上传单个文件 
    $info   =   $upload->uploadOne($_FILES['pd_cover']);
    if(!$info) {// 上传错误提示错误信息
      $res['code'] = -1;
      $res['msg'] = $upload->getError();
      $res['data'] = array();
    }else{// 上传成功
      $res['code'] = 0;
      $res['msg'] = '上传成功';
      $res['data'] = $info;
    }
    $this->ajaxReturn($res);
  }

  public function do_publish() {  //  发布一件商品
    $data = array(
      'name' => I('name'),
      'photo' => I('photo'),
      'price' => I('price'),
      'stock' => I('stock'),
      'brand_id' => I('bid'),
      'cid' => I('cid'),
      'intro' => I('intro'),
      'content' => I('content'),
      'photo_list' => I('photo_list'),
      'status' => I('status'),
      'is_hot' => I('is_hot'),
      'updatetime' => time(),
      'addtime' => time()
    );

    $product = M('product');  //..实例化product模型
    $res = $product->add($data);
    $this->ajaxReturn($res);
  }

  public function list() {  //  渲染商品列表页面
    $category = M('category');  //..实例化category模型
    $brand = M('brand');  //..实例化product模型
    $c_list = $category->order('addtime desc')->select();
    $b_list = $brand->order('addtime desc')->select();
    
    $this->assign('c_list',$c_list);
    $this->assign('b_list',$b_list);
    $this->display();
  }

  public function get_product_list() {  //  查询商品列表
    $page = I('page');
    $limit = I('limit');
    $start = ($page - 1) * $limit;
    $product = M('product');  //..实例化product模型
    $product_list = $product->limit($start, $limit)->order('addtime desc')->select();
    $brand = M('brand');
    $category = M('category');
    foreach ($product_list as $key => $value) {
      $brand_where['id'] = $value['brand_id'];
      $category_where['id'] = $value['cid'];

      $product_list[$key]['category_name'] = $category->where($category_where)->getField('name');
      $product_list[$key]['brand_name']  = $brand->where($brand_where)->getField('name');
      $product_list[$key]['status'] = $value['status'] == 1 ? '上架' : '下架';
      $product_list[$key]['is_hot'] = $value['is_hot'] == 1 ? '是' : '否';
      $product_list[$key]['addtime'] =  date('Y-m-d H:i:s', $value['addtime']);
      $product_list[$key]['updatetime'] =  date('Y-m-d H:i:s', $value['updatetime']);
    }
    $res['code'] = 0;
    $res['data'] = $product_list;
    $res['count'] = $product->count();
    $this->ajaxReturn($res);
  }

  public function delete_pd() {    //  删除商品
    $id = I('pd_id');
    $product = M('product');  //..实例化product模型
    $data['id'] = $id;
    $res = $product->where($data)->delete();
    $this->ajaxReturn($res);
  }

  public function edit_pd() {    //  编辑商品
    $data = array(
      'name' => I('name'),
      'photo' => I('photo'),
      'price' => I('price'),
      'stock' => I('stock'),
      'brand_id' => I('brand_id'),
      'cid' => I('cid'),
      'intro' => I('intro'),
      'content' => I('content'),
      'photo_list' => I('photo_list'),
      'status' => I('status'),
      'is_hot' => I('is_hot'),
      'updatetime' => time()
    );

    $product = M('product');
    $where['id'] = I('id');
    $res = $product->where($where)->save($data);
    $this->ajaxReturn($res);
  }

  public function get_brand_list() {  //  查询品牌列表
    $page = I('page');
    $limit = I('limit');
    $start = ($page - 1) * $limit;
    $brand = M('brand');  //..实例化product模型
    $brand_list = $brand->limit($start, $limit)->order('addtime desc')->select();
    foreach ($brand_list as $key => $value) {
        $brand_list[$key]['addtime'] =  date('Y-m-d H:i:s', $value['addtime']);
    }
    $res['code'] = 0;
    $res['data'] = $brand_list;
    $res['count'] = $brand->count();
    $this->ajaxReturn($res);
  }

  public function delete_brand() {    //  删除品牌
    $id = I('brand_id');
    $brand = M('brand');  //..实例化brand模型
    $data['id'] = $id;
    $res = $brand->where($data)->delete();
    $this->ajaxReturn($res);
  }

  public function upload_brand_icon() {   //  上传品牌图标
    $upload = new \Think\Upload();// 实例化上传类
    $upload->maxSize   =     5242880 ;// 设置附件上传大小 5m
    $upload->exts      =     array('jpg', 'png', 'jpeg');// 设置附件上传类型
    $upload->rootPath  =     './Uploads/'; // 设置附件上传根目录
    $upload->savePath  =     'images/brand/'; // 设置附件上传（子）目录
    $upload->saveName  =     array('uniqid','');

    // 上传单个文件 
    $info   =   $upload->uploadOne($_FILES['brand_icon']);
    if(!$info) {// 上传错误提示错误信息
      $res['code'] = -1;
      $res['msg'] = $upload->getError();
      $res['data'] = array();
    }else{// 上传成功
      $res['code'] = 0;
      $res['msg'] = '上传成功';
      $res['data'] = $info;
    }
    $this->ajaxReturn($res);
  }

  public function edit_brand() {    //  编辑品牌
    $id = I('id');
    $icon = I('icon');
    $name = I('name');

    $brand = M('brand');
    $where['id'] = $id;
    $data['name'] = $name;
    $data['icon'] = $icon;
    $res = $brand->where($where)->save($data);
    $this->ajaxReturn($res);
  }

  public function add_brand() {    //  添加品牌
    $name = I('name');
    $icon = I('icon');

    $brand = M('brand');
    $data['name'] = $name;
    $data['icon'] = $icon;
    $data['addtime'] = time();
    $res = $brand->add($data);
    $this->ajaxReturn($res);
  }

  public function get_classify_list() {  //  查询分类列表
    $page = I('page');
    $limit = I('limit');
    $start = ($page - 1) * $limit;
    $category = M('category');  //..实例化category模型
    $category_list = $category->limit($start, $limit)->order('addtime desc')->select();
    foreach ($category_list as $key => $value) {
        $category_list[$key]['addtime'] =  date('Y-m-d H:i:s', $value['addtime']);
    }
    $res['code'] = 0;
    $res['data'] = $category_list;
    $res['count'] = $category->count();
    $this->ajaxReturn($res);
  }

  public function delete_category() {    //  删除分类
    $id = I('category_id');
    $category = M('category');
    $data['id'] = $id;
    $res = $category->where($data)->delete();
    $this->ajaxReturn($res);
  }

  public function upload_category_icon() {   //  上传分类图标
    $upload = new \Think\Upload();// 实例化上传类
    $upload->maxSize   =     5242880 ;// 设置附件上传大小 5m
    $upload->exts      =     array('jpg', 'png', 'jpeg');// 设置附件上传类型
    $upload->rootPath  =     './Uploads/'; // 设置附件上传根目录
    $upload->savePath  =     'images/category/'; // 设置附件上传（子）目录
    $upload->saveName  =     array('uniqid','');

    // 上传单个文件 
    $info   =   $upload->uploadOne($_FILES['category_icon']);
    if(!$info) {// 上传错误提示错误信息
      $res['code'] = -1;
      $res['msg'] = $upload->getError();
      $res['data'] = array();
    }else{// 上传成功
      $res['code'] = 0;
      $res['msg'] = '上传成功';
      $res['data'] = $info;
    }
    $this->ajaxReturn($res);
  }

  public function edit_category() {    //  编辑分类
    $id = I('id');
    $icon = I('icon');
    $name = I('name');
    $introduction = I('introduction');

    $category = M('category');
    $where['id'] = $id;
    $data['name'] = $name;
    $data['icon'] = $icon;
    $data['introduction'] = $introduction;
    $res = $category->where($where)->save($data);
    $this->ajaxReturn($res);
  }

  public function add_category() {    //  添加分类
    $name = I('name');
    $icon = I('icon');
    $introduction = I('introduction');

    $category = M('category');
    $data['name'] = $name;
    $data['icon'] = $icon;
    $data['introduction'] = $introduction;
    $data['addtime'] = time();
    $res = $category->add($data);
    $this->ajaxReturn($res);
  }
}