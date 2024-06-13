<?php require "admintool/system/config/configure.php";
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

ini_set( 'display_errors', 1 );
error_reporting( E_ALL );
$rand = rand(20,100) ;
$from = "Bookings@jollofbyjara.com";
$to = "suthar.jayanti93@gmail.com";
$subject = "PHP Mail Test script".$rand;
$message = "This is a test to check the PHP Mail functionality".$rand;
$headers = "From:" . $from;
try {
    SendMail($to, $from, $subject,$message, $headers);
} catch (\Exception $e) {
    exit("exception");
}

exit("==== send +++++".$rand);

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
        $htmlmi.='<div class="mi_inner_cart"><div class="mi_full"><h4 class="mititle">'.$row[$t]['MI_Title'].'</h4><p class="miprice2">'.$curr.number_format($row[$t]['MI_Cost'],2).'</p><div class="qtybox"><select name="miqty" id="miqty-'.$row[$t]['MI_Id'].'" class="miqty" data-id="'.$row[$t]['MI_Id'].'">'.$cmiqty.'</select></div><div class="clear"></div></div></div>';
    }
}
//$res=$dbobj -> select("SELECT order_item.OI_ItemId , order_item.OI_Cost, order_item.OI_Quantity from order_item,menu_item where order_item.OI_ItemId=menu_item.MI_Id and order_item.OI_OrderId='".$_SESSION['']."'");

$name = $_SESSION['memname'].' '.$_SESSION['lname'];
$email = $_SESSION['femail'];
$message22 = 'Thank you for order via SABIS.<br><br>Your Order Details are shown below: '.$htmlmi.'
    
    <br><br>First Name: '.$_SESSION['memname'].'<br>Last Name: '.$_SESSION['lname'].'<br>Phone Number: '.$_SESSION['fphon'].'<br>Email Address: '.$_SESSION['femail'].'<br>Table No: '.$_SESSION['tabno'].'<br>No of Guest: '.$_SESSION['noofg'].'<br><br>Date: '.date('Y-m-d').'<br><br>Your Order:<br><br>Allergens: '.$allegy.'<br>Service Charge: '.$_SESSION['servcrg'].'%<br>Consumption Tax: '.$_SESSION['conscrg'].'%<br>VAT: '.$_SESSION['vatcrg'].'%<br>Total: N'.floatval($_SESSION['tamt']).'<br>Discount Value: '.$discountval.'<br>Grand Total: N'.floatval($_SESSION['gtot']).'<br>';
$to = $_SESSION['femail'];
$emailfrm = get_value('Con_from_Email','configure','Con_Id',1);
$subject = "SABIS | Thank you for your Order @ Jollof by Jara";
$headers = 'From: '. $emailfrm . "\r\n" .
    'Reply-To: ' . $emailfrm . "\r\n";
$headers .= 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
mail($to, $subject, $message22, $headers);


ini_set( 'display_errors', 1 );
error_reporting( E_ALL );
$from = "testmy3661@gmail.com";
$to = "testmy3661@gmail.com";
$subject = "PHP Mail Test script";
$message = "This is a test to check the PHP Mail functionality";
$headers = "From:" . $from;
mail($to,$subject,$message, $headers);
echo "Test email sent";

?>
