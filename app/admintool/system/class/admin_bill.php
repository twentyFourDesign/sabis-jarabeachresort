<?php
class admin_bill extends dbclass{
    function get_admin_single_detail($billname,$password) {
        $query = "SELECT * FROM bill where Bil_BillName='".$billname."' and Bil_Password='".$password."' and Bil_Status='Active'";
        $sql = $this->select($query);
        return $sql;
    }
	
	function get_bill_detail($sorton, $sorttype, $option, $keyword, $var_limit) {
		if(isset($keyword) && !empty($keyword)) {
			$search_cond = " AND ".$option." like '".$keyword."%'";
		}
		$order_cond = ' order by '.$sorton.' '.$sorttype;
		$query = "select * from bill where 1=1".$search_cond.$order_cond.$var_limit;
		$sql = $this->select($query);
		return $sql;
	}
	
	function count_bill_detail($option, $keyword) {
		if(isset($keyword) && !empty($keyword)) {
			$search_cond = " AND ".$option." like '".$keyword."%'";
		}
		$query = "select count(*) as tot from bill where 1=1".$search_cond;
		$sql = $this->select($query);
		return $sql[0]["tot"];
	}
	
	function funoperation() {
		$msg='';
		if($_REQUEST['action']=='active') {
			$query = "update bill set Bil_Status='Active' where Bil_Id in (".implode(",",$_REQUEST['chk']).")";
			$msg='Selected Record(s) Active Successfully';
		}
		if($_REQUEST['action']=='inactive') {
			$query = "update bill set Bil_Status='Inactive' where Bil_Id in (".implode(",",$_REQUEST['chk']).")";
			$msg='Selected Record(s) Inactive Successfully';
		}
		if($_REQUEST['action']=='delete') {
			$query = "delete from bill where Bil_Id in (".implode(",",$_REQUEST['chk']).")";
			$msg='Selected Record(s) Delete Successfully';
		}
		$this->update($query);
		return $msg;
	}

	function get_bill_single_detail($txtbillid) {
		$query = "SELECT * FROM bill where Bil_Id='".$txtbillid."'";
		$sql = $this->select($query);
		return $sql;
	}
	
	function update_bill_detail($status,$billid,$firstname, $email, $phone, $address, $total, $service1, $qnty1, $price1, $total1, $service2, $qnty2, $price2, $total2, $service3, $qnty3, $price3, $total3) {
		$msg='';
		$query = "update bill set Bil_Status='".$status."', Bil_Name='".$firstname."', Bil_Email='".$email."', Bil_Phone='".$phone."', Bil_Address='".$address."', Bil_Total='".$total."', Bil_Service1='".$service1."', Bil_Quantity1='".$qnty1."', Bil_Cost1='".$price1."', Bil_Total1='".$total1."', Bil_Service2='".$service2."', Bil_Quantity2='".$qnty2."', Bil_Cost2='".$price2."', Bil_Total2='".$total2."', Bil_Service3='".$service3."', Bil_Quantity3='".$qnty3."', Bil_Cost3='".$price3."', Bil_Total3='".$total3."' where Bil_Id='".$billid."'";
		$sql = $this->update($query);
		$msg='Bill update Successfully';
		return $msg;
	}
	
	function add_bill_detail($status,$firstname, $email, $phone, $address, $total, $service1, $qnty1, $price1, $total1, $service2, $qnty2, $price2, $total2, $service3, $qnty3, $price3, $total3) {
		$msg='';
		$query = "insert bill set Bil_Status='".$status."', Bil_Name='".$firstname."', Bil_Email='".$email."', Bil_Phone='".$phone."', Bil_Address='".$address."', Bil_Total='".$total."', Bil_Service1='".$service1."', Bil_Quantity1='".$qnty1."', Bil_Cost1='".$price1."', Bil_Total1='".$total1."', Bil_Service2='".$service2."', Bil_Quantity2='".$qnty2."', Bil_Cost2='".$price2."', Bil_Total2='".$total2."', Bil_Service3='".$service3."', Bil_Quantity3='".$qnty3."', Bil_Cost3='".$price3."', Bil_Total3='".$total3."'";
		$sql = $this->insert($query);
		$msg='Bill Added Successfully';
		return $msg;
	}
}
?>