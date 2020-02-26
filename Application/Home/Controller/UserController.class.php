<?php
namespace Home\Controller;
use Common\Controller\HomeBaseController;
class UserController extends HomeBaseController {

    public function logout() {  //  退出当前用户
        session(null); // 清空当前的session
        $this->redirect('Index/login'); //..重定向至登录页面
    }

    public function cart() {    //  渲染购物车页面
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
    public function add_cart() {    //  将商品加入购物车
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

    public function info() {    //  渲染个人信息页面
        $user = M('user');
        $user_id = session('member_id');
        $map['id'] = $user_id;
        $user_info = $user->where($map)->find();
        $this->assign('user_info', $user_info);
        $this->display();
    }

    public function save_info() {   //  保存修改后的个人信息
        $account = I('account');
        $name = I('name');
        $tel = I('tel');
        $sex = I('sex');
        $password = I('password', '');

        $map['account'] = $account;
        $data['name'] = $name;
        $data['tel'] = $tel;
        $data['sex'] = $sex;
        if ($password !== '') {
            $data['password'] = md5($password);
        }
        $user = M('user');
        $res = $user->where($map)->save($data); //  调用模型更新用户信息
        if ($res !== false) {
            session('member_name', $name);
            return $this->success('信息修改成功');
        } else {
            return $this->error('信息修改失败');
        }
    }

    public function top_up() {  //  渲染余额充值页面
        $user = M('user');
        $user_id = session('member_id');
        $map['id'] = $user_id;
        $balance = $user->where($map)->getField('balance');
        $this->assign('balance', $balance);
        $this->display();
    }

    public function do_top_up() {   //  执行余额充值
        $balance = I('balance');
        $user = M('user');
        $user_id = session('member_id');
        $map['id'] = $user_id;
        $res = $user->where($map)->setInc('balance', $balance);
        if ($res !== false) {
            return $this->success('充值成功');
        } else {
            return $this->error('充值失败');
        }
    }

    public function address() {  //  渲染收货地址页面
        $address = M('user_address');
        $user_id = session('member_id');
        $map['uid'] = $user_id;
        $user_address = $address->where($map)->find();
        if ($user_address) {
            $this->assign('user_address', $user_address);
        } else {
            $this->assign('user_address', array());
        }
        $this->display();
    }

    public function save_address() {    //  保存收货地址
        $data['receiver'] = I('receiver');
        $data['tel'] = I('tel');
        $data['address'] = I('address');
        $data['postcode'] = I('postcode');
        $address = M('user_address');
        $user_id = session('member_id');
        $map['uid'] = $user_id;
        $user_address = $address->where($map)->find();
        if ($user_address) {    //  存在收货地址则更新
            $address_map['id'] = $user_address['id'];
            $res = $address->where($address_map)->save($data);
            if ($res !== false) {
                return $this->success('地址修改成功');
            } else {
                return $this->error('地址修改失败');
            }
        } else {    //  不存在则添加
            $data['uid'] = $user_id;
            $data['addtime'] = time();
            $res = $address->add($data);
            if ($res) {
                return $this->success('地址添加成功');
            } else {
                return $this->error('地址添加失败');
            }
        }
    }

    public function settle() {  //  渲染结算页面
        $address = M('user_address');
        $user_id = session('member_id');
        $map['uid'] = $user_id;
        $user_address = $address->where($map)->find();  //  先判断用户有无填写收货地址
        if ($user_address) {   //   有收货地址
            $cart = M('shopping_car');
            $c_map['uid'] = $user_id;
            $cart_list = $cart->where($c_map)->select();   //  查询当前用户的购物车数据
            if ($cart_list == null) {  //  购物车没有记录
                return $this->redirect('User/cart');
            }
            $price_count = 0;   //  购物车总金额计算变量
            foreach ($cart_list as $key => $value) {
                // 计算金额
                $price_count = bcadd($price_count, bcmul($value['num'], $value['price']));
            }
            $num_count = $cart->where($c_map)->sum('num');
            $this->assign('num_count', $num_count);
            $this->assign('price_count', number_format($price_count, 2));
            $this->assign('address', $user_address);    //..往模板中传入收货地址
            $this->display();
        } else {    //  无收货地址则先完善收货地址
            return $this->error('请先完善收货地址', U('User/address'));
        }
    }

    public function do_settle() {   //  执行购物车结算
        $cart = M('shopping_car');
        $uid = session('member_id');
        $c_map['uid'] = $uid;
        $cart_list = $cart->where($c_map)->select();   //  查询当前用户的购物车数据
        $price_count = 0;   //  购物车总金额计算变量
        foreach ($cart_list as $key => $value) {
            // 计算金额
            $price_count = bcadd($price_count, bcmul($value['num'], $value['price']));
        }
        $num_count = $cart->where($c_map)->sum('num');

        $user = M('user');
        $user_balance = $user->where(array('id' => $uid))->getField('balance'); //..获取用户余额
        if ($user_balance < $price_count) {     //  用户余额不足
            return $this->error('您当前余额不足，请先充值', U('User/top_up'));
        } else {    //  余额足够 立即购买商品
            $buy_res = $user->where(array('id' => $uid))->setDec('balance', $price_count);
            if ($buy_res) { //  扣款成功
                //  生产订单
                $order_no = $this->get_sn();
                $order_data['uid'] = $uid;
                $order_data['order_sn'] = $order_no;
                $order_data['price'] = $price_count;
                $order_data['product_num'] = $num_count;
                $order_data['status'] = 1;  //..1支付成功，2已发货，3已退货，4已取消
                $order_data['addtime'] = time();
                $order = M('order');
                $order->add($order_data);

                //  往订单商品中间表插入记录
                $order_product = M('order_product');
                foreach ($cart_list as $key => $value) {
                    $op_data['order_no'] = $order_no;
                    $op_data['pid'] = $value['pid'];
                    $op_data['price'] = $value['price'];
                    $op_data['num'] = $value['num'];
                    $order_product->add($op_data);
                }

                //  清空用户购物车
                $cart->where(array('uid' => $uid))->delete();
                return $this->success('商品购买成功', U('User/order'));
            } else {
                return $this->error('用户扣款失败');
            }
        }

    }
    private function get_sn() {     //  生成唯一订单号函数
        return date('YmdHis').rand(100000, 999999);
    }
}