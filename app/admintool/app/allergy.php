<?php require "../system/config/configure.php";
$row = $dbobj -> select("SELECT * FROM allergens where All_Status='Active'");
    
if(count($row)>0){ 
	for($t=0;$t<count($row);$t++) {
        $array[]= array('Id'=>$row[$t]['All_Id'],'Title'=>$row[$t]['All_Title']);
    }
    echo json_encode(array('message'=>'Success','detail'=>$array));
}else{
	$msg='Some Error Occurred Please Try Again.';
    echo json_encode(array('message'=>'failed','detail'=>$msg));
}
?>