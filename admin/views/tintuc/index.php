<?php 
require_once('database/start_session.php');
?>
<table class="table table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Tiêu Đề</th>
            <th>Nội Dung</th>
            <th>Ảnh</th>
            <th>Thời Gian</th>
            <th>Thao Tác</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($tintuc as $tt) { ?>
            <tr>
                <td><?php echo $tt->id ?></td>
                <td><?php echo $tt->tieuDe ?></td>
                <td><?php echo $tt->noiDung ?></td>
                <td><img src="<?php echo $tt->anh ?>" width="100" height="100"></td>
                <td><?php echo $tt->thoiGian ?></td>
                <td>
                    <a href="index.php?controller=tintuc&action=edit&id=<?php echo $tt->id ?>">Sửa</a> |
                    <a href="index.php?controller=tintuc&action=del&id=<?php echo $tt->id ?>" onclick="return confirm('Bạn chắc chắn muốn xóa?')">Xóa</a>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>
<a href="index.php?controller=tintuc&action=add">Thêm mới tin tức</a>
