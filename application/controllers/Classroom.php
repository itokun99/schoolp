<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class classroom extends Core_Controller
{

    function __construct()
    {
        parent::__construct();
		
		$this->checkAuth();
        $this->load->model("UserModel");
		$this->load->model("SchoolModel");
		$this->load->model("ParentStudentModel");
		$this->load->model("MessageModel");
		
		$this->scyear_id = $this->session->userdata("schoolp_scyear_id");
    }

    public function index()
    {
		$this->load->view('contents/error/error_page');
    }	
	
	public function class_schedule()
    {
		$menu_id = "31";
		$menu_name = "Classroom Schedule";
		
		$day_now = date('d');
		$month_now = date('m');
		$year_now = date('Y');
		
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
			$this->load->model("client/DayModel");
			$this->load->model("client/ColourModel");
			$this->load->model("client/InfoModel");
			$this->load->model("client/CourcesTypeModel");
			$this->load->model("client/CourcesModel");
			$this->load->model("client/EducationLevelModel");
			$this->load->model("client/ClassroomModel");
			$this->load->model("client/ClassroomScheduleModel");
			$this->load->model("client/ClassroomScheduleTimeModel");
			
			$get_class = $this->db->query("
				SELECT classroomid FROM b_classroom, b_classroom_student
				WHERE b_classroom.classroomid = b_classroom_student.classroom_id
				AND b_classroom.classroom_publish = '1'
				AND b_classroom_student.student_id = '$student_id'
			");
			
			$classroom_id = 0;			
			if ($get_class->num_rows() <> 0)
			{
				$class_ok = $get_class->result();
				foreach ($class_ok AS $class_ok)
				$classroom_id = $class_ok->classroomid;
			}
			
			$days = $this->DayModel->getByCriteria(array('day_status' => 1), null, 0, 0, null, array('dayid', 'ASC'));
			foreach ($days as $j => $day)
			{
				$get_schedule_time = $this->db->query("
					SELECT schedule_time, teacher_id, cources_id, DATE_FORMAT(schedule_time, '%H:%i') AS timez_ok
					FROM b_classroom_schedule, b_classroom_schedule_time
					WHERE b_classroom_schedule.cscheduleid = b_classroom_schedule_time.cschedule_id
					AND b_classroom_schedule.classroom_id = '$classroom_id'
					AND b_classroom_schedule.day_id = '$day->dayid'
					ORDER BY schedule_time ASC
				");
				$schedule_class = $get_schedule_time->result();
			
				foreach ($schedule_class as $k => $classroomday)
				{					
					$teacher_name = "";
					$cources_name = "";
					$cources_colour = "#ffffff";
					$lesson_hour = 60;
					
					$teacher_id = $classroomday->teacher_id;
					$cources_id = $classroomday->cources_id;
					
					$teacher = $this->UserModel->getOne(array('memberid' => $teacher_id, 'publish' => 1));
					$cources = $this->CourcesModel->getOne(array('courcesid' => $cources_id, 'cources_publish' => 1));
					
					if (isset($teacher) && is_object($teacher) && $teacher != false)
						$teacher_name = "$teacher->fullname";
					else
						$teacher_name = "Unknown";
						
					if (isset($cources) && is_object($cources) && $cources != false)
					{
						$cources_name = "$cources->cources_name";							
						$colour = $this->ColourModel->getOne(array('colourid' => $cources->colour_id));
						if (isset($colour) && is_object($colour) && $colour != false) $cources_colour = "$colour->colour_code";
						
						$courcestype = $this->CourcesTypeModel->getOne(array('typeid' => $cources->cources_type));
						if (isset($courcestype) && is_object($courcestype) && $courcestype != false) $lesson_hour = "$courcestype->duration";
					}
					else
						$cources_name = "Unknown";
						
					$classroomday->teacher_name = $teacher_name;
					$classroomday->cources_name = $cources_name;
					$classroomday->cources_colour = $cources_colour;
					
					$schedule_time_start = $classroomday->schedule_time;
					
					$start_stamp = strtotime($schedule_time_start);
					$schedule_time_finish = $this->DateAdd($start_stamp, "M", $lesson_hour);
					$schedule_time_finish = $this->cTimePL($schedule_time_finish);
					//echo "$schedule_time_start - $lesson_hour - $schedule_time_finish<br>";
					
					$classroomday->lesson_duration = $lesson_hour;
					$classroomday->timez_finish = $schedule_time_finish;
				}
						
				$day->schedule_class = $schedule_class;
				
			}
					
			$get_schedule_time = $this->db->query("SELECT DISTINCT schedule_time, DATE_FORMAT(schedule_time, '%H:%i') AS timez_ok FROM b_classroom_schedule_time WHERE classroom_id = '$classroom_id' ORDER BY schedule_time ASC");
			$db_schedule_times = $get_schedule_time->result();
					
			foreach ($db_schedule_times as $k => $db_schedule_time)
			{
				$lesson_hour = 60;
			
				$get_lesson = $this->db->query("
					SELECT b_cources_type.duration
					FROM b_classroom_schedule_time, b_cources, b_cources_type
					WHERE b_classroom_schedule_time.cources_id = b_cources.courcesid
					AND b_cources_type.typeid = b_cources.cources_type
					AND b_classroom_schedule_time.classroom_id = '$classroom_id'
					AND b_classroom_schedule_time.schedule_time = '$db_schedule_time->schedule_time'
					ORDER BY b_cources_type.duration DESC LIMIT 0, 1
				");
				if ($get_lesson->num_rows() <> 0)
				{
					$db_lesson = $get_lesson->result();
					foreach ($db_lesson AS $db_lesson) $lesson_hour = $db_lesson->duration;
				}
				
				$schedule_time_start = $db_schedule_time->schedule_time;
				
				$start_stamp = strtotime($schedule_time_start);
				$schedule_time_finish = $this->DateAdd($start_stamp, "M", $lesson_hour);
				$schedule_time_finish = $this->cTimePL($schedule_time_finish);
				//echo "$schedule_time_start - $lesson_hour - $schedule_time_finish<br>";
				
				$db_schedule_time->lesson_duration = $lesson_hour;
				$db_schedule_time->timez_finish = $schedule_time_finish;
			
				foreach ($days as $j => $day)
				{
					$db_schedule_time->days[$day->dayid] = new stdClass();
					$db_schedule_time->days[$day->dayid]->day_name = "$day->day_name";
					$db_schedule_time->days[$day->dayid]->day_id = "$day->dayid";
					
					$time_status = 0;
					$teacher_id = 0;
					$cources_id = 0;
					$teacher_name = "";
					$cources_name = "";
					$cources_colour = "#ffffff";
					$cources_religion_id = 0;
					
					$classroomday = $this->ClassroomScheduleModel->getOne(array('classroom_id' => $classroom_id, 'day_id' => $day->dayid));
					
					if (isset($classroomday) && is_object($classroomday) && $classroomday != false)
					{
						$classDetail = $this->ClassroomScheduleTimeModel->getOne(array('cschedule_id' => $classroomday->cscheduleid, 'schedule_time' => $db_schedule_time->schedule_time));
						if (isset($classDetail) && is_object($classDetail) && $classDetail != false)
						{
							$time_status = 1;
							$teacher_id = $classDetail->teacher_id;
							$cources_id = $classDetail->cources_id;
							
							$teacher = $this->UserModel->getOne(array('memberid' => $teacher_id, 'publish' => 1));
							$cources = $this->CourcesModel->getOne(array('courcesid' => $cources_id, 'cources_publish' => 1));
							
							if (isset($teacher) && is_object($teacher) && $teacher != false)
								$teacher_name = "$teacher->fullname";
							else
								$teacher_name = "";
								
							if (isset($cources) && is_object($cources) && $cources != false)
							{
								$cources_name = "$cources->cources_name";							
								$colour = $this->ColourModel->getOne(array('colourid' => $cources->colour_id));
								if (isset($colour) && is_object($colour) && $colour != false) $cources_colour = "$colour->colour_code";
								
								$cources_religion = $cources->religion_type;
							
								$cek_religion = $this->db->query("
									SELECT b_cources_religion.courcesreligionid FROM b_cources_religion, b_cources_religion_class
									WHERE cources_id = '$cources_id'
									AND day_id = '$day->dayid' AND schedule_time = '$db_schedule_time->schedule_time'
									AND classroom_id = '$classroom_id'
									ANd scyear_id = '$this->scyear_id'
								");
								
								if ($cek_religion->num_rows() <> 0)
								{
									$religion_ok = $cek_religion->result();
									foreach ($religion_ok AS $religion_ok) $cources_religion_id = $religion_ok->courcesreligionid;
								}
							}
							else
								$cources_name = "Unknown";
						}
					}
					
					//echo "$db_schedule_time->timez_ok - $day->day_name - $time_status - $teacher_id - $cources_id<br>";
	
					$db_schedule_time->days[$day->dayid]->time_status = "$time_status";
					$db_schedule_time->days[$day->dayid]->teacher_id = "$teacher_id";
					$db_schedule_time->days[$day->dayid]->cources_id = "$cources_id";
					$db_schedule_time->days[$day->dayid]->teacher_name = "$teacher_name";
					$db_schedule_time->days[$day->dayid]->cources_name = "$cources_name";
					$db_schedule_time->days[$day->dayid]->cources_colour = "$cources_colour";
					$db_schedule_time->days[$day->dayid]->cources_religion = "$cources_religion";
					$db_schedule_time->days[$day->dayid]->cources_religion_id = "$cources_religion_id";
	
				}
				
			}
			
			$classroom = $this->ClassroomModel->getOne(array('classroomid' => $classroom_id));
			
			$teacher_name = "-";
			$edulevel_name = "";			
			
			if (isset($classroom) && is_object($classroom) && $classroom != false)
			{
				$scyear_name = $this->session->userdata("schoolp_scyear_name");
				
				$teacher = $this->UserModel->getOne(array('memberid' => $classroom->teacher_id));
				if (isset($teacher) && is_object($teacher) && $teacher != false)		
				{
					$teacher_name = "$teacher->fullname ($teacher->member_code)";
				}
				$classroom->teacher_name = $teacher_name;				
				
				$edulevel = $this->EducationLevelModel->getOne(array('edulevelid' => $classroom->edulevel_id));
				if (isset($edulevel) && is_object($edulevel) && $edulevel != false) $edulevel_name = "$edulevel->edulevel_name";
				$classroom->edulevel_name = $edulevel_name;
								
				$school_info = $this->InfoModel->getOne(array('info_status' => 1));
				if (isset($school_info) && is_object($school_info) && $school_info != false) 
				{					
					$date_att_stamp = "$year_now-$month_now-$day_now";
					$date_att_stamp = strtotime($date_att_stamp);
					
					$get_semester = $this->db->query("
						SELECT semester_name FROM b_school_semester, b_school_edulevel
						WHERE b_school_edulevel.zedulevelid = b_school_semester.zedulevel_id
						AND b_school_edulevel.edulevel_id = '$classroom->edulevel_id'
						AND UNIX_TIMESTAMP(start_date) <= '$date_att_stamp' AND UNIX_TIMESTAMP(end_date) >= '$date_att_stamp'
					");
					
					if ($get_semester->num_rows() <> 0)
					{
						$semester = $get_semester->result();
						foreach ($semester AS $semester) $semester_name = $semester->semester_name;
						$scyear_name = "$scyear_name Semester $semester_name";
					}
				}
				$classroom->scyear_name = $scyear_name;	
			}
			
		}
		
		$get_dbmaster = $this->connectdb($this->basedb . 'school_master');	
		
		
		$cnt = array(
			'menu_id' => $menu_id, 
			'menu_name' => $menu_name,
			'days' => $days,
			'db_schedule_times' => $db_schedule_times,
			'student_id' => $student_id,
			'classroom' => $classroom,
			'classroom_id' => $classroom_id,
			'school' => $school,
			'school_id' => $school_id
		);
		
		$this->load_content("admin/student/classroom_schedule", $cnt);
    }
	
	public function class_calendar($classroom_id = '', $school_id = '')
    {
		$menu_id = "32";
		$menu_name = "Classroom Calendar";
		
		$day_now = date('d');
		$month_now = date('m');
		$year_now = date('Y');
		
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
			$this->load->model("client/CalendarModel");
			$this->load->model("client/CourcesModel");
			$this->load->model("client/CourcesModel");
			$this->load->model("client/InfoModel");
			$this->load->model("client/EducationLevelModel");
			$this->load->model("client/ClassroomModel");
			$this->load->model("client/ExamTypeModel");
			
			$get_class = $this->db->query("
				SELECT classroomid FROM b_classroom, b_classroom_student
				WHERE b_classroom.classroomid = b_classroom_student.classroom_id
				AND b_classroom.classroom_publish = '1'
				AND b_classroom_student.student_id = '$student_id'
			");
			
			$classroom_id = 0;			
			if ($get_class->num_rows() <> 0)
			{
				$class_ok = $get_class->result();
				foreach ($class_ok AS $class_ok)
				$classroom_id = $class_ok->classroomid;
			}
			
			$memberz = $this->UserModel->getOne(array('memberid' => $student_id));
			
			$get_calendar = $this->db->query("
				SELECT * FROM b_calendar
				WHERE (event_type = 1 AND (edulevel_id = '-1' OR edulevel_id = '$memberz->edulevel_id'))
				 OR (event_type = 2 AND 
					((classroom_id = '$classroom_id' AND classroom_id <> '-2') OR (classroom_id = '-2' AND courcesreligion_id IN (SELECT DISTINCT courcesreligion_id FROM b_cources_religion_class WHERE classroom_id = '$classroom_id')))
				 )
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
				
				$calendar_desc = trim($exam_db->exam_desc);
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
			
			$classroom = $this->ClassroomModel->getOne(array('classroomid' => $classroom_id));
			
			$teacher_name = "-";
			$edulevel_name = "";
			
			if (isset($classroom) && is_object($classroom) && $classroom != false)
			{
				$scyear_name = $this->session->userdata("schoolp_scyear_name");
				
				$teacher = $this->UserModel->getOne(array('memberid' => $classroom->teacher_id));
				if (isset($teacher) && is_object($teacher) && $teacher != false)		
				{
					$teacher_name = "$teacher->fullname ($teacher->member_code)";
				}
				$classroom->teacher_name = $teacher_name;
				
				$edulevel = $this->EducationLevelModel->getOne(array('edulevelid' => $classroom->edulevel_id));
				if (isset($edulevel) && is_object($edulevel) && $edulevel != false) $edulevel_name = "$edulevel->edulevel_name";
				$classroom->edulevel_name = $edulevel_name;				
				
				$school_info = $this->InfoModel->getOne(array('info_status' => 1));
				if (isset($school_info) && is_object($school_info) && $school_info != false) 
				{					
					$date_att_stamp = "$year_now-$month_now-$day_now";
					$date_att_stamp = strtotime($date_att_stamp);
					
					$get_semester = $this->db->query("
						SELECT semester_name FROM b_school_semester, b_school_edulevel
						WHERE b_school_edulevel.zedulevelid = b_school_semester.zedulevel_id
						AND b_school_edulevel.edulevel_id = '$classroom->edulevel_id'
						AND UNIX_TIMESTAMP(start_date) <= '$date_att_stamp' AND UNIX_TIMESTAMP(end_date) >= '$date_att_stamp'
					");
					
					if ($get_semester->num_rows() <> 0)
					{
						$semester = $get_semester->result();
						foreach ($semester AS $semester) $semester_name = $semester->semester_name;
						$scyear_name = "$scyear_name Semester $semester_name";
					}
				}
				$classroom->scyear_name = $scyear_name;	
			}
			
		}
		
		$get_dbmaster = $this->connectdb($this->basedb . 'school_master');	
		
		
		//var_dump($calendars);
		
		$cnt = array(
			'menu_id' => $menu_id, 
			'menu_name' => $menu_name,
			'calendars' => $calendars,
			'classroom' => $classroom,
			'classroom_id' => $classroom_id,
			'school_id' => $school_id
		);
		
		$this->load_content("admin/student/classroom_calendar", $cnt);
    }
	
	public function view_calendar($calendar_id = '', $classroom_id = '', $school_id = '')
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
			$this->load->model("client/CalendarModel");
			
			$calendar = $this->CalendarModel->getOne(array('calendarid' => $calendar_id), array('*, DATE_FORMAT(calendar_date, "%d %b %Y") AS calendar_date_ok, DATE_FORMAT(calendar_time, "%H:%i") AS timez'));
			
			$member = $this->UserModel->getOne(array('memberid' => $calendar->member_id));
			if ($calendar->calendar_type == 1) $member_text = "Admin - $member->fullname";
			else $member_text = "Teacher - $member->fullname ($member->member_code)";
			
			$calendar->created_by = $member_text;
			
			$calendar_desc = str_replace("\r\n", "<br>", $calendar->calendar_desc);
			$calendar->calendar_desc = $calendar_desc;
		}
		$get_dbmaster = $this->connectdb($this->basedb . 'school_master');
		
		//var_dump($calendar);
		
		$cnt = array(
			'menu_id' => $menu_id, 
			'menu_name' => $menu_name,
			'calendar' => $calendar,
			'calendar_id' => $calendar_id,
			'classroom_id' => $classroom_id
		);
		
		$this->load_page("admin/student/class_calendar_view", $cnt);
	}
	
	public function send_message($teacher_id = '', $student_id = '', $cources_id = '', $classroom_id = '', $school_id = '')
    {
		$menu_id = "7";
        $menu_name = "Classroom Send Message";	
		
		$school = $this->SchoolModel->getOne(array('schoolid' => $school_id));
		
		$school_code = $school->school_code;
		$school_code_tb = strtolower($school_code);
		$school_dbase = $this->basedb . "school_client_$school_code_tb";
		$get_dbclient = $this->connectdb($school_dbase);
		if ($get_dbclient)
		{
			$this->load->model("client/ClassroomModel");
			$this->load->model("client/CourcesModel");
			
			$classroom = $this->ClassroomModel->getOne(array('classroomid' => $classroom_id));
			$cources = $this->CourcesModel->getByCriteria(array('cources_publish' => 1), null, 0, 0, null, array('cources_name', 'ASC'));
			$cources = $this->CourcesModel->getOne(array('courcesid' => $cources_id));
			$teacher = $this->UserModel->getOne(array('memberid' => $teacher_id));
		}
		$get_dbmaster = $this->connectdb($this->basedb . 'school_master');
		
		$cnt = array(
			'menu_id' => $menu_id, 
			'menu_name' => $menu_name,
			'school_id' => $school_id,
			'classroom_id' => $classroom_id,
			'teacher_id' => $teacher_id,
			'cources_id' => $cources_id,
			'student_id' => $student_id,
			'teacher' => $teacher,
			'classroom' => $classroom,
			'cources' => $cources
		);

		$this->load_page("admin/student/class_message_add", $cnt);
    }
	
	public function insert_messagedb()
    {
		$menu_id = "7";
        $menu_name = "Classroom Send Message";
		$datez = date('Y-m-d H:i:s');
					
		$classroom_id = $this->input->post('classroom_id');
		$teacher_id  = $this->input->post('teacher_id');
		$cources_id  = $this->input->post('cources_id');
		$student_id  = $this->input->post('student_id');
		$school_id  = $this->input->post('school_id');
		$message_cont  = $this->input->post('message_cont');
		
		$member_id = $this->session->userdata("schoolp_member_id");
		
		$member = $this->UserModel->getOne(array('memberid' => $member_id));
		
		$member_text = "Parent - $member->fullname ($member->member_code)";
		
		$query_db = array(
			'user_id_from' => $member_id,
			'user_id_to' => $teacher_id,
			'classroom_id' => $classroom_id,
			'cources_id' => $cources_id,
			'message_cont' => $message_cont,
			'message_date' => $datez,
			'message_status' => 0,
			'message_type' => 1,
			'parent_status' => 1,			
			'teacher_id' => $teacher_id,
			'school_id' => $school_id,
			'datez' => $datez,
			'member_id' => $member_id
		);
		$ins_message_into_db = $this->MessageModel->save($query_db);
		
		$school = $this->SchoolModel->getOne(array('schoolid' => $school_id));
		
		$school_code = $school->school_code;
		$school_code_tb = strtolower($school_code);
		$school_dbase = $this->basedb . "school_client_$school_code_tb";
		$get_dbclient = $this->connectdb($school_dbase);
		if ($get_dbclient)
		{
			$this->load->model("client/ClassroomModel");
			$this->load->model("client/CourcesModel");
			
			$classroom = $this->ClassroomModel->getOne(array('classroomid' => $classroom_id));
			$teacher = $this->UserModel->getOne(array('memberid' => $teacher_id));
			$cources = $this->CourcesModel->getOne(array('courcesid' => $cources_id));
			$student = $this->UserModel->getOne(array('memberid' => $student_id));
			
			$send_to_text = "Teacher - $teacher->fullname ($teacher->member_code)";
			
			$query_db = array(
				'user_id_from' => $student_id,
				'user_id_to' => $teacher_id,
				'classroom_id' => $classroom_id,
				'cources_id' => $cources_id,
				'message_cont' => $message_cont,
				'message_date' => $datez,
				'message_status' => 0,
				'message_type' => 1,
				'parent_status' => '1',
				'read_message_id' => $ins_message_into_db,
				'datez' => $datez,
				'member_id' => $member_id
			);
			$ins_message_into_db = $this->MessageModel->save($query_db);
		}
		$get_dbmaster = $this->connectdb($this->basedb . 'school_master');
				
		
				
		$menu_title = "CLASSROOM MESSAGE";
		$menu_desc =  "School: $school->school_name <br> Student: $student->fullname ($student->member_code) <br> Classroom: $classroom->classroom_name <br> From: $member_text <br> To: $send_to_text <br> Cources: $cources->cources_name";
		$menu_detail = "School: $school->school_name <br> Student: $student->fullname ($student->member_code) <br> Classroom: $classroom->classroom_name <br> From: $member_text <br> To: $send_to_text <br> Cources: $cources->cources_name <br> Message: $message_cont";
		$menu_action = "SEND";
		$this->activitydb($menu_title, $menu_desc, $menu_detail, $menu_action);		
		
		//$class_menu_active = "2";
		//$this->session->set_userdata("class_menu_active", $class_menu_active);
		
		$message_alert = "Message has been Sent.";
		$this->session->set_userdata("message_alert", $message_alert);
		
		redirect('classroom/class_schedule');
    }
	
	
	public function class_attendance()
    {
		$menu_id = "33";
		$menu_name = "Classroom Attendance";

		$day_now = date('d');
		$month_now = date('m');
		$year_now = date('Y');
		
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
			$this->load->model("client/InfoModel");
			$this->load->model("client/ClassroomModel");
			$this->load->model("client/EducationLevelModel");
			$this->load->model("client/AttendanceModel");
			
			$get_class = $this->db->query("
				SELECT classroomid FROM b_classroom, b_classroom_student
				WHERE b_classroom.classroomid = b_classroom_student.classroom_id
				AND b_classroom.classroom_publish = '1'
				AND b_classroom_student.student_id = '$student_id'
			");
			
			$classroom_id = 0;			
			if ($get_class->num_rows() <> 0)
			{
				$class_ok = $get_class->result();
				foreach ($class_ok AS $class_ok)
				$classroom_id = $class_ok->classroomid;
			}
			
			$classroom = $this->ClassroomModel->getOne(array('classroomid' => $classroom_id));
		
			$teacher_name = "-";
			$edulevel_name = "";
			
			if (isset($classroom) && is_object($classroom) && $classroom != false)
			{
				$scyear_name = $this->session->userdata("schoolp_scyear_name");
				
				$teacher = $this->UserModel->getOne(array('memberid' => $classroom->teacher_id));
				if (isset($teacher) && is_object($teacher) && $teacher != false)		
				{
					$teacher_name = "$teacher->fullname ($teacher->member_code)";
				}
				$classroom->teacher_name = $teacher_name;
								
				$edulevel = $this->EducationLevelModel->getOne(array('edulevelid' => $classroom->edulevel_id));
				if (isset($edulevel) && is_object($edulevel) && $edulevel != false) $edulevel_name = "$edulevel->edulevel_name";
				$classroom->edulevel_name = $edulevel_name;
								
				$school_info = $this->InfoModel->getOne(array('info_status' => 1));
				if (isset($school_info) && is_object($school_info) && $school_info != false) 
				{
					$date_att_stamp = "$year_now-$month_now-$day_now";
					$date_att_stamp = strtotime($date_att_stamp);
					
					$get_semester = $this->db->query("
						SELECT semester_name FROM b_school_semester, b_school_edulevel
						WHERE b_school_edulevel.zedulevelid = b_school_semester.zedulevel_id
						AND b_school_edulevel.edulevel_id = '$classroom->edulevel_id'
						AND UNIX_TIMESTAMP(start_date) <= '$date_att_stamp' AND UNIX_TIMESTAMP(end_date) >= '$date_att_stamp'
					");
					
					if ($get_semester->num_rows() <> 0)
					{
						$semester = $get_semester->result();
						foreach ($semester AS $semester) $semester_name = $semester->semester_name;
						$scyear_name = "$scyear_name Semester $semester_name";
					}
				}
				$classroom->scyear_name = $scyear_name;	
			}
			
			$day_id = date('w');
			$month_now = date('m');
			$year_now = date('Y');
			
			$month_ok = $this->input->post("month_ok", true);
			$year_ok = $this->input->post("year_ok", true);
			if (!isset($month_ok)) $month_ok = $month_now;
			if (!isset($year_ok)) $year_ok = $year_now;
			
			$total_day = cal_days_in_month(CAL_GREGORIAN, $month_ok, $year_ok);
			
			
			$get_schedule_time = $this->db->query("SELECT DISTINCT schedule_time, DATE_FORMAT(schedule_time, '%H:%i') AS timez_ok FROM b_classroom_schedule_time WHERE classroom_id = '$classroom_id' ORDER BY schedule_time ASC");
			$dataDetails = $get_schedule_time->result();
			
			foreach ($dataDetails as $k => $dataDetail)
			{
				$schedule_time_start = $dataDetail->schedule_time;
				$lesson_hour = $this->session->userdata("lesson_hour");
				if ($lesson_hour == 0) $lesson_hour = 60;
				
				$start_stamp = strtotime($schedule_time_start);
				$schedule_time_finish = $this->DateAdd($start_stamp, "M", $lesson_hour);
				$schedule_time_finish = $this->cTimePL($schedule_time_finish);
				//echo "$schedule_time_start - $lesson_hour - $schedule_time_finish<br>";
				
				$dataDetail->timez_finish = $schedule_time_finish;						
				
				$total_attendance = 0;
				$total_leave_sick = 0;
				for ($k = 1; $k <= $total_day; $k++)
				{
					$dataDetail->days[$k] = new stdClass();
					$dataDetail->days[$k]->day_id = "$k";
				
					$absent_status = "0";
					$cek_attendance = $this->db->query("
						SELECT attendance_status FROM b_attendance
						WHERE schedule_time = '$dataDetail->schedule_time'
						AND classroom_id = '$classroom_id' AND student_id = '$student_id'
						AND attendance_type = '1'
						AND day(attendance_date) = '$k' AND month(attendance_date) = '$month_ok' AND year(attendance_date) = '$year_ok'
					");
					
					if ($cek_attendance->num_rows() <> 0)
					{
						$attendance_ok = $cek_attendance->result();
						foreach ($attendance_ok as $attendance_ok) $absent_status = $attendance_ok->attendance_status;
						
						if ($absent_status == "1") $total_attendance = $total_attendance + 1;
					}
					
					if ($absent_status <> "1")
					{
						$date_att_stamp = "$year_ok-$month_ok-$k";
						$date_att_stamp = strtotime($date_att_stamp);
						
						$cek_leavesick = $this->db->query("
							SELECT leavesickid FROM b_leave_sick
							WHERE student_id = '$student_id'
							AND UNIX_TIMESTAMP(date_from) <= '$date_att_stamp' AND UNIX_TIMESTAMP(date_to) >= '$date_att_stamp'
						");
						
						if ($cek_leavesick->num_rows() <> 0)
						{
							$total_leave_sick = $total_leave_sick + 1;
							$absent_status = -1;
						}	
					}
					
					$date_attend = "$year_now-$month_now-$k";
					$date_attend = strtotime($date_attend);
					$day_id = date('w', $date_attend);
					if ($day_id == 0 || $day_id == 6) $day_type = 2;
					else $day_type = 1;
										
					$dataDetail->days[$k]->day_type = "$day_type";
					$dataDetail->days[$k]->absent_status = "$absent_status";
	
					//echo "$dataDetail->schedule_time - $k - $day_type - $student->fullname - $absent_status <br>";	
				}
				
				$dataDetail->total_attendance = $total_attendance;
				$dataDetail->total_leave_sick = $total_leave_sick;
			}
			
			$classroom = $this->ClassroomModel->getOne(array('classroomid' => $classroom_id));
			
			$teacher_name = "-";
			$edulevel_name = "";
			
			if (isset($classroom) && is_object($classroom) && $classroom != false)
			{
				$scyear_name = $this->session->userdata("schoolp_scyear_name");
				
				$teacher = $this->UserModel->getOne(array('memberid' => $classroom->teacher_id));
				if (isset($teacher) && is_object($teacher) && $teacher != false)		
				{
					$teacher_name = "$teacher->fullname ($teacher->member_code)";
				}
				$classroom->teacher_name = $teacher_name;
								
				$edulevel = $this->EducationLevelModel->getOne(array('edulevelid' => $classroom->edulevel_id));
				if (isset($edulevel) && is_object($edulevel) && $edulevel != false) $edulevel_name = "$edulevel->edulevel_name";
				$classroom->edulevel_name = $edulevel_name;
							
				$school_info = $this->InfoModel->getOne(array('info_status' => 1));
				if (isset($school_info) && is_object($school_info) && $school_info != false) 
				{
					$date_att_stamp = "$year_now-$month_now-$day_now";
					$date_att_stamp = strtotime($date_att_stamp);
					
					$get_semester = $this->db->query("
						SELECT semester_name FROM b_school_semester, b_school_edulevel
						WHERE b_school_edulevel.zedulevelid = b_school_semester.zedulevel_id
						AND b_school_edulevel.edulevel_id = '$classroom->edulevel_id'
						AND UNIX_TIMESTAMP(start_date) <= '$date_att_stamp' AND UNIX_TIMESTAMP(end_date) >= '$date_att_stamp'
					");
					
					if ($get_semester->num_rows() <> 0)
					{
						$semester = $get_semester->result();
						foreach ($semester AS $semester) $semester_name = $semester->semester_name;
						$scyear_name = "$scyear_name Semester $semester_name";
					}
				}
				$classroom->scyear_name = $scyear_name;	
			}
			
		}
		
		
		$get_dbmaster = $this->connectdb($this->basedb . 'school_master');	
		
		//echo "<pre>";
		//var_dump($dataDetail);
		
		$cnt = array(
			'menu_id' => $menu_id, 
			'menu_name' => $menu_name,
			'dataDetails' => $dataDetails,
			'classroom' => $classroom,
			'classroom_id' => $classroom_id,
			'total_day' => $total_day,
			'month_ok' => $month_ok,
			'year_ok' => $year_ok,
			'student_id' => $student_id,
			'school_id' => $school_id
		);
		
		$this->load_content("admin/student/classroom_attendance", $cnt);
    }
	
	public function class_daily_exam()
    {
		$menu_id = "35";
		$menu_name = "Classroom Daily Exam";
		
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
			$this->load->model("client/ClassroomModel");
			$this->load->model("client/CourcesModel");
			$this->load->model("client/EducationLevelModel");
			$this->load->model("client/ExamTypeModel");
			$this->load->model("client/ExamScheduleModel");
			$this->load->model("client/ExamScoreModel");
			$this->load->model("client/ExamFileModel");
			
			$get_class = $this->db->query("
				SELECT classroomid FROM b_classroom, b_classroom_student
				WHERE b_classroom.classroomid = b_classroom_student.classroom_id
				AND b_classroom.classroom_publish = '1'
				AND b_classroom_student.student_id = '$student_id'
			");
			
			$classroom_id = 0;			
			if ($get_class->num_rows() <> 0)
			{
				$class_ok = $get_class->result();
				foreach ($class_ok AS $class_ok)
				$classroom_id = $class_ok->classroomid;
			}
			
			$classroom = $this->ClassroomModel->getOne(array('classroomid' => $classroom_id));
			
			$dailyexams = null;
			if (isset($classroom) && is_object($classroom) && $classroom != false)
			{
				$get_exam = $this->db->query("
					SELECT *, DATE_FORMAT(exam_date, '%d %b %Y') AS exam_date_ok
					FROM b_exam_schedule
					WHERE exam_status = '1'
					AND (classroom_id = '$classroom_id'
					OR courcesreligion_id IN (SELECT DISTINCT courcesreligion_id FROM b_cources_religion_class WHERE classroom_id = '$classroom_id'))
					AND exam_type < 7
					ORDER BY exam_date ASC
				");
				$dailyexams = $get_exam->result();
								
				foreach ($dailyexams as $j => $dailyexam)
				{
					$cources_name = "-";
					$cources = $this->CourcesModel->getOne(array('courcesid' => $dailyexam->cources_id));
					if (isset($dailyexam) && is_object($dailyexam) && $dailyexam != false) $cources_name = "$cources->cources_name";
					$dailyexam->cources_name = $cources_name;
					
					$exam_desc = str_replace("\r\n", "<br>", $dailyexam->exam_desc);
					$dailyexam->exam_desc = $exam_desc;
					
					$teacher_name = "-";
					$teacher = $this->UserModel->getOne(array('memberid' => $dailyexam->member_id));
					if (isset($teacher) && is_object($teacher) && $teacher != false) $teacher_name = "$teacher->fullname";
					$dailyexam->teacher_name = $teacher_name;
					
					$score_value = "-";
					$query_cek = array(
						'classroom_id' => $classroom_id,
						'exam_id' => $dailyexam->examid,
						'student_id' => $student_id
					);			
					$scores = $this->ExamScoreModel->getOne($query_cek);
					if (isset($scores) && is_object($scores) && $scores != false) $score_value = $scores->score_value;
					
					$dailyexam->score_value = $score_value;
					
					$exam_type_text = "Others";
					$exam_type = $this->ExamTypeModel->getOne(array('typeid' => $dailyexam->exam_type));
					if (isset($exam_type) && is_object($exam_type) && $exam_type != false) $exam_type_text = $exam_type->type_name;
									
					$dailyexam->exam_type_name = $exam_type_text;
					
					$examfiles = $this->ExamFileModel->getByCriteria(array('exam_id' => $dailyexam->examid, 'student_id' => $student_id, 'classroom_id' => $classroom_id), null, 0, 0, null, array('datez', 'DESC'));
					$total_exam_file = count($examfiles);
					
					$dailyexam->total_exam_file = $total_exam_file;
				}
						
				$teacher_name = "-";
				$teacher = $this->UserModel->getOne(array('memberid' => $classroom->teacher_id));
				if (isset($teacher) && is_object($teacher) && $teacher != false)		
				{
					$teacher_name = "$teacher->fullname ($teacher->member_code)";
				}
				$classroom->teacher_name = $teacher_name;
				
				$edulevel_name = "";
				$edulevel = $this->EducationLevelModel->getOne(array('edulevelid' => $classroom->edulevel_id));
				if (isset($edulevel) && is_object($edulevel) && $edulevel != false) $edulevel_name = "$edulevel->edulevel_name";
				$classroom->edulevel_name = $edulevel_name;
			}
		}
		
		$get_dbmaster = $this->connectdb($this->basedb . 'school_master');	
				
		$cnt = array(
			'menu_id' => $menu_id, 
			'menu_name' => $menu_name,
			'dailyexams' => $dailyexams,
			'student_id' => $student_id,
			'classroom' => $classroom,
			'classroom_id' => $classroom_id,
			'school' => $school,
			'school_id' => $school_id
		);
		
		$this->load_content("admin/student/class_exam_daily", $cnt);
    }

	public function class_exam_schedule()
    {
		$menu_id = "36";
		$menu_name = "Exam Schedule";
		
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
			$this->load->model("client/ClassroomModel");
			$this->load->model("client/CourcesModel");
			$this->load->model("client/EducationLevelModel");
			$this->load->model("client/ExamScheduleModel");
			$this->load->model("client/ExamScoreModel");
			$this->load->model("client/ExamFileModel");
			
			$get_class = $this->db->query("
				SELECT classroomid FROM b_classroom, b_classroom_student
				WHERE b_classroom.classroomid = b_classroom_student.classroom_id
				AND b_classroom.classroom_publish = '1'
				AND b_classroom_student.student_id = '$student_id'
			");
			
			$classroom_id = 0;			
			if ($get_class->num_rows() <> 0)
			{
				$class_ok = $get_class->result();
				foreach ($class_ok AS $class_ok)
				$classroom_id = $class_ok->classroomid;
			}
			
			$student_id_ok = $student_id;				
			$classroom = $this->ClassroomModel->getOne(array('classroomid' => $classroom_id));
			
			$exams = null;
			if (isset($classroom) && is_object($classroom) && $classroom != false)
			{
				$get_exam = $this->db->query("
					SELECT *, DATE_FORMAT(exam_date, '%d %b %Y') AS exam_date_ok, DATE_FORMAT(exam_time, '%h:%i %p') AS exam_time_ok
					FROM b_exam_schedule
					WHERE (exam_type = '1' OR exam_type = '2') AND exam_status = '1'
					AND scyear_id = '$this->scyear_id'
					AND edulevel_id = '$classroom->edulevel_id'					
					AND (class_stat = '0' OR (class_stat = '1' AND examid IN (SELECT exam_id FROM b_exam_class WHERE classroom_id = '$classroom_id')))
					ORDER BY exam_date ASC, exam_time ASC
				");
				
				$exams = $get_exam->result();
				
				foreach ($exams as $j => $exam)
				{
					$cources_name = "-";
					$cources = $this->CourcesModel->getOne(array('courcesid' => $exam->cources_id));
					if (isset($exam) && is_object($exam) && $exam != false) $cources_name = "$cources->cources_name";
					$exam->cources_name = $cources_name;
					
					$edulevel_name = "-";
					$edulevel = $this->EducationLevelModel->getOne(array('edulevelid' => $exam->edulevel_id));
					if (isset($exam) && is_object($exam) && $exam != false) $edulevel_name = "$edulevel->edulevel_name";
					$exam->edulevel_name = $edulevel_name;
					
					$exam_desc = str_replace("\r\n", "<br>", $exam->exam_desc);
					$exam->exam_desc = $exam_desc;
					
					$score_value = "-";
					$query_cek = array(
						'classroom_id' => $classroom_id,
						'exam_id' => $exam->examid,
						'student_id' => $student_id
					);			
					$scores = $this->ExamScoreModel->getOne($query_cek);
					if (isset($scores) && is_object($scores) && $scores != false) $score_value = $scores->score_value;
					
					$exam->score_value = $score_value;
					
					$examfiles = $this->ExamFileModel->getByCriteria(array('exam_id' => $exam->examid, 'student_id' => $student_id, 'classroom_id' => $classroom_id), null, 0, 0, null, array('datez', 'DESC'));
					$total_exam_file = count($examfiles);
					
					$exam->total_exam_file = $total_exam_file;
					
					$type_name = "-";
					if ($exam->type_id == 1) $type_name = "MID";
					else if ($exam->type_id == 2) $type_name = "FINAL";
					else if ($exam->type_id == 3) $type_name = "UN";
					$exam->type_name = $type_name;	
				}
			}

		}
		
		$get_dbmaster = $this->connectdb($this->basedb . 'school_master');	
				
		$cnt = array(
			'menu_id' => $menu_id, 
			'menu_name' => $menu_name,
			'exams' => $exams,
			'student_id' => $student_id,
			'classroom' => $classroom,
			'classroom_id' => $classroom_id,
			'school' => $school,
			'school_id' => $school_id
		);
		
		$this->load_content("admin/student/class_exam_schedule", $cnt);
    }
	
	
	public function class_rapor_score()
    {
		$menu_id = "37";
		$menu_name = "Rapor Score";
		
		$day_now = date('d');
		$month_now = date('m');
		$year_now = date('Y');
		
		$student_id = $this->session->userdata("schoolp_children_id");
		
		if ($this->input->post('semester_id')) $semester_id = $this->input->post('semester_id');
		
		$dataDetail = $this->ParentStudentModel->getOne(array('student_id' => $student_id));
		$school_id = $dataDetail->school_id;
		
		$school = $this->SchoolModel->getOne(array('schoolid' => $school_id));
		
		$school_code = $school->school_code;
		$school_code_tb = strtolower($school_code);
		$school_dbase = $this->basedb . "school_client_$school_code_tb";
		$get_dbclient = $this->connectdb($school_dbase);
		if ($get_dbclient)
		{
			$this->load->model("client/SettingModel");
			$this->load->model("client/SchoolSemesterModel");
			$this->load->model("client/ClassroomModel");
			$this->load->model("client/CourcesModel");
			$this->load->model("client/CourcesPercentageModel");
			$this->load->model("client/EducationLevelModel");
			$this->load->model("client/ExamTypeModel");
			$this->load->model("client/ExamScheduleModel");
			$this->load->model("client/ExamScoreModel");
			$this->load->model("client/ExamScoreModel");
			
			$get_class = $this->db->query("
				SELECT classroomid FROM b_classroom, b_classroom_student
				WHERE b_classroom.classroomid = b_classroom_student.classroom_id
				AND b_classroom.classroom_publish = '1'
				AND b_classroom_student.student_id = '$student_id'
			");
			
			$classroom_id = 0;			
			if ($get_class->num_rows() <> 0)
			{
				$class_ok = $get_class->result();
				foreach ($class_ok AS $class_ok)
				$classroom_id = $class_ok->classroomid;
			}
			
			$classroom = $this->ClassroomModel->getOne(array('classroomid' => $classroom_id));
			
			if (!isset($semester_id))
			{
				$semester_id = -1;
				$date_att_stamp = "$year_now-$month_now-$day_now";
				$date_att_stamp = strtotime($date_att_stamp);
				
				$cek_semester = $this->db->query("
					SELECT semesterid FROM b_school_semester, b_school_edulevel
					WHERE b_school_edulevel.zedulevelid = b_school_semester.zedulevel_id
					AND b_school_edulevel.edulevel_id = '$classroom->edulevel_id'
					AND UNIX_TIMESTAMP(start_date) <= '$date_att_stamp' AND UNIX_TIMESTAMP(end_date) >= '$date_att_stamp'
				");
				
				if ($cek_semester->num_rows() <> 0)
				{
					$semester = $cek_semester->result();
					foreach ($semester AS $semester) $semester_id = $semester->semesterid;
				}			
			}
			
			$semester_link = "";
			if ($semester_id <> -1)
			{
				$semester = $this->SchoolSemesterModel->getOne(array('semesterid' => $semester_id));
				$semester_link = "AND b_exam_schedule.exam_date BETWEEN '$semester->start_date' AND '$semester->end_date'";
			}
		
			$get_promote = $this->db->query("
				SELECT * FROM b_student_promote
				WHERE student_id = '$student_id'
				AND classroom_id = '$classroom_id'
				AND semester_id = '$semester_id'
				AND scyear_id = '$this->scyear_id'
				ORDER BY promoteid ASC LIMIT 0, 1
			");
			
			$promote_status = "0";
			$promote_text = "-";
			$description_text = "";
			$promote_ranking = "";
			if ($get_promote->num_rows() <> 0)
			{
				$promote_ok = $get_promote->result();
				foreach ($promote_ok AS $promote_ok)
				
				if ($promote_ok->promote_status == 1) $promote_text = "Naik Kelas";
				else if ($promote_ok->promote_status == 2) $promote_text = "Tinggal Kelas";
				else if ($promote_ok->promote_status == -1) $promote_text = "Ok";
				
				$description_text = $promote_ok->promote_desc;
				
				$promote_status = $promote_ok->promote_status;
				$promote_ranking = $promote_ok->ranking;
			}
			$classroom->promote_text = $promote_text;
			$classroom->description_text = $description_text;
			$classroom->promote_status = $promote_status;
			$classroom->promote_ranking = $promote_ranking;

			$setting = $this->SettingModel->getOne();
			
			if (isset($setting) && $setting != "false")
			{
				$score_percent_exam = $setting->score_percent_exam;
				$score_percent_un = $setting->score_percent_un;
				$score_percent_daily = $setting->score_percent_daily;
				$score_percent_exercise = $setting->score_percent_exercise;
				$score_percent_pratikum = $setting->score_percent_pratikum;
				$score_percent_extra = $setting->score_percent_extra;
				$score_percent_kerajinan = $setting->score_percent_kerajinan;
				$score_percent_sikap = $setting->score_percent_sikap;
			}
			else
			{
				$score_percent_exam = 0;
				$score_percent_un = 0;
				$score_percent_daily = 0;
				$score_percent_exercises = 0;
				$score_percent_pratikum = 0;
				$score_percent_extra = 0;
				$score_percent_kerajinan = 0;
				$score_percent_sikap = 0;
			}
			
			$get_student = $this->db->query("
				SELECT b_member.* FROM b_member, b_classroom_student
				WHERE b_classroom_student.student_id=b_member.memberid
				AND b_member.publish = '1'
				AND b_classroom_student.classroom_id = '$classroom_id'
				ORDER BY b_member.fullname ASC
			");
			$students = $get_student->result();
			
			$teacher_link = "";
			
			$get_cources_exam = $this->db->query("
				SELECT * FROM b_cources
				WHERE cources_publish = '1'
				AND courcesid IN (SELECT DISTINCT cources_id FROM b_classroom_schedule_time WHERE classroom_id = '$classroom_id' $teacher_link)
				ORDER BY cources_name ASC
			");
			$dataDetails = $get_cources_exam->result();
			
			$get_exam_type = $this->db->query("SELECT DISTINCT exam_type FROM b_exam_schedule ORDER BY exam_type DESC");
			$type_exams = $get_exam_type->result();
			foreach ($type_exams as $j => $type_exam)
			{
				$exam_type_name = "Others";
				$exam_type = $this->ExamTypeModel->getOne(array('typeid' => $type_exam->exam_type));
				if (isset($exam_type) && is_object($exam_type) && $exam_type != false) $exam_type_name = $exam_type->type_name;
								
				$type_exam->type_name = $exam_type_name;
			}
					
			foreach ($dataDetails as $i => $dataDetail)
			{
				$score_final = 0;
				$class_final = 0;
				$scoring_percent = 0;
				
				foreach ($type_exams as $j => $type_exam)
				{
					$dataDetail->type_exam[$type_exam->exam_type] = new stdClass();
					$dataDetail->type_exam[$type_exam->exam_type]->type_id = "$type_exam->exam_type";
					$dataDetail->type_exam[$type_exam->exam_type]->type_name = "$type_exam->type_name";
					
					$total_score = 0;
					$total_exam = 0;
					$score_exam_average = 0;
					
					$get_score = $this->db->query("
						SELECT b_exam_score.score_value
						FROM b_exam_schedule, b_exam_score
						WHERE b_exam_score.exam_id = b_exam_schedule.examid
						AND b_exam_schedule.exam_type = '$type_exam->exam_type'
						AND b_exam_score.cources_id = '$dataDetail->courcesid'
						AND b_exam_score.student_id = '$student_id' $semester_link
					");
					
					if ($get_score->num_rows() <> 0)
					{
						$scores = $get_score->result();
						foreach ($scores as $score)
						{
							$total_score = $total_score + $score->score_value;
							$total_exam = $total_exam + 1;
						}
						
						$score_exam_average = $total_score / $total_exam;
						$score_exam_average = round($score_exam_average, 2);
					}
					
					$score_percent = 0;
				
					$cek_percent_db = $this->CourcesPercentageModel->getOne(array('cources_id' => $dataDetail->courcesid, 'edulevel_id' => $classroom->edulevel_id));					
					if (isset($cek_percent_db) && is_object($cek_percent_db) && $cek_percent_db != false)
					{
						if ($type_exam->exam_type == 1)
						{
							$score_percent = $cek_percent_db->percent_exam;
						}
						else if ($type_exam->exam_type == 2)
						{
							$score_percent = $cek_percent_db->percent_un;
						}
						else if ($type_exam->exam_type == 3)
						{
							$score_percent = $cek_percent_db->percent_daily;
						}
						else if ($type_exam->exam_type == 4)
						{
							$score_percent = $cek_percent_db->percent_exercise;
						}
						else if ($type_exam->exam_type == 5)
						{
							$score_percent = $cek_percent_db->percent_pratikum;
						}
						else if ($type_exam->exam_type == 6)
						{
							$score_percent = $cek_percent_db->percent_extra;
						}
						else if ($type_exam->exam_type == 7)
						{
							$score_percent = $cek_percent_db->percent_kerajinan;
						}
						else if ($type_exam->exam_type == 8)
						{
							$score_percent = $cek_percent_db->percent_sikap;
						}
					}
					
					$score_percent_bobot = $score_exam_average * $score_percent / 100;
					$score_percent_bobot = round($score_percent_bobot, 2);
					$score_final = $score_final + $score_percent_bobot;
									
					//echo "$dataDetail->cources_name - $type_exam->exam_type - $total_score - $score_exam_average - $score_percent - $score_percent_bobot<br>";
					
					$dataDetail->type_exam[$type_exam->exam_type]->score_exam = $score_exam_average;
					
					$score_status = 1;
					if ($score_percent <> 0 && $get_score->num_rows() == 0)	$score_status = 2;
					else $scoring_percent = $scoring_percent + $score_percent;
					
					$dataDetail->type_exam[$type_exam->exam_type]->score_status = $score_status;
					
					// AVERAGE STUDENT SCORE FINAL
					$score_class_final = 0;				
					foreach ($students as $k => $student)
					{
						$total_class_score = 0;
						$total_class_exam = 0;
						$score_class_exam_average = 0;
						
						$get_class_score = $this->db->query("
							SELECT b_exam_score.score_value
							FROM b_exam_schedule, b_exam_score
							WHERE b_exam_score.exam_id = b_exam_schedule.examid
							AND b_exam_schedule.exam_type = '$type_exam->exam_type'
							AND b_exam_score.cources_id = '$dataDetail->courcesid'
							AND b_exam_score.student_id = '$student->memberid' $semester_link
						");
						
						if ($get_class_score->num_rows() <> 0)
						{
							$class_scores = $get_class_score->result();
							foreach ($class_scores as $class_score)
							{
								$total_class_score = $total_class_score + $class_score->score_value;
								$total_class_exam = $total_class_exam + 1;
							}
							
							$score_class_exam_average = $total_class_score / $total_class_exam;
							$score_class_exam_average = round($score_class_exam_average, 2);
						}
										
						$score_class_percent_bobot = $score_class_exam_average * $score_percent / 100;
						$score_class_percent_bobot = round($score_class_percent_bobot, 2);
						$score_class_final = $score_class_final + $score_class_percent_bobot;
						
						
					}
					$class_final = $class_final + $score_class_final;
					
				}
				
				$dataDetail->final_score = $score_final;
				$dataDetail->scoring_percent = $scoring_percent;
				
				$class_average_score = $class_final / count($students);
				$class_average_score = round($class_average_score, 2);
				$dataDetail->class_average_score = $class_average_score;
				//echo "$score_final <br><br>";
			}
			
			$get_semester = $this->db->query("
				SELECT b_school_semester.* FROM b_school_semester, b_school_edulevel
				WHERE b_school_edulevel.zedulevelid = b_school_semester.zedulevel_id
				AND b_school_edulevel.edulevel_id = '$classroom->edulevel_id'
				AND b_school_edulevel.scyear_id = '$this->scyear_id'
			");
			$semesters = $get_semester->result();
		}
		
		$get_dbmaster = $this->connectdb($this->basedb . 'school_master');	
				
		$cnt = array(
			'menu_id' => $menu_id, 
			'menu_name' => $menu_name,
			'dataDetails' => $dataDetails,
		    'type_exams' => $type_exams,
			'student_id' => $student_id,
			'semester_id' => $semester_id,
			'semesters' => $semesters,
			'classroom' => $classroom,
			'classroom_id' => $classroom_id,
			'school' => $school,
			'school_id' => $school_id
		);
		
		$this->load_content("admin/student/class_rapor_score", $cnt);
    }
	
	public function attach_file($exam_id = '', $student_id = '', $classroom_id = '')
    {
		$menu_id = "-1";
		$menu_name = "Attach File";  
		
		$dataDetail = $this->ParentStudentModel->getOne(array('student_id' => $student_id));
		$school_id = $dataDetail->school_id;
		
		$school = $this->SchoolModel->getOne(array('schoolid' => $school_id));
		
		$school_code = $school->school_code;
		$school_code_tb = strtolower($school_code);
		$school_dbase = $this->basedb . "school_client_$school_code_tb";
		$get_dbclient = $this->connectdb($school_dbase);
		if ($get_dbclient)
		{
			$this->load->model("client/ExamScheduleModel");
			$this->load->model("client/ClassroomModel");
			$this->load->model("client/CourcesModel");
			$this->load->model("client/ExamFileModel");
			
			$exam = $this->ExamScheduleModel->getOne(array('examid' => $exam_id), array('*, DATE_FORMAT(exam_date, "%d %b %Y") AS exam_date_ok'));
			$cources = $this->CourcesModel->getOne(array('courcesid' => $exam->cources_id));
			$classroom = $this->ClassroomModel->getOne(array('classroomid' => $classroom_id));
			
			$student = $this->UserModel->getOne(array('memberid' => $student_id));
			
			$dataDetails = $this->ExamFileModel->getByCriteria(array('exam_id' => $exam_id, 'student_id' => $student_id), null, 0, 0, null, array('datez', 'DESC'));		
		}
		
		$get_dbmaster = $this->connectdb($this->basedb . 'school_master');

		$cnt = array(
		  'menu_id' => $menu_id, 
		  'menu_name' => $menu_name,
		  'exam' => $exam,
		  'cources' => $cources,
		  'student' => $student,
		  'student_id' => $student_id,
		  'classroom' => $classroom,
		  'classroom_id' => $classroom_id,
		  'dataDetails' => $dataDetails,
		  'exam_id' => $exam_id
		);
		
		$this->load_page("admin/student/score_attach_file", $cnt);
    }
	
	
	public function print_rapor($semester_id = "")
    {
		$menu_id = "-1";
		$menu_name = "Print Rapor";
		
		$day_now = date('d');
		$month_now = date('m');
		$year_now = date('Y');
		
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
			$this->load->model("client/SettingModel");
			$this->load->model("client/SchoolSemesterModel");
			$this->load->model("client/ClassroomModel");
			$this->load->model("client/CourcesModel");
			$this->load->model("client/CourcesPercentageModel");
			$this->load->model("client/EducationLevelModel");
			$this->load->model("client/ExamTypeModel");
			$this->load->model("client/ExamScheduleModel");
			$this->load->model("client/ExamScoreModel");
			$this->load->model("client/ExamScoreModel");
			
			$get_class = $this->db->query("
				SELECT classroomid FROM b_classroom, b_classroom_student
				WHERE b_classroom.classroomid = b_classroom_student.classroom_id
				AND b_classroom.classroom_publish = '1'
				AND b_classroom_student.student_id = '$student_id'
			");
			
			$classroom_id = 0;			
			if ($get_class->num_rows() <> 0)
			{
				$class_ok = $get_class->result();
				foreach ($class_ok AS $class_ok)
				$classroom_id = $class_ok->classroomid;
			}
			
			$student = $this->UserModel->getOne(array('memberid' => $student_id));
			$classroom = $this->ClassroomModel->getOne(array('classroomid' => $classroom_id));
			
			$semester = $this->SchoolSemesterModel->getOne(array('semesterid' => $semester_id));
			$semester_link = "AND b_exam_schedule.exam_date BETWEEN '$semester->start_date' AND '$semester->end_date'";
			
			$scyear_name = $this->session->userdata("schoolp_scyear_name");
			$classroom->scyear_name = $scyear_name;
			
			$edulevel = $this->EducationLevelModel->getOne(array('edulevelid' => $classroom->edulevel_id));
			if (isset($edulevel) && is_object($edulevel) && $edulevel != false) $edulevel_name = "$edulevel->edulevel_name";
			$classroom->edulevel_name = $edulevel_name;
		
			$get_promote = $this->db->query("
				SELECT * FROM b_student_promote
				WHERE student_id = '$student_id'
				AND classroom_id = '$classroom_id'
				AND semester_id = '$semester_id'
				AND scyear_id = '$this->scyear_id'
				ORDER BY promoteid ASC LIMIT 0, 1
			");
			
			$promote_status = "0";
			$promote_text = "-";
			$description_text = "";
			$promote_ranking = "";
			if ($get_promote->num_rows() <> 0)
			{
				$promote_ok = $get_promote->result();
				foreach ($promote_ok AS $promote_ok)
				
				if ($promote_ok->promote_status == 1) $promote_text = "Naik Kelas";
				else if ($promote_ok->promote_status == 2) $promote_text = "Tinggal Kelas";
				else if ($promote_ok->promote_status == -1) $promote_text = "Ok";
				
				$description_text = $promote_ok->promote_desc;
				
				$promote_status = $promote_ok->promote_status;
				$promote_ranking = $promote_ok->ranking;
			}
			$classroom->promote_text = $promote_text;
			$classroom->description_text = $description_text;
			$classroom->promote_status = $promote_status;
			$classroom->promote_ranking = $promote_ranking;
			
			$get_student = $this->db->query("
				SELECT b_member.* FROM b_member, b_classroom_student
				WHERE b_classroom_student.student_id=b_member.memberid
				AND b_member.publish = '1'
				AND b_classroom_student.classroom_id = '$classroom_id'
				ORDER BY b_member.fullname ASC
			");
			$students = $get_student->result();
			
			$teacher_link = "";
			
			$get_cources_exam = $this->db->query("
				SELECT * FROM b_cources
				WHERE cources_publish = '1'
				AND courcesid IN (SELECT DISTINCT cources_id FROM b_classroom_schedule_time WHERE classroom_id = '$classroom_id' $teacher_link)
				ORDER BY cources_name ASC
			");
			$dataDetails = $get_cources_exam->result();
			
			$get_exam_type = $this->db->query("SELECT DISTINCT exam_type FROM b_exam_schedule ORDER BY exam_type DESC");
			$type_exams = $get_exam_type->result();
			foreach ($type_exams as $j => $type_exam)
			{
				$exam_type_name = "Others";
				$exam_type = $this->ExamTypeModel->getOne(array('typeid' => $type_exam->exam_type));
				if (isset($exam_type) && is_object($exam_type) && $exam_type != false) $exam_type_name = $exam_type->type_name;
								
				$type_exam->type_name = $exam_type_name;
			}
					
			foreach ($dataDetails as $i => $dataDetail)
			{
				$score_final = 0;
				$class_final = 0;
				$scoring_percent = 0;
				
				foreach ($type_exams as $j => $type_exam)
				{
					$dataDetail->type_exam[$type_exam->exam_type] = new stdClass();
					$dataDetail->type_exam[$type_exam->exam_type]->type_id = "$type_exam->exam_type";
					$dataDetail->type_exam[$type_exam->exam_type]->type_name = "$type_exam->type_name";
					
					$total_score = 0;
					$total_exam = 0;
					$score_exam_average = 0;
					
					$get_score = $this->db->query("
						SELECT b_exam_score.score_value
						FROM b_exam_schedule, b_exam_score
						WHERE b_exam_score.exam_id = b_exam_schedule.examid
						AND b_exam_schedule.exam_type = '$type_exam->exam_type'
						AND b_exam_score.cources_id = '$dataDetail->courcesid'
						AND b_exam_score.student_id = '$student_id' $semester_link
					");
					
					if ($get_score->num_rows() <> 0)
					{
						$scores = $get_score->result();
						foreach ($scores as $score)
						{
							$total_score = $total_score + $score->score_value;
							$total_exam = $total_exam + 1;
						}
						
						$score_exam_average = $total_score / $total_exam;
						$score_exam_average = round($score_exam_average, 2);
					}
					
					$total_score_avg = 0;
					$total_exam_avg = 0;
					$score_exam_average_class = 0;
					
					$get_score_avg = $this->db->query("
						SELECT b_exam_score.score_value
						FROM b_exam_schedule, b_exam_score
						WHERE b_exam_score.exam_id = b_exam_schedule.examid
						AND b_exam_schedule.exam_type = '$type_exam->exam_type'
						AND b_exam_score.classroom_id = '$classroom_id'
						AND b_exam_score.cources_id = '$dataDetail->courcesid' $semester_link
					");
					
					if ($get_score_avg->num_rows() <> 0)
					{
						$score_avgs = $get_score_avg->result();
						foreach ($score_avgs as $score_avg)
						{
							$total_score_avg = $total_score_avg + $score_avg->score_value;
							$total_exam_avg = $total_exam_avg + 1;
						}
						
						$score_exam_average_class = $total_score_avg / $total_exam_avg;
						$score_exam_average_class = round($score_exam_average_class, 2);
					}
					
					$score_percent = 0;
				
					$cek_percent_db = $this->CourcesPercentageModel->getOne(array('cources_id' => $dataDetail->courcesid, 'edulevel_id' => $classroom->edulevel_id));					
					if (isset($cek_percent_db) && is_object($cek_percent_db) && $cek_percent_db != false)
					{
						if ($type_exam->exam_type == 1)
						{
							$score_percent = $cek_percent_db->percent_exam;
						}
						else if ($type_exam->exam_type == 2)
						{
							$score_percent = $cek_percent_db->percent_un;
						}
						else if ($type_exam->exam_type == 3)
						{
							$score_percent = $cek_percent_db->percent_daily;
						}
						else if ($type_exam->exam_type == 4)
						{
							$score_percent = $cek_percent_db->percent_exercise;
						}
						else if ($type_exam->exam_type == 5)
						{
							$score_percent = $cek_percent_db->percent_pratikum;
						}
						else if ($type_exam->exam_type == 6)
						{
							$score_percent = $cek_percent_db->percent_extra;
						}
						else if ($type_exam->exam_type == 7)
						{
							$score_percent = $cek_percent_db->percent_kerajinan;
						}
						else if ($type_exam->exam_type == 8)
						{
							$score_percent = $cek_percent_db->percent_sikap;
						}
					}
					
					$score_percent_bobot = $score_exam_average * $score_percent / 100;
					$score_percent_bobot = round($score_percent_bobot, 2);
					$score_final = $score_final + $score_percent_bobot;
									
					//echo "$dataDetail->cources_name - $type_exam->exam_type - $total_score - $score_exam_average - $score_percent - $score_percent_bobot<br>";
					
					$dataDetail->type_exam[$type_exam->exam_type]->score_exam = $score_exam_average;
					$dataDetail->type_exam[$type_exam->exam_type]->score_avg = $score_exam_average_class;
					
					$score_status = 1;
					if ($score_percent <> 0 && $get_score->num_rows() == 0)	$score_status = 2;
					else $scoring_percent = $scoring_percent + $score_percent;
					
					$dataDetail->type_exam[$type_exam->exam_type]->score_status = $score_status;
					
					// AVERAGE STUDENT SCORE FINAL
					$score_class_final = 0;				
					foreach ($students as $k => $student_ok)
					{
						$total_class_score = 0;
						$total_class_exam = 0;
						$score_class_exam_average = 0;
						
						$get_class_score = $this->db->query("
							SELECT b_exam_score.score_value
							FROM b_exam_schedule, b_exam_score
							WHERE b_exam_score.exam_id = b_exam_schedule.examid
							AND b_exam_schedule.exam_type = '$type_exam->exam_type'
							AND b_exam_score.cources_id = '$dataDetail->courcesid'
							AND b_exam_score.student_id = '$student_ok->memberid' $semester_link
						");
						
						if ($get_class_score->num_rows() <> 0)
						{
							$class_scores = $get_class_score->result();
							foreach ($class_scores as $class_score)
							{
								$total_class_score = $total_class_score + $class_score->score_value;
								$total_class_exam = $total_class_exam + 1;
							}
							
							$score_class_exam_average = $total_class_score / $total_class_exam;
							$score_class_exam_average = round($score_class_exam_average, 2);
						}
										
						$score_class_percent_bobot = $score_class_exam_average * $score_percent / 100;
						$score_class_percent_bobot = round($score_class_percent_bobot, 2);
						$score_class_final = $score_class_final + $score_class_percent_bobot;
						
						
					}
					$class_final = $class_final + $score_class_final;
					
				}
				
				$dataDetail->final_score = $score_final;
				$dataDetail->scoring_percent = $scoring_percent;
				
				$class_average_score = $class_final / count($students);
				$class_average_score = round($class_average_score, 2);
				$dataDetail->class_average_score = $class_average_score;
				//echo "$score_final <br><br>";
			}
			
		}
		
		$get_dbmaster = $this->connectdb($this->basedb . 'school_master');	
				
		$cnt = array(
		  'menu_id' => $menu_id, 
		  'menu_name' => $menu_name,
		  'student' => $student,
		  'semester' => $semester,
		  'dataDetails' => $dataDetails,
		  'type_exams' => $type_exams,
		  'school_name' => $school->school_name,		  
		  'classroom' => $classroom
		);
		
		//load the view and saved it into $html variable
		$html = $this->load->view("contents/admin/student/class_rapor_pdf", $cnt, true);
 
        //this the the PDF filename that user will get to download
        $pdfFilePath = "Nilai Rapor.pdf";
 
        //load mPDF library
        $this->load->library('m_pdf');
		
		$mpdf = new mPDF('c', 'A4-P');
		$mpdf->WriteHTML($html);
		$mpdf->Output($pdfFilePath, "D");	
    }
	
	
	public function cources_religion($cources_religion_id = "", $classroom_id = "")
    {
		$menu_id = "-1";
		$menu_name = "Cources Religion";  
		
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
			$this->load->model("client/DayModel");
			$this->load->model("client/CourcesReligionModel");
			
			$dataDetail = $this->CourcesReligionModel->getOne(array('courcesreligionid' => $cources_religion_id), array('*, DATE_FORMAT(schedule_time, "%H:%i") AS timez_ok'));
		
			$get_religion = $this->db->query("
				SELECT b_cources_religion.*, b_religion.religion_name FROM b_cources_religion, b_religion, b_cources_religion_class
				WHERE b_cources_religion.religion_id = b_religion.religionid
				AND b_cources_religion_class.courcesreligion_id = b_cources_religion.courcesreligionid
				AND b_cources_religion_class.classroom_id = '$classroom_id'
				AND cources_id = '$dataDetail->cources_id'
				AND day_id = '$dataDetail->day_id' AND schedule_time = '$dataDetail->schedule_time'
				AND scyear_id = '$this->scyear_id'
				ORDER BY religion_name ASC
			");			
			$religions = $get_religion->result();
			
			foreach ($religions AS $k => $religion)
			{
				$teacher_name = "-";
				$teacher = $this->UserModel->getOne(array('memberid' => $religion->teacher_id));
				if (isset($teacher) && is_object($teacher) && $teacher != false) $teacher_name = $teacher->fullname;
				
				$religion->teacher_name = $teacher_name;
				
				$get_classroom = $this->db->query("
					SELECT b_cources_religion_class.*, b_classroom.classroom_name FROM b_cources_religion_class, b_classroom
					WHERE b_cources_religion_class.classroom_id = b_classroom.classroomid
					AND courcesreligion_id = '$religion->courcesreligionid'
					ORDER BY b_classroom.classroom_name ASC
				");			
				$classrooms = $get_classroom->result();
				
				$classroom_text = "";
				foreach ($classrooms AS $m => $classroom)
				{
					$classroom_text = "$classroom_text $classroom->classroom_name <br>";
				}
				
				$religion->classroom_text = $classroom_text;
			}
			
			$day_ok = $this->DayModel->getOne(array('dayid' => $dataDetail->day_id));
		}
		
		$get_dbmaster = $this->connectdb($this->basedb . 'school_master');	
		
		$cnt = array(
			'menu_id' => $menu_id, 
			'menu_name' => $menu_name,
			'ClassReligions' => $religions,
			'courcesReligion' => $dataDetail,
			'day_ok' => $day_ok
		);
		
		$this->load_page_cont("admin/student/religion_cources", $cnt);
    }

}
