<?php
namespace Admin\Controller;
use Common\Controller\AdminBaseController;
class ProductController extends AdminBaseController {

    public function list(){
      $this->display();
    }

    public function publish() {
      $this->display();
    }

    public function classify() {
      $this->display();
    }

    public function brand() {
      $this->display();
    }

    public function hello() {
        $admin_user = D('AdminUser');
        $data = $admin_user->select();
        $this->ajaxReturn($data);
    }
}