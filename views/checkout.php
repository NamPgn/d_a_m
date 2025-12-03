<div class="container mt-4">
  <div class="row">
    <!-- Thông tin đơn hàng -->
    <div class="col-md-7">
      <div class="card mb-4">
        <div class="card-header bg-primary text-white">
          <h5 class="mb-0"><i class="fa fa-shopping-bag"></i> Sản phẩm đã chọn</h5>
        </div>
        <div class="card-body">
          <table class="table table-borderless">
            <thead>
              <tr>
                <th>Sản phẩm</th>
                <th>Số lượng</th>
                <th>Đơn giá</th>
                <th>Thành tiền</th>
              </tr>
            </thead>
            <tbody>
              <?php 
              $total = 0;
              foreach ($cartDetailData as $item): 
                $subtotal = $item['price'] * $item['quantity'];
                $total += $subtotal;
              ?>
                <tr>
                  <td>
                    <div class="d-flex align-items-center">
                      <img src="<?= BASE_URL . $item['image'] ?>" width="60" height="60" class="me-3 rounded object-fit-cover">
                      <span><?= $item['name'] ?></span>
                    </div>
                  </td>
                  <td><?= $item['quantity'] ?></td>
                  <td><?= number_format($item['price'], 0, ',', '.') ?> VNĐ</td>
                  <td><strong><?= number_format($subtotal, 0, ',', '.') ?> VNĐ</strong></td>
                </tr>
              <?php endforeach; ?>
            </tbody>
            <tfoot>
              <tr>
                <td colspan="3" class="text-end"><h5>Tổng cộng:</h5></td>
                <td><h5 class="text-danger"><?= number_format($total, 0, ',', '.') ?> VNĐ</h5></td>
              </tr>
            </tfoot>
          </table>
        </div>
      </div>
    </div>

    <!-- Form thông tin người nhận -->
    <div class="col-md-5">
      <div class="card">
        <div class="card-header bg-success text-white">
          <h5 class="mb-0"><i class="fa fa-user"></i> Thông tin người nhận</h5>
        </div>
        <div class="card-body">
          <form action="<?= BASE_URL ?>?action=checkout" method="post">
            <div class="mb-3">
              <label class="form-label">Họ và tên <span class="text-danger">*</span></label>
              <input 
                type="text" 
                class="form-control" 
                name="customer_name" 
                value="<?= $user['name'] ?? '' ?>" 
                required>
            </div>

            <div class="mb-3">
              <label class="form-label">Số điện thoại <span class="text-danger">*</span></label>
              <input 
                type="text" 
                class="form-control" 
                name="customer_phone" 
                value="<?= $user['phone'] ?? '' ?>" 
                required>
            </div>

            <div class="mb-3">
              <label class="form-label">Địa chỉ giao hàng <span class="text-danger">*</span></label>
              <textarea 
                class="form-control" 
                name="customer_address" 
                rows="3" 
                required><?= $user['address'] ?? '' ?></textarea>
            </div>

            <div class="mb-3">
              <label class="form-label">Ghi chú (không bắt buộc)</label>
              <textarea 
                class="form-control" 
                name="note" 
                rows="2" 
                placeholder="Ghi chú thêm về đơn hàng..."></textarea>
            </div>

            <div class="alert alert-info">
              <small>
                <i class="fa fa-info-circle"></i> 
                Đơn hàng sẽ được giao trong vòng 2-3 ngày làm việc
              </small>
            </div>

            <div class="d-grid gap-2">
              <button type="submit" class="btn btn-success btn-lg">
                <i class="fa fa-check-circle"></i> Xác nhận đặt hàng
              </button>
              <a href="<?= BASE_URL ?>?action=cart-list" class="btn btn-secondary">
                <i class="fa fa-arrow-left"></i> Quay lại giỏ hàng
              </a>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<style>
  .card {
    border: none;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
  }
  
  .table td {
    vertical-align: middle;
  }
</style>

