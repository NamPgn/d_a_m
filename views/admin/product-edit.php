<form action="<?= BASE_URL ?>?action=admin-products-edit&id=<?= $data['id'] ?>" method="post" enctype="multipart/form-data">
  <div class="form-group">
    <label for="name">Name</label>
    <input type="text" name="name" class="form-control" required value="<?= $data['name'] ?>">
  </div>
  <div class="form-group">
    <label for="price">Price</label>
    <input type="number" name="price" class="form-control" required value="<?= $data['price'] ?>">
  </div>
  <div class="form-group">
    <label for="category_id">Category</label>
    <select name="category_id" class="form-control" required>
      <?php foreach ($categories as $category): ?>
        <?php if ($category['id'] == $data['category_id']): ?>
          <option value="<?= $category['id'] ?>" selected><?= $category['name'] ?></option>
        <?php else: ?>
          <option value="<?= $category['id'] ?>"><?= $category['name'] ?></option>
        <?php endif; ?>
      <?php endforeach; ?>
    </select>
  </div>
  <div class="form-group">
    <label for="quantity">Quantity</label>
    <input type="number" name="quantity" class="form-control" required value="<?= $data['quantity'] ?>">
  </div>
  <div class="form-group">  
    <label for="descriptions">Descriptions</label>
    <textarea name="descriptions" class="form-control" ><?= $data['descriptions'] ?></textarea>
  </div>
  <div class="form-group">
    <label for="image">Image</label>
    <input type="file" name="image" class="form-control" accept="image/*">
  </div>
  <div class="form-group">
    <label for="image">Image</label>
    <img src="<?= BASE_URL . $data['image'] ?>" width="100">
  </div>
  <button type="submit" class="btn btn-primary mt-3">Sửa</button>
</form>