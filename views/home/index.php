<?php
require_once('database/start_session.php');
require_once('database/config.php');
require_once('database/dbhelper.php');

if (isset($_POST['atcbtn'])) {
    $id = $_POST['pid'];
    // $qty = $_POST['qty'];
    $iduser = $_SESSION['username'];

    // Check if $iduser is empty or not set
    if (empty($iduser)) {
        // Handle the case where $iduser is empty or not set
        // For example, you can redirect the user to the login page
        header("Location: index.php?controller=login");
        exit; // Stop further execution
    }

    // Example insert query
    $insertSql = "INSERT INTO dathang (`username`, `masanpham`, `soluong`) VALUES ('$iduser', $id, 1)";

    // Execute the insert query
    $insertedId = executeInsert($insertSql);

    // Check if insertion failed
    if ($insertedId == 0) {
        echo "Insertion Fail";
    } else {
        // Redirect the user to the shop cart page
        header("Location: index.php?controller=shopcart");
        exit; // Stop further execution
    }
}
?>
<div class="container-fluid mb-5">
    <div class="row border-top px-xl-5">
        <div class="col-lg-3 d-none d-lg-block">
            <a class="btn shadow-none d-flex align-items-center justify-content-between bg-primary text-white w-100" data-toggle="collapse" href="#navbar-vertical" style="height: 65px; margin-top: -1px; padding: 0 30px;">
                <h6 class="m-0">Danh Mục Sản Phẩm</h6>
                <i class="fa fa-angle-down text-dark"></i>
            </a>
            <nav class="collapse show navbar navbar-vertical navbar-light align-items-start p-0 border border-top-0 border-bottom-0" id="navbar-vertical">
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
                                foreach ($sanpham as $item){
                                    echo'
                                <a href="index.php?controller=shopgrid&action=get_product&madanhmuc=' . $item['madanhmuc'] . '" class="dropdown-item">'.$item['tendanhmuc'].'</a>
                                ';}?>
                            </div>
                        </div>
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Đồ Nữ</a>
                            <div class="dropdown-menu rounded-0 m-0">
                            <?php 
                                $sql = "select * from danhmuc where loaisanpham ='Nữ'";
                                $sanpham = executeResult($sql);
                                foreach ($sanpham as $item){
                                    echo'
                                <a href="index.php?controller=shopgrid&action=get_product&madanhmuc=' . $item['madanhmuc'] . '" class="dropdown-item">'.$item['tendanhmuc'].'</a>
                                ';}?>
                            </div>
                        </div>
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Phụ Kiện</a>
                            <div class="dropdown-menu rounded-0 m-0">
                            <?php 
                                $sql = "select * from danhmuc where loaisanpham ='Phụ kiện'";
                                $sanpham = executeResult($sql);
                                foreach ($sanpham as $item){
                                    echo'
                                <a href="index.php?controller=shopgrid&action=get_product&madanhmuc=' . $item['madanhmuc'] . '" class="dropdown-item">'.$item['tendanhmuc'].'</a>
                                ';}?>
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
            <div id="header-carousel" class="carousel slide" data-ride="carousel">
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
            </div>
        </div>
    </div>
</div>

<!-- Featured Start -->
<div class="container-fluid pt-5">
    <div class="row px-xl-5 pb-3">
        <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
            <div class="d-flex align-items-center border mb-4" style="padding: 30px;">
                <h1 class="fa fa-check text-primary m-0 mr-3"></h1>
                <h5 class="font-weight-semi-bold m-0">Sản Phẩm Chất Lượng</h5>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
            <div class="d-flex align-items-center border mb-4" style="padding: 30px;">
                <h1 class="fa fa-shipping-fast text-primary m-0 mr-2"></h1>
                <h5 class="font-weight-semi-bold m-0">Miễn Phí Vận Chuyển</h5>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
            <div class="d-flex align-items-center border mb-4" style="padding: 30px;">
                <h1 class="fas fa-exchange-alt text-primary m-0 mr-3"></h1>
                <h5 class="font-weight-semi-bold m-0">Hoàn Trả trong 14 ngày</h5>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
            <div class="d-flex align-items-center border mb-4" style="padding: 30px;">
                <h1 class="fa fa-phone-volume text-primary m-0 mr-3"></h1>
                <h5 class="font-weight-semi-bold m-0">Hỗ trợ 24/7</h5>
            </div>
        </div>
    </div>
</div>
<!-- Featured End -->


<!-- Categories Start -->
<div class="container-fluid pt-5">
    <div class="row px-xl-5 pb-3">
        <div class="col-lg-4 col-md-6 pb-1">
            <div class="cat-item d-flex flex-column border mb-4" style="padding: 30px;">
                <a href="index.php?controller" class="cat-img position-relative overflow-hidden mb-3">
                    <img class="img-fluid" src="assets/img/cat-1.jpg" alt="">
                </a>
                <h5 class="font-weight-semi-bold m-0">Sản Phẩm Cho Đàn Ông</h5>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 pb-1">
            <div class="cat-item d-flex flex-column border mb-4" style="padding: 30px;">
                <a href="" class="cat-img position-relative overflow-hidden mb-3">
                    <img class="img-fluid" src="assets/img/cat-2.jpg" alt="">
                </a>
                <h5 class="font-weight-semi-bold m-0">Sản Phẩm Phụ Nữ</h5>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 pb-1">
            <div class="cat-item d-flex flex-column border mb-4" style="padding: 30px;">
                <a href="" class="cat-img position-relative overflow-hidden mb-3">
                    <img class="img-fluid" src="assets/img/cat-3.jpg" alt="">
                </a>
                <h5 class="font-weight-semi-bold m-0">Sản Phẩm Trẻ Em</h5>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 pb-1">
            <div class="cat-item d-flex flex-column border mb-4" style="padding: 30px;">
                <a href="" class="cat-img position-relative overflow-hidden mb-3">
                    <img class="img-fluid" src="assets/img/cat-4.jpg" alt="">
                </a>
                <h5 class="font-weight-semi-bold m-0">Phụ Kiện</h5>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 pb-1">
            <div class="cat-item d-flex flex-column border mb-4" style="padding: 30px;">
                <a href="" class="cat-img position-relative overflow-hidden mb-3">
                    <img class="img-fluid" src="assets/img/cat-5.jpg" alt="">
                </a>
                <h5 class="font-weight-semi-bold m-0">Túi </h5>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 pb-1">
            <div class="cat-item d-flex flex-column border mb-4" style="padding: 30px;">
                <a href="" class="cat-img position-relative overflow-hidden mb-3">
                    <img class="img-fluid" src="assets/img/cat-6.jpg" alt="">
                </a>
                <h5 class="font-weight-semi-bold m-0">Giày</h5>
            </div>
        </div>
    </div>
</div>
<!-- Categories End -->


<!-- Offer Start -->
<div class="container-fluid offer pt-5">
    <div class="row px-xl-5">
        <div class="col-md-6 pb-4">
            <div class="position-relative bg-secondary text-center text-md-right text-white mb-2 py-5 px-5">
                <img src="assets/img/offer-1.png" alt="">
                <div class="position-relative" style="z-index: 1;">
                    <h5 class="text-uppercase text-primary mb-3">Giám Giá 20% với tất cả sản phẩm</h5>
                    <h1 class="mb-4 font-weight-semi-bold">Bộ sưu tập mùa xuân</h1>
                    <a href="" class="btn btn-outline-primary py-md-2 px-md-3">Mua Ngay</a>
                </div>
            </div>
        </div>
        <div class="col-md-6 pb-4">
            <div class="position-relative bg-secondary text-center text-md-left text-white mb-2 py-5 px-5">
                <img src="assets/img/offer-2.png" alt="">
                <div class="position-relative" style="z-index: 1;">
                    <h5 class="text-uppercase text-primary mb-3">Giám Giá 20% với tất cả sản phẩm</h5>
                    <h1 class="mb-4 font-weight-semi-bold">Bộ sưu tập mùa đông</h1>
                    <a href="" class="btn btn-outline-primary py-md-2 px-md-3">Mua Ngay</a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Offer End -->


<!-- Products Start -->
<div class="container-fluid pt-5">
    <div class="text-center mb-4">
        <h2 class="section-title px-5"><span class="px-2">Sản Phẩm HOT</span></h2>
    </div>
    <div class="row px-xl-5 pb-3">
        
        <?php
        $sql = 'select * from sanpham';
        $sanpham = executeResult($sql);
        $index = 1;
        $count = 0;

        foreach ($sanpham as $item) {
            if ($count >= 8) {
                break; // Thoát khỏi vòng lặp nếu đã hiển thị đủ 8 sản phẩm
            }

            $anh_sp = str_replace('../assets/uploads/', 'assets/uploads/', $item['anh_sp']);
            echo '
            <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
            <form method="post">
                <div class="card product-item border-0 mb-4">
                    <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                        <img class="img-fluid w-100" src="' . $anh_sp . '" alt="">
                    </div>
                    <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
                        <h6 class="text-truncate mb-3">' . $item['tensp'] . '</h6>
                        <div class="d-flex justify-content-center">
                            <h6>$' . $item['giathanh'] . '</h6>
                            <h6 class="text-muted ml-2"><del>$' . $item['giathanh'] . '</del></h6>
                        </div>
                    </div>
                    <div class="card-footer d-flex justify-content-between bg-light border">
                        <a href="index.php?controller=shopgrid&action=details&masp=' . $item['masp'] . '" class="btn btn-sm text-dark p-0"><i class="fas fa-eye text-primary mr-1"></i>View Detail</a>
                        <input type="hidden" name="pid" value=" '. $item['masp'] .' ">
                        <i class="fas fa-shopping-cart text-primary mr-1"></i><button class="btn btn-sm text-dark p-0" name="atcbtn">Thêm vào giỏ hàng</button>
                    </div>
                </div>
            </form>
            </div>';

            $count++;
        }
        ?>
    </div>
</div>
<!-- Products End -->


<!-- Subscribe Start -->
<div class="container-fluid bg-secondary my-5">
    <div class="row justify-content-md-center py-5 px-xl-5">
        <div class="col-md-6 col-12 py-5">
            <div class="text-center mb-2 pb-2">
                <h2 class="section-title px-5 mb-3"><span class="bg-secondary px-2">Thông Tin Liên Hệ</span></h2>
                <p>Chúng tôi luôn nỗ lực mỗi ngày để mang đến cho khách hàng những sản phẩm và dịch vụ tốt nhất.</p>
                <p>Thời gian làm việc: Thứ Hai - Chủ Nhật, 10:00 AM - 9:00 PM</p>
            </div>
            <form action="">
                <div class="input-group">
                    <input type="text" class="form-control border-white p-4" placeholder="Email Liên Hệ">
                    <div class="input-group-append">
                        <button class="btn btn-primary px-4">Theo Dõi</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Subscribe End -->


<!-- Products Start -->
<!-- <div class="container-fluid pt-5">
    <div class="text-center mb-4">
        <h2 class="section-title px-5"><span class="px-2">TIN THỜI TRANG</span></h2>
    </div>
    <div class="row px-xl-5 pb-3">
        <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
            <img src="assets/img/product-1.jpg" style="width: 453px; height:302px;">
            <h2>Xu Hướng Hiện Nay</h2>
            <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
            <p><a class="btn btn-secondary" href="#" role="button">View details »</a></p>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
            <h2>Heading</h2>
            <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
            <p><a class="btn btn-secondary" href="#" role="button">View details »</a></p>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
            <h2>Heading</h2>
            <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
            <p><a class="btn btn-secondary" href="#" role="button">View details »</a></p>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
            <h2>Heading</h2>
            <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
            <p><a class="btn btn-secondary" href="#" role="button">View details »</a></p>
        </div>
    </div>
</div> -->
<!-- Products End -->


<!-- Vendor Start -->
<div class="container-fluid py-5">
    <div class="row px-xl-5">
        <div class="col">
            <div class="owl-carousel vendor-carousel">
                <div class="vendor-item border p-4">
                    <img src="assets/img/vendor-1.jpg" alt="">
                </div>
                <div class="vendor-item border p-4">
                    <img src="assets/img/vendor-2.jpg" alt="">
                </div>
                <div class="vendor-item border p-4">
                    <img src="assets/img/vendor-3.jpg" alt="">
                </div>
                <div class="vendor-item border p-4">
                    <img src="assets/img/vendor-4.jpg" alt="">
                </div>
                <div class="vendor-item border p-4">
                    <img src="assets/img/vendor-5.jpg" alt="">
                </div>
                <div class="vendor-item border p-4">
                    <img src="assets/img/vendor-6.jpg" alt="">
                </div>
                <div class="vendor-item border p-4">
                    <img src="assets/img/vendor-7.jpg" alt="">
                </div>
                <div class="vendor-item border p-4">
                    <img src="assets/img/vendor-8.jpg" alt="">
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Vendor End -->