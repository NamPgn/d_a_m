<form action="<?= BASE_URL ?>?action=register" method="post">
  <div class="form-group">
    <label for="exampleInputEmail1">Email</label>
    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email" name="email">
    <small id="emailHelp" class="form-text text-muted">Không chia sẻ email với ai khác.</small>
  </div>
  <br>
  <div class="form-group">
    <label for="exampleInputEmail1">Tên đăng nhập</label>
    <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Nhập tên đăng nhập" name="name">
  </div>
  <br>
  <div class="form-group">
    <label for="exampleInputEmail1">Số điện thoại</label>
    <input type="number" class="form-control" id="exampleInputEmail1" placeholder="Nhập số điện thoại" name="phone">
  </div>
  <br>
  <div class="form-group">
    <label for="exampleInputPassword1">Mật khẩu</label>
    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Nhập mật khẩu" name="password">
  </div>
  <br>
  <div class="form-group">
    <label for="exampleInputPassword1">Nhập lại mật khẩu</label>
    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Nhập lại mật khẩu" name="confirm_password">
  </div>
  <br>
  <div class="form-group">
    <label for="exampleInputPassword1">Địa chỉ</label>
    <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Nhập địa chỉ" name="address">
  </div>
  <br>
  <a href="<?= BASE_URL ?>?action=login" class="text-muted mt-3 ">Đã có tài khoản? Đăng nhập ngay</a>
  <br>
  <button type="submit" class="btn btn-primary mt-3">Đăng ký</button>
</form>