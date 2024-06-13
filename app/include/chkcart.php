<?php require "../admintool/system/config/configure.php";

if(sizeof($_SESSION['cart'])>0) {
    echo 'Yes';
} else {
    echo 'No';
}

?>