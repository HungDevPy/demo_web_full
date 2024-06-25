<?php
require_once('database/config.php');
require_once('database/dbhelper.php');
?>
<table class="table table-striped">
    <thead>
        <tr style="font-weight: 500;text-align: center;">
            <td width="50px">STT</td>
            <td width="200px">Tên User</td>
            <td>Tên Sản Phẩm/<br>Số lượng</td>
            <td>Tổng tiền</td>
            <td width="250px">Địa chỉ</td>
            <td>Số điện thoại</td>
            <td>Trạng thái</td>
            <!-- <td width="50px">Lưu</td> -->
        </tr>
    </thead>
    <tbody>
    <?php
        try {

            if (isset($_GET['page'])) {
                $page = $_GET['page'];
            } else {
                $page = 1;
            }
            $limit = 10;
            $start = ($page - 1) * $limit;

            $sql = "SELECT * FROM donhang, khachhang, sanpham
            WHERE donhang.madathang = khachhang.makh AND donhang.masp = sanpham.masp
            LIMIT $start, $limit";
            $order_details_List = executeResult($sql);
            $total = 0;
            $count = 0;
            // if (is_array($order_details_List) || is_object($order_details_List)){
            foreach ($order_details_List as $item) {
                 $tensp=strlen($item['tensp']) > 30 ? substr($item['tensp'], 0, 30) . '...' : $item['tensp'];
                echo '
                
                                        <tr style="text-align: center;">
                                            <td width="50px">' . (++$count) . '</td>
                                            <td style="text-align:center">' . $item['tenkh'] . '</td>
                                            <td>' . $tensp . '<br>(<strong>' . $item['tongsp'] . '</strong>)</td>
                                            <td class="b-500 red">' . number_format($item['tongtien'], 0, ',', '.') . '<span> VNĐ</span></td>
                                            <td width="100px">' . $item['diachi'] . '</td>
                                            <td width="100px">' . $item['sodt'] . '</td>
                                            <td width="100px" class="green b-500">' . $item['tinhtrangdonhang'] . '</td>
                                            <td width="100px">
                                                <a href="index.php?controller=donhang&action=edit&madonhang=' . $item['madonhang'] . '" class="btn btn-success">Edit</a>
                                            </td>
                                        </tr>
                                    ';
            }
        } catch (Exception $e) {
            die("Lỗi thực thi sql: " . $e->getMessage());
        }
        ?>

    </tbody>
</table>