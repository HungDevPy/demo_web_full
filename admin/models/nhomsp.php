<?php
class Nhomsanpham
{
  public $madanhmuc;
  public $tendanhmuc;
  public $loaisanpham;

  function __construct($madanhmuc, $tendanhmuc,$loaisanpham)
  {
    $this->madanhmuc = $madanhmuc;
    $this->tendanhmuc = $tendanhmuc;
    $this->loaisanpham= $loaisanpham;
  }

  static function get_all()
  {
    $list = [];
    $db = DB::getInstance();
    $req = $db->query('SELECT * FROM danhmuc');

    foreach ($req->fetchAll() as $item) {
      $list[] = new Nhomsanpham($item['madanhmuc'], $item['tendanhmuc'], $item['loaisanpham']);
    }

    return $list;
  }
  static function get_bymadanhmuc($madanhmuc)
  {
    $db = DB::getInstance();
    $req = $db->prepare('SELECT * FROM danhmuc WHERE madanhmuc = :madanhmuc');
    $req->execute(array('madanhmuc' => $madanhmuc));

    $item = $req->fetch();
    if (isset($item['madanhmuc'])) {
      return new Nhomsanpham($item['madanhmuc'], $item['tendanhmuc'], $item['loaisanpham']);
    }
    return null;
  }
  function add_bymadanhmuc()
  {
    $db = DB::getInstance();
    $sql = "INSERT INTO danhmuc( madanhmuc, tendanhmuc,loaisanpham)
     VALUES ('','$this->tendanhmuc','$this->loaisanpham')";
    return $db->exec($sql);
  }

  function update()
  {
      $db = DB::getInstance();
      $sql = 'UPDATE danhmuc SET tendanhmuc="' . $this->tendanhmuc . '",loaisanpham="' . $this->loaisanpham . '" WHERE madanhmuc=' . $this->madanhmuc;
      // echo "SQL: " . $sql . "<br>"; // Ghi log câu lệnh SQL
      $result = $db->exec($sql);
      // echo "Result: " . $result . "<br>"; 
      return $result;
  }
  static function delete($madanhmuc)
  {
    $db = DB::getInstance();
    $sql = "DELETE FROM danhmuc WHERE madanhmuc='$madanhmuc' ";
    return $db->exec($sql);
  }
}
