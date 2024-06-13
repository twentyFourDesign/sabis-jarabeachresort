<?php
class admin_configure extends dbclass{
	function get_configure_detail($sorton, $sorttype, $option, $keyword, $var_limit) {
		if(isset($keyword) && !empty($keyword)) {
			$search_cond = " AND ".$option." like '".$keyword."%'";
		}
		$order_cond = ' order by '.$sorton.' '.$sorttype;
		$query = "select * from configure where 1=1".$search_cond.$order_cond.$var_limit;
		$sql = $this->select($query);
		return $sql;
	}
	
	function count_configure_detail($option, $keyword) {
		if(isset($keyword) && !empty($keyword)) {
			$search_cond = " AND ".$option." like '".$keyword."%'";
		}
		$query = "select count(*) as tot from configure where 1=1".$search_cond;
		$sql = $this->select($query);
		return $sql[0]["tot"];
	}
	
	function get_all_configure_detail() {
		$query = "select * from configure where Con_Status='Active'";
		$sql = $this->select($query);
		return $sql;
	}
	
	function funoperation() {
		$msg='';
		if($_REQUEST['action']=='active') {
			$query = "update configure set Con_Status='Active' where Con_Id in (".implode(",",$_REQUEST['chk']).")";
			$msg='Selected Record(s) Active Successfully';
		}
		if($_REQUEST['action']=='inactive') {
			$query = "update configure set Con_Status='Inactive' where Con_Id in (".implode(",",$_REQUEST['chk']).")";
			$msg='Selected Record(s) Inactive Successfully';
		}
		if($_REQUEST['action']=='delete') {
			$query = "delete from configure where Con_Id in (".implode(",",$_REQUEST['chk']).")";
			$msg='Selected Record(s) Delete Successfully';
		}
		$this->update($query);
		return $msg;
	}

	function get_configure_single_detail($txtconfigureid) {
		
		$query = "SELECT * FROM configure where Con_Id='".$txtconfigureid."'";
		
		$sql = $this->select($query);
		
		return $sql;
	
	}
	
	function update_configure_detail($status,$id,$title,$fromemail,$mobile,$address,$image,$servicecharge,$contax,$vat,$table,$currency) {
		$msg='';
		$query = "update configure set Con_Status='".$status."', Con_Title='".addslashes($title)."',Con_from_Email='".addslashes(stripslashes($fromemail))."',Con_Mobile='".stripslashes($mobile)."',Con_Address='".$address."',Con_Image='".$image."',Con_Servicecharges='".$servicecharge."',Con_ConTax='".$contax."', Con_VAT='".$vat."', Con_TableNo='".$table."',Con_CurrencySym='".$currency."' where Con_Id='".$id."'";
		$sql = $this->update($query);
		$msg='Configure Detail update successfully';
		return $msg;
	}
	
	function add_configure_detail($status,$title,$fromemail,$mobile,$address,$image,$servicecharge,$contax,$vat,$table,$currency) {
		$msg='';
		$query = "insert configure set Con_Status='".$status."', Con_Title='".addslashes($title)."',Con_from_Email='".addslashes(stripslashes($fromemail))."',Con_Mobile='".stripslashes($mobile)."',Con_Address='".$address."',Con_Image='".$image."',Con_Servicecharges='".$servicecharge."',Con_ConTax='".$contax."', Con_VAT='".$vat."', Con_TableNo='".$table."',Con_CurrencySym='".$currency."'";
		$sql = $this->insert($query);
		$msg='Configure Detail added successfully';
		return $sql;
	}
	
	function get_configure_single_detail1($txtconfigureid) {
		$query = "SELECT * FROM configure where Con_Status='Active' and Con_Id='".$txtconfigureid."'";
		$sql = $this->select($query);
		return $sql;
	}
}
?>