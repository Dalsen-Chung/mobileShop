<?php
namespace Admin\Controller;
use Common\Controller\AdminBaseController;
class UserController extends AdminBaseController {

    public function member(){
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