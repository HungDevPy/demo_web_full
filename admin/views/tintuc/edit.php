<h4 class="text-primary font-weight-bold">Chỉnh Sửa Tin Tức</h4>
<form action="index.php?controller=tintuc&action=edit_submit" method="post" class="was-validated" enctype="multipart/form-data">
    <div class="form-group">
        <label for="id">ID:</label>
        <input type="text" class="form-control" id="id" name="id" value="<?php echo $tintuc->id ?>" readonly>
    </div>
    <div class="form-group">
        <label for="tieu_de">Tiêu Đề:</label>
        <input type="text" class="form-control" id="tieuDe" name="tieuDe" value="<?php echo $tintuc->tieuDe ?>" required>
        <div class="invalid-feedback">Tiêu đề không được để trống.</div>
    </div>
    <div class="form-group">
        <label for="noi_dung">Nội Dung:</label>
        <textarea class="form-control" id="noiDung" name="noiDung" rows="4" required><?php echo $tintuc->noiDung ?></textarea>
        <div class="invalid-feedback">Nội dung không được để trống.</div>
    </div>
    <div class="form-group">
        <label for="anh">Ảnh:</label>
        <input type="file" class="form-control" id="anh" name="anh" accept="image/*">
        <div class="invalid-feedback">Vui lòng chọn một tệp ảnh hợp lệ.</div>
    </div>
    <button type="submit" class="btn btn-primary">Lưu</button>
</form>

