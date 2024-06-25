<?php
require_once('controllers/base_controller.php');

class CheckoutController extends BaseController
{
    function __construct()
    {
        $this->folder = 'checkout';
    }

    public function index()
    {
        $data = array();
        $this->render('index', $data);
    }

    public function error()
    {
        $this->render('error');
    }
    public function check()
    {
        $idList = [];
        foreach ($cart as $item) {
            $idList[] = $item['masp'];
        }
        if (count($idList) > 0) {
            $idList = implode(',', $idList); // chuyeern
            //[2, 5, 6] => 2,5,6

            $sql = "SELECT * FROM sanpham where masp in ($idList)";
            $cartList = executeResult($sql);
        } else {
            $cartList = [];
        }
        $status = 'Đang chuẩn bị';

        foreach ($cartList as $item) {
            $num = 0;
            foreach ($cart as $value) {
                if ($value['masp'] == $item['masp']) {
                    $num = $value['num'];
                    break;
                }
            }
            $sql = "INSERT into order_details(order_id, product_id,id_user, num, price,status) values ('$orderId', " . $item['id'] . ",'$userId','$num', " . $item['price'] . ",'$status')";
            execute($sql);
            echo '<script language="javascript">
                alert("Đặt hàng thành công!"); 
                window.location = "history.php";
            </script>';
        }
    }
}
