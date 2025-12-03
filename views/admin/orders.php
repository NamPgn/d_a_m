<div class="row">
  <div class="col-md-3">
    <?php require_once 'sidebar.php'; ?>
  </div>
  <div class="col-md-9">
    <h3 class="mb-4">Quản lý đơn hàng</h3>
    
    <div class="card">
      <div class="card-body">
        <table class="table table-striped table-hover">
          <thead class="table-dark">
            <tr>
              <th>Mã ĐH</th>
              <th>Khách hàng</th>
              <th>SĐT</th>
              <th>Tổng tiền</th>
              <th>Trạng thái</th>
              <th>Ngày đặt</th>
            </tr>
          </thead>
          <tbody>
            <?php if (empty($data)): ?>
              <tr>
                <td colspan="7" class="text-center text-muted">Chưa có đơn hàng nào</td>
              </tr>
            <?php else: ?>
              <?php foreach ($data as $order): ?>
                <tr>
                  <td><strong>#<?= $order['id'] ?></strong></td>
                  <td><?= $order['customer_name'] ?></td>
                  <td><?= $order['customer_phone'] ?></td>
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
                  <td><?= date('d/m/Y H:i', strtotime($order['created_at'])) ?></td>
                </tr>
              <?php endforeach; ?>
            <?php endif; ?>
          </tbody>
        </table>
      </div>
    </div>

  </div>
</div>

