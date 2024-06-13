<?php

class admin_menu_category extends dbclass{

	function get_menu_category_detail($sorton, $sorttype, $option, $keyword, $var_limit) {

		if(isset($keyword) && !empty($keyword)) {

			$search_cond = " AND ".$option." like '".$keyword."%'";

		}

		$order_cond = ' order by '.$sorton.' '.$sorttype;

		$query = "select * from menu_category where 1=1".$search_cond.$order_cond.$var_limit;

		$sql = $this->select($query);

		return $sql;

	}

	

	function count_member_detail($option, $keyword) {

		if(isset($keyword) && !empty($keyword)) {

			$search_cond = " AND ".$option." like '".$keyword."%'";

		}

		$query = "select count(*) as tot from menu_category where 1=1".$search_cond;

		$sql = $this->select($query);

		return $sql[0]["tot"];

	}

	

	function funoperation() {

		$msg='';

		if($_REQUEST['action']=='active') {

			$query = "update menu_category set MC_Status='Active' where MC_Id in (".implode(",",$_REQUEST['chk']).")";

			$msg='Selected Record(s) Active Successfully';

		}

		if($_REQUEST['action']=='inactive') {

			$query = "update menu_category set MC_Status='Inactive' where MC_Id in (".implode(",",$_REQUEST['chk']).")";

			$msg='Selected Record(s) Inactive Successfully';

		}

		if($_REQUEST['action']=='delete') {

			$query = "delete from menu_category where MC_Id in (".implode(",",$_REQUEST['chk']).")";

			$msg='Selected Record(s) Delete Successfully';

		}

		$this->update($query);

		return $msg;

	}



	function get_menu_category_single_detail($txtuid) {

		$query = "SELECT * FROM menu_category where MC_Id='".$txtuid."'";

		$sql = $this->select($query);

		return $sql;

	}

	

	function update_menu_category_detail($status,$uid,$title, $parent, $image, $sort, $usertype,$guest) {

		$msg='';

		$query = "update menu_category set MC_Status='".$status."', MC_Title='".addslashes($title)."', MC_Parent='".$parent."', MC_Image='".$image."', MC_Sort='".$sort."', MC_Utype='".$usertype."', MC_Align='".$guest."' where MC_Id='".$uid."'";

		$sql = $this->update($query);

		$msg='Menu Category updated Successfully';

		return $msg;

	}

	

	function add_menu_category_detail($status,$title, $parent, $image, $sort, $usertype,$guest) {

		$msg='';

		$query = "insert menu_category set MC_Status='".$status."', MC_Title='".addslashes($title)."', MC_Parent='".$parent."', MC_Image='".$image."', MC_Sort='".$sort."', MC_Utype='".$usertype."', MC_Align='".$guest."'";

		$sql = $this->insert($query);

		$msg='Menu Category Added Successfully';

		return $sql;

	}
    function get_menu_category()    {
        $query = "select * from menu_category where MC_Parent != 0 order by MC_Title ASC";
        $sql = $this->select($query);
        return $sql;
    }

}

?>