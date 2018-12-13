<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class assessment extends Core_Controller
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

	public function add_assessment()
    {
		$menu_id = "40";
		$menu_name = "Teacher Assessment";
		
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
			if (isset($classroom) && is_object($classroom) && $classroom != false)
			{
				$get_teacher = $this->db->query("
					SELECT * FROM b_member
					WHERE publish = '1'
					AND memberid IN (SELECT DISTINCT teacher_id FROM b_classroom_schedule_time WHERE classroom_id='$classroom_id')
					ORDER BY fullname ASC
				");
				$teachers = $get_teacher->result();
			}
			
			$get_dbmaster = $this->connectdb($this->basedb . 'school_master');
			
			$cnt = array(
				'menu_id' => $menu_id, 
				'menu_name' => $menu_name,
				'school_id' => $school_id,
				'classroom_id' => $classroom_id,
				'student_id' => $student_id,
				'teachers' => $teachers,
				'classroom' => $classroom,
				'school' => $school
			);
			
			$this->load_content("admin/student/teacher_assessment", $cnt); 

		}
		
		$get_dbmaster = $this->connectdb($this->basedb . 'school_master');
    }
	
	public function insert_db()
    {
		$menu_id = "-1";
		$menu_name = "Teacher Assessment - Add";
		
		$student_id  = $this->input->post('student_id');
		$classroom_id  = $this->input->post('classroom_id');
		$school_id  = $this->input->post('school_id');
		$rating  = $this->input->post('rating');
		$comment  = $this->input->post('comment');
		$teacher_id  = $this->input->post('teacher_id');
		
		$parent_id = $this->session->userdata("schoolp_member_id");
		
		$parent = $this->UserModel->getOne(array('memberid' => $parent_id));		
		$parent_text = "$parent->fullname ($parent->member_code)";
		$parent_name = "$parent->fullname";
		
		$school = $this->SchoolModel->getOne(array('schoolid' => $school_id));
		
		$school_code = $school->school_code;
		$school_code_tb = strtolower($school_code);
		$school_dbase = $this->basedb . "school_client_$school_code_tb";
		$get_dbclient = $this->connectdb($school_dbase);
		if ($get_dbclient)
		{
			$this->load->model("client/ClassroomModel");
			$this->load->model("client/TeacherAssessmentModel");
			
			$classroom = $this->ClassroomModel->getOne(array('classroomid' => $classroom_id));
			
			$student = $this->UserModel->getOne(array('memberid' => $student_id));			
			$student_name = "$student->fullname ($student->member_code)";
			
			$teacher = $this->UserModel->getOne(array('memberid' => $teacher_id));			
			$teacher_name = "$teacher->fullname ($teacher->member_code)";
			
			$datez = date('Y-m-d H:i:s');
						
			$query_db = array(
				'teacher_id' => $teacher_id,
				'classroom_id' => $classroom_id,
				'rating' => $rating,
				'comment' => $comment,
				'student_id' => $student_id,
				'status' => 1,
				'datez' => $datez,
				'parent_name' => $parent_name,
				'parent_id' => $parent_id
			);
				 
			$ins_into_db = $this->TeacherAssessmentModel->save($query_db);
		}
		$get_dbmaster = $this->connectdb($this->basedb . 'school_master');
		
		$comment = str_replace("\r\n", "<br>", $comment);
		
		$menu_title = "TEACHER ASSESSMENT";
		$menu_desc =  "School: $school->school_name <br> Parent: $parent_text <br> Classroom: $classroom->classroom_name <br> Student: $student_name <br> Teacher: $teacher_name <br> Rating: $rating <br> Comment: $comment";
		$menu_detail = "";
		$menu_action = "ADD";
		$this->activitydb($menu_title, $menu_desc, $menu_detail, $menu_action);
		
		$message_alert = "Penilaian Guru teah diajukan.";
		$this->session->set_userdata("message_alert", $message_alert);
		
		redirect('assessment/add_assessment');
    }
	
	

}
