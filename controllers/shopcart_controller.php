<?php
require_once('database/start_session.php');
require_once('controllers/base_controller.php');
require_once('database/config.php');
require_once('database/dbhelper.php');

class ShopcartController extends BaseController
{
    function __construct()
    {
        $this->folder = 'shopcart';
    }

    public function index()
    {
        $data = array();
        $this->render('index', $data);
    }

    public function del()
    {
        $id=$_SESSION['username'];
        // $madonhang=$_SESSION['madonhang'];
        $sql = "DELETE FROM dathang WHERE username = '$id'";
        //  
        $check=execute($sql);
        $this->render('index');
        
    }

    public function checkout()
    {
        $this->render('checkout');
        
    }

    public function order()
    {
        $this->render('order');
        
    }

    public function error()
    {
        $this->render('error');
    }
    public function getall()
    {
        $shopcart = Shopcart::get_all($_GET['id']);
        $data = array('shopcart' => $shopcart);
        $this->render('index', $data);
    }
}
