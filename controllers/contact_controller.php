<?php
require_once('controllers/base_controller.php');

class ContactController extends BaseController
{
  function __construct()
  {
    $this->folder = 'contact'; 
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