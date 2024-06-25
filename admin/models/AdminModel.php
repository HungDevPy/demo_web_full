<?php
// AdminModel.php
require_once('models/db.php');
class AdminModel
{
    public $tendangnhap;
    public $matkhau;

    public function checkLogin($username, $password)
    {
        try {
            // Kết nối cơ sở dữ liệu
            $db = DB::getInstance();

            // Chuẩn bị truy vấn SQL
            $query = "SELECT * FROM admin WHERE user_admin = :username AND password_admin = :password";

            // Chuẩn bị và thực thi câu truy vấn
            $statement = $db->prepare($query);
            $statement->execute(array(  
                ':username' => $username,
                ':password' => $password
            ));

            // Lấy kết quả
            $result = $statement->fetch(PDO::FETCH_ASSOC);

            // Đóng kết nối cơ sở dữ liệu
            $db = null;

            // Kiểm tra kết quả
            if ($result) {
                // Nếu có kết quả, gán các thuộc tính của đối tượng AdminModel từ kết quả
                $this->tendangnhap = $result['user_admin'];
                $this->matkhau = $result['password_admin'];
                return true;
            } else {
                // Nếu không có kết quả, trả về false
                return false;
            }
        } catch (PDOException $e) {
            // Xử lý ngoại lệ nếu có lỗi xảy ra trong quá trình truy vấn
            echo "Lỗi: " . $e->getMessage();
            return false;
        }
    }
}
?>

