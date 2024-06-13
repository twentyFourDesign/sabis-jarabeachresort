<?php

class admin_order extends dbclass{

	function get_order_detail($sorton, $sorttype, $option, $keyword, $var_limit) {

		if(isset($keyword) && !empty($keyword)) {

			$search_cond = " AND ".$option." like '".$keyword."%'";

		}

		$order_cond = ' order by '.$sorton.' '.$sorttype;

		$query = "select * from orders where 1=1".$search_cond.$order_cond.$var_limit;

		$sql = $this->select($query);

		return $sql;

	}

	

	function count_member_detail($option, $keyword) {

		if(isset($keyword) && !empty($keyword)) {

			$search_cond = " AND ".$option." like '".$keyword."%'";

		}

		$query = "select count(*) as tot from orders where 1=1".$search_cond;

		$sql = $this->select($query);

		return $sql[0]["tot"];

	}

	

	function funoperation() {

		$msg='';

		if($_REQUEST['action']=='active') {

			$query = "update orders set Ord_Status='Active' where Ord_Id in (".implode(",",$_REQUEST['chk']).")";

			$msg='Selected Record(s) Active Successfully';

		}

		if($_REQUEST['action']=='inactive') {

			$query = "update orders set Ord_Status='Inactive' where Ord_Id in (".implode(",",$_REQUEST['chk']).")";

			$msg='Selected Record(s) Inactive Successfully';

		}

		if($_REQUEST['action']=='delete') {

			$query = "delete from orders where Ord_Id in (".implode(",",$_REQUEST['chk']).")";
			$query2 = "delete from order_item where OI_OrderId in (".implode(",",$_REQUEST['chk']).")";
			
			$msg='Selected Record(s) Delete Successfully';

		}
		if($_REQUEST['action']=='completed') {

			$query = "update orders set Ord_PaymentStatus='Completed' where Ord_Id in (".implode(",",$_REQUEST['chk']).")";

			$msg='Selected Record(s) Completed Successfully';

		}
		if($_REQUEST['action']=='processing') {

			$query = "update orders set Ord_PaymentStatus='Processing' where Ord_Id in (".implode(",",$_REQUEST['chk']).")";

			$msg='Selected Record(s) Processing Successfully';

		}
		
		

		$this->update($query);
		if($query2!='') {
		    $this->update($query2);
		}

		return $msg;

	}



	function get_order_single_detail($txtuid) {

		$query = "SELECT * FROM orders where Ord_Id='".$txtuid."'";

		$sql = $this->select($query);

		return $sql;

	}

	

	function update_order_detail($status,$uid,$title, $noguest, $date, $firstname, $email, $phone, $dob, $allergens, $servicecharge, $comptax, $vat, $total, $vcode, $discode, $distype, $disvalue, $discount, $extra, $gtotal, $ostatus, $paymode, $paystatus, $transac, $instruct, $address, $whattime, $whereeat, $comment) {

		$msg='';

		$query = "update orders set Ord_Status='".$status."', Ord_TableNo='".$title."', Ord_NoOfGuest='".$noguest."', Ord_Date='".$date."', Ord_FirstName='".$firstname."', Ord_Email='".$email."', Ord_Phone='".$phone."', Ord_Dob='".$dob."', Ord_Allergens='".$allergens."', Ord_ServiceCharge='".$servicecharge."', Ord_ConTax='".$comptax."', Ord_Vat='".$vat."', Ord_Total='".$total."', Ord_VoucherCode='".$vcode."', Ord_DiscountCode='".$discode."', Ord_DiscountType='".$distype."', Ord_DiscountValue='".$disvalue."', Ord_Discount='".$discount."', Ord_Extra='".$extra."', Ord_GrandTotal='".$gtotal."', Ord_OrderStatus='".$ostatus."', Ord_PaymentMode='".$paymode."', Ord_PaymentStatus='".$paystatus."', Ord_TransactionID='".$transac."', Ord_Instruction='".$instruct."', Ord_DeliveryAddress='".$address."', Ord_Whattime='".$whattime."', Ord_Whereeat='".$whereeat."', Ord_Comments='".$comment."'  where Ord_Id='".$uid."'";

		$sql = $this->update($query);

		$msg='Order updated Successfully';

		return $msg;

	}

	

	function add_order_detail($status,$title, $noguest, $date, $firstname, $email, $phone, $dob, $allergens, $servicecharge, $comptax, $vat, $total, $vcode, $discode, $distype, $disvalue, $discount, $extra, $gtotal, $ostatus, $paymode, $paystatus, $transac, $instruct, $address, $whattime, $whereeat, $comment) {

		$msg='';

		$query = "insert orders set Ord_Status='".$status."', Ord_TableNo='".$title."', Ord_NoOfGuest='".$noguest."', Ord_Date='".$date."', Ord_FirstName='".$firstname."', Ord_Email='".$email."', Ord_Phone='".$phone."', Ord_Dob='".$dob."', Ord_Allergens='".$allergens."', Ord_ServiceCharge='".$servicecharge."', Ord_ConTax='".$comptax."', Ord_Vat='".$vat."', Ord_Total='".$total."', Ord_VoucherCode='".$vcode."', Ord_DiscountCode='".$discode."', Ord_DiscountType='".$distype."', Ord_DiscountValue='".$disvalue."', Ord_Discount='".$discount."', Ord_Extra='".$extra."', Ord_GrandTotal='".$gtotal."', Ord_OrderStatus='".$ostatus."', Ord_PaymentMode='".$paymode."', Ord_PaymentStatus='".$paystatus."', Ord_TransactionID='".$transac."', Ord_Instruction='".$instruct."', Ord_DeliveryAddress='".$address."', Ord_Whattime='".$whattime."', Ord_Whereeat='".$whereeat."', Ord_Comments='".$comment."'";

		$sql = $this->insert($query);

		$msg='Order Added Successfully';

		return $sql;

	}

}

?>