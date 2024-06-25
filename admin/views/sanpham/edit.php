<h4 class="text-primary font-weight-bold">Thêm Sản Phẩm</h4>
<form action="index.php?controller=sanpham&action=edit_submit" method="post" class="was-validated" enctype="multipart/form-data">
    <div class="form-group">
        <label for="masp">Ma:</label>
        <input type="text" class="form-control" id="masp" name="masp" value="<?php echo $sanpham->masp ?>" required>
    </div>
    <div class="form-group">
        <label for="tensanpham">Tên Sản Phẩm:</label>
        <input type="text" class="form-control" id="tensanpham" name="tensanpham" value="<?php echo $sanpham->tensp ?>" required>
    </div>
    <div class="form-group">
        <label for="nhomid">Loại Sản Phẩm:</label>
        <select class="form-control" id="iddanhmucsp" name="iddanhmucsp" required>
            <?php foreach ($nhomsp as $obj) { ?>
                <option value="<?php echo $obj->madanhmuc ?>"><?php echo $obj->tendanhmuc ?></option>
            <?php } ?>
        </select>
    </div>
    <div class="form-group">
        <label for="text">Mô Tả Sản Phẩm:</label>
        <input type="text" class="form-control" id="motasp" name="motasp" value="<?php echo $sanpham->mota_sp ?>" required>
    </div>
    <div class="form-group">
        <label for="text">Chi Tiết Sản Phẩm:</label>
        <input type="text" class="form-control" id="chitietsp" name="chitietsp" value="<?php echo $sanpham->chitiet_sp ?>" required>
    </div>
    <div class="form-group">
        <label for="anhsp">Ảnh:</label>
        <input type="file" id="anhsp" name="anhsp" required>
    </div>
    <div class="form-group">
        <label for="text">Số Lượng:</label>
        <input type="text" class="form-control" id="soluong" name="soluong" value="<?php echo $sanpham->soluong ?>" required>
    </div>
    <div class="form-group">
        <label for="text">Giá Thành:</label>
        <input type="text" class="form-control" id="giathanh" name="giathanh" value="<?php echo $sanpham->giathanh ?>" required>
    </div>
    <div class="form-group">
        <label for="nhasx">Nhà sản xuất:</label>
        <select class="form-control" id="nhasx" name="nhasx" required>
            <?php foreach ($doitac as $obj) { ?>
                <option value="<?php echo $obj->id_doitac ?>"><?php echo $obj->name_doitac ?></option>
            <?php } ?>
        </select>
    </div>
    <!-- <div class="form-group">
        <label for="content">Thời Gian Đặt Hâng:</label>
        <input type="text" class="form-control" id="content" name="content">
    </div> -->
    <button type="submit" class="btn btn-primary" name="edit">Sửa</button>
</form>