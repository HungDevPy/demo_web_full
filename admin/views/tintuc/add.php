<?php 
require_once('database/start_session.php');
?>
<h4 class="text-primary font-weight-bold">Thêm Tin Tức</h4>
<form action="index.php?controller=tintuc&action=add_submit" method="post" class="was-validated" enctype="multipart/form-data">
    <div class="form-group">
        <label for="tieuDe">Tiêu Đề:</label>
        <input type="text" class="form-control" id="tieuDe" name="tieuDe">
    </div>
    <div class="form-group">
        <label for="noiDung">Nội Dung:</label>
        <textarea class="form-control" id="noiDung" name="noiDung" rows="5" ></textarea>
    </div>
    <div class="form-group">
        <label for="anh">Ảnh:</label> 
        <input type="file" id="anh" name="anh" >
    </div>
    <button type="submit" class="btn btn-primary" name="add">Thêm</button>
</form>
