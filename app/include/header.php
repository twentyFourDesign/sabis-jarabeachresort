<div class="header">
    <?php if($pagetit2=='thankyou.php') { ?>
        <div class="btnlft"><img onclick="window.location='topcats.php'" id="btnbk" src="assets/images/lftarr.png" /></div>
    <?php } else if($pagetit2=='table_details.php') { ?>
        <div class="btnlft"><img onclick="window.location='logout.php'" id="btnbk" src="assets/images/logout.png" /></div>
    <?php } else if($pagetit2=='topcats.php') { ?>
        <div class="btnlft"><img onclick="window.location='logout.php'" id="btnbk" src="assets/images/logout.png" /></div>
    <?php } else if($pagetit2=='cats.php') { ?>
        <div class="btnlft"><img onclick="window.location='topcats.php'" id="btnbk" src="assets/images/lftarr.png" /></div>
    <?php } else { ?>
        <div class="btnlft"><img onclick="history.back()" id="btnbk" src="assets/images/lftarr.png" /></div>
    <?php } ?>
    <h1 class="headtitle"><?=$pageabt;?></h1>
    <?php if($pagetit2=='cats.php') { ?><a class="cart_out" onclick="order()"><img src="assets/images/cartw.png" /></a><?php } ?>
    <div class="imgrgt"><img src="assets/images/tplogo.jpg" /></div>
    <div class="clear"></div>
</div>