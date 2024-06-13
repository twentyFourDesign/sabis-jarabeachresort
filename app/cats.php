<?php require "admintool/system/config/configure.php";
$row = $dbobj -> select("SELECT * FROM menu_category where MC_Parent='".$_REQUEST['cid']."' and MC_Status='Active' order by MC_Sort ASC");
include "include/regchk.php";
?>
<!DOCTYPE html>
<html lang="en">
<?php include "include/head.php"; ?>
<body class="posrel minheight">
    <div class="fetuimg">
        <img class="fetimg" src="admintool/upload/menu_category/<?=$_REQUEST['cid'].'_'.get_value('MC_Image','menu_category','MC_Id',$_REQUEST['cid']);?>">
        <div class="hedposa"><?php include "include/header.php"; ?></div>
    </div>
	<p style="padding-left: 24px;"><?php echo get_value('Con_Address','configure','Con_Id',1); ?></p>
    <div class="cat_outer2">
        <?php if(count($row)>0){ ?>
            <div class="sbcat">
        	   <?php for($t=0;$t<count($row);$t++) { ?>
        	        <?php if($t==0) { ?><script type="text/javascript">$(document).ready(function () { miload(<?=$row[$t]['MC_Id'];?>); });</script><?php } ?>
        	        <button class="sbcattitle" id="src<?=$row[$t]['MC_Id'];?>" onclick="miload(<?=$row[$t]['MC_Id'];?>)" type="button"><?=$row[$t]['MC_Title'];?></button>
        	   <?php } ?>
            </div>
        <?php } else { ?>
            <p>No Categories Found.!</p>
        <?php } ?>
    </div>
    <div id="menu_outer" class="pdd10"></div>
    <div class="btn_outposf">
        <button onclick="order()">Order</button>
        <!--<div class="btmline"></div>-->
    </div>
    <div id="loader"><img src="assets/images/loader.gif" /></div>
</body>
<script>
    function miload(id) {
        $("#loader").show();
        $(".sbcattitle").removeClass('active');
        $("#src"+id).addClass('active');
        $.ajax({url: "include/menuitems.php?cat="+id, success: function(result){
            $("#menu_outer").html(result);
            $("#loader").hide(500);
            $("select[name=miqty]").bind('change', function() {
                var mid = $(this).data('id');
                var mqty = $(this).val();
				
				if($("#mioption-"+mid).length>0){
					var mopt = $("#mioption-"+mid).val();
				}else{
					var mopt = 0;
				}
				
                if(mqty>0) {
                    $.ajax({url: "include/cart.php?mid="+mid+"&mqty="+mqty+"&mopt="+mopt, success: function(result){
                    }});
                } else {
                    $.ajax({url: "include/checkcrt.php?mid="+mid, success: function(result){
                        if(result=='Yes') {
                                $.ajax({url: "include/remcart.php?mid="+mid, success: function(result){
                                    if(result!='No') {
                                        
                                    }
                                }});
                        } else {
                            
                        }
                    }});
                }
            });
			
			$("select[name=mioption]").bind('change', function() {
                var mid = $(this).data('option');
                var mqty = $("#miqty-"+mid).val();
				
				if($("#mioption-"+mid).length>0){
					var mopt = $("#mioption-"+mid).val();
				}else{
					var mopt = 0;
				}
                if(mqty>0) {
                    $.ajax({url: "include/cart.php?mid="+mid+"&mqty="+mqty+"&mopt="+mopt, success: function(result){
                    }});
                } else {
                    $.ajax({url: "include/checkcrt.php?mid="+mid, success: function(result){
                        if(result=='Yes') {
                                $.ajax({url: "include/remcart.php?mid="+mid, success: function(result){
                                    if(result!='No') {
                                        
                                    }
                                }});
                        } else {
                            
                        }
                    }});
                }
            });
			
            $("#loader").hide(500);
        }});
    }
    function order() {
        $("#loader").show();
        $.ajax({url: "include/chkcart.php", success: function(result){
            if(result=='Yes') {
                $("#loader").hide();
                window.location="order.php";
            } else {
                $("#loader").hide();
                alert("Select Menu Items First.!");
            }
        }});
    }
</script>
</html>