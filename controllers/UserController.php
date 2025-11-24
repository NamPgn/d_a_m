<?php
class UserController
{
  public function users()
  {
    $title = 'Users';
    $view = 'admin/users.php';
    $user = new User();
    $data = $user->getAll();
    require_once PATH_VIEW_MAIN;
  }
  public function userAdd()
  {
    $title = 'Add User';
    $view = 'admin/users-add.php';
    $user = new User();
    $method = $_SERVER['REQUEST_METHOD'];
    if ($method == 'POST') {
      $email = $_POST['email'];
      $password = $_POST['password'];
      $name = $_POST['name'];
      $phone = $_POST['phone'];
      $address = $_POST['address'];
      $user->add($email, $password, $name, $phone, $address);
      $_SESSION['message'] = 'Thêm User Thành Công';
      header('Location: ' . BASE_URL . '?action=admin-users');
      exit;
    }
    $user = new User();
    require_once PATH_VIEW_MAIN;
  }
  public function userEdit()
  {
    $title = 'Edit User';
    $view = 'admin/users-edit.php';
    $user = new User();
    $data = $user->getById($_GET['id']);
    $method = $_SERVER['REQUEST_METHOD'];
    if ($method == 'POST') {
      $id = $_POST['id'];
      $email = $_POST['email'];
      $password = $_POST['password'];
      $name = $_POST['name'];
      $phone = $_POST['phone'];
      $address = $_POST['address'];
      $user->edit($id, $email, $password, $name, $phone, $address);
      $_SESSION['message'] = 'Sửa User Thành Công';
      header('Location: ' . BASE_URL . '?action=admin-users');
      exit;
    }
    $user = new User();
    $data = $user->getById($_GET['id']);
    require_once PATH_VIEW_MAIN;
  }
  public function userDelete()
  {
    $title = 'Delete User';
    $view = 'admin/users-delete.php';
    $user = new User();
    $user->delete($_GET['id']);
    $_SESSION['message'] = 'Xóa User Thành Công';
    header('Location: ' . BASE_URL . '?action=admin-users');
    exit;
    require_once PATH_VIEW_MAIN;
  }
}