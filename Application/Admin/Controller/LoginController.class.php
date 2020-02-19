<?php
namespace Admin\Controller;
use Think\Controller;
class LoginController extends Controller {

    // 检测输入的验证码是否正确，$code为用户输入的验证码字符串
    private function check_verify($code, $id = ''){
        $verify = new \Think\Verify();
        return $verify->check($code, $id);
    }

    public function index() {
        $this->display();
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
    public function do() {
        $account = I('account');    //..接收表单参数
        $password = I('password');
        $verify_code = I('verify_code');
        $check_res = $this->check_verify($verify_code);     //检查验证码是否正确
        if (!$check_res) {
            return $this->error('验证码错误',U('Login/index'));
        }
        $admin_user = M('admin_user');  //..实例化admin_user模型
        $data['account'] = $account;
        $user = $admin_user->where($data)->find();  //  去数据库中查找用户输入的账号
        if (!$user) {
            return $this->error('用户不存在',U('Login/index'));
        } else {
            if (md5($password) !== $user['password']) {
                return $this->error('密码错误',U('Login/index'));
            }
            if ($user['status'] === '0') {
                return $this->error('该用户禁止登陆',U('Login/index'));
            }
            session('user_id', $user['id']);    //..用户已登录，存入session信息
            session('user_name', $user['name']);
            return $this->success('登录成功',U('Order/index'));
        }
    
    }

    public function hello() {
        $admin_user = D('AdminUser');
        $data = $admin_user->select();
        $this->ajaxReturn($data);
    }
}