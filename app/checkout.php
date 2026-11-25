<?php require "admintool/system/config/configure.php";
include "include/regchk.php";
$_SESSION['allegy']=$_REQUEST['allid'];
$_SESSION['delivery']=$_REQUEST['txtdelivery'];
$_SESSION['orins']=$_REQUEST['asrtwntk'];
$_SESSION['whattime']=$_REQUEST['whattime'];
$_SESSION['whereeat']=$_REQUEST['whereeat'];
$_SESSION['comment']=$_REQUEST['txtcomment'];

// Paystack needs an email; if the guest gave none, use the resort's address for Paystack only.
$paystack_email = filter_var($_SESSION['femail'], FILTER_VALIDATE_EMAIL) ? $_SESSION['femail'] : get_value('Con_from_Email','configure','Con_Id',1);

$flag=0;
for($t=0;$t<count($_SESSION['cart']);$t++) {
	$catid = get_value('MI_CategoryId','menu_item','MI_Id',$_SESSION['cart'][$t]['product_id']); 
	$parentid = get_value('MC_Parent','menu_category','MC_Id',$catid); 

	if($parentid=='14'){
		$flag=1;
	}
}
?>
<!DOCTYPE html>
<html lang="en">
<?php include "include/head.php"; ?>
<body class="posrel minheight">
    <?php include "include/header.php"; ?>
    <div class="payopt">
        <p style="text-align: center;">By proceeding I hereby commit to the order I have placed</p>
		<?php if($flag==1){ ?>
        <form>
            <script src="https://js.paystack.co/v1/inline.js"></script>
            <a onclick="payWithPaystack()">PAYSTACK (ONLINE/ INSTANT)</a> 
        </form>
        <a href="javascript:funtab();">OPEN TAB / PAY LATER</a>
        <a href="javascript:funpos();">POS (ASK SERVER)</a>
		<?php } else {?>
		<a href="javascript:funorder();">SEND ORDER</a>
		<?php } ?>
        <p class="errmsg" id="err"></p>
    </div>
    <div class="btmline"></div>
    <div id="loader"><img src="assets/images/loader.gif" /></div>
</body>
<script>
  function payWithPaystack(){
    var handler = PaystackPop.setup({
      key: 'pk_live_5c778b5eb74ec195450dc789bc091f0fcf8bc5f5',
      email: <?=json_encode($paystack_email);?>,
      amount: <?=floatval($_SESSION['gtot'])*100?>,
      ref: ''+Math.floor((Math.random() * 1000000000) + 1), // generates a pseudo-unique reference. Please replace with a reference you generated. Or remove the line entirely so our API will generate one for you
      metadata: {
         custom_fields: [
            {
                display_name: "Mobile Number",
                variable_name: "mobile_number",
                value: "<?=$_SESSION['fphon'];?>"
            }
         ]
      },
      callback: function(response){
          $("#loader").show();
          $.ajax({url: "include/payverfiy.php?ref="+response.reference, success: function(result){
            if(result=='true') {
                $("#loader").hide();
                window.location="thankyou.php";
            } else {
                $("#loader").hide();
            }
        }});
      },
      onClose: function(){
          $("#err").html("Payment canceled.");
      }
    });
    handler.openIframe();
  }
 
 function funpos(){
	$("#loader").show();
	document.location.href="pos.php";
}
	
function funorder(){
	$("#loader").show();
	document.location.href="sendorder.php";
}
	
function funtab(){
	$("#loader").show();
	document.location.href="tab.php";
} 
</script>

</html>