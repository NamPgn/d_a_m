<div class="container mt-4">
  <h3 class="mb-4"><i class="fa fa-list"></i> Đơn hàng của tôi</h3>

  <?php if (empty($data)): ?>
    <div class="alert alert-info text-center">
      <i class="fa fa-info-circle"></i> Bạn chưa có đơn hàng nào
    </div>
    <div class="text-center">
      <a href="<?= BASE_URL ?>" class="btn btn-primary">
        <i class="fa fa-shopping-cart"></i> Tiếp tục mua sắm
      </a>
    </div>
  <?php else: ?>
    <div class="table-responsive">
      <table class="table table-bordered table-hover">
        <thead class="table-dark">
          <tr>
            <th>Mã đơn hàng</th>
            <th>Ngày đặt</th>
            <th>Tổng tiền</th>
            <th>Trạng thái</th>
            <th>Thao tác</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($data as $order): ?>
            <tr>
              <td><strong>#<?= $order['id'] ?></strong></td>
              <td><?= date('d/m/Y H:i', strtotime($order['created_at'])) ?></td>
              <td><strong class="text-danger"><?= number_format($order['total_amount'], 0, ',', '.') ?> VNĐ</strong></td>
              <td>
                <?php
                $statusClass = [
                  'pending' => 'warning',
                  'confirmed' => 'info',
                  'shipping' => 'primary',
                  'completed' => 'success',
                  'cancelled' => 'danger'
                ];
                $statusText = [
                  'pending' => 'Chờ xác nhận',
                  'confirmed' => 'Đã xác nhận',
                  'shipping' => 'Đang giao',
                  'completed' => 'Hoàn thành',
                  'cancelled' => 'Đã hủy'
                ];
                $status = $order['status'];
                $class = $statusClass[$status] ?? 'secondary';
                $text = $statusText[$status] ?? $status;
                ?>
                <span class="badge bg-<?= $class ?>"><?= $text ?></span>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  <?php endif; ?>
</div>

