<?php
// Kết nối đến cơ sở dữ liệu
require_once 'database/dbhelper.php';

// Nhận các tham số từ yêu cầu AJAX
$minPrice = $_POST['minPrice'];
$maxPrice = $_POST['maxPrice'];

// Chuẩn bị câu truy vấn SQL với sử dụng prepared statements để bảo mật
$sql = "SELECT * FROM sanpham WHERE giathanh >= ? AND giathanh <= ?";
$products = executeResult($sql, 'ii', [$minPrice, $maxPrice]);

// Kiểm tra xem có sản phẩm nào trả về không
if ($products) {
    // Xử lý kết quả và trả về dưới dạng HTML
    foreach ($products as $product) {
        echo '<div class="product-item">' . $product['tensp'] . '</div>';
    }
} else {
    // Trường hợp không có sản phẩm nào phù hợp với điều kiện
    echo '<div class="product-item">Không có sản phẩm nào phù hợp</div>';
}
?>
