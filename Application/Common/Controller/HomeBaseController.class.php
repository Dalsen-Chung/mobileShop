<?php
namespace Common\Controller;
use Think\Controller;
class HomeBaseController extends Controller {
    public function __construct() {
      parent::__construct();
      $user_id = session('member_id');
      if (!$user_id) {    //  未登录
        $this->redirect('Index/login'); //..重定向至登录页面
      }
    }
}