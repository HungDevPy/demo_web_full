<?php
require_once('controllers/base_controller.php');
// require_once('models/shopgrid.php');
require_once('models/db.php');

class ThanhtoanController extends BaseController
{
  function __construct()
  {
    $this->folder = 'thanhtoan'; //Tên thư mục của module home trong view
  }

  public function index()
  {
    $data = array();
    $this->render('vnpay_pay', $data);
  }
  public function get_product()
  {
    $data = array();
    $this->render('sanpham', $data);
  }
  public function details()
  {
    $data = array();
    $this->render('thongtin', $data);
  }
}
