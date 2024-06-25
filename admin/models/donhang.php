<?php
class Donhang
{
  public function get_all()
  {
    $db = DB::getInstance();
    $sql = "SELECT * FROM danhmuc";
    return $db->exec($sql);

  }
}
