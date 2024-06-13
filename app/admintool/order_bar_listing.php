<?php require "system/config/configure.php";

include "include/checklogin.php";

require_once CLASS_PATH.'admin_order.php';

$obj = new admin_order;

$moduleid=57;

$action = $_REQUEST['action'];

if(isset($_REQUEST['selstatus']) && !empty($_REQUEST['selstatus'])) {

	for($k=0;$k<count($_REQUEST['selstatus']);$k++){
			$dbobj->update("update orders set Ord_OrderStatus=".$_REQUEST['selstatus'][$k]." where Ord_Id = ".$_REQUEST['ord'][$k]);
	}
?>
<script>
	document.location.href="order_bar_listing.php?msgtextuser=+Order status changed successfully+";
</script>
<?php
}

if(isset($action) && !empty($action)) {
	$msg='';
	$msg=$obj->funoperation();
}


if(isset($_REQUEST['msgtextuser']) && !empty($_REQUEST['msgtextuser'])) {

	$msg=$_REQUEST['msgtextuser'];

}

$keyword=$_REQUEST['keyword'];

$option=$_REQUEST['option'];



if (!isset($sorton)) $sorton = "Ord_TableNo";



if (!isset($sorttype)) $sorttype = "ASC";



$db_res = $obj->get_order_detail($sorton, $sorttype, $option, $keyword, $var_limit);

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
<title>Order</title>
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

  <div class="main-panel" style="width: 100%;">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-transparent  navbar-absolute fixed-top">
      <div class="container-fluid">
        <div class="navbar-wrapper"> <a class="navbar-brand" href="#pablo">Orders</a> </div>
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
                <form id="frmorder" name="frmorder" method="post" action="order_bar_listing.php" >
                  <div class="table-responsive">
                    <table id="example" class="table " style="width:100%" cellspacing="0" cellpadding="0">
                      <thead class=" text-primary">
                     
                        <th> Table No. </th>
						   <th> No Of Guest </th>
						  <th> Name </th>
						  
                        <th> Status </th>
						<th> Item Etc. </th>  
                        </thead>
                      <tbody>
                        <?php 
                        //echo "select * from orders where Ord_PaymentStatus='Completed' or Ord_PaymentStatus='Pending-Tab' order by Ord_Id DESC"; exit();
						  $db_res = $dbobj->select( "select * from orders where Ord_PaymentStatus='Completed' or Ord_PaymentStatus='Pending-Tab' order by Ord_Id DESC limit 200" );
						  //for($i = 0;$i < count($db_res);$i++) {
						  //echo ($db_res[$i]['Ord_PaymentStatus']);}
						  //echo count($db_res);
						  //echo "\n";
						  //echo $_SESSION['sess_usertype'];
						  if(count($db_res)>0) {
                                        for($i = 0;$i < count($db_res);$i++) {
                                            $cats = $dbobj->select( "SELECT * FROM menu_category where MC_Utype=".$_SESSION['sess_usertype']." and MC_Status='Active'");
                                            //echo "\n";
                                            for($cq=0; $cq<count($cats); $cq++) {
                                                $qidsma.=$cats[$cq]['MC_Id'].',';
                                            }
                                            //echo "select * from order_item join menu_item on order_item.OI_ItemId=menu_item.MI_Id where OI_OrderId='".$db_res[$i]['Ord_Id']."' and MI_CategoryId IN ('".str_replace(",","','",rtrim($qidsma,','))."') order by OI_Status DESC LIMIT 1"; exit();
                                            $mists = $dbobj->select( "select * from order_item join menu_item on order_item.OI_ItemId=menu_item.MI_Id where OI_OrderId='".$db_res[$i]['Ord_Id']."' and MI_CategoryId IN ('".str_replace(",","','",rtrim($qidsma,','))."') order by OI_Status DESC LIMIT 1" );
                                            //echo ($mists[0][]);
                                            if(count($mists)>0) {
                                                $ordersts=get_value('OS_Title','order_status','OS_Id', $mists[0]['OI_Status']);
                                            }
                                            if(($mists[0]['OI_Status']=='4' || $mists[0]['OI_Status']=='2') && $mists[0]['OI_Status']!='') {
                                                if(($i%2)==0) { $class = "odd"; } 
                                                else { $class = "even"; } ?>
                                                    <tr class="<?php echo $class?> cls<?=$mists[0]['OI_Status'];?>">
                                                     
                                                        <td><?php echo $db_res[$i]['Ord_TableNo'];?></td>
                            							<td><?php echo $db_res[$i]['Ord_NoOfGuest'];?></td>
                            							<td><?php echo $db_res[$i]['Ord_FirstName'].' '.$db_res[$i]['Ord_LastName'];?></td>
                            						    <td><?=$ordersts;?></td>
							
						                                <td><a href="javascript:get_product_detail(<?php echo $db_res[$i]['Ord_Id'];?>);" type="button" class="btn btn-primary pull-left"><i style="color: #FFFFFF;" class="material-icons">list</i> &nbsp;<div class="ripple-container"></div></a></td>	
                                                    </tr>
                                                <?php 
                                                    
                                                }
                                        }

                            } else { ?>
                                <tr class="<?php echo $class?>">
                                <td colspan="5" align="center">No record found</td>
                                </tr>
                                <?php 
                                }?>
                    </tbody>
                </table>
                    <table>
                      <tr>
                        <td colspan="4">&nbsp;&nbsp;</td>
                      </tr>
                      <tr>
                        <td colspan="5"><input type="hidden" name="action" id="action" />
                        
                          <?php if (count($db_res)) { 

                                                              if(in_array($moduleid,$_SESSION['sess_edit'])) {?>
                         
					
							<!--<button type="submit" class="btn btn-primary pull-left btnclsinact" name="btncompleted" style="background:#fb8c00"><i class="material-icons">info</i> Change Status
                          <div class="ripple-container"></div>
                          </button>	-->
								
                          <?php } 

                                                          }?>
                        </td>
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
.form-check .form-check-label span {top: -10px;}
.cls2 { background:#FFCCCB; }
.cls4 { background:#FEFFCC; }
.cls1 { background:#50D050; }
</style>
<script>

$(document).ready(function() { 

    $('#example').DataTable();

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
<script>
function stschng(miid) {
    var mid = $("#selostatus-"+miid).val();
    $.ajax({url: "include/upsts.php?oists="+mid+"&oid="+miid, success: function(result){
    }});
}
function orcomplete(oid) {
    $.ajax({url: "include/upstsall.php?oid="+oid+"&ut="+<?=$_SESSION['sess_usertype']?>, success: function(result){
        $("select[name='selostatus']").val("1");
    }});
}
</script>
</html>
