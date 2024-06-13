<?php require "../system/config/configure.php";

$row = $dbobj -> select("SELECT * FROM menu_item where find_in_set('".$_REQUEST['cat']."',MI_CategoryId)!=0  and MI_Status='Active' order by MI_Sort ASC");
    
if(count($row)>0){ 
	for($t=0;$t<count($row);$t++) {
	    if($row[$t]['MI_Img']!='') {
	        $path='https://mywebapp.co.in/project/food_ordering_system/admintool/upload/mi/'.$row[$t]['MI_Id'].'_'.$row[$t]['MI_Img'];
	    } else {
	        $path='';
	    }
        $array[]= array('Id'=>$row[$t]['MI_Id'],'Title'=>$row[$t]['MI_Title'],'Desc'=>$row[$t]['MI_Desc'],'Price'=>$row[$t]['MI_Cost'],'Img'=>$path);
    }
    echo json_encode(array('message'=>'Success','detail'=>$array));
}else{
	$msg='Some Error Occurred Please Try Again.';
    echo json_encode(array('message'=>'failed','detail'=>$msg));
}
?>