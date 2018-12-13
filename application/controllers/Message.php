<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class message extends Core_Controller
{

    function __construct()
    {
        parent::__construct();		
		
		$this->checkAuth();
        $this->load->model("UserModel");
		$this->load->model("SchoolModel");
		$this->load->model("ParentStudentModel");
		$this->load->model("MessageModel");
    }

    public function index()
    {
		$this->load->view('contents/error/error_page');
    }

	public function inbox()
    {
		$menu_id = "3";
		$menu_name = "Message - Inbox";
		
		$member_id = $this->session->userdata("schoolp_member_id");
		
		$dt = Time();
		$date_now = $this->DateAdd($dt, "H", 0);
		$date_now = $this->cDateSch($date_now);
		
		$date_from_go = $this->DateAdd($dt, "m", -2);
		$date_from_go = $this->cDateSch($date_from_go);
		
		$date_from = $this->input->post("date_from", true);
		$date_to = $this->input->post("date_to", true);
		if (!isset($date_from)) $date_from = $date_from_go;
		if (!isset($date_to)) $date_to = $date_now;
		
		$sch_from_arr = explode("-", $date_from);
		$date_from_db = "$sch_from_arr[2]-$sch_from_arr[1]-$sch_from_arr[0]";
		
		$sch_to_arr = explode("-", $date_to);
		$date_to_db = "$sch_to_arr[2]-$sch_to_arr[1]-$sch_to_arr[0]";
				
		$get_message = $this->db->query("
			SELECT b_message.*, DATE_FORMAT(datez, '%d %b %Y <br>(%h:%i %p)') AS datez_ok
			FROM b_message
			WHERE user_id_to = '$member_id' AND (message_type = '1' OR message_type = '2')
			AND message_status = 0 AND message_date BETWEEN '$date_from_db' AND '$date_to_db'
			AND teacher_id = 0
			ORDER BY datez DESC
		");				
		$messages = $get_message->result();
		
		foreach ($messages as $j => $message)
		{
			$message->classroom_name = "-";
			$message->cources_name = "-";
			
			$school = $this->SchoolModel->getOne(array('schoolid' => $message->school_id));
			$message->school_name = $school->school_name;
		
			$school_code = $school->school_code;
			$school_code_tb = strtolower($school_code);
			$school_dbase = $this->basedb . "school_client_$school_code_tb";
			$get_dbclient = $this->connectdb($school_dbase);
			if ($get_dbclient)
			{
				$this->load->model("client/ClassroomModel");
				$this->load->model("client/CourcesModel");
				
				$classroom = $this->ClassroomModel->getOne(array('classroomid' => $message->classroom_id));
				if (isset($classroom) && is_object($classroom) && $classroom != false)
				{
					$message->classroom_name = $classroom->classroom_name;
				}
				
				$cources = $this->CourcesModel->getOne(array('courcesid' => $message->cources_id));
				if (isset($cources) && is_object($cources) && $cources != false)
				{
					$message->cources_name = $cources->cources_name;
				}
								
				$member = $this->UserModel->getOne(array('memberid' => $message->user_id_from));
				$message->sender_name = $member->fullname;
				
				if ($member->member_type == 1 || $member->member_type == 2) $member_type_text = "Admin";
				else if ($member->member_type == 3 && $member->principal_stat == 0) $member_type_text = "Guru";
				else if ($member->member_type == 4) $member_type_text = "Siswa";
				else if ($member->member_type == 3 && $member->principal_stat == 1) $member_type_text = "Kepsek";
				else if ($member->member_type == 3 && $member->principal_stat == 2) $member_type_text = "Wakil Kepsek";
				else if ($member->member_type == 6) $member_type_text = "Pemilik Yayasan";
				else $member_type_text = "User";
								
				$member = $this->UserModel->getOne(array('memberid' => $message->user_id_from));
				$message->student_name = "$member->fullname ($member->member_code)";
				
				$message->member_type_text = $member_type_text;	
			}
			$get_dbmaster = $this->connectdb($this->basedb . 'school_master');
			
			$message->reply_status = 0;
			$cek_message = $this->db->query("
				SELECT * FROM b_message
				WHERE reply_message_id = '$message->messageid' OR messageid = '$message->reply_message_id'
				ORDER BY datez DESC LIMIT 0, 1 
			");				
			$message_reply = $cek_message->result();
			if (isset($message_reply) && count($message_reply) > 0)
			{
				$message->reply_status = 1;
			}
		}
		
		//echo "<pre>";
		//var_dump($messages);
		
		$cnt = array(
			'menu_id' => $menu_id, 
			'menu_name' => $menu_name,
			'date_from' => $date_from,
			'date_to' => $date_to,
			'messages' => $messages
		);
		
		$this->load_content("admin/message/inbox", $cnt);     
    }
	
	public function inbox_detail($message_id = "", $parent_message_id = "")
	{
		$menu_id = "3";
		$menu_name = "Message - Inbox Detail";
		
		$datez = date('Y-m-d H:i:s');		
		$member_id = $this->session->userdata("schoolp_member_id");
		
		$upd_message = $this->db->query("
			UPDATE b_message SET read_status = 1, read_date = '$datez'
			WHERE user_id_to = '$member_id' AND (messageid = '$message_id' OR (reply_message_id = '$parent_message_id' AND reply_message_id <> 0))
		");
		
		if ($parent_message_id == 0) $parent_message_id = $message_id;

		$message = $this->MessageModel->getOne(array('messageid' => $parent_message_id), array('*, DATE_FORMAT(datez, "%d %b %Y (%h:%i %p)") AS datez_ok'));
		
		$school = $this->SchoolModel->getOne(array('schoolid' => $message->school_id));
		$message->school_name = $school->school_name;
		
		$messagezz = $this->MessageModel->getOne(array('messageid' => $message_id));
		
		$school_code = $school->school_code;
		$school_code_tb = strtolower($school_code);
		$school_dbase = $this->basedb . "school_client_$school_code_tb";
		$get_dbclient = $this->connectdb($school_dbase);
		if ($get_dbclient)
		{
			$this->load->model("client/ClassroomModel");
			$this->load->model("client/CourcesModel");
			
			$upd_message = $this->db->query("
				UPDATE b_message SET read_status = 1, read_date = '$datez'
				WHERE messageid = '$messagezz->read_message_id'
			");
				
			$sender_name = "-";
			$sender = $this->UserModel->getOne(array('memberid' => $message->user_id_from));		
			if (isset($sender) && is_object($sender) && $sender != false)
			{
				if ($sender->member_type == 1 || $sender->member_type == 2) $member_type_text = "Admin";
				else if ($sender->member_type == 3 && $sender->principal_stat == 0) $member_type_text = "Guru";
				else if ($sender->member_type == 4) $member_type_text = "Siswa";
				else if ($sender->member_type == 3 && $sender->principal_stat == 1) $member_type_text = "Kepsek";
				else if ($sender->member_type == 3 && $sender->principal_stat == 2) $member_type_text = "Wakil Kepsek";
				else if ($sender->member_type == 6) $member_type_text = "Pemilik Yayasan";
				else $member_type_text = "User";
				
				$sender_name = "$sender->fullname ($member_type_text)";
			}
			
			if ($message->read_message_id <> 0 )
			{
				$messagesc = $this->MessageModel->getOne(array('messageid' => $message->read_message_id));
				$member = $this->UserModel->getOne(array('memberid' => $messagesc->user_id_to));
				$message->student_name = "$member->fullname ($member->member_code)";
			}
			else
			{
				$message->student_name = "-";
				$messagesc = $this->MessageModel->getOne(array('messageid' => $messagezz->read_message_id));
				if (isset($messagesc) && is_object($messagesc) && $messagesc != false)
				{
					$member = $this->UserModel->getOne(array('memberid' => $messagesc->user_id_to));
					$message->student_name = "$member->fullname ($member->member_code)";
				}
			}
						
			$classroom_name = "-";
			$classroom = $this->ClassroomModel->getOne(array('classroomid' => $message->classroom_id));		
			if (isset($classroom) && is_object($classroom) && $classroom != false)
			{
				$classroom_name = $classroom->classroom_name;
			}
			
			$cources_name = "-";
			$cources = $this->CourcesModel->getOne(array('courcesid' => $message->cources_id));
			if (isset($cources) && is_object($cources) && $cources != false)
			{
				$cources_name = $cources->cources_name;				
			}

			$get_dbmaster = $this->connectdb($this->basedb . 'school_master');
			
			if ($message->teacher_id <> 0)
			{
				$sender = $this->UserModel->getOne(array('memberid' => $message->user_id_from));		
				if (isset($sender) && is_object($sender) && $sender != false)
				{
					$sender_name = "$sender->fullname (Orangtua)";
				}
			}
			
			$message->sender_name = $sender_name;	
			$message->classroom_name = $classroom_name;
			$message->cources_name = $cources_name;
			
		}
		
		
		$get_message = $this->db->query("
			SELECT *, DATE_FORMAT(datez, '%d %b %Y (%h:%i %p)') AS datez_ok
			FROM b_message
			WHERE message_type = '2' AND reply_message_id = '$parent_message_id'
			ORDER BY datez ASC
		");				
		$reply_messages = $get_message->result();
		
		foreach ($reply_messages as $j => $reply_message)
		{
			if ($reply_message->parent_status == 1 && $reply_message->teacher_id == 0)
			{
				$parent_status = 1;
				
				$get_dbclient = $this->connectdb($school_dbase);
				$sender_name = "-";
				$sender = $this->UserModel->getOne(array('memberid' => $reply_message->user_id_from));		
				if (isset($sender) && is_object($sender) && $sender != false)
				{
					if ($sender->member_type == 1 || $sender->member_type == 2) $member_type_text = "Admin";
					else if ($sender->member_type == 3 && $sender->principal_stat == 0) $member_type_text = "Guru";
					else if ($sender->member_type == 4) $member_type_text = "Siswa";
					else if ($sender->member_type == 3 && $sender->principal_stat == 1) $member_type_text = "Kepsek";
					else if ($sender->member_type == 3 && $sender->principal_stat == 2) $member_type_text = "Wakil Kepsek";
					else if ($sender->member_type == 6) $member_type_text = "Pemilik Yayasan";
					else $member_type_text = "User";
				
					//if ($parent_status == 1) $member_type_text = "Orangtua";
					$sender_name = "$sender->fullname ($member_type_text)";
				}
				$reply_message->sender_name = $sender_name;
			}
			else
			{
				$get_dbmaster = $this->connectdb($this->basedb . 'school_master');
				
				$sender_name = "-";
				$sender = $this->UserModel->getOne(array('memberid' => $reply_message->user_id_from));		
				if (isset($sender) && is_object($sender) && $sender != false)
				{
					$sender_name = "$sender->fullname (Orangtua)";
				}
				$reply_message->sender_name = $sender_name;
			}
			
			
		}
		
		//echo "<pre>";
		//var_dump($message);
		
		$get_dbmaster = $this->connectdb($this->basedb . 'school_master');
		
		$cnt = array(
			'menu_id' => $menu_id, 
			'menu_name' => $menu_name,
			'message' => $message,
			'reply_messages' => $reply_messages,
			'message_id' => $message_id,
			'parent_message_id' => $parent_message_id			
		);
		
		$this->load_content("admin/message/inbox_detail", $cnt);
	}
	
	
	public function sent()
    {
		$menu_id = "3";
		$menu_name = "Message - Sent";
		
		$member_id = $this->session->userdata("schoolp_member_id");
		
		$dt = Time();
		$date_now = $this->DateAdd($dt, "H", 0);
		$date_now = $this->cDateSch($date_now);
		
		$date_from_go = $this->DateAdd($dt, "m", -2);
		$date_from_go = $this->cDateSch($date_from_go);
		
		$date_from = $this->input->post("date_from", true);
		$date_to = $this->input->post("date_to", true);
		if (!isset($date_from)) $date_from = $date_from_go;
		if (!isset($date_to)) $date_to = $date_now;
		
		$sch_from_arr = explode("-", $date_from);
		$date_from_db = "$sch_from_arr[2]-$sch_from_arr[1]-$sch_from_arr[0]";
		
		$sch_to_arr = explode("-", $date_to);
		$date_to_db = "$sch_to_arr[2]-$sch_to_arr[1]-$sch_to_arr[0]";
				
		$get_message = $this->db->query("
			SELECT b_message.*, DATE_FORMAT(datez, '%d %b %Y <br>(%h:%i %p)') AS datez_ok
			FROM b_message
			WHERE user_id_from = '$member_id' AND message_type = '1'
			AND message_status = 0 AND message_date BETWEEN '$date_from_db' AND '$date_to_db'
			AND teacher_id <> 0
			ORDER BY datez DESC
		");				
		$messages = $get_message->result();
		
		foreach ($messages as $j => $message)
		{
			$message->classroom_name = "-";
			$message->cources_name = "-";
			
			$school = $this->SchoolModel->getOne(array('schoolid' => $message->school_id));
			$message->school_name = $school->school_name;
		
			$school_code = $school->school_code;
			$school_code_tb = strtolower($school_code);
			$school_dbase = $this->basedb . "school_client_$school_code_tb";
			$get_dbclient = $this->connectdb($school_dbase);
			if ($get_dbclient)
			{
				$this->load->model("client/ClassroomModel");
				$this->load->model("client/CourcesModel");
				
				$classroom = $this->ClassroomModel->getOne(array('classroomid' => $message->classroom_id));
				if (isset($classroom) && is_object($classroom) && $classroom != false)
				{
					$message->classroom_name = $classroom->classroom_name;
				}
				
				$cources = $this->CourcesModel->getOne(array('courcesid' => $message->cources_id));
				if (isset($cources) && is_object($cources) && $cources != false)
				{
					$message->cources_name = $cources->cources_name;
				}
								
				$member = $this->UserModel->getOne(array('memberid' => $message->user_id_to));
				$message->recipient_name = $member->fullname;
				
				if ($member->member_type == 1 || $member->member_type == 2) $member_type_text = "Admin";
				else if ($member->member_type == 3 && $member->principal_stat == 0) $member_type_text = "Guru";
				else if ($member->member_type == 4) $member_type_text = "Siswa";
				else if ($member->member_type == 3 && $member->principal_stat == 1) $member_type_text = "Kepsek";
				else if ($member->member_type == 3 && $member->principal_stat == 2) $member_type_text = "Wakil Kepsek";
				else if ($member->member_type == 6) $member_type_text = "Pemilik Yayasan";
				else $member_type_text = "User";
								
				$member = $this->UserModel->getOne(array('memberid' => $message->user_id_to));
				$message->student_name = "$member->fullname ($member->member_code)";
				
				$message->member_type_text = $member_type_text;	
			}
			$get_dbmaster = $this->connectdb($this->basedb . 'school_master');
			
		}
		
		//echo "<pre>";
		//var_dump($messages);
		
		$cnt = array(
			'menu_id' => $menu_id, 
			'menu_name' => $menu_name,
			'date_from' => $date_from,
			'date_to' => $date_to,
			'messages' => $messages
		);
		
		$this->load_content("admin/message/sent", $cnt);     
    }
	
	public function sent_detail($message_id = "", $parent_message_id = "")
	{
		$menu_id = "3";
		$menu_name = "Message - Sent Detail";
		
		$datez = date('Y-m-d H:i:s');		
		$member_id = $this->session->userdata("schoolp_member_id");
		
		if ($parent_message_id == 0) $parent_message_id = $message_id;

		$message = $this->MessageModel->getOne(array('messageid' => $parent_message_id), array('*, DATE_FORMAT(datez, "%d %b %Y (%h:%i %p)") AS datez_ok'));
		
		$school = $this->SchoolModel->getOne(array('schoolid' => $message->school_id));
		$message->school_name = $school->school_name;
		
		$messagezz = $this->MessageModel->getOne(array('messageid' => $message_id));
		
		$school_code = $school->school_code;
		$school_code_tb = strtolower($school_code);
		$school_dbase = $this->basedb . "school_client_$school_code_tb";
		$get_dbclient = $this->connectdb($school_dbase);
		if ($get_dbclient)
		{
			$this->load->model("client/ClassroomModel");
			$this->load->model("client/CourcesModel");
			
			$recipient_name = "-";
			$recipient = $this->UserModel->getOne(array('memberid' => $message->user_id_to));		
			if (isset($recipient) && is_object($recipient) && $recipient != false)
			{
				if ($recipient->member_type == 1 || $recipient->member_type == 2) $member_type_text = "Admin";
				else if ($recipient->member_type == 3 && $recipient->principal_stat == 0) $member_type_text = "Guru";
				else if ($recipient->member_type == 4) $member_type_text = "Siswa";
				else if ($recipient->member_type == 3 && $recipient->principal_stat == 1) $member_type_text = "Kepsek";
				else if ($recipient->member_type == 3 && $recipient->principal_stat == 2) $member_type_text = "Wakil Kepsek";
				else if ($recipient->member_type == 6) $member_type_text = "Pemilik Yayasan";
				else $member_type_text = "User";
				
				$recipient_name = "$recipient->fullname ($member_type_text)";
			}
			
			$messagesc = $this->MessageModel->getOne(array('read_message_id' => $message_id));
			$member = $this->UserModel->getOne(array('memberid' => $messagesc->user_id_from));
			$message->student_name = "$member->fullname ($member->member_code)";
			
			$classroom_name = "-";
			$classroom = $this->ClassroomModel->getOne(array('classroomid' => $message->classroom_id));		
			if (isset($classroom) && is_object($classroom) && $classroom != false)
			{
				$classroom_name = $classroom->classroom_name;
			}
			
			$cources_name = "-";
			$cources = $this->CourcesModel->getOne(array('courcesid' => $message->cources_id));
			if (isset($cources) && is_object($cources) && $cources != false)
			{
				$cources_name = $cources->cources_name;				
			}

			$get_dbmaster = $this->connectdb($this->basedb . 'school_master');
			
			$message->recipient_name = $recipient_name;	
			$message->classroom_name = $classroom_name;
			$message->cources_name = $cources_name;
			
		}
		
		
		$get_message = $this->db->query("
			SELECT *, DATE_FORMAT(datez, '%d %b %Y (%h:%i %p)') AS datez_ok
			FROM b_message
			WHERE message_type = '2' AND reply_message_id = '$parent_message_id'
			ORDER BY datez ASC
		");				
		$reply_messages = $get_message->result();
		
		foreach ($reply_messages as $j => $reply_message)
		{
			if ($reply_message->parent_status == 1 && $reply_message->teacher_id == 0)
			{
				$parent_status = 1;
				
				$get_dbclient = $this->connectdb($school_dbase);
				$sender_name = "-";
				$sender = $this->UserModel->getOne(array('memberid' => $reply_message->user_id_from));		
				if (isset($sender) && is_object($sender) && $sender != false)
				{
					if ($sender->member_type == 1 || $sender->member_type == 2) $member_type_text = "Admin";
					else if ($sender->member_type == 3 && $sender->principal_stat == 0) $member_type_text = "Guru";
					else if ($sender->member_type == 4) $member_type_text = "Siswa";
					else if ($sender->member_type == 3 && $sender->principal_stat == 1) $member_type_text = "Kepsek";
					else if ($sender->member_type == 3 && $sender->principal_stat == 2) $member_type_text = "Wakil Kepsek";
					else if ($sender->member_type == 6) $member_type_text = "Pemilik Yayasan";
					else $member_type_text = "User";
										
					//if ($parent_status == 1) $member_type_text = "Orangtua";
					$sender_name = "$sender->fullname ($member_type_text)";
				}
				$reply_message->sender_name = $sender_name;
			}
			else
			{
				$get_dbmaster = $this->connectdb($this->basedb . 'school_master');
				
				$sender_name = "-";
				$sender = $this->UserModel->getOne(array('memberid' => $reply_message->user_id_from));		
				if (isset($sender) && is_object($sender) && $sender != false)
				{
					$sender_name = "$sender->fullname (Orangtua)";
				}
				$reply_message->sender_name = $sender_name;
			}
			
			
		}
		
		//echo "<pre>";
		//var_dump($message);
		
		$get_dbmaster = $this->connectdb($this->basedb . 'school_master');
		
		$cnt = array(
			'menu_id' => $menu_id, 
			'menu_name' => $menu_name,
			'message' => $message,
			'reply_messages' => $reply_messages,
			'message_id' => $message_id,
			'parent_message_id' => $parent_message_id			
		);
		
		$this->load_content("admin/message/sent_detail", $cnt);
	}
	
	public function reply_message($message_id = "")
	{
		$menu_id = "3";
		$menu_name = "Message - Reply";
		
		$member_id = $this->session->userdata("schoolp_member_id");
		
		$message = $this->MessageModel->getOne(array('messageid' => $message_id), array('*, DATE_FORMAT(datez, "%d %b %Y (%h:%i %p)") AS datez_ok'));
		
		$school = $this->SchoolModel->getOne(array('schoolid' => $message->school_id));
		$message->school_name = $school->school_name;
		
		$school_code = $school->school_code;
		$school_code_tb = strtolower($school_code);
		$school_dbase = $this->basedb . "school_client_$school_code_tb";
		$get_dbclient = $this->connectdb($school_dbase);
		if ($get_dbclient)
		{
			$this->load->model("client/ClassroomModel");
			$this->load->model("client/CourcesModel");
			
			$sender_id = $message->user_id_from;
			if ($member_id == $message->user_id_from) $sender_id = $message->user_id_to;
			
			$sender_name = "-";
			$sender = $this->UserModel->getOne(array('memberid' => $sender_id));		
			if (isset($sender) && is_object($sender) && $sender != false)
			{
				if ($sender->member_type == 1 || $sender->member_type == 2) $member_type_text = "Admin";
				else if ($sender->member_type == 3 && $sender->principal_stat == 0) $member_type_text = "Guru";
				else if ($sender->member_type == 4) $member_type_text = "Siswa";
				else if ($sender->member_type == 3 && $sender->principal_stat == 1) $member_type_text = "Kepsek";
				else if ($sender->member_type == 3 && $sender->principal_stat == 2) $member_type_text = "Wakil Kepsek";
				else if ($sender->member_type == 6) $member_type_text = "Pemilik Yayasan";
				else $member_type_text = "User";
				
				$sender_name = "$sender->fullname ($member_type_text)";
			}
						
			
			if ($message->read_message_id <> 0 )
			{
				$messagesc = $this->MessageModel->getOne(array('messageid' => $message->read_message_id));
				$member = $this->UserModel->getOne(array('memberid' => $messagesc->user_id_to));
			}
			else
			{
				$messagesc = $this->MessageModel->getOne(array('read_message_id' => $message_id));
				$member = $this->UserModel->getOne(array('memberid' => $messagesc->user_id_from));
			}
			$message->student_name = "$member->fullname ($member->member_code)";
			
			$classroom_name = "-";
			$classroom = $this->ClassroomModel->getOne(array('classroomid' => $message->classroom_id));		
			if (isset($classroom) && is_object($classroom) && $classroom != false)
			{
				$classroom_name = $classroom->classroom_name;
			}
			
			$cources_name = "-";
			$cources = $this->CourcesModel->getOne(array('courcesid' => $message->cources_id));
			if (isset($cources) && is_object($cources) && $cources != false)
			{
				$cources_name = $cources->cources_name;				
			}
			
			$teacher_name = "-";
			if ($message->teacher_id <> 0)
			{
				$teacher = $this->UserModel->getOne(array('memberid' => $message->user_id_from));		
				if (isset($teacher) && is_object($teacher) && $teacher != false)
				{
					if ($teacher->member_type == 1 || $teacher->member_type == 2) $member_type_text = "Admin";
					else if ($teacher->member_type == 3 && $teacher->principal_stat == 0) $member_type_text = "Guru";
					else if ($teacher->member_type == 4) $member_type_text = "Siswa";
					else if ($teacher->member_type == 3 && $teacher->principal_stat == 1) $member_type_text = "Kepsek";
					else if ($teacher->member_type == 3 && $teacher->principal_stat == 2) $member_type_text = "Wakil Kepsek";
					else if ($teacher->member_type == 6) $member_type_text = "Pemilik Yayasan";
					else $member_type_text = "User";
					
					$teacher_name = "$teacher->fullname ($member_type_text)";
				}
			}
			
			$message->sender_name = $sender_name;	
			$message->classroom_name = $classroom_name;
			$message->cources_name = $cources_name;
			$message->teacher_name = $teacher_name;	
						
		}
		
		$get_dbmaster = $this->connectdb($this->basedb . 'school_master');
		
		//echo "<pre>";
		//var_dump($message);
		
		$cnt = array(
			'menu_id' => $menu_id, 
			'menu_name' => $menu_name,
			'message' => $message,
			'message_id' => $message_id
		);
		
		$this->load_page("admin/message/reply_message", $cnt);
	}
	
	public function save_messagedb()
    {
		$menu_id = "3";
        $menu_name = "Save Message";
		$datez = date('Y-m-d H:i:s');
					
		$message_id = $this->input->post('message_id');
		$message_cont  = $this->input->post('message_cont');
		
		$member_id = $this->session->userdata("schoolp_member_id");
		
		$message = $this->MessageModel->getOne(array('messageid' => $message_id));
		
		$school = $this->SchoolModel->getOne(array('schoolid' => $message->school_id));
		$school_name = $school->school_name;
		
		$school_code = $school->school_code;
		$school_code_tb = strtolower($school_code);
		$school_dbase = $this->basedb . "school_client_$school_code_tb";
		$get_dbclient = $this->connectdb($school_dbase);
		if ($get_dbclient)
		{
			$this->load->model("client/ClassroomModel");
			$this->load->model("client/CourcesModel");
			
			$sender_id = $message->user_id_from;
			if ($member_id == $message->user_id_from) $sender_id = $message->user_id_to;
			
			$sender_name = "-";
			$sender = $this->UserModel->getOne(array('memberid' => $sender_id));		
			if (isset($sender) && is_object($sender) && $sender != false)
			{
				if ($sender->member_type == 1 || $sender->member_type == 2) $member_type_text = "Admin";
				else if ($sender->member_type == 3 && $sender->principal_stat == 0) $member_type_text = "Guru";
				else if ($sender->member_type == 4) $member_type_text = "Siswa";
				else if ($sender->member_type == 3 && $sender->principal_stat == 1) $member_type_text = "Kepsek";
				else if ($sender->member_type == 3 && $sender->principal_stat == 2) $member_type_text = "Wakil Kepsek";
				else if ($sender->member_type == 6) $member_type_text = "Pemilik Yayasan";
				else $member_type_text = "User";
				
				$sender_name = "$sender->fullname ($member_type_text)";
			}
			
			if ($message->read_message_id <> 0 )
			{
				$messagesc = $this->MessageModel->getOne(array('messageid' => $message->read_message_id));
				$member = $this->UserModel->getOne(array('memberid' => $messagesc->user_id_to));
			}
			else
			{
				$messagesc = $this->MessageModel->getOne(array('read_message_id' => $message_id));
				$member = $this->UserModel->getOne(array('memberid' => $messagesc->user_id_from));
			}
			$student_name = "$member->fullname ($member->member_code)";
			
			$classroom_name = "-";
			$classroom = $this->ClassroomModel->getOne(array('classroomid' => $message->classroom_id));		
			if (isset($classroom) && is_object($classroom) && $classroom != false)
			{
				$classroom_name = $classroom->classroom_name;
			}
			
			$cources_name = "-";
			$cources = $this->CourcesModel->getOne(array('courcesid' => $message->cources_id));
			if (isset($cources) && is_object($cources) && $cources != false)
			{
				$cources_name = $cources->cources_name;				
			}
			
			
			
			$get_dbmaster = $this->connectdb($this->basedb . 'school_master');
		
			if ($message->teacher_id <> 0)
			{
				$sender_id = $message->user_id_to;
				$student_id = $messagesc->user_id_from;
			}
			else
			{
				$student_id = $messagesc->user_id_to;
			}
			
			$query_db = array(
				'user_id_from' => $member_id,
				'user_id_to' => $sender_id,
				'classroom_id' => $message->classroom_id,
				'cources_id' => $message->cources_id,
				'message_cont' => $message_cont,
				'reply_message_id' => $message_id,
				'message_date' => $datez,
				'message_status' => 0,
				'message_type' => 2,
				'parent_status' => '1',
				'school_id' => $message->school_id,
				'teacher_id' => $sender_id,
				'datez' => $datez,
				'member_id' => $member_id
			);
			$ins_message_into_db = $this->MessageModel->save($query_db);
			$message_id_db = $ins_message_into_db;
			
			$get_dbclient = $this->connectdb($school_dbase);
			
			$query_db = array(
				'user_id_from' => $student_id,
				'user_id_to' => $sender_id,
				'classroom_id' => $message->classroom_id,
				'cources_id' => $message->cources_id,
				'message_cont' => $message_cont,
				'reply_message_id' => $messagesc->messageid,
				'message_date' => $datez,
				'message_status' => 0,
				'message_type' => 2,
				'parent_status' => '1',
				'read_message_id' => $ins_message_into_db,
				'datez' => $datez,
				'member_id' => $member_id
			);
			$ins_message_into_db = $this->MessageModel->save($query_db);
			
			
		}
		
		$get_dbmaster = $this->connectdb($this->basedb . 'school_master');
		
		$menu_title = "MESSAGE";
		$menu_desc =  "School: $school_name <br> Student: $student_name <br> Classroom: $classroom_name <br> Reply to: $sender_name <br> Message: $message_cont";
		$menu_detail = "";
		$menu_action = "REPLY";
		$this->activitydb($menu_title, $menu_desc, $menu_detail, $menu_action);		

		
		$message_alert = "Message has been Sent.";
		$this->session->set_userdata("message_alert", $message_alert);
		
		redirect('message/inbox_detail/' . $message_id_db . '/' . $message_id);
		
    }
	
	
	public function student_inbox()
    {
		$menu_id = "38";
		$menu_name = "Message - Inbox";		
		
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
			$this->load->model("client/MessageModel");
			
			$get_message = $this->db->query("
				SELECT b_message.*, DATE_FORMAT(datez, '%d %b %Y <br>(%h:%i %p)') AS datez_ok
				FROM b_message
				WHERE user_id_to = '$student_id' AND (message_type = '1') AND reply_message_id = 0
				AND message_status = 0 AND parent_status = 0
				ORDER BY datez DESC
			");				
			$messages = $get_message->result();
			
			foreach ($messages as $j => $message)
			{
				$message->classroom_name = "-";
				$message->cources_name = "-";
				
				$classroom = $this->ClassroomModel->getOne(array('classroomid' => $message->classroom_id));
				if (isset($classroom) && is_object($classroom) && $classroom != false)
				{
					$message->classroom_name = $classroom->classroom_name;
				}
				
				$cources = $this->CourcesModel->getOne(array('courcesid' => $message->cources_id));
				if (isset($cources) && is_object($cources) && $cources != false)
				{
					$message->cources_name = $cources->cources_name;
				}
				
				$member = $this->UserModel->getOne(array('memberid' => $message->user_id_from));
				$message->sender_name = $member->fullname;
				
				if ($member->member_type == 1 || $member->member_type == 2) $member_type_text = "Admin";
				else if ($member->member_type == 3 && $member->principal_stat == 0) $member_type_text = "Guru";
				else if ($member->member_type == 4) $member_type_text = "Siswa";
				else if ($member->member_type == 3 && $member->principal_stat == 1) $member_type_text = "Kepsek";
				else if ($member->member_type == 3 && $member->principal_stat == 2) $member_type_text = "Wakil Kepsek";
				else if ($member->member_type == 6) $member_type_text = "Pemilik Yayasan";
				else $member_type_text = "User";
				
				$message->member_type_text = $member_type_text;	
				
				$message->reply_status = 0;
				$cek_message = $this->db->query("
					SELECT * FROM b_message
					WHERE reply_message_id = '$message->messageid' OR messageid = '$message->reply_message_id'
					ORDER BY datez DESC LIMIT 0, 1 
				");				
				$message_reply = $cek_message->result();
				if (isset($message_reply) && count($message_reply) > 0)
				{
					$message->reply_status = 1;
				}
			}
		}
		
		$get_dbmaster = $this->connectdb($this->basedb . 'school_master');
		
		//echo "<pre>";
		//var_dump($messages);
		
		$cnt = array(
			'menu_id' => $menu_id, 
			'menu_name' => $menu_name,
			'student_id' => $student_id,
			'school_id' => $school_id,
			'messages' => $messages
		);
		
		$this->load_content("admin/student/inbox", $cnt);     
    }
	
	public function student_inbox_detail($message_id = "", $student_id = '', $school_id = '')
	{
		$menu_id = "38";
		$menu_name = "Message - Inbox Detail";
		
		$school = $this->SchoolModel->getOne(array('schoolid' => $school_id));
		
		$school_code = $school->school_code;
		$school_code_tb = strtolower($school_code);
		$school_dbase = $this->basedb . "school_client_$school_code_tb";
		$get_dbclient = $this->connectdb($school_dbase);
		if ($get_dbclient)
		{
			$this->load->model("client/ClassroomModel");
			$this->load->model("client/CourcesModel");
			$this->load->model("client/MessageModel");
			
			$message = $this->MessageModel->getOne(array('messageid' => $message_id), array('*, DATE_FORMAT(datez, "%d %b %Y (%h:%i %p)") AS datez_ok'));
			
			$sender_name = "-";
			$sender = $this->UserModel->getOne(array('memberid' => $message->user_id_from));		
			if (isset($sender) && is_object($sender) && $sender != false)
			{
				if ($sender->member_type == 1 || $sender->member_type == 2) $member_type_text = "Admin";
				else if ($sender->member_type == 3 && $sender->principal_stat == 0) $member_type_text = "Guru";
				else if ($sender->member_type == 4) $member_type_text = "Siswa";
				else if ($sender->member_type == 3 && $sender->principal_stat == 1) $member_type_text = "Kepsek";
				else if ($sender->member_type == 3 && $sender->principal_stat == 2) $member_type_text = "Wakil Kepsek";
				else if ($sender->member_type == 6) $member_type_text = "Pemilik Yayasan";
				else $member_type_text = "User";
				
				$sender_name = "$sender->fullname ($member_type_text)";
			}
			
			$classroom_name = "-";
			$classroom = $this->ClassroomModel->getOne(array('classroomid' => $message->classroom_id));		
			if (isset($classroom) && is_object($classroom) && $classroom != false)
			{
				$classroom_name = $classroom->classroom_name;
			}
			
			$cources_name = "-";
			$cources = $this->CourcesModel->getOne(array('courcesid' => $message->cources_id));
			if (isset($cources) && is_object($cources) && $cources != false)
			{
				$cources_name = $cources->cources_name;
				
			}
			
			$message->sender_name = $sender_name;	
			$message->classroom_name = $classroom_name;
			$message->cources_name = $cources_name;
			
			$get_message = $this->db->query("
				SELECT *, DATE_FORMAT(datez, '%d %b %Y (%h:%i %p)') AS datez_ok
				FROM b_message
				WHERE message_type = '2' AND reply_message_id = '$message_id'
				ORDER BY datez ASC
			");				
			$reply_messages = $get_message->result();
			
			foreach ($reply_messages as $j => $reply_message)
			{
				$sender_name = "-";
				$sender = $this->UserModel->getOne(array('memberid' => $reply_message->user_id_from));		
				if (isset($sender) && is_object($sender) && $sender != false)
				{
					if ($sender->member_type == 1 || $sender->member_type == 2) $member_type_text = "Admin";
					else if ($sender->member_type == 3 && $sender->principal_stat == 0) $member_type_text = "Guru";
					else if ($sender->member_type == 4) $member_type_text = "Siswa";
					else if ($sender->member_type == 3 && $sender->principal_stat == 1) $member_type_text = "Kepsek";
					else if ($sender->member_type == 3 && $sender->principal_stat == 2) $member_type_text = "Wakil Kepsek";
					else if ($sender->member_type == 6) $member_type_text = "Pemilik Yayasan";
					else $member_type_text = "User";
					
					$sender_name = "$sender->fullname ($member_type_text)";
				}
				$reply_message->sender_name = $sender_name;
				
			}
		}
		
		$get_dbmaster = $this->connectdb($this->basedb . 'school_master');
		
		//echo "<pre>";
		//var_dump($message);
		
		$cnt = array(
			'menu_id' => $menu_id, 
			'menu_name' => $menu_name,
			'message' => $message,
			'reply_messages' => $reply_messages,
			'message_id' => $message_id,
			'student_id' => $student_id,
			'school_id' => $school_id
		);
		
		$this->load_content("admin/student/inbox_detail", $cnt);
	}
	
	
	public function send_message()
    {
		$menu_id = "42";
		$menu_name = "Send Message to Teacher";
		
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
			
			$teachers = null;
			$cources = null;
			if (isset($classroom) && is_object($classroom) && $classroom != false)
			{
				$get_teacher = $this->db->query("
					SELECT * FROM b_member
					WHERE publish = '1'
					AND memberid IN (SELECT DISTINCT teacher_id FROM b_classroom_schedule_time WHERE classroom_id='$classroom_id')
					ORDER BY fullname ASC
				");
				$teachers = $get_teacher->result();
				
				$get_cources = $this->db->query("SELECT DISTINCT courcesid, cources_name FROM b_classroom_schedule_time, b_cources WHERE b_classroom_schedule_time.cources_id=b_cources.courcesid AND cources_publish = 1 AND classroom_id='$classroom_id'");
				$cources = $get_cources->result();
			}
			
			$get_dbmaster = $this->connectdb($this->basedb . 'school_master');
			
			$cnt = array(
				'menu_id' => $menu_id, 
				'menu_name' => $menu_name,
				'teachers' => $teachers,
				'cources' => $cources,
				'classroom_id' => $classroom_id,
				'classroom' => $classroom,
				'school_id' => $school_id,
				'school' => $school
			);
			
			$this->load_content("admin/student/class_message_add", $cnt); 

		}
		
		$get_dbmaster = $this->connectdb($this->basedb . 'school_master');
    }
	
	public function insert_messagedb()
    {
		$menu_id = "-1";
        $menu_name = "Send Message to Teacher";
		$datez = date('Y-m-d H:i:s');
		
		$student_id = $this->session->userdata("schoolp_children_id");
		
		$classroom_id = $this->input->post('classroom_id');
		$teacher_id  = $this->input->post('teacher_id');
		$cources_id  = $this->input->post('cources_id');
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
		
		$message_alert = "Pesan telah terkirim.";
		$this->session->set_userdata("message_alert", $message_alert);
		
		redirect('message/send_message');
    }
	
	
}
