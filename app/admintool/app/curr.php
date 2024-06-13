<?php require "../system/config/configure.php";

$rs_main = $dbobj -> select("SELECT Con_CurrencySym FROM configure where Con_Id=1");

if($rs_main[0]['Con_CurrencySym']!=''){ 
	echo json_encode(array('message'=>'Success','detail'=>$rs_main[0]['Con_CurrencySym']));
}else{
	$msg="Sorry, Please try Leter.";
	echo json_encode(array('message'=>'Failure','detail'=>$msg));	
}

?>