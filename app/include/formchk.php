<?php require "../admintool/system/config/configure.php";
$rs_main = $dbobj -> select("SELECT * FROM orders where Ord_Phone='".$_REQUEST['phone']."' order by Ord_Id DESC limit 1");
if(count($rs_main)>0){
    echo $rs_main[0]['Ord_FirstName']."|".$rs_main[0]['Ord_LastName']."|".$rs_main[0]['Ord_Email']."|".$rs_main[0]['Ord_Dob'];
} else { 
    echo 'error';
}

?>