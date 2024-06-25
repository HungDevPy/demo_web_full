<h4 class="text-primary font-weight-bold">Thêm Nhóm Sản Phẩm</h4>
<form action="index.php?controller=nhomsp&action=add_submit" method="post" class="was-validated">
    <div class="form-group">
        <label for="tendanhmuc">Tên Sản Phẩm:</label>
        <input type="text" class="form-control" id="tendanhmuc" name="tendanhmuc" required>
        <div class="invalid-feedback">Vui lòng nhập Tên Sản Phẩm.</div>
    </div>
    <div class="form-group">
        <label for="loaisanpham">Loại Sản Phẩm:</label>
        <select class="form-control" id="loaisanpham" name="loaisanpham" required>
            <option value="Nam">Sản phẩm nam</option>
            <option value="Nữ">Sản phẩm nữ</option>
            <option value="Trẻ em">Sản phẩm trẻ em</option>
            <option value="Phụ kiện">Phụ kiện</option>
        </select>
        <div class="invalid-feedback">Vui lòng chọn Loại Sản Phẩm.</div>
    </div>  
    <button type="submit" class="btn btn-primary" name="add">Thêm</button>
</form>