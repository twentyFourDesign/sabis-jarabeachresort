<?php require "../admintool/system/config/configure.php";
$rs_main = $dbobj -> select("SELECT * FROM configure where Con_Id=1");
$curr = $rs_main[0]['Con_CurrencySym'];
$servchrg = floatval($rs_main[0]['Con_Servicecharges']);
$consutax = floatval($rs_main[0]['Con_ConTax']);
$vattax = floatval($rs_main[0]['Con_VAT']);

if(!isset($_SESSION['cart'])) {
	echo "error";
} else {
    $tot="0";
    $extra="0";
    foreach($_SESSION['cart'] as $key => $value) {
        $pid = $value['product_id'];
        $ioid = $value['option'];
        $qtys = $value['quantity'];
        $row = $dbobj -> select("SELECT * FROM menu_item where MI_Id='".$pid."'");
        $row2 = $dbobj -> select("SELECT * FROM item_option where io_id='".$ioid."'");
        $price = $row[0]['MI_Cost'];
        $priceext = $row2[0]['io_price'];
        $tot += $price*$qtys;
        $extra += $priceext*$qtys;
    }
    $_SESSION['tamt']=$tot;
    $tsercrg = ($tot*$servchrg)/100;
    $tcons = ($tot*$consutax)/100;
    $tvat = ($tot*$vattax)/100;
    $subtot = floatval($tot+$tsercrg+$tcons+$tvat);
    if(!isset($_SESSION['cdist'])) {
        $dis=0;
    } else {
        if($_SESSION['cdist']=='Percent') {
            $dis=($subtot*$_SESSION['cdis'])/100;
        } else {
            $dis=$_SESSION['cdis'];
        }
    }
    $grdtot = floatval($tot+$tsercrg+$tcons+$tvat+$extra)-$dis;
    $_SESSION['servcrg']=$tsercrg;
    $_SESSION['conscrg']=$tcons;
    $_SESSION['vatcrg']=$tvat;
    $_SESSION['disval']=$dis;
    $_SESSION['gtot']=$grdtot;
    $_SESSION['extra']=$extra;
    
    echo $curr.number_format($tot)."|".$curr.$tsercrg."|".$curr.$tcons."|".$curr.$tvat."|-".$curr.$dis."|".$curr.number_format($grdtot)."|".$curr.number_format($extra);
}
    

?>