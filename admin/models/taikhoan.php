<?php
class Taikhoan
{
  public $tendangnhap;
  public $matkhau;
  public $email;

  function __construct($tendangnhap, $matkhau, $email)
  {
    $this->tendangnhap = $tendangnhap;
    $this->matkhau = $matkhau;
    $this->email = $email;
  }

  static function get_all()
  {
    $list = [];
    $db = DB::getInstance();
    $req = $db->query('SELECT * FROM taikhoan');

    foreach ($req->fetchAll() as $item) {
      $list[] = new Taikhoan($item['username'], $item['password'], $item['mail']);
    }

    return $list;
  }
  static function get_byid($username)
  {
    $db = DB::getInstance();
    $req = $db->prepare('SELECT * FROM taikhoan WHERE username = :username');
    $req->execute(array('username' => $username));

    $item = $req->fetch();
    if (isset($item['username'])) {
      return new Taikhoan($item['username'], $item['password'], $item['mail']);
    }
    return null;
  }
  function add_byid()
  {
    $db = DB::getInstance();
    $sql = "INSERT INTO `taikhoan`(`mail`, `username`, `password`)
     VALUES ('$this->email','$this->tendangnhap','$this->matkhau')";
    return $db->exec($sql);
  }
  function insert()
  {
    $db = DB::getInstance();
    $sql = "INSERT INTO `taikhoan`(`mail`, `username`, `password`)
         VALUES ('$this->email','$this->tendangnhap', '$this->matkhau')";
    return $db->exec($sql);
  }
  function update()
  {
    $db = DB::getInstance();
    $sql = "UPDATE taikhoan SET           
     password  = '$this->matkhau',    
     mail ='$this->email' 
     WHERE username = '$this->tendangnhap' ";
    return $db->exec($sql);
  }
  static function delete($tendangnhap)
  {
    $db = DB::getInstance();
    $sql = "DELETE FROM taikhoan WHERE username='$tendangnhap' ";
    return $db->exec($sql);
  }
}
