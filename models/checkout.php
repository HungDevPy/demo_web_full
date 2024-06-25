<?php
class Checkout
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
    static function check()
    {
        $idList = [];
        foreach ($cart as $item) {
            $idList[] = $item['masp'];
        }
        if (count($idList) > 0) {
            $idList = implode(',', $idList); // chuyeern
            //[2, 5, 6] => 2,5,6

            $sql = "select * from sanpham where masp in ($idList)";
            $cartList = executeResult($sql);
        } else {
            $cartList = [];
        }
    }
}
