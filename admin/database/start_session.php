<?php
// init.php - File này bạn gọi một lần ở đầu mỗi trang controller hoặc view

// Kiểm tra xem session đã được khởi tạo hay chưa
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>