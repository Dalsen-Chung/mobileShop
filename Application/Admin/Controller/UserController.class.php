<?php
namespace Admin\Controller;
use Common\Controller\AdminBaseController;
class UserController extends AdminBaseController {

    public function get_admin_list() {  //  查询管理员列表
        $page = I('page');
        $limit = I('limit');
        $start = ($page - 1) * $limit;
        $admin_user = M('admin_user');  //..实例化admin_user模型
        $user_list = $admin_user->limit($start, $limit)->order('addtime desc')->select();
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
        $password = I('password');

        $admin_user = M('admin_user');  //..实例化admin_user模型
        $where['id'] = $id;
        $data['name'] = $name;
        $data['status'] = $status;
        if ($password != "") {
            $data['password'] = md5($password);
        }
        $res = $admin_user->where($where)->save($data);
        $this->ajaxReturn($res);
    }

    public function add_admin() {    //  编辑管理员用户
        $account = I('account');
        $name = I('name');
        $status = I('status');
        $password = md5(I('password'));

        $admin_user = M('admin_user');  //..实例化admin_user模型
        $data['name'] = $name;
        $data['status'] = $status;
        $data['account'] = $account;
        $data['password'] = $password;
        $data['addtime'] = time();
        $res = $admin_user->add($data);
        $this->ajaxReturn($res);
    }

    public function get_user_list() {  //  查询会员用户列表
        $page = I('page');
        $limit = I('limit');
        $start = ($page - 1) * $limit;
        $user = M('user');  //..实例化user模型
        $user_list = $user->limit($start, $limit)->order('addtime desc')->select();
        foreach ($user_list as $key => $value) {
            $user_list[$key]['status'] = $value['status'] == 1 ? '正常' : '禁用';
            $user_list[$key]['balance'] = number_format(($value['balance']/100),2);
            $user_list[$key]['sex'] = $value['sex'] == 1 ? '男' : '女';
            $user_list[$key]['addtime'] =  date('Y-m-d H:i:s', $value['addtime']);
        }
        $res['code'] = 0;
        $res['data'] = $user_list;
        $res['count'] = $user->count();
        $this->ajaxReturn($res);
    }

    public function delete_user() {    //  删除会员用户
        $id = I('user_id');
        $user = M('user');  //..实例化user模型
        $data['id'] = $id;
        $res = $user->where($data)->delete();
        $this->ajaxReturn($res);
    }

    public function edit_user() {    //  编辑会员用户
        $id = I('id');
        $name = I('name');
        $status = I('status');
        $sex = I('sex');
        $tel = I('tel');
        $balance = intval(floatval(I('balance')) * 100);    //  先将字符串转换成浮点数再乘以100，最后转成int
        $user = M('user');  //..实例化user模型
        $where['id'] = $id;
        $data['name'] = $name;
        $data['status'] = $status;
        $data['sex'] = $sex;
        $data['tel'] = $tel;
        $data['balance'] = $balance;
        $res = $user->where($where)->save($data);
        $this->ajaxReturn($res);
    }
}