<?php
namespace Admin\Controller;
use Common\Controller\AdminBaseController;
class IndexController extends AdminBaseController {

    public function index(){
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