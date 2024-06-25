<?php
require_once('database/config.php');
require_once('database/dbhelper.php');

// Ensure that $order_id is set to avoid undefined variable error
$order_id = '';

// Check if 'id' is set in the URL parameters
if (isset($_GET['madonhang'])) {
    $order_id = $_GET['madonhang'];
}

// Retrieve order details based on the provided order_id
$sql = "SELECT * FROM donhang, khachhang, sanpham
        WHERE donhang.madathang = khachhang.makh AND donhang.masp = sanpham.masp
        AND donhang.madonhang = $order_id";

try {
    $order_details_List = executeResult($sql);
} catch (Exception $e) {
    die("Lỗi thực thi sql: " . $e->getMessage());
}
?>

<!-- HTML structure -->
<div class="panel-body">
    <form action="" method="POST">
        <table class="table table-bordered table-hover">
            <thead>
                <tr style="font-weight: 500;text-align: center;">
                    <td width="50px">STT</td>
                    <td width="200px">Tên User</td>
                    <td>Tên Sản Phẩm/<br>Số lượng</td>
                    <td>Tổng tiền</td>
                    <td width="250px">Địa chỉ</td>
                    <td>Số điện thoại</td>
                    <td>Trạng thái</td>
                    <td width="100px">Lưu</td>
                </tr>
            </thead>
            <tbody>
                <?php 
                $count = 0;
                foreach ($order_details_List as $item) : 
                    $tensp = strlen($item['tensp']) > 30 ? substr($item['tensp'], 0, 30) . '...' : $item['tensp'];
                    ?>
                    <tr style="text-align: center;">
                        <td width="50px"><?= ++$count ?></td>
                        <td style="text-align:center"><?= $item['tenkh'] ?></td>
                        <td><?= $tensp ?><br>(<strong><?= $item['tongsp'] ?></strong>)</td>
                        <td class="b-500 red"><?= number_format($item['tongtien'], 0, ',', '.') ?><span> VNĐ</span></td>
                        <td width="100px"><?= $item['diachi'] ?></td>
                        <td width="100px"><?= $item['sodt'] ?></td>
                        <td>
                            <select name="status[]" id="status<?= $item['madonhang'] ?>">
                                <option value="Đang xử lý" <?= ($item['tinhtrangdonhang'] == 'Đang xử lý') ? 'selected' : '' ?>>Đang xử lý</option>
                                <option value="Đang giao hàng" <?= ($item['tinhtrangdonhang'] == 'Đang giao') ? 'selected' : '' ?>>Đang giao hàng</option>
                                <option value="Đã giao hàng" <?= ($item['tinhtrangdonhang'] == 'Đã giao hàng') ? 'selected' : '' ?>>Đã giao hàng</option>
                                <option value="Đã hủy" <?= ($item['tinhtrangdonhang'] == 'Đã hủy') ? 'selected' : '' ?>>Đã hủy</option>
                            </select>
                        </td>
                        <td width="100px">
                            <button type="submit" name="save" class="btn btn-success">Lưu</button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <a href="index.php?controller=donhang" class="btn btn-warning">Back</a>
    </form>

    <?php
    // Check if the form is submitted
    if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['save'])) {
        // Assuming 'status' is an array because of the multiple selection
        $statuses = $_POST['status'];

        // Update each order detail with the selected status
        foreach ($statuses as $key => $status) {
            $order_id = $order_details_List[$key]['madonhang']; // Make sure to use the correct column name
            $sql = "UPDATE `donhang` SET `tinhtrangdonhang` = '$status' WHERE `madonhang` = $order_id";
            execute($sql);
        }

        echo '<script language="javascript">
            alert("Cập nhật thành công!");
            window.location = "index.php?controller=donhang";
        </script>';
    }
    ?>
</div>
