<?php require "../admintool/system/config/configure.php";
echo ($_REQUEST['code']);
//exit();
$row = $dbobj -> select("SELECT * FROM discount_code where DC_Code='".$_REQUEST['code']."' and DC_Status='Active'  and  DC_Start_Date<=CURDATE() and DC_End_Date>=CURDATE()");
$r2 = $dbobj -> select("SELECT * FROM voucher where Vou_Code='".$_REQUEST['code']."' and Vou_Status='Active' and Vou_Start_Date<=CURDATE() and Vou_End_Date>=CURDATE()");
$r3 = $dbobj -> select("SELECT * FROM orders where Ord_DiscountCode = '".$_REQUEST['code']."' and Ord_Phone = '".$_SESSION['fphon']."'");
//echo count($r2);echo count($r3);
//exit();
if(count($row)>0) {
    $_SESSION['dtype']='Discount';
    $_SESSION['ccode']=$row[0]['DC_Code'];
    $_SESSION['cdist']=$row[0]['DC_AmtType'];
    $_SESSION['cdis']=$row[0]['DC_Amount'];
    //echo 'true|Discount';
    } 
else {
    //echo count($r2);
    //echo count($r3);
    if(count($r2)>0) {
        if(count($r3)==0)
        {
        $_SESSION['dtype']='Voucher';
        $_SESSION['ccode']=$r2[0]['Vou_Code'];
        $_SESSION['cdist']='Fixed';
        $_SESSION['cdis']=$r2[0]['Vou_Amount'];
            //echo 'true|Voucher';
        }
        else{
            echo 'false|Voucher already used.';
        }
        } 
        else {
        echo 'false|This coupon or voucher code is invalid or has expired.';
        }   
    }