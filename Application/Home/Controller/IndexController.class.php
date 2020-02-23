<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {

    public function index() {
        $query_cid = I('cid','');
        $query_bid = I('bid','');

        $category = $this->get_category();
        $brand = $this->get_brand();
        
        $product_data = $this->get_product($query_cid, $query_bid);
        $p_list = $product_data['list'];
        $page = $product_data['page'];
        $this->assign('c_list',$category);
        $this->assign('b_list',$brand);
        $this->assign('query_cid',$query_cid);
        $this->assign('query_bid',$query_bid);
        $this->assign('p_list',$p_list);
        $this->assign('page',$page);
        $this->display();
    }

    private function get_category() {
        $category = M('category');  //..实例化category模型
        $category_list = $category->order('addtime desc')->select();
        return $category_list;
    }

    private function get_brand() {
        $brand = M('brand');  //..实例化brand模型
        $brand_list = $brand->order('addtime desc')->select();
        return $brand_list;
    }

    private function get_product($cid, $bid) {
        $search = I('search', '');
        $map = array('status' => 1);
        if ($cid) {
            $map['cid'] = $cid;
        }
        if ($bid) {
            $map['brand_id'] = $bid;
        }
        if ($search) {
            $this->assign('search',$search);
            $map['name']  = array('LIKE', '%'.$search.'%');
        }
        $product = M('product');  //..实例化product模型
        $count      = $product->where($map)->count();// 查询满足要求的总记录数
        $Page       = new \Think\Page($count,10);// 实例化分页类 传入总记录数和每页显示的记录数(10)
        $Page->setConfig('header', '<li class="rows">共<b>%TOTAL_ROW%</b>条记录&nbsp;第<b>%NOW_PAGE%</b>页/共<b>%TOTAL_PAGE%</b>页</li>');
        $Page->setConfig('prev', '上一页');
        $Page->setConfig('next', '下一页');
        $Page->setConfig('last', '末页');
        $Page->setConfig('first', '首页');
        $Page->setConfig('theme', '%FIRST%%UP_PAGE%%LINK_PAGE%%DOWN_PAGE%%END%%HEADER%');
        $Page->lastSuffix = false;//最后一页不显示为总页数
        $show       = $Page->show();// 分页显示输出
        $product_list = $product->where($map)->order('addtime desc')->limit($Page->firstRow.','.$Page->listRows)->select();
        $brand = M('brand');
        $category = M('category');
        foreach ($product_list as $key => $value) {
          $brand_where['id'] = $value['brand_id'];
          $category_where['id'] = $value['cid'];
    
          $product_list[$key]['category_name'] = $category->where($category_where)->getField('name');
          $product_list[$key]['brand_name']  = $brand->where($brand_where)->getField('name');
          $product_list[$key]['addtime'] =  date('Y-m-d H:i:s', $value['addtime']);
          $product_list[$key]['updatetime'] =  date('Y-m-d H:i:s', $value['updatetime']);
        }
        return array(
            'list' => $product_list,
            'page' => $show
        );
    }
}