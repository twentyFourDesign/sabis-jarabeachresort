<?php require "system/config/configure.php";
include "include/checklogin.php";

global $dbobj;

$filename = "users.csv";
$fp = fopen('php://output', 'w');

$header = array('First Name','Email Address','Phone Number','Date of Birth');

header('Content-type: application/csv');
header('Content-Disposition: attachment; filename='.$filename);
fputcsv($fp, $header);

$sql="SELECT Ord_FirstName,Ord_Email,Ord_Phone,Ord_Dob FROM orders GROUP BY Ord_Phone ORDER BY Ord_Id ASC";
$data = $dbobj -> select($sql);
for($t=0;$t<count($data);$t++) {
    $row=array($data[$t]['Ord_FirstName'],$data[$t]['Ord_Email'],$data[$t]['Ord_Phone'],date("d-m-Y", strtotime($data[$t]['Ord_Dob'])));
	fputcsv($fp, $row);
}
exit;

?>