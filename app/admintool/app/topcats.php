<?php require "../system/config/configure.php";
$row = $dbobj -> select("SELECT * FROM menu_category where MC_Parent='0' and MC_Status='Active' order by MC_Sort ASC");
    
if(count($row)>0){ 
	for($t=0;$t<count($row);$t++) {
	    if($row[$t]['MC_Image']!='') {
    	    $path='https://mywebapp.co.in/project/food_ordering_system/admintool/upload/menu_category/';
    	    $array[]= array('Id'=>$row[$t]['MC_Id'],'Title'=>$row[$t]['MC_Title'],'Image'=>$path.$row[$t]['MC_Id'].'_'.$row[$t]['MC_Image']);
    	} else {
    	    $path='https://mywebapp.co.in/project/food_ordering_system/admintool/app/tcplaceholder.jpg';
    	    $array[]= array('Id'=>$row[$t]['MC_Id'],'Title'=>$row[$t]['MC_Title'],'Image'=>$path);
    	}
    }
    echo json_encode(array('message'=>'Success','detail'=>$array));
}else{
	$msg='Some Error Occurred Please Try Again.';
    echo json_encode(array('message'=>'failed','detail'=>$msg));
}
?>