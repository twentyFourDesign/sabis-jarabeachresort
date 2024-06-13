<?php
require "system/config/configure.php";
global $dbobj;
$id=$_REQUEST['id'];

$row=$dbobj->select("select DG_Cost from dg where DG_Id='".$id."'");

if(count($row)>0) {
    echo $row[0]['DG_Cost'];
} else {
    echo 'error';
}


?>