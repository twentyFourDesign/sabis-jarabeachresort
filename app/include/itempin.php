<?php require "../admintool/system/config/configure.php";

$pinarray=array();
for ($x = 0; $x < count($_SESSION['tabno']); $x++) {
	$pin = get_value('IP_Pin','item_pin','IP_Room',$_SESSION['tabno'][$x]);
	if(!empty($pin)){
		$pinarray[] = $pin;
	}	
}

if(in_array($_REQUEST['pin'],$pinarray)) {
	echo "true";
} else {
	echo "false";
}