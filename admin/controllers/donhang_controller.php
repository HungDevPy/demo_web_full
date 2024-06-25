<?php
require_once('controllers/base_controller.php');
require_once('models/donhang.php');
require_once('models/db.php');

class DonhangController extends BaseController
{
    function __construct()
    {
        $this->folder = 'donhang'; //Tên thư mục của module home trong view
    }
    public function index()
    {
        // $donhang = Donhang::get_all();
        //  
        $this->render('index');
    }
    public function edit()
    {
        // $donhang = Donhang::get_all();
        //  
        $this->render('edit');
    }

}
