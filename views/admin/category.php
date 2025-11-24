<div class="row">
  <div class="col-md-3">
    <?php require_once 'sidebar.php'; ?>
  </div>
  <div class="col-md-9">
    <button class="btn btn-success"><a href="<?= BASE_URL ?>?action=admin-category-add">Thêm Danh Muc</a></button>
    <table class="table">
      <thead>
        <tr>
          <th>ID</th>
          <th>Name</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($data as $category): ?>
          <tr>
            <td><?= $category['id'] ?></td>
            <td><?= $category['name'] ?></td>
            <td>
              <a href="<?= BASE_URL ?>?action=admin-category-edit&id=<?= $category['id'] ?>" class="btn btn-warning">Sửa</a>
              <a href="<?= BASE_URL ?>?action=admin-category-delete&id=<?= $category['id'] ?>" class="btn btn-danger">Xóa</a>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>

</div>