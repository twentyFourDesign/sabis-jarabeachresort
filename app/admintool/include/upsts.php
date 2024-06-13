<?php require "../system/config/configure.php";

$dbobj->update("update order_item set OI_Status='".$_REQUEST['oists']."' where OI_Id='".$_REQUEST['oid']."'");
echo 'true';