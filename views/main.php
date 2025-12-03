<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    <style>
        a {
            text-decoration: none;
            color: inherit;
            cursor: pointer;
            display: inline-block;
            font-size: 1rem;
            line-height: 1.5;
            text-align: center;
            text-decoration: none;
            vertical-align: middle;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-xxl bg-light justify-content-center">
        <div class="d-flex justify-content-between w-100 px-5">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link text-uppercase" href="<?= BASE_URL ?>"><b>Trang chủ</b></a>
                </li>
                <?php if (isset($_SESSION['user'])): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= BASE_URL ?>?action=my-orders">
                            <i class="fa fa-list"></i> Đơn hàng của tôi
                        </a>
                    </li>
                <?php endif; ?>
                <li class="nav-item">
                    <a class="nav-link" href="<?= BASE_URL ?>?action=cart-list">
                        <i class="fa fa-shopping-cart"></i> Giỏ hàng
                    </a>
                </li>
                <?php if (isset($_SESSION['user']) && $_SESSION['user']['role'] === 1): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= BASE_URL ?>?action=admin">
                            <i class="fa fa-dashboard"></i> Quản trị
                        </a>
                    </li>
                <?php endif; ?>
            </ul>
            <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <?= $_SESSION['user']['name'] ?? 'Guest' ?>
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <?= isset($_SESSION['user']) ? '<a class="dropdown-item" href="' . BASE_URL . '?action=logout">Đăng xuất</a>' : '<a class="dropdown-item" href="' . BASE_URL . '?action=login">Đăng nhập</a>' ?>
                </div>
            </div>
        </div>
    </nav>

    <div class="container">
        <h1 class="mt-3 mb-3"><?= $title ?? 'Home' ?></h1>

        <div class="row">
            <?php if (isset($_SESSION['message'])): ?>
                <div class="alert alert-success">
                    <?= $_SESSION['message'] ?>
                </div>
                <?php unset($_SESSION['message']); ?>
            <?php endif; ?>
            <?php
            if (isset($view)) {
                require_once PATH_VIEW . $view;
            }
            ?>
        </div>
    </div>

</body>

</html>