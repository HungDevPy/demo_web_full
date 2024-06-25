<?php
require_once('controllers/base_controller.php');
require_once('models/db.php');
require_once('models/tintuc.php');

class TintucController extends BaseController
{
    function __construct()
    {
        $this->folder = 'tintuc'; //Tên thư mục của module tintuc trong view
    }

    public function index()
    {
        $tintuc = TinTuc::getAll();
        $data = array('tintuc' => $tintuc);
        $this->render('index', $data);
    }

    public function add()
    {
        // Lấy danh sách nhóm sản phẩm và tin tức
        $tintuc = TinTuc::getAll();
        $data = array('tintuc' => $tintuc);
        $this->render('add', $data);
    }

    public function add_submit()
    {
        // Xử lý thêm tin tức mới
        // Đọc dữ liệu từ biểu mẫu
        $tieuDe = isset($_POST['tieuDe']) ? $_POST['tieuDe'] : '';
        $noiDung = isset($_POST['noiDung']) ? $_POST['noiDung'] : '';
        $anh = isset($_FILES['anh']) ? $_FILES['anh'] : '';
        $thoiGian = date('Y-m-d H:i:s');
        $binhLuan = 0; // Khởi tạo số bình luận là 0
        $username = isset($_SESSION['username']) ? $_SESSION['username'] : '';

        if (!empty($tieuDe) && !empty($noiDung) && !empty($anh)) {
            // Tạo đối tượng TinTuc mới
            $tintuc = new TinTuc(null, $tieuDe, $noiDung, $anh, $thoiGian, $binhLuan, $username);

            try {
                // Thực hiện thêm tin tức
                $result = $tintuc->add();

                if ($result === true) {
                    echo "<script> alert('Thêm tin tức thành công.')</script>";
                } else {
                    echo "<script> alert('Lỗi khi thêm tin tức!');</script>";
                }
            } catch (Exception $e) {
                echo "Error: " . $e->getMessage();
            }

            // Hiển thị lại trang index
            $this->index();
        } else {
            echo "<script> alert('Lỗi: Tiêu đề, nội dung và ảnh không được để trống!');</script>";
            $this->add();
        }
    }

    public function edit()
    {
        // Lấy thông tin tin tức cần sửa
        $tintuc = TinTuc::getById($_GET['id']);
        $data = array('tintuc' => $tintuc);
        $this->render('edit', $data);
    }

    public function edit_submit()
    {
        // Xử lý cập nhật tin tức
        $id = isset($_POST['id']) ? $_POST['id'] : '';
        $tieuDe = isset($_POST['tieuDe']) ? $_POST['tieuDe'] : '';
        $noiDung = isset($_POST['noiDung']) ? $_POST['noiDung'] : '';
        $anh = isset($_FILES['anh']) ? $_FILES['anh'] : '';
        $thoiGian = date('Y-m-d H:i:s');
        $username = isset($_SESSION['username']) ? $_SESSION['username'] : '';

        if (!empty($tieuDe) && !empty($noiDung)) {
            // Tạo đối tượng TinTuc mới
            $tintuc = new TinTuc($id, $tieuDe, $noiDung, $anh, $thoiGian, $username);

            // Thực hiện cập nhật tin tức
            $result = $tintuc->update();

            if ($result === true) {
                echo "<script> alert('Cập nhật tin tức thành công.')</script>";
            } else {
                echo "<script> alert('Lỗi khi cập nhật tin tức!');</script>";
            }

            // Hiển thị lại trang index
            $this->index();
        } else {
            echo "<script> alert
            ('Lỗi: Tiêu đề và nội dung không được để trống!');</script>";
            $this->edit();
        }
    }

    public function del()
    {
        // Xóa tin tức
        $result = TinTuc::delete($_GET['id']);

        if ($result) {
            echo "<script> alert('Xóa tin tức thành công.')</script>";
        } else {
            echo "<script> alert('Lỗi khi xóa tin tức!');</script>";
        }

        // Trở về trang index
        $this->index();
    }
}
