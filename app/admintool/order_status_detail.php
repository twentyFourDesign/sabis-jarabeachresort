<?php
require "system/config/configure.php";

include "include/checklogin.php";

require_once CLASS_PATH . 'admin_order_status.php';

$obj = new admin_order_status;


if ( isset( $_REQUEST[ 'txtuid' ] ) && !empty( $_REQUEST[ 'txtuid' ] ) ) {

    $txtuid = $_REQUEST[ 'txtuid' ];

    $rs1 = $obj->get_order_status_single_detail( $txtuid );

}


if ( strlen( $_REQUEST[ 'action' ] ) != 0 ) {


    $title = $_REQUEST[ 'title' ];

    $status = $_REQUEST[ 'status' ];


    if ( $_REQUEST[ 'action' ] == "edit" ) {

        $uid = $_REQUEST[ 'txtuid' ];

        $msgtextuser = $obj->update_order_status_detail( $status, $uid, $title );
        ?>
<script>

			document.location.href="order_status_listing.php?msgtextuser=+<?php echo $msgtextuser?>+";

		</script>
<?php

} elseif ( $_REQUEST[ 'action' ] == "add" ) {

        $inserId = $obj->add_order_status_detail( $status, $title );


        ?>
<script>

			document.location.href="order_status_listing.php?msgtextuser=+Order Status added successfully+";

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
<title> Order Status </title>

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

            if(!chkForm("frmu", "title", "validateblank", "Please Enter Title")){

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
        <div class="navbar-wrapper"> <a class="navbar-brand" href="#pablo">Order Status</a> </div>
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
                <form id="frmu" name="frmu" method="post" action="order_status_detail.php" onSubmit="return frmcheck()" enctype="multipart/form-data">
                  <div class="table-responsive">
                    <table id="example" class="table" style="width:100%" cellspacing="0" cellpadding="0">
                      <tbody>
                        <tr>
                          <td width="15%" height="25"><span class="radfont">*</span>Title</td>
                          <td width="30%" height="25"><input name="title" type="text" class="form-control" id="title" value="<?=$rs1[0]['OS_Title'];?>" size="40" /></td>
                          <td width="15%" height="25"> Status:</td>
                          <td width="30%" height="25"><select name="status" class="form-control">
                              <?php echo $rs1[0]['OS_Status']=="Active" ? '<option value="Active" selected="selected">Active</option>' : '<option value="Active">Active</option>'; ?> <?php echo $rs1[0]['OS_Status']=="Inactive" ? '<option value="Inactive" selected="selected">Inactive</option> ' : '<option value="Inactive">Inactive</option>'; ?>
                            </select></td>
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
                            <input name="txtuid" type="hidden" value="<?php echo $rs1[0]['OS_Id'];?>" />
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
                            <button type="button" class="btn btn-primary pull-left" onClick="funcancel('order_status_listing')" style="background:#e53935"><i class="material-icons">close</i> Cancel
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
