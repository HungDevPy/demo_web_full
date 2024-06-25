<table class="table table-striped">
  <thead>
    <tr>
      <th>Tên Đối Tác</th>
      <th>Email</th>
      <th>Phone</th>
      <th>Địa chỉ</th>
      <th>Website</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($doitac as $ac) { ?>
      <tr>
         
        <td><?php echo $ac->name_doitac ?></td>
        <td><?php echo $ac->email_doitac ?></td>
        <td><?php echo $ac->phone_doitac ?></td>
        <td><?php echo $ac->address_doitac ?></td>
        <td><?php echo $ac->website_doitac ?></td>
        <td><a href="index.php?controller=doitac&action=edit&id_doitac=<?php echo $ac->id_doitac ?>">Sửa |</a>
        <a href="index.php?controller=doitac&action=del&id_doitac=<?php echo $ac->id_doitac ?>" onclick="return confirm('Bạn chắc chắn muốn xóa?')">Xóa</a></td> 
      </tr>
    <?php } ?>
  </tbody>
</table>
<a href="index.php?controller=doitac&action=add">Thêm Đối Tác Mới</a>