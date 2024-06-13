<?php require "admintool/system/config/configure.php";
if(isset($_SESSION['memname']) && !empty($_SESSION['memname'])) {
    header("Location: table_details.php");
}
$rs_main = $dbobj -> select("SELECT Con_TableNo FROM configure where Con_Id=1");
$tabs = $rs_main[0]['Con_TableNo']; ?>
<!DOCTYPE html>
<html lang="en">
<?php include "include/head.php"; 
?>
<body class="posrel minheight">
<div class="tpline"></div>
<div class="reg_outer">
    <div class="logo">
        <img src="assets/images/logo.png">
    </div>
    <h1 class="pgtitle">Who is making this order?</h1>
    <div class="frm_outer">
        <form name="frmreg" id="frmreg" method="POST" onsubmit="return frmchck();" action="table_details.php">
        <div class="frmin" style="display: none;">
            <label>Phone Number (Your unique ID. No account creation needed. Numbers are not used for marketing purposes)*</label><br>
            <input type="number" name="fphone" id="fphone" class="frm-field" />
        </div>
        <div class="frmin">
            <label>Preferred Name*</label><br>
            <input type="text" name="fname" id="fname" class="frm-field" />
        </div>
		<div class="frmin">
            <label>Would you like an email receipt?</label><br>
            <input type="radio" name="chkemail" id="chkemail" value="Yes" /> Yes <input checked type="radio" name="chkemail" id="chkemail" value="No" /> No
        </div>	
        <div class="frmin" id="emaildiv" style="display: none;">
            <label>Email Address (for your receipt)</label><br>
            <input type="email" name="femail" id="femail" class="frm-field" />
        </div>
       <!--  <div class="frmin">
            <label>Date of Birth</label><br>
            <input type="date" name="dob" id="dob" class="frm-field" />
        </div> -->
        <div class="frmin btnouter"><button class="btnnxt" name="btnreg" type="submit" id="btnreg">Next</button></div>
        <p class="errmsg" id="err"></p>
        </form>
		 <div class="frmin btnouter"><a href="https://www.jollofbyjara.com/" target="_blank"><img src="assets/images/tplogo.png" width="150px"></a></div>
    </div>
</div>
<div class="btmline"></div>
<div id="loader"><img src="assets/images/loader.gif" /></div>
</body>
<script>
    function frmchck() {
        //if($("#fphone").val()=='') {
            //$("#err").html("Please Enter Phone Number.!");
            //return false;
        if($("#fname").val()=='') {
            $("#err").html("Please Enter First Name.!");
            return false;
        } //else if($("#lname").val()=='') {
            //$("#err").html("Please Enter Last Name.!");
            //return false;
        //}
        /*else if($("#femail").val()=='') {
            $("#err").html("Please Enter Email Address.!");
            return false;
        }*/ else {
            return true;
        }
    }
    $("#fphone").bind('click keyup', function() {
        $.ajax({url: "include/formchk.php?phone="+document.getElementById("fphone").value, success: function(result) {
            if(result!='error') {
                var r=result.split("|");
                document.getElementById("fname").value=r[0];
                //document.getElementById("lname").value=r[1];
                document.getElementById("femail").value=r[2];
                document.getElementById("dob").value=r[3];
            } else {
            }
        }});
    });
	$('input[type=radio][name=chkemail]').change(function() {
            if (this.value == 'Yes') {
                document.getElementById("emaildiv").style.display='block';
            }else {
                document.getElementById("emaildiv").style.display='none';
            }
     });
</script>
</html>
