<?php //print_r($_SESSION);
if(isset($_SESSION['adminuser']) && basename($_SERVER['REQUEST_URI'])=='index.php') {
    ?><script>window.location='dashboard.php';</script><?php
} else if(!isset($_SESSION['adminuser'])) {
    ?><script>//window.location='index.php';</script><?php
}
?>