<?php require "../admintool/system/config/configure.php";

// Stop duplicate orders: nothing in the cart means this order was already saved.
if(empty($_SESSION['cart'])) { echo 'false'; exit; }
if(is_array($_SESSION['allegy'])) {
    $allegy = implode(', ', $_SESSION['allegy']);
} else {
    $allegy = $_SESSION['allegy'];
}
if($_SESSION['cdis']>0) {
    $discount=$_SESSION['cdis'];
} else {
    $discount=0;
}
if($_SESSION['disval']>0) {
    $discountval=$_SESSION['disval'];
} else {
    $discountval=0;
}

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
			$miopt = $_SESSION['cart'][$pkey]['option'];
	    } else {
	        $miqty = 0;
			$miopt ='';
	    }
			
		$optstr='';
			
		if(!empty($miopt)){
			$optstr='Option: '.get_value('io_title','item_option','io_id',$miopt);
		}
			
	    $cmiqty='';
	    if($row[$t]['MI_Qty']!='') {
            if($row[$t]['MI_Qty']>20) {
                    $rwqty=20;
                } else {
                    $rwqty=$row[$t]['MI_Qty'];
                    $cmiqty=$rwqty;
                }                
    	} else {
    	    for ($x = 0; $x <= 10; $x++) {
    	        if($miqty==$x) {
    	            $cmiqty .= $x;
    	        } 
    	    }
        }
	   $htmlmi.='<div class="mi_inner_cart"><div class="mi_full"><h4 class="mititle">Item Name: '.$row[$t]['MI_Title'].'</h4><p class="miprice2">Item Price: N'.$curr.number_format($row[$t]['MI_Cost'],2).'</p><p class="miprice2">'.$optstr.'</p><div class="qtybox"><p name="miqty" id="miqty-'.$row[$t]['MI_Id'].'" class="miqty" data-id="'.$row[$t]['MI_Id'].'">Quantity: '.$miqty.'</p></div><div class="clear"></div></div></div>';
	}
}
$id = $dbobj -> insert("insert into orders set Ord_TableNo='".implode(",",$_SESSION['tabno'])."', Ord_NoOfGuest='".$_SESSION['noofg']."', Ord_Date='".date('Y-m-d')."', Ord_FirstName='".$_SESSION['memname']."', Ord_Email='".$_SESSION['femail']."', Ord_Phone='".$_SESSION['fphon']."', Ord_Dob='1970-01-01', Ord_Instruction='".$_SESSION['orins']."', Ord_Allergens='".$allegy."', Ord_ServiceCharge='".$_SESSION['servcrg']."', Ord_ConTax='".$_SESSION['conscrg']."', Ord_Vat='".$_SESSION['vatcrg']."', Ord_Total='".floatval($_SESSION['tamt'])."', Ord_VoucherCode='', Ord_DiscountCode='".$_SESSION['ccode']."', Ord_DiscountType='".$_SESSION['cdist']."', Ord_DiscountValue='".$discountval."', Ord_Discount='".$discount."', Ord_Extra='".$_SESSION['extra']."', Ord_GrandTotal='".floatval($_SESSION['gtot'])."', Ord_OrderStatus='1', Ord_PaymentMode='Paystack', Ord_PaymentStatus='Completed', Ord_TransactionID='".$_REQUEST['ref']."', Ord_Time='".date('H:i:s')."', Ord_Status='Active', Ord_DeliveryAddress='".$_SESSION['delivery']."', Ord_Whattime='".$_SESSION['whattime']."', Ord_Whereeat='".$_SESSION['whereeat']."', Ord_Comments='".$_SESSION['comment']."'");
$optionprice = 0;
if($id>0) {
	foreach($_SESSION['cart'] as $key => $value) {
		$pid = $value['product_id'];
		$qtys = $value['quantity'];
		$row = $dbobj -> select("SELECT * FROM menu_item where MI_Id='".$pid."'");
		$price = $row[0]['MI_Cost'];
		if($value['option']!='') { $optinn = $value['option']; } else { $optinn='0'; }
        if(get_value('io_price','item_option','io_id',$value['option'])!='') {
            $optionprice = number_format(get_value('io_price','item_option','io_id',$value['option']));
        }
		$dbobj -> insert("insert into order_item set OI_OrderId='".$id."', OI_ItemId='".$pid."', OI_Cost='".$price."', OI_Quantity='".$qtys."', OI_Status='4', OI_Item_Option='".$optinn."',OI_Icost='".$optionprice."'");

		if($row[0]['MI_Qty']!='') {
			$dbobj->update("update menu_item set MI_Qty = MI_Qty - ".$qtys." where MI_Id='".$pid."'");
		} 
	}

	$name = $_SESSION['memname'];
	$email = $_SESSION['femail'];
	$pricefinal = number_format($_SESSION['gtot'],2);
	$totalvalue = number_format(floatval($_SESSION['tamt']),2);
	$disvalue = number_format($discountval,2);

	$delstr = "";
	if(!empty($_SESSION['delivery'])){
		$delstr = '<br><br>Delivery Address: '.$_SESSION['delivery'];
	}
	
	$emailstr = "";
	if(!empty($_SESSION['femail'])){
		$emailstr = '<br>Email Address: '.$_SESSION['femail'];
	}

	$message22 = 'Thank you for order via SABIS.<br><br><a target=_blank href=https://www.jollofbyjara.com/sabis/><img src=https://sabis.jarabeachresort.com/assets/images/maillogo.jpg /></a><br><br>Your Order Details are shown below: <br><br><a target=_blank href=https://www.jollofbyjara.com/><img style=width:100px src=https://sabis.jarabeachresort.com/assets/images/tplogo.png /></a><br><br>Preferred Name: '.$_SESSION['memname'].$emailstr.'<br>Room(s): '.(is_array($_SESSION['tabno']) ? implode(', ', $_SESSION['tabno']) : $_SESSION['tabno']).'<br>No of Guest: '.$_SESSION['noofg'].'<br><br>Date: '.date('Y-m-d').'<br><br>Your Order: '.$htmlmi.'<br><br>Allergens: '.$allegy.'<br><br>Order Instructions: '.$_SESSION['orins'].$delstr.'<br><br>Service Charge: N'.$_SESSION['servcrg'].'<br>Consumption Tax: N'.$_SESSION['conscrg'].'<br>VAT: N'.$_SESSION['vatcrg'].'<br>Total: N'.$totalvalue.'<br>Discount Value: N'.$disvalue.'<br>Grand Total: N'.$pricefinal.'<br>';
	$to = $_SESSION['femail'];
	$toadmin = get_value('Con_from_Email','configure','Con_Id',1);
	$emailfrm = get_value('Con_from_Email','configure','Con_Id',1);
	$subject = "SABIS | Thank you for your Order @ Jollof by Jara";
	$headers = 'From: '. $emailfrm . "\r\n" .
	'Reply-To: ' . $emailfrm . "\r\n";
	$headers .= 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
	if(!empty($to)) SendMail($to, $emailfrm, $subject, $message22, $headers);
	SendMail($toadmin, $emailfrm, $subject, $message22, $headers);
    
    unset($_SESSION['cart']);
    unset($_SESSION['ccode']);
    unset($_SESSION['cdist']);
    unset($_SESSION['cdis']);
    unset($_SESSION['allegy']);
    unset($_SESSION['orins']);
    unset($_SESSION['dtype']);
    echo 'true';
} else {
    echo 'false';
}

?>
