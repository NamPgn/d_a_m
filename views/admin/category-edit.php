<form action="<?= BASE_URL ?>?action=admin-category-edit&id=<?= $data['category']['id'] ?>" method="post">
  <div class="form-group">
    <label for="name">Name</label>
    <input type="text" name="name" class="form-control" required value="<?= $data['category']['name'] ?>">
  </div>
  <button type="submit" class="btn btn-primary mt-3">Sửa</button>
</form>