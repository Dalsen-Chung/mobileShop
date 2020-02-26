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

        $user_id = session('member_id');
        if ($user_id) {    //  已登录
            $cart = M('shopping_car');
            $map['uid'] = $user_id;
            $cart_counts = $cart->where($map)->count();
            $this->assign('cart_counts',$cart_counts);
        }
        $this->display();
    }

    public function register() {
        $user_id = session('member_id');
        if ($user_id) {    //  已登录
            $cart = M('shopping_car');
            $map['uid'] = $user_id;
            $cart_counts = $cart->where($map)->count();
            $this->assign('cart_counts',$cart_counts);
        }
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
        $Page       = new \Think\Page($count,12);// 实例化分页类 传入总记录数和每页显示的记录数(10)
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

    public function do_register() {
        $account = I('account');
        $name = I('name');
        $password = md5(I('password'));
        $tel = I('tel');
        $sex = I('sex');

        $user = M('user');
        $map['account'] = $account;
        $had_acc = $user->where($map)->find();
        if ($had_acc) {
            return $this->error('账号已存在');
        }
        $upload = $this->upload_avatar();
        if ($upload === false) {
            return $this->error('头像上传失败');
        }
        $map['name'] = $name;
        $map['password'] = $password;
        $map['tel'] = $tel;
        $map['sex'] = $sex;
        $map['avatar'] = $upload;
        $map['addtime'] = time();
        $res = $user->add($map);
        if ($res) {
            return $this->success('注册成功', U('Index/login'));
        } else {
            return $this->error('注册失败');
        }
    }

    private function upload_avatar () {  //  上传用户头像
        $upload = new \Think\Upload();// 实例化上传类
        $upload->maxSize   =     5242880 ;// 设置附件上传大小 5m
        $upload->exts      =     array('jpg', 'png', 'jpeg');// 设置附件上传类型
        $upload->rootPath  =     './Uploads/'; // 设置附件上传根目录
        $upload->savePath  =     'images/avatar/'; // 设置附件上传（子）目录
        $upload->saveName  =     array('uniqid','');
    
        // 上传单个文件 
        $info   =   $upload->uploadOne($_FILES['avatar']);
        if(!$info) {// 上传错误提示错误信息
            return false;
        }else{// 上传成功
            return $info['savepath']. $info['savename'];
        }
    }

    // 检测输入的验证码是否正确，$code为用户输入的验证码字符串
    private function check_verify($code, $id = '') {
        $verify = new \Think\Verify();
        return $verify->check($code, $id);
    }

    /**
     * 生成验证码
     */
    public function get_captcha() {
        $config =    array(
            'length'      =>    4,     // 验证码位数
            'useNoise'    =>    false // 关闭验证码杂点
        );
        $Verify = new \Think\Verify($config);
        $Verify->entry();
    }

    /**
     * 执行登录方法
     */
    public function do_login() {
        $account = I('account');    //..接收表单参数
        $password = I('password');
        $verify_code = I('verify_code');
        $check_res = $this->check_verify($verify_code);     //检查验证码是否正确
        if (!$check_res) {
            return $this->error('验证码错误',U('Index/login'));
        }
        $member_user = M('user');  //..实例化user模型
        $data['account'] = $account;
        $user = $member_user->where($data)->find();  //  去数据库中查找用户输入的账号
        if (!$user) {
            return $this->error('用户不存在',U('Index/login'));
        } else {
            if (md5($password) !== $user['password']) {
                return $this->error('密码错误',U('Index/login'));
            }
            if ($user['status'] === '0') {
                return $this->error('该用户禁止登陆',U('Index/login'));
            }
            session('member_id', $user['id']);    //..用户已登录，存入session信息
            session('member_name', $user['name']);
            session('member_avatar', $user['avatar']);
            return $this->success('登录成功',U('Index/index'));
        }
    }

    public function detail() {      //  渲染商品详情
        $pid = I('pid');
        $product = M('product');
        $res = $product->where(array('id' => $pid))->find();    //..查询商品详情

        $brand = M('brand');
        $category = M('category');
        $res['category_name'] = $category->where(array('id' => $res['cid']))->getField('name');
        $res['brand_name']  = $brand->where(array('id' => $res['brand_id']))->getField('name');
        $res['addtime'] = date('Y-m-d', $res['addtime']);

        $photo_list = explode(',', $res['photo_list']);     //..将商品详情图片字符串转化为数组

        $user_id = session('member_id');
        if ($user_id) {    //  已登录，查询购物车数量
            $cart = M('shopping_car');
            $map['uid'] = $user_id;
            $cart_counts = $cart->where($map)->count();
            $this->assign('cart_counts',$cart_counts);
        }

        $this->assign('product', $res);
        $this->assign('photo_list', $photo_list);
        $this->display();
    }
}