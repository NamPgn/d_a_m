<div class="container mt-4">
  <table class="table table-bordered align-middle">
    <thead class="table-dark">
      <tr>
        <th>Hình</th>
        <th>Tên sản phẩm</th>
        <th>Số lượng</th>
        <th>Đơn giá</th>
        <th>Thành tiền</th>
        <th>Xóa</th>
      </tr>
    </thead>

    <tbody>
      <?php foreach ($cartDetailData as $item): ?>
        <tr>
          <td><img src="<?= BASE_URL . $item['image'] ?>" width="80" height="80" class="object-fit-cover"></td>

          <td><?= $item['name'] ?></td>

          <td><?= $item['quantity'] ?></td>

          <td><?= number_format($item['price'], 0, ',', '.') ?> VNĐ</td>

          <td><?= number_format($item['price'] * $item['quantity'], 0, ',', '.') ?> VNĐ</td>
          <td>
            <a 
              href="<?= BASE_URL ?>?action=cart-delete&product_id=<?= $item['product_id'] ?>&cart_id=<?= $item['cart_id'] ?>" 
              class="btn btn-danger btn-sm">
              <i class="fa fa-trash"></i>
            </a>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>

  <?php if (!empty($cartDetailData)): ?>
    <div class="d-flex justify-content-between align-items-center mt-3">
      <h4>
        Tổng cộng: 
        <span class="text-danger">
          <?php 
            $total = 0;
            foreach ($cartDetailData as $item) {
              $total += $item['price'] * $item['quantity'];
            }
            echo number_format($total, 0, ',', '.') . ' VNĐ';
          ?>
        </span>
      </h4>
      <a href="<?= BASE_URL ?>?action=checkout" class="btn btn-success btn-lg">
        <i class="fa fa-credit-card"></i> Thanh toán
      </a>
    </div>
  <?php else: ?>
    <div class="alert alert-info text-center">
      <i class="fa fa-shopping-cart"></i> Giỏ hàng của bạn đang trống
    </div>
    <a href="<?= BASE_URL ?>" class="btn btn-primary">
      <i class="fa fa-arrow-left"></i> Tiếp tục mua sắm
    </a>
  <?php endif; ?>
</div>
