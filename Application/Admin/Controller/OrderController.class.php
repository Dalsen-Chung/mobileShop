<?php
namespace Admin\Controller;
use Common\Controller\AdminBaseController;
class OrderController extends AdminBaseController {

  public function get_order_list() {  //  获取订单列表
    $order = M('order');
    $order_product = M('order_product');
    $product = M('product');
    $user = M('user');
    $order_list = $order->select();
    $user_address = M('user_address');
    foreach ($order_list as $key => $value) {
        $order_list[$key]['username'] = $user->where(array('id' => $value['uid']))->getField('name');
        $order_list[$key]['addtime'] = date('Y-m-d H:i:s', $value['addtime']);
        $order_list[$key]['status_text'] = $this->order_status_map($value['status']);
        $order_sn = $value['order_sn'];
        $op_list = $order_product->where(array('order_sn' => $order_sn))->select();
        $descArr = array();
        foreach ($op_list as $op_key => $op_value) {
            $pid = $op_value['pid'];
            $p_name = $product->where(array('id' => $pid))->getField('name');
            array_push($descArr, '商品：'.$p_name.'，单价：¥'.$op_value['price'].'，数量：'.$op_value['num']);
        }
        $order_list[$key]['desc'] = implode('<br>', $descArr);

        //  获取用户地址
        $address = $user_address->where(array('uid' => $value['uid']))->find();
        $order_list[$key]['address'] = $address['province'].$address['city'].$address['district'].$address['address'];
    }

    $res['code'] = 0;
    $res['data'] = $order_list;
    $res['count'] = $order->count();
    $this->ajaxReturn($res);
  }

  public function deliver() {   //  订单发货接口
    $data = array(
      'tracking_num' => I('tracking_num'),
      'status' => 2
    );

    $order = M('order');
    $where['id'] = I('id');
    $res = $order->where($where)->save($data);
    $this->ajaxReturn($res);
  }

  private function order_status_map($status) {   //  订单状态码与解释映射
      $map = array(
          '1' => '支付成功',
          '2' => '已发货',
          '3' => '已取消'
      );
      $text = $map[$status];
      if ($text) {
          return $map[$status];
      } else {
          return '未知';
      }
  }
}