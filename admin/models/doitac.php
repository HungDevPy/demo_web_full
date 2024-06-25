<?php
class Doitac
{
  public $id_doitac;
  public $name_doitac;
  public $email_doitac;
  public $phone_doitac;
  public $address_doitac;
  public $website_doitac;

  function __construct($id_doitac,$name_doitac,$email_doitac,$phone_doitac,$address_doitac,$website_doitac)
  {
    $this->id_doitac = $id_doitac;
    $this->name_doitac = $name_doitac;
    $this->email_doitac = $email_doitac;
    $this->phone_doitac = $phone_doitac;
    $this->address_doitac = $email_doitac;
    $this->website_doitac = $website_doitac;
  }

  static function get_all()
  {
    $list = [];
    $db = DB::getInstance();
    $req = $db->query('SELECT * FROM doitac');

    foreach ($req->fetchAll() as $item) {
      $list[] = new doitac($item['id_doitac'], $item['name_doitac'], $item['email_doitac'], $item['phone_doitac'], $item['address_doitac'], $item['website_doitac']);
    }

    return $list;
  }
  static function get_byid($id_doitac)
  {
    $db = DB::getInstance();
    $req = $db->prepare('SELECT * FROM doitac WHERE id_doitac = :id_doitac');
    $req->execute(array('id_doitac' => $id_doitac));

    $item = $req->fetch();
    if (isset($item['id_doitac'])) {
      return new doitac($item['id_doitac'],$item['name_doitac'], $item['email_doitac'], $item['phone_doitac'], $item['address_doitac'], $item['website_doitac']);
    }
    return null;
  }
  function add_byid()
  {
    $db = DB::getInstance();
    $sql = "INSERT INTO `doitac`(`id_doitac`, `name_doitac`, `email_doitac`, `phone_doitac`, `address_doitac`, `website_doitac`)
     VALUES ('','$this->name_doitac','$this->email_doitac','$this->phone_doitac','$this->address_doitac','$this->website_doitac')";
    return $db->exec($sql);
  }
  function insert()
  {
    $db = DB::getInstance();
    $sql = "INSERT INTO `doitac`(`id_doitac`, `name_doitac`, `email_doitac`, `phone_doitac`, `address_doitac`, `website_doitac`)
     VALUES ('','$this->name_doitac','$this->email_doitac','$this->phone_doitac','$this->address_doitac','$this->website_doitac')";
    return $db->exec($sql);
  }
  function update()
  {
    $db = DB::getInstance();
    $sql = "UPDATE doitac SET 
        email_doitac = '$this->email_doitac', 
        phone_doitac = '$this->phone_doitac', 
        address_doitac = '$this->address_doitac', 
        website_doitac = '$this->website_doitac' 
        WHERE id_doitac = '$this->id_doitac'";
    return $db->exec($sql);
  }
  static function delete($id_doitac)
  {
    $db = DB::getInstance();
    $sql = "DELETE FROM doitac WHERE id_doitac='$id_doitac' ";
    return $db->exec($sql);
  }
}
