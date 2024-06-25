<?php
$controller = isset($_GET['controller']) ? $_GET['controller'] : '';
$action = isset($_GET['action']) ? $_GET['action'] : '';
$checkUseLayout = true;

// if ($controller == 'shopcart' && $action == 'checkout') {
//     $checkUseLayout = false;
// }
// if ($checkUseLayout) {
//     include('header.php');
// }
include('header.php')
 ?>
 
<!-- Page Heading -->
<div>
<?= @$content ?>
</div>
    <!-- Blog Section End -->
<?php 
if ($checkUseLayout) {
    include('footer.php');
}
?>