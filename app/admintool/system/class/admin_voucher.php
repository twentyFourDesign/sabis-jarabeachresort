<?php

class admin_voucher extends dbclass{

	function get_voucher_detail($sorton, $sorttype, $option, $keyword, $var_limit) {

		if(isset($keyword) && !empty($keyword)) {

			$search_cond = " AND ".$option." like '".$keyword."%'";

		}

		$order_cond = ' order by '.$sorton.' '.$sorttype;

		$query = "select * from voucher where 1=1".$search_cond.$order_cond.$var_limit;

		$sql = $this->select($query);

		return $sql;

	}

	

	function count_member_detail($option, $keyword) {

		if(isset($keyword) && !empty($keyword)) {

			$search_cond = " AND ".$option." like '".$keyword."%'";

		}

		$query = "select count(*) as tot from voucher where 1=1".$search_cond;

		$sql = $this->select($query);

		return $sql[0]["tot"];

	}

	

	function funoperation() {

		$msg='';

		if($_REQUEST['action']=='active') {

			$query = "update voucher set Vou_Status='Active' where Vou_Id in (".implode(",",$_REQUEST['chk']).")";

			$msg='Selected Record(s) Active Successfully';

		}

		if($_REQUEST['action']=='inactive') {

			$query = "update voucher set Vou_Status='Inactive' where Vou_Id in (".implode(",",$_REQUEST['chk']).")";

			$msg='Selected Record(s) Inactive Successfully';

		}

		if($_REQUEST['action']=='delete') {

			$query = "delete from voucher where Vou_Id in (".implode(",",$_REQUEST['chk']).")";

			$msg='Selected Record(s) Delete Successfully';

		}

		$this->update($query);

		return $msg;

	}



	function get_voucher_single_detail($txtuid) {

		$query = "SELECT * FROM voucher where Vou_Id='".$txtuid."'";

		$sql = $this->select($query);

		return $sql;

	}

	

	function update_voucher_detail($status,$uid,$title, $code, $amount, $start, $end) {

		$msg='';

		$query = "update voucher set Vou_Status='".$status."', Vou_Title='".$title."', Vou_Code='".$code."', Vou_Amount='".$amount."', Vou_Start_Date='".$start."', Vou_End_Date='".$end."'  where Vou_Id='".$uid."'";

		$sql = $this->update($query);

		$msg='Voucher updated successfully';

		return $msg;

	}

	

	function add_voucher_detail($status,$title, $code, $amount, $start, $end) {

		$msg='';

		$query = "insert voucher set Vou_Status='".$status."', Vou_Title='".$title."', Vou_Code='".$code."', Vou_Amount='".$amount."',Vou_Start_Date='".$start."', Vou_End_Date='".$end."' ";

		$sql = $this->insert($query);

		$msg='Voucher added successfully';

		return $sql;

	}

}

?>