<?php
class Login
{
    public $username;
    public $password;
    public $email;

    function __construct($username, $password, $email)
    {
        $this->username = $username;
        $this->password = $password;
        $this->email = $email;
    }
    static function get_all()
    {
    $list = [];
    $db = DB::getInstance();
    $req = $db->query('SELECT * FROM taikhoan');

    foreach ($req->fetchAll() as $item) {
      $list[] = new Login($item['username'],$item['password'], $item['email'] );
    }

    return $list;
  }
}
