<form action="<?= BASE_URL ?>?action=admin-users-add" method="post" enctype="multipart/form-data">
  <div class="form-group">
    <label for="name">Name</label>
    <input type="text" name="name" class="form-control" required>
  </div>
  <div class="form-group">
    <label for="email">Email</label>
    <input type="email" name="email" class="form-control" required>
  </div>
  <div class="form-group">
    <label for="password">Password</label>
    <input type="password" name="password" class="form-control" required>
  </div>
  <div class="form-group">
    <label for="phone">Phone</label>
    <input type="number" name="phone" class="form-control" required>
  </div>
  <div class="form-group">
    <label for="address">Address</label>
    <input type="text" name="address" class="form-control" required>
  </div>
  <button type="submit" class="btn btn-primary mt-3">Thêm</button>
</form>