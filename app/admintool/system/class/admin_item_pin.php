<?php

class admin_item_pin extends dbclass{

	function get_item_pin_detail($sorton, $sorttype, $option, $keyword, $var_limit) {

		if(isset($keyword) && !empty($keyword)) {

			$search_cond = " AND ".$option." like '".$keyword."%'";

		}

		$order_cond = ' order by '.$sorton.' '.$sorttype;

		$query = "select * from item_pin where 1=1".$search_cond.$order_cond.$var_limit;

		$sql = $this->select($query);

		return $sql;

	}

	

	function count_member_detail($option, $keyword) {

		if(isset($keyword) && !empty($keyword)) {

			$search_cond = " AND ".$option." like '".$keyword."%'";

		}

		$query = "select count(*) as tot from item_pin where 1=1".$search_cond;

		$sql = $this->select($query);

		return $sql[0]["tot"];

	}

	

	function funoperation() {

		$msg='';

		if($_REQUEST['action']=='active') {

			$query = "update item_pin set IP_Status='Active' where IP_Id in (".implode(",",$_REQUEST['chk']).")";

			$msg='Selected Record(s) Active Successfully';

		}

		if($_REQUEST['action']=='inactive') {

			$query = "update item_pin set IP_Status='Inactive' where IP_Id in (".implode(",",$_REQUEST['chk']).")";

			$msg='Selected Record(s) Inactive Successfully';

		}

		if($_REQUEST['action']=='delete') {

			$query = "delete from item_pin where IP_Id in (".implode(",",$_REQUEST['chk']).")";

			$msg='Selected Record(s) Delete Successfully';

		}

		$this->update($query);

		return $msg;

	}



	function get_item_pin_single_detail($txtuid) {

		$query = "SELECT * FROM item_pin where IP_Id='".$txtuid."'";

		$sql = $this->select($query);

		return $sql;

	}

	

	function update_item_pin_detail($status,$uid,$title, $pin) {

		$msg='';

		$query = "update item_pin set IP_Status='".$status."', IP_Room='".$title."', IP_Pin='".$pin."'  where IP_Id='".$uid."'";

		$sql = $this->update($query);

		$msg='Item Pin updated Successfully';

		return $msg;

	}

	

	function add_item_pin_detail($status,$title, $pin) {

		$msg='';

		$query = "insert item_pin set IP_Status='".$status."', IP_Room='".$title."', IP_Pin='".$pin."'";

		$sql = $this->insert($query);

		$msg='Item Pin Added Successfully';

		return $sql;

	}

}

?>