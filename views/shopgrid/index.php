<!-- <?php
        require_once('database/start_session.php');
        require_once('database/config.php');
        require_once('database/dbhelper.php');
        require_once('models/shopgrid.php');
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
        }
        ?> -->
<!-- Navbar Start -->
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
<!-- Navbar End -->
<!-- Page Header Start -->
<div class="container-fluid bg-secondary mb-5">
    <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 158px">
        <h1 class="font-weight-semi-bold text-uppercase mb-3">Sản Phẩm</h1>
        <!-- <div class="d-inline-flex">
            <p class="m-0"><a href="">Trang Chủ</a></p>
            <p class="m-0 px-2">-</p>
            <p class="m-0">Sẩn Phẩm</p>
        </div> -->
    </div>
</div>
<!-- Shop Start -->
<div class="container-fluid pt-5">
    <div class="row px-xl-5">
        <!-- Shop Sidebar Start -->
        <div class="col-lg-3 col-md-12">
            <!-- Price Start -->
            <div class="border-bottom mb-4 pb-4">
                <h5 class="font-weight-semi-bold mb-4">Lọc Theo Giá</h5>
                <form>
                    <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                        <input type="checkbox" class="custom-control-input" checked id="price-all">
                        <label class="custom-control-label" for="price-all">All Price</label>
                        <span class="badge border font-weight-normal">1000</span>
                    </div>
                    <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                        <input type="checkbox" class="custom-control-input" id="price-1">
                        <label class="custom-control-label" for="price-1">$0 - $100</label>
                        <span class="badge border font-weight-normal">150</span>
                    </div>
                    <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                        <input type="checkbox" class="custom-control-input" id="price-2">
                        <label class="custom-control-label" for="price-2">$100 - $200</label>
                        <span class="badge border font-weight-normal">295</span>
                    </div>
                    <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                        <input type="checkbox" class="custom-control-input" id="price-3">
                        <label class="custom-control-label" for="price-3">$200 - $300</label>
                        <span class="badge border font-weight-normal">246</span>
                    </div>
                    <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                        <input type="checkbox" class="custom-control-input" id="price-4">
                        <label class="custom-control-label" for="price-4">$300 - $400</label>
                        <span class="badge border font-weight-normal">145</span>
                    </div>
                    <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between">
                        <input type="checkbox" class="custom-control-input" id="price-5">
                        <label class="custom-control-label" for="price-5">$400 - $500</label>
                        <span class="badge border font-weight-normal">168</span>
                    </div>
                </form>
            </div>
            <!-- Price End -->

            <!-- Color Start -->
            <div class="border-bottom mb-4 pb-4">
                <h5 class="font-weight-semi-bold mb-4">Lọc Theo Màu</h5>
                <form>
                    <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                        <input type="checkbox" class="custom-control-input" checked id="color-all">
                        <label class="custom-control-label" for="price-all">All Color</label>
                        <span class="badge border font-weight-normal">1000</span>
                    </div>
                    <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                        <input type="checkbox" class="custom-control-input" id="color-1">
                        <label class="custom-control-label" for="color-1">Black</label>
                        <span class="badge border font-weight-normal">150</span>
                    </div>
                    <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                        <input type="checkbox" class="custom-control-input" id="color-2">
                        <label class="custom-control-label" for="color-2">White</label>
                        <span class="badge border font-weight-normal">295</span>
                    </div>
                    <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                        <input type="checkbox" class="custom-control-input" id="color-3">
                        <label class="custom-control-label" for="color-3">Red</label>
                        <span class="badge border font-weight-normal">246</span>
                    </div>
                    <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                        <input type="checkbox" class="custom-control-input" id="color-4">
                        <label class="custom-control-label" for="color-4">Blue</label>
                        <span class="badge border font-weight-normal">145</span>
                    </div>
                    <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between">
                        <input type="checkbox" class="custom-control-input" id="color-5">
                        <label class="custom-control-label" for="color-5">Green</label>
                        <span class="badge border font-weight-normal">168</span>
                    </div>
                </form>
            </div>
            <!-- Color End -->

            <!-- Size Start -->
            <div class="mb-5">
                <h5 class="font-weight-semi-bold mb-4">Lọc Theo Kích Cỡ</h5>
                <form>
                    <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                        <input type="checkbox" class="custom-control-input" checked id="size-all">
                        <label class="custom-control-label" for="size-all">All Size</label>
                        <span class="badge border font-weight-normal">1000</span>
                    </div>
                    <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                        <input type="checkbox" class="custom-control-input" id="size-1">
                        <label class="custom-control-label" for="size-1">XS</label>
                        <span class="badge border font-weight-normal">150</span>
                    </div>
                    <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                        <input type="checkbox" class="custom-control-input" id="size-2">
                        <label class="custom-control-label" for="size-2">S</label>
                        <span class="badge border font-weight-normal">295</span>
                    </div>
                    <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                        <input type="checkbox" class="custom-control-input" id="size-3">
                        <label class="custom-control-label" for="size-3">M</label>
                        <span class="badge border font-weight-normal">246</span>
                    </div>
                    <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                        <input type="checkbox" class="custom-control-input" id="size-4">
                        <label class="custom-control-label" for="size-4">L</label>
                        <span class="badge border font-weight-normal">145</span>
                    </div>
                    <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between">
                        <input type="checkbox" class="custom-control-input" id="size-5">
                        <label class="custom-control-label" for="size-5">XL</label>
                        <span class="badge border font-weight-normal">168</span>
                    </div>
                </form>
            </div>
            <!-- Size End -->
        </div>
        <!-- Shop Sidebar End -->


        <!-- Shop Product Start -->
        <div class="col-lg-9 col-md-12">
            <div class="row pb-3">
                <div class="col-12 pb-1">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <form action="">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Search by name">
                                <div class="input-group-append">
                                    <span class="input-group-text bg-transparent text-primary">
                                        <i class="fa fa-search"></i>
                                    </span>
                                </div>
                            </div>
                        </form>
                        <!-- <div class="dropdown ml-4">
                            <button class="btn border dropdown-toggle" type="button" id="triggerId" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Sort by
                            </button>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="triggerId">
                                <a class="dropdown-item" href="#">Latest</a>
                                <a class="dropdown-item" href="#">Popularity</a>
                                <a class="dropdown-item" href="#">Best Rating</a>
                            </div>
                        </div> -->
                    </div>
                </div>
                <?php
                try {
                    // Số sản phẩm trên mỗi trang và trang hiện tại
                    $limit = 9;
                    $currentPage = isset($_POST['page']) ? $_POST['page'] : 1;
                    $start = ($currentPage - 1) * $limit;
                    $productList = getProductsForPage($currentPage, $limit);
                    foreach ($productList as $item) {
                        $anh_sp = str_replace('../assets/uploads/', 'assets/uploads/', $item['anh_sp']);
                        echo '
    <div class="col-lg-4 col-md-6 col-sm-12 pb-1">
    <form method="post">
        <div class="card product-item border-0 mb-4">
            <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                <img class="img-fluid w-100" src="' . $anh_sp . '" alt="">
            </div>
            <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
                <h6 class="text-truncate mb-3">' . $item['tensp'] . '</h6>
                <div class="d-flex justify-content-center">
                    <h6>' . $item['giathanh'] . 'VND</h6><h6 class="text-muted ml-2"><del>' . $item['giathanh'] . 'VND</del></h6>
                </div>
            </div>
            <div class="card-footer d-flex justify-content-between bg-light border">
                <a href="index.php?controller=shopgrid&action=details&masp=' . $item['masp'] . '" class="btn btn-sm text-dark p-0"><i class="fas fa-eye text-primary mr-1"></i>View Detail</a>
                <input type="hidden" name="pid" value=" ' . $item['masp'] . ' ">
                <i class="fas fa-shopping-cart text-primary mr-1"></i><button class="btn btn-sm text-dark p-0" name="atcbtn">Thêm vào giỏ hàng</button>
            </div>
        </div>
    </form>
    </div>';
                    }
                    $totalProducts = executeSingleResult("SELECT COUNT(*) as total FROM sanpham")['total'];
                    $totalPages = ceil($totalProducts / $limit);
                    // Display pagination links
                    echo '<div class="col-12 pb-1">';
                    echo '<nav aria-label="Page navigation">';
                    echo '<ul class="pagination justify-content-center mb-3">';
                    // Previous page link
                    if ($currentPage > 1) {
                        $previousPage = $currentPage - 1;
                        echo '<li class="page-item"><a class="page-link" href="javascript:void(0);" onclick="goToPage(' . $previousPage . ')" aria-label="Previous"><span aria-hidden="true">&laquo;</span><span class="sr-only">Previous</span></a></li>';
                    } else {
                        echo '<li class="page-item disabled"><span class="page-link" aria-hidden="true">&laquo;</span></li>';
                    }
                    // Page numbers
                    for ($i = 1; $i <= $totalPages; $i++) {
                        echo '<li class="page-item' . ($currentPage == $i ? ' active' : '') . '"><a class="page-link" href="javascript:void(0);" onclick="getPage(' . $i . ')">' . $i . '</a></li>';
                    }
                    // Next page link
                    if ($currentPage < $totalPages) {
                        $nextPage = $currentPage + 1;
                        echo '<li class="page-item"><a class="page-link" href="javascript:void(0);" onclick="goToPage(' . $nextPage . ')" aria-label="Next"><span aria-hidden="true">&raquo;</span><span class="sr-only">Next</span></a></li>';
                    } else {
                        echo '<li class="page-item disabled"><span class="page-link" aria-hidden="true">&raquo;</span></li>';
                    }

                    echo '</ul>';
                    echo '</nav>';
                    echo '</div>';
                } catch (Exception $e) {
                    die("Lỗi thực thi SQL: " . $e->getMessage());
                }
                ?>
                <form id="paginationForm" method="post">
                    <!-- Thêm vào các trường ẩn cần thiết -->
                    <input type="hidden" id="currentPage" name="page" value="<?php echo $currentPage; ?>">
                </form>

                <!-- Thêm vào phần body của trang HTML của bạn -->
                <!-- <div class="product__pagination">
                    <?php
                    $totalProducts = executeSingleResult("SELECT COUNT(*) as total FROM sanpham")['total'];
                    $totalPages = ceil($totalProducts / $limit);

                    // Liên kết "Previous"
                    if ($currentPage > 1) {
                        $previousPage = $currentPage - 1;
                        echo '<a href="javascript:void(0);" onclick="goToPage(' . $previousPage . ')"><i class="fa fa-long-arrow-left"></i></a>';
                    }

                    // Liên kết trang
                    for ($i = 1; $i <= $totalPages; $i++) {
                        if ($i == $currentPage) {
                            echo '<span class="current-page">' . $i . '</span>';
                        } else {
                            echo '<a href="javascript:void(0);" onclick="goToPage(' . $i . ')">' . $i . '</a>';
                        }
                    }
                    // Liên kết "Next"
                    if ($currentPage < $totalPages) {
                        $nextPage = $currentPage + 1;
                        echo '<a href="javascript:void(0);" onclick="goToPage(' . $nextPage . ')"><i class="fa fa-long-arrow-right"></i></a>';
                    }
                    ?>
                </div> -->

            </div>
        </div>
        <!-- Shop Product End -->
    </div>
</div>
<!-- Shop End -->