<?php
namespace Admin\Controller;
use Common\Controller\AdminBaseController;
class UserController extends AdminBaseController {

    public function get_admin_list() {
        $page = I('page');
        $limit = I('limit');
        $start = ($page - 1) * $limit;
        $admin_user = M('admin_user');  //..实例化admin_user模型
        $user_list = $admin_user->limit($start, $limit)->select();
        foreach ($user_list as $key => $value) {
            $user_list[$key]['status'] = $value['status'] == 1 ? '正常' : '禁用';
            $user_list[$key]['addtime'] =  date('Y-m-d H:i:s', $value['addtime']);
        }
        $res['code'] = 0;
        $res['data'] = $user_list;
        $res['count'] = $admin_user->count();
        $this->ajaxReturn($res);
    }

    public function hello() {
        $admin_user = D('AdminUser');
        $data = $admin_user->select();
        $this->ajaxReturn($data);
    }
}