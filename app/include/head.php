<?php 
$linkhe2 = $_SERVER['PHP_SELF'];
$link_arrayhe2 = explode('/',$linkhe2);
$pagetit2 = end($link_arrayhe2);
if($_SESSION['sabis']=='sab') { ?>
<?php } else { ?>
   <!-- <script>window.location='https://www.jollofbyjara.com/';</script> -->
<?php } ?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">
    <?php if($pagetit2=='index.php') {
        $pageabt='Home';
    } else if($pagetit2=='table_details.php') {
        $pageabt='Table Selection';
    } else if($pagetit2=='register.php') {
        $pageabt='Register';
    } else if($pagetit2=='topcats.php') {
        $pageabt='Categories';
    } else if($pagetit2=='cats.php') {
        $pageabt='Menu Items';
    } else if($pagetit2=='order.php') {
        $pageabt='Order';
    } else if($pagetit2=='checkout.php') {
        $pageabt='Checkout';
    } else if($pagetit2=='thankyou.php') {
        $pageabt='Order Placed';
    }
    ?>
    <title><?=$pageabt?> | Sabis</title>
    <meta name="keywords" content="Sabis" />
    <meta name="description" content="Sabis">
    <meta name="author" content="Msphere Infotech">
    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="assets/images/icons/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="assets/images/icons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="assets/images/icons/favicon-16x16.png">
    <link rel="manifest" href="assets/images/icons/site.webmanifest">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="assets/style.css">
</head>