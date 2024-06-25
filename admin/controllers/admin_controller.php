<?php
// controllers/AdminController.php
require_once('controllers/base_controller.php');
require_once('models/AdminModel.php');

class AdminController extends BaseController
{
    public function __construct()
    {
        $this->folder = 'admin'; // Thư mục chứa các view của admin
    }

    public function login()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $username = $_POST['username'];
            $password = $_POST['password'];

            $adminModel = new AdminModel();
            $loggedIn = $adminModel->checkLogin($username, $password);

            if ($loggedIn) {
                session_start();
                $_SESSION[$username] = $username;
                header('Location: index.php?controller=home');
                exit;
            } else {
                echo "Tên đăng nhập hoặc mật khẩu không đúng";
            }
        } else {
            require_once('views/admin/login.php');
        }
    }

    public function logout()
    {
        session_start();

        // Unset the 'admin' session variable
        unset($_SESSION['admin']);

        // Redirect the user to the login page
        header('Location: index.php?controller=admin&action=login');
        exit();
    }
}
