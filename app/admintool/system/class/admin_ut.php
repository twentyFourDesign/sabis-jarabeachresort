<?php
class admin_ut extends dbclass{
	function get_ut_detail($sorton, $sorttype, $option, $keyword, $var_limit) {
		if(isset($keyword) && !empty($keyword)) {
			$search_cond = " AND ".$option." like '".$keyword."%'";
		}
		$order_cond = ' order by '.$sorton.' '.$sorttype;
		$query = "select * from usertype where 1=1".$search_cond.$order_cond.$var_limit;
		$sql = $this->select($query);
		return $sql;
	}
	
	function count_ut_detail($option, $keyword) {
		if(isset($keyword) && !empty($keyword)) {
			$search_cond = " AND ".$option." like '".$keyword."%'";
		}
		$query = "select count(*) as tot from usertype where 1=1".$search_cond;
		$sql = $this->select($query);
		return $sql[0]["tot"];
	}
	
	function get_ut_single_detail($txtpage_contentid) {
		$query = "SELECT * FROM usertype where UT_Id='".$txtpage_contentid."'";
		$sql = $this->select($query);
		return $sql;
	}
	
	function funoperation() {
		$msg='';
		if($_REQUEST['action']=='delete') {
			$query = "delete from usertype where UT_Id in (".implode(",",$_REQUEST['chk']).")";
			$msg='Selected Record(s) Delete Successfully';
		}
		$this->update($query);
		return $msg;
	}
	
	function update_ut_detail($utid,$title,$module,$moduleadd,$moduleedit,$moduledelete) {
		$msg='';
		$query = "update usertype set UT_Title='".addslashes($title)."',UT_Module='".$module."',UT_Add='".$moduleadd."',UT_Edit='".$moduleedit."',UT_Delete='".$moduledelete."' where UT_Id='".$utid."'";
		$sql = $this->update($query);
		$msg='User type detail update Successfully';
		return $msg;
	}
	
	function add_ut_detail($title,$module,$moduleadd,$moduleedit,$moduledelete) {
		$msg='';
		$query = "insert usertype set UT_Title='".addslashes($title)."',UT_Module='".$module."',UT_Add='".$moduleadd."',UT_Edit='".$moduleedit."',UT_Delete='".$moduledelete."'";
		$sql = $this->insert($query);
		$msg='User Type Detail Added Successfully';
		return $msg;
	}
	function get_module_detail() {
		$query = "select * from modulefile order by MF_Id";
		$sql = $this->select($query);
		return $sql;
	}
}
?>