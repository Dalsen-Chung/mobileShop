<?php
namespace Admin\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
        $user_id = session('user_id');
        if (!$user_id) {    //  未登录
            $this->redirect('Login/index'); //..重定向至登录页面
        }
        $this->display();
    }

    public function home() {
        $this->display();
    }

    public function hello() {
        $admin_user = D('AdminUser');
        $data = $admin_user->select();
        $this->ajaxReturn($data);
    }
}