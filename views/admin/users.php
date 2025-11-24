<div class="row">
  <div class="col-md-3">
    <?php require_once 'sidebar.php'; ?>
  </div>
  <div class="col-md-9">
    <button class="btn btn-success"><a href="<?= BASE_URL ?>?action=admin-users-add">Thêm User</a></button>
    <table class="table">
      <thead>
        <tr>
          <th>ID</th>
          <th>Name</th>
          <th>Email</th>
          <th>Phone</th>
          <th>Address</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($data as $user): ?>
          <tr>
            <td><?= $user['id'] ?></td>
            <td><?= $user['name'] ?></td>
            <td><?= $user['email'] ?></td>
            <td><?= $user['phone'] ?></td>
            <td><?= $user['address'] ?></td>
            <td>  
              <a href="<?= BASE_URL ?>?action=admin-users-edit&id=<?= $user['id'] ?>" class="btn btn-warning">Sửa</a>
              <a href="<?= BASE_URL ?>?action=admin-users-delete&id=<?= $user['id'] ?>" class="btn btn-danger">Xóa</a>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>