<?php
class admin_order_item extends dbclass{
   
	
	function get_user_detail($sorton, $sorttype, $option, $keyword, $var_limit) {
		if(isset($keyword) && !empty($keyword)) {
			$search_cond = " AND ".$option." like '".$keyword."%'";
		}
		$order_cond = ' order by '.$sorton.' '.$sorttype;
		$query = "select * from order_item where OI_OrderId='".$_REQUEST['or_id']."'".$search_cond.$order_cond.$var_limit;
		$sql = $this->select($query);
		return $sql;
	}
	
	function count_member_detail($option, $keyword) {
		if(isset($keyword) && !empty($keyword)) {
			$search_cond = " AND ".$option." like '".$keyword."%'";
		}
		$query = "select count(*) as tot from order_item where OI_OrderId='".$_REQUEST['or_id']."'".$search_cond;
		$sql = $this->select($query);
		return $sql[0]["tot"];
	}
	
	function funoperation() {
		$msg='';
		if($_REQUEST['action']=='active') {
			$query = "update order_item set op_stat='Active' where OI_Id in (".implode(",",$_REQUEST['chk']).")";
			$msg='Selected Record(s)set to Active Successfully';
			$this->update($query);
		}
		if($_REQUEST['action']=='inactive') {
			$query = "update order_item set op_stat='Inactive' where OI_Id in (".implode(",",$_REQUEST['chk']).")";
			$msg='Selected Record(s) set to Inactive Successfully';
			$this->update($query);
		}
		if($_REQUEST['action']=='delete') {		 		
			 
			$rs_main = $this -> select("SELECT * FROM configure where Con_Id=1");

			$servchrg = floatval($rs_main[0]['Con_Servicecharges']);
			$consutax = floatval($rs_main[0]['Con_ConTax']);
			$vattax = floatval($rs_main[0]['Con_VAT']);
			
			 $row = $this -> select("SELECT * FROM orders where Ord_Id='".$_REQUEST['or_id']."'");
			
			 for($i=0;$i<count($_REQUEST['chk']);$i++){
				 
				$orderitem = $this -> select("SELECT * FROM order_item where OI_Id='".$_REQUEST['chk'][$i]."'");
				 
				$tot = $row[0]['Ord_Total']-$orderitem[0]['OI_Cost']; 
				$tsercrg = ($tot*$servchrg)/100;
				$tcons = ($tot*$consutax)/100;
				$tvat = ($tot*$vattax)/100;
				$subtot = floatval($tot+$tsercrg+$tcons+$tvat);
				$grdtot = floatval($tot+$tsercrg+$tcons+$tvat)-$row[0]['Ord_Discount'];
				 
				$queryupdate = "update orders set Ord_ServiceCharge='".$tsercrg."', Ord_ConTax='".$tcons."', Ord_Vat='".$tvat."', Ord_Total='".$tot."', Ord_GrandTotal='".$grdtot."'  where Ord_Id='".$_REQUEST['or_id']."'";

				$sql = $this->update($queryupdate); 
				 
				$query = "delete from order_item where OI_Id ='".$_REQUEST['chk'][$i]."'";
			 	$this->update($query);
			 }
			 //exit;
			 $msg='Selected Record(s) Delete Successfully';
		}
		
		return $msg;
	}

	function get_ord_single_detail($txtopid) {
		$query = "SELECT * FROM order_item where OI_Id='".$txtopid."'";
		$sql = $this->select($query);
		return $sql;
	}
	
	function update_ord_detail($opid,$order,$prod,$price,$quant,$ostatus,$option) {
		$msg='';
        
		$query = "update order_item set OI_OrderId='".$order."',OI_ItemId='".$prod."', OI_Cost='".$price."' , OI_Quantity='".$quant."', OI_Status='".$ostatus."', OI_Item_Option='".$option."' where OI_Id='".$opid."'";
		$sql = $this->update($query);
		$row = $this -> select("SELECT * FROM menu_item where MI_Id='".$prod."'");
		if($row[0]['MI_Qty']!='') {
		    $this->update("update menu_item set MI_Qty = MI_Qty - ".$quant." where MI_Id='".$prod."'");
		}
		
		$msg='Items updated Successfully';
		return $msg;
	}
	
	function add_ord_detail($order,$prod,$price,$quant,$ostatus,$option) {
		$msg='';
		$query = "insert order_item set OI_OrderId='".$order."', OI_ItemId='".$prod."', OI_Cost='".$price."', OI_Quantity='".$quant."', OI_Status='".$ostatus."', OI_Item_Option='".$option."'";
		$sql = $this->insert($query);
		$row = $this -> select("SELECT * FROM menu_item where MI_Id='".$prod."'");
		if($row[0]['MI_Qty']!='') {
		    $this->update("update menu_item set MI_Qty = MI_Qty - ".$quant." where MI_Id='".$prod."'");
		}
	
		$msg='Items added Successfully';
		
		return $sql;
	}
}
?>