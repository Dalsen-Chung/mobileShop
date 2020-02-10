<?php
namespace Admin\Controller;
use Common\Controller\AdminBaseController;
class LogoutController extends AdminBaseController {

    /**
     * 执行登出方法
     */
    public function do() {
        session(null); // 清空当前的session
        $this->redirect('Login/index'); //..重定向至登录页面
    }
}