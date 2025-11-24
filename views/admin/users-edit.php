<form action="<?= BASE_URL ?>?action=admin-users-edit" method="post" enctype="multipart/form-data">
  <input type="hidden" name="id" value="<?= $data['id'] ?>">
  <div class="form-group">
    <label for="name">Name</label>
    <input type="text" name="name" class="form-control" required value="<?= $data['name'] ?>">
  </div>
  <div class="form-group">
    <label for="email">Email</label>
    <input type="email" name="email" class="form-control" required value="<?= $data['email'] ?>">
  </div>
  <div class="form-group">
    <label for="password">Password</label>
    <input type="password" name="password" class="form-control" required value="<?= $data['password'] ?>">
  </div>
  <div class="form-group">
    <label for="phone">Phone</label>
    <input type="number" name="phone" class="form-control" required value="<?= $data['phone'] ?>">
  </div>
  <div class="form-group">  
    <label for="address">Address</label>
    <input type="text" name="address" class="form-control" required value="<?= $data['address'] ?>">
  </div>
  <button type="submit" class="btn btn-primary mt-3">Sửa</button>
</form>