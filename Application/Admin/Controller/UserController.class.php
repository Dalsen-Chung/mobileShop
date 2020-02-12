<?php
namespace Admin\Controller;
use Common\Controller\AdminBaseController;
class UserController extends AdminBaseController {

    public function get_admin_list() {  //  查询管理员列表
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

    public function delete_admin() {    //  删除管理员用户
        $id = I('user_id');
        $admin_user = M('admin_user');  //..实例化admin_user模型
        $data['id'] = $id;
        $res = $admin_user->where($data)->delete();
        $this->ajaxReturn($res);
    }

    public function edit_admin() {    //  编辑管理员用户
        $id = I('id');
        $name = I('name');
        $status = I('status');
        $admin_user = M('admin_user');  //..实例化admin_user模型
        $where['id'] = $id;
        $data['name'] = $name;
        $data['status'] = $status;
        $res = $admin_user->where($where)->save($data);
        $this->ajaxReturn($res);
    }
}