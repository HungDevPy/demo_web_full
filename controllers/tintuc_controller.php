<?php
require_once('controllers/base_controller.php');

class TintucController extends BaseController
{
  function __construct()
  {
    $this->folder = 'tintuc'; 
  }

  public function index()
  {
    $data = array();
    $this->render('index', $data);
  }
  public function docthem(){
    $data=array();
    $this->render('docthem',$data);
  }

  public function error()
  {
    $this->render('error');
  }
}