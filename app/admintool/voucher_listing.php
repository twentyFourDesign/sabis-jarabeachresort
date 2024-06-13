<?php require "system/config/configure.php";

include "include/checklogin.php";

require_once CLASS_PATH.'admin_voucher.php';

$obj = new admin_voucher;



$moduleid=51;



$action = $_REQUEST['action'];



if(isset($action) && !empty($action)) {

	$msg='';

	$msg=$obj->funoperation();

}



if(isset($_REQUEST['msgtextuser']) && !empty($_REQUEST['msgtextuser'])) {

	$msg=$_REQUEST['msgtextuser'];

}



$keyword=$_REQUEST['keyword'];

$option=$_REQUEST['option'];



if (!isset($sorton)) $sorton = "Vou_Title";



if (!isset($sorttype)) $sorttype = "ASC";



$db_res = $obj->get_voucher_detail($sorton, $sorttype, $option, $keyword, $var_limit);

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
<title>Voucher</title>
<!--     Fonts and icons     -->
<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" />
<link rel="stylesheet" href="assets/css/material-dashboard.css?v=2.0.0">
<link rel="stylesheet" href="assets/style.css">
<script>

    function status_edit(v_value) {

            document.location.href="voucher_detail.php?txtuid="+v_value;

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
        <div class="navbar-wrapper"> <a class="navbar-brand" href="#pablo">Voucher</a> </div>
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
                <form id="frmvoucher" name="frmvoucher" method="post" action="voucher_listing.php" >
                  <div class="table-responsive">
                    <table id="example" class="table " style="width:100%" cellspacing="0" cellpadding="0">
                      <thead class=" text-primary">
                      <th width="5%"> </th>
                        <th> Title </th>
						  <th> Code </th>
						  <th> Amount </th>
                        <th> Status </th>
                        </thead>
                      <tbody>
                        <?php if(count($db_res)>0) {

                                                      for($i = 0;$i < count($db_res);$i++) { 

                                                        if(($i%2)==0) { $class = "odd"; } else { $class = "even"; } ?>
                        <tr class="<?php echo $class?>">
                          <td style="padding: 0px 8px 0px 18px;"><div class="form-check">
                              <label class="form-check-label">
                              <input class="form-check-input" id='chk' name="chk[]" type="checkbox" value="<?php echo $db_res[$i]["Vou_Id"];?>" >
                              <span class="form-check-sign"> <span class="check"></span> </span> </label>
                            </div></td>
                          <td <?php if(in_array($moduleid,$_SESSION['sess_edit'])) {?>onClick="status_edit(<?php echo $db_res[$i]['Vou_Id'];?>)" style="padding: 0px 8px;cursor:pointer;"<?php }?>><?php echo $db_res[$i]['Vou_Title'];?></td>
                          <td><?php echo $db_res[$i]['Vou_Code'];?></td>
						<td><?php echo showprice($db_res[$i]['Vou_Amount']);?></td>
						<td><?php echo $db_res[$i]['Vou_Status'];?></td>	
                        </tr>
                        <?php }

                                                    } else {?>
                        <tr class="<?php echo $class?>">
                          <td colspan="4" align="center">No record found</td>
                        </tr>
                        <?php }?>
                      </tbody>
                    </table>
                    <table>
                      <tr>
                        <td colspan="4">&nbsp;&nbsp;</td>
                      </tr>
                      <tr>
                        <td colspan="5"><input type="hidden" name="action" id="action" />
                          <?php if(in_array($moduleid,$_SESSION['sess_add'])) {?>
                          <button type="button" class="btn btn-primary pull-left btnclsadd" onClick="javascript:document.location.href='voucher_detail.php'"><i class="material-icons">add</i> Add
                          <div class="ripple-container"></div>
                          </button>
                          <?php }?>
                          <?php if (count($db_res)) { 

                                                              if(in_array($moduleid,$_SESSION['sess_delete'])) {?>
                          <button type="button" class="btn btn-primary pull-left btnclsdel" name="btndelete" onClick="setaction('chk[]','delete', 'Are you sure, you want to delete selected records?', 'frmvoucher')"  style="background:#e53935"><i class="material-icons">delete</i> Delete
                          <div class="ripple-container"></div>
                          </button>
                          <?php }

                                                              if(in_array($moduleid,$_SESSION['sess_edit'])) {?>
                          <button type="button" class="btn btn-primary pull-left btnclsact" name="btnactive" onClick="setaction('chk[]','active', 'Are you sure, you want to Active selected records?', 'frmvoucher')"  style="background:#E25D14"><i class="material-icons">info</i> Active
                          <div class="ripple-container"></div>
                          </button>
                          <button type="button" class="btn btn-primary pull-left btnclsinact" name="btninactive" onClick="setaction('chk[]','inactive', 'Are you sure, you want to Inactive selected records?', 'frmvoucher')"  style="background:#fb8c00"><i class="material-icons">info</i> Inactive
                          <div class="ripple-container"></div>
                          </button>
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
</html>
