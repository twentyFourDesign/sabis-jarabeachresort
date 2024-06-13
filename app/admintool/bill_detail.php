<?php
require "system/config/configure.php";

include "include/checklogin.php";

require_once CLASS_PATH . 'admin_bill.php';

$obj = new admin_bill;


if ( isset( $_REQUEST[ 'txtbillid' ] ) && !empty( $_REQUEST[ 'txtbillid' ] ) ) {

    $txtbillid = $_REQUEST[ 'txtbillid' ];

    $rs1 = $obj->get_bill_single_detail( $txtbillid );

}


if ( strlen( $_REQUEST[ 'action' ] ) != 0 ) {

    $firstname = $_REQUEST['txtfirstname'];
    $email = $_REQUEST['txtemail'];
    $phone = $_REQUEST['txtphone'];
    $address = $_REQUEST['txtaddress'];
    $status = $_REQUEST['selstatus'];
	$total = $_REQUEST['txttotal'];
	
	$service1 = $_REQUEST['selservice1'];
	$qnty1 = $_REQUEST['txtqnty1'];
	$price1 = $_REQUEST['txtprice1'];
	$total1 = $_REQUEST['txttotal1'];
	
	$service2 = $_REQUEST['selservice2'];
	$qnty2 = $_REQUEST['txtqnty2'];
	$price2 = $_REQUEST['txtprice2'];
	$total2 = $_REQUEST['txttotal2'];
	
	$service3 = $_REQUEST['selservice3'];
	$qnty3 = $_REQUEST['txtqnty3'];
	$price3 = $_REQUEST['txtprice3'];
	$total3 = $_REQUEST['txttotal3'];


    if ( $_REQUEST[ 'action' ] == "edit" ) {

        $billid = $_REQUEST[ 'txtbillid' ];

        $msgtextbill = $obj->update_bill_detail( $status, $billid, $firstname, $email, $phone, $address, $total, $service1, $qnty1, $price1, $total1, $service2, $qnty2, $price2, $total2, $service3, $qnty3, $price3, $total3);
        ?>
<script>
	document.location.href="bill_listing.php?msgtextbill=+<?php echo $msgtextbill?>+";
</script>
<?php

} elseif ( $_REQUEST[ 'action' ] == "add" ) {
        $inserId = $obj->add_bill_detail( $status, $firstname, $email, $phone, $address, $total, $service1, $qnty1, $price1, $total1, $service2, $qnty2, $price2, $total2, $service3, $qnty3, $price3, $total3);
?>
<script>
	document.location.href="bill_listing.php?msgtextbill=+Bill Detail added successfully+";
</script>
<?php
}

}

?>

<!DOCTYPE html>

<html lang="en">
<head>
<meta charset="utf-8">
<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, bill-scalable=0" name="viewport" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
<title> Bill </title>

<!--     Fonts and icons     -->

<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" />
<link rel="stylesheet" href="assets/css/material-dashboard.css?v=2.0.0">
<link rel="stylesheet" href="assets/style.css">
<script>

    function status_edit(v_value) {

            document.location.href=v_value+".php";

    }

    </script> 
<script>

function frmcheck() {

	if(!chkForm("frmbilldetail", "txtfirstname", "validateblank", "Please Enter Name", "txtemail", "validateblank", "Please Enter Email Address")){
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
        <div class="navbar-wrapper"> <a class="navbar-brand" href="#pablo">Bill</a> </div>
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
                <form id="frmbilldetail" name="frmbilldetail" method="post" action="bill_detail.php" onSubmit="return frmcheck()" enctype="multipart/form-data">
                  <div class="table-responsive">
                    <table id="example" class="table" style="width:100%" cellspacing="0" cellpadding="0">
                      <tbody>
                        
                        <tr>
                          <td width="15%" height="25"><span class="radfont">*</span>Name :</td>
                          <td width="30%" height="25"><input name="txtfirstname" type="text" class="form-control" id="txtfirstname" value="<?=$rs1[0]['Bil_Name'];?>" size="40" /></td>
                          <td width="15%" height="25"><span class="radfont">*</span>Email Address :</td>
						<td width="30%" height="25"><input name="txtemail" type="text" class="form-control" id="txtemail" value="<?=$rs1[0]['Bil_Email'];?>" size="40" /></td>
                         </tr>
                        <tr>
                          <td width="15%" height="25">Phone :</td>
                          <td width="30%" height="25"><input name="txtphone" type="text" class="form-control" id="txtphone" value="<?=$rs1[0]['Bil_Phone'];?>" size="40" /></td>
                          <td width="15%" height="25">Address :</td>
                          <td width="30%" height="25"><textarea style="min-height: 30px;" rows="2" class="form-control" name="txtaddress" id="txtaddress"><?=$rs1[0]['Bil_Address'];?></textarea></td>
						</tr>
                        <tr>
                          <td width="15%" height="25">Status:</td>
                          <td width="30%" height="25"><select name="selstatus" class="form-control">
                              <?php echo $rs1[0]['Bil_Status']=="Active" ? '<option value="Active" selected="selected">Active</option > ' : '
<option value="Active">Active</option> '; ?> <?php echo $rs1[0]['Bil_Status']=="Inactive" ? '<option value="InActive" selected="selected">InActive</option>' : '<option value="InActive">InActive</option>'; ?>
                            </select></td>
                          
                        </tr>
                        <tr>
                          <td colspan="4" height="30"></td>
                        </tr>
						  <tr>
                          <td colspan="4"><table width="100%" border="0">
  <tbody>
    <tr>
      <td width="25%"><select name="selservice1" class="form-control" id="selservice1">
						  <?php $blogdata = $dbobj -> select("SELECT * FROM dg where DG_Status='Active' order by DG_Title desc");?>
		  <option>Select DG</option>
				<?php  for($i = 0;$i < count($blogdata);$i++) { ?>
				<option <?php if($blogdata[$i]['DG_Id']==$rs1[0]['Bil_Service1']){ ?> selected="selected" <?php } ?> value="<?php echo $blogdata[$i]['DG_Id'];?>"><?php echo $blogdata[$i]['DG_Title'];?></option>
				<?php } ?>
						  </select></td>
      <td><input name="txtqnty1" type="text" class="form-control" id="txtqnty1" value="<?php if($rs1[0]['Bil_Quantity1']!=''){ echo $rs1[0]['Bil_Quantity1']; }else{ echo 0; }?>" placeholder="Quantity" size="40" /></td>
	<td><input name="txtprice1" type="text" readonly class="form-control" id="txtprice1" value="<?php if($rs1[0]['Bil_Cost1']!=''){ echo $rs1[0]['Bil_Cost1']; }else{ echo 0.00; }?>" placeholder="Cost"  /></td>	
      <td><input name="txttotal1" readonly type="text" class="form-control" id="txttotal1" value="<?php if($rs1[0]['Bil_Total1']!=''){ echo $rs1[0]['Bil_Total1']; }else{ echo 0.00; }?>" placeholder="Total" size="40" /></td>
	  
    </tr>
    <tr>
      <td width="25%"><select name="selservice2" class="form-control" id="selservice2">
						  <?php $blogdata = $dbobj -> select("SELECT * FROM switchgear_panel where SP_Status='Active' order by SP_Title desc");?>
		  <option>Select Switchgear Panel</option>
				<?php  for($i = 0;$i < count($blogdata);$i++) { ?>
				<option <?php if($blogdata[$i]['SP_Id']==$rs1[0]['Bil_Service2']){ ?> selected="selected" <?php } ?> value="<?php echo $blogdata[$i]['SP_Id'];?>"><?php echo $blogdata[$i]['SP_Title'];?></option>
				<?php } ?>
						  </select></td>
    <td><input name="txtqnty2" type="text" class="form-control" id="txtqnty2" value="<?php if($rs1[0]['Bil_Quantity2']!=''){ echo $rs1[0]['Bil_Quantity2']; }else{ echo 0; }?>" placeholder="Quantity" size="40"></td>
	<td><input name="txtprice2" type="text" readonly class="form-control" id="txtprice2" value="<?php if($rs1[0]['Bil_Cost2']!=''){ echo $rs1[0]['Bil_Cost2']; }else{ echo 0.00; }?>" placeholder="Cost"  /></td>	
      <td><input name="txttotal2" readonly type="text" class="form-control" id="txttotal2" value="<?php if($rs1[0]['Bil_Total2']!=''){ echo $rs1[0]['Bil_Total2']; }else{ echo 0.00; }?>" placeholder="Total" size="40" /></td>
	 
    </tr>
    <tr>
      <td width="25%"><select name="selservice3" class="form-control" id="selservice3">
						  <?php $blogdata = $dbobj -> select("SELECT * FROM automation where Aut_Status='Active' order by Aut_Title desc");?>
		  <option>Select SAS/Automation</option>
				<?php  for($i = 0;$i < count($blogdata);$i++) { ?>
				<option <?php if($blogdata[$i]['Aut_Id']==$rs1[0]['Bil_Service3']){ ?> selected="selected" <?php } ?> value="<?php echo $blogdata[$i]['Aut_Id'];?>"><?php echo $blogdata[$i]['Aut_Title'];?></option>
				<?php } ?>
						  </select></td>
      <td><input name="txtqnty3" type="text" class="form-control" id="txtqnty3" value="<?php if($rs1[0]['Bil_Quantity3']!=''){ echo $rs1[0]['Bil_Quantity3']; }else{ echo 0; }?>" placeholder="Quantity" size="40" /></td>
	<td><input name="txtprice3" type="text" readonly class="form-control" id="txtprice3" value="<?php if($rs1[0]['Bil_Cost3']!=''){ echo $rs1[0]['Bil_Cost3']; }else{ echo 0.00; }?>" placeholder="Cost"  /></td>	
      <td><input name="txttotal3" readonly type="text" class="form-control" id="txttotal3" value="<?php if($rs1[0]['Bil_Total3']!=''){ echo $rs1[0]['Bil_Total3']; }else{ echo 0.00; }?>" placeholder="Total" size="40" /></td>
	  
    </tr>
  </tbody>
</table>
</td>
                        </tr>
						<tr>
                          <td colspan="4" height="30"></td>
                        </tr>
						   <tr>
                          <td width="15%" height="25">Total :</td>
                          <td width="30%" height="25"><input name="txttotal" type="text" class="form-control" id="txttotal" value="<?=$rs1[0]['Bil_Total'];?>" size="40" /></td>                       
						</tr>
                        <tr>
                          <td width="15%" align="right">&nbsp;</td>
                          <td width="30%"><?php if(isset($_REQUEST['txtbillid']) && !empty($_REQUEST['txtbillid'])) { ?>
                            <button type="submit" class="btn btn-primary pull-left"><i class="material-icons">save</i> Save Changes
                            <div class="ripple-container"></div>
                            </button>
                            <input name="txtbillid" type="hidden" value="<?php echo $rs1[0]['Bil_Id'];?>" />
                            <input name="action" type="hidden" value="edit" />
                            <?php } else { ?>
                            <button type="submit" class="btn btn-primary pull-left"><i class="material-icons">save</i> Save Changes
                            <div class="ripple-container"></div>
                            </button>
                            <input name="action" type="hidden" value="add" />
                            <?php } ?>
                            <button type="button" class="btn btn-primary pull-left" onClick="funcancel('bill_listing')" style="background:#e53935"><i class="material-icons">close</i> Cancel
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
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
    $( document ).ready(function() {
		$.ajaxSetup({ cache: false });
        
        $('#selservice1').on('change',function(){
           $.ajax({url: "getcost1.php?id="+document.getElementById("selservice1").value, success: function(result){
                if(result!='error') {             
                    document.getElementById("txtprice1").value=result;
                } else{
					document.getElementById("txtprice1").value='';
				}
           }});
			gettotal1();	
        });
		$('#txtqnty1').focusout(function(){
          
			gettotal1();	
        });
      
    });
	$( document ).ready(function() {
		$.ajaxSetup({ cache: false });

		$('#selservice2').on('change',function(){
		   $.ajax({url: "getcost2.php?id="+document.getElementById("selservice2").value, success: function(result){
				if(result!='error') {             
					document.getElementById("txtprice2").value=result;
				} else{
					document.getElementById("txtprice2").value='';
				}
		   }});
			gettotal2();	
		});
		$('#txtqnty2').focusout(function(){
			gettotal2();	
		});
	});
	$( document ).ready(function() {
		$.ajaxSetup({ cache: false });

		$('#selservice3').on('change',function(){
		   $.ajax({url: "getcost3.php?id="+document.getElementById("selservice3").value, success: function(result){
				if(result!='error') {             
					document.getElementById("txtprice3").value=result;
				} else{
					document.getElementById("txtprice3").value='';
				}
		   }});
			gettotal3();	
		});
		$('#txtqnty3').focusout(function(){
			gettotal3();	
		});
	});
function gettotal1(){
	document.getElementById("txttotal1").value=document.getElementById("txtprice1").value*document.getElementById("txtqnty1").value;
	document.getElementById("txttotal").value='';	
	document.getElementById("txttotal").value= (parseFloat(document.getElementById("txttotal1").value) + parseFloat(document.getElementById("txttotal2").value) + parseFloat(document.getElementById("txttotal3").value)).toFixed(2);
}
function gettotal2(){
	document.getElementById("txttotal2").value=document.getElementById("txtprice2").value*document.getElementById("txtqnty2").value;
	document.getElementById("txttotal").value='';	
	document.getElementById("txttotal").value= (parseFloat(document.getElementById("txttotal1").value) + parseFloat(document.getElementById("txttotal2").value) + parseFloat(document.getElementById("txttotal3").value)).toFixed(2);
}
function gettotal3(){
document.getElementById("txttotal3").value=document.getElementById("txtprice3").value*document.getElementById("txtqnty3").value;
document.getElementById("txttotal").value='';
document.getElementById("txttotal").value= (parseFloat(document.getElementById("txttotal1").value) + parseFloat(document.getElementById("txttotal2").value) + parseFloat(document.getElementById("txttotal3").value)).toFixed(2);
}	
</script>
<style>
.table th, .table td {
    border: 0
}
</style>
</html>