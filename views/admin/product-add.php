<form action="<?= BASE_URL ?>?action=admin-products-add" method="post" enctype="multipart/form-data">
  <div class="form-group">
    <label for="name">Name</label>
    <input type="text" name="name" class="form-control" required>
  </div>
  <div class="form-group">
    <label for="price">Price</label>
    <input type="number" name="price" class="form-control" required>
  </div>
  <div class="form-group">
    <label for="category_id">Category</label>
    <select name="category_id" class="form-control" required>
      <?php foreach ($categories as $category): ?>
        <option value="<?= $category['id'] ?>"><?= $category['name'] ?></option>
      <?php endforeach; ?>
    </select>
  </div>
  <div class="form-group">
    <label for="quantity">Quantity</label>
    <input type="number" name="quantity" class="form-control" required>
  </div>
  <div class="form-group">  
    <label for="descriptions">Descriptions</label>
    <textarea name="descriptions" class="form-control" required></textarea>
  </div>
  <div class="form-group">
    <label for="image">Image</label>
    <input type="file" name="image" class="form-control" accept="image/*">
  </div>
  <button type="submit" class="btn btn-primary mt-3">Thêm</button>
</form>