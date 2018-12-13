<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Core_Controller extends CI_Controller {

	public $defaultTemplate = "default";
	public $loginTemplate = "login";
    public $mobileTemplate = "mobile";

	function __construct() {
		parent::__construct();
		
		date_default_timezone_set("Asia/Bangkok");
		$this->form_validation->set_error_delimiters('<span>', '</span>');
		
		$this->basedb = "";
		$this->connectdb($this->basedb . "school_master");
		
		$this->load->helper('text');
		
		$dt = Time();
		$date_now = $this->DateAdd($dt, "H", 0);
    
	    $this->day_ok = $this->cDay($date_now);
	    $this->month_ok = $this->cMonth($date_now);
	    $this->year_ok = $this->cYear($date_now);
		
		$dt = Time();
		$date_sch = $this->DateAdd($dt, "d", 1);
		$this->date_sch = $this->cDateSch($date_sch);
		
		$this->load->model("UserModel");
		$this->load->model("ActivityModel");
		$this->load->model("SchoolModel");
		$this->load->model("ParentStudentModel");
				
		//$link_school = "http://localhost:81/project/schoolc";
		$link_school = "http://kes.co.id/schoolc";
		$this->session->set_userdata("link_school", $link_school);
		
		$this->cek_reminder();
	}

	public function getControllerName() {
		return $this->router->fetch_class();
	}

	public function isLoggedIn() {
		$islogged = false;

		$loggedIn = $this->session->userdata("schoolp_logged_in");
		if (isset($isLogged) && $loggedIn) {
			$islogged = true;
		}

		return $islogged;
	}

	public function checkAuth() {
		$islogged = false;
		
		if ($this->session->userdata("schoolp_mobile"))	redirect(base_url() . "mobile/page");
		
		$loggedIn = $this->session->userdata("schoolp_logged_in");
		if (isset($loggedIn) && $loggedIn ==  true) {
			$islogged = true;
			
			$quez_id = $this->session->userdata("schoolp_member_id");
			$member = $this->UserModel->getOne(array('memberid' => $quez_id));
			if (isset($member) && is_object($member) && $member != false)
				$this->session->set_userdata("schoolp_picprofile", $member->picture);
				
			else
				redirect(base_url() . "home");
			
			$cek_parent = $this->db->query("SELECT student_id FROM b_parent_student	WHERE parent_id = '$quez_id' ORDER BY parstdid ASC LIMIT 0, 1");			
			if ($cek_parent->num_rows() == 0)
			{
				$this->session->set_userdata("schoolp_children_id", -1);	
			}
			
			// Children Year Default Setting
			$children_id = $this->session->userdata("schoolp_children_id");
			$dataDetail = $this->ParentStudentModel->getOne(array('student_id' => $children_id));
			
			$school_id = -1;
			if (isset($dataDetail) && is_object($dataDetail) && $dataDetail != false) $school_id = $dataDetail->school_id;
			
			$school = $this->SchoolModel->getOne(array('schoolid' => $school_id));
			
			if (isset($school) && is_object($school) && $school != false)
			{
				$school_code = $school->school_code;
				$school_code_tb = strtolower($school_code);
				$school_dbase = $this->basedb . "school_client_$school_code_tb";
				$get_dbclient = $this->connectdb($school_dbase);
				if ($get_dbclient)
				{
					$this->load->model("client/InfoModel");				
					$this->session->set_userdata("schoolp_scyear_id", -1);
					$this->session->set_userdata("schoolp_scyear_name", "Unknown");
					
					$school_info = $this->InfoModel->getOne(array('info_status' => 1));
					if (isset($school_info) && is_object($school_info) && $school_info != false)		
					{
						$scyear_name = $school_info->scyear_name;
						$scyear_name_next = $scyear_name + 1;
						$scyear_name_text = "$scyear_name / $scyear_name_next";
						
						$this->session->set_userdata("schoolp_scyear_id", $school_info->scyearid);
						$this->session->set_userdata("schoolp_scyear_name", $scyear_name_text);
						
					}
				}
			}
			
			$get_dbmaster = $this->connectdb($this->basedb . 'school_master');
		}

		if (!$islogged) {
			redirect(base_url() . "home");
		}
	}
	
	public function cek_reminder()
    {		
			$datez = date('Y-m-d H:i:s');
			
			$member_id = $this->session->userdata("schoolp_member_id");
			
			$get_reminder = $this->db->query("
				SELECT * FROM b_reminder
				WHERE edulevel_id <> '-2'
				AND reminder_start <= '$datez' AND reminder_end >= '$datez'
				AND reminderid NOT IN (SELECT reminder_id FROM b_reminder_read WHERE read_status = '1' AND member_id = '$member_id')
				ORDER BY b_reminder.reminder_end DESC
			");
			$total_reminder = $get_reminder->num_rows();
			
			$this->session->set_userdata("schoolp_total_reminder", $total_reminder);		
    }

    public function load_content($view = "", $cnt = null)
    {
		$mobile_text = "";
		if ($this->session->userdata("schoolp_mobile"))
		{
			$mobile_text = "mobile/";
		}
		
		$parent_id = $this->session->userdata("schoolp_member_id");
		
		$dataChildrens = $this->ParentStudentModel->getByCriteria(array('parstd_status' => 1, 'parent_id' => $parent_id), null, 0, 0, null, array('datez', 'DESC'));
		foreach ($dataChildrens as $i => $dataChildren)
		{
			$school = $this->SchoolModel->getOne(array('schoolid' => $dataChildren->school_id));
			$school_code = $school->school_code;
			$school_code_tb = strtolower($school_code);
			$school_dbase = $this->basedb . "school_client_$school_code_tb";
			$get_dbclient = $this->connectdb($school_dbase);
			if ($get_dbclient)
			{
				$student_name = "-";
				
				$children = $this->UserModel->getOne(array('memberid' => $dataChildren->student_id));
				
				if (isset($children) && is_object($children) && $children != false)
				{
					$student_name = $children->fullname;
				}
				
				$dataChildren->student_name = $student_name;
			}
				
			$get_dbmaster = $this->connectdb($this->basedb . 'school_master');
		}		
		
        $header = array(
			'defaultSkin' => $this->defaultTemplate,
			'isLoggedIn' => $this->isLoggedIn(),
			'schoolp_uname' => $this->session->userdata("schoolp_uname"),
			'schoolp_fname' => $this->session->userdata("schoolp_fname"),
			'picprofile' => $this->session->userdata("schoolp_picprofile"),
			'dataChildrens' => $dataChildrens,
			'controllerName' => $this->getControllerName(),
			'flashMsg' => $this->getFlash()
		);
		
        $this->load->view($mobile_text . 'templates/' . $this->defaultTemplate . '/header', array_merge($cnt, $header));

        if (!empty($view)) {
            $this->load->view($mobile_text . "contents/" . $view, $cnt);
        }

        $footer = array(
			'defaultSkin' => $this->defaultTemplate
		);

		$this->load->view($mobile_text . 'templates/' . $this->defaultTemplate . '/footer', array_merge($cnt, $footer));
    }
	
	public function load_login($view = "", $cnt = null, $hdr = array(), $ftr = array())
    {
        $header = array(
			'defaultSkin' => $this->defaultTemplate,
			'isLoggedIn' => $this->isLoggedIn(),
			'schoolp_uname' => $this->session->userdata("schoolp_uname"),
			'schoolp_fname' => $this->session->userdata("schoolp_fname"),
			'controllerName' => $this->getControllerName(),
			'flashMsg' => $this->getFlash()
		);
        $this->load->view('templates/' . $this->loginTemplate . '/header', array_merge($hdr, $header));

        if (!empty($view)) {
            $this->load->view("contents/" . $view, $cnt);
        }

        $footer = array(
			'defaultSkin' => $this->defaultTemplate
		);

		$this->load->view('templates/' . $this->loginTemplate . '/footer', array_merge($ftr, $footer));
    }
	
	public function load_page($view = "", $cnt = null)
    {
		$mobile_text = "";
		if ($this->session->userdata("schoolp_mobile"))
		{
			$mobile_text = "mobile/";
		}
		
        $pagehead = array(
			'defaultSkin' => $this->defaultTemplate,
			'isLoggedIn' => $this->isLoggedIn(),
			'schoolp_uname' => $this->session->userdata("schoolp_uname"),
			'schoolp_fname' => $this->session->userdata("schoolp_fname"),
			'controllerName' => $this->getControllerName(),
			'flashMsg' => $this->getFlash()
		);
		
        $this->load->view($mobile_text . 'templates/' . $this->defaultTemplate . '/pagehead', array_merge($cnt, $pagehead));

        if (!empty($view)) {
            $this->load->view($mobile_text . "contents/" . $view, $cnt);
        }

    }
	
	public function load_page_cont($view = "", $cnt = null)
    {
		$mobile_text = "";
		if ($this->session->userdata("schoolp_mobile"))
		{
			$mobile_text = "mobile/";
		}
		
        $pagehead = array(
			'defaultSkin' => $this->defaultTemplate,
			'isLoggedIn' => $this->isLoggedIn(),
			'schoolc_uname' => $this->session->userdata("schoolc_uname"),
			'schoolc_fname' => $this->session->userdata("schoolc_fname"),
			'controllerName' => $this->getControllerName(),
			'flashMsg' => $this->getFlash()
		);
		
        $this->load->view($mobile_text . 'templates/' . $this->defaultTemplate . '/pagecont', array_merge($cnt, $pagehead));

        if (!empty($view)) {
            $this->load->view($mobile_text . "contents/" . $view, $cnt);
        }

    }

    public function load_mobile($view = "", $cnt = null, $hdr = array(), $ftr = array())
    {
        $header = array(
            'defaultSkin' => $this->mobileTemplate,
            'isLoggedIn' => $this->isLoggedIn(),
            'uname' => $this->session->userdata("uname"),
            'groupName' => $this->session->userdata("group_name"),
            'controllerName' => $this->getControllerName(),
            'flashMsg' => $this->getFlash()
        );
        $this->load->view('templates/' . $this->mobileTemplate . '/header', array_merge($hdr, $header));

        if (!empty($view)) {
            $this->load->view("contents/" . $view, $cnt);
        }

        $footer = array(
            'defaultSkin' => $this->mobileTemplate
        );

        $this->load->view('templates/' . $this->mobileTemplate . '/footer', array_merge($ftr, $footer));
    }

	public function setFlash($msg = "", $type = "") {
		$this->session->set_userdata("flash_msg", array('msg' => $msg, 'type' => $type));
	}

	public function getFlash() {
		$msg = "";

		$flashMsg = $this->session->userdata("flash_msg");
		if (isset($flashMsg) && $flashMsg != "") {
			$msg = '<div class="flash-msg ' . $flashMsg['type'] . '-msg">' . $flashMsg['msg'] . '</div>';
			$this->session->unset_userdata("flash_msg");
		}

		return $msg;
	}
	
	public function activitydb($menu_title = "", $menu_desc = "", $menu_detail = "", $menu_action = "", $member_id = null, $username = null)
	{
		$datez = date('Y-m-d H:i:s');
		$ipaddress = $_SERVER['REMOTE_ADDR'];
		
		$member_id_ok = $this->session->userdata("schoolp_member_id");
		if ($member_id_ok <> "")
		{
			$member_id_ok = $this->session->userdata("schoolp_member_id");
			$username_ok = $this->session->userdata("schoolp_uname");
		}	
		else
		{
			$member_id_ok = -1;
			$username_ok = "";
		}
		
		
		$query_db = array(
			'member_id' => $member_id_ok,
			'username' => $username_ok,
			'menu_title' => $menu_title,
			'menu_desc' => $menu_desc,
			'menu_detail' => $menu_detail,
			'menu_action' => $menu_action,
			'ipaddress' => $ipaddress,			
			'datez' => $datez
		);	
		 
		$ins_activity_db = $this->ActivityModel->save($query_db);
	}

	public function RandomString($length = 10) {
	    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	    $randomString = '';
	    for ($i = 0; $i < $length; $i++) {
	        $randomString .= $characters[rand(0, strlen($characters) - 1)];
	    }
	    return $randomString;
	}
	
	public function connectdb($database = "", $hostname = "", $username = "", $password = "")
	{
		if ($hostname == "") $hostname = "localhost";
		if ($username == "") $username = "root";
		if ($password == "") $password = "";
		
		$config['hostname'] = $hostname;
		$config['username'] = $username;
		$config['password'] = $password;
		$config['database'] = $database;
		$config['dbdriver'] = 'mysqli';
		$config['dbprefix'] = '';
		$config['pconnect'] = FALSE;
		$config['db_debug'] = FALSE;
		$config['cache_on'] = FALSE;
		$config['cachedir'] = '';
		$config['char_set'] = 'utf8';
		$config['dbcollat'] = 'utf8_general_ci';
		
		$this->load->dbutil();
		if ($this->dbutil->database_exists($database))
		{
			$this->db = $this->load->database($config, TRUE);
			return $this->db;
		}
		else
			return false;
		
	}	
	
	public function sendEmail()
	{   
		// Email configuration
		$config = Array(
		   'protocol' => 'mail',
		   'smtp_host' => 'mail.kes.co.id',
		   'smtp_port' => 25,
		   'smtp_user' => 'info@kes.co.id', // change it to yours
		   'smtp_pass' => 'kes123456', // change it to yours
		   'mailtype' => 'html',
		   'charset' => 'iso-8859-1',
		   'wordwrap' => TRUE
		); 
	   
		$this->load->library('email', $config);		
	}
	
	public function DateDiff($Date1, $Date2, $Interval)
	{
		If ($Date1 < $Date2) {
		$dt1 = $Date1;
		$dt2 = $Date2;
		} Else {
		$dt1 = $Date2;
		$dt2 = $Date1;
		}
		$d1 = GetDate($dt1);
		$d2 = GetDate($dt2);
		$Date = $dt2 - $dt1;
		$d = GetDate($Date);
		Switch ($Interval) {
		Case "Y":
		//year
		$Number = GetYear($d1['year'], $d2['year'], $d1['mon'], $d2['mon'], $d1['mday'], $d2['mday']);
		Break;
		Case "m":
		//month
		//1 part, the same as in "Y" case
		$y = GetYear($d1['year'], $d2['year'], $d1['mon'], $d2['mon'], $d1['mday'], $d2['mday']);
		//2 part, rest months
		$dt1 = DateAdd($dt1, "Y", $y);
		$d1 = GetDate($dt1);
		While (True) {
		$m++;
		$dt1 = DateAdd($dt1, "m", 1);
		If ($dt1 >= $dt2) Break;
		}
		If ($dt1 > $dt2) $m--;
		$Number = ($y * 12) + $m;
		Break;
		Case "d":
		//day
		$Number = $Date / 86400; //60 sek. * 60 min. * 24 h.
		Break;
		Case "H":
		//hour
		$Number = $Date / 3600; //60 sek. * 60 min.
		Break;
		Case "M":
		//minute
		$Number = $Date / 60; //60 sek.
		Break;
		Case "S":
		//second
		$Number = $Date;
		Break;
		}
		If ($Date1 < $Date2) {
		Return $Number;
		} Else {
		Return $Number * (-1);
		}
	}
	
	public function DateAdd($Date, $Interval, $Number)
	{
		$d = GetDate($Date);
		Switch ($Interval) {
		Case ("Y"):
		//year
		$Date = MkTime($d['hours'], $d['minutes'], $d['seconds'],
		$d['mon'], $d['mday'], $d['year'] + $Number);
		Break;
		Case "m":
		//month
		$Date = MkTime($d['hours'], $d['minutes'], $d['seconds'],
		$d['mon'] + $Number, $d['mday'], $d['year']);
		Break;
		Case "d":
		//day
		$Date = MkTime($d['hours'], $d['minutes'], $d['seconds'],
		$d['mon'], $d['mday'] + $Number, $d['year']);
		Break;
		Case "H":
		//hour
		$Date = MkTime($d['hours'] + $Number, $d['minutes'], $d['seconds'],
		$d['mon'], $d['mday'], $d['year']);
		Break;
		Case "M":
		//minute
		$Date = MkTime($d['hours'], $d['minutes'] + $Number, $d['seconds'],
		$d['mon'], $d['mday'], $d['year']);
		Break;
		Case "S":
		//second
		$Date = MkTime($d['hours'], $d['minutes'], $d['seconds'] + $Number,
		$d['mon'], $d['mday'], $d['year']);
		Break;
		}
		Return $Date;
	}	
	
	public function cDateTimePL($Date)
	{
		Return StrFTime("%Y-%m-%d %H:%M:%S", $Date);
	}
	
	public function cDatePL($Date)
	{
		Return StrFTime("%Y-%m-%d", $Date);
	}
	
	public function cDateSch($Date)
	{
		Return StrFTime("%d-%m-%Y", $Date);
	}
	
	public function cTimePL($Date)
	{
		Return StrFTime("%H:%M", $Date);
	}
	
	public function cDatePLText($Date)
	{
		Return date("d F Y", $Date);
	}
	
	public function cYear($Date)
	{
		$d = GetDate($Date);
		Return $d['year'];
	}
	
	public function cMonth($Date)
	{
		$d = GetDate($Date);
		Return $d['mon'];
	}
	
	public function cDay($Date)
	{
		$d = GetDate($Date);
		Return $d['mday'];
	}
	
	public function cHour($Date)
	{
		$d = GetDate($Date);
		Return $d['hours'];
	}
	
	public function cMinute($Date)
	{
		$d = GetDate($Date);
		Return $d['minutes'];
	}
	
	public function cSecond($Date)
	{
		$d = GetDate($Date);
		Return $d[second];
	}

}