<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class notification extends Core_Controller
{

    function __construct()
    {
        parent::__construct();		
		
		$this->checkAuth();
        $this->load->model("UserModel");
		$this->load->model("SchoolModel");
		$this->load->model("MessageModel");
		$this->load->model("PaymentNotificationModel");
    }

    public function index()
    {
		$this->load->view('contents/error/error_page');
    }
	
	public function message()
    {
		$menu_id = "-1";
		$menu_name = "Message - Notification";
		
		$member_id = $this->session->userdata("schoolp_member_id");
		$get_message = $this->db->query("
			SELECT b_message.*, DATE_FORMAT(datez, '%d %b %Y <br>(%h:%i %p)') AS datez_ok
			FROM b_message
			WHERE user_id_to = '$member_id' AND (message_type = '1' OR message_type = '2')
			AND message_status = 0 AND read_status = '0' AND teacher_id = 0
			ORDER BY datez DESC
		");
		$total_msg = $get_message->num_rows();
		$messages = $get_message->result();		
		
		$cnt = array(
			'menu_id' => $menu_id, 
			'menu_name' => $menu_name,
			'total_msg' => $total_msg,
			'messages' => $messages
		);
		
		$this->load->view('contents/admin/notification/message', $cnt);
    }
	
	public function payment()
    {
		$menu_id = "-1";
		$menu_name = "Payment - Notification";
		
		$member_id = $this->session->userdata("schoolp_member_id");
		$get_payment = $this->db->query("
			SELECT b_payment_notification.*, DATE_FORMAT(datez, '%d %b %Y <br>(%h:%i %p)') AS datez_ok
			FROM b_payment_notification
			WHERE parent_id = '$member_id' AND notification_status = '1'
			ORDER BY datez ASC
		");
		$total_msg = $get_payment->num_rows();
		$payments = $get_payment->result();		
		
		foreach ($payments as $j => $payment)
		{
			$school = $this->SchoolModel->getOne(array('schoolid' => $payment->school_id));
		
			$school_code = $school->school_code;
			$school_code_tb = strtolower($school_code);
			$school_dbase = $this->basedb . "school_client_$school_code_tb";
			$get_dbclient = $this->connectdb($school_dbase);
			if ($get_dbclient)
			{
				$student_name = "-";
				$student = $this->UserModel->getOne(array('memberid' => $payment->student_id));
				if (isset($student) && is_object($student) && $student != false)		
				{
					$student_name = "$student->fullname";
				}
				$payment->student_name = $student_name;
				
			}
			
			$monthName = date("F", mktime(0, 0, 0, $payment->payment_month, 10));
			
			$payment->month_name = $monthName;
			
			$payment->school_name = $school->school_name;
			
			$get_dbmaster = $this->connectdb($this->basedb . 'school_master');
			
		}
		
				
		//echo "<pre>";
		//var_dump($payments);
		
		$cnt = array(
			'menu_id' => $menu_id, 
			'menu_name' => $menu_name,
			'total_msg' => $total_msg,
			'payments' => $payments
		);
		
		$this->load->view('contents/admin/notification/payment', $cnt);
    }
	
	
	public function payment_read($notification_id = "")
    {
		$menu_id = "-1";
		$menu_name = "Payment - Read Notification";
		
		$datez = date('Y-m-d H:i:s');

		$query_db = array(
			'notification_status' => 2,
			'read_date' => $datez
		);
		$upd_into_db = $this->PaymentNotificationModel->save($query_db, array('notificationid' => $notification_id));
		
		$notification = $this->PaymentNotificationModel->getOne(array('notificationid' => $notification_id));
		
		$school = $this->SchoolModel->getOne(array('schoolid' => $notification->school_id));
		
		$school_code = $school->school_code;
		$school_code_tb = strtolower($school_code);
		$school_dbase = $this->basedb . "school_client_$school_code_tb";
		$get_dbclient = $this->connectdb($school_dbase);
		if ($get_dbclient)
		{
			$student_name = "-";
			$student = $this->UserModel->getOne(array('memberid' => $notification->student_id));
			if (isset($student) && is_object($student) && $student != false)		
			{
				$student_name = "$student->fullname";
			}
			$notification->student_name = $student_name;
			
		}
		
		$monthName = date("F", mktime(0, 0, 0, $notification->payment_month, 10));
		
		$notification->month_name = $monthName;
		
		$notification->school_name = $school->school_name;
		
		$get_dbmaster = $this->connectdb($this->basedb . 'school_master');
		
		$cnt = array(
			'menu_id' => $menu_id, 
			'menu_name' => $menu_name,
			'notification' => $notification
		);
		
		$this->load->view('contents/admin/notification/payment_read', $cnt);
    }
	
	
	function auto_notify()
    {
		$menu_id = "-1";
		$menu_name = "Notification";
		
		$children_id = $this->session->userdata("schoolp_children_id");
		
		$messages = array();
		$total_msg = 0;
		
		$dataDetail = $this->ParentStudentModel->getOne(array('student_id' => $children_id));
		if (isset($dataDetail) && is_object($dataDetail) && $dataDetail != false)
		{
			$school_id = $dataDetail->school_id;		
					
			$school = $this->SchoolModel->getOne(array('schoolid' => $dataDetail->school_id));
			$school_code = $school->school_code;
			$school_code_tb = strtolower($school_code);
			$school_dbase = $this->basedb . "school_client_$school_code_tb";
			$get_dbclient = $this->connectdb($school_dbase);
			
			if ($get_dbclient)
			{
				$this->load->model("client/CourcesModel");
				$this->load->model("client/ClassroomModel");
				$this->load->model("client/NotificationModel");
				$this->load->model("client/CalendarModel");
				$this->load->model("client/ExamScheduleModel");
				$this->load->model("client/ExamTypeModel");
				
				$get_notifys = $this->db->query("
					SELECT *, DATE_FORMAT(notify_date, '%d %b %Y') AS notify_date_ok
					FROM b_notification
					WHERE member_id = '$children_id'
					AND (az_id IN (SELECT calendarid FROM b_calendar WHERE calendar_status ='1')
						 OR az_id IN (SELECT examid FROM b_exam_schedule WHERE exam_status ='1'))
				");
				$total_msg = $get_notifys->num_rows();
				
				$get_message = $this->db->query("
					SELECT *, DATE_FORMAT(notify_date, '%d %b %Y') AS notify_date_ok
					FROM b_notification
					WHERE member_id = '$children_id'
					AND (az_id IN (SELECT calendarid FROM b_calendar WHERE calendar_status ='1')
						 OR az_id IN (SELECT examid FROM b_exam_schedule WHERE exam_status ='1'))
					ORDER BY notify_date DESC LIMIT 0, 5
				");
				$messages = $get_message->result();
				
				foreach ($messages as $j => $message) 
				{
					$title = "";
					
					if ($message->notify_type == 1)
					{
						$calendar = $this->CalendarModel->getOne(array('calendarid' => $message->az_id), array('*, DATE_FORMAT(calendar_date, "%d %b %Y") AS calendar_date_ok, DATE_FORMAT(calendar_time, "%h:%i %p") AS calendar_time_ok'));
						$title = "$message->notify_date_ok ($calendar->calendar_time_ok) <br>$calendar->calendar_title";
					}
					else if ($message->notify_type == 2)
					{
						$exam = $this->ExamScheduleModel->getOne(array('examid' => $message->az_id), array('*, DATE_FORMAT(exam_date, "%d %b %Y") AS exam_date_ok, DATE_FORMAT(exam_time, "%h:%i %p") AS exam_time_ok'));
						$cources = $this->CourcesModel->getOne(array('courcesid' => $exam->cources_id));
						
						$title = "$message->notify_date_ok ($exam->exam_time_ok) <br>Ujian $cources->cources_name";
					}
					else if ($message->notify_type == 3)
					{
						$calendar = $this->CalendarModel->getOne(array('calendarid' => $message->az_id), array('*, DATE_FORMAT(calendar_date, "%d %b %Y") AS calendar_date_ok, DATE_FORMAT(calendar_time, "%h:%i %p") AS calendar_time_ok'));
						
						$classroom_name = "";
						$classroom = $this->ClassroomModel->getOne(array('classroomid' => $calendar->classroom_id));
						if (isset($classroom) && is_object($classroom) && $classroom != false) $classroom_name = "$classroom->classroom_name";
						
						$title = "$message->notify_date_ok ($calendar->calendar_time_ok) <br>$classroom_name - $calendar->calendar_title";
					}
					else if ($message->notify_type == 4)
					{
						$exam = $this->ExamScheduleModel->getOne(array('examid' => $message->az_id), array('*, DATE_FORMAT(exam_date, "%d %b %Y") AS exam_date_ok, DATE_FORMAT(exam_time, "%h:%i %p") AS exam_time_ok'));
						$cources = $this->CourcesModel->getOne(array('courcesid' => $exam->cources_id));
						
						$exam_type_text = "Others";
						$exam_type = $this->ExamTypeModel->getOne(array('typeid' => $exam->exam_type));
						if (isset($exam_type) && is_object($exam_type) && $exam_type != false) $exam_type_text = $exam_type->type_name;
									
						$classroom_name = "";
						$classroom = $this->ClassroomModel->getOne(array('classroomid' => $exam->classroom_id));
						if (isset($classroom) && is_object($classroom) && $classroom != false) $classroom_name = "$classroom->classroom_name";
						
						$exam_time_text = "";
						if ($exam->exam_time <> "00:00:00") $exam_time_text = " ($exam->exam_time_ok)";
						$title = "$message->notify_date_ok $exam_time_text <br>$classroom_name - $exam_type_text $cources->cources_name";
					}
					
					
					$message->title = $title;
				}
				
			}
			$get_dbmaster = $this->connectdb($this->basedb . 'school_master');
		}
			
		$cnt = array(
			'menu_id' => $menu_id, 
			'menu_name' => $menu_name,
			'total_msg' => $total_msg,
			'messages' => $messages
		);
		
		$this->load_page_cont("admin/notification/notify", $cnt);
    }
	
	public function notify_detail($notification_id = "")
    {
		$menu_id = "-1";
		$menu_name = "Notification - Detail";
		
		$datez = date('Y-m-d H:i:s');
		
		$children_id = $this->session->userdata("schoolp_children_id");
		
		$dataDetail = $this->ParentStudentModel->getOne(array('student_id' => $children_id));
		$school_id = $dataDetail->school_id;		
				
		$school = $this->SchoolModel->getOne(array('schoolid' => $dataDetail->school_id));
		$school_code = $school->school_code;
		$school_code_tb = strtolower($school_code);
		$school_dbase = $this->basedb . "school_client_$school_code_tb";
		$get_dbclient = $this->connectdb($school_dbase);
		
		if ($get_dbclient)
		{
			$this->load->model("client/EducationLevelModel");
			$this->load->model("client/CourcesModel");
			$this->load->model("client/ClassroomModel");
			$this->load->model("client/NotificationModel");
			$this->load->model("client/CalendarModel");
			$this->load->model("client/ExamScheduleModel");
			$this->load->model("client/ExamTypeModel");
			
			$notification = $this->NotificationModel->getOne(array('notifyid' => $notification_id));
		
			if ($notification->notify_type == 2)
			{
				$exam_id = $notification->az_id;
				
				$calendar = $this->ExamScheduleModel->getOne(array('examid' => $exam_id), array('*, DATE_FORMAT(exam_date, "%d %b %Y") AS calendar_date_ok, DATE_FORMAT(exam_time, "%H:%i") AS timez'));
				
				$member = $this->UserModel->getOne(array('memberid' => $calendar->member_id));
				$member_type_text = "Admin";			
				
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
				
				$calendar_title = "Ujian - $cources_name";
				$calendar->calendar_title = $calendar_title;
			}
			else if ($notification->notify_type == 4)
			{
				$exam_id = $notification->az_id;
				
				$calendar = $this->ExamScheduleModel->getOne(array('examid' => $exam_id), array('*, DATE_FORMAT(exam_date, "%d %b %Y") AS calendar_date_ok, DATE_FORMAT(exam_time, "%H:%i") AS timez'));
				
				$member = $this->UserModel->getOne(array('memberid' => $calendar->member_id));
				$member_type_text = "Admin";			
				
				$member_text = "$member->fullname ($member_type_text)";
				$classroom_name = "";
				$classroom = $this->ClassroomModel->getOne(array('classroomid' => $calendar->classroom_id));
				if (isset($classroom) && is_object($classroom) && $classroom != false) $classroom_name = "$classroom->classroom_name";
				
				$exam_type_text = "Others";
				$exam_type = $this->ExamTypeModel->getOne(array('typeid' => $calendar->exam_type));
				if (isset($exam_type) && is_object($exam_type) && $exam_type != false) $exam_type_text = $exam_type->type_name;
									
				$calendar->created_by = $member_text;
				$calendar->classroom_name = $classroom_name;
				$calendar->exam_type_text = $exam_type_text;
				
				$edulevel_name = "All";
				$edulevel = $this->EducationLevelModel->getOne(array('edulevelid' => $calendar->edulevel_id));
				if (isset($edulevel) && is_object($edulevel) && $edulevel != false) $edulevel_name = "$edulevel->edulevel_name";
				
				$calendar->edulevel_name = $edulevel_name;
				
				$calendar_desc = str_replace("\r\n", "<br>", $calendar->exam_desc);
				$calendar->calendar_desc = $calendar_desc;
				
				$cources_name = "Unknown";
				$cources = $this->CourcesModel->getOne(array('courcesid' => $calendar->cources_id, 'cources_publish' => 1));
				if (isset($cources) && is_object($cources) && $cources != false) $cources_name = "$cources->cources_name";
				
				$calendar_title = "$exam_type_text - $cources_name";
				$calendar->calendar_title = $calendar_title;
			}
			else if ($notification->notify_type == 3)
			{
				$calendar_id = $notification->az_id;
				
				$calendar = $this->CalendarModel->getOne(array('calendarid' => $calendar_id), array('*, DATE_FORMAT(calendar_date, "%d %b %Y") AS calendar_date_ok, DATE_FORMAT(calendar_time, "%H:%i") AS timez'));
				
				$classroom_name = "";
				$classroom = $this->ClassroomModel->getOne(array('classroomid' => $calendar->classroom_id));
				if (isset($classroom) && is_object($classroom) && $classroom != false) $classroom_name = "$classroom->classroom_name";
					
				$member = $this->UserModel->getOne(array('memberid' => $calendar->member_id));
				if ($member->member_type == 1) $member_type_text = "Admin";
				else if ($member->member_type == 2) $member_type_text = "Admin";
				else if ($member->member_type == 3) $member_type_text = "Teacher";
				else if ($member->member_type == 5) $member_type_text = "Principal";
				else if ($member->member_type == 6) $member_type_text = "Owner";
				
				$member_text = "$member->fullname ($member_type_text)";
				
				$calendar->created_by = $member_text;
				$calendar->classroom_name = $classroom_name;
				
				$edulevel_name = "All";
				$edulevel = $this->EducationLevelModel->getOne(array('edulevelid' => $calendar->edulevel_id));
				if (isset($edulevel) && is_object($edulevel) && $edulevel != false) $edulevel_name = "$edulevel->edulevel_name";
				
				$calendar->edulevel_name = $edulevel_name;
				
				$calendar_desc = str_replace("\r\n", "<br>", $calendar->calendar_desc);
				$calendar->calendar_desc = $calendar_desc;	
			}
			else
			{
				$calendar_id = $notification->az_id;
				
				$calendar = $this->CalendarModel->getOne(array('calendarid' => $calendar_id), array('*, DATE_FORMAT(calendar_date, "%d %b %Y") AS calendar_date_ok, DATE_FORMAT(calendar_time, "%H:%i") AS timez'));
				
				$member = $this->UserModel->getOne(array('memberid' => $calendar->member_id));
				if ($member->member_type == 1) $member_type_text = "Admin";
				else if ($member->member_type == 2) $member_type_text = "Admin";
				else if ($member->member_type == 3) $member_type_text = "Teacher";
				else if ($member->member_type == 5) $member_type_text = "Principal";
				else if ($member->member_type == 6) $member_type_text = "Owner";
				
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

		
		$cnt = array(
			'menu_id' => $menu_id, 
			'menu_name' => $menu_name,
			'calendar' => $calendar,
			'calendar_id' => $notification_id
		);
		
		$this->load_page_cont("admin/notification/notify_detail", $cnt);
		
		$this->load->view('contents/admin/notification/notify_stat', $cnt);
    }
	
	
	function notify_more()
    {
		$menu_id = "-1";
		$menu_name = "All Notification";
		
		$children_id = $this->session->userdata("schoolp_children_id");
		
		$dataDetail = $this->ParentStudentModel->getOne(array('student_id' => $children_id));
		$school_id = $dataDetail->school_id;		
				
		$school = $this->SchoolModel->getOne(array('schoolid' => $dataDetail->school_id));
		$school_code = $school->school_code;
		$school_code_tb = strtolower($school_code);
		$school_dbase = $this->basedb . "school_client_$school_code_tb";
		$get_dbclient = $this->connectdb($school_dbase);
		
		if ($get_dbclient)
		{
			$this->load->model("client/CourcesModel");
			$this->load->model("client/ClassroomModel");
			$this->load->model("client/NotificationModel");
			$this->load->model("client/CalendarModel");
			$this->load->model("client/ExamScheduleModel");
			$this->load->model("client/ExamTypeModel");
			
			$get_message = $this->db->query("
				SELECT *, DATE_FORMAT(notify_date, '%d %b %Y') AS notify_date_ok
				FROM b_notification
				WHERE member_id = '$children_id'
				AND (az_id IN (SELECT calendarid FROM b_calendar WHERE calendar_status ='1')
					 OR az_id IN (SELECT examid FROM b_exam_schedule WHERE exam_status ='1'))
				ORDER BY notify_date DESC
			");
			$messages = $get_message->result();
			
			foreach ($messages as $j => $message) 
			{
				$title = "";
				
				if ($message->notify_type == 1)
				{
					$calendar = $this->CalendarModel->getOne(array('calendarid' => $message->az_id), array('*, DATE_FORMAT(calendar_date, "%d %b %Y") AS calendar_date_ok, DATE_FORMAT(calendar_time, "%h:%i %p") AS calendar_time_ok'));
					$title = "Waktu: $calendar->calendar_time_ok <br>$calendar->calendar_title";
				}
				else if ($message->notify_type == 2)
				{
					$exam = $this->ExamScheduleModel->getOne(array('examid' => $message->az_id), array('*, DATE_FORMAT(exam_date, "%d %b %Y") AS exam_date_ok, DATE_FORMAT(exam_time, "%h:%i %p") AS exam_time_ok'));
					$cources = $this->CourcesModel->getOne(array('courcesid' => $exam->cources_id));
					
					$title = "Waktu: $exam->exam_time_ok <br>Ujian $cources->cources_name";
				}
				else if ($message->notify_type == 3)
				{
					$calendar = $this->CalendarModel->getOne(array('calendarid' => $message->az_id), array('*, DATE_FORMAT(calendar_date, "%d %b %Y") AS calendar_date_ok, DATE_FORMAT(calendar_time, "%h:%i %p") AS calendar_time_ok'));
					
					$classroom_name = "";
					$classroom = $this->ClassroomModel->getOne(array('classroomid' => $calendar->classroom_id));
					if (isset($classroom) && is_object($classroom) && $classroom != false) $classroom_name = "$classroom->classroom_name";
					
					$title = "Waktu: $calendar->calendar_time_ok <br>$classroom_name - $calendar->calendar_title";
				}
				else if ($message->notify_type == 4)
				{
					$exam = $this->ExamScheduleModel->getOne(array('examid' => $message->az_id), array('*, DATE_FORMAT(exam_date, "%d %b %Y") AS exam_date_ok, DATE_FORMAT(exam_time, "%h:%i %p") AS exam_time_ok'));
					$cources = $this->CourcesModel->getOne(array('courcesid' => $exam->cources_id));
					
					$exam_type_text = "Others";
					$exam_type = $this->ExamTypeModel->getOne(array('typeid' => $exam->exam_type));
					if (isset($exam_type) && is_object($exam_type) && $exam_type != false) $exam_type_text = $exam_type->type_name;
								
					$classroom_name = "";
					$classroom = $this->ClassroomModel->getOne(array('classroomid' => $exam->classroom_id));
					if (isset($classroom) && is_object($classroom) && $classroom != false) $classroom_name = "$classroom->classroom_name";
					
					$title = "$classroom_name - $exam_type_text $cources->cources_name";
				}
				
				
				$message->title = $title;
			}
			
		}
		$get_dbmaster = $this->connectdb($this->basedb . 'school_master');		
		
		
		
		$cnt = array(
			'menu_id' => $menu_id, 
			'menu_name' => $menu_name,
			'dataDetails' => $messages
		);
		
		$this->load_content("admin/notification/notify_more", $cnt);
    }
	

}
