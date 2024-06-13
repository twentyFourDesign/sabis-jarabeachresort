<?php

class admin_allergens extends dbclass{

	function get_allergens_detail($sorton, $sorttype, $option, $keyword, $var_limit) {

		if(isset($keyword) && !empty($keyword)) {

			$search_cond = " AND ".$option." like '".$keyword."%'";

		}

		$order_cond = ' order by '.$sorton.' '.$sorttype;

		$query = "select * from allergens where 1=1".$search_cond.$order_cond.$var_limit;

		$sql = $this->select($query);

		return $sql;

	}

	

	function count_member_detail($option, $keyword) {

		if(isset($keyword) && !empty($keyword)) {

			$search_cond = " AND ".$option." like '".$keyword."%'";

		}

		$query = "select count(*) as tot from allergens where 1=1".$search_cond;

		$sql = $this->select($query);

		return $sql[0]["tot"];

	}

	

	function funoperation() {

		$msg='';

		if($_REQUEST['action']=='active') {

			$query = "update allergens set All_Status='Active' where All_Id in (".implode(",",$_REQUEST['chk']).")";

			$msg='Selected Record(s) Active Successfully';

		}

		if($_REQUEST['action']=='inactive') {

			$query = "update allergens set All_Status='Inactive' where All_Id in (".implode(",",$_REQUEST['chk']).")";

			$msg='Selected Record(s) Inactive Successfully';

		}

		if($_REQUEST['action']=='delete') {

			$query = "delete from allergens where All_Id in (".implode(",",$_REQUEST['chk']).")";

			$msg='Selected Record(s) Delete Successfully';

		}

		$this->update($query);

		return $msg;

	}



	function get_allergens_single_detail($txtuid) {

		$query = "SELECT * FROM allergens where All_Id='".$txtuid."'";

		$sql = $this->select($query);

		return $sql;

	}

	

	function update_allergens_detail($status,$uid,$title) {

		$msg='';

		$query = "update allergens set All_Status='".$status."', All_Title='".$title."'  where All_Id='".$uid."'";

		$sql = $this->update($query);

		$msg='Allergens updated Successfully';

		return $msg;

	}

	

	function add_allergens_detail($status,$title) {

		$msg='';

		$query = "insert allergens set All_Status='".$status."', All_Title='".$title."'";

		$sql = $this->insert($query);

		$msg='Allergens Added Successfully';

		return $sql;

	}

}

?>