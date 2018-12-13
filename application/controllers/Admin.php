<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class admin extends Core_Controller
{

    function __construct()
    {
        parent::__construct();
		
		$this->checkAuth();
        $this->load->model("UserModel");
    }

    public function index()
    {
		$menu_id = "1";
		$menu_name = "Home";
		
		$cnt = array(
		  'menu_id' => $menu_id, 
		  'menu_name' => $menu_name
		);
		
		$this->load_content("admin/index", $cnt);
      
        
    }

}
