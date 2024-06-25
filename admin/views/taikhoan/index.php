<table class="table table-striped">
  <thead>
    <tr>
      <th>Tên đăng nhập</th>
      <th>Mật khẩu</th>
      <th>Email</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($taikhoan as $ac) { ?>
      <tr>
         
        <td><a href="index.php?controller=taikhoan&action=detail&id=<?php echo $ac->tendangnhap ?>"><?php echo $ac->tendangnhap ?></a></td>
        <td><?php echo $ac->matkhau ?></td>
        <td><?php echo $ac->email ?></td>
        <td><a href="index.php?controller=taikhoan&action=edit&id=<?php echo $ac->tendangnhap ?>">Sửa |</a>
        <a href="index.php?controller=taikhoan&action=del&id=<?php echo $ac->tendangnhap ?>" onclick="return confirm('Bạn chắc chắn muốn xóa?')">Xóa</a></td> 
      </tr>
    <?php } ?>
  </tbody>
</table>
<a href="index.php?controller=taikhoan&action=add">Thêm mới tài khoản</a>