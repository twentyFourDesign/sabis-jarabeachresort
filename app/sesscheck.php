<?php require "admintool/system/config/configure.php"; 
if($_REQUEST['sabis']=='sab') { $_SESSION['sabis']='sab'; ?>
    <script>window.location='index.php';</script>
<?php } else { ?>
    <script>window.location='https://www.google.com';</script>
<?php } ?>