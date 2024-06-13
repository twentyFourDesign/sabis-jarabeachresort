<?php
require "system/config/configure.php";

include "include/checklogin.php";

require_once CLASS_PATH . 'admin_user.php';

$obj = new admin_user;


if ( isset( $_REQUEST[ 'txtuserid' ] ) && !empty( $_REQUEST[ 'txtuserid' ] ) ) {

    $txtuserid = $_REQUEST[ 'txtuserid' ];

    $rs1 = $obj->get_user_single_detail( $txtuserid );

}


if ( strlen( $_REQUEST[ 'action' ] ) != 0 ) {

    $username = $_REQUEST[ 'txtusername' ];

    $password = $_REQUEST[ 'txtpassword' ];

    $firstname = $_REQUEST[ 'txtfirstname' ];

    $lastname = $_REQUEST[ 'txtlastname' ];

    $shortname = $_REQUEST[ 'txtshortname' ];

    $no = $_REQUEST[ 'txtno' ];

    $ut = $_REQUEST[ 'selut' ];

    $status = $_REQUEST[ 'selstatus' ];


    $image = basename( $_FILES[ 'txtimage' ][ 'name' ] );

    if ( strlen( $image ) == 0 )$image = $_REQUEST[ 'txthimage' ];


    if ( $_REQUEST[ 'action' ] == "edit" ) {

        $userid = $_REQUEST[ 'txtuserid' ];

        if ( !empty( $_FILES[ 'txtimage' ][ 'name' ] ) ) {

            $target_path = "upload/user/" . $userid . "_" . basename( $_FILES[ 'txtimage' ][ 'name' ] );

            move_uploaded_file( $_FILES[ 'txtimage' ][ 'tmp_name' ], $target_path );

        }

        $msgtextuser = $obj->update_user_detail( $status, $userid, $username, $password, $firstname, $lastname, $no, $ut, $shortname, $image );
        ?>
<script>

			document.location.href="user_listing.php?msgtextuser=+<?php echo $msgtextuser?>+";

		</script>
<?php

} elseif ( $_REQUEST[ 'action' ] == "add" ) {

        $inserId = $obj->add_user_detail( $status, $username, $password, $firstname, $lastname, $no, $ut, $shortname, $image );

        if ( !empty( $_FILES[ 'txtimage' ][ 'name' ] ) ) {

            $target_path = "upload/user/" . $inserId . "_" . basename( $_FILES[ 'txtimage' ][ 'name' ] );

            move_uploaded_file( $_FILES[ 'txtimage' ][ 'tmp_name' ], $target_path );

        }
        ?>
<script>

			document.location.href="user_listing.php?msgtextuser=+User Detail added successfully+";

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
<title> User </title>

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

            if(!chkForm("frmuserdetail", "txtusername", "validateblank", "Please Enter Username", "txtpassword", "validateblank", "Please Enter Password", "txtfirstname", "validateblank", "Please Enter Title")){

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
        <div class="navbar-wrapper"> <a class="navbar-brand" href="#pablo">User</a> </div>
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
                <form id="frmuserdetail" name="frmuserdetail" method="post" action="user_detail.php" onSubmit="return frmcheck()" enctype="multipart/form-data">
                  <div class="table-responsive">
                    <table id="example" class="table" style="width:100%" cellspacing="0" cellpadding="0">
                      <tbody>
                        <tr>
                          <td width="15%" height="25"><span class="radfont">*</span>User Name :</td>
                          <?php $username = explode('X',$rs1[0]['Usr_UserName']); ?>
                          <td width="30%" height="25"><input name="txtusername" type="text" class="form-control" id="txtusername" value="<?=$username[0];?>" size="40" /></td>
                          <td width="15%" height="25"><span class="radfont">*</span>Password:</td>
                          <td width="30%" height="25"><?php  	$password = explode('X',$rs1[0]['Usr_Password']);  ?>
                            <input name="txtpassword" type="password" class="form-control" id="txtpassword" value="<?=$password[0];?>" size="40" /></td>
                          <td colspan="2" height="10"></td>
                        </tr>
                        <tr>
                          <td width="15%" height="25"><span class="radfont">*</span>First Name :</td>
                          <?php $firstname = explode('X',$rs1[0]['Usr_FirstName']); ?>
                          <td width="30%" height="25"><input name="txtfirstname" type="text" class="form-control" id="txtfirstname" value="<?=$firstname[0];?>" size="40" /></td>
                          <td width="15%" height="25">Last Name:</td>
                          <?php $lastname = explode('X',$rs1[0]['Usr_LastName']);?>
                          <td width="30%" height="25"><input name="txtlastname" type="text" class="form-control" id="txtlastname" value="<?=$lastname[0];?>" size="40" /></td>
                          <td colspan="2" height="10"></td>
                        </tr>
                        <tr>
                          <td width="15%" height="25">Short Name :</td>
                          <?php $shortname = explode('X',$rs1[0]['Usr_ShortName']); ?>
                          <td width="30%" height="25"><input name="txtshortname" type="text" class="form-control" id="txtshortname" value="<?=$shortname[0];?>" size="40" /></td>
                          <td width="15%" height="25">Contact Number :</td>
                          <?php $email = explode('X',$rs1[0]['Usr_No']); ?>
                          <td width="30%" height="25"><input name="txtno" type="text" class="form-control" id="txtno" value="<?=$email[0];?>" size="40" /></td>
                          <td colspan="2" height="10"></td>
                        </tr>
                        <tr>
                          <td width="15%" height="25">User Type:</td>
                          <td width="30%" height="25"><?=usertypecombo($rs1[0]['Usr_Type'])?></td>
                          <td width="15%" height="25">Profile Picture:</td>
                          <td width="30%" height="25"><?php $headerimage = $rs1[0]['Usr_img'];?>
                            <input name="txtimage" id="txtimage" class="textfield" type="file" />
                            <input name="txthimage" type="hidden" id="txthimage" value="<?=$headerimage;?>" />
                            <br>
                            <?php if($headerimage!=''){?>
                            <a href="upload/user/<?=$rs1[0]['Usr_Id']."_".$headerimage;?>" target="_blank"> <img src="upload/user/<?=$rs1[0]['Usr_Id']."_".$headerimage;?>" class="img-size" width="100" /> </a>
                            <?php }?></td>
                        </tr>
                        <tr>
                          <td width="15%" height="25">Status:</td>
                          <td width="30%" height="25"><select name="selstatus" class="form-control">
                              <?php echo $rs1[0]['Usr_Status']=="Active" ? '<option value="Active" selected="selected">Active</option > ' : '<option value="Active">Active</option>'; ?> <?php echo $rs1[0]['Usr_Status']=="Inactive" ? '<option value="InActive" selected="selected">InActive</option>' : '<option value="InActive">InActive</option>'; ?>
                            </select></td>
                          <td colspan="2" height="10"></td>
                        </tr>
                        <tr>
                          <td colspan="4" height="10"></td>
                        </tr>
                        <tr>
                          <td width="15%" align="right">&nbsp;</td>
                          <td width="30%"><?php if(isset($_REQUEST['txtuserid']) && !empty($_REQUEST['txtuserid'])) { ?>
                            <button type="submit" class="btn btn-primary pull-left"><i class="material-icons">save</i> Save Changes
                            <div class="ripple-container"></div>
                            </button>
                            <input name="txtuserid" type="hidden" value="<?php echo $rs1[0]['Usr_Id'];?>" />
                            <input name="action" type="hidden" value="edit" />
                            <?php } else { ?>
                            <button type="submit" class="btn btn-primary pull-left"><i class="material-icons">save</i> Save Changes
                            <div class="ripple-container"></div>
                            </button>
                            <input name="action" type="hidden" value="add" />
                            <?php } ?>
                            <button type="button" class="btn btn-primary pull-left" onClick="funcancel('user_listing')" style="background:#e53935"><i class="material-icons">close</i> Cancel
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
