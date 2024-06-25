<?php
require_once('controllers/base_controller.php');
require_once('models/sanpham.php');
require_once('models/db.php');
require_once('models/nhomsp.php');
require_once('models/doitac.php');

class SanphamController extends BaseController
{
  function __construct()
  {
    $this->folder = 'sanpham'; //Tên thư mục của module home trong view
  }

  public function index()
  {
    $sanpham = Sanpham::get_all();
    $data = array('sanpham' => $sanpham);
    $this->render('index', $data);
  }
  public function add()
  {
    $nhomsp = Nhomsanpham::get_all();
    $doitac= Doitac::get_all();
    $data = array('nhomsp' => $nhomsp,'doitac'=>$doitac);
    $this->render('add', $data);
  }
  public function add_submit()
  {
    // $masp = isset($_POST['masp']) ? $_POST['masp'] : 0;
    $tensanpham = isset($_POST['tensanpham']) ? $_POST['tensanpham'] : '';
    $id_danhmucsp = isset($_POST['iddanhmucsp']) ? $_POST['iddanhmucsp'] : '';
    $mota_sp = isset($_POST['motasp']) ? $_POST['motasp'] : '';
    $anh_sp = isset($_FILES['anhsp']) ? $_FILES['anhsp'] : '';
    $chitiet_sp = isset($_POST['chitietsp']) ? $_POST['chitietsp'] : '';
    $soluong = isset($_POST['soluong']) ? $_POST['soluong'] : '';
    $giathanh = isset($_POST['giathanh']) ? $_POST['giathanh'] : ''; 
    $nhasx_sp = isset($_POST['nhasx']) ? $_POST['nhasx'] : '';
    $thoigian = date('Y-m-d H:i:s');
    // var_dump($masp);
    if (!empty($tensanpham) && !empty($id_danhmucsp)) {
        $sanpham = new Sanpham(null, $tensanpham, $id_danhmucsp, $mota_sp, $chitiet_sp, $anh_sp, $soluong,$giathanh, $nhasx_sp, $thoigian);
      // var_dump($sanpham);

      try {
        // Gọi hàm add_byid()
        $result = $sanpham->add_byid();
        if ($result === true) {
          echo "<script> alert('Cập nhật thành công.')</script>";
      } else {
          echo "<script> alert('Lỗi cập nhật dữ liệu!');</script>";
      }
        // Xử lý kết quả trả về từ hàm
    } catch (Exception $e) {
        // Xử lý thông báo lỗi
        echo "Error: " . $e->getMessage();
    }

      $this->index();
    } else {
      echo "<script> alert('Lỗi: Tên sản phẩm và giá không được để trống!');</script>";
      $this->add();
    }
  }
  public function edit()
  {
    $nhomsp = Nhomsanpham::get_all();
    $doitac=Doitac::get_all();
    $sanpham = Sanpham::get_byid($_GET['masp']);
    $data = array('sanpham' => $sanpham, 'nhomsp' => $nhomsp,'doitac'=>$doitac);
    $this->render('edit', $data);
  }

  public function edit_submit()
{
    $masp = isset($_POST['masp']) ? $_POST['masp'] : 0;
    $tensanpham = isset($_POST['tensanpham']) ? $_POST['tensanpham'] : '';
    $id_danhmucsp = isset($_POST['iddanhmucsp']) ? $_POST['iddanhmucsp'] : '';
    $mota_sp = isset($_POST['motasp']) ? $_POST['motasp'] : '';
    $anh_sp = isset($_FILES['anhsp']) ? $_FILES['anhsp'] : '';
    $chitiet_sp = isset($_POST['chitietsp']) ? $_POST['chitietsp'] : '';
    $soluong = isset($_POST['soluong']) ? $_POST['soluong'] : '';
    $giathanh = isset($_POST['giathanh']) ? $_POST['giathanh'] : ''; 
    $nhasx_sp = isset($_POST['nhasx']) ? $_POST['nhasx'] : '';
    $thoigian = date('Y-m-d H:i:s');
    // var_dump($masp);
    if (!empty($tensanpham) && !empty($id_danhmucsp)) {
        $sanpham = new Sanpham($masp, $tensanpham, $id_danhmucsp, $mota_sp, $chitiet_sp, $anh_sp, $soluong,$giathanh, $nhasx_sp, $thoigian);
        $result = $sanpham->update();

        if ($result === true) {
            echo "<script> alert('Cập nhật thành công.')</script>";
        } else {
            echo "<script> alert('Lỗi cập nhật dữ liệu!');</script>";
        }

        $this->index();
    } else {
        echo "<script> alert('Lỗi: Tên sản phẩm và danh mục không được để trống!');</script>";
        $this->edit();
    }
}

  public function del()
  {
    $sanpham = Sanpham::delete($_GET['masp']); //Gọi phương thức   delete() của model Taikhoan.  

    //Trở về trang chủ  
    $this->index();
  }
}
