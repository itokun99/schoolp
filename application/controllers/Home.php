<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class home extends Core_Controller
{

    function __construct()
    {
        parent::__construct();
		
		$this->checkAuth();
        $this->load->model("UserModel");
		$this->load->library('user_agent');
    }

    public function index()
    {		
		if ($this->agent->is_mobile("android")) {
			$this->session->set_userdata("schoolp_mobile", 1);	
		}
		else if ($this->agent->is_mobile("iphone")) {
			$this->session->set_userdata("schoolp_mobile", 1);	
		}
		else if ($this->agent->is_mobile("gt-p")) {
			$this->session->set_userdata("schoolp_mobile", 1);	
		}

		redirect("children/profile");
    }
	
	public function web()
    {
		$this->session->unset_userdata("schoolp_mobile");
		
		redirect("children/profile");
    }

}
