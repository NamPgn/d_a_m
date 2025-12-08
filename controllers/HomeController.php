<?php
class HomeController
{
    public function index()
    {
        $title = 'Trang chủ';
        $view = 'home.php';
        $product = new Product();
        $category = new Category();
        $categories = $category->getAll();
        $keyword = $_GET['keyword'] ?? null;
        $category_id = $_GET['category_id'] ?? null;
        $products = $product->getAll($keyword, $category_id);

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

    public function checkout()
    {
        // Kiểm tra đăng nhập
        if (!isset($_SESSION['user'])) {
            header('Location: ' . BASE_URL . '?action=login');
            exit;
        }

        $user_id = $_SESSION['user']['id'];

        // Lấy thông tin user
        $userModel = new User();
        $userData = $userModel->getById($user_id);

        // lấy giỏ hàng
        $cartModel = new Cart();
        $cartData = $cartModel->findCartByUserId($user_id);

        if (!$cartData) {
            $_SESSION['message'] = 'Giỏ hàng trống';
            header('Location: ' . BASE_URL . '?action=cart-list');
            exit;
        }

        // lấy sản phẩm trong giỏ
        $cartDetailModel = new CartDetail();
        $cartDetailData = $cartDetailModel->findCartDetailByCartId($cartData['id']);

        // kiểm tra giỏ hàng có sản phẩm không
        if (empty($cartDetailData)) {
            $_SESSION['message'] = 'Giỏ hàng trống';
            header('Location: ' . BASE_URL . '?action=cart-list');
            exit;
        }

        // xử lý khi submit form
        $method = $_SERVER['REQUEST_METHOD'];
        if ($method == 'POST') {
            $customer_name = $_POST['customer_name'];
            $customer_phone = $_POST['customer_phone'];
            $customer_address = $_POST['customer_address'];

            // tính tổng tiền
            $total_amount = 0;
            foreach ($cartDetailData as $item) {
                $total_amount += $item['price'] * $item['quantity'];
            }

            // tạo đơn hàng
            $orderModel = new Order();
            $order_id = $orderModel->createOrder($user_id, $total_amount, $customer_name, $customer_phone, $customer_address);

            // Tạo chi tiết đơn hàng
            $orderDetailModel = new OrderDetail();
            foreach ($cartDetailData as $item) {
                $orderDetailModel->createOrderDetail($order_id, $item['product_id'], $item['quantity'], $item['price']);
            }

            // xóa giỏ hàng sau khi đặt hàng
            $pdo = $cartModel->getConnection();
            $sql = "DELETE FROM cart_detail WHERE cart_id = ?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$cartData['id']]);

            $_SESSION['message'] = 'Đặt hàng thành công! Mã đơn hàng: #' . $order_id;
            header('Location: ' . BASE_URL);
            exit;
        }

        $title = 'Thanh toán';
        $view = 'checkout.php';
        $data = [
            'user' => $userData,
            'cartDetail' => $cartDetailData
        ];
        require_once PATH_VIEW_MAIN;
    }

    public function myOrders()
    {
        // Kiểm tra đăng nhập
        if (!isset($_SESSION['user'])) {
            header('Location: ' . BASE_URL . '?action=login');
            exit;
        }

        $title = 'Đơn hàng của tôi';
        $view = 'my-orders.php';

        $user_id = $_SESSION['user']['id'];
        $orderModel = new Order();
        $data = $orderModel->getOrdersByUserId($user_id);

        require_once PATH_VIEW_MAIN;
    }
}
