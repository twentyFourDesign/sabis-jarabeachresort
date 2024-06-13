<?php
require "admintool/system/config/configure.php";
//include "include/regchk.php";
$rs_main = $dbobj->select( "SELECT Con_TableNo FROM configure where Con_Id=1" );
$tabs = $rs_main[ 0 ][ 'Con_TableNo' ];
?>
<!DOCTYPE html>
<html lang="en">
<?php include "include/head.php"; ?>
<body class="posrel minheight">
<?php //include "include/header.php"; ?>
<div class="tpline"></div>
<div class="reg_outer">
  <div class="logo"> <img src="assets/images/logo.png"> </div>
  <h1 class="pgtitle">Who is making this order?</h1>
  <div class="frm_outer">
    <form name="frmreg" id="frmreg" method="POST" onsubmit="return frmchck();" action="topcats.php">
      <div class="frmin-half">
		  <label>Please select your Room(s) and/or Day Pass:*</label>
        <br>
        <select class="frm-field" name="tabno[]" id="tabno" multiple style="height: 100px;">
          <?php for ($d = 1; $d <= $tabs; $d++) { ?>
          <option value="Room <?=$d;?>">Room
          <?=$d;?>
          </option>
          <?php } ?>
          <option value="Day Pass">Day Pass</option>
          <!--<option value="Take Out">Take Out</option>
          <option value="Delivery">Delivery</option>-->
        </select>
      </div>
      <div class="frmin-half">
        <label>Preferred Name:*</label>
        <br>
        <input type="text" name="fname" id="fname" class="frm-field" />
      </div>
      <div class="clear"></div>
      <div class="frmin-half">
        <label>Would you like an email receipt?</label>
        <br>
        <input type="radio" name="chkemail" id="chkemail" value="Yes" />
        Yes
        <input checked type="radio" name="chkemail" id="chkemail" value="No" />
        No
        <div class="frmin" id="emaildiv" style="display: none;">
          <label>Email Address (for your receipt):</label>
          <br>
          <input type="email" name="femail" id="femail" class="frm-field" />
        </div>
      </div>
      <div class="frmin-half">
        <label>Number of Guests inc any children eating:</label>
        <br>
        <input type="number" name="noofg" id="noofg" class="frm-field" />
      </div>
      <div class="clear"></div>
      <div class="frmin btnouter">
        <button class="btnnxt" name="btnreg" type="submit" id="btnreg">Next</button>
      </div>
      <p class="errmsg" id="err"></p>
    </form>
	  <div class="frmin btnouter"><a href="https://www.jollofbyjara.com/" target="_blank"><img src="assets/images/tplogo.png" width="150px"></a></div>
  </div>
</div>
<div class="btmline"></div>
</body>
<script>
    function frmchck() {
        if($("#tabno").val()=='') {
            $("#err").html("Please Select Table No.!");
            return false;
        } else if($("#fname").val()=='') {
            $("#err").html("Please Enter Preferred Name.!");
            return false;
        } /*else if($("#noofg").val()=='') {
            $("#err").html("Please Enter No. of guests.!");
            return false;
        }*/ else {
            return true;
        }
    }
	$('input[type=radio][name=chkemail]').change(function() {
            if (this.value == 'Yes') {
                document.getElementById("emaildiv").style.display='block';
            }else {
                document.getElementById("emaildiv").style.display='none';
            }
     });
</script>
</html>