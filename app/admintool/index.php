<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");

require "system/config/configure.php";
include "include/checklogin.php";
require_once CLASS_PATH.'admin_user.php';
$obj = new admin_user;
?>
<script src="assets/js/core/jquery.min.js"></script>
<script src="assets/js/core/popper.min.js"></script>
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
<script>
jQuery( document ).ready(function() {
    type = ['', 'info', 'danger','success', 'warning', 'rose', 'primary'];
});
</script>
<?php $flag=0;
if(isset($_REQUEST['action']) && $_REQUEST['action']=='login') {
    $username=$_REQUEST['username']; $password=$_REQUEST['password'];
    $res=$obj->get_admin_single_detail($username,$password); 
	$rs_module = $dbobj -> select("SELECT * FROM usertype where UT_Id='".$res[0]['Usr_Type']."'");
	$mcnt = explode(",",$rs_module[0]['UT_Module']);
	$add = explode(",",$rs_module[0]['UT_Add']);
        $edit = explode(",",$rs_module[0]['UT_Edit']);
        $delete = explode(",",$rs_module[0]['UT_Delete']);
	$file[]='dashboard,logout,index';
	
	for($x = 0;$x < count($mcnt); $x++) {
		$rs_mf = $dbobj -> select("SELECT * FROM modulefile where MF_Id='".$mcnt[$x]."'");
		$file[] = $rs_mf[0]['MF_File'];
	}
	
	$_SESSION['sess_file'] = implode(",",$file);
	$_SESSION['sess_add'] = $add;
	$_SESSION['sess_edit'] = $edit;
	$_SESSION['sess_delete'] = $delete;
	$_SESSION['sess_usertype'] = $res[0]['Usr_Type'];
        
    if(!empty($res)) {
        $_SESSION['adminuser']=$res[0]['Usr_Id'];?>
        <script>window.location='dashboard.php';</script>
     <?php 
    } else {
        $res2=$obj->get_c_single_detail($username,$password);
        if(!empty($res2)) {
            $_SESSION['adminuser']=$res2[0]['c_id']; ?>
            <script>window.location='dashboard_client.php';</script>
        <?php } else {
            $flag=1;
        }
    }
}?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>
        Login
    </title>
    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" />
    <!-- Documentation extras -->
    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link href="assets/assets-for-demo/demo.css" rel="stylesheet" />
    <!-- iframe removal --><!-- Bootstrap core CSS     -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
    <!--  Material Dashboard CSS    -->
    <link href="assets/css/material-dashboard2.css" rel="stylesheet" />
    <style>.loginbtn{background:#000000;color:#FFF;height:40px;line-height:40px; width: 100%; text-align:center;border-radius:5px;border:0;padding: 0 40px;font-weight: 400;}
    .txtbox {background:#FFF;padding: 0 20px;width: 100%;line-height: 40px;height: 40px;border-radius: 5px;border: 1px solid #999;box-shadow: 10px 10px 41px -15px rgba(0,0,0,0.75);}
    h3.ltitle { color:#222222; font-size:22px; margin:0px; padding:0px; text-align:center; font-style: normal; }</style>
</head>

<body  style="background:#f7f7f7">
            <div class="">
                <div class="">
                    <div class="">
                        <div class="col-md-6 col-sm-6" style="background:url('assets/img/leftnew.jpeg') no-repeat;background-size:cover;background-position:right;height:100%">
                        </div>
                        <div class="col-md-6 col-sm-6" style="background:#f7f7f7">
                            <div class="">
                                <div class="col-md-3"></div>
                                <div class="col-md-6">
                                <form method="post" action="index.php" style="padding-top:180px">
                                    <div class="card-header text-center" data-background-color="rose">
                                        <h4 class="card-title"><img src="assets/img/pacelogo.png" ><br><br></h4>
                                        <h3 class="ltitle">Please Login</h3>
                                    </div>
                           			<div class="card-content">
                                        <div class="">
                                            <div class="form-group">
                                                <input type="text" class="txtbox" id="username" name="username" placeholder="User Name" required>
                                                </div>
                                        </div>
                                        <div class="">
                                            <div class="form-group">
                                                <input type="password" class="txtbox" id="password" name="password" placeholder="Password" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="footer text-left">
                                        <br>
                                        <button type="submit" class="loginbtn">Login</button>
                                    </div>
                                    <input type="hidden" name="action" value="login">
                            </form>
                            </div>
                                <div class="col-md-3"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
<?php if($flag==1) {?>
        <script>
            jQuery.notify({
                icon: "notifications",
                message: "Sorry, wrong username and password."

            }, {
                type: 'danger',
                timer: 3000,
                placement: {
                    from: 'top',
                    align: 'center'
                }
            });
        </script>
<?php }?>
</body>
</html>