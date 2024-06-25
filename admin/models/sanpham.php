<?php
require_once('models/nhomsp.php');
class Sanpham
{
  public $masp;
  public $tensp;
  public $id_danhmucsp;
  public $mota_sp;
  public $chitiet_sp;
  public $anh_sp;
  public $soluong;
  public $giathanh;
  public $nhasx_sp;
  public $thoigiandathang;

  function __construct($masp, $tensp, $id_danhmucsp, $mota_sp, $chitiet_sp, $anh_sp,$soluong,$giathanh, $nhasx_sp, $thoigiandathang)
  {
    $this->masp = $masp;
    $this->tensp = $tensp;
    $this->id_danhmucsp = $id_danhmucsp;
    $this->mota_sp = $mota_sp;
    $this->chitiet_sp = $chitiet_sp;
    $this->anh_sp = $anh_sp;
    $this->soluong=$soluong;
    $this->giathanh=$giathanh;
    $this->nhasx_sp = $nhasx_sp;
    $this->thoigiandathang = $thoigiandathang;
  }

  static function get_all()
  {
    $list = [];
    $db = DB::getInstance();
    $req = $db->query('SELECT * FROM sanpham ');

    foreach ($req->fetchAll() as $item) {
      $list[] = new Sanpham($item['masp'], $item['tensp'], $item['id_danhmucsp'], $item['mota_sp'], $item['chitiet_sp'], $item['anh_sp'],$item['soluong'],$item['giathanh'], $item['nhasx_sp'], $item['thoigiandathang']);
    }

    return $list;
  }
  static function get_byid($masp)
  {
    $db = DB::getInstance();
    $req = $db->prepare('SELECT * FROM sanpham WHERE masp = :masp');
    $req->execute(array('masp' => $masp));

    $item = $req->fetch();
    if (isset($item['masp'])) {
      return new Sanpham($item['masp'], $item['tensp'], $item['id_danhmucsp'], $item['mota_sp'], $item['chitiet_sp'], $item['anh_sp'], $item['soluong'],$item['giathanh'], $item['nhasx_sp'], $item['thoigiandathang']);
    }
    return null;
  }
  function add_byid()
{
    $db = DB::getInstance();
    $target_dir = "../assets/uploads/";
    $filename = basename($this->anh_sp['name']);
    $target_file = $target_dir . $filename;

    if (move_uploaded_file($this->anh_sp['tmp_name'], $target_file)) {
        // Kiểm tra xem nhasx_sp có tồn tại trong danh sách mã danh mục hay không
        $sql_check = 'SELECT * FROM danhmuc WHERE madanhmuc = ?';
        $stmt_check = $db->prepare($sql_check);
        $stmt_check->execute([$this->nhasx_sp]);
        $row_count = $stmt_check->rowCount();

        if ($row_count > 0) {
            $sql = 'INSERT INTO `sanpham`(`tensp`, `id_danhmucsp`, `mota_sp`, `chitiet_sp`, `anh_sp`, `soluong`, `giathanh`, `nhasx_sp`, `thoigiandathang`)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)';
            $stmt = $db->prepare($sql);
            $stmt->execute([$this->tensp, $this->id_danhmucsp, $this->mota_sp, $this->chitiet_sp, $target_file, $this->soluong,$this->giathanh, $this->nhasx_sp, $this->thoigiandathang]);

            return true;
        } else {
            throw new Exception("Invalid nhasx_sp value. It does not exist in the danhmuc table.");
        }
    } else {
        throw new Exception("Error moving uploaded file.");
    }
}
public function update()
{
    $db = DB::getInstance();
    $target_dir = "../assets/uploads/";
    $filename = basename($this->anh_sp['name']);
    $target_file = $target_dir . $filename;

    if (move_uploaded_file($this->anh_sp['tmp_name'], $target_file)) {
        // Kiểm tra xem nhasx_sp có tồn tại trong danh sách mã danh mục hay không
        $sql_check = 'SELECT * FROM danhmuc WHERE madanhmuc = ?';
        $stmt_check = $db->prepare($sql_check);
        $stmt_check->execute([$this->nhasx_sp]);
        $row_count = $stmt_check->rowCount();

        if ($row_count > 0) {
            $sql = 'UPDATE sanpham SET tensp=?, id_danhmucsp=?, mota_sp=?, chitiet_sp=?, anh_sp=?, soluong=?,giathanh=?, nhasx_sp=?, thoigiandathang=? WHERE masp=?';
            $stmt = $db->prepare($sql);
            $stmt->execute([$this->tensp, $this->id_danhmucsp, $this->mota_sp, $this->chitiet_sp, $target_file, $this->soluong,$this->giathanh, $this->nhasx_sp, $this->thoigiandathang, $this->masp]);

            return true;
        } else {
            return "Invalid nhasx_sp value. It does not exist in the danhmuc table.";
        }
    } else {
        return "Error moving uploaded file.";
    }
}
 static function delete($masp)
  {
    $db = DB::getInstance();
    $sql = "DELETE FROM sanpham WHERE masp='$masp' ";
    return $db->exec($sql);
  }
}   

