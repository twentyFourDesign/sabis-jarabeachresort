<?php require "../system/config/configure.php";
$row = $dbobj -> select("SELECT * FROM menu_category where MC_Parent='".$_REQUEST['cat']."' and MC_Status='Active' order by MC_Sort ASC");
    
if(count($row)>0){ 
	for($t=0;$t<count($row);$t++) {
        $array[]= array('Id'=>$row[$t]['MC_Id'],'Title'=>$row[$t]['MC_Title']);
    }
    echo json_encode(array('message'=>'Success','detail'=>$array));
}else{
	$msg='Some Error Occurred Please Try Again.';
    echo json_encode(array('message'=>'failed','detail'=>$msg));
}
?>