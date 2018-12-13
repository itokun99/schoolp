<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class mobile extends Core_Controller
{

    function __construct()
    {
        parent::__construct();
		
        $this->load->model("UserModel");
    }

    public function index()
    {
		$this->session->set_userdata("schoolp_mobile", 1);		
		redirect('children/profile');
    }
	
	public function web()
    {
		$this->session->unset_userdata("schoolp_mobile");
		redirect('children/profile');
    }
	
	public function page()
    {
		$this->load->view('contents/admin/mobile');
    }
	
}
