<?php

class admin_order_status extends dbclass{

	function get_order_status_detail($sorton, $sorttype, $option, $keyword, $var_limit) {

		if(isset($keyword) && !empty($keyword)) {

			$search_cond = " AND ".$option." like '".$keyword."%'";

		}

		$order_cond = ' order by '.$sorton.' '.$sorttype;

		$query = "select * from order_status where 1=1".$search_cond.$order_cond.$var_limit;

		$sql = $this->select($query);

		return $sql;

	}

	

	function count_member_detail($option, $keyword) {

		if(isset($keyword) && !empty($keyword)) {

			$search_cond = " AND ".$option." like '".$keyword."%'";

		}

		$query = "select count(*) as tot from order_status where 1=1".$search_cond;

		$sql = $this->select($query);

		return $sql[0]["tot"];

	}

	

	function funoperation() {

		$msg='';

		if($_REQUEST['action']=='active') {

			$query = "update order_status set OS_Status='Active' where OS_Id in (".implode(",",$_REQUEST['chk']).")";

			$msg='Selected Record(s) Active Successfully';

		}

		if($_REQUEST['action']=='inactive') {

			$query = "update order_status set OS_Status='Inactive' where OS_Id in (".implode(",",$_REQUEST['chk']).")";

			$msg='Selected Record(s) Inactive Successfully';

		}

		if($_REQUEST['action']=='delete') {

			$query = "delete from order_status where OS_Id in (".implode(",",$_REQUEST['chk']).")";

			$msg='Selected Record(s) Delete Successfully';

		}

		$this->update($query);

		return $msg;

	}



	function get_order_status_single_detail($txtuid) {

		$query = "SELECT * FROM order_status where OS_Id='".$txtuid."'";

		$sql = $this->select($query);

		return $sql;

	}

	

	function update_order_status_detail($status,$uid,$title) {

		$msg='';

		$query = "update order_status set OS_Status='".$status."', OS_Title='".$title."'  where OS_Id='".$uid."'";

		$sql = $this->update($query);

		$msg='Order Status updated Successfully';

		return $msg;

	}

	

	function add_order_status_detail($status,$title) {

		$msg='';

		$query = "insert order_status set OS_Status='".$status."', OS_Title='".$title."'";

		$sql = $this->insert($query);

		$msg='Order Status Added Successfully';

		return $sql;

	}

}

?>