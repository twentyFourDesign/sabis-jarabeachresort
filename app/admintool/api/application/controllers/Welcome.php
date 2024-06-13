<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require(APPPATH.'/libraries/REST_Controller.php');

//class Welcome extends CI_Controller {
class Welcome extends REST_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('menu_model');
    }
    public function index_get(){
        echo phpversion();
        die();
        $response = ['status'=>true,'data'=>null,'message'=>"No Data Found"];
        $menuCategories = $this->menu_model->get_menu_category();
        if(!empty($menuCategories) && count($menuCategories) > 0)
        {
            $returnData = [];
            foreach ($menuCategories as $menuCategory)
            {
                $tempArray = [];
                $categoryTitle = $menuCategory['MC_Title'];
                $tempArray['title'] = $categoryTitle ;

                $menu_list = $this->menu_model->get_category_menu_list($menuCategory['MC_Id']);
                if(count($menu_list) >0)
                {
                    $tempArray['data'] = $menu_list;
                }
                $returnData[] = $tempArray;
            }
            $response = ['status'=>true,'message'=>"",'data'=>$returnData];
        }
        $this->response($response);
    }

}
