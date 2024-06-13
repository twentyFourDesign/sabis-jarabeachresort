<?php require "../system/config/configure.php";

$proids=explode (",", $_REQUEST['proids']);
$qtys=explode (",", $_REQUEST['qtys']);
    
if(count($proids)>0){ 
	for ($x = 0; $x < count($proids); $x++) {
	    $row = $dbobj -> select("SELECT * FROM menu_item where MI_Id='".$proids[$x]."'");
        $array[]= array('Id'=>$row[0]['MI_Id'],'Title'=>$row[0]['MI_Title'],'Desc'=>$row[0]['MI_Desc'],'Price'=>$row[0]['MI_Cost'],'Qty'=>$qtys[$x]);
    }
    echo json_encode(array('message'=>'Success','detail'=>$array));
}else{
	$msg='Some Error Occurred Please Try Again.';
    echo json_encode(array('message'=>'failed','detail'=>$msg));
}
?>