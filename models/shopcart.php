<?php
class Shopcart
{
  public $id;
  public $order_id;
  public $product_id;
  public $id_user;
  public $num;
  public $price;
  public $status;

  function __construct($id, $order_id, $product_id, $id_user,$num,$price,$status)
  {
    $this->id = $id;
    $this->order_id = $order_id;
    $this->product_id = $product_id;
    $this->id_user = $id_user;
    $this->num = $num;
    $this->price = $price;
    $this->status = $status;
  }
  static function get_all()
  {
    $list = [];
    $db = DB::getInstance();
    $req = $db->query('SELECT * FROM order_details');

    foreach ($req->fetchAll() as $item) {
      $list[] = new Shopcart($item['id'], $item['order_id'],$item['product_id'],$item['id_user'],$item['num'],$item['price'],$item['status']);
    }
    return $list;
  }
  
}