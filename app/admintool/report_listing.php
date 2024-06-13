<?php
require "system/config/configure.php";

include "include/checklogin.php";

require_once CLASS_PATH . 'admin_order.php';

$obj = new admin_order;

$moduleid = 55;

$action = $_REQUEST[ 'action' ];


if ( isset( $action ) && !empty( $action ) ) {
    $msg = '';
    $msg = $obj->funoperation();
}


if ( isset( $_REQUEST[ 'msgtextuser' ] ) && !empty( $_REQUEST[ 'msgtextuser' ] ) ) {

    $msg = $_REQUEST[ 'msgtextuser' ];

}

$keyword = $_REQUEST[ 'keyword' ];

$option = $_REQUEST[ 'option' ];


if ( !isset( $sorton ) )$sorton = "Ord_TableNo";


if ( !isset( $sorttype ) )$sorttype = "ASC";


$db_res = $obj->get_order_detail( $sorton, $sorttype, $option, $keyword, $var_limit );

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
<title>Report</title>
<!--     Fonts and icons     -->
<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" />
<link rel="stylesheet" href="assets/css/material-dashboard.css?v=2.0.0">
<link rel="stylesheet" href="assets/style.css">
<script language="javascript" src="assets/js/modal.popup.js"></script> 
<script>
    function status_edit(v_value) {
            document.location.href="order_detail.php?txtuid="+v_value;
    }
	function get_product_detail(val) {
        var align = 'center';												//Valid values; left, right, center
        var top = 100; 														//Use an integer (in pixels)
        var width = 900; 													//Use an integer (in pixels)
        var padding = 30;													//Use an integer (in pixels)
        var backgroundColor = '#FFFFFF'; 									//Use any hex code
        //var source = 'index.php?file=customer_popup&txtcustomerid=' + vval;//Refer to any page on your server, external pages are not valid e.g. http://www.google.co.uk
        var source = 'include/get_order_product_detail.php?orderid=' + val;
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
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap.min.css">
</head>
<body class="">
<div class="wrapper">
  <?php include "include/left.php";?>
  <div class="main-panel"> 
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-transparent  navbar-absolute fixed-top">
      <div class="container-fluid">
        <div class="navbar-wrapper"> <a class="navbar-brand" href="#pablo">Report</a> </div>
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
                <h4 class="card-title ">Listing</h4>
              </div>
              <div class="card-body">
                <form action="report_listing.php" name="frmsearch" method="post">
                  <table width="100%">
                    <tr>
                      <td><div class="searchcol"><strong>From Date :</strong>
                          <input name="txtfdate" type="date" class="form-control" id="txtfdate" value="<?php echo $_REQUEST['txtfdate']; ?>" size="40" />
                        </div>
                        <div class="searchcol"><strong>To Date :</strong>
                          <input name="txtdate" type="date" class="form-control" id="txtdate" value="<?php echo $_REQUEST['txtdate']; ?>" size="40" />
                        </div>
                        <div class="searchcol" style="width:auto;">
                          <input type="submit" value="Search" class="btn btn-primary">
                        </div></td>
                    </tr>
                  </table>
                </form>
                <div style="height:30px;"></div>
                <form id="frmorder" name="frmorder" method="post" action="report_listing.php" >
                  <div class="table-responsive">
                    <table id="example" class="table " style="width:100%" cellspacing="0" cellpadding="0">
                      <thead class=" text-primary">
                      <th> Table No. </th>
                        <th> Date </th>
                        <th> Name </th>
                        <th> Service Charge </th>
                        <th> Consumption Tax </th>
                        <th> VAT </th>
						  <th> Total </th>
						  <th> Discount </th>
						  <th> Grand Total </th>
                        </thead>
                      <tbody>
                        <?php
                        $searchstr = '';

                        if ( !empty( $_REQUEST[ 'txtfdate' ] ) ) {

                            $searchstr .= " AND Ord_Date >= '" . $_REQUEST[ 'txtfdate' ] . "'";
                        }
                        if ( !empty( $_REQUEST[ 'txtdate' ] ) ) {

                            $searchstr .= " AND Ord_Date <= '" . $_REQUEST[ 'txtdate' ] . "'";
                        }

                        $db_res = $dbobj->select( "select * from orders where Ord_OrderStatus=1 and Ord_PaymentStatus='Completed' " . $searchstr . " order by Ord_Id DESC" );
                        ?>
                        <?php
                        if ( count( $db_res ) > 0 ) {

                            for ( $i = 0; $i < count( $db_res ); $i++ ) {

                                if ( ( $i % 2 ) == 0 ) {
                                    $class = "odd";
                                } else {
                                    $class = "even";
                                }
								$service = $service+$db_res[$i]['Ord_ServiceCharge'];
								$contax = $contax+$db_res[$i]['Ord_ConTax'];
								$vat = $vat+$db_res[$i]['Ord_Vat'];
								$total = $total+$db_res[$i]['Ord_Total'];
								$discount = $discount+$db_res[$i]['Ord_DiscountValue'];
								$gtotal = $gtotal+$db_res[$i]['Ord_GrandTotal'];
                                ?>
                        <tr class="<?php echo $class?>">
                          <td><?php echo $db_res[$i]['Ord_TableNo'];?></td>
							<td><?php echo date("d/m/Y",strtotime($db_res[$i]['Ord_Date']));?></td>
                          <td><?php echo $db_res[$i]['Ord_FirstName'].' '.$db_res[$i]['Ord_LastName'];?></td>
                          <td><?php echo showprice($db_res[$i]['Ord_ServiceCharge']);?></td>
                          <td><?php echo showprice($db_res[$i]['Ord_ConTax']);?></td>
                         <td><?php echo showprice($db_res[$i]['Ord_Vat']);?></td>
						<td><?php echo showprice($db_res[$i]['Ord_Total']);?></td>
						<td><?php echo showprice($db_res[$i]['Ord_DiscountValue']);?></td>
						<td><?php echo showprice($db_res[$i]['Ord_GrandTotal']);?></td>	
                        </tr>
                        <?php
                        }

                        } else {
                            ?>
                        <tr class="<?php echo $class?>">
                          <td colspan="9" align="center">No record found</td>
                        </tr>
                        <?php }?>
						   <tr class="<?php echo $class?>">
                          <td><strong>Total</strong></td>
							<td>&nbsp;</td>
                          <td>&nbsp;</td>
                          <td><strong><?php echo showprice($service);?></strong></td>
                          <td><strong><?php echo showprice($contax);?></strong></td>
                         <td><strong><?php echo showprice($vat);?></strong></td>
						<td><strong><?php echo showprice($total);?></strong></td>
						<td><strong><?php echo showprice($discount);?></strong></td>
						<td><strong><?php echo showprice($gtotal);?></strong></td>
                        </tr>
                      </tbody>
                    </table>
                    <table>
                      <tr>
                        <td colspan="4">&nbsp;&nbsp;</td>
                      </tr>
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
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap.min.js"></script>

<style>
.form-check .form-check-label span {
    top: -10px;
}
.searchcol {
    width: 45%;
    padding: 0px 5px;
    display: inline-block;
}
</style>
<script>

$(document).ready(function() { 

    $('#example').DataTable(order: [[1, 'desc']],);

} );

</script>
<?php if($msg!='') {?>
<script>

            jQuery.notify({

                icon: "notifications",

                message: "<?=$msg?>"



            }, {

                type: 'info',

                timer: 3000,

                placement: {

                    from: 'top',

                    align: 'center'

                }

            });

        </script>
<?php }?>
<!--<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script type="application/javascript">
    $( document ).ready(function() {
		$.ajaxSetup({ cache: false });      
        $('select#selstatus').on('change',function(){
		   
           $.ajax({url: "changestatus.php?id="+document.getElementById("selservice3").value, success: function(result){
				if(result!='error') {             
					alert($(this).val());
				} else{
					alert($(this).val());
				}
		   }});			
        });
    });
</script>-->
</html>
