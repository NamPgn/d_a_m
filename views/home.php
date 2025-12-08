<div class="container-fluid px-0">
  <!-- Hero Banner Section -->
  <div class="hero-banner position-relative mb-5" style="height: 300px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
    <div class="position-absolute top-50 start-50 translate-middle text-center text-white w-100">
      <h1 class="display-4 fw-bold mb-3">Khám Phá Sản Phẩm</h1>
      <p class="lead">Chất lượng cao - Giá cả hợp lý - Giao hàng nhanh chóng</p>
    </div>
    <div class="position-absolute bottom-0 start-0 w-100" style="height: 100px; background: linear-gradient(to top, white, transparent);"></div>
  </div>

  <div class="container py-4">
    <!-- Filter & Stats Bar -->
    <div class="row mb-4">
      <div class="col-lg-8">
        <div class="d-flex gap-2 flex-wrap">
          <button class="btn btn-outline-primary active">
            <i class="bi bi-grid-fill me-2"></i>Tất cả
          </button>
          <button class="btn btn-outline-primary">
            <i class="bi bi-star-fill me-2"></i>Bán chạy
          </button>
          <button class="btn btn-outline-primary">
            <i class="bi bi-fire me-2"></i>Khuyến mãi
          </button>
          <button class="btn btn-outline-primary">
            <i class="bi bi-lightning-fill me-2"></i>Mới nhất
          </button>
        </div>
      </div>

    </div>

    <!-- Stats Cards -->
    <div class="row g-3 mb-5">
      <div class="col-6 col-md-3">
        <div class="card border-0 bg-gradient text-white h-100" style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);">
          <div class="card-body text-center">
            <i class="bi bi-box-seam display-4 mb-2"></i>
            <h3 class="mb-0"><?= count($products) ?></h3>
            <small>Sản phẩm</small>
          </div>
        </div>
      </div>
      <div class="col-6 col-md-3">
        <div class="card border-0 bg-gradient text-white h-100" style="background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);">
          <div class="card-body text-center">
            <i class="bi bi-truck display-4 mb-2"></i>
            <h3 class="mb-0">24h</h3>
            <small>Giao hàng</small>
          </div>
        </div>
      </div>
      <div class="col-6 col-md-3">
        <div class="card border-0 bg-gradient text-white h-100" style="background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);">
          <div class="card-body text-center">
            <i class="bi bi-shield-check display-4 mb-2"></i>
            <h3 class="mb-0">100%</h3>
            <small>Bảo hành</small>
          </div>
        </div>
      </div>
      <div class="col-6 col-md-3">
        <div class="card border-0 bg-gradient text-white h-100" style="background: linear-gradient(135deg, #fa709a 0%, #fee140 100%);">
          <div class="card-body text-center">
            <i class="bi bi-star-fill display-4 mb-2"></i>
            <h3 class="mb-0">5.0</h3>
            <small>Đánh giá</small>
          </div>
        </div>
      </div>
    </div>

    <!-- Products Grid -->
    <div class="row mb-3">
      <div class="col-12">
        <div class="d-flex justify-content-between align-items-center">
          <h2 class="fw-bold mb-0">
            <i class="bi bi-bag-fill text-primary me-2"></i>Sản Phẩm Nổi Bật
          </h2>
          <form action="<?= BASE_URL ?>" method="get" class="d-flex gap-2">
            <div class="input-group">
              <span class="input-group-text bg-white">
                <i class="bi bi-search"></i>
              </span>
              <input type="text" class="form-control border-start-0" placeholder="Tìm kiếm sản phẩm..." name="keyword">
            </div>
            <div class="input-group">
              <span class="input-group-text bg-white">
                <i class="bi bi-filter"></i>
              </span>
              <select name="category_id" id="category_id" class="form-select">
                <option value="">Tất cả</option>
                <?php foreach ($categories as $category): ?>
                  <option value="<?= $category['id'] ?>"><?= $category['name'] ?></option>
                <?php endforeach; ?>
              </select>
            </div>
            <button type="submit" class="btn btn-primary btn-sm w-50">Tìm kiếm</button>
          </form>
          <span class="badge bg-primary-subtle text-primary px-3 py-2">
            <?= count($products) ?> sản phẩm
          </span>
        </div>
        <hr class="mt-3 mb-4">
      </div>
    </div>

    <div class="row g-4">
      <?php foreach ($products as $index => $product): ?>
        <div class="col-xl-3 col-lg-4 col-md-6">
          <div class="card h-100 shadow-sm border-0 hover-card position-relative">
            <!-- Badge -->
            <?php if ($index % 3 == 0): ?>
              <span class="position-absolute top-0 start-0 m-3 badge bg-danger z-1">
                <i class="bi bi-fire me-1"></i>HOT
              </span>
            <?php elseif ($index % 3 == 1): ?>
              <span class="position-absolute top-0 start-0 m-3 badge bg-success z-1">
                <i class="bi bi-star-fill me-1"></i>NEW
              </span>
            <?php endif; ?>

            <!-- Quick View Button -->
            <div class="position-absolute top-0 end-0 m-3 z-1">
              <button class="btn btn-light btn-sm rounded-circle shadow-sm" data-bs-toggle="tooltip" title="Yêu thích">
                <i class="bi bi-heart"></i>
              </button>
            </div>

            <!-- Image -->
            <div class="position-relative overflow-hidden" style="height: 280px;">
              <img
                src="<?= $product['image'] ?>"
                alt="<?= $product['name'] ?>"
                class="card-img-top w-100 h-100 object-fit-cover">
              <div class="overlay position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center justify-content-center">
                <a
                  href="<?= BASE_URL ?>?action=product-detail&id=<?= $product['id'] ?>"
                  class="btn btn-light btn-lg rounded-pill px-4 opacity-0">
                  <i class="bi bi-eye me-2"></i>Xem ngay
                </a>
              </div>
            </div>

            <!-- Content -->
            <div class="card-body d-flex flex-column">
              <h5 class="card-title fw-bold mb-2 text-truncate" data-bs-toggle="tooltip" title="<?= $product['name'] ?>">
                <?= $product['name'] ?>
              </h5>

              <p class="card-text text-muted small mb-3" style="height: 40px; overflow: hidden; text-overflow: ellipsis; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical;">
                <?= $product['descriptions'] ?>
              </p>

              <!-- Rating -->
              <div class="mb-3">
                <i class="bi bi-star-fill text-warning"></i>
                <i class="bi bi-star-fill text-warning"></i>
                <i class="bi bi-star-fill text-warning"></i>
                <i class="bi bi-star-fill text-warning"></i>
                <i class="bi bi-star-half text-warning"></i>
                <span class="text-muted small ms-2">(4.5)</span>
              </div>

              <!-- Price & Button -->
              <div class="mt-auto">
                <div class="d-flex justify-content-between align-items-center mb-3">
                  <div>
                    <p class="fs-5 fw-bold text-danger mb-0">
                      <?= number_format($product['price'], 0, ',', '.') ?>₫
                    </p>
                    <small class="text-muted text-decoration-line-through">
                      <?= number_format($product['price'] * 1.2, 0, ',', '.') ?>₫
                    </small>
                  </div>
                  <span class="badge bg-danger-subtle text-danger">-20%</span>
                </div>

                <div class="d-grid gap-2">
                  <a
                    href="<?= BASE_URL ?>?action=product-detail&id=<?= $product['id'] ?>"
                    class="btn btn-primary">
                    <i class="bi bi-cart-plus me-2"></i>Thêm giỏ hàng
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>

    <!-- Pagination -->
    <div class="row mt-5">
      <div class="col-12">
        <nav>
          <ul class="pagination justify-content-center">
            <li class="page-item disabled">
              <span class="page-link"><i class="bi bi-chevron-left"></i></span>
            </li>
            <li class="page-item active"><a class="page-link" href="#">1</a></li>
            <li class="page-item"><a class="page-link" href="#">2</a></li>
            <li class="page-item"><a class="page-link" href="#">3</a></li>
            <li class="page-item">
              <a class="page-link" href="#"><i class="bi bi-chevron-right"></i></a>
            </li>
          </ul>
        </nav>
      </div>
    </div>

    <!-- Features Section -->
    <div class="row mt-5 pt-5 border-top">
      <div class="col-md-3 text-center mb-4">
        <div class="feature-icon mb-3">
          <i class="bi bi-truck display-4 text-primary"></i>
        </div>
        <h5 class="fw-bold">Miễn phí vận chuyển</h5>
        <p class="text-muted small">Cho đơn hàng trên 500.000₫</p>
      </div>
      <div class="col-md-3 text-center mb-4">
        <div class="feature-icon mb-3">
          <i class="bi bi-arrow-repeat display-4 text-success"></i>
        </div>
        <h5 class="fw-bold">Đổi trả 30 ngày</h5>
        <p class="text-muted small">Hoàn tiền 100% nếu không hài lòng</p>
      </div>
      <div class="col-md-3 text-center mb-4">
        <div class="feature-icon mb-3">
          <i class="bi bi-shield-check display-4 text-info"></i>
        </div>
        <h5 class="fw-bold">Thanh toán an toàn</h5>
        <p class="text-muted small">Bảo mật thông tin 100%</p>
      </div>
      <div class="col-md-3 text-center mb-4">
        <div class="feature-icon mb-3">
          <i class="bi bi-headset display-4 text-warning"></i>
        </div>
        <h5 class="fw-bold">Hỗ trợ 24/7</h5>
        <p class="text-muted small">Tư vấn nhiệt tình, chuyên nghiệp</p>
      </div>
    </div>
  </div>
</div>

<style>
  .hover-card {
    transition: all 0.3s ease;
  }

  .hover-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2) !important;
  }

  .hover-card .overlay {
    background: rgba(0, 0, 0, 0.5);
    opacity: 0;
    transition: all 0.3s ease;
  }

  .hover-card:hover .overlay {
    opacity: 1;
  }

  .hover-card:hover .overlay .btn {
    opacity: 1 !important;
  }

  .object-fit-cover {
    object-fit: cover;
    transition: transform 0.3s ease;
  }

  .hover-card:hover .object-fit-cover {
    transform: scale(1.1);
  }

  .hero-banner {
    overflow: hidden;
  }

  .hero-banner::before {
    content: '';
    position: absolute;
    width: 200%;
    height: 200%;
    background: radial-gradient(circle, rgba(255, 255, 255, 0.1) 1px, transparent 1px);
    background-size: 50px 50px;
    animation: moveBackground 20s linear infinite;
  }

  @keyframes moveBackground {
    0% {
      transform: translate(0, 0);
    }

    100% {
      transform: translate(50px, 50px);
    }
  }

  .btn-outline-primary.active {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    border: none;
  }

  .feature-icon {
    transition: transform 0.3s ease;
  }

  .feature-icon:hover {
    transform: scale(1.1) rotate(5deg);
  }
</style>

<script>
  // Initialize Bootstrap tooltips
  document.addEventListener('DOMContentLoaded', function() {
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
      return new bootstrap.Tooltip(tooltipTriggerEl);
    });
  });
</script>