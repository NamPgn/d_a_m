<?php
class ProductController
{
  public function products()
  {
    $title = 'Products';
    $view = 'admin/products.php';
    $products = new Product();
    $data = $products->getAll();
    $categories = new Category();
    $categories = $categories->getAll();
    require_once PATH_VIEW_MAIN;
  }

  public function productAdd()
  {
    $title = 'Thêm Sản Phẩm';
    $view = 'admin/product-add.php';
    $method = $_SERVER['REQUEST_METHOD'];
    if ($method == 'POST') {
      $product = new Product();
      $data = $product->getById($_GET['id']);
      $file = $_FILES['image'];
      $pathImage = $data['image'];
      if (!empty($file['name'])) {
        if ($data['image'] != '') {
          unlink(PATH_ROOT . $data['image']);
        }
        $newName = time() . '-' . $file['name'];
        $pathImage = BASE_ASSETS_UPLOADS . $newName;
        move_uploaded_file($file['tmp_name'], $pathImage);
      }
      $name = $_POST['name'];
      $price = $_POST['price'];
      $quantity = $_POST['quantity'];
      $category_id = $_POST['category_id'];
      $image = $pathImage;
      $descriptions = $_POST['descriptions'];
      $product = new Product();
      $product->add($name, $price, $quantity, $category_id, $image, $descriptions);
      $_SESSION['message'] = 'Thêm Sản Phẩm Thành Công';
      header('Location: ' . BASE_URL . '?action=admin-products');
      exit;
    }
    $categories = new Category();
    $categories = $categories->getAll();



    require_once PATH_VIEW_MAIN;
  }

  public function productEdit()
  {
    $title = 'Edit Product';
    $view = 'admin/product-edit.php';
    $method = $_SERVER['REQUEST_METHOD'];
    if ($method == 'POST') {
      $id = $_GET['id'];
      $file = $_FILES['image'];
      $product = new Product();
      $data = $product->getById($_GET['id']);
      $pathImage = $data['image'];
      if (isset($file['name']) && $file['error'] === UPLOAD_ERR_OK) {
        if ($data['image'] != '') {
          unlink(PATH_ROOT . $data['image']);
        }
        $newName = time() . '-' . $file['name'];
        $pathImage = BASE_ASSETS_UPLOADS . $newName;
        move_uploaded_file($file['tmp_name'], $pathImage);
      }
      $name = $_POST['name'];
      $price = $_POST['price'];
      $quantity = $_POST['quantity'];
      $category_id = $_POST['category_id'];
      $image = $pathImage;
      $descriptions = $_POST['descriptions'];
      $product = new Product();
      $product->edit($id, $name, $price, $quantity, $category_id, $image, $descriptions);
      $_SESSION['message'] = 'Sửa Sản Phẩm Thành Công';
      header('Location: ' . BASE_URL . '?action=admin-products');
      exit;
    }
    $categories = new Category();
    $categories = $categories->getAll();
    $product = new Product();
    $data = $product->getById($_GET['id']);
    require_once PATH_VIEW_MAIN;
  }

  public function productDelete()
  {
    $product = new Product();
    $data = $product->getById($_GET['id']);
    if ($data['image'] != '') {
      unlink(PATH_ROOT . $data['image']);
    }
    $product->delete($_GET['id']);
    $_SESSION['message'] = 'Xóa Sản Phẩm Thành Công';
    header('Location: ' . BASE_URL . '?action=admin-products');
    exit;
  }
}
