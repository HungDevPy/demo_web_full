<h4 class="text-primary font-weight-bold">Sửa thông tin tài khoản</h4>
<form action="index.php?controller=taikhoan&action=edit_submit" method="post" class="was-validated">
    <div class="form-group">
        <label>Tên đăng nhập:</label>
        <input type="text" class="form-control" id="ten" name="ten" value="<?php echo $taikhoan->tendangnhap ?>" disabled>
    </div>
    <div class="form-group">
        <label>Mật khẩu:</label>
        <input type="password" class="form-control" id="matkhau" name="matkhau" value="<?php echo $taikhoan->matkhau ?>" required>
    </div>
    <div class="form-group">
        <label>Email:</label>
        <input type="email" class="form-control" id="email" name="email" value="<?php echo $taikhoan->email ?>">
    </div>
    <input type="hidden" name="tendangnhap" value="<?php echo $taikhoan->tendangnhap ?>">
    <button type="submit" class="btn btn-primary" name="edit">Sửa</button>
</form>