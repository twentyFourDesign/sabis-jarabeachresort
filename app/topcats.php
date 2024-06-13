<?php require "admintool/system/config/configure.php";
$row = $dbobj -> select("SELECT * FROM menu_category where MC_Parent='0' and MC_Status='Active' order by MC_Sort ASC");
include "include/regchk.php";
if($_REQUEST['tabno']!='') {
    $_SESSION['tabno']=$_REQUEST['tabno'];
    $_SESSION['noofg']=$_REQUEST['noofg'];
}
?>
<!DOCTYPE html>
<html lang="en">
<?php include "include/head.php"; ?>
<body class="posrel minheight">
    <?php include "include/header.php"; ?>
    <div class="cat_outer">
        <?php if(count($row)>0){ 
        	for($t=0;$t<count($row);$t++) {
        	    if($row[$t]['MC_Image']!='') { ?>
        	        <div class="catin">
        	            <a href="cats.php?cid=<?=$row[$t]['MC_Id'];?>"><img src="admintool/upload/menu_category/<?=$row[$t]['MC_Id'].'_'.$row[$t]['MC_Image'];?>" alt="<?=$row[$t]['MC_Title'];?>" />
        	            <div class="cattitle_outer"><h3 class="cattitle"><?=$row[$t]['MC_Title'];?></h3></div></a>
        	        </div>
        	   <?php } else { ?>
            	    <div class="catin">
        	            <a href="cats.php?cid=<?=$row[$t]['MC_Id'];?>"><img src="assets/images/tcplaceholder.jpg" alt="<?=$row[$t]['MC_Title'];?>" />
        	            <div class="cattitle_outer"><h3 class="cattitle"><?=$row[$t]['MC_Title'];?></h3></div></a>
        	        </div>
            	<?php }
            } 
        } else { ?>
            <p>No Categories Found.!</p>
        <?php } ?>
    </div>
    <div class="btmline"></div>
</body>
</html>