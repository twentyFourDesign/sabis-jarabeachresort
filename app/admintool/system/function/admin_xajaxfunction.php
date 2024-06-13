<?php
include_once('xajax.inc.php');
$xajax = new xajax();

function get_flat($pid,$fid="") {
	global $dbobj;
	$objResponse = new xajaxResponse();
	$objResponse->addAssign('flattd','innerHTML',flatcombo($pid,$fid));
	return $objResponse;
}

function user_receipt($uid,$pid) {
	global $dbobj;
	$objResponse = new xajaxResponse();
	$cquery = "SELECT * FROM receipt_print where RT_Rid='".$pid."'";
	$crs = $dbobj->select($cquery);
	if($crs[0]['RT_Id']=="") {
		$query = "insert receipt_print set RT_Rid='".$pid."', RT_Uid='".$uid."', RT_Date='".date('Y-m-d')."'";
		$rs=$dbobj->insert($query);
	} else {
		$query = "update receipt_print set RT_Rid='".$pid."', RT_Uid='".$uid."', RT_Date='".date('Y-m-d')."' where RT_Id=".$crs[0]['RT_Id'];
		$rs=$dbobj->update($query);
	}
	return $objResponse;
}

function user_cus($uid,$cid,$did) {
	global $dbobj;
	$objResponse = new xajaxResponse();
	$cquery = "SELECT * FROM document_print where DP_Cid='".$cid."' and DP_Did='".$did."'";
	$crs = $dbobj->select($cquery);
	if($crs[0]['DP_Id']=="") {
		$query = "insert document_print set DP_Did='".$did."', DP_Cid='".$cid."', DP_Uid='".$uid."', DP_Date='".date('Y-m-d')."'";
		$rs=$dbobj->insert($query);	
	} else {
		$query = "update document_print set DP_Did='".$did."', DP_Cid='".$cid."', DP_Uid='".$uid."', DP_Date='".date('Y-m-d')."' where DP_Id = '".$crs[0]['DP_Id']."'";
		$rs=$dbobj->update($query);	
	}
	return $objResponse;
}

$xajax->registerFunction("get_flat");
$xajax->registerFunction("user_receipt");
$xajax->registerFunction("user_cus");
$xajax->processRequests();
$xajax->printJavascript();
?>
