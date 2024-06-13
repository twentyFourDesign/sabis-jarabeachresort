<?php require "../admintool/system/config/configure.php";

$proids=$_REQUEST['mid'];

if($proids!='') {
    if (is_array($_SESSION['cart'])) {
        $pkey = array_search($proids,array_column($_SESSION['cart'], 'product_id'),true);
        if($pkey !== false) {
            unset($_SESSION['cart'][$pkey]);
            $_SESSION['cart'] = array_values($_SESSION['cart']);
            echo "Removed.";
        } else {
            echo 'No';
        }
    } else {
        echo 'No';
    }
}

?>