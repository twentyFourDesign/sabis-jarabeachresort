<?php
class admin_user extends dbclass{
    function get_admin_single_detail($username,$password) {
        $query = "SELECT * FROM user where Usr_UserName='".$username."' and Usr_Password='".$password."' and Usr_Status='Active'";
        $sql = $this->select($query);
        return $sql;
    }
	
	function get_user_detail($sorton, $sorttype, $option, $keyword, $var_limit) {
		if(isset($keyword) && !empty($keyword)) {
			$search_cond = " AND ".$option." like '".$keyword."%'";
		}
		$order_cond = ' order by '.$sorton.' '.$sorttype;
		$query = "select * from user where 1=1".$search_cond.$order_cond.$var_limit;
		$sql = $this->select($query);
		return $sql;
	}
	
	function get_c_single_detail($username,$password) {
	    $query = "SELECT * FROM client where c_p_num='".$username."' and c_pass='".$password."' and c_stat='Active'";
        $sql = $this->select($query);
        return $sql;
	}
	
	function count_user_detail($option, $keyword) {
		if(isset($keyword) && !empty($keyword)) {
			$search_cond = " AND ".$option." like '".$keyword."%'";
		}
		$query = "select count(*) as tot from user where 1=1".$search_cond;
		$sql = $this->select($query);
		return $sql[0]["tot"];
	}
	
	function funoperation() {
		$msg='';
		if($_REQUEST['action']=='active') {
			$query = "update user set Usr_Status='Active' where Usr_Id in (".implode(",",$_REQUEST['chk']).")";
			$msg='Selected Record(s) Active Successfully';
		}
		if($_REQUEST['action']=='inactive') {
			$query = "update user set Usr_Status='Inactive' where Usr_Id in (".implode(",",$_REQUEST['chk']).")";
			$msg='Selected Record(s) Inactive Successfully';
		}
		if($_REQUEST['action']=='delete') {
			$query = "delete from user where Usr_Id in (".implode(",",$_REQUEST['chk']).")";
			$msg='Selected Record(s) Delete Successfully';
		}
		$this->update($query);
		return $msg;
	}

	function get_user_single_detail($txtuserid) {
		$query = "SELECT * FROM user where Usr_Id='".$txtuserid."'";
		$sql = $this->select($query);
		return $sql;
	}
	
	function update_user_detail($status,$userid,$username,$password,$firstname,$lastname,$no,$ut,$shortname,$image) {
		$msg='';
		$query = "update user set Usr_Status='".$status."', Usr_UserName='".$username."', Usr_Password='".$password."', Usr_FirstName='".$firstname."', Usr_LastName='".$lastname."', Usr_No='".$no."', Usr_img='".$image."', Usr_Type='".$ut."', Usr_ShortName='".$shortname."' where Usr_Id='".$userid."'";
		$sql = $this->update($query);
		$msg='User update Successfully';
		return $msg;
	}
	
	function add_user_detail($status,$username,$password,$firstname,$lastname,$no,$ut,$shortname,$image) {
		$msg='';
		$query = "insert user set Usr_Status='".$status."', Usr_UserName='".$username."', Usr_Password='".$password."', Usr_FirstName='".$firstname."', Usr_LastName='".$lastname."', Usr_No='".$no."', Usr_img='".$image."', Usr_Type='".$ut."', Usr_ShortName='".$shortname."'";
		$sql = $this->insert($query);
		$msg='User Added Successfully';
		return $msg;
	}
}
?>