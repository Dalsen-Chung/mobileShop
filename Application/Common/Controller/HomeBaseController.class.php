<?php
namespace Common\Controller;
use Think\Controller;
class HomeBaseController extends Controller {
    public function __construct() {
      parent::__construct();
      $user_id = session('member_id');
      if (!$user_id) {    //  未登录
        $this->error('请先登录',U('Index/login')); //..重定向至登录页面
      }
      $cart = M('shopping_car');
      $map['uid'] = $user_id;
      $cart_counts = $cart->where($map)->count();
      $this->assign('cart_counts',$cart_counts);
    }
}