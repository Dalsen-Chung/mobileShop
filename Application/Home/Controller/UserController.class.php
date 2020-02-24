<?php
namespace Home\Controller;
use Common\Controller\HomeBaseController;
class UserController extends HomeBaseController {
    public function logout() {
        session(null); // 清空当前的session
        $this->redirect('Index/login'); //..重定向至登录页面
    }

    public function cart() {
        $user_id = session('member_id');    //..从session中获取用户id
        $cart = M('shopping_car');
        $product = M('product');
        $brand = M('brand');
        $category = M('category');
        $c_map['uid'] = $user_id;
        $cart_list = $cart->where($c_map)->select();   //  查询当前用户的购物车数据
        $price_count = 0;   //  购物车总金额计算变量
        foreach ($cart_list as $key => $value) {
            $pid = $value['pid'];
            $p_map['id'] = $pid;
            $cart_product = $product->where($p_map)->find();

            $category_where['id'] = $cart_product['cid'];
            $brand_where['id'] = $cart_product['brand_id'];
      
            $cart_list[$key]['name'] = $cart_product['name'];
            $cart_list[$key]['photo'] = $cart_product['photo'];
            $cart_list[$key]['category_name'] = $category->where($category_where)->getField('name');
            $cart_list[$key]['brand_name']  = $brand->where($brand_where)->getField('name');
            $cart_list[$key]['price'] = number_format($value['price'], 2);

            // 计算金额
            $price_count = bcadd($price_count, bcmul($value['num'], $value['price']));
        }
        $num_count = $cart->where($c_map)->sum('num');
        $this->assign('cart_list', $cart_list);
        $this->assign('num_count', $num_count);
        $this->assign('price_count', number_format($price_count, 2));
        $this->display();
    }
    public function add_cart() {
        $pid = I('pid');    //..获取商品ID
        $user_id = session('member_id');    //..从session中获取用户id
        
        $product = M('product');    //..实例化商品模型并查询该商品价格
        $p_map['id'] = $pid;
        $price = $product->where($p_map)->getField('price');

        $cart = M('shopping_car');
        $c_map['pid'] = $pid;
        $c_map['uid'] = $user_id;
        $cart_rec = $cart->where($c_map)->find();   //  查看该商品是否已存在购物车中
        if ($cart_rec) {    //  存在购物车，则该商品数量加一
            $res = $cart->where($c_map)->setInc('num');
            if ($res) {
                return $this->success('成功加入购物车');
            } else {
                return $this->error('加入购物车失败');
            }
        } else {    //  不存在，则新增一条购物车记录
            $add_map['uid'] = $user_id;
            $add_map['pid'] = $pid;
            $add_map['price'] = $price;
            $add_map['addtime'] = time();
            $res = $cart->add($add_map);
            if ($res) {
                return $this->success('成功加入购物车');
            } else {
                return $this->error('加入购物车失败');
            }
        }
    }

    public function inc_cart_num() {    //  购物车商品数量加一
        $cart_id = I('cart_id');
        $cart = M('shopping_car');
        $c_map['id'] = $cart_id;
        $res = $cart->where($c_map)->setInc('num');
        if ($res) {
            return $this->redirect('User/cart');
        } else {
            return $this->error('商品数量增加失败');
        }
    }

    public function dec_cart_num() {    //  购物车商品数量减一
        $cart_id = I('cart_id');
        $cart = M('shopping_car');
        $c_map['id'] = $cart_id;
        $res = $cart->where($c_map)->setDec('num');
        if ($res) {
            return $this->redirect('User/cart');
        } else {
            return $this->error('商品数量减少失败');
        }
    }

    public function delete_cart() {    //  删除购物车产品
        $cart_id = I('cart_id');
        $cart = M('shopping_car');
        $c_map['id'] = $cart_id;
        $res = $cart->where($c_map)->delete();
        if ($res) {
            return $this->redirect('User/cart');
        } else {
            return $this->error('商品删除失败');
        }
    }
}