<?php
class OrderController
{
  public function orders()
  {
    $title = 'Quản lý đơn hàng';
    $view = 'admin/orders.php';
    $orderModel = new Order();
    $data = $orderModel->getAllOrders();
    require_once PATH_VIEW_MAIN;  
  }

}

