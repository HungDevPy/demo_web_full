<?php
require_once('database/config.php');
require_once('database/dbhelper.php');
?>
<div class="container">
    <form action="index.php?controller=login&action=resetpass" method="POST">
        <h1 style="text-align: center;">Đổi mật khẩu</h1>
        <div class="form-group">
            <label for="">Mật khẩu cũ:</label>
            <input type="password" name="oldpass" class="form-control" placeholder="Mật khẩu cũ">
        </div>
        <div class="form-group">
            <label for="">Mật khẩu mới:</label>
            <input type="password" name="newpass" class="form-control" placeholder="Mật khẩu mới">
        </div>
        <div class="form-group">
            <label for="">Nhập lại mật khẩu:</label>
            <input type="password" name="repass" class="form-control" placeholder="Mật khẩu">
        </div>
        <div style="padding-top: 5px;" class="form-group">
            <input type="submit" name="submit" class="btn btn-primary" value="Xác nhận">
        </div>
    </form>
</div>