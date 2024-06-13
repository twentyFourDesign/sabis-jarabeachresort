<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Menu_model extends CI_Model
{
	function __construct() {
		parent::__construct();
 	}

	 public function get_menu_category()
	 {
		 $this->db->select('*')->from('menu_category');
		 $this->db->where('MC_Parent !=', 0);
		 $this->db->order_by('MC_Title','ASC');
 		 $query = $this->db->get();
		 return $query->result_array();
	 }

	 public function get_category_menu_list($catId)
	 {
		 $imgPath = base_url()."upload/mi/";
		 $query = "select
                           MI_Title as title,
                           MI_Cost as price,
                           MI_Desc as description,
                           CONCAT('$imgPath',MI_Id,'_',MI_Img) as image,
                           MI_Qty as qty
                    from menu_item where MI_Status = 'Active' and MI_CategoryId = $catId order by MI_Title asc";
		 $query = $this->db->query($query);
		 return $query->result_array();
	 }
}
