<?php
require_once('models/taikhoan.php');

class TinTuc {
    public $id;
    public $tieuDe;
    public $noiDung;
    public $anh;
    public $thoiGian;
    public $username; // Khóa ngoại tham chiếu đến bảng tai khoan

    function __construct($id, $tieuDe, $noiDung, $anh, $thoiGian, $username) {
        $this->id = $id;
        $this->tieuDe = $tieuDe;
        $this->noiDung = $noiDung;
        $this->anh = $anh;
        $this->thoiGian = $thoiGian;
        $this->username = $username;
    }

    public static function getAll() {
        $list = [];
        $db = DB::getInstance();
        $req = $db->query('SELECT * FROM tin_tuc');

        foreach ($req->fetchAll() as $item) {
            $list[] = new TinTuc($item['id'], $item['tieu_de'], $item['noi_dung'], $item['anh'], $item['thoi_gian'], $item['nguoi_dang']);
        }

        return $list;
    }

    public static function getById($id) {
        $db = DB::getInstance();
        $req = $db->prepare('SELECT * FROM tin_tuc WHERE id = :id');
        $req->execute(array('id' => $id));

        $item = $req->fetch();
        if ($item) {
            return new TinTuc($item['id'], $item['tieu_de'], $item['noi_dung'], $item['anh'], $item['thoi_gian'], $item['nguoi_dang']);
        }
        return null;
    }

    public function add() {
        $db = DB::getInstance();
        $target_dir = "../assets/uploads/tintuc/";
    
        // Kiểm tra xem thư mục đích có tồn tại không
        if (!file_exists($target_dir)) {
            mkdir($target_dir, 0777, true); // Tạo thư mục nếu không tồn tại
        }
    
        $filename = basename($this->anh['name']);
        $target_file = $target_dir . $filename;
    
        if (move_uploaded_file($this->anh['tmp_name'], $target_file)) {
            $sql = 'INSERT INTO `tin_tuc`(`tieu_de`, `noi_dung`, `anh`, `thoi_gian`, `nguoi_dang`)
                    VALUES (?, ?, ?, ?, ?)';
            $stmt = $db->prepare($sql);
            $stmt->execute([$this->tieuDe, $this->noiDung, $target_file, $this->thoiGian, 'admin']);
    
            return true;
        } else {
            throw new Exception("Error moving uploaded file.");
        }
    }
    

    public function update() {  
        $db = DB::getInstance();
        $target_dir = "../assets/uploads/tintuc/";
        $filename = basename($this->anh['name']);
        $target_file = $target_dir . $filename;

        if (move_uploaded_file($this->anh['tmp_name'], $target_file)) {
            $sql = 'UPDATE tin_tuc 
                    SET tieu_de=?, noi_dung=?, anh=?, thoi_gian=?, nguoi_dang=? 
                    WHERE id=?';
            $stmt = $db->prepare($sql);
            $stmt->execute([$this->tieuDe, $this->noiDung, $target_file, $this->thoiGian,  'admin', $this->id]);

            return true;
        } else {
            throw new Exception("Error moving uploaded file.");
        }
    }

    public static function delete($id) {
        $db = DB::getInstance();
        $sql = "DELETE FROM tin_tuc WHERE id=?";
        $stmt = $db->prepare($sql);
        $stmt->execute([$id]);
        return true;
    }
}

