<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class alert extends Core_Controller
{

    function __construct()
    {
        parent::__construct();		
		
		$this->checkAuth();
        $this->load->model("UserModel");
		$this->load->model("AlertModel");
    }

    public function index()
    {
		$this->load->view('contents/error/error_page');
    }
	
	public function auto_alert()
    {
		$menu_id = "-1";
		$menu_name = "Alert";
		
		$datez = date('Y-m-d H:i:s');
		
		$member_id = $this->session->userdata("schoolp_member_id");
		
		$get_alert = $this->db->query("
			SELECT * FROM b_alert
			WHERE alert_status = '1' AND read_status = '0'
			AND parent_id = '$member_id'
			ORDER BY datez DESC
		");
		$alerts = $get_alert->result();
		
		foreach ($alerts as $j => $alert) 
		{
			$school_id = $alert->school_id;
		
			$school = $this->SchoolModel->getOne(array('schoolid' => $school_id));
			
			$school_code = $school->school_code;
			$school_code_tb = strtolower($school_code);
			$school_dbase = $this->basedb . "school_client_$school_code_tb";
			$get_dbclient = $this->connectdb($school_dbase);
			if ($get_dbclient)
			{
				$this->load->model("client/CourcesModel");
				$this->load->model("client/DisciplineModel");
				$this->load->model("client/DisciplineTypeModel");
				
				$discipline = $this->DisciplineModel->getOne(array('disciplineid' => $alert->discipline_id), array('*, DATE_FORMAT(discipline_date, "%d %b %Y") AS discipline_date_ok'));
				
				$alert->school_name = $school->school_name;
				$alert->discipline_date_ok = $discipline->discipline_date_ok;
				
				$cources_name = "-";
				$cources = $this->CourcesModel->getOne(array('courcesid' => $discipline->cources_id));
				if (isset($cources) && is_object($cources) && $cources != false) $cources_name = "$cources->cources_name";
				$alert->cources_name = $cources_name;
				
				$type_name = "-";
				$type_ok = $this->DisciplineTypeModel->getOne(array('typeid' => $discipline->type_id));
				if (isset($type_ok) && is_object($type_ok) && $type_ok != false) $type_name = "$type_ok->type_name";
				$alert->type_name = $type_name;
				
				$student_name = "-";
				$student = $this->UserModel->getOne(array('memberid' => $discipline->user_id));
				if (isset($student) && is_object($student) && $student != false) $student_name = "$student->fullname";
				$alert->student_name = $student_name;
				
				$discipline_desc = str_replace("\r\n", "<br>", $discipline->discipline_desc);
				$alert->discipline_desc = $discipline_desc;
				
			}
			$get_dbmaster = $this->connectdb($this->basedb . 'school_master');
						
		}
			
		$cnt = array(
			'menu_id' => $menu_id, 
			'menu_name' => $menu_name,
			'alerts' => $alerts
		);
		
		$this->load->view('contents/admin/alert/alert_view', $cnt);
    }
	
	public function details($alert_id = "")
    {
		$menu_id = "-1";
		$menu_name = "Reminder";
		
		$datez = date('Y-m-d H:i:s');
		
		$member_id = $this->session->userdata("schoolp_member_id");
		
		$alert = $this->AlertModel->getOne(array('alertid' => $alert_id));
		
		$school_id = $alert->school_id;		
		$school = $this->SchoolModel->getOne(array('schoolid' => $school_id));
		
		$discipline = null;
		$member_type_text = "-";
		
		$school_code = $school->school_code;
		$school_code_tb = strtolower($school_code);
		$school_dbase = $this->basedb . "school_client_$school_code_tb";
		$get_dbclient = $this->connectdb($school_dbase);
		if ($get_dbclient)
		{
			$this->load->model("client/CourcesModel");
			$this->load->model("client/DisciplineModel");
			$this->load->model("client/DisciplineTypeModel");
			
			$discipline = $this->DisciplineModel->getOne(array('disciplineid' => $alert->discipline_id), array('*, DATE_FORMAT(discipline_date, "%d %b %Y") AS discipline_date_ok'));
			
			$discipline->school_name = $school->school_name;
			$discipline->discipline_date_ok = $discipline->discipline_date_ok;
			
			$cources_name = "-";
			$cources = $this->CourcesModel->getOne(array('courcesid' => $discipline->cources_id));
			if (isset($cources) && is_object($cources) && $cources != false) $cources_name = "$cources->cources_name";
			$discipline->cources_name = $cources_name;
			
			$type_name = "-";
			$type_ok = $this->DisciplineTypeModel->getOne(array('typeid' => $discipline->type_id));
			if (isset($type_ok) && is_object($type_ok) && $type_ok != false) $type_name = "$type_ok->type_name";
			$discipline->type_name = $type_name;
			
			$student_name = "-";
			$student = $this->UserModel->getOne(array('memberid' => $discipline->user_id));
			if (isset($student) && is_object($student) && $student != false) $student_name = "$student->fullname";
			$discipline->student_name = $student_name;
			
			$teacher_name = "-";
			$teacher = $this->UserModel->getOne(array('memberid' => $discipline->member_id));
			if (isset($teacher) && is_object($teacher) && $teacher != false) $teacher_name = "$teacher->fullname";
			$discipline->teacher_name = $teacher_name;
			
			$discipline_desc = str_replace("\r\n", "<br>", $discipline->discipline_desc);
			$discipline->discipline_desc = $discipline_desc;
		}
		$get_dbmaster = $this->connectdb($this->basedb . 'school_master');	
		
		$query_db = array(
			'read_status' => 1,
			'read_date' => $datez
		);
		$upd_into_db = $this->AlertModel->save($query_db, array('alertid' => $alert_id));
		
		$cnt = array(
			'menu_id' => $menu_id, 
			'menu_name' => $menu_name,
			'discipline' => $discipline
		);
		
		$this->load->view('contents/admin/alert/alert_detail', $cnt);
    }
	

}
