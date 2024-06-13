<?php
require "system/config/configure.php";

include "include/checklogin.php";

require_once CLASS_PATH . 'admin_order_item.php';

$obj = new admin_order_item;


if ( isset( $_REQUEST[ 'txtopid' ] ) && !empty( $_REQUEST[ 'txtopid' ] ) ) {

    $txtopid = $_REQUEST[ 'txtopid' ];

    $rs1 = $obj->get_ord_single_detail( $txtopid );

}


if ( strlen( $_REQUEST[ 'action' ] ) != 0 ) {


    $order = $_REQUEST[ 'orid' ];

    $prod = $_REQUEST[ 'prodid' ];

    $price = $_REQUEST[ 'txtprice' ];

    $quant = $_REQUEST[ 'quant' ];
    $ostatus = $_REQUEST[ 'selostatus' ];
	$option = $_REQUEST['seloption'];

    if ( $_REQUEST[ 'action' ] == "edit" ) {

        $opid = $_REQUEST[ 'txtopid' ];

        $msgtextuser = $obj->update_ord_detail($opid, $order, $prod, $price, $quant, $ostatus, $option);
        ?>
<script language="javascript">

			document.location.href="order_item_listing.php?or_id=<?php echo $_REQUEST['or_id']; ?>&msgtextuser=+<?php echo $msgtextuser?>+";

		</script>
<?php

} elseif ( $_REQUEST[ 'action' ] == "add" ) {

        $msgtextuser = ' Items added Successfully';

        $inserId = $obj->add_ord_detail($order, $prod, $price, $quant, $ostatus, $option);
        ?>
<script language="javascript">

				document.location.href="order_item_listing.php?or_id=<?php echo $_REQUEST['or_id']; ?>&msgtextuser=+<?php echo $msgtextuser?>+";

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
<title> Order Items </title>

<!--     Fonts and icons     -->

<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" />
<link rel="stylesheet" href="assets/css/material-dashboard.css?v=2.0.0">
<link rel="stylesheet" href="assets/style.css">
<script>

    function status_edit(v_value) {

            document.location.href=v_value+".php?or_id=<?php echo $_REQUEST['or_id']; ?>";

    }

    </script> 
<script>

    function frmcheck() {

            if(!chkForm("frmorp", "prodid", "validateblank", "Please Select Item","txtprice", "validateblank", "Please Enter Cost","quant", "validateblank", "Please Enter Quantity")){

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
        <div class="navbar-wrapper"> <a class="navbar-brand" href="#pablo">Items</a> </div>
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
                <form id="frmorp" name="frmorp" method="post" action="order_item_detail.php?or_id=<?php echo $_REQUEST['or_id'];?>" onSubmit="return frmcheck()" enctype="multipart/form-data">
                  <div class="table-responsive">
                    <table id="example" class="table" style="width:100%" cellspacing="0" cellpadding="0">
                      <tbody>
                      <input name="orid" type="hidden" class="form-control" id="orid" value="<?php echo $_REQUEST['or_id'];?>" size="40" />
                      <tr>
                        <td width="15%" height="25"><span class="radfont">*</span>Items</td>
                        <td width="30%" height="25"><?=prodtypecombo($rs1[0]['OI_ItemId'])?></td>
                        <td width="15%" height="25"><span class="radfont">*</span> Cost</td>
                        <td width="30%" height="25"><input name="txtprice" type="text" class="form-control" id="txtprice" value="<?=$rs1[0]['OI_Cost'];?>" size="40" /></td>
                      </tr>
                     
                      <tr>
                        <td width="15%" height="25"><span class="radfont">*</span>Quantity</td>
                        <td width="30%" height="25"><input name="quant" type="text" class="form-control" id="quant" value="<?=$rs1[0]['OI_Quantity'];?>" size="40" /></td>
                        <td width="15%" height="25">Order Status: </td>
                          <td width="30%" height="25"><select name="selostatus" class="form-control" id="selostatus">
						  <?php $blogdata = $dbobj -> select("SELECT * FROM order_status where OS_Status='Active' order by OS_Title desc");?>
		  <option>Select Status</option>
				<?php  for($j = 0;$j < count($blogdata);$j++) { ?>
				<option <?php if($rs1[0]['OI_Status']==$blogdata[$j]['OS_Id']){ ?> selected="selected" <?php } ?> value="<?php echo $blogdata[$j]['OS_Id'];?>"><?php echo $blogdata[$j]['OS_Title'];?></option>
				<?php } ?>
						  </select></td>      
                      </tr>
						  <tr>
                        <td width="15%" height="25">Item Option: </td>
                          <td width="30%" height="25"><select name="seloption" class="form-control" id="seloption">
						  <?php $optiondata = $dbobj -> select("SELECT * FROM item_option where io_status='Active' order by io_title asc");?>
		  <option value="0">Select Option</option>
				<?php  for($j = 0;$j < count($optiondata);$j++) { ?>
				<option <?php if($rs1[0]['OI_Item_Option']==$optiondata[$j]['io_id']){ ?> selected="selected" <?php } ?> value="<?php echo $optiondata[$j]['io_id'];?>"><?php echo $optiondata[$j]['io_title'];?></option>
				<?php } ?>
						  </select></td>      
                      </tr>
                      <tr>
                        <td colspan="4" height="10"></td>
                      </tr>
                      <tr>
                        <td width="15%" align="right">&nbsp;</td>
                        <td width="30%"><?php if(isset($_REQUEST['txtopid']) && !empty($_REQUEST['txtopid'])) { ?>
                          <button type="submit" class="btn btn-primary pull-left btnclsadd"><i class="material-icons">save</i> Save Changes
                          <div class="ripple-container"></div>
                          </button>
                          <input name="txtopid" type="hidden" value="<?php echo $rs1[0]['OI_Id'];?>" />
                          <input name="action" type="hidden" value="edit" />
                          <?php
                          } else

                          {
                              ?>
                          <button type="submit" class="btn btn-primary pull-left btnclsadd"><i class="material-icons">save</i> Save Changes
                          <div class="ripple-container"></div>
                          </button>
                          <input name="action" type="hidden" value="add" />
                          <?php } ?>
                          <button type="button" class="btn btn-primary pull-left btnclsadd" onClick="funcancel2('order_item_listing.php?or_id=<?php echo $_REQUEST['or_id']; ?>')" style="background:#e53935"><i class="material-icons">close</i> Cancel
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
  <div id="loader" class="loader"></div>
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
<script>

    $( document ).ready(function() {

        var otp='';

        $('#prodid').focusout(function(){

            $('#loader').show();

            $.ajax({url: "ajax12.php?prodid="+document.getElementById("prodid").value, success: function(result){

                if(result!='error') {

                    var r=result.split("|");

                    document.getElementById("txtprice").value=r[0];

                    

                  

                } 

                $('#loader').hide();

            }});

        });

    });

</script>
</html>
