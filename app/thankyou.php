<?php require "admintool/system/config/configure.php"; ?>
<!DOCTYPE html>
<html lang="en">
<?php include "include/head.php";

if(!isset($_SESSION['cart'])) {
} else {
    foreach($_SESSION['cart'] as $key => $value) {
        $proids.=$value['product_id'].',';
    }
}
$row = $dbobj -> select("SELECT * FROM menu_item where MI_Id IN ('".str_replace(",","','",rtrim($proids,','))."') and MI_Status='Active' order by MI_Sort ASC");
    if(count($row)>0){ 
    	for($t=0;$t<count($row);$t++) {
    	$pkey = array_search($row[$t]['MI_Id'],array_column($_SESSION['cart'], 'product_id'),true);
        if($pkey !== false) {
	        $miqty = $_SESSION['cart'][$pkey]['quantity'];
	    } else {
	        $miqty = 0;
	    }
	    $cmiqty='';
	    if($row[$t]['MI_Qty']!='') {
            if($row[$t]['MI_Qty']>20) {
                    $rwqty=20;
                } else {
                    $rwqty=$row[$t]['MI_Qty'];
                }                
    	    for ($x1 = 0; $x1 <= $rwqty; $x1++) {    	    
    	        if($miqty==$x1) {
    	            $cmiqty .= '<option selected value="'.$x1.'">'.$x1.'</option>';   
    	        } else {
    	            $cmiqty .= '<option value="'.$x1.'">'.$x1.'</option>';
    	        }
    	    }
    	} else {
    	    for ($x = 0; $x <= 10; $x++) {
    	        if($miqty==$x) {
    	            $cmiqty .= '<option selected value="'.$x.'">'.$x.'</option>';
    	        } else {
    	            $cmiqty .= '<option value="'.$x.'">'.$x.'</option>';
    	        }
    	    }
        }
	   $htmlmi.='<div class="mi_inner_cart"><div class="mi_full" style="display: flex; "><h4 class="mititle">'.$row[$t]['MI_Title'].'</h4><p class="miprice2" style="position: relative;left: -60px;top: 40px;">'.$curr.number_format($row[$t]['MI_Cost'],2).'</p><div class="qtybox"><select name="miqty" id="miqty-'.$row[$t]['MI_Id'].'" class="miqty" style="position: relative;top: 40px;left:-50px;" data-id="'.$row[$t]['MI_Id'].'">'.$cmiqty.'</select></div><div class="clear"></div></div></div>';
	}
}
?>
<body>
    <?php include "include/header.php"; ?>
    <div class="thkbg">
        <img class="ticklogo" src="assets/images/thkylogo.png" />
        <img class="tlogo" src="assets/images/logo.png" style="width: 120px;" />
        <h4>Thank you, your order has been placed.<br><br>We look forward to serving you.</h4>
        <!--<h4>Your Order:</h4>
         <div class="osmilist">
            <?//=$htmlmi;?>
        </div>-->
        <img class="tplogo" src="assets/images/powerdlogo.png" style="width: 140px; "/>
        <h5 class="flwusti">Follow us on</h5>
        <a target="_blank" href="https://www.instagram.com/jarabeachresortng/"><img class="instlogo" src="assets/images/instalogo.png" style="width: 50px;display: inline-block;margin-right: 10px;" /></a>&nbsp;&nbsp;<a target="_blank" href="https://www.facebook.com/jarabeachresortnigeria"><img class="instlogo" src="assets/images/facebook.png" style="width: 50px;display: inline-block;" /></a>
        <!--<h6 class="instalink"><a target="_blank" href="https://www.instagram.com/jarabeachresortng/">@jarabeachresortng</a></h6>-->
    </div>
<?php include "include/footer.php"; 
unset($_SESSION['cart']);
unset($_SESSION['ccode']);
unset($_SESSION['cdist']);
unset($_SESSION['cdis']);
unset($_SESSION['allegy']);
unset($_SESSION['orins']);
unset($_SESSION['whereeat']);
unset($_SESSION['whattime']);	
unset($_SESSION['dtype']);?>
</body>


</html>