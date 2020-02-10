<?php
namespace Admin\Controller;
use Common\Controller\AdminBaseController;
class UserController extends AdminBaseController {

    public function get_admin_list() {
        $admin_user = M('admin_user');  //..实例化admin_user模型
        $user_list = $admin_user->select();
        $res['code'] = 0;
        $res['data'] = $user_list;
        $this->ajaxReturn($res);
    }

    public function hello() {
        $admin_user = D('AdminUser');
        $data = $admin_user->select();
        $this->ajaxReturn($data);
    }
}