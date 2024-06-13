<?php
require "system/config/configure.php";

include "include/checklogin.php";

require_once CLASS_PATH . 'admin_order.php';

$obj = new admin_order;


if ( isset( $_REQUEST[ 'txtuid' ] ) && !empty( $_REQUEST[ 'txtuid' ] ) ) {

    $txtuid = $_REQUEST[ 'txtuid' ];

    $rs1 = $obj->get_order_single_detail( $txtuid );

}


if ( strlen( $_REQUEST[ 'action' ] ) != 0 ) {


    $title = $_REQUEST[ 'title' ];

    $status = $_REQUEST[ 'status' ];
	$noguest = $_REQUEST[ 'txtnoguest' ];
	$date = $_REQUEST[ 'date' ];
	$firstname = $_REQUEST[ 'txtfirstname' ];
	
	$email = $_REQUEST[ 'txtemail' ];
	$phone = $_REQUEST[ 'txtphone' ];
	$allergens = $_REQUEST[ 'txtallergens' ];
	$servicecharge = $_REQUEST[ 'txtservicecharge' ];
	$comptax = $_REQUEST[ 'txtcomptax' ];
	$vat = $_REQUEST[ 'txtvat' ];
	$total = $_REQUEST[ 'txttotal' ];
	$vcode = $_REQUEST[ 'txtvcode' ];
	$discode = $_REQUEST[ 'txtdiscode' ];
	$distype = $_REQUEST['txtdistype'];
	$disvalue = $_REQUEST[ 'txtdisvalue' ];
	$discount = $_REQUEST[ 'txtdiscount' ];
    $extra = $_REQUEST[ 'txtextra' ];
	$gtotal = $_REQUEST[ 'txtgtotal' ];
	$ostatus = $_REQUEST[ 'selostatus' ];
	$paymode = $_REQUEST[ 'txtpaymode' ];
	$paystatus = $_REQUEST[ 'selpaystatus' ];
	$transac = $_REQUEST[ 'txttransac' ];
	$instruct = $_REQUEST[ 'txtinstruct' ];
	$dob = $_REQUEST['txtdob'];
	$address = $_REQUEST['txtaddress'];
	$whattime = $_REQUEST['selwhattime'];
	$whereeat = $_REQUEST['selwhereeat'];
	$comment = $_REQUEST['txtcomment'];


    if ( $_REQUEST[ 'action' ] == "edit" ) {

        $uid = $_REQUEST[ 'txtuid' ];
		
        $msgtextuser = $obj->update_order_detail( $status, $uid, $title, $noguest, $date, $firstname,  $email, $phone, $dob, $allergens, $servicecharge, $comptax, $vat, $total, $vcode, $discode, $distype, $disvalue, $discount, $extra, $gtotal, $ostatus, $paymode, $paystatus, $transac, $instruct, $address, $whattime, $whereeat, $comment);
        ?>
<script>

			document.location.href="order_listing.php?msgtextuser=+<?php echo $msgtextuser?>+";

		</script>
<?php

} elseif ( $_REQUEST[ 'action' ] == "add" ) {

        $inserId = $obj->add_order_detail( $status, $title, $noguest, $date, $firstname, $email, $phone, $dob, $allergens, $servicecharge, $comptax, $vat, $total, $vcode, $discode, $distype, $disvalue, $discount, $extra, $gtotal, $ostatus, $paymode, $paystatus, $transac, $instruct, $address, $whattime, $whereeat, $comment);


        ?>
<script>

			document.location.href="order_listing.php?msgtextuser=+Order added successfully+";

		</script>
<?php
}

}

?>

<!DOCTYPE html>

<html lang="en">
<head>
<meta charset="utf-8">
<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
<title> Order </title>

<!--     Fonts and icons     -->

<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" />
<link rel="stylesheet" href="assets/css/material-dashboard.css?v=2.0.0">
<link rel="stylesheet" href="assets/style.css">
<script>

    function statuc_edit(v_value) {

            document.location.href=v_value+".php";

    }

    </script> 
<script>

    function frmcheck() {

            if(!chkForm("frmu", "title", "validateblank", "Please Enter Table No.")){

                    return false;

            } else {

                    return true;

            }

    }

    </script>
</head>

<body class="">
<div class="wrapper">
  <?php include "include/left.php";?>
  <div class="main-panel"> 
    
    <!-- Navbar -->
    
    <nav class="navbar navbar-expand-lg navbar-transparent  navbar-absolute fixed-top">
      <div class="container-fluid">
        <div class="navbar-wrapper"> <a class="navbar-brand" href="#pablo">Order</a> </div>
        <?php include "include/top.php";?>
      </div>
    </nav>
    
    <!-- End Navbar -->
    
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header card-header-primary">
                <h4 class="card-title ">Detail</h4>
              </div>
              <div class="card-body">
                <form id="frmu" name="frmu" method="post" action="order_detail.php" onSubmit="return frmcheck()" enctype="multipart/form-data">
                  <div class="table-responsive">
                    <table id="example" class="table" style="width:100%" cellspacing="0" cellpadding="0">
                      <tbody>
                        <tr>
                          <td width="15%" height="25"><span class="radfont">*</span>Table No.</td>
                          <?php $title = explode('X',$rs1[0]['Ord_TableNo']); ?>
                          <td width="30%" height="25"><input name="title" type="text" class="form-control" id="title" value="<?=$title[0];?>" size="40" /></td>
                          <td width="15%" height="25"> Status:</td>
                          <td width="30%" height="25"><select name="status" class="form-control">
                              <?php echo $rs1[0]['Ord_Status']=="Active" ? '<option value="Active" selected="selected">Active</option>' : '<option value="Active">Active</option>'; ?> <?php echo $rs1[0]['Ord_Status']=="Inactive" ? '<option value="Inactive" selected="selected">Inactive< / option > ' : '<option value="Inactive">Inactive</option> '; ?>
                            </select></td>
                        </tr>
						 <tr>
                          <td width="15%" height="25">No of Guest: </td>
                          <td width="30%" height="25"><input name="txtnoguest" type="text" class="form-control" id="txtnoguest" value="<?=$rs1[0]['Ord_NoOfGuest'];?>" size="40" /></td>
                          <td width="15%" height="25">Date: </td>
							<?php if(!empty($rs1[0]['Ord_Id'])){ $date = date('Y-m-d',strtotime($rs1[0]['Ord_Date'])); }else{ $date = date('Y-m-d');}?> 
                          <td width="30%" height="25"><input name="date" type="date" class="form-control" id="date" value="<?=$date;?>"  size="40" /></td>
                        </tr>  
						<tr>
                          <td width="15%" height="25">Preferred Name: </td>
                          <td width="30%" height="25"><input name="txtfirstname" type="text" class="form-control" id="txtfirstname" value="<?=$rs1[0]['Ord_FirstName'];?>" size="40" /></td>
                          <td width="15%" height="25">Email Address: </td>
                          <td width="30%" height="25"><input name="txtemail" type="text" class="form-control" id="txtemail" value="<?=$rs1[0]['Ord_Email'];?>" size="40" /></td>
                        </tr>
                        <tr>
                          <td width="15%" height="25">Phone number: </td>
                          <td width="30%" height="25"><input name="txtphone" type="text" class="form-control" id="txtphone" value="<?=$rs1[0]['Ord_Phone'];?>" size="40" /></td>
                          <td width="15%" height="25">Date of Birth: </td>
                          <td width="30%" height="25"><input name="txtdob" type="date" class="form-control" id="txtdob" value="<?=$rs1[0]['Ord_Dob'];?>" /></td>
                        </tr>
                        <tr>
                          <td width="15%" height="25">Allergens : </td>
                          <td width="30%" height="25"><input name="txtallergens" type="text" class="form-control" id="txtallergens" value="<?=$rs1[0]['Ord_Allergens'];?>" size="40" /></td>
                          <td width="15%" height="25">Service Charge: </td>
                          <td width="30%" height="25"><input name="txtservicecharge" type="text" class="form-control" id="txtservicecharge" value="<?=$rs1[0]['Ord_ServiceCharge'];?>" size="40" /></td>
                        </tr>
                        <tr>
                          <td width="15%" height="25">Consumption Tax : </td>
                          <td width="30%" height="25"><input name="txtcomptax" type="text" class="form-control" id="txtcomptax" value="<?=$rs1[0]['Ord_ConTax'];?>" size="40" /></td>
                          <td width="15%" height="25">VAT: </td>
                          <td width="30%" height="25"><input name="txtvat" type="text" class="form-control" id="txtvat" value="<?=$rs1[0]['Ord_Vat'];?>" size="40" /></td>
                        </tr>
                        <tr>
                          <td width="15%" height="25">Total: </td>
                          <td width="30%" height="25"><input name="txttotal" type="text" class="form-control" id="txttotal" value="<?=$rs1[0]['Ord_Total'];?>" size="40" /></td>
                          <td width="15%" height="25">Voucher Code: </td>
                          <td width="30%" height="25"><input name="txtvcode" type="text" class="form-control" id="txtvcode" value="<?=$rs1[0]['Ord_VoucherCode'];?>" size="40" /></td>
                        </tr>
                        <tr>
                          <td width="15%" height="25">Discount Code: </td>
                          <td width="30%" height="25"><input name="txtdiscode" type="text" class="form-control" id="txtdiscode" value="<?=$rs1[0]['Ord_DiscountCode'];?>" size="40" /></td>
                          <td width="15%" height="25">Discount Type: </td>
                          <td width="30%" height="25"><input name="txtdistype" type="text" class="form-control" id="txtdistype" value="<?=$rs1[0]['Ord_DiscountType'];?>" size="40" /></td>
                        </tr>
                        <tr>
                          <td width="15%" height="25">Discount Value: </td>
                          <td width="30%" height="25"><input name="txtdisvalue" type="text" class="form-control" id="txtdisvalue" value="<?=$rs1[0]['Ord_DiscountValue'];?>" size="40" /></td>
                          <td width="15%" height="25">Discount: </td>
                          <td width="30%" height="25"><input name="txtdiscount" type="text" class="form-control" id="txtdiscount" value="<?=$rs1[0]['Ord_Discount'];?>" size="40" /></td>
                        </tr>
                        <tr>
                          <td width="15%" height="25">Extra for Option: </td>
                          <td width="30%" height="25"><input name="txtextra" type="number" step="0.01" class="form-control" id="txtextra" value="<?=$rs1[0]['Ord_Extra'];?>" size="40" /></td>
                          <td width="15%" height="25">Grand Total: </td>
                            <td width="30%" height="25"><input name="txtgtotal" type="text" class="form-control" id="txtgtotal" value="<?=$rs1[0]['Ord_GrandTotal'];?>" size="40" /></td>
                        </tr>
                        <tr>                          
                          <td width="15%" height="25">Order Status: </td>
                          <td width="30%" height="25"><select name="selostatus" class="form-control" id="selostatus">
						  <?php $blogdata = $dbobj -> select("SELECT * FROM order_status where OS_Status='Active' order by OS_Title desc");?>
		  <option>Select Order Status</option>
				<?php  for($j = 0;$j < count($blogdata);$j++) { ?>
				<option <?php if($rs1[0]['Ord_OrderStatus']==$blogdata[$j]['OS_Id']){ ?> selected="selected" <?php } ?> value="<?php echo $blogdata[$j]['OS_Id'];?>"><?php echo $blogdata[$j]['OS_Title'];?></option>
				<?php } ?>
						  </select></td>						
						  <td width="15%" height="25">Payment Mode: </td>
                          <td width="30%" height="25"><input name="txtpaymode" type="text" class="form-control" id="txtpaymode" value="<?=$rs1[0]['Ord_PaymentMode'];?>" size="40" /></td>
                        </tr>
						<tr>
                          <td width="15%" height="25">Payment Status: </td>
                          <td width="30%" height="25"><select name="selpaystatus" class="form-control" id="selpaystatus">
		  					<option>Select Payment Status</option>
							<option <?php if($rs1[0]['Ord_PaymentStatus']=='Processing'){ ?> selected <?php } ?> value="Processing">Processing</option>
							<option <?php if($rs1[0]['Ord_PaymentStatus']=='Pending-Tab'){ ?> selected <?php } ?> value="Pending-Tab">Pending-Tab</option>
							<option <?php if($rs1[0]['Ord_PaymentStatus']=='Completed'){ ?> selected <?php } ?> value="Completed">Completed</option>
							  <option <?php if($rs1[0]['Ord_PaymentStatus']=='Pending'){ ?> selected <?php } ?> value="Completed">Pending</option>
						  </select></td>						
						  <td width="15%" height="25">Transaction ID: </td>
                          <td width="30%" height="25"><input name="txttransac" type="text" class="form-control" id="txttransac" value="<?=$rs1[0]['Ord_TransactionID'];?>" size="40" /></td>
                         </tr>
						  <tr>
                          <td width="15%" height="25">What time would you like to eat?: </td>
                          <td width="30%" height="25"><select name="selwhattime" class="form-control" id="selwhattime">
		  					<option>Select</option>
							<option <?php if($rs1[0]['Ord_Whattime']=='ASAP'){ ?> selected <?php } ?> value="ASAP">ASAP</option>
							<option <?php if($rs1[0]['Ord_Whattime']=='1pm'){ ?> selected <?php } ?> value="1pm">1pm (Lunch)</option>
							<option <?php if($rs1[0]['Ord_Whattime']=='1.15pm'){ ?> selected <?php } ?> value="1.15pm">1.15pm (Lunch)</option>  
							<option <?php if($rs1[0]['Ord_Whattime']=='1:30pm'){ ?> selected <?php } ?> value="1:30pm">1:30pm (Lunch)</option>
							<option <?php if($rs1[0]['Ord_Whattime']=='1.45pm'){ ?> selected <?php } ?> value="1.45pm">1.45pm (Lunch)</option>  
							<option <?php if($rs1[0]['Ord_Whattime']=='2pm'){ ?> selected <?php } ?> value="2pm">2pm (Lunch)</option>
							<option <?php if($rs1[0]['Ord_Whattime']=='2.15pm'){ ?> selected <?php } ?> value="2.15pm">2.15pm (Lunch)</option>  
							<option <?php if($rs1[0]['Ord_Whattime']=='2:30pm'){ ?> selected <?php } ?> value="2:30pm">2:30pm (Lunch)</option>
							<option <?php if($rs1[0]['Ord_Whattime']=='2.45pm'){ ?> selected <?php } ?> value="2.45pm">2.45pm (Lunch)</option>  
							<option <?php if($rs1[0]['Ord_Whattime']=='3pm'){ ?> selected <?php } ?> value="3pm">3pm (Lunch)</option>
							<option <?php if($rs1[0]['Ord_Whattime']=='7pm'){ ?> selected <?php } ?> value="7pm">7pm (Dinner)</option>
							<option <?php if($rs1[0]['Ord_Whattime']=='7.15pm'){ ?> selected <?php } ?> value="7.15pm">7.15pm (Dinner)</option>  
							<option <?php if($rs1[0]['Ord_Whattime']=='7:30pm'){ ?> selected <?php } ?> value="7:30pm">7:30pm (Dinner)</option>
							<option <?php if($rs1[0]['Ord_Whattime']=='7.45pm'){ ?> selected <?php } ?> value="7.45pm">7.45pm (Dinner)</option>  
							<option <?php if($rs1[0]['Ord_Whattime']=='8pm'){ ?> selected <?php } ?> value="8pm">8pm (Dinner)</option>
							<option <?php if($rs1[0]['Ord_Whattime']=='8.15pm'){ ?> selected <?php } ?> value="8.15pm">8.15pm (Dinner)</option>  
							<option <?php if($rs1[0]['Ord_Whattime']=='8:30pm'){ ?> selected <?php } ?> value="8:30pm">8:30pm (Dinner)</option>
							<option <?php if($rs1[0]['Ord_Whattime']=='8.45pm'){ ?> selected <?php } ?> value="8.45pm">8.45pm (Dinner)</option>  
							<option <?php if($rs1[0]['Ord_Whattime']=='9pm'){ ?> selected <?php } ?> value="9pm">9pm (Dinner)</option>  
						  </select></td>						
						  <td width="15%" height="25">Where would you like to eat?: </td>
                          <td width="30%" height="25"><select name="selwhereeat" class="form-control" id="selwhereeat">
		  					<option>Select</option>
							<option <?php if($rs1[0]['Ord_Whereeat']=='Room / Balcony'){ ?> selected <?php } ?> value="Room / Balcony">Room / Balcony</option>
							<option <?php if($rs1[0]['Ord_Whereeat']=='Terrace'){ ?> selected <?php } ?> value="Terrace">Terrace</option>
							<option <?php if($rs1[0]['Ord_Whereeat']=='Gazebo'){ ?> selected <?php } ?> value="Gazebo">Gazebo</option>
							<option <?php if($rs1[0]['Ord_Whereeat']=='Poolside'){ ?> selected <?php } ?> value="Poolside">Poolside</option>
						  </select></td>
                         </tr>
						 <tr>						
                          <td width="15%" height="25">Instructions: </td>
                          <td width="30%" height="25"><textarea name="txtinstruct" class="form-control" id="txtinstruct"><?php echo stripslashes($rs1[0]['Ord_Instruction']);?></textarea></td> 
						  <td width="15%" height="25">Delivery Address: </td>
                          <td width="30%" height="25"><textarea name="txtaddress" class="form-control" id="txtaddress"><?php echo stripslashes($rs1[0]['Ord_DeliveryAddress']);?></textarea></td>
                        </tr>  
						<tr>						
                          <td width="15%" height="25">Comments or Requests: </td>
                          <td width="30%" height="25"><textarea name="txtcomment" class="form-control" id="txtcomment"><?php echo stripslashes($rs1[0]['Ord_Comments']);?></textarea></td> 
						  <td width="15%" height="25">&nbsp;</td>
                          <td width="30%" height="25">&nbsp;</td>
                        </tr>   
				        <tr>
                          <td width="15%" height="25">&nbsp;</td>
                          <td width="30%" height="25">&nbsp;</td>
                        </tr>     
                        <tr>
                          <td colspan="4" height="10"></td>
                        </tr>
                        <tr>
                          <td width="15%" align="right">&nbsp;</td>
                          <td width="30%"><?php if(isset($_REQUEST['txtuid']) && !empty($_REQUEST['txtuid'])) { ?>
                            <button type="submit" class="btn btn-primary pull-left"><i class="material-icons">save</i> Save Changes
                            <div class="ripple-container"></div>
                            </button>
                            <input name="txtuid" type="hidden" value="<?php echo $rs1[0]['Ord_Id'];?>" />
                            <input name="action" type="hidden" value="edit" />
                            <?php
                            } else

                            {
                                ?>
                            <button type="submit" class="btn btn-primary pull-left"><i class="material-icons">save</i> Save Changes
                            <div class="ripple-container"></div>
                            </button>
                            <input name="action" type="hidden" value="add" />
                            <?php } ?>
                            <button type="button" class="btn btn-primary pull-left" onClick="funcancel('order_listing')" style="background:#e53935"><i class="material-icons">close</i> Cancel
                            <div class="ripple-container"></div>
                            </button></td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <?php include "include/footer.php";?>
  </div>
</div>
</body>

<!--   Core JS Files   -->

<script src="assets/js/core/jquery.min.js"></script>
<script src="assets/js/core/popper.min.js"></script>
<script src="assets/js/general.js"></script>
<script src="assets/js/bootstrap-material-design.js"></script>
<script src="assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>

<!--  Charts Plugin, full documentation here: https://gionkunz.github.io/chartist-js/ -->

<script src="assets/js/plugins/chartist.min.js"></script>

<!-- Library for adding dinamically elements -->

<script src="assets/js/plugins/arrive.min.js" type="text/javascript"></script>

<!--  Notifications Plugin, full documentation here: http://bootstrap-notify.remabledesigns.com/    -->

<script src="assets/js/plugins/bootstrap-notify.js"></script>

<!-- Material Dashboard Core initialisations of plugins and Bootstrap Material Design Library -->

<script src="assets/js/material-dashboard.js?v=2.0.0"></script>

<!-- demo init -->

<script src="assets/js/plugins/demo.js"></script>

<style>
.table th, .table td {
    border: 0
}
</style>
</html>
