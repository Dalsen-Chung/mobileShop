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
}