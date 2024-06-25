<?php
require_once('database/start_session.php');
require_once('database/config.php');
require_once('database/dbhelper.php');
require_once('models/shopcart.php');
$id = $_SESSION['username'];
$sql = "SELECT dathang.*, anh_sp, giathanh, tensp
                    FROM dathang
                    INNER JOIN sanpham ON sanpham.masp = dathang.masanpham
                    WHERE username = '$id'";
// echo $sql;
$cartList = executeResult($sql);
// Check if the 'add' button is clicked
  // Retrieve payment method from form
  $paymentMethod = isset($_POST['payment']) ? $_POST['payment'] : '';
if ($paymentMethod  == "paypal") {
  echo'chon';
  $name = isset($_POST['name']) ? $_POST['name'] : '';
  $phone = isset($_POST['phone']) ? $_POST['phone'] : '';
  $email = isset($_POST['email']) ? $_POST['email'] : '';
  $address = isset($_POST['address']) ? $_POST['address'] : '';
  $note = isset($_POST['note']) ? $_POST['note'] : '';
  $iduser = $_SESSION['username'];

  //   //insert order
  $query = "INSERT INTO `khachhang`(`tenkh`, `sodt`, `emailkh`, `diachi`, `note`) 
  VALUES ('$name', '$phone', '$email', '$address', '$note')";
  $idOrder = executeInsert($query);

  //   //insert order 
  if ($idOrder > 0) {
    $sql = "SELECT dathang.*, anh_sp, giathanh, tensp
                    FROM dathang
                    INNER JOIN sanpham ON sanpham.masp = dathang.masanpham
                    WHERE username = '$id'";
    $cartList = executeResult($sql);
    foreach ($cartList as $item) {
      $product_id = $item["masanpham"];
      $number = $item["soluong"];
      $price = $item["giathanh"];
      $query = "INSERT INTO `donhang`(`madonhang`, `madathang`, `makh`, `masp`, `tinhtrangdonhang`, `tongtien`, `tongsp`)
        VALUES (NULL,$idOrder,'$iduser', $product_id,'Đang xử lý', $price,$number)";
      $idOrder_details = executeInsert($query);
      if ($idOrder_details < 0) {
        echo 'insert Order_details fail';
      }
    }
    $sql_get_quantity = "SELECT * FROM doanhthu WHERE masp = $product_id";
    $old_quantity_result = executeSingleResult($sql_get_quantity);

    if ($old_quantity_result) {
      $old_quantity = $old_quantity_result['soluong'];
      $new_quantity = $old_quantity + $number;
      $new_total_price = $new_quantity * $price;
      $sql_doanhthu = "UPDATE `doanhthu` 
                         SET soluong = $new_quantity, 
                             tongtien = $new_total_price, 
                             update_day = NOW() 
                         WHERE masp = $product_id";
      $in = execute($sql_doanhthu);
      echo $sql_doanhthu;
    } else {
      $new_quantity = $number;
      $new_total_price = $new_quantity * $price;
      $sql_doanhthu = "INSERT INTO `doanhthu`(`id`, `masp`, `soluong`, `tongtien`, `update_day`)
                         VALUES (NULL, $product_id, $new_quantity, $new_total_price, NOW())";
      $in = execute($sql_doanhthu);
    }
    echo $sql_doanhthu;
    $sql = "DELETE FROM dathang WHERE username = '$iduser'";
    $check = execute($sql);
    header("Location: index.php?controller=shopcart&action=order");
  } else {
    echo 'insert fail';
  }
}

?>
<div class="container-fluid">
  <div class="row border-top px-xl-5">
    <div class="col-lg-3 d-none d-lg-block">
      <a class="btn shadow-none d-flex align-items-center justify-content-between bg-primary text-white w-100" data-toggle="collapse" href="#navbar-vertical" style="height: 65px; margin-top: -1px; padding: 0 30px;">
        <h6 class="m-0">Danh Mục Sản Phẩm</h6>
        <i class="fa fa-angle-down text-dark"></i>
      </a>
      <nav class="collapse position-absolute navbar navbar-vertical navbar-light align-items-start p-0 border border-top-0 border-bottom-0 bg-light" id="navbar-vertical" style="width: calc(100% - 30px); z-index: 1;">
        <div class="navbar-nav w-100 overflow-hidden" style="height: 410px">
          <?php
          $categories = array("Nam", "Nữ", "Trẻ em", "Phụ kiện");
          foreach ($categories as $category) {
            $sql = "SELECT * FROM danhmuc WHERE loaisanpham = '$category'";
            $danhmuc = executeResult($sql);
          ?>
            <div class="nav-item dropdown">
              <a href="#" class="nav-link" data-toggle="dropdown">Sản Phẩm <?php echo $category; ?> <i class="fa fa-angle-down float-right mt-1"></i></a>
              <div class="dropdown-menu position-absolute bg-secondary border-0 rounded-0 w-100 m-0">
                <?php
                foreach ($danhmuc as $item) {
                  echo '<a href="index.php?controller=shopgrid&action=get_product&madanhmuc=' . $item['madanhmuc'] . '" class="dropdown-item">' . $item['tendanhmuc'] . '</a>';
                }
                ?>
                <div class="dropdown-divider"></div>
              </div>
            </div>
          <?php } ?>
        </div>
      </nav>
    </div>
    <div class="col-lg-9">
      <nav class="navbar navbar-expand-lg bg-light navbar-light py-3 py-lg-0 px-0">
        <a href="" class="text-decoration-none d-block d-lg-none">
          <h1 class="m-0 display-5 font-weight-semi-bold"><span class="text-primary font-weight-bold border px-3 mr-1">H</span>Shopper</h1>
        </a>
        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
          <div class="navbar-nav mr-auto py-0">
            <a href="index.php" class="nav-item nav-link active">Trang chủ</a>
            <a href="index.php?controller=shopgrid" class="nav-item nav-link">Sản Phẩm</a>
            <div class="nav-item dropdown">
              <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Đồ Nam</a>
              <div class="dropdown-menu rounded-0 m-0">
                <?php
                $sql = "select * from danhmuc where loaisanpham ='Nam'";
                $sanpham = executeResult($sql);
                foreach ($sanpham as $item) {
                  echo '
                                <a href="index.php?controller=shopgrid&action=get_product&madanhmuc=' . $item['madanhmuc'] . '" class="dropdown-item">' . $item['tendanhmuc'] . '</a>
                                ';
                } ?>
              </div>
            </div>
            <div class="nav-item dropdown">
              <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Đồ Nữ</a>
              <div class="dropdown-menu rounded-0 m-0">
                <?php
                $sql = "select * from danhmuc where loaisanpham ='Nữ'";
                $sanpham = executeResult($sql);
                foreach ($sanpham as $item) {
                  echo '
                                <a href="index.php?controller=shopgrid&action=get_product&madanhmuc=' . $item['madanhmuc'] . '" class="dropdown-item">' . $item['tendanhmuc'] . '</a>
                                ';
                } ?>
              </div>
            </div>
            <div class="nav-item dropdown">
              <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Phụ Kiện</a>
              <div class="dropdown-menu rounded-0 m-0">
                <?php
                $sql = "select * from danhmuc where loaisanpham ='Phụ kiện'";
                $sanpham = executeResult($sql);
                foreach ($sanpham as $item) {
                  echo '
                                <a href="index.php?controller=shopgrid&action=get_product&madanhmuc=' . $item['madanhmuc'] . '" class="dropdown-item">' . $item['tendanhmuc'] . '</a>
                                ';
                } ?>
              </div>
            </div>
            <div class="nav-item dropdown">
              <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Thêm</a>
              <div class="dropdown-menu rounded-0 m-0">
                <a href="index.php?controller=shopcart" class="dropdown-item">Giỏ Hàng</a>
                <a href="index.php?controller=shopcart&action=order" class="dropdown-item">Đơn Hàng</a>
                <a href="index.php?controller=tintuc" class="dropdown-item">Tin Tức</a>
              </div>
            </div>
            <a href="index.php?controller=contact" class="nav-item nav-link">Liên Hệ</a>
          </div>
          <div class="navbar-nav ml-auto py-0">
            <?php
            $login = "login";
            $loginEcho = "Đăng Nhập";
            if (isset($_SESSION['username'])) {
              $login = "logout";
              $loginEcho = $_SESSION['username'];

              if (isset($_GET['action']) && $_GET['action'] === 'logout') {
                unset($_SESSION['username']);
                $login = "login";
                $loginEcho = "Login";
              }
            }
            ?>
            <div class="header__top__right__auth">
              <a href="index.php?controller=login&action=<?php echo $login; ?>" class="nav-item nav-link"><i class="fa fa-user"></i><?php echo $loginEcho; ?></a>
            </div>
            <!-- <a href="index.php?controller=login" class="nav-item nav-link">Đăng Nhập</a>
                        <a href="index.php?controller=login&action=register" class="nav-item nav-link">Đăng ký</a> -->
          </div>
        </div>
      </nav>
      <!-- <div id="header-carousel" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active" style="height: 410px;">
                        <img class="img-fluid" src="assets/img/carousel-1.jpg" alt="Image">
                        <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                            <div class="p-3" style="max-width: 700px;">
                                <h4 class="text-light text-uppercase font-weight-medium mb-3">GIẢM GIÁ 10% ĐƠN HÀNG ĐẦU TIÊN CỦA BẠN</h4>
                                <h3 class="display-4 text-white font-weight-semi-bold mb-4">Váy Thời Trang</h3>
                                <a href="" class="btn btn-light py-2 px-3">Mua Ngay</a>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item" style="height: 410px;">
                        <img class="img-fluid" src="assets/img/carousel-2.jpg" alt="Image">
                        <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                            <div class="p-3" style="max-width: 700px;">
                                <h4 class="text-light text-uppercase font-weight-medium mb-3">GIẢM GIÁ 10% ĐƠN HÀNG ĐẦU TIÊN</h4>
                                <h3 class="display-4 text-white font-weight-semi-bold mb-4">GIÁ CẢ HỢP LÝ</h3>
                                <a href="" class="btn btn-light py-2 px-3">MUA NGAY</a>
                            </div>
                        </div>
                    </div>
                </div>
                <a class="carousel-control-prev" href="#header-carousel" data-slide="prev">
                    <div class="btn btn-dark" style="width: 45px; height: 45px;">
                        <span class="carousel-control-prev-icon mb-n2"></span>
                    </div>
                </a>
                <a class="carousel-control-next" href="#header-carousel" data-slide="next">
                    <div class="btn btn-dark" style="width: 45px; height: 45px;">
                        <span class="carousel-control-next-icon mb-n2"></span>
                    </div>
                </a>
            </div> -->
    </div>
  </div>
</div>
<!-- Hero Section Begin -->
<div class="container-fluid bg-secondary mb-5">
  <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
    <h1 class="font-weight-semi-bold text-uppercase mb-3">Thanh Toan</h1>
    <div class="d-inline-flex">
      <p class="m-0"><a href="">Trang Chu</a></p>
      <p class="m-0 px-2">-</p>
      <p class="m-0">Thanh Toan</p>
    </div>
  </div>
</div>
<!-- Page Header End -->


<!-- Checkout Start -->
<!-- Checkout Start -->
<div class="container-fluid pt-5">
  <form id="checkoutForm" action="" method="post">
    <div class="row px-xl-5">
      <div class="col-lg-8">
        <div class="mb-4">
          <h4 class="font-weight-semi-bold mb-4">Thông Tin Địa Chỉ</h4>
          <div class="row">
            <div class="col-md-6 form-group">
              <label>Tên Khách Hàng</label>
              <input id="name" name="name" class="form-control" type="text" placeholder="John" required>
            </div>
            <div class="col-md-6 form-group">
              <label>E-mail</label>
              <input id="email" name="email" class="form-control" type="email" placeholder="example@email.com" required>
            </div>
            <div class="col-md-6 form-group">
              <label>Số Điện Thoại</label>
              <input id="phone" name="phone" class="form-control" type="text" placeholder="+123 456 789" required>
            </div>
            <div class="col-md-6 form-group">
              <label>Địa Chỉ Khách Hàng</label>
              <input id="address" name="address" class="form-control" type="text" placeholder="123 Street" required>
            </div>
            <div class="col-md-6 form-group">
              <label>Mô Tả</label>
              <input id="note" name="note" class="form-control" type="text" placeholder="Any additional notes">
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-4">
        <div class="card border-secondary mb-5">
          <div class="card-header bg-secondary border-0">
            <h4 class="font-weight-semi-bold m-0">Tổng số đơn hàng</h4>
          </div>
          <div class="card-body">
            <h5 class="font-weight-medium mb-3">Sản Phẩm</h5>
            <?php
            $total = 0;
            foreach ($cartList as $item) {
              $num = $item['soluong'];
              $anh_sp = str_replace('../assets/uploads/', 'assets/uploads/', $item['anh_sp']);
              $tensp = strlen($item['tensp']) > 30 ? substr($item['tensp'], 0, 30) . '...' : $item['tensp'];
              $total += $num * $item['giathanh'];
              echo '
                                <div class="d-flex justify-content-between">
                                    <p>' . $tensp . ' x' . $item['soluong'] . '</p>
                                    <p>' . number_format($num * $item['giathanh']) . ' VND</p>
                                </div>';
            }
            ?>
            <hr class="mt-0">
            <div class="d-flex justify-content-between mb-3 pt-1">
              <h6 class="font-weight-medium">Chi Phí Phụ</h6>
              <h6 class="font-weight-medium">0 VND</h6>
            </div>
            <div class="d-flex justify-content-between">
              <h6 class="font-weight-medium">Shipping</h6>
              <h6 class="font-weight-medium">0 VND</h6>
            </div>
          </div>
          <div class="card-footer border-secondary bg-transparent">
            <div class="d-flex justify-content-between mt-2">
              <h5 class="font-weight-bold">Tổng</h5>
              <h5 class="font-weight-bold"><?= number_format($total) ?> VND</h5>
            </div>
          </div>
        </div>

        <div class="card border-secondary mb-5">
          <div class="card-header bg-secondary border-0">
            <h4 class="font-weight-semi-bold m-0">Phương Thức Thanh Toán</h4>
          </div>
          <div class="card-body">
            <div class="form-group">
              <div class="custom-control custom-radio">
                <input type="radio" class="custom-control-input" name="payment" id="paypal" value="paypal" required>
                <label class="custom-control-label" for="paypal">Thanh Toán Khi Nhận Hàng</label>
              </div>
            </div>
            <div class="form-group">
              <div class="custom-control custom-radio">
                <input type="radio" class="custom-control-input" name="payment" id="directcheck" value="directcheck" required>
                <label class="custom-control-label" for="directcheck">Thanh Toán Chuyển Khoản</label>
              </div>
            </div>
            <div class="form-group">
              <div class="custom-control custom-radio">
                <input type="radio" class="custom-control-input" name="payment" id="vnpay" value="vnpay" required>
                <label class="custom-control-label" for="vnpay">Thanh Toán Bằng VNPAY</label>
              </div>
            </div>
          </div>
          <div class="card-footer border-secondary bg-transparent">
            <button type="submit" name="add" value="add"  class="btn btn-lg btn-block btn-primary font-weight-bold my-3 py-3">Đặt Hàng</button>
          </div>
        </div>
      </div>
    </div>
  </form>
</div>
<!-- Checkout End -->
</div>

<script>
  function submitPaymentForm() {
    const paymentMethods = document.getElementsByName('payment');
    let selectedPaymentMethod = null;
    for (let i = 0; i < paymentMethods.length; i++) {
      if (paymentMethods[i].checked) {
        selectedPaymentMethod = paymentMethods[i].value;
        break;
      }
    }

    if (selectedPaymentMethod) {
      const form = document.getElementById('checkoutForm');
      switch (selectedPaymentMethod) {
        case 'vnpay':
          form.action = 'index.php?controller=thanhtoan';
          break;
        case 'directcheck':
          form.action = 'index.php?controller=directcheck';
          break;

      }
      form.submit();
    } else {
      alert('Please select a payment method');
    }
  }

  document.getElementById('checkoutForm').onsubmit = function(event) {
    submitPaymentForm();
    return false;
  };
</script>
<!-- Checkout End -->