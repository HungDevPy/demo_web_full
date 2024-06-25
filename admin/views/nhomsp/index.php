<table class="table table-striped">
  <thead>
    <tr>
      <th>Ma</th>
      <th>Ten Danh Muc</th>
      <th>Loai San Pham</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($nhomsp as $obj) { ?>
      <tr>
         
        <td><a href="index.php?controller=nhomsp&action=detail&madanhmuc=<?php echo $obj->madanhmuc ?>"><?php echo $obj->madanhmuc ?></a></td>
        <td><?php echo $obj->tendanhmuc ?></td>
        <td><?php echo $obj->loaisanpham?></td>
        <td><a href="index.php?controller=nhomsp&action=edit&madanhmuc=<?php echo $obj->madanhmuc ?>">Sửa |</a>
        <a href="index.php?controller=nhomsp&action=del&madanhmuc=<?php echo $obj->madanhmuc ?>" onclick="return confirm('Bạn chắc chắn muốn xóa?')">Xóa</a></td> 
      </tr>
    <?php } ?>
  </tbody>
</table>
<a href="index.php?controller=nhomsp&action=add">Thêm mới danh muc san pham</a>