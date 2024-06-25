<?php
$controllers = array(
    'login'       => ['index', 'error'],
    'home'        => ['index', 'error'],
    'taikhoan'    => ['index', 'add', 'add_submit', 'edit', 'edit_submit', 'del', 'detail'],
    'doitac'      => ['index', 'add', 'add_submit', 'edit', 'edit_submit', 'del', 'detail'],
    'nhomsp'      => ['index', 'add', 'add_submit', 'edit', 'edit_submit', 'del', 'detail'],
    'sanpham'     => ['index', 'add', 'add_submit', 'edit', 'edit_submit', 'del', 'detail'],
    'donhang'     => ['index', 'edit'],
    'admin'       => ['login', 'logout'], // Thêm các action của admin
    // 'banner'      =>['index', 'add', 'add_submit', 'edit', 'edit_submit', 'del', 'detail'],
    'doanhthu'    =>['index'],
    'tintuc'      =>['index', 'add', 'add_submit', 'edit', 'edit_submit', 'del', 'detail'],
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
