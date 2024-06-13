<?php require "system/config/configure.php";
include "include/checklogin.php";
require_once CLASS_PATH.'admin_configure.php';
$obj = new admin_configure;
$moduleid=3;
$action = $_REQUEST['action'];

if(isset($action) && !empty($action)) {
	$msg='';
	$msg=$obj->funoperation();
}

if(isset($_REQUEST['msgtextconfigure']) && !empty($_REQUEST['msgtextconfigure'])) {
	$msg=$_REQUEST['msgtextconfigure'];
}

$keyword=$_REQUEST['keyword'];
$option=$_REQUEST['option'];

if (!isset($sorton)) $sorton = "Con_Title";

if (!isset($sorttype)) $sorttype = "ASC";

$db_res = $obj->get_configure_detail($sorton, $sorttype, $option, $keyword, $var_limit);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>
        Configure
    </title>
    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" />
    <link rel="stylesheet" href="assets/css/material-dashboard.css?v=2.0.0">
    <link rel="stylesheet" href="assets/style.css">
    <script>
    function status_edit(v_value) {
            document.location.href="configure_detail.php?txtconfigureid="+v_value;
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
                    <div class="navbar-wrapper">
                        <a class="navbar-brand" href="#pablo">Configure</a>
                    </div>
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
                                    <form id="frmconfigure" name="frmconfigure" method="post" action="configure_listing.php">
                                        <div class="table-responsive">
                                            <table id="example" class="table " style="width:100%" cellspacing="0" cellpadding="0">
                                                <thead class=" text-primary">

                                                    <th>
                                                        Title
                                                    </th>
                                                    <th>
                                                        Status
                                                    </th>
                                                </thead>
                                                <tbody>
                                                    <?php if(count($db_res)>0) {
                                                      for($i = 0;$i < count($db_res);$i++) { 
                                                        if(($i%2)==0) { $class = "odd"; } else { $class = "even"; } ?>
                                                        <tr class="<?php echo $class?>">

                                                            <td <?php if(in_array($moduleid,$_SESSION['sess_edit'])) {?>onClick="status_edit(<?php echo $db_res[$i]['Con_Id'];?>)" style="padding: 0px 8px;cursor:pointer;"<?php }?>><?php echo stripslashes($db_res[$i]['Con_Title']);?></td>
                                                            <td><?php echo $db_res[$i]['Con_Status'];?></td>
                                                        </tr>
                                                    <?php }
                                                    } else {?>
                                                        <tr class="<?php echo $class?>"><td colspan="4" align="center">No record found</td></tr>
                                                    <?php }?>
                                                </tbody>
                                            </table>
                                            <table>
                                                    <tr><td colspan="4">&nbsp;&nbsp;</td></tr>
                                                    <tr>
                                                        <td colspan="5">
                                                            <input type="hidden" name="action" id="action" />
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
<style>.form-check .form-check-label span {top: -10px;}</style>
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
