<?php
require "../system/config/configure.php";
$orderarray = array();

if($_SESSION['sess_usertype']==1 || $_SESSION['sess_usertype']==9) {
    $db_res1 = $dbobj->select( "SELECT * FROM order_item where OI_OrderId=" . $_REQUEST[ 'orderid' ] );
    for ( $i = 0; $i < count( $db_res1 ); $i++ ) {
        $orderarray[$i]['idd']=$db_res1[$i]['OI_Id'];
    	$orderarray[$i]['name']=get_value('MI_Title','menu_item','MI_Id',$db_res1[$i]['OI_ItemId']);
    	$orderarray[$i]['qnty']=$db_res1[$i]['OI_Quantity'];
	$orderarray[$i]['io']=$db_res1[$i]['OI_Item_Option'];
        $orderarray[$i]['iop']=$db_res1[$i]['OI_Icost'];
    	$orderarray[$i]['cost']=$db_res1[$i]['OI_Cost'];
    	$orderarray[$i]['sts']=$db_res1[$i]['OI_Status'];
    }
} else {
    $cats = $dbobj->select( "SELECT * FROM menu_category where MC_Utype=".$_SESSION['sess_usertype']." and MC_Status='Active'");
    for($cq=0; $cq<count($cats); $cq++) {
        $qidsma.=$cats[$cq]['MC_Id'].',';
    }
    $db_res1 = $dbobj->select( "SELECT * FROM order_item join menu_item on order_item.OI_ItemId=menu_item.MI_Id where OI_OrderId=".$_REQUEST[ 'orderid' ]." and MI_CategoryId IN ('".str_replace(",","','",rtrim($qidsma,','))."')");
    for ( $i = 0; $i < count( $db_res1 ); $i++ ) {
        $orderarray[$i]['idd']=$db_res1[$i]['OI_Id'];
    	$orderarray[$i]['name']=get_value('MI_Title','menu_item','MI_Id',$db_res1[$i]['OI_ItemId']);
    	$orderarray[$i]['qnty']=$db_res1[$i]['OI_Quantity'];
	$orderarray[$i]['io']=$db_res1[$i]['OI_Item_Option'];
        $orderarray[$i]['iop']=$db_res1[$i]['OI_Icost'];
    	$orderarray[$i]['cost']=$db_res1[$i]['OI_Cost'];
    	$orderarray[$i]['sts']=$db_res1[$i]['OI_Status'];
    }
}
$key_values = array_column($orderarray, 'name'); 
array_multisort($key_values, SORT_ASC, $orderarray);
?>
<style type="text/css">
.table-responsive1 {
    border: 2px solid #e1e1e1; font-size:.875rem;}
.table {
    margin-bottom: 0px;
}
</style>
<div class="table-responsive1">
  <table id="example" class="table" style="width:100%" cellspacing="0" cellpadding="0">
    <thead class=" text-primary" style="background-color: #CCCCCC">
    <th width="50%">Item</th>
      <th>Quantity</th>
	<th>Item Option</th>
      <th>Cost</th>
      <th>Status</th>
      </thead>
    <tbody>
      <?php
      if ( count( $orderarray ) > 0 ) {
          for ( $j = 0; $j < count( $orderarray ); $j++ ) {
              if ( ( $i % 2 ) == 0 ) {
                  $class = "odd";
              } else {
                  $class = "even";
              }
              ?>
      <tr role="row" class="<?php echo $class?>">
        <td><?php echo $orderarray[$j]['name'];?></td>
        <td><?php echo $orderarray[$j]['qnty'];?></td>
          <td><?php if($orderarray[$j]['io']>0){ echo get_value('io_title','item_option','io_id',$orderarray[$j]['io']); } if($orderarray[$j]['iop']>0) { echo ' - '.showprice($orderarray[$j]['iop']);  } ?></td>
        <td><?php echo showprice($orderarray[$j]['cost']);?></td>
        <td><select name="selostatus" class="form-control" id="selostatus-<?=$orderarray[$j]['idd'];?>" onchange="stschng(<?=$orderarray[$j]['idd'];?>)">
		<?php $blogdata = $dbobj -> select("SELECT * FROM order_status where OS_Status='Active' order by OS_Title desc");?>
		<option>Select Status</option>
		<?php  for($jk = 0;$jk < count($blogdata);$jk++) { ?>
		    <option <?php if($orderarray[$j]['sts']==$blogdata[$jk]['OS_Id']){ ?> selected="selected" <?php } ?> value="<?php echo $blogdata[$jk]['OS_Id'];?>"><?php echo $blogdata[$jk]['OS_Title'];?></option>
		<?php } ?>
		</select></td>
      </tr>
      <?php
      }
      } else {
          ?>
      <tr class="<?php echo $class?>">
        <td colspan="5" align="center">No record found</td>
      </tr>
      <?php }?>
    </tbody>
  </table>
</div>
<?php if($_SESSION['sess_usertype']!=9){?>
<p align="center" style="margin:30px 0px;">
  <button type="button" class="btn btn-primary" onClick="javascript:document.location.href='order_item_listing.php?or_id=<?php echo $_REQUEST['orderid']; ?>'">Manage Item(s)</button>
  <button type="button" class="btn btn-primary" onClick="orcomplete(<?php echo $_REQUEST['orderid']; ?>)">Completed</button>
</p>
<?php } else { ?>
<p align="center" style="margin:30px 0px;">
  <button type="button" class="btn btn-primary" onClick="orcomplete(<?php echo $_REQUEST['orderid']; ?>)">Completed</button>
</p>
<?php } ?>
<div style="height: 10px;"></div>
<p style="font-size:.995rem;"><strong>Allegery</strong>:&nbsp;<?php echo get_value('Ord_Allergens','orders','Ord_Id',$_REQUEST[ 'orderid' ]) ;?></p>
<p style="font-size:.995rem;"><strong>Instructions</strong>:&nbsp;<?php echo get_value('Ord_Instruction','orders','Ord_Id',$_REQUEST[ 'orderid' ]) ;?></p>
<p style="font-size:.995rem;"><strong>What time would you like to eat?</strong>:&nbsp;<?php echo get_value('Ord_Whattime','orders','Ord_Id',$_REQUEST[ 'orderid' ]) ;?></p>
<p style="font-size:.995rem;"><strong>Where would you like to eat?</strong>:&nbsp;<?php echo get_value('Ord_Whereeat','orders','Ord_Id',$_REQUEST[ 'orderid' ]) ;?></p>
<p style="font-size:.995rem;"><strong>Comments or Requests</strong>:&nbsp;<?php echo get_value('Ord_Comments','orders','Ord_Id',$_REQUEST[ 'orderid' ]) ;?></p>
