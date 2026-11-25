<?php require "../admintool/system/config/configure.php";

include_once __DIR__.'/rooms.php';
$pinarray=array();
foreach ((array)$_SESSION['tabno'] as $room) {
	// PINs are saved per "Room N"; a booking-system name like "Garden Room 18" uses the PIN for "Room 18".
	$pin = get_value('IP_Pin','item_pin','IP_Room',mysqli_real_escape_string($dbobj->CONN,$room));
	if(empty($pin)) {
		$pin = get_value('IP_Pin','item_pin','IP_Room',mysqli_real_escape_string($dbobj->CONN,jara_pin_room_key($room)));
	}
	if(!empty($pin)){
		$pinarray[] = $pin;
	}	
}

if(in_array($_REQUEST['pin'],$pinarray)) {
	echo "true";
} else {
	echo "false";
}