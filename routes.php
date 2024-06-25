<?php
$controllers = array(
    'home'        => ['index', 'error'],
    'shopgrid'    => ['index', 'get_product', 'details', 'error'],
    'contact'      => ['index', 'error'],
    'checkout'     => ['index', 'add', 'add_submit', 'edit', 'edit_submit', 'del', 'detail'],
    'shopcart'     => ['index', 'getall', 'add_submit', 'edit', 'edit_submit', 'del', 'detail','checkout','order'],
    'login'        =>['index','login','logout','register','resetpass'],
    'tintuc'       =>['index','docthem'],
    'thanhtoan'    =>['index']
);


if (
    !array_key_exists($controller, $controllers)
    || !in_array($action, $controllers[$controller])
) {
    $controller = 'home';
    $action = 'error';
    echo "<script> alert('Không tồn tại controller hoặc action!') </script>";
}


include_once('controllers/' . $controller . '_controller.php');

$klass = str_replace('_', '', ucwords($controller, '_')) . 'Controller';

$controller = new $klass;
$controller->$action();
