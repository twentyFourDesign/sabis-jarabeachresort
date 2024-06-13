<?php

class admin_item_option extends dbclass{

	function get_item_option_detail($sorton, $sorttype, $option, $keyword, $var_limit) {

		if(isset($keyword) && !empty($keyword)) {

			$search_cond = " AND ".$option." like '".$keyword."%'";

		}

		$order_cond = ' order by '.$sorton.' '.$sorttype;

		$query = "select * from item_option where 1=1".$search_cond.$order_cond.$var_limit;

		$sql = $this->select($query);

		return $sql;

	}

	

	function count_member_detail($option, $keyword) {

		if(isset($keyword) && !empty($keyword)) {

			$search_cond = " AND ".$option." like '".$keyword."%'";

		}

		$query = "select count(*) as tot from item_option where 1=1".$search_cond;

		$sql = $this->select($query);

		return $sql[0]["tot"];

	}

	

	function funoperation() {

		$msg='';

		if($_REQUEST['action']=='active') {

			$query = "update item_option set io_status='Active' where io_id in (".implode(",",$_REQUEST['chk']).")";

			$msg='Selected Record(s) Active Successfully';

		}

		if($_REQUEST['action']=='inactive') {

			$query = "update item_option set io_status='Inactive' where io_id in (".implode(",",$_REQUEST['chk']).")";

			$msg='Selected Record(s) Inactive Successfully';

		}

		if($_REQUEST['action']=='delete') {

			$query = "delete from item_option where io_id in (".implode(",",$_REQUEST['chk']).")";

			$msg='Selected Record(s) Delete Successfully';

		}

		$this->update($query);

		return $msg;

	}



	function get_item_option_single_detail($txtuid) {

		$query = "SELECT * FROM item_option where io_id='".$txtuid."'";

		$sql = $this->select($query);

		return $sql;

	}

	

	function update_item_option_detail($status,$uid,$title,$price) {

		$msg='';

		$query = "update item_option set io_status='".$status."', io_title='".$title."', io_price='".$price."'  where io_id='".$uid."'";

		$sql = $this->update($query);

		$msg='Item Option updated Successfully';

		return $msg;

	}

	

	function add_item_option_detail($status,$title,$price) {

		$msg='';

		$query = "insert item_option set io_status='".$status."', io_title='".$title."', io_price='".$price."'";

		$sql = $this->insert($query);

		$msg='Item Option Added Successfully';

		return $sql;

	}

}

?>