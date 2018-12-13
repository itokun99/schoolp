<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class reminder extends Core_Controller
{

    function __construct()
    {
        parent::__construct();		
		
		$this->checkAuth();
        $this->load->model("UserModel");
		$this->load->model("ReminderModel");
		$this->load->model("ReminderReadModel");
    }

    public function index()
    {
		$this->load->view('contents/error/error_page');
    }
	
	public function auto_reminder()
    {
		$menu_id = "-1";
		$menu_name = "Reminder";
		
		$datez = date('Y-m-d H:i:s');
		
		$member_id = $this->session->userdata("schoolp_member_id");
		
		$get_reminder = $this->db->query("
			SELECT * FROM b_reminder
			WHERE edulevel_id <> '-2'
			AND reminder_start <= '$datez' AND reminder_end >= '$datez'
			AND reminderid NOT IN (SELECT reminder_id FROM b_reminder_read WHERE read_status = '1' AND member_id = '$member_id')
			ORDER BY b_reminder.reminder_end DESC
		");
		$reminders = $get_reminder->result();
		
		foreach ($reminders as $j => $reminder) 
		{
			$school_id = $reminder->school_id;
		
			$school = $this->SchoolModel->getOne(array('schoolid' => $school_id));
			
			$school_code = $school->school_code;
			$school_code_tb = strtolower($school_code);
			$school_dbase = $this->basedb . "school_client_$school_code_tb";
			$get_dbclient = $this->connectdb($school_dbase);
			if ($get_dbclient)
			{
				$this->load->model("client/ClassroomModel");
				$this->load->model("client/CalendarModel");
				
				$calendar = $this->CalendarModel->getOne(array('calendarid' => $reminder->calendar_id), array('*, DATE_FORMAT(calendar_date, "%d %b %Y") AS calendar_date_ok, DATE_FORMAT(calendar_time, "%H:%i") AS timez'));
				
				$reminder->school_name = $school->school_name;
				$reminder->calendar_title = $calendar->calendar_title;
				$reminder->calendar_date_ok = $calendar->calendar_date_ok;
				$reminder->calendar_time_ok = $calendar->timez;
				
				if ($reminder->reminder_type == 2)
				{
					$classroom = $this->ClassroomModel->getOne(array('classroomid' => $reminder->classroom_id));
					$type_text = "Kelas <br> ($classroom->classroom_name)";	
				}			
				else $type_text = "Sekolah";
			}
			$get_dbmaster = $this->connectdb($this->basedb . 'school_master');
						
			$reminder->type_text = $type_text;
		}
			
		$cnt = array(
			'menu_id' => $menu_id, 
			'menu_name' => $menu_name,
			'reminders' => $reminders
		);
		
		$this->load->view('contents/admin/reminder/reminder_view', $cnt);
    }
	
	public function details($reminder_id = "")
    {
		$menu_id = "-1";
		$menu_name = "Reminder";
		
		$datez = date('Y-m-d H:i:s');
		
		$member_id = $this->session->userdata("schoolp_member_id");
		
		$reminder = $this->ReminderModel->getOne(array('reminderid' => $reminder_id));
		
		$school_id = $reminder->school_id;		
		$school = $this->SchoolModel->getOne(array('schoolid' => $school_id));
		
		$calendar = null;
		$member_type_text = "-";
		
		$school_code = $school->school_code;
		$school_code_tb = strtolower($school_code);
		$school_dbase = $this->basedb . "school_client_$school_code_tb";
		$get_dbclient = $this->connectdb($school_dbase);
		if ($get_dbclient)
		{
			$this->load->model("client/ClassroomModel");
			$this->load->model("client/CalendarModel");
			
			$calendar = $this->CalendarModel->getOne(array('calendarid' => $reminder->calendar_id), array('*, DATE_FORMAT(calendar_date, "%d %b %Y") AS calendar_date_ok, DATE_FORMAT(calendar_time, "%H:%i") AS timez'));
			
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
			$calendar->school_name = $school->school_name;
			
			if ($reminder->reminder_type == 2)
			{
				$classroom = $this->ClassroomModel->getOne(array('classroomid' => $reminder->classroom_id));
				$type_text = "Kelas ($classroom->classroom_name)";	
			}			
			else $type_text = "Sekolah";
			
			$calendar->type_text = $type_text;
		}
		$get_dbmaster = $this->connectdb($this->basedb . 'school_master');	
		
		$query_db = array(
			'reminder_id' => $reminder_id,
			'read_status' => 1,
			'member_id' => $member_id,
			'datez' => $datez
		);
		$upd_into_db = $this->ReminderReadModel->save($query_db);
		
		$cnt = array(
			'menu_id' => $menu_id, 
			'menu_name' => $menu_name,
			'calendar' => $calendar
		);
		
		$this->load->view('contents/admin/reminder/reminder_detail', $cnt);
    }
	

}
