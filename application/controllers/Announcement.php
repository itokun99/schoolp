<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class announcement extends Core_Controller
{

    function __construct()
    {
        parent::__construct();		
		
		$this->checkAuth();
        $this->load->model("UserModel");
		$this->load->model("SchoolModel");
		$this->load->model("ParentStudentModel");
		
		$this->scyear_id = $this->session->userdata("schoolp_scyear_id");
    }

    public function index()
    {
		$menu_id = "39";
		$menu_name = "Announcement";  
		
		$student_id = $this->session->userdata("schoolp_children_id");
		
		$dataDetail = $this->ParentStudentModel->getOne(array('student_id' => $student_id));
		$school_id = $dataDetail->school_id;
		
		$school = $this->SchoolModel->getOne(array('schoolid' => $school_id));
		
		$school_code = $school->school_code;
		$school_code_tb = strtolower($school_code);
		$school_dbase = $this->basedb . "school_client_$school_code_tb";
		$get_dbclient = $this->connectdb($school_dbase);
		if ($get_dbclient)
		{
			$this->load->model("client/CourcesModel");
			$this->load->model("client/CalendarModel");
			$this->load->model("client/ClassroomStudentModel");
			$this->load->model("client/ExamTypeModel");
			
			$student = $this->UserModel->getOne(array('memberid' => $student_id));
			$get_calendar = $this->db->query("
				SELECT * FROM b_calendar
				WHERE event_type = 1 AND (edulevel_id = '-1' OR edulevel_id = '$student->edulevel_id')
				ORDER BY calendar_date ASC
			");
			$calendar_dbs = $get_calendar->result();
			
		
			$calendars = array();
			foreach ($calendar_dbs as $j => $calendar_db) 
			{
				$calendar_desc = trim($calendar_db->calendar_desc);
				$calendar_desc = str_replace("\r\n", "<br>", $calendar_desc);
			
				$calendar_dt_format = "$calendar_db->calendar_date" . "T" . "$calendar_db->calendar_time";
				
				$calendars[] = array(
					'id' 	=> intval($calendar_db->calendarid), 
					'title' => trim($calendar_db->calendar_title), 
					'description' => $calendar_desc, 
					'start' => $calendar_dt_format,
				//	'end' 	=> trim($calendar_db->calendar_date),
					'oclock' => trim($calendar_db->calendar_time),
					'color' => trim($calendar_db->calendar_bg),
					);
			}
			
			$memberz = $this->UserModel->getOne(array('memberid' => $student_id));
			
			$classroom_id = -1;
			$studentclassroom = $this->ClassroomStudentModel->getOne(array('student_id' => $student_id), array('classroom_id'));		
			if (isset($studentclassroom) && is_object($studentclassroom) && $studentclassroom != false)
			$classroom_id = $studentclassroom->classroom_id;
		
			$memberz_link = "";
			if ($memberz->member_type == "4") $memberz_link = " AND edulevel_id = '$memberz->edulevel_id'";
			$get_exam = $this->db->query("
				SELECT * FROM b_exam_schedule
				WHERE (exam_type = 1 OR exam_type = 2)
				AND scyear_id = '$this->scyear_id' $memberz_link
				AND (class_stat = '0' OR (class_stat = '1' AND examid IN (SELECT exam_id FROM b_exam_class WHERE classroom_id = '$classroom_id')))
				ORDER BY exam_date ASC
			");
			$exam_dbs = $get_exam->result();
			
			foreach ($exam_dbs as $j => $exam_db) 
			{
				$cources_name = "Unknown";
				$cources = $this->CourcesModel->getOne(array('courcesid' => $exam_db->cources_id, 'cources_publish' => 1));
				if (isset($cources) && is_object($cources) && $cources != false) $cources_name = "$cources->cources_name";
				
				$calendar_desc = trim($calendar_db->calendar_desc);
				$calendar_desc = str_replace("\r\n", "<br>", $calendar_desc);
				
				$calendar_title = "Ujian - $cources_name";			
				$calendar_dt_format = "$exam_db->exam_date" . "T" . "$exam_db->exam_time";
				
				$calendars[] = array(
					'id' 	=> -intval($exam_db->examid), 
					'title' => trim($calendar_title),
					'description' => $calendar_desc, 
					'start' => $calendar_dt_format,
					'oclock' => trim($exam_db->exam_time),
					'color' => '#4213AB',
					);
			}
			
			$get_exam = $this->db->query("
				SELECT * FROM b_exam_schedule
				WHERE exam_type BETWEEN '3' AND '6' AND classroom_id = '$classroom_id'
				ORDER BY exam_date ASC
			");
			$exam_dbs = $get_exam->result();
			
			foreach ($exam_dbs as $j => $exam_db) 
			{
				$exam_type_text = "Others";
				$exam_type = $this->ExamTypeModel->getOne(array('typeid' => $exam_db->exam_type));
				if (isset($exam_type) && is_object($exam_type) && $exam_type != false) $exam_type_text = $exam_type->type_name;
				
				$cources_name = "Unknown";
				$cources = $this->CourcesModel->getOne(array('courcesid' => $exam_db->cources_id, 'cources_publish' => 1));
				if (isset($cources) && is_object($cources) && $cources != false) $cources_name = "$cources->cources_name";
				
				$calendar_desc = trim($exam_db->exam_desc);
				$calendar_desc = str_replace("\r\n", "<br>", $calendar_desc);
				
				$calendar_title = "$exam_type_text - $cources_name";			
				$calendar_dt_format = "$exam_db->exam_date" . "T" . "$exam_db->exam_time";
				
				$calendars[] = array(
					'id' 	=> -intval($exam_db->examid), 
					'title' => trim($calendar_title),
					'description' => $calendar_desc, 
					'start' => $calendar_dt_format,
				//	'end' 	=> trim($calendar_db->calendar_date),
					'oclock' => trim($exam_db->exam_time),
					'color' => '#8956FC',
					);
			}
			
			$get_holiday = $this->db->query("
				SELECT * FROM b_holiday
				WHERE holiday_publish = '1' AND (holiday_type = '1' OR holiday_type = '2')
				AND (holiday_role_stat = '-1'
				OR (holiday_role_stat = '1' AND holidayid IN (SELECT holiday_id FROM b_holiday_role WHERE edulevel_id = '$memberz->edulevel_id'))
				)
				ORDER BY datez ASC
			");
			$holidays = $get_holiday->result();
			
			$rows = array();	
			foreach ($holidays AS $i => $holiday)
			{
				$calendar_desc = "Holiday";
				
				$calendar_title = $holiday->holiday_title;
				$calendar_title = str_replace("'", "", $calendar_title);
				
				$calendar_dt_start = "$holiday->holiday_start";
				$calendar_dt_end = "$holiday->holiday_end";
			
			    $dt_end_stamp = strtotime($calendar_dt_end);
				$date_sch = $this->DateAdd($dt_end_stamp, "d", 1);
				$calendar_dt_end = $this->cDatePl($date_sch);
		
				$calendars[] = array(
					'id' 	=> 0, 
					'title' => trim($calendar_title),
					'description' => $calendar_desc, 
					'start' => $calendar_dt_start,
					'end' => $calendar_dt_end,
					'oclock' => "",
					'color' => '#C40202',
					'textColor' => '#FFFFFF',
					);
				
				$basedate_from = strtotime($holiday->holiday_start);	
				$basedate_to = strtotime($holiday->holiday_end);
			  
				$date_range = $this->DateDiff($basedate_from, $basedate_to, "d");
				
				for ($i = 0; $i <= $date_range; $i++)
				{
					$basedate = strtotime($holiday->holiday_start);	
					$date_bs = $this->DateAdd($basedate, "d", $i);
					$date_ext = $this->cDatePl($date_bs);
					
					$rows[] = $date_ext;
				}
				$notvalidday = json_encode($rows);				
			}
			
			$calendars = json_encode($calendars);
		}
		
		$get_dbmaster = $this->connectdb($this->basedb . 'school_master');
				
		//var_dump($calendars);
		
		$cnt = array(
			'menu_id' => $menu_id, 
			'menu_name' => $menu_name,
			'calendars' => $calendars,
			'notvalidday' => $notvalidday,
			'school_id' => $school_id
		);
		
		$this->load_content("admin/student/announcement", $cnt);
        
    }
	
	
	public function view_calendar($calendar_id = '', $school_id = '')
	{
		$menu_id = "-1";
        $menu_name = "View Calendar";	

		$school = $this->SchoolModel->getOne(array('schoolid' => $school_id));
		
		$school_code = $school->school_code;
		$school_code_tb = strtolower($school_code);
		$school_dbase = $this->basedb . "school_client_$school_code_tb";
		$get_dbclient = $this->connectdb($school_dbase);
		if ($get_dbclient)
		{
			$this->load->model("client/EducationLevelModel");
			$this->load->model("client/CourcesModel");
			$this->load->model("client/CalendarModel");
			$this->load->model("client/ExamScheduleModel");
			$this->load->model("client/ExamTypeModel");
			
			if ($calendar_id < 0)
			{
				$exam_id = abs($calendar_id);
				$calendar = $this->ExamScheduleModel->getOne(array('examid' => $exam_id), array('*, DATE_FORMAT(exam_date, "%d %b %Y") AS calendar_date_ok, DATE_FORMAT(exam_time, "%H:%i") AS timez'));
				
				$member = $this->UserModel->getOne(array('memberid' => $calendar->member_id));
				if ($member->member_type == 1 || $member->member_type == 2) $member_type_text = "Admin";
				else if ($member->member_type == 3 && $member->principal_stat == 0) $member_type_text = "Guru";
				else if ($member->member_type == 4) $member_type_text = "Siswa";
				else if ($member->member_type == 3 && $member->principal_stat == 1) $member_type_text = "Guru";
				else if ($member->member_type == 3 && $member->principal_stat == 2) $member_type_text = "Guru";
				else if ($member->member_type == 6) $member_type_text = "Pemilik Yayasan";
				else $member_type_text = "User";		
				
				$member_text = "$member->fullname ($member_type_text)";
				
				$calendar->created_by = $member_text;
				
				$edulevel_name = "All";
				$edulevel = $this->EducationLevelModel->getOne(array('edulevelid' => $calendar->edulevel_id));
				if (isset($edulevel) && is_object($edulevel) && $edulevel != false) $edulevel_name = "$edulevel->edulevel_name";
				
				$calendar->edulevel_name = $edulevel_name;
				
				$calendar_desc = str_replace("\r\n", "<br>", $calendar->exam_desc);
				$calendar->calendar_desc = $calendar_desc;
				
				$cources_name = "Unknown";
				$cources = $this->CourcesModel->getOne(array('courcesid' => $calendar->cources_id, 'cources_publish' => 1));
				if (isset($cources) && is_object($cources) && $cources != false) $cources_name = "$cources->cources_name";
				
				$exam_type_text = "Others";
				$exam_type = $this->ExamTypeModel->getOne(array('typeid' => $calendar->exam_type));
				if (isset($exam_type) && is_object($exam_type) && $exam_type != false) $exam_type_text = $exam_type->type_name;
				
				$calendar_title = "$exam_type_text - $cources_name";
				$calendar->calendar_title = $calendar_title;
			}
			else
			{			
				$calendar = $this->CalendarModel->getOne(array('calendarid' => $calendar_id), array('*, DATE_FORMAT(calendar_date, "%d %b %Y") AS calendar_date_ok, DATE_FORMAT(calendar_time, "%H:%i") AS timez'));
				
				$member = $this->UserModel->getOne(array('memberid' => $calendar->member_id));
				if ($member->member_type == 1 || $member->member_type == 2) $member_type_text = "Admin";
				else if ($member->member_type == 3 && $member->principal_stat == 0) $member_type_text = "Guru";
				else if ($member->member_type == 4) $member_type_text = "Siswa";
				else if ($member->member_type == 3 && $member->principal_stat == 1) $member_type_text = "Guru";
				else if ($member->member_type == 3 && $member->principal_stat == 2) $member_type_text = "Guru";
				else if ($member->member_type == 6) $member_type_text = "Pemilik Yayasan";
				else $member_type_text = "User";	
				
				$member_text = "$member->fullname ($member_type_text)";
				
				$calendar->created_by = $member_text;
				
				$edulevel_name = "All";
				$edulevel = $this->EducationLevelModel->getOne(array('edulevelid' => $calendar->edulevel_id));
				if (isset($edulevel) && is_object($edulevel) && $edulevel != false) $edulevel_name = "$edulevel->edulevel_name";
				
				$calendar->edulevel_name = $edulevel_name;
				
				$calendar_desc = str_replace("\r\n", "<br>", $calendar->calendar_desc);
				$calendar->calendar_desc = $calendar_desc;
			}
		}
		$get_dbmaster = $this->connectdb($this->basedb . 'school_master');
		
		//var_dump($calendar);
		
		$cnt = array(
			'menu_id' => $menu_id, 
			'menu_name' => $menu_name,
			'calendar' => $calendar,
			'calendar_id' => $calendar_id,
			'school_id' => $school_id
		);
		
		$this->load_page("admin/student/class_calendar_view", $cnt);
	}
	

}
