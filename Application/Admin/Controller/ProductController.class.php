<?php
namespace Admin\Controller;
use Common\Controller\AdminBaseController;
class ProductController extends AdminBaseController {

  public function get_product_list() {  //  查询商品列表
    $page = I('page');
    $limit = I('limit');
    $start = ($page - 1) * $limit;
    $product = M('product');  //..实例化product模型
    $product_list = $product->limit($start, $limit)->select();
    foreach ($product_list as $key => $value) {
        $product_list[$key]['status'] = $value['status'] == 1 ? '正常' : '禁用';
        $product_list[$key]['addtime'] =  date('Y-m-d H:i:s', $value['addtime']);
    }
    $res['code'] = 0;
    $res['data'] = $product_list;
    $res['count'] = $product->count();
    $this->ajaxReturn($res);
  }

  public function get_brand_list() {  //  查询品牌列表
    $page = I('page');
    $limit = I('limit');
    $start = ($page - 1) * $limit;
    $brand = M('brand');  //..实例化product模型
    $brand_list = $brand->limit($start, $limit)->select();
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
}