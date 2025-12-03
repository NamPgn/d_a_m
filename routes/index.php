<?php
$action = $_GET['action'] ?? '/';

match ($action) {
  '/' => (new HomeController())->index(),
  'product-detail' => (new HomeController())->productDetail(),

  'login' => (new HomeController())->login(),
  'register' => (new HomeController())->register(),
  'logout' => (new HomeController())->logout(),
  'check-cart-quantity' => (new HomeController())->checkCartQuantity(),
  'cart-list' => (new HomeController())->cartList(),
  'cart-delete' => (new HomeController())->cartDelete(),
  'checkout' => (new HomeController())->checkout(),
  'my-orders' => (new HomeController())->myOrders(),

  //admin
  'admin' => (new DashboardController())->index(),
  'admin-category' => (new CategoryController())->category(),
  'admin-category-add' => (new CategoryController())->categoryAdd(),
  'admin-category-edit' => (new CategoryController())->categoryEdit(),
  'admin-category-delete' => (new CategoryController())->categoryDelete(),


  'admin-products' => (new ProductController())->products(),
  'admin-products-add' => (new ProductController())->productAdd(),
  'admin-products-edit' => (new ProductController())->productEdit(),
  'admin-products-delete' => (new ProductController())->productDelete(),

  'admin-users' => (new UserController())->users(),
  'admin-users-add' => (new UserController())->userAdd(),
  'admin-users-edit' => (new UserController())->userEdit(),
  'admin-users-delete' => (new UserController())->userDelete(),

  'admin-orders' => (new OrderController())->orders(),
};
