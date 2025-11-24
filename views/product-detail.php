<div class="container py-5">
  <nav aria-label="breadcrumb" class="mb-4">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="<?= BASE_URL ?>">Trang chủ</a></li>
      <li class="breadcrumb-item active"><?= $product['name'] ?></li>
    </ol>
  </nav>

  <div class="row g-4">
    <!-- Hình ảnh sản phẩm -->
    <div class="col-lg-6">
      <div class="card border-0 shadow-sm">
        <div class="product-image-main">
          <img
            src="<?= $product['image'] ?>"
            alt="<?= $product['name'] ?>"
            class="img-fluid rounded"
            id="mainImage">
        </div>

        <!-- Gallery nhỏ (nếu có nhiều ảnh) -->
        <?php if (isset($product['images']) && count($product['images']) > 0): ?>
          <div class="d-flex gap-2 mt-3 flex-wrap">
            <?php foreach ($product['images'] as $img): ?>
              <img
                src="<?= $img ?>"
                class="thumbnail-image"
                onclick="changeImage(this.src)">
            <?php endforeach; ?>
          </div>
        <?php endif; ?>
      </div>
    </div>

    <!-- Thông tin sản phẩm -->
    <div class="col-lg-6">
      <div class="product-info">
        <h1 class="fw-bold mb-3"><?= $product['name'] ?></h1>

        <!-- Đánh giá -->
        <div class="d-flex align-items-center mb-3">
          <div class="text-warning me-2">
            <i class="bi bi-star-fill"></i>
            <i class="bi bi-star-fill"></i>
            <i class="bi bi-star-fill"></i>
            <i class="bi bi-star-fill"></i>
            <i class="bi bi-star-half"></i>
          </div>
          <span class="text-muted">(4.5/5 - 128 đánh giá)</span>
        </div>

        <!-- Giá -->
        <div class="mb-4">
          <h2 class="text-danger fw-bold mb-0">
            <?= number_format($product['price'], 0, ',', '.') ?> VNĐ
          </h2>
        </div>

        <!-- Mô tả ngắn -->
        <div class="mb-4">
          <h5 class="fw-bold mb-2">Mô tả sản phẩm</h5>
          <p class="text-muted"><?= $product['full_description'] ?? $product['descriptions'] ?></p>
        </div>

        <!-- Thông tin bổ sung -->
        <div class="product-details mb-4">
          <div class="row g-3">
            <div class="col-6">
              <span class="text-muted">Danh mục:</span>
              <strong class="d-block"><?= $category['name'] ?></strong>
            </div>
          </div>
        </div>

        <!-- Số lượng và nút mua -->
        <form action="<?= BASE_URL ?>?action=check-cart-quantity" method="post">
          <input type="hidden" name="product_id" value="<?= $product['id'] ?>">

          <div class="d-flex gap-3 mb-4">
            <div class="input-group" style="max-width: 150px;">
              <button class="btn btn-outline-secondary" type="button" onclick="changeQty(-1)">
                <i class="fa fa-minus"></i>
              </button>

              <input
                type="number"
                class="form-control text-center"
                name="quantity"
                value="1"
                min="1"
                max="<?= $product['quantity'] ?>"
                id="quantity">

              <button class="btn btn-outline-secondary" type="button" onclick="changeQty(1)">
                <i class="fa fa-plus"></i>
              </button>
            </div>

            <?php if (isset($_SESSION['user'])): ?>
              <button type="submit" class="btn btn-primary flex-grow-1">
                <i class="fa fa-cart-plus me-2"></i>Thêm vào giỏ hàng
              </button>
            <?php else: ?>
              <a href="<?= BASE_URL ?>?action=login" class="btn btn-primary flex-grow-1">
                <i class="fa fa-cart-plus me-2"></i>Đăng nhập để thêm vào giỏ hàng
              </a>
            <?php endif; ?>
          </div>
        </form>


        <!-- Nút bổ sung -->
        <div class="d-flex gap-2">
          <button class="btn btn-danger w-100">
            <i class="fa fa-lightning me-2"></i>Mua ngay
          </button>
          <button class="btn btn-outline-secondary" onclick="addToWishlist(<?= $product['id'] ?>)">
            <i class="fa fa-heart"></i>
          </button>
        </div>

        <!-- Chính sách -->
        <div class="mt-4 p-3 bg-light rounded">
          <div class="row g-2 small">
            <div class="col-12">
              <i class="fa fa-truck text-primary me-2"></i>
              <strong>Miễn phí vận chuyển</strong> cho đơn hàng từ 500.000đ
            </div>
            <div class="col-12">
              <i class="fa fa-arrow-repeat text-success me-2"></i>
              <strong>Đổi trả trong 7 ngày</strong> nếu sản phẩm lỗi
            </div>
            <div class="col-12">
              <i class="fa fa-shield text-info me-2"></i>
              <strong>Bảo hành chính hãng</strong> 12 tháng
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Mô tả chi tiết -->
  <div class="row mt-5">
    <div class="col-12">
      <ul class="nav nav-tabs" role="tablist">
        <li class="nav-item">
          <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#description">
            Mô tả chi tiết
          </button>
        </li>
        <li class="nav-item">
          <button class="nav-link" data-bs-toggle="tab" data-bs-target="#specifications">
            Thông số kỹ thuật
          </button>
        </li>
        <li class="nav-item">
          <button class="nav-link" data-bs-toggle="tab" data-bs-target="#reviews">
            Đánh giá (128)
          </button>
        </li>
      </ul>

      <div class="tab-content p-4 border border-top-0 rounded-bottom">
        <div class="tab-pane fade show active" id="description">
          <p><?= $product['full_description'] ?? $product['descriptions'] ?></p>
        </div>

        <div class="tab-pane fade" id="specifications">
          <?php if (isset($product['specifications'])): ?>
            <table class="table table-striped">
              <?php foreach ($product['specifications'] as $key => $value): ?>
                <tr>
                  <td class="fw-bold" style="width: 30%;"><?= $key ?></td>
                  <td><?= $value ?></td>
                </tr>
              <?php endforeach; ?>
            </table>
          <?php else: ?>
            <p class="text-muted">Thông tin đang được cập nhật...</p>
          <?php endif; ?>
        </div>

        <div class="tab-pane fade" id="reviews">
          <p class="text-muted">Chức năng đánh giá đang được phát triển...</p>
        </div>
      </div>
    </div>
  </div>
</div>

<style>
  .hover-card {
    transition: all 0.3s ease;
  }

  .hover-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15) !important;
  }

  .object-fit-cover {
    object-fit: cover;
  }

  .product-image-main {
    position: relative;
    overflow: hidden;
    border-radius: 8px;
    background: #f8f9fa;
  }

  .product-image-main img {
    width: 100%;
    height: auto;
    max-height: 500px;
    object-fit: contain;
  }

  .thumbnail-image {
    width: 80px;
    height: 80px;
    object-fit: cover;
    border-radius: 8px;
    cursor: pointer;
    border: 2px solid transparent;
    transition: all 0.3s ease;
  }

  .thumbnail-image:hover {
    border-color: #0d6efd;
    transform: scale(1.05);
  }

  .product-info h1 {
    font-size: 1.75rem;
  }

  .product-details {
    border-top: 1px solid #dee2e6;
    border-bottom: 1px solid #dee2e6;
    padding: 1rem 0;
  }

  #quantity {
    max-width: 70px;
  }

  .nav-tabs .nav-link {
    color: #6c757d;
    border: none;
    border-bottom: 3px solid transparent;
  }

  .nav-tabs .nav-link.active {
    color: #0d6efd;
    border-bottom-color: #0d6efd;
    background: transparent;
  }
</style>