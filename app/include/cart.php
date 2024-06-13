<?php require "../admintool/system/config/configure.php";

$proids=$_REQUEST['mid'];
$qtys=$_REQUEST['mqty'];
$option=$_REQUEST['mopt'];

if(!isset($_SESSION['cart'])) {
	$_SESSION['cart'] = array();
}

if($proids!='') {
    $dats = ['product_id' => $proids, 'quantity' => $qtys, 'option' => $option];
    if(array_search($proids,array_column($_SESSION['cart'], 'product_id')) !== FALSE) {
        foreach($_SESSION['cart'] as $key => $value) {
            if( $value['product_id']  == $proids) {
                $_SESSION['cart'][$key]['quantity'] = $qtys;
				$_SESSION['cart'][$key]['option'] = $option;
            }
        }
    } else {
        $_SESSION['cart'][]=$dats;
    }
}

echo 'Added';
    

?>