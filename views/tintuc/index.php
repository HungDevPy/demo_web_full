<?php
require_once('database/start_session.php');
require_once('database/config.php');
require_once('database/dbhelper.php');
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
<div class="container-fluid bg-secondary mb-5">
    <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
        <h1 class="font-weight-semi-bold text-uppercase mb-3">Tin Tức</h1>
        <div class="d-inline-flex">
            <p class="m-0"><a href="">Trang Chủ</a></p>
            <p class="m-0 px-2">-</p>
            <p class="m-0">Tin Tức</p>
        </div>
    </div>
</div>
<section class="blog spad">
    <div class="container">
        <div class="cate">
            <div class="grid wide">
                <div class="row">
                    <div class="col l-4">
                        <div class="category__news">
                            <div class="category__gr">
                                <h3 class="category__heading">Tin tức nổi bật</h3>
                                <ul class="category__list">
                                    <?php
                                    $sql = "select * from tin_tuc";
                                    $sanpham = executeResult($sql);
                                    foreach ($sanpham as $item) {
                                        $anh_sp = str_replace('../assets/uploads/tintuc/', 'assets/uploads/tintuc/', $item['anh']);
                                        echo '
                                            <li class="category__items">
                                                <img class="category__items-img" src="' . $anh_sp . '" alt="">
                                                <a href="index.php?controller=tintuc&action=docthem&id=' . $item['id'] . '" class="category__items-text">' . $item['tieu_de'] . '</a>
                                            </li>
                                        ';
                                    } ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col l-8">
                        <div class="news-items-container">
                            <?php
                            $sql = "select * from tin_tuc";
                            $sanpham = executeResult($sql);
                            foreach ($sanpham as $item) {
                                $anh_sp = str_replace('../assets/uploads/tintuc/', 'assets/uploads/tintuc/', $item['anh']);
                                $excerpt_length = 300; // Số ký tự bạn muốn hiển thị
                                $excerpt = strlen($item['noi_dung']) > $excerpt_length ? substr($item['noi_dung'], 0, $excerpt_length) . '...' : $item['noi_dung'];
                            ?>
                                <div class="news-items__category">
                                    <div class="news-items">
                                        <img src="<?php echo $anh_sp ?>" alt="news image" class="news-items__img">
                                        <div class="news-items__info">
                                            <a href="index.php?controller=tintuc&action=docthem&id=<?php echo $item['id'] ?>" class="news-items__title"><?php echo $item['tieu_de'] ?></a>
                                            <div class="news-items__permission">
                                                <span class="news-items__permission-team">
                                                    <i class="fa-regular fa-user"></i>
                                                    Admin
                                                </span>
                                                <span class="news-items__permission-date">
                                                    <i class="fa-regular fa-clock"></i>
                                                    <?php echo $item['thoi_gian'] ?>
                                                </span>
                                            </div>
                                            <p class="news-items__msg">
                                                <?php
                                                echo $excerpt
                                                ?>
                                            </p>
                                            <a href="index.php?controller=tintuc&action=docthem&id=<?php echo $item['id'] ?>" class="news-items__links">
                                                Xem thêm
                                                <i class="news-items__links-icon fa-solid fa-arrow-right"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <style>
        .category__news {
            background-color: #f5f5f5;
            border-radius: 10px;
            padding: 20px;
            margin-top: -3px;
            width: 80%;
        }

        .category__gr {
            padding: 12px 20px;
        }

        .category__heading {
            color: #333;
            text-transform: uppercase;
            font-size: 24px;
            margin-bottom: 15px;
            font-weight: 700;
            font-size: 20px;
        }

        .category__list {
            list-style: none;
            padding-left: 0;
        }

        .category__items {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
        }

        .category__items-img {
            width: 100px;
            height: 60px;
            border-radius: 10px;
            object-fit: cover;
            width: 80px;
            /* Giảm kích thước hình ảnh */
            height: 48px;
            /* Giảm kích thước hình ảnh */
        }

        .category__items-text {
            margin-left: 15px;
            text-decoration: none;
            font-size: 16px;
            font-weight: 600;
            color: #333;
            transition: color 0.2s ease-in-out;
            font-size: 14px;
            /* Giảm kích thước font */
        }

        .category__items-text:hover {
            color: #007bff;
        }

        .news-items__heading {
            font-size: 24px;
            text-transform: uppercase;
            font-weight: 700;
            margin-bottom: 20px;
        }

        .news-items__category {
            margin-bottom: 30px;
        }

        .news-items {
            border: 1px solid #ddd;
            border-radius: 10px;
            overflow: hidden;
            transition: box-shadow 0.3s ease-in-out;
        }

        .news-items:hover {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .news-items__img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        .news-items__info {
            padding: 15px;
        }

        .news-items__title {
            font-size: 20px;
            font-weight: 700;
            color: #333;
            text-decoration: none;
            transition: color 0.2s ease-in-out;
        }

        .news-items__title:hover {
            color: #007bff;
        }

        .news-items__permission {
            display: flex;
            justify-content: space-between;
            margin: 10px 0;
            font-size: 14px;
            color: #888;
        }

        .news-items__msg {
            font-size: 16px;
            color: #555;
            margin-bottom: 15px;
        }

        .news-items__links {
            text-decoration: none;
            font-size: 16px;
            font-weight: 700;
            color: #007bff;
            display: inline-flex;
            align-items: center;
            transition: color 0.2s ease-in-out;
        }

        .news-items__links-icon {
            margin-left: 5px;
        }

        .news-items__links:hover {
            color: #0056b3;
        }

        /* Specific layout for three news items */
        @media (min-width: 992px) {
            .news-items-container {
                display: flex;
                flex-wrap: wrap;
                gap: 20px;
            }

            .news-items-container .news-items__category {
                flex: 1 1 48%;
            }

            .news-items-container .news-items__category:nth-child(3) {
                flex: 1 1 100%;
            }
        }
    </style>
</section>