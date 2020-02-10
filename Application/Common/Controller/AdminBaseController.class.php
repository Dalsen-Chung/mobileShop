<?php
namespace Common\Controller;
use Think\Controller;
class AdminBaseController extends Controller {
    public function __construct() {
      parent::__construct();
      $user_id = session('user_id');
      if (!$user_id) {    //  未登录
        $this->redirect('Login/index'); //..重定向至登录页面
      }
      $this->assign('route','123');
    }
}