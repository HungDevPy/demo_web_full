<?php
require_once('controllers/base_controller.php');
require_once('models/nhomsp.php');
require_once('models/db.php');

class NhomspController extends BaseController
{
  function __construct()
  {
    $this->folder = 'nhomsp';//Tên thư mục của module home trong view
  
  }
  public function index()
  {
    $nhomsp = Nhomsanpham::get_all();
    $data = array('nhomsp' => $nhomsp);
    $this->render('index', $data);
  }

  public function detail()
  {
    $nhomsp = Nhomsanpham::get_bymadanhmuc($_GET['madanhmuc']);
    $data = array('nhomsp' => $nhomsp);
    $this->render('detail', $data);
  }
  public function add()
  {
    $this->render('add');
  }
  public function add_submit()
  {
    $loaisanpham=isset($_POST['loaisanpham']) ? $_POST['loaisanpham'] : '';
    $tendanhmuc    = isset($_POST['tendanhmuc']) ? $_POST['tendanhmuc'] : '';
    $nhomsp=new Nhomsanpham('',$tendanhmuc,$loaisanpham);
    $results = $nhomsp->add_bymadanhmuc();

      if ($results) {
        echo "<script>  </script>";
        
      } else {
        echo "<script> alert('Lỗi thêm dữ liệu!') </script>";
      }

      $this->index();
  }
  public function edit()
  {
    $nhomsp = Nhomsanpham::get_bymadanhmuc($_GET['madanhmuc']);
    $data = array('nhomsp' => $nhomsp);
    $this->render('edit', $data);
  }

  public function edit_submit()
  {

    $madanhmuc = isset($_POST['madanhmuc']) ? $_POST['madanhmuc'] : '';
    $tendanhmuc    = isset($_POST['tendanhmuc']) ? $_POST['tendanhmuc'] : '';
    $loaisanpham=isset($_POST['loaisanpham']) ? $_POST['loaisanpham'] : '';
    if (($madanhmuc != '') && ($tendanhmuc != '')) {
      $nhomsp = new Nhomsanpham($madanhmuc, $tendanhmuc,$loaisanpham);
      $results = $nhomsp->update();
      if ($results) {
        echo "<script> alert('Sửa thành công.') </script>";
      } else {
        echo "<script> alert('Lỗi sửa dữ liệu!') </script>";
      }

      //Trở về trang chủ  
      $this->index();
    } else {
      //Hiển thị thông báo  
      echo "<script> alert('Lỗi: !') </script>";

      //Trở về trang sửa  

      echo "<script> history.go(-1) </script>";
    }
  }
  public function del()
  {
    $nhomsp = Nhomsanpham::delete($_GET['madanhmuc']); //Gọi phương thức   delete() của model Taikhoan.  

    //Trở về trang chủ  
    $this->index();
  }
}
