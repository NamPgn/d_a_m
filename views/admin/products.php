<div class="row">
  <div class="col-md-3">
    <?php require_once 'sidebar.php'; ?>
  </div>
  <div class="col-md-9">
    <button class="btn btn-success"><a href="<?= BASE_URL ?>?action=admin-products-add">Thêm Sản Phẩm</a></button>
    <table class="table">
      <thead>
        <tr>
          <th>ID</th>
          <th>Name</th>
          <th>Price</th>
          <th>Quantity</th>
          <th>Category</th>
          <th>Image</th>
          <th>Description</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($data as $product): ?>
          <tr>
            <td><?= $product['id'] ?></td>
            <td><?= $product['name'] ?></td>
            <td><?= $product['price'] ?></td>
            <td><?= $product['quantity'] ?></td>
            <td> <?php foreach ($categories as $category): ?>
                <?php if ($category['id'] == $product['category_id']): ?>
                  <?= $category['name'] ?>
                <?php endif; ?>
              <?php endforeach; ?>
            </td>
            <td><img src="<?= BASE_URL . $product['image'] ?>" width="100"></td>
            <td><?= $product['descriptions'] ?></td>
            <td>
              <a href="<?= BASE_URL ?>?action=admin-products-edit&id=<?= $product['id'] ?>" class="btn btn-warning">Sửa</a>
              <a href="<?= BASE_URL ?>?action=admin-products-delete&id=<?= $product['id'] ?>" class="btn btn-danger">Xóa</a>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>