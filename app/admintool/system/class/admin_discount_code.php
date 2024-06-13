<?php

class admin_discount_code extends dbclass{

	function get_discount_code_detail($sorton, $sorttype, $option, $keyword, $var_limit) {

		if(isset($keyword) && !empty($keyword)) {

			$search_cond = " AND ".$option." like '".$keyword."%'";

		}

		$order_cond = ' order by '.$sorton.' '.$sorttype;

		$query = "select * from discount_code where 1=1".$search_cond.$order_cond.$var_limit;

		$sql = $this->select($query);

		return $sql;

	}

	

	function count_member_detail($option, $keyword) {

		if(isset($keyword) && !empty($keyword)) {

			$search_cond = " AND ".$option." like '".$keyword."%'";

		}

		$query = "select count(*) as tot from discount_code where 1=1".$search_cond;

		$sql = $this->select($query);

		return $sql[0]["tot"];

	}

	

	function funoperation() {

		$msg='';

		if($_REQUEST['action']=='active') {

			$query = "update discount_code set DC_Status='Active' where DC_Id in (".implode(",",$_REQUEST['chk']).")";

			$msg='Selected Record(s) Active Successfully';

		}

		if($_REQUEST['action']=='inactive') {

			$query = "update discount_code set DC_Status='Inactive' where DC_Id in (".implode(",",$_REQUEST['chk']).")";

			$msg='Selected Record(s) Inactive Successfully';

		}

		if($_REQUEST['action']=='delete') {

			$query = "delete from discount_code where DC_Id in (".implode(",",$_REQUEST['chk']).")";

			$msg='Selected Record(s) Delete Successfully';

		}

		$this->update($query);

		return $msg;

	}



	function get_discount_code_single_detail($txtuid) {

		$query = "SELECT * FROM discount_code where DC_Id='".$txtuid."'";

		$sql = $this->select($query);

		return $sql;

	}

	

	function update_discount_code_detail($status,$uid,$title, $code, $amount, $type,$start, $end) {

		$msg='';

		$query = "update discount_code set DC_Status='".$status."', DC_Title='".$title."', DC_Code='".$code."', DC_Amount='".$amount."', DC_AmtType='".$type."', DC_Start_Date='".$start."', DC_End_Date='".$end."'  where DC_Id='".$uid."'";

		$sql = $this->update($query);

		$msg='Discount Code updated successfully';

		return $msg;

	}

	

	function add_discount_code_detail($status,$title, $code, $amount, $type, $start, $end) {

		$msg='';

		$query = "insert discount_code set DC_Status='".$status."', DC_Title='".$title."', DC_Code='".$code."', DC_Amount='".$amount."', DC_AmtType='".$type."', DC_Start_Date='".$start."', DC_End_Date='".$end."'";

		$sql = $this->insert($query);

		$msg='Discount Code added successfully';

		return $sql;

	}

}

?>