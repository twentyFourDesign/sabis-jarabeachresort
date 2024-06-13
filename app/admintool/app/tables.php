<?php require "../system/config/configure.php";

$rs_main = $dbobj -> select("SELECT Con_TableNo FROM configure where Con_Id=1");

if($rs_main[0]['Con_TableNo']>0){ 
	echo json_encode(array('message'=>'Success','detail'=>$rs_main[0]['Con_TableNo']));
}else{
	$msg="Sorry, wrong detail entered.";
	echo json_encode(array('message'=>'Failure','detail'=>$msg));	
}

?>