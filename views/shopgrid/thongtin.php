<?php
require_once('database/start_session.php');
require_once('database/config.php');
require_once('database/dbhelper.php');
require_once('models/shopgrid.php');

if (isset($_POST['atcbtn'])) {
    $id = isset($_GET['masp']) ? $_GET['masp'] : '';
    $qty = $_POST['qty'];
    $iduser = $_SESSION['username'];

    // Example insert query
    $insertSql = "INSERT INTO dathang (username, masanpham, soluong) VALUES ('$iduser', $id, $qty)";
    // Execute the insert query
    $insertedId = executeInsert($insertSql);

    // Thêm sản phẩm vào giỏ hàng
    if ($insertedId > 0) {
        // Lấy số lượng hiện có của sản phẩm
        $sql = "SELECT soluong FROM sanpham WHERE masp = $id";
        $product = executeSingleResult($sql);

        if ($product) {
            $available_quantity = $product['soluong'];

            // Kiểm tra số lượng sản phẩm có đủ để bán không
            if ($qty <= $available_quantity) {
                // Trừ số lượng sản phẩm đã mua từ số lượng hiện có
                $new_quantity = $available_quantity - $qty;
                $updateSql = "UPDATE sanpham SET soluong = $new_quantity WHERE masp = $id";
                execute($updateSql);
            } else {
                // Thông báo không đủ sản phẩm để bán
                echo '<script>alert("Sản phẩm không đủ để bán.");</script>';
            }
        } else {
            // Thông báo không tìm thấy sản phẩm
            echo "Không tìm thấy sản phẩm.";
        }
    } else {
        // Thông báo thất bại khi thêm sản phẩm vào giỏ hàng
        echo "Thêm sản phẩm vào giỏ hàng thất bại.";
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
<!-- Page Header Start -->
<div class="container-fluid bg-secondary mb-5">
    <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 158px">
        <h1 class="font-weight-semi-bold text-uppercase mb-3">Thông Tin</h1>
    </div>
</div>
<!-- Page Header End -->


<!-- Shop Detail Start -->
<div class="container-fluid py-5">
    <?php
    if (isset($_GET['masp'])) {
        $id_category = trim(strip_tags($_GET['masp']));
    } else {
        $id_category = 0;
    }
    $sql = "select * from sanpham where masp='$id_category'";
    $sanpham = executeResult($sql);
    foreach ($sanpham as $item) {
        $anh_sp = str_replace('../assets/uploads/', 'assets/uploads/', $item['anh_sp']);
        echo '
    <div class="row px-xl-5">
        <div class="col-lg-5 pb-5"> 
            <div id="product-carousel" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner border">
                <div class="carousel-item active">
                <img class="w-100 h-100" src="' . $anh_sp . '" alt="Image" style="height: 567px; width: 567px;">
            </div>
                    
                </div>
                <a class="carousel-control-prev" href="#product-carousel" data-slide="prev">
                    <i class="fa fa-2x fa-angle-left text-dark"></i>
                </a>
                <a class="carousel-control-next" href="#product-carousel" data-slide="next">
                    <i class="fa fa-2x fa-angle-right text-dark"></i>
                </a>
            </div>
        </div>

        <div class="col-lg-7 pb-5">
            <h3 class="font-weight-semi-bold">' . $item['tensp'] . '</h3>
            <div class="d-flex mb-3">
                <div class="text-primary mr-2">
                    <small class="fas fa-star"></small>
                    <small class="fas fa-star"></small>
                    <small class="fas fa-star"></small>
                    <small class="fas fa-star-half-alt"></small>
                    <small class="far fa-star"></small>
                </div>
                <small class="pt-1">(50 Đánh giá)</small>
            </div>
            <h3 class="font-weight-semi-bold mb-4">' . number_format($item['giathanh'], 0, ',', '.') . ' VNĐ</h3>
            <p class="mb-4">' . $item['mota_sp'] . '</p>
                <div class="d-flex mb-3">
                    <p class="text-dark font-weight-medium mb-0 mr-3">Sizes:</p>
                    <form>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" class="custom-control-input" id="size-1" name="size">
                            <label class="custom-control-label" for="size-1">XS</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" class="custom-control-input" id="size-2" name="size">
                            <label class="custom-control-label" for="size-2">S</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" class="custom-control-input" id="size-3" name="size">
                            <label class="custom-control-label" for="size-3">M</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" class="custom-control-input" id="size-4" name="size">
                            <label class="custom-control-label" for="size-4">L</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" class="custom-control-input" id="size-5" name="size">
                            <label class="custom-control-label" for="size-5">XL</label>
                        </div>
                    </form>
                </div>
                <form method="post">
                <div class="d-flex align-items-center mb-4 pt-2">
                    <p class="mb-3">Số Lượng Còn Lại: ' . $item['soluong'] . ' chiếc</p>
                    <div class="input-group quantity mr-3" style="width: 130px;">
                    <div class="input-group-btn">
                        <button class="btn btn-primary btn-minus">
                        <i class="fa fa-minus"></i>
                        </button>
                    </div>
                    <input type="text" class="form-control bg-secondary text-center" value="1" name="qty">
                    <div class="input-group-btn">
                        <button class="btn btn-primary btn-plus">
                        <i class="fa fa-plus"></i>
                        </button>
                    </div>
                    </div>
                    <button class="btn btn-primary px-3" name="atcbtn"><i class="fa fa-shopping-cart mr-1"></i> Add To Cart</button>
                </div>
                </form>
            
            <div class="d-flex pt-2">
                <p class="text-dark font-weight-medium mb-0 mr-2">Share on:</p>
                <div class="d-inline-flex">
                    <a class="text-dark px-2" href="">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a class="text-dark px-2" href="">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a class="text-dark px-2" href="">
                        <i class="fab fa-linkedin-in"></i>
                    </a>
                    <a class="text-dark px-2" href="">
                        <i class="fab fa-pinterest"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="row px-xl-5">
        <div class="col">
            <div class="nav nav-tabs justify-content-center border-secondary mb-4">
                <a class="nav-item nav-link active" data-toggle="tab" href="#tab-pane-1">Mô Tả</a>
                <a class="nav-item nav-link" data-toggle="tab" href="#tab-pane-2">Chi Tiết</a>
                <a class="nav-item nav-link" data-toggle="tab" href="#tab-pane-3">Đánh Giá (0)</a>
            </div>
            <div class="tab-content">
                <div class="tab-pane fade show active" id="tab-pane-1">
                    <h4 class="mb-3">Mô Tả Sản Phẩm</h4>
                    <p>' . $item['mota_sp'] . '</p>
                </div>
                <div class="tab-pane fade" id="tab-pane-2">
                    <h4 class="mb-3">Chi Tiết</h4>
                    <p>' . $item['chitiet_sp'] . '</p>
                    <div class="row">
                        <div class="col-md-6">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item px-0">
                                    Sit erat duo lorem duo ea consetetur, et eirmod takimata.
                                </li>
                                <li class="list-group-item px-0">
                                    Amet kasd gubergren sit sanctus et lorem eos sadipscing at.
                                </li>
                                <li class="list-group-item px-0">
                                    Duo amet accusam eirmod nonumy stet et et stet eirmod.
                                </li>
                                <li class="list-group-item px-0">
                                    Takimata ea clita labore amet ipsum erat justo voluptua. Nonumy.
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item px-0">
                                    Sit erat duo lorem duo ea consetetur, et eirmod takimata.
                                </li>
                                <li class="list-group-item px-0">
                                    Amet kasd gubergren sit sanctus et lorem eos sadipscing at.
                                </li>
                                <li class="list-group-item px-0">
                                    Duo amet accusam eirmod nonumy stet et et stet eirmod.
                                </li>
                                <li class="list-group-item px-0">
                                    Takimata ea clita labore amet ipsum erat justo voluptua. Nonumy.
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="tab-pane-3">
                    <div class="row">
                        <div class="col-md-6">
                            <h4 class="mb-4">1 đánh giá "' . $item['tensp'] . '"</h4>
                            <div class="media mb-4">
                                <img src="assets/img/user.jpg" alt="Image" class="img-fluid mr-3 mt-1" style="width: 45px;">
                                <div class="media-body">
                                    <h6>John Doe<small> - <i>01 Jan 2045</i></small></h6>
                                    <div class="text-primary mb-2">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star-half-alt"></i>
                                        <i class="far fa-star"></i>
                                    </div>
                                    <p>Sản phẩm Rất ok</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <h4 class="mb-4">Để Lại Đánh Giá</h4>
                            <small>Địa chỉ email của bạn sẽ không được công bố. Các trường bắt buộc được đánh dấu *</small>
                            <div class="d-flex my-3">
                                <p class="mb-0 mr-2">Đánh giá của bạn * :</p>
                                <div class="text-primary">
                                    <i class="far fa-star"></i>
                                    <i class="far fa-star"></i>
                                    <i class="far fa-star"></i>
                                    <i class="far fa-star"></i>
                                    <i class="far fa-star"></i>
                                </div>
                            </div>
                            <form>
                                <div class="form-group">
                                    <label for="message">Đánh Giá *</label>
                                    <textarea id="message" cols="30" rows="5" class="form-control"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="name">Tên Người Đánh Giá *</label>
                                    <input type="text" class="form-control" id="name">
                                </div>
                                <div class="form-group">
                                    <label for="email">Email *</label>
                                    <input type="email" class="form-control" id="email">
                                </div>
                                <div class="form-group mb-0">
                                    <input type="submit" value="Để Lại Đánh Giá" class="btn btn-primary px-3">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>';
    }
    ?>
</div>
<!-- Shop Detail End -->


<!-- Products Start -->
<div class="container-fluid py-5">
    <div class="text-center mb-4">
        <h2 class="section-title px-5"><span class="px-2">Bạn cũng có thể thích</span></h2>
    </div>
    <div class="row px-xl-5">
        <div class="col">
            <div class="owl-carousel related-carousel">
                <?php
                if (isset($_GET['masp'])) {
                    $id_category = trim(strip_tags($_GET['masp']));
                } else {
                    $id_category = 0;
                }

                $sql = 'SELECT * FROM sanpham WHERE id_danhmucsp=(SELECT id_danhmucsp FROM sanpham WHERE masp =' . $id_category . ') ORDER BY RAND() LIMIT 4';
                $productList = executeResult($sql);
                //  echo' <h1>'.$sql.'</h1>';
                foreach ($productList as $item) {
                    $anh_sp = str_replace('../assets/uploads/', 'assets/uploads/', $item['anh_sp']);
                ?>
                    <div class="card product-item border-0">
                        <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                            <img class="img-fluid w-100" src="<?php echo $anh_sp; ?>" alt="">
                        </div>
                        <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
                            <h6 class="text-truncate mb-3"><?php echo $item['tensp']; ?></h6>
                            <div class="d-flex justify-content-center">
                                <h6>$123.00</h6>
                                <h6 class="text-muted ml-2"><del><?php echo $item['giathanh']; ?></del></h6>
                            </div>
                        </div>
                        <div class="card-footer d-flex justify-content-between bg-light border">
                            <a href="index.php?controller=shopgrid&action=details&masp=<?php echo $item['masp'];   ?>" class="btn btn-sm text-dark p-0"><i class="fas fa-eye text-primary mr-1"></i>View Detail</a>
                            <a href="" class="btn btn-sm text-dark p-0"><i class="fas fa-shopping-cart text-primary mr-1"></i>Add To Cart</a>
                        </div>
                    </div>
                <?php
                }
                ?>
            </div>
        </div>
    </div>
</div>
<!-- Products End -->