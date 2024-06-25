<?php
require_once('controllers/base_controller.php');
require_once('models/doitac.php');
require_once('database/dbhelper.php');

class DoitacController extends BaseController
{
  function __construct()
  {
    $this->folder = 'doitac'; //Tên thư mục của module home trong view
  }

  public function index()
  {
    $doitac = doitac::get_all();
    $data = array('doitac' => $doitac);
    $this->render('index', $data);
  }

  // public function detail()
  // {
  //   $doitac = doitac::get_byid($_GET['id']);
  //   $data = array('doitac' => $doitac);
  //   $this->render('detail', $data);
  // }
  public function add()
  { 
    $this->render('add');
  }
  public function add_submit()
{
    $name_doitac = isset($_POST['name_doitac']) ? $_POST['name_doitac'] : '';
    $email_doitac = isset($_POST['email_doitac']) ? $_POST['email_doitac'] : '';
    $phone_doitac = isset($_POST['phone_doitac']) ? $_POST['phone_doitac'] : '';
    $address_doitac = isset($_POST['address_doitac']) ? $_POST['address_doitac'] : '';
    $website_doitac = isset($_POST['website_doitac']) ? $_POST['website_doitac'] : '';

    if (!empty($name_doitac) && !empty($email_doitac) && !empty($phone_doitac) && !empty($address_doitac) && !empty($website_doitac)) {
        $doitac = new doitac('', $name_doitac, $email_doitac, $phone_doitac, $address_doitac, $website_doitac);

        $results = $doitac->add_byid();

        if ($results) {
            echo "<script> alert('Thêm mới thành công.') </script>";
        } else {
            echo "<script> alert('Lỗi thêm dữ liệu!') </script>";
        }

        $this->index();
    } else {
        echo "<script> alert('Lỗi: Các trường không được để trống!') </script>";
        $this->add();
    }
}

  public function edit()
  {
    $doitac = doitac::get_byid($_GET['id_doitac']);
    $data = array('doitac' => $doitac);
    $this->render('edit', $data);
  }

  public function edit_submit()
  {
      $id_doitac = isset($_POST['id_doitac']) ? $_POST['id_doitac'] : '';
      $name_doitac = isset($_POST['name_doitac']) ? $_POST['name_doitac'] : '';
      $email_doitac = isset($_POST['email_doitac']) ? $_POST['email_doitac'] : '';
      $phone_doitac = isset($_POST['phone_doitac']) ? $_POST['phone_doitac'] : '';
      $address_doitac = isset($_POST['address_doitac']) ? $_POST['address_doitac'] : '';
      $website_doitac = isset($_POST['website_doitac']) ? $_POST['website_doitac'] : '';
  
      if (!empty($id_doitac) && !empty($name_doitac) && !empty($email_doitac) && !empty($phone_doitac) && !empty($address_doitac) && !empty($website_doitac)) {
          $doitac = new doitac($id_doitac, $name_doitac, $email_doitac, $phone_doitac, $address_doitac, $website_doitac);
          $results = $doitac->update();
          if ($results) {
              echo "<script> alert('Sửa thành công.') </script>";
          } else {
              echo "<script> alert('Lỗi sửa dữ liệu!') </script>";
          }
          $this->index();
      } else {
          echo "<script> alert('Lỗi: Không được để trống các trường thông tin!') </script>";
          echo "<script> history.go(-1) </script>";
      }
  }
  
  public function del()
  {
    $doitac = doitac::delete($_GET['id_doitac']); //Gọi phương thức   delete() của model doitac.  

    //Trở về trang chủ  
    $this->index();
  }
}
