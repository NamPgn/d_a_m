<form action="<?= BASE_URL ?>?action=login" method="post">
  <div class="form-group">
    <label for="exampleInputEmail1">Email</label>
    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email" name="email">
    <small id="emailHelp" class="form-text text-muted">Không chia sẻ email với ai khác.</small>
  </div>

  <br>
  <div class="form-group">
    <label for="exampleInputPassword1">Mật khẩu</label>
    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Nhập mật khẩu" name="password">
  </div>
  <a href="<?= BASE_URL ?>?action=register" class="text-decoration-none text-muted mt-3 ">Chưa có tài khoản? Đăng ký ngay</a>
  <br>
  <button type="submit" class="btn btn-primary mt-3">Đăng nhập</button>
</form>