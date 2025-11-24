<?php
class HomeController
{
    public function index()
    {
        $title = 'Trang chủ';
        $view = 'home.php';
        $product = new Product();
        $products = $product->getAll();
        require_once PATH_VIEW_MAIN;
    }

    public function productDetail()
    {
        $title = 'Chi tiết sản phẩm';
        $view = 'product-detail.php';
        $product = new Product();
        $product = $product->getById($_GET['id']);
        $category = new Category();
        $category = $category->getById($product['category_id']);
        $data = [
            'product' => $product,
            'category' => $category,
        ];
        require_once PATH_VIEW_MAIN;
    }
    public function login()
    {
        $method = $_SERVER['REQUEST_METHOD'];
        if ($method == 'POST') {
            $email = $_POST['email'];
            $password = $_POST['password'];
            $user = new User();
            $userData = $user->checkLogin($email, $password);
            if ($userData) {
                $_SESSION['message'] = 'Đăng nhập thành công';
                $_SESSION['user'] = [
                    'id' => $userData['id'],
                    'name' => $userData['name'],
                    'email' => $userData['email'],
                    'role' => $userData['role'],
                ];
                if ($userData['role'] == '1') {
                    header('Location: ' . BASE_URL . '?action=admin');
                    exit;
                } else {
                    header('Location: ' . BASE_URL);
                    exit;
                }
                header('Location: ' . BASE_URL);
                exit;
            } else {
                $_SESSION['message'] = 'Email hoặc mật khẩu không đúng';
                header('Location: ' . BASE_URL . '?action=login');
                exit;
            }
        }
        $title = 'Đăng nhập';
        $view = 'login.php';
        require_once PATH_VIEW_MAIN;
    }

    public function register()
    {
        $method = $_SERVER['REQUEST_METHOD'];
        if ($method == 'POST') {
            if ($_POST['password'] == $_POST['confirm_password']) {
                $user = new User();
                $userData = $user->findByEmail($_POST['email']);
                if ($userData) {
                    $_SESSION['message'] = 'Email đã tồn tại';
                    header('Location: ' . BASE_URL . '?action=register');
                    exit;
                } else {
                    $user->register($_POST['email'], $_POST['password'], $_POST['name'], $_POST['phone'], $_POST['address']);
                    $_SESSION['message'] = 'Đăng ký thành công';
                    header('Location: ' . BASE_URL . '?action=login');
                    exit;
                }
            } else {
                $_SESSION['message'] = 'Mật khẩu và mật khẩu xác nhận không khớp';
                header('Location: ' . BASE_URL . '?action=register');
                exit;
            }
        }
        $title = 'Đăng ký';
        $view = 'register.php';
        require_once PATH_VIEW_MAIN;
    }

    public function logout()
    {
        if (isset($_SESSION['user'])) {
            unset($_SESSION['user']);
            $_SESSION['message'] = 'Đăng xuất thành công';
            header('Location: ' . BASE_URL);
        }
        exit;
    }

    public function checkCartQuantity()
    {
        $product_id = (int)$_POST['product_id'];
        $quantity   = (int)$_POST['quantity'];

        // Lấy sản phẩm
        $productModel = new Product();
        $product = $productModel->getById($product_id);
        $stock = (int)$product['quantity'];

        // Kiểm tra số lượng nhập vào
        if ($quantity < 1 || $quantity > $stock || !is_numeric($_POST['quantity'])) {
            $_SESSION['message'] = 'Số lượng sản phẩm không hợp lệ';
            header('Location: ' . BASE_URL . '?action=product-detail&id=' . $product_id);
            exit;
        }

        // Lấy giỏ hàng
        $cartModel = new Cart();
        $cart = $cartModel->findCartByUserId($_SESSION['user']['id']);
        if (!$cart) {
            $cart = $cartModel->createCart($_SESSION['user']['id']);
        }

        // Lấy cart detail
        $cartDetailModel = new CartDetail();
        $cartDetailData = $cartDetailModel->findCartDetailByCartIdAndProductId($cart['id'], $product_id);

        $currentQty = $cartDetailData ? (int)$cartDetailData['quantity'] : 0;

        // KIỂM TRA TỔNG SỐ LƯỢNG
        if ($currentQty + $quantity > $stock) {
            $_SESSION['message'] = 'Số lượng vượt quá tồn kho!';
            header('Location: ' . BASE_URL . '?action=product-detail&id=' . $product_id);
            exit;
        }

        // Nếu chưa có → tạo mới
        if (!$cartDetailData) {
            $cartDetailModel->createCartDetail($cart['id'], $product_id, $quantity);
        }
        // Nếu có → cập nhật
        else {
            $cartDetailModel->updateCartDetail($cart['id'], $product_id, $quantity);
        }

        $_SESSION['message'] = 'Thêm vào giỏ hàng thành công';
        header('Location: ' . BASE_URL . '?action=product-detail&id=' . $product_id);
        exit;
    }
    public function cartList()
    {
        if (!isset($_SESSION['user'])) {
            header('Location: ' . BASE_URL . '?action=login');
            exit;
        }

        $title = 'Giỏ hàng';
        $view = 'cart-list.php';

        // Lấy hoặc tạo giỏ hàng
        $cartModel = new Cart();
        $cartData = $cartModel->findCartByUserId($_SESSION['user']['id']);

        if (!$cartData) {
            // Nếu user chưa có giỏ → tạo mới
            $cartData = $cartModel->createCart($_SESSION['user']['id']);
        }

        // Lấy danh sách sản phẩm trong giỏ
        $cartDetailModel = new CartDetail();
        $cartDetailData = $cartDetailModel->findCartDetailByCartId($cartData['id']);

        // Truyền dữ liệu sang view
        $data = [
            'cart' => $cartData,
            'cartDetail' => $cartDetailData
        ];

        require_once PATH_VIEW_MAIN;
    }

    public function cartDelete()
    {
        if (!isset($_GET['product_id']) || !isset($_GET['cart_id'])) {
            $_SESSION['message'] = 'Dữ liệu không hợp lệ';
            header('Location: ' . BASE_URL . '?action=cart-list');
            exit;
        }
        $product_id = $_GET['product_id'];
        $cart_id = $_GET['cart_id'];

        $cartDetailModel = new CartDetail();
        $cartDetailModel->deleteCartDetail($product_id, $cart_id);

        $_SESSION['message'] = 'Xóa sản phẩm khỏi giỏ hàng thành công';
        header('Location: ' . BASE_URL . '?action=cart-list');
        exit;
    }
}
