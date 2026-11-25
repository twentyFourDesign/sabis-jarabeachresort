<?php
require "admintool/system/config/configure.php";
//include "include/regchk.php";
$rs_main = $dbobj->select( "SELECT Con_TableNo FROM configure where Con_Id=1" );
$tabs = $rs_main[ 0 ][ 'Con_TableNo' ];
include_once __DIR__.'/include/rooms.php';
$rooms = jara_rooms( $tabs ); // room names from the booking system
$roomGroups = array();
foreach ( $rooms as $r ) { $roomGroups[ $r[ 'type' ] ][] = $r[ 'title' ]; }
?>
<!DOCTYPE html>
<html lang="en">
<?php include "include/head.php"; ?>
<style>
  .roomlist { max-height:260px; overflow-y:auto; border:1px solid #CCCCCC; border-radius:10px; background:#fff; padding:6px 12px; margin-top:6px; }
  .roomgrp-title { font-weight:700; margin:10px 0 4px; }
  .roomopt { display:block; padding:6px 0; font-weight:400; cursor:pointer; }
  .roomopt input { margin-right:8px; }
  .daypassbox { border:1px solid #CCCCCC; border-radius:10px; background:#fff; padding:6px 12px; margin-top:12px; }
</style>
<body class="posrel minheight">
<?php //include "include/header.php"; ?>
<div class="tpline"></div>
<div class="reg_outer">
  <div class="logo"> <img src="assets/images/logo.png"> </div>
  <h1 class="pgtitle">Who is making this order?</h1>
  <div class="frm_outer">
    <form name="frmreg" id="frmreg" method="POST" onsubmit="return frmchck();" action="topcats.php">
      <div class="frmin">
        <label>Staying overnight? Select your room(s):</label>
        <div class="roomlist" id="roomlist">
          <?php foreach ( $roomGroups as $type => $titles ) { ?>
          <div class="roomgrp">
            <?php if ( count( $roomGroups ) > 1 ) { ?><p class="roomgrp-title"><?=htmlspecialchars( $type );?></p><?php } ?>
            <?php foreach ( $titles as $title ) { ?>
            <label class="roomopt"><input type="checkbox" class="roomchk" name="tabno[]" value="<?=htmlspecialchars( $title );?>" /> <?=htmlspecialchars( $title );?></label>
            <?php } ?>
          </div>
          <?php } ?>
        </div>
        <div class="daypassbox">
          <label class="roomopt"><input type="checkbox" class="roomchk" id="daypass" name="tabno[]" value="Day Pass" /> <strong>Day Pass</strong> &ndash; I'm visiting for the day</label>
        </div>
      </div>
      <div class="clear"></div>
      <div class="frmin-half">
        <label>Preferred Name:*</label>
        <br>
        <input type="text" name="fname" id="fname" class="frm-field" />
      </div>
      <div class="frmin-half">
        <label>Number of Guests inc any children eating:</label>
        <br>
        <input type="number" name="noofg" id="noofg" class="frm-field" />
      </div>
      <div class="clear"></div>
      <div class="frmin">
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
        if($(".roomchk:checked").length==0) {
            $("#err").html("Please select your room(s) or Day Pass.");
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