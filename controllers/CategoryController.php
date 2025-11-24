<?php
class CategoryController
{
  public function category()
  {
    $title = 'Danh Mục';
    $view = 'admin/category.php';
    $categories = new Category();
    $data = $categories->getAll();
    
    require_once PATH_VIEW_MAIN;
  }

  public function categoryAdd()
  {
    $title = 'Thêm Dang Mục';
    $view = 'admin/category-add.php';
    $method = $_SERVER['REQUEST_METHOD'];
    if ($method == 'POST') {
      $name = $_POST['name'];
      $category = new Category();
      $category->add($name);
      $_SESSION['message'] = 'Thêm Danh Mục Thành Công';
      header('Location: ' . BASE_URL . '?action=admin-category');
      exit;
    }
    require_once PATH_VIEW_MAIN;
  }

  public function categoryEdit()
  {
    $title = 'Sửa Danh Mục';
    $view = 'admin/category-edit.php';
    $category = new Category();
    $data['category'] = $category->getById($_GET['id']);
    $method = $_SERVER['REQUEST_METHOD'];
    if ($method == 'POST') {
      $id = $_GET['id'];
      $name = $_POST['name'];
      $category->edit($id, $name);
      $_SESSION['message'] = 'Sửa Danh Mục Thành Công';
      header('Location: ' . BASE_URL . '?action=admin-category');
      exit;
    }
    require_once PATH_VIEW_MAIN;
  }

  public function categoryDelete()
  {
    $title = 'Xóa Dang Mục';
    $view = 'admin/category-delete.php';
    $category = new Category();
    $category->delete($_GET['id']);
    $_SESSION['message'] = 'Xóa Danh Mục Thành Công';
    header('Location: ' . BASE_URL . '?action=admin-category');
    exit;
    require_once PATH_VIEW_MAIN;
  }
}
