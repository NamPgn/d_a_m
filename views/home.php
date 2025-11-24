<div class="container py-5">
  <div class="row">
    <div class="col-md-12">
      <h5>Danh sách sản phẩm</h5>
    </div>
  </div>
  <div class="row g-4">
    <?php foreach ($products as $product): ?>
      <div class="col-lg-4 col-md-6">
        <div class="card h-100 shadow-sm border-0 hover-card">
          <div class="position-relative overflow-hidden" style="height: 250px;">
            <img 
              src="<?= $product['image'] ?>" 
              alt="<?= $product['name'] ?>" 
              class="card-img-top w-100 h-100 object-fit-cover"
            >
          </div>
          
          <div class="card-body d-flex flex-column">
            <h5 class="card-title fw-bold mb-2"><?= $product['name'] ?></h5>
            <p class="card-text text-muted small flex-grow-1"><?= $product['descriptions'] ?></p>
            
            <div class="mt-auto">
              <p class="fs-5 fw-bold text-danger mb-3">
                <?= number_format($product['price'], 0, ',', '.') ?> VNĐ
              </p>
              <a 
                href="<?= BASE_URL ?>?action=product-detail&id=<?= $product['id'] ?>" 
                class="btn btn-primary w-100"
              >
                <i class="bi bi-eye me-2"></i>Xem chi tiết
              </a>
            </div>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
</div>

<style>
  .hover-card {
    transition: all 0.3s ease;
  }
  
  .hover-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 10px 30px rgba(0,0,0,0.15) !important;
  }
  
  .object-fit-cover {
    object-fit: cover;
  }
</style>