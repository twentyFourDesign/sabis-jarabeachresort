<?php require "../admintool/system/config/configure.php";

$proids=$_REQUEST['mid'];

if($proids!='') {
    if (is_array($_SESSION['cart'])) {
        $pkey = array_search($proids,array_column($_SESSION['cart'], 'product_id'),true);
        if($pkey !== false) {
            echo 'Yes';
        } else {
            echo 'No';
        }
    } else {
        echo 'No';
    }
}

?>