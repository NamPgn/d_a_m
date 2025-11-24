<div class="container mt-4">
  <table class="table table-bordered align-middle">
    <thead class="table-dark">
      <tr>
        <th>Hình</th>
        <th>Tên sản phẩm</th>
        <th>Số lượng</th>
        <th>Đơn giá</th>
        <th>Thành tiền</th>
        <th>Cập nhật</th>
        <th>Xóa</th>
      </tr>
    </thead>

    <tbody>
      <?php foreach ($cartDetailData as $item): ?>
        <tr>
          <td><img src="<?= BASE_URL . $item['image'] ?>" width="80" height="80"></td>

          <td><?= $item['name'] ?></td>

          <td><?= $item['quantity'] ?></td>

          <td><?= number_format($item['price'], 0, ',', '.') ?> VNĐ</td>

          <td><?= number_format($item['price'] * $item['quantity'], 0, ',', '.') ?> VNĐ</td>
          <td>
            <input type="number" class="form-control" value="<?= $item['quantity'] ?>" min="1" max="<?= $item['quantity'] ?>">
          </td>
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

  <a href="<?= BASE_URL ?>?action=checkout" class="btn btn-primary">Thanh toán</a>
</div>
