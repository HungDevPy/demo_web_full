<?php
require_once('database/config.php');
require_once('database/dbhelper.php');
require_once('database/start_session.php');
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $news_id = isset($_POST['news_id']) ? $_POST['news_id'] : 0;
    $user_id = isset($_SESSION['username']) ? $_SESSION['username'] : 0;
    $content = isset($_POST['content']) ? $_POST['content'] : '';
    $thoiGian = date('Y-m-d H:i:s');
    if ($news_id != 0 && $user_id != 0 && !empty($content)) {
        $sql = "INSERT INTO `binh_luan`(`id_tintuc`, `noi_dung`, `thoi_gian`, `nguoi_dang`) VALUES ('$news_id','$content','$thoiGian','$user_id' )";
        execute($sql);
    }
}
$matintuc = isset($_GET['id']) ? $_GET['id'] : 1;
$sql = "SELECT binh_luan.*, taikhoan.username 
FROM binh_luan 
INNER JOIN taikhoan ON binh_luan.nguoi_dang = taikhoan.username 
WHERE binh_luan.id_tintuc = $matintuc
ORDER BY binh_luan.thoi_gian DESC;";
$comments = executeResult($sql);
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
<!-- Blog Details Section Begin -->
<section class="blog-details spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-5 order-md-1 order-2">
                <div class="blog__sidebar">
                    <div class="blog__sidebar__item">
                        <h4>Tin tức gần đây</h4>
                        <div class="blog__sidebar__recent">
                            <?php
                            $sql = "select * from tin_tuc";
                            $sanpham = executeResult($sql);
                            foreach ($sanpham as $item) {
                                $anh_sp = str_replace('../assets/uploads/tintuc/', 'assets/uploads/tintuc/', $item['anh']);
                                echo '
                            <a href="index.php?controller=tintuc&action=docthem&id=' . $item['id'] . '" class="blog__sidebar__recent__item">
                                <div class="blog__sidebar__recent__item__pic">
                                    <img src="' . $anh_sp . '" alt="">
                                </div>
                                <div class="blog__sidebar__recent__item__text">
                                    <h6>' . $item['tieu_de'] . '</h6>
                                    <span>' . $item['thoi_gian'] . '</span>
                                </div>
                            </a>';
                            } ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-8 col-md-7 order-md-1 order-1">
                <?php
                $matintuc = isset($_GET['id']) ? $_GET['id'] : 1;
                $sql = "SELECT * FROM tin_tuc WHERE id=$matintuc";
                $tintuc = executeResult($sql);
                foreach ($tintuc as $item);
                $anh_sp = str_replace('../assets/uploads/tintuc/', 'assets/uploads/tintuc/', $item['anh']);
                ?>
                <div class="blog__details__text">
                    <img src="<?php echo $anh_sp ?>" alt="" class="blog__details__img">
                    <h3><?php echo $item['tieu_de'] ?></h3>
                    <p><?php echo nl2br($item['noi_dung']) ?></p>
                </div>
                <div class="blog__details__content">
                    <div class="row">
                        <?php foreach ($comments as $comment) { ?>
                            <div class="col-12">
                                <div class="comment">
                                    <div class="comment-avatar">
                                        <img class="avatarComment" src="assets/uploads/tintuc/user.png" alt="user avatar">
                                    </div>
                                    <div class="comment-content">
                                        <h5><?php echo $comment['username']; ?></h5>
                                        <p><?php echo nl2br($comment['noi_dung']); ?></p>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                        <div class="col-12 load-comment-content">
                            <div class="content-body-comment-area">
                                <form action="index.php?controller=tintuc&action=docthem&id=<?php echo $matintuc; ?>" method="POST">
                                    <div class="form-group">
                                        <textarea class="form-control commentContent" id="commentContent" rows="5" name="content" placeholder="Nhập nội dung bình luận ..."></textarea>
                                        <input type="hidden" name="news_id" value="<?php echo $matintuc; ?>">
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary btn-submit-comment">Gửi</button>
                                    </div>
                                    <div id="comment-message-alert"></div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <style>
                        .blog__details__img {
                            width: 100%;
                            height: auto;
                            border-radius: 10px;
                            margin-bottom: 20px;
                        }

                        .blog__details__text h3 {
                            font-size: 28px;
                            font-weight: bold;
                            color: #333;
                            margin-bottom: 15px;
                        }

                        .blog__details__text p {
                            font-size: 16px;
                            line-height: 1.6;
                            color: #555;
                            margin-bottom: 20px;
                        }

                        .blog__sidebar h4 {
                            font-size: 24px;
                            font-weight: bold;
                            margin-bottom: 20px;
                            color: #333;
                        }

                        .blog__sidebar__recent__item {
                            display: flex;
                            margin-bottom: 20px;
                            text-decoration: none;
                            color: #333;
                        }

                        .blog__sidebar__recent__item__pic img {
                            width: 80px;
                            height: 80px;
                            border-radius: 10px;
                            object-fit: cover;
                            margin-right: 15px;
                        }

                        .blog__sidebar__recent__item__text {
                            flex: 1;
                        }

                        .blog__sidebar__recent__item__text h6 {
                            font-size: 16px;
                            font-weight: bold;
                            margin-bottom: 5px;
                        }

                        .blog__sidebar__recent__item__text span {
                            font-size: 14px;
                            color: #999;
                        }

                        .body-comment-area {
                            display: flex;
                            align-items: flex-start;
                            margin-top: 20px;
                        }

                        .image-body-comment-area {
                            margin-right: 15px;
                        }

                        .content-body-comment-area {
                            flex: 1;
                        }

                        .form-control {
                            border-radius: 5px;
                            border: 1px solid #ccc;
                            padding: 10px;
                            width: 100%;
                            resize: none;
                        }

                        .btn-submit-comment {
                            background-color: #007bff;
                            border: none;
                            color: white;
                            padding: 10px 20px;
                            border-radius: 5px;
                            cursor: pointer;
                        }

                        .btn-submit-comment:hover {
                            background-color: #0056b3;
                        }

                        .comment {
                            display: flex;
                            margin-bottom: 20px;
                        }

                        .comment-avatar {
                            margin-right: 15px;
                        }

                        .comment-avatar img {
                            width: 50px;
                            height: 50px;
                            border-radius: 50%;
                        }

                        .comment-content {
                            flex: 1;
                        }

                        .comment-content h5,
                        .comment-content p,
                        .comment-content span {
                            display: block;
                            margin-bottom: 5px;
                        }

                        .comment-content h5 {
                            font-size: 18px;
                            font-weight: bold;
                        }

                        .comment-content p {
                            font-size: 16px;
                            color: #555;
                            
                        }

                        .comment-content span {
                            font-size: 14px;
                            color: #999;
                        }
                    </style>
                </div>
            </div>
        </div>
    </div>
    </div>
</section>
<!-- Blog Details Section End -->