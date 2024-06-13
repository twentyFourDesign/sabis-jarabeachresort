<?php require "system/config/configure.php";
include "include/checklogin.php";
require_once CLASS_PATH.'admin_ut.php';
$obj = new admin_ut;

if(isset($_REQUEST['txtutid']) && !empty($_REQUEST['txtutid'])) {
$txtutid=$_REQUEST['txtutid'];
$rs1 = $obj -> get_ut_single_detail($txtutid);
}

if(strlen($_REQUEST['action'])!=0) {
		$title=$_REQUEST['txttitle'];
		$module=implode(",",$_REQUEST['chkmodul']);
		$moduleadd=implode(",",$_REQUEST['chkmoduladd']);
		$moduleedit=implode(",",$_REQUEST['chkmoduledit']);
		$moduledelete=implode(",",$_REQUEST['chkmoduldelete']);
		$status=$_REQUEST['selstatus'];

		if($_REQUEST['action']=="edit") {
		
			$utid=$_REQUEST['txtutid'];
			
			$msgtextut = $obj -> update_ut_detail($utid,$title,$module,$moduleadd,$moduleedit,$moduledelete); 
	?>
<script language="javascript">
				document.location.href="user_type_listing.php?msgtextut=+<?php echo $msgtextut?>+";
			</script>
<?php
		} elseif($_REQUEST['action']=="add") {
			
			$msgtextut = $obj -> add_ut_detail($title,$module,$moduleadd,$moduleedit,$moduledelete); 
	?>
			<script language="javascript">
				document.location.href="user_type_listing.php?msgtextut=+<?php echo $msgtextut?>+";
			</script>
<?php	}
	}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>User Type</title>
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
            if(!chkForm("frmutdetail", "txttitle", "validateblank", "Please Enter Title")){
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
                                    <h4 class="card-title ">Detail</h4>
                                </div>
                                <div class="card-body">
                                    <form id="frmutdetail" name="frmutdetail" method="post" action="user_type_detail.php" onSubmit="return frmcheck()" enctype="multipart/form-data">
                                        <div class="table-responsive">
                                            <table id="example" class="table" style="width:100%" cellspacing="0" cellpadding="0">
                                                <tbody>
                                                    <tr>
                                                      <td width="12%" height="25"><span class="radfont">*</span>Title :</td>
                                                      <?php $title = $rs1[0]['UT_Title']; ?>
                                                      <td width="33%" height="25"><input name="txttitle" type="text" class="form-control" id="txttitle" value="<?php echo stripslashes($title);?>" size="40" /></td>
                                                      <td width="11%" height="25">&nbsp;</td>
                                                      <td width="34%" height="25">&nbsp;</td>
                                                    </tr>
													<tr>
                                                      <td width="12%" height="25">Module :</td>
                                                      <td width="33%" height="25"><?php $db_cmp = $obj->get_module_detail(); 
	  	$moduledata = explode(',',$rs1[0]['UT_Module']);
                $moduleadddata = explode(',',$rs1[0]['UT_Add']);
                $moduleeditdata = explode(',',$rs1[0]['UT_Edit']);
                $moduledeletedata = explode(',',$rs1[0]['UT_Delete']);
	  ?><table width="100%" border="0" align="center" cellpadding="0" cellspacing="6" class="text">
              <tr>
                  <th></th>
                  <th>View</th>
                  <th>Add</th>
                  <th>Edit</th>
                  <th>Delete</th>
              </tr>
		 <?php for($j = 0;$j < count($db_cmp);$j++) {  ?>
			  <tr>
			  <td>
				<?=$db_cmp[$j]['MF_Module'];?>
			  </td>
                          <td width="10" height="15">
				<input type="checkbox" id='chkmodul' name="chkmodul[]" value="<?=$db_cmp[$j]['MF_Id'];?>" <?php echo in_array($db_cmp[$j]['MF_Id'],$moduledata) ? 'checked="checked"' : ''; ?>>
			  </td>
                          <td width="10" height="15">
				<input type="checkbox" id='chkmodul' name="chkmoduladd[]" value="<?=$db_cmp[$j]['MF_Id'];?>" <?php echo in_array($db_cmp[$j]['MF_Id'],$moduleadddata) ? 'checked="checked"' : ''; ?>>
			  </td>
                          <td width="10" height="15">
				<input type="checkbox" id='chkmodul' name="chkmoduledit[]" value="<?=$db_cmp[$j]['MF_Id'];?>" <?php echo in_array($db_cmp[$j]['MF_Id'],$moduleeditdata) ? 'checked="checked"' : ''; ?>>
			  </td>
                          <td width="10" height="15">
				<input type="checkbox" id='chkmodul' name="chkmoduldelete[]" value="<?=$db_cmp[$j]['MF_Id'];?>" <?php echo in_array($db_cmp[$j]['MF_Id'],$moduledeletedata) ? 'checked="checked"' : ''; ?>>
			  </td>
			  </tr>	  
		<?php } ?>	  
	  </table></td>
                                                      <td width="11%" height="25">&nbsp;</td>
                                                      <td width="34%" height="25">&nbsp;</td>
                                                    </tr>
                                                    <tr>
                                                      <td colspan="4" height="10"></td>
                                                    </tr>
                                                    <tr>
                                                      <td width="11%" align="right">&nbsp;</td>
                                                      <td width="34%">
                                                        <?php if(isset($_REQUEST['txtutid']) && !empty($_REQUEST['txtutid'])) { ?>
                                                          <button type="submit" class="btn btn-primary pull-left"><i class="material-icons">save</i> Save Changes<div class="ripple-container"></div></button>
                                                        
                                                        <input name="txtutid" type="hidden" value="<?php echo $rs1[0]['UT_Id'];?>" />
                                                        <input name="action" type="hidden" value="edit" />
                                                        <?php } else { ?>
                                                        <button type="submit" class="btn btn-primary pull-left"><i class="material-icons">save</i> Save Changes<div class="ripple-container"></div></button>
                                                        <input name="action" type="hidden" value="add" />
                                                        <?php } ?>
                                                        <button type="button" class="btn btn-primary pull-left" onClick="funcancel('user_type_listing')" style="background:#e53935"><i class="material-icons">close</i> Cancel<div class="ripple-container"></div></button>
                                                      </td>
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
<style>.table th, .table td {border:0}</style>
</html>
