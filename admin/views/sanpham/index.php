<table class="table table-striped">
  <thead>
    <tr>
      <th>Mã Sản Phẩm</th>
      <th>Tên Sản Phẩm</th>
      <th>Danh Mục</th>
      <th>Mô Tả</th>
      <th>Chi Tiết</th>
      <th>Ảnh</th>
      <th>Số Lượng</th> 
      <th>Giá Thành</th>
      <th>Nhà Sản Xuất</th>
      <th>Thời Gian Đặt Hàng</th>
      <th>Thao Tác</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($sanpham as $sp) { ?>  
      <tr>
        <td><a href="index.php?controller=sanpham&action=detail&id=<?php echo $sp->id ?>"><?php echo $sp->masp ?></a></td>
        <td><?php echo strlen($sp->tensp) > 100 ? substr($sp->tensp, 0, 100) . '...' : $sp->tensp; ?></td>
        <td><?php echo $sp->id_danhmucsp ?></td>
        <td><?php echo $sp->mota_sp ?></td>
        <td><?php echo strlen($sp->chitiet_sp) > 300 ? substr($sp->chitiet_sp, 0, 300) . '...' : $sp->chitiet_sp; ?></td>
        <td><img src="<?php echo $sp->anh_sp; ?> " width="100" height="100"></td>
        <td><?php echo $sp->soluong ?></td>
        <td><?php echo $sp->giathanh ?></td>
        <td><?php echo $sp->nhasx_sp ?></td>
        <td><?php echo $sp->thoigiandathang ?></td>
        <td>
          <a href="index.php?controller=sanpham&action=edit&masp=<?php echo $sp->masp ?>">Sửa</a> |
          <a href="index.php?controller=sanpham&action=del&masp=<?php echo $sp->masp ?>" onclick="return confirm('Bạn chắc chắn muốn xóa?')">Xóa</a>
        </td>
      </tr>
    <?php } ?>
  </tbody>
</table>
<a href="index.php?controller=sanpham&action=add">Thêm mới sản phẩm</a>