<?php
namespace Home\Controller;
use Common\Controller\HomeBaseController;
class UserController extends HomeBaseController {
    public function logout() {
        session(null); // 清空当前的session
        $this->redirect('Index/login'); //..重定向至登录页面
    }

    public function add_cart() {
        
    }
}