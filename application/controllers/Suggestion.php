<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class suggestion extends Core_Controller
{

    function __construct()
    {
        parent::__construct();		
		
		$this->checkAuth();
        $this->load->model("UserModel");
		$this->load->model("SchoolModel");
		$this->load->model("ParentStudentModel");
    }

    public function index()
    {
		$this->load->view('contents/error/error_page');
    }

	public function add_suggestion()
    {
		$menu_id = "41";
		$menu_name = "Suggestion - Add";
		
		$student_id = $this->session->userdata("schoolp_children_id");
		
		$dataDetail = $this->ParentStudentModel->getOne(array('student_id' => $student_id));
		$school_id = $dataDetail->school_id;
		
		$school = $this->SchoolModel->getOne(array('schoolid' => $school_id));
		
		$cnt = array(
			'menu_id' => $menu_id, 
			'menu_name' => $menu_name,
			'school_id' => $school_id,
			'student_id' => $student_id,
			'school' => $school
		);

		$this->load_content("admin/student/suggestion_add", $cnt); 
    }
	
	public function insert_db()
    {
		$menu_id = "-1";
		$menu_name = "Suggestion - Add";
		
		$student_id  = $this->input->post('student_id');
		$school_id  = $this->input->post('school_id');
		$suggestion_cont  = $this->input->post('suggestion_cont');
		
		$member_id = $this->session->userdata("schoolp_member_id");
		
		$member = $this->UserModel->getOne(array('memberid' => $member_id));		
		$member_text = "$member->fullname ($member->member_code)";
		
		$school = $this->SchoolModel->getOne(array('schoolid' => $school_id));
		
		$school_code = $school->school_code;
		$school_code_tb = strtolower($school_code);
		$school_dbase = $this->basedb . "school_client_$school_code_tb";
		$get_dbclient = $this->connectdb($school_dbase);
		if ($get_dbclient)
		{
			$this->load->model("client/SuggestionModel");
			
			$student = $this->UserModel->getOne(array('memberid' => $student_id));
			
			$student_name = "$student->fullname ($student->member_code)";
			
			$datez = date('Y-m-d H:i:s');
						
			$query_db = array(
				'suggestion_cont' => $suggestion_cont,
				'suggestion_type' => 5,
				'suggestion_publish' => 1,
				'datez' => $datez,
				'member_id' => $student_id
			);
				 
			$ins_suggestion_into_db = $this->SuggestionModel->save($query_db);
		}
		$get_dbmaster = $this->connectdb($this->basedb . 'school_master');
		
		$suggestion_cont = str_replace("\r\n", "<br>", $suggestion_cont);
		
		$menu_title = "SUGGESTION";
		$menu_desc =  "School: $school->school_name <br> Parent: $member_text <br> Student: $student_name <br> Suggestion: $suggestion_cont";
		$menu_detail = "";
		$menu_action = "ADD";
		$this->activitydb($menu_title, $menu_desc, $menu_detail, $menu_action);
		
		$message_alert = "Pesan Saran telah dikirim.";
		$this->session->set_userdata("message_alert", $message_alert);
		
		redirect('suggestion/add_suggestion');
    }
	
	

}
