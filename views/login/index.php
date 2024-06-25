<?php
require_once('database/config.php');
require_once('database/dbhelper.php');
?>
<div class="container">
    <form action="index.php?controller=login&action=login" method="POST">
        <h1 style="text-align: center;">Đăng nhập hệ thống</h1>
        <div class="form-group">
            <label for="">Tài khoản:</label>
            <input type="text" name="username" class="form-control" placeholder="Tài khoản">
        </div>
        <div class="form-group">
            <label for="">Mật khẩu:</label>
            <input type="password" name="password" class="form-control" placeholder="Mật khẩu">
        </div>
        <a href="forget.php">Quên mật khẩu</a>
        <div style="padding-top: 5px;" class="form-group">
            <input type="submit" name="submit" class="btn btn-primary" value="Đăng nhập">
            <p style="padding-top: 1rem;">Bạn chưa có tài khoản? <a href="index.php?controller=login&action=register">Đăng ký</a></p>
        </div>
    </form>
</div>