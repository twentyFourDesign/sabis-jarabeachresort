<?php require "../system/config/configure.php";

if($_REQUEST['table'] != '') {
    $id = $dbobj -> insert("insert into orders set Ord_TableNo='".$_REQUEST['table']."', Ord_NoOfGuest='".$_REQUEST['guests']."', Ord_Date='".date('Y-m-d')."', Ord_FirstName='".$_REQUEST['fname']."', Ord_LastName='".$_REQUEST['lname']."', Ord_Email='".$_REQUEST['email']."', Ord_Phone='".$_REQUEST['phone']."', Ord_Instruction='".$_REQUEST['note']."', Ord_Allergens='', Ord_ServiceCharge='', Ord_ConTax='', Ord_Vat='', Ord_Total='".$_REQUEST['tamt']."', Ord_VoucherCode='', Ord_DiscountCode='', Ord_DiscountType='', Ord_DiscountValue='', Ord_Discount='', Ord_GrandTotal='".$_REQUEST['tamt']."', Ord_OrderStatus='2', Ord_PaymentMode='Online', Ord_PaymentStatus='Completed', Ord_TransactionID='', Ord_Status='Active'");
    $proids=explode (",", $_REQUEST['proids']);
    $qtys=explode (",", $_REQUEST['qtys']);
    for ($x = 0; $x < count($proids); $x++) {
        $prodprice = $dbobj -> select("SELECT * FROM menu_item where MI_Id='".$proids[$x]."'");
        $dbobj -> insert("insert into order_item set OI_OrderId='".$id."', OI_ItemId='".$proids[$x]."', OI_Cost='".$prodprice[0]['MI_Cost']."', OI_Quantity='".$qtys[$x]."'");
    }
    echo json_encode(array('message'=>'Success','detail'=>array('Id'=>$id)));
} else {
    echo json_encode(array('message'=>'Failure','detail'=>"Some Error Occurred Please Try Again."));
}