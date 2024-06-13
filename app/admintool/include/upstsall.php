<?php require "../system/config/configure.php";

if($_REQUEST['ut']!='1' && $_REQUEST['ut']!='') {
    $cats = $dbobj->select( "SELECT * FROM menu_category where MC_Utype=".$_REQUEST['ut']." and MC_Status='Active'");
    for($cq=0; $cq<count($cats); $cq++) {
        $qidsma.=$cats[$cq]['MC_Id'].',';
    }
    $dbobj->update("update order_item join menu_item on order_item.OI_ItemId=menu_item.MI_Id set OI_Status='1' where OI_OrderId='".$_REQUEST['oid']."' and MI_CategoryId IN ('".str_replace(",","','",rtrim($qidsma,','))."')");
} else {
    $dbobj->update("update order_item set OI_Status='1' where OI_OrderId='".$_REQUEST['oid']."'");   
}
echo 'true';