<h4 class="text-primary font-weight-bold">Sửa thông tin Nhóm Sản Phẩm</h4>
<form action="index.php?controller=nhomsp&action=edit_submit" method="post" class="was-validated" onsubmit="return confirm('Bạn chắc chắn muốn sửa?')">
    <div class="form-group">
        <label>ID:</label>
        <input type="text" class="form-control" id="madanhmuc" name="madanhmuc" value="<?php echo $nhomsp->madanhmuc ?>" readonly>
    </div>
    <div class="form-group">
        <label>Tên Nhóm Sản Phẩm:</label>
        <input type="text" class="form-control" id="tendanhmuc" name="tendanhmuc" value="<?php echo $nhomsp->tendanhmuc ?>" required>
        <div class="invalid-feedback">Vui lòng nhập tên nhóm sản phẩm.</div>
    </div>
    <div class="form-group">
        <label>Loại Sản Phẩm:</label>
        <select class="form-control" id="loaisanpham" name="loaisanpham" required>
            <option value="Nam" <?php if ($nhomsp->loaisanpham == 'Nam') echo 'selected' ?>>Sản phẩm nam</option>
            <option value="Nữ" <?php if ($nhomsp->loaisanpham == 'Nữ') echo 'selected' ?>>Sản phẩm nữ</option>
            <option value="Trẻ em" <?php if ($nhomsp->loaisanpham == 'Trẻ em') echo 'selected' ?>>Sản phẩm trẻ em</option>
            <option value="Phụ kiện" <?php if ($nhomsp->loaisanpham == 'Phụ kiện') echo 'selected' ?>>Phụ kiện</option>
        </select>
        <div class="invalid-feedback">Vui lòng chọn loại sản phẩm.</div>
    </div>
    <button type="submit" class="btn btn-primary" name="edit">Sửa</button>
</form>