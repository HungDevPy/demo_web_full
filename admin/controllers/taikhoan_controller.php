<?php
require_once('controllers/base_controller.php');
require_once('models/taikhoan.php');
require_once('database/dbhelper.php');

class TaikhoanController extends BaseController
{
  function __construct()
  {
    $this->folder = 'taikhoan'; //Tên thư mục của module home trong view
  }

  public function index()
  {
    $taikhoan = Taikhoan::get_all();
    $data = array('taikhoan' => $taikhoan);
    $this->render('index', $data);
  }

  public function detail()
  {
    $taikhoan = Taikhoan::get_byid($_GET['id']);
    $data = array('taikhoan' => $taikhoan);
    $this->render('detail', $data);
  }
  public function add()
  {
    $this->render('add');
  }
  public function add_submit()
  {
    $tendangnhap = isset($_POST['tendangnhap']) ? $_POST['tendangnhap'] : '';
    $matkhau    = isset($_POST['matkhau']) ? md5($_POST['matkhau']) : '';
    $email      = isset($_POST['email']) ? $_POST['email'] : '';

    if (($tendangnhap != '') && ($matkhau != '')) {
      $taikhoan = new Taikhoan($tendangnhap, $matkhau, $email);


      $results = $taikhoan->add_byid();

      if ($results) {
        echo "<script> alert('Thêm mới thành công.') </script>";
      } else {
        echo "<script> alert('Lỗi thêm dữ liệu!') </script>";
      }

      $this->index();
    } else {

      echo "<script> alert('Lỗi: Tên đăng nhập và mật khẩu không   được để trống!') </script>";
      $this->add();
    }
  }
  public function edit()
  {
    $taikhoan = Taikhoan::get_byid($_GET['id']);
    $data = array('taikhoan' => $taikhoan);
    $this->render('edit', $data);
  }

  public function edit_submit()
  {
    
    $tendangnhap = isset($_POST['tendangnhap']) ? $_POST['tendangnhap'] : '';
    $matkhau    = isset($_POST['matkhau']) ? md5($_POST['matkhau']) : '';
    $email      = isset($_POST['email']) ? $_POST['email'] : '';

    if (($tendangnhap != '') && ($matkhau != '')) {
      $taikhoan = new Taikhoan($tendangnhap, $matkhau, $email);


      $results = $taikhoan->update();
      if ($results) {
        echo "<script> alert('Sửa thành công.') </script>";
      } else {
        echo "<script> alert('Lỗi sửa dữ liệu!') </script>";
      }

      //Trở về trang chủ  
      $this->index();
    } else {
      //Hiển thị thông báo  
      echo "<script> alert('Lỗi: Tên đăng nhập và mật khẩu không được để trống!') </script>";

      //Trở về trang sửa  

      echo "<script> history.go(-1) </script>";
    }
  }
  public function del()
  {
    $taikhoan = Taikhoan::delete($_GET['id']); //Gọi phương thức   delete() của model Taikhoan.  

    //Trở về trang chủ  
    $this->index();
  }
}
