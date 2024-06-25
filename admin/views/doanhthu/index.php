<?php
require_once('database/config.php');
require_once('database/dbhelper.php');
?>
<table class="table table-striped">
    <thead>
        <tr style="font-weight: 500;text-align: center;">
            <td width="50px">STT</td>
            <td width="200px">Tên sản phẩm</td>
            <td>Số lượng</td>
            <td>Tổng tiền</td>
            <td width="250px">Ngày cập nhật</td>
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

            $sql = "SELECT sanpham.tensp, sanpham.giathanh, doanhthu.* 
            FROM doanhthu 
            INNER JOIN sanpham ON sanpham.masp = doanhthu.masp 
            LIMIT $start, $limit";
            // echo $sql;
            $doanhthu = executeResult($sql);
            $total = 0;
            $count = 0;
            // if (is_array($order_details_List) || is_object($order_details_List)){
            foreach ($doanhthu as $item) {
                $tensp = strlen($item['tensp']) > 30 ? substr($item['tensp'], 0, 30) . '...' : $item['tensp'];
                $update_date = $item['update_day']; // Lấy giá trị của trường 'update_day'

                // Chuyển đổi định dạng ngày tháng năm
                $new_format_date = date("d-m-Y", strtotime($update_date));
                echo '
                
                                        <tr style="text-align: center;">
                                            <td width="50px">' . (++$count) . '</td>
                                            <td style="text-align:center">' . $item['tensp'] . '</td>
                                            <td>' . $item['soluong'] . '</td>
                                            <td class="b-500 red">' . number_format($item['tongtien'], 0, ',', '.') . '<span> VNĐ</span></td>
                                            <td width="100px">' . $new_format_date . '</td>
                                        </tr>
                                    ';
            }
        } catch (Exception $e) {
            die("Lỗi thực thi sql: " . $e->getMessage());
        }
        ?>

    </tbody>
</table>