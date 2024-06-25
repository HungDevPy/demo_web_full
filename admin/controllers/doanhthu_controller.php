<?php
require_once('controllers/base_controller.php');

class DoanhthuController extends BaseController
{
  function __construct()
  {
    $this->folder = 'doanhthu'; 
  }

  public function index()
  {
    $data = array();
    $this->render('index', $data);
  }

  public function error()
  {
    $this->render('error');
  }
}   