<?php

class admin_menu_item extends dbclass{

	function get_menu_item_detail($sorton, $sorttype, $option, $keyword, $var_limit) {

 		if(isset($keyword) && !empty($keyword)) {

			$search_cond = " AND ".$option." like '".$keyword."%'";

		}

		$order_cond = ' order by '.$sorton.' '.$sorttype;

		$query = "select * from menu_item where 1=1".$search_cond.$order_cond.$var_limit;

		$sql = $this->select($query);

		return $sql;

	}

	

	function count_member_detail($option, $keyword) {

		if(isset($keyword) && !empty($keyword)) {

			$search_cond = " AND ".$option." like '".$keyword."%'";

		}

		$query = "select count(*) as tot from menu_item where 1=1".$search_cond;

		$sql = $this->select($query);

		return $sql[0]["tot"];

	}

	

	function funoperation() {

		$msg='';

		if($_REQUEST['action']=='active') {

			$query = "update menu_item set MI_Status='Active' where MI_Id in (".implode(",",$_REQUEST['chk']).")";

			$msg='Selected Record(s) Active Successfully';

		}

		if($_REQUEST['action']=='inactive') {

			$query = "update menu_item set MI_Status='Inactive' where MI_Id in (".implode(",",$_REQUEST['chk']).")";

			$msg='Selected Record(s) Inactive Successfully';

		}

		if($_REQUEST['action']=='delete') {

			$query = "delete from menu_item where MI_Id in (".implode(",",$_REQUEST['chk']).")";

			$msg='Selected Record(s) Delete Successfully';

		}

		$this->update($query);

		return $msg;

	}



	function get_menu_item_single_detail($txtuid) {

		$query = "SELECT * FROM menu_item where MI_Id='".$txtuid."'";

		$sql = $this->select($query);

		return $sql;

	}

	

	function update_menu_item_detail($status,$uid,$title, $cost, $category, $desc, $image, $qty, $sort, $selio) {

		$msg='';

        if($qty=='') { $qty='NULL'; }
		$query = "update menu_item set MI_Status='".$status."', MI_Title='".addslashes($title)."', MI_Cost='".$cost."', MI_CategoryId='".$category."', MI_Desc='".addslashes($desc)."', MI_Img='".$image."', MI_Qty=".$qty.", MI_Sort='".$sort."', MI_Item_option='".$selio."' where MI_Id='".$uid."'";
		$sql = $this->update($query);

		$msg='Menu Item updated Successfully';

		return $msg;

	}

	

	function add_menu_item_detail($status,$title, $cost, $category, $desc, $image, $qty, $sort, $selio) {

		$msg='';
        if($qty=='') { $qty='NULL'; }
		 $query = "insert menu_item set MI_Status='".$status."', MI_Title='".addslashes($title)."', MI_Cost='".$cost."', MI_CategoryId='".$category."', MI_Desc='".addslashes($desc)."', MI_Img='".$image."', MI_Qty=".$qty.", MI_Sort='".(int)$sort."', MI_Item_option='".$selio."'";

		$sql = $this->insert($query);

		$msg='Menu Item Added Successfully';

		return $sql;

	}

    function get_category_menu_list($catId)
    {
        $imgPath = SERVER_URL."upload/mi/";
        $query = "select
                           MI_Title as title,
                           MI_Cost as price,
                           MI_Desc as description,
                           CONCAT('$imgPath',MI_Id,'_',MI_Img) as image,
                           MI_Qty as qty
                    from menu_item where MI_Status = 'Active' and MI_CategoryId = $catId order by MI_Title asc";
        $sql = $this->simple_query($query);
        return $sql;
    }
}

?>