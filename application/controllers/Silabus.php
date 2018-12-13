<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class silabus extends Core_Controller
{

    function __construct()
    {
        parent::__construct();		
		
		$this->checkAuth();
        $this->load->model("UserModel");
		$this->load->model("ParentStudentModel");		
				
		$this->scyear_id = $this->session->userdata("schoolp_scyear_id");
    }
	
    public function index()
    {
		$menu_id = "43";
		$menu_name = "Silabus";  
		
		$member_id = $this->session->userdata("schoolp_children_id");
		
		$dataDetail = $this->ParentStudentModel->getOne(array('student_id' => $member_id));
		$school_id = $dataDetail->school_id;
		
		$school = $this->SchoolModel->getOne(array('schoolid' => $school_id));
		
		$school_code = $school->school_code;
		$school_code_tb = strtolower($school_code);
		$school_dbase = $this->basedb . "school_client_$school_code_tb";
		$get_dbclient = $this->connectdb($school_dbase);
		if ($get_dbclient)
		{			
			$this->load->model("client/EducationLevelModel");
			$this->load->model("client/CourcesModel");
			$this->load->model("client/CourcesSilabusModel");
			$this->load->model("client/ClassroomModel");
			$this->load->model("client/ClassroomStudentModel");
			
			$classroom_id = "-1";
			$studentclassroom = $this->ClassroomStudentModel->getOne(array('student_id' => $member_id), array('classroom_id'));		
			if (isset($studentclassroom) && is_object($studentclassroom) && $studentclassroom != false)
			$classroom_id = $studentclassroom->classroom_id;
			
			$classroom = $this->ClassroomModel->getOne(array('classroomid' => $classroom_id), array('edulevel_id'));		
			$edulevel_id = $classroom->edulevel_id;
					
			$get_data = $this->db->query("
				SELECT DISTINCT b_cources_silabus.*, DATE_FORMAT(b_cources_silabus.datez, '%d %b %Y <br> (%h:%i %p)') AS datez_ok
				FROM b_cources_silabus, b_classroom_schedule_time
				WHERE b_cources_silabus.cources_id = b_classroom_schedule_time.cources_id
				AND b_cources_silabus.member_id = b_classroom_schedule_time.teacher_id
				ANd b_cources_silabus.edulevel_id = '$edulevel_id'
				ANd b_classroom_schedule_time.classroom_id = '$classroom_id'
				AND b_cources_silabus.scyear_id = '$this->scyear_id'
				ORDER BY datez DESC
			");
			
			$dataDetails = $get_data->result();
				
			foreach ($dataDetails as $j => $dataDetail)
			{
				$edulevel_name = "-";
				$edulevel = $this->EducationLevelModel->getOne(array('edulevelid' => $dataDetail->edulevel_id));
				if (isset($edulevel) && is_object($edulevel) && $edulevel != false) $edulevel_name = "$edulevel->edulevel_name";
				$dataDetail->edulevel_name = $edulevel_name;
				
				$cources_name = "-";
				$cources = $this->CourcesModel->getOne(array('courcesid' => $dataDetail->cources_id));
				if (isset($cources) && is_object($cources) && $cources != false) $cources_name = "$cources->cources_name";
				$dataDetail->cources_name = $cources_name;
				
				$teacher_name = "-";
				$teacher = $this->UserModel->getOne(array('memberid' => $dataDetail->member_id));
				if (isset($teacher) && is_object($teacher) && $teacher != false) $teacher_name = "$teacher->fullname";
				$dataDetail->teacher_name = $teacher_name;
				
			}
			
		}
		
		$get_dbmaster = $this->connectdb($this->basedb . 'school_master');	
				
		$cnt = array(
		  'menu_id' => $menu_id, 
		  'menu_name' => $menu_name,
		  'dataDetails' => $dataDetails
		);
		
		$this->load_content("admin/student/silabus", $cnt);
        
    }
	
}
