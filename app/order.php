<?php require "admintool/system/config/configure.php";
include "include/regchk.php";
$rs_main = $dbobj -> select("SELECT * FROM configure where Con_Id=1");
$curr = $rs_main[0]['Con_CurrencySym'];
$servchrg = floatval($rs_main[0]['Con_Servicecharges']);
$consutax = floatval($rs_main[0]['Con_ConTax']);

$vattax = floatval($rs_main[0]['Con_VAT']);

/*if(strlen($_REQUEST['action'])!=0) {
    
    $code=$_REQUEST['code'];
    $_SESSION['ccode']=$code;
}*/
if(!isset($_SESSION['cart'])) {
} else {
    foreach($_SESSION['cart'] as $key => $value) {
        $proids.=$value['product_id'].',';
    }
}
$row = $dbobj -> select("SELECT * FROM menu_item where MI_Id IN ('".str_replace(",","','",rtrim($proids,','))."') and MI_Status='Active' order by MI_Sort ASC");
    if(count($row)>0){ 
    	for($t=0;$t<count($row);$t++) {
    	$pkey = array_search($row[$t]['MI_Id'],array_column($_SESSION['cart'], 'product_id'),true);
        if($pkey !== false) {
	        $miqty = $_SESSION['cart'][$pkey]['quantity'];
			$miopt = $_SESSION['cart'][$pkey]['option'];
	    } else {
	        $miqty = 0;
			$miopt ='';
	    }
	    $cmiqty='';
	    if($row[$t]['MI_Qty']!='') {
            if($row[$t]['MI_Qty']>20) {
                    $rwqty=20;
                } else {
                    $rwqty=$row[$t]['MI_Qty'];
                }                
    	    for ($x1 = 0; $x1 <= $rwqty; $x1++) {    	    
    	        if($miqty==$x1) {
    	            $cmiqty .= '<option selected value="'.$x1.'">'.$x1.'</option>';   
    	        } else {
    	            $cmiqty .= '<option value="'.$x1.'">'.$x1.'</option>';
    	        }
    	    }
    	} else {
    	    for ($x = 0; $x <= 10; $x++) {
    	        if($miqty==$x) {
    	            $cmiqty .= '<option selected value="'.$x.'">'.$x.'</option>';
    	        } else {
    	            $cmiqty .= '<option value="'.$x.'">'.$x.'</option>';
    	        }
    	    }
        }
        if($miopt>0) { 
	        $htmlmi.='<div class="mi_inner_cart"><div class="mi_full"><h4 class="mititle">'.$row[$t]['MI_Title'].'</h4><p class="miprice2">'.$curr.number_format($row[$t]['MI_Cost'],2).'</p><p class="miprice2">'.get_value('io_title','item_option','io_id',$miopt).' - '.$curr.number_format(get_value('io_price','item_option','io_id',$miopt)).'</p><div class="qtybox"><select name="miqty" id="miqty-'.$row[$t]['MI_Id'].'" class="miqty" data-id="'.$row[$t]['MI_Id'].'">'.$cmiqty.'</select></div><div class="clear"></div></div></div>';
       } else {
           $htmlmi.='<div class="mi_inner_cart"><div class="mi_full"><h4 class="mititle">'.$row[$t]['MI_Title'].'</h4><p class="miprice2">'.$curr.number_format($row[$t]['MI_Cost'],2).'</p><div class="qtybox"><select name="miqty" id="miqty-'.$row[$t]['MI_Id'].'" class="miqty" data-id="'.$row[$t]['MI_Id'].'">'.$cmiqty.'</select></div><div class="clear"></div></div></div>';
       }
	}
} else {
    $htmlmi = 'No items currently. Please check back soon.';
}
$allerg = $dbobj -> select("SELECT * FROM allergens where All_Status='Active'");

?>
<!DOCTYPE html>
<html lang="en">
<?php include "include/head.php"; ?>
<style>
    .all{
        display: inline-block;
    }
    @media only screen and (max-width: 386px) and (min-width: 367px){
    .all{
        display: inline-block;
        width: 30%;
    }}
</style>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0/jquery.min.js"></script>
<!-- jQuery Modal -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css" />
<script>
    function get_product_detail() {
        var align = 'center';												//Valid values; left, right, center
        var top = 100; 														//Use an integer (in pixels)
        var width = 900; 													//Use an integer (in pixels)
        var padding = 30;													//Use an integer (in pixels)
        var backgroundColor = '#FFFFFF'; 									//Use any hex code
        //var source = 'index.php?file=customer_popup&txtcustomerid=' + vval;//Refer to any page on your server, external pages are not valid e.g. http://www.google.co.uk
        var source = 'include/addmore.php';
        var borderColor = '#666666'; 										//Use any hex code
        var borderWeight = 0; 												//Use an integer (in pixels)
        var borderRadius = 0; 												//Use an integer (in pixels)
        var fadeOutTime = 300; 												//Use any integer, 0 = no fade
        var disableColor = '#666666'; 										//Use any hex code
        var disableOpacity = 40; 											//Valid range 0-100
        var loadingImage = 'assets/ploading.gif';							//Use relative path from this page
        modalPopup(align, top, width, padding, disableColor, disableOpacity, backgroundColor, borderColor, borderWeight, borderRadius, fadeOutTime, source, loadingImage);
    }
</script>
<script type="text/javascript">
window.onload = function(){//window.addEventListener('load',function(){...}); (for Netscape) and window.attachEvent('onload',function(){...}); (for IE and Opera) also work
    get_product_detail();
}
</script>
<body onload="calc()" class="posrel minheight">
    <?php include "include/header.php"; ?>
    
    <div class="ordersumm">
        <h2>Order Summary</h2>
        <form name="orsub" method="POST" action="checkout.php" onSubmit="return funitempin();">
        <div class="osmilist">
            <?=$htmlmi;?>
        </div>
         <div class="catbtn">
            <!--<div id="ex1" class="modal" style="max-width: 600px !important;">
              <p>Would you like to add any snacks/ nibbles while you wait? </a><button type="button" name="category" class="catbtn" style="margin-left: 80px;"><a href="https://mywebapp.co.in/project/food_ordering_system/cats.php?cid=6">Snack</a></button> or
             Would you like to pre-pay for your takeaway boxes?</a><button type="button" name="category" class="catbtn" style="margin-left: 115px;width: 48px;"><a href="https://mywebapp.co.in/project/food_ordering_system/cats.php?cid=14">Shop</a></button></p>
              
              <a href="#" rel="modal:close">Close</a>
            </div>
            
            Link to open the modal 
            <p></p><a href="#ex1" rel="modal:open"><button type="button" name="category">Add more items</button></a></p>-->
            <a href="topcats.php"><button type="button" name="category">Add more items</button></a>
            
            
           <!-- <a href="javascript:addmore();" type="button" class="btn btn-primary pull-left"><i style="color: #FFFFFF;" class="material-icons">Add More Items</i> &nbsp;<div class="ripple-container">Add More Items</div></a>
            <button type="button" name="category"><a href="javascript:addmore();" class="btn btn-primary pull-left"><i style="color: #FFFFFF;">Add more items</i></a></button>-->
        </div>
        
        
        
        <div class="anysreqouter">
            <h3>Any special requests or changes / things we need to know? Indicate Your Spice Level, if applicable</h3>
            <textarea class="anysreta" id="asrtwntk" name="asrtwntk"></textarea>
        </div>
		<div class="anysreqouter">
            <h3>What time would you like to be served?</h3>
            <select class="anysreta" id="whattime" name="whattime">
				<option value=" ">Select</option>
				<option value="ASAP">ASAP</option>
				<option value="1pm">1pm (Lunch)</option>
				<option value="1.15pm">1.15pm (Lunch)</option>
				<option value="1:30pm">1:30pm (Lunch)</option>
				<option value="1.45pm">1.45pm (Lunch)</option>
				<option value="2pm">2pm (Lunch)</option>
				<option value="2.15pm">2.15pm (Lunch)</option>
				<option value="2:30pm">2:30pm (Lunch)</option>
				<option value="2.45pm">2.45pm (Lunch)</option>
				<option value="3pm">3pm (Lunch)</option>
				<option value="7pm">7pm (Dinner)</option>
				<option value="7.15pm">7.15pm (Dinner)</option>
				<option value="7:30pm">7:30pm (Dinner)</option>
				<option value="7.45pm">7.45pm (Dinner)</option>
				<option value="8pm">8pm (Dinner)</option>
				<option value="8.15pm">8.15pm (Dinner)</option>
				<option value="8:30pm">8:30pm (Dinner)</option>
				<option value="8.45pm">8.45pm (Dinner)</option>
				<option value="9pm">9pm (Dinner)</option>
			</select>
        </div>
		<div class="anysreqouter">
            <h3>Where would you like to be served?</h3>
            <select class="anysreta" id="whereeat" name="whereeat">
				<option value=" ">Select</option>
				<option value="Room / Balcony">Room / Balcony</option>
				<option value="Terrace">Terrace</option>
				<option value="Gazebo">Gazebo</option>
				<option value="Poolside">Poolside</option>
			</select>
        </div>	
		<div class="anysreqouter">
				<h3>Enter any comments or request:</h3>
				<textarea class="anysreta" id="txtcomment" name="txtcomment"></textarea>
			</div>		
		<?php if($_SESSION['tabno']=='Delivery'){?>	
			<div class="anysreqouter">
				<h3>Delivery Address:</h3>
				<textarea class="anysreta" id="txtdelivery" name="txtdelivery"></textarea>
			</div>	
		<?php } ?>	
        <div class="anysreqouter">
            <h3>Enter Discount Code or Voucher Code (if applicable)</h3>
            <input type="text" class="txtccode" id="ccode" name="ccode" /><button id="remcc" onclick="remcode()" class="remcc" type="Button">X</button>
            <div class="clear"></div>
            <p id="cerr" class="cerr"></p>
        </div>
		<div class="anysreqouter">
            <h3>Enter Order Pin</h3>
            <input type="number" min="0" max="9999" id="txtpin" name="txtpin" required class="txtccode" />
            <div class="clear"></div>
            <p id="pinerror" class="pinerror"></p>
        </div>	
        <?php if(count($allerg)>0){ ?>
            <div class="allgesouter">
                <h3>Allergens</h3>
    	        <?php for($a=0;$a<count($allerg);$a++) { ?>
    	            <div class="all">
    	                <input type="checkbox" id="allid-<?=$allerg[$a]['All_Id'];?>" name="allid[]" value="<?=$allerg[$a]['All_Title'];?>"> 
    	                <label for="<?=$allerg[$a]['All_Title'];?>"> <?=$allerg[$a]['All_Title'];?></label>
    	            </div>
    	        <?php } ?>
            </div>
        <?php } ?>
        <div class="totouter">
            <h4 class="tbno">Room #<?=implode(",",$_SESSION['tabno']);?></h4>
            <div class="ori_left oribold">Item Total</div>
            <div id="itemtot" class="ori_rgt oribold"></div>
            <div class="ori_left" id="iteextradiv">Extra For Option</div>
            <div id="iteextra" class="ori_rgt"></div>
            <div class="clear" id="iteextrarow"></div>
            <div class="clear sp1"></div>
            <!--<div class="ori_left">Service Charge (<?//=number_format($servchrg,2);?>%)</div>
            <div id="itesrc" class="ori_rgt"></div>
            <div class="clear"></div>-->
            <div class="ori_left">Consumption Tax (<?=number_format($consutax,2);?>% LIRS)</div>
            <div id="itemctax" class="ori_rgt"></div>
            <div class="clear"></div>
            <div class="ori_left">VAT (<?=number_format($vattax,2);?>% FIRS)</div>
            <div id="itemvat" class="ori_rgt"></div>
            <div class="clear"></div>
            <div id="itemnone" class="ori_left">Discount</div>
            <div id="itemdis" class="ori_rgt"></div>
            <div class="clear"></div>
            <div class="tpbrder">
                <div class="ori_left oribold">Grand Total</div>
                <div id="itemgtot" class="ori_rgt oribold"></div>
                <div class="clear"></div>
            </div>
        </div>
        <?php //exit(); ?>
        <?php //echo ($_SESSION['ccode']); exit(); ?>
        <div class="orderbtn">
            <button type="submit" name="order">Confirm Order + Pay (if applicable)</button>
        </div>
        </form>
    </div>
    <div class="btmline"></div>
    <div id="loader"><img src="assets/images/loader.gif" /></div>
    <?php if($_SESSION['tabno']=='Delivery'){ } else { ?>
    <?php include "include/addmore.php"; ?>
    <?php } ?>
</body>

<?php if(!isset($_SESSION['cdist'])) {
} else { ?>
<script>
    $("#itemnone").show();
    $("#itemdis").show();
    $("#ccode").addClass("half");
    $("#ccode").val('<?=$_SESSION['ccode'];?>');
    $("#remcc").show();
    $("#cerr").show();
    $("#cerr").html("<?=$_SESSION['dtype'];?> code Applied.");
    $("#cerr").addClass("grnclr");
</script>
<?php } ?>
<script>
    $("select[name=miqty]").bind('change', function() {
        var mid = $(this).data('id');
        var mqty = $(this).val();
        if(mqty>0) {
            $.ajax({url: "include/cart.php?mid="+mid+"&mqty="+mqty, success: function(result){
                calc();
            }});
        } else {
            $.ajax({url: "include/checkcrt.php?mid="+mid, success: function(result){
                if(result=='Yes') {
                    $("#loader").show();
                    $.ajax({url: "include/remcart.php?mid="+mid, success: function(result){
                        if(result!='No') {
                            $("#loader").hide(500);
                            window.location="order.php";
                        }
                    }});
                } else {
                }
            }});
        }
    });
    
    
   /* function gotosnack(filename) {
        Confirm('', 'Add few more items!', 'Would you like to add any snacks/ nibbles while you wait?', 'Would you like to pre-pay for your takeaway boxes?', '', '',filename+"php");
	\ans=confirm('Are you sure, you want to cancel?');
	if(ans) {
		document.location.href=""+filename+"14";
	} 
    }*/
    
    
    
    function remcode() {
        $.ajax({url: "include/remdiscount.php", success: function(result){
            if(result=='true') {
                $("#itemnone").hide();
                $("#itemdis").hide();
                $("#ccode").removeClass("half");
                $("#remcc").hide();
                $("#cerr").hide();
                $("#cerr").removeClass("grnclr");
                $("#cerr").hide();
                $("#cerr").html("");
                calc();
            }
        }});
    }
    
    $("#ccode").bind('click keyup', function() {
        var ccode = $(this).val();
        $.ajax({url: "include/discount.php?code="+ccode, success: function(result){
            var res = result.split("|");
            if(res[0]=='true') {
                $("#itemnone").show();
                $("#itemdis").show();
                $("#ccode").addClass("half");
                $("#remcc").show();
                $("#cerr").show();
                $("#cerr").html(res[1]+" code Applied.");
                $("#cerr").addClass("grnclr");
                calc();
            } else {
                $("#itemnone").hide();
                $("#itemdis").hide();
                $("#ccode").removeClass("half");
                $("#remcc").hide();
                $("#cerr").hide();
                $("#cerr").removeClass("grnclr");
                $("#cerr").show();
                $("#cerr").html(res[1]);
                calc();
            }
            calc();
        }});
    });
	
	$("#txtpin").bind('click keyup', function() {
        var txtpin = $(this).val();
        $.ajax({url: "include/itempin.php?pin="+txtpin, success: function(result){
            if(result=='true') {
                $("#pinerror").show();
                $("#pinerror").html("Valid Pin!!");
                $("#pinerror").addClass("grnclr");
            } else {
                $("#pinerror").removeClass("grnclr");
				$("#pinerror").addClass("cerr");
                $("#pinerror").show();
                $("#pinerror").html("Invalid Pin, Please try again!!");
            }
        }});
    });
    
    function remcode() {
        $.ajax({url: "include/remdiscount.php", success: function(result){
            if(result=='true') {
                $("#itemnone").hide();
                $("#itemdis").hide();
                $("#ccode").removeClass("half");
                $("#remcc").hide();
                $("#cerr").hide();
                $("#cerr").removeClass("grnclr");
                $("#cerr").hide();
                $("#cerr").html("");
                calc();
            }
        }});
    }
    function calc() {
        $.ajax({url: "include/calc.php", success: function(result){
            if(result == 'error') { 
            } else {
                var prores23=result.split("|");
                $("#itemtot").html(prores23[0]);
                $("#itesrc").html(prores23[1]);
                $("#itemctax").html(prores23[2]);
                $("#itemvat").html(prores23[3]);
                $("#itemdis").html(prores23[4]);
                $("#itemgtot").html(prores23[5]);
                if(prores23[6]!="₦0") {
                    $("#iteextra").html(prores23[6]);
                } else {
                    $("#iteextradiv").hide();
                    $("#iteextrarow").hide();
                    $("#iteextra").hide();
                }
            }
        }});
    }
</script>
</html>