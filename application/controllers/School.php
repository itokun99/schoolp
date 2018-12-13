<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class school extends Core_Controller
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
		$menu_id = "2";
		$menu_name = "Children School";
		
		$parent_id = $this->session->userdata("schoolp_member_id");
		
		$parent = $this->UserModel->getOne(array('memberid' => $parent_id));
		if ($parent->parent_nik == "") redirect('school/nik');
		
		$dataDetails = $this->ParentStudentModel->getByCriteria(array('parstd_status' => 1, 'parent_id' => $parent_id), null, 0, 0, null, array('datez', 'DESC'));
		
		foreach ($dataDetails as $i => $dataDetail)
		{
			$school = $this->SchoolModel->getOne(array('schoolid' => $dataDetail->school_id));
			$school_code = $school->school_code;
			$school_code_tb = strtolower($school_code);
			$school_dbase = $this->basedb . "school_client_$school_code_tb";
			$get_dbclient = $this->connectdb($school_dbase);
			if ($get_dbclient)
			{
				$student_name = "-";
				$student_gender = "-";
				$student_picture = "na.jpg";
				
				$children = $this->UserModel->getOne(array('memberid' => $dataDetail->student_id));
				
				if (isset($children) && is_object($children) && $children != false)
				{
					$student_name = $children->fullname;
					$student_gender = $children->gender;
					if ($children->picture <> "") $student_picture = $children->picture;
				}
				
				$dataDetail->student_name = $student_name;
				$dataDetail->student_gender = $student_gender;
				$dataDetail->student_picture = $student_picture;
			}
			$get_dbmaster = $this->connectdb($this->basedb . 'school_master');
		}
		
		//echo "<pre>";
		//var_dump($dataDetails);
		
		$cnt = array(
		  'menu_id' => $menu_id, 
		  'menu_name' => $menu_name,
		  'dataDetails' => $dataDetails
		);
		
		$this->load_content("admin/school/index", $cnt);
    }	
	
	public function add_school()
    {
		$menu_id = "2";
		$menu_name = "Add School";
		
		$get_edulevel = $this->db->query("SELECT * FROM b_edulevel ORDER BY edulevel_name ASC");
		$edulevels = $get_edulevel->result();
		
		$get_provinsi = $this->db->query("SELECT * FROM provinsi ORDER BY nama_provinsi ASC");
		$provinsis = $get_provinsi->result();
		
		$cnt = array(
		  'menu_id' => $menu_id, 
		  'menu_name' => $menu_name,
		  'edulevels' => $edulevels,
		  'provinsis' => $provinsis
		);
		
		$this->load_content("admin/school/school_add", $cnt);
    }
	
	public function save()
    {
		$menu_id = "2";
		$menu_name = "Insert School";
		
		$datez = date('Y-m-d H:i:s');
		$parent_id = $this->session->userdata("schoolp_member_id");
		
		$school_id = $this->input->post('school_id');
        $children_nik = $this->input->post('children_nik');
		$children_nik = trim($children_nik);
		
		$parent = $this->UserModel->getOne(array('memberid' => $parent_id));		
		$school = $this->SchoolModel->getOne(array('schoolid' => $school_id));
		
		$school_code = $school->school_code;
		$school_code_tb = strtolower($school_code);
		$school_dbase = $this->basedb . "school_client_$school_code_tb";
		$get_dbclient = $this->connectdb($school_dbase);
		if ($get_dbclient)
		{
			$cek_children_parent = $this->db->query("
				SELECT memberid, fullname, nik FROM b_member
				WHERE member_type = '4'
				AND nik = '$children_nik'
				AND memberid IN (SELECT student_id FROM b_student_parent WHERE parent_nik='$parent->parent_nik')
			");
			
			if ($cek_children_parent->num_rows() <> 0)
			{
				$children = $cek_children_parent->result();
				foreach ($children AS $children)
				$student_id = $children->memberid;
				
				$get_dbmaster = $this->connectdb($this->basedb . 'school_master');
								
				//$parent_student = $this->ParentStudentModel->getOne(array('parstd_quez' => $children_code, 'parent_id' => $parent_id));
				//if (isset($parent_student) && is_object($parent_student) && $parent_student != false)
				$parent_student = $this->ParentStudentModel->getByCriteria(array('student_nik' => $children_nik));
				if (count($parent_student) > 1)
				{
					$err_message = "<div class='alert-box warning'><span>peringatan &nbsp;&nbsp; </span> Akses Anak telah digunakan. Hanya maksimum <b>2</b> Akses Akun.</div>";
					$this->session->set_userdata("err_message", $err_message);
					$message_alert = "Akses Anak telah digunakan. <br>Hanya maksimum <b>2</b> Akses Akun.";
					$this->session->set_userdata("message_alert", $message_alert);
					$this->session->set_userdata("msg_type_alert", "2");
				}
				else
				{
					$cek_exist = $this->ParentStudentModel->getOne(array('student_nik' => $children_nik, 'parent_id' => $parent_id));
					if (isset($cek_exist) && is_object($cek_exist) && $cek_exist != false)
					{
						$err_message = "<div class='alert-box warning'><span>peringatan &nbsp;&nbsp; </span> Akses Anak-anak telah digunakan dalam Akun ini. Silahkan Coba Lagi. </div>";
						$this->session->set_userdata("err_message", $err_message);
						$message_alert = "Akses Anak-anak telah digunakan dalam Akun ini. Silahkan Coba Lagi.";
						$this->session->set_userdata("message_alert", $message_alert);
						$this->session->set_userdata("msg_type_alert", "2");
					}
					else
					{
						$query_db = array(
							'parent_id' => $parent_id,
							'school_id' => $school_id,
							'student_id' => $student_id,
							'student_nik' => $children_nik,
							'parstd_status' => 1,
							'datez' => $datez,
							'member_id' => $parent_id
						);
						
						$ins_into_db = $this->ParentStudentModel->save($query_db);
						
						$menu_title = "CHILDREN SCHOOL";
						$menu_desc =  "Add Children: $children->fullname ($children->nik) <br> School: $school->school_name <br> Parent: $parent->fullname ($parent->parent_nik)";
						$menu_detail = "";
						$menu_action = "ADD";
						$this->activitydb($menu_title, $menu_desc, $menu_detail, $menu_action);
						
						$message_alert = "Children School has been added.";
						$this->session->set_userdata("message_alert", $message_alert);
						
						$this->session->set_userdata("schoolp_children_id", $student_id);
						
						redirect('school');
					}
					
					
				}
				
				
			}
			else
			{
				$err_message = "<div class='alert-box warning'><span>peringatan &nbsp;&nbsp; </span> Kode Anak tidak ada di Sekolah ini. Silahkan Coba Lagi.</div>";
				$this->session->set_userdata("err_message", $err_message);
				$message_alert = "Kode Anak tidak ada di Sekolah ini. <br>Silahkan Coba Lagi.";
				$this->session->set_userdata("message_alert", $message_alert);
				$this->session->set_userdata("msg_type_alert", "2");
			}
			
		}
		else 
		{
			$err_message = "<div class='alert-box warning'><span>peringatan &nbsp;&nbsp; </span> Kode Anak tidak ada di Sekolah ini. Silahkan Coba Lagi.</div>";
			$this->session->set_userdata("err_message", $err_message);
			$message_alert = "Kode Anak tidak ada di Sekolah ini. <br>Silahkan Coba Lagi.";
			$this->session->set_userdata("message_alert", $message_alert);
			$this->session->set_userdata("msg_type_alert", "2");
		}
		
		redirect('school/add_school');
    }
	
	
	public function remove_children($parstd_id = '')
    {
		$menu_id = "2";
		$menu_name = "Remove Children";
		
		$datez = date('Y-m-d H:i:s');
		$parent_id = $this->session->userdata("schoolp_member_id");
		
		$parent_student = $this->ParentStudentModel->getOne(array('parstdid' => $parstd_id));
		
		$parent = $this->UserModel->getOne(array('memberid' => $parent_student->parent_id));		
		$school = $this->SchoolModel->getOne(array('schoolid' => $parent_student->school_id));
		
		$student_name = "Unknown";
		
		$school_code = $school->school_code;
		$school_code_tb = strtolower($school_code);
		$school_dbase = $this->basedb . "school_client_$school_code_tb";
		$get_dbclient = $this->connectdb($school_dbase);
		if ($get_dbclient)
		{
			$children = $this->UserModel->getOne(array('memberid' => $parent_student->student_id));
			
			if (isset($children) && is_object($children) && $children != false)
			{
				$student_name = $children->fullname;
			}
			
		}
		
		$get_dbmaster = $this->connectdb($this->basedb . 'school_master');
		
		$menu_title = "CHILDREN SCHOOL";
		$menu_desc =  "Delete Children: $student_name <br> School: $school->school_name <br> Parent: $parent->fullname ($parent->member_code)";
		$menu_detail = "";
		$menu_action = "DELETE";
		$this->activitydb($menu_title, $menu_desc, $menu_detail, $menu_action);
		
		$del_children_db = $this->ParentStudentModel->delete(array('parstdid' => $parstd_id));
		
		$message_alert = "Children $student_name has been removed.";		
		
		
		$this->session->set_userdata("message_alert", $message_alert);
		
		redirect('school');
    }
	
	public function children_access($student_id = null)
    {
		if ($this->input->post('children_id')) $student_id  = $this->input->post('children_id');
		
		$this->session->set_userdata("schoolp_children_id", $student_id);		
		
		redirect('children/profile');
	}
	
	public function children_detail($student_id = '', $school_id = '', $menu_type = '')
    {
		$menu_id = "2";
		$menu_name = "Children Detail";
		
		$parent_id = $this->session->userdata("schoolp_member_id");
		$classroom = array();
		
		$school = $this->SchoolModel->getOne(array('schoolid' => $school_id));
		
		$school_code = $school->school_code;
		$school_code_tb = strtolower($school_code);
		$school_dbase = $this->basedb . "school_client_$school_code_tb";
		$get_dbclient = $this->connectdb($school_dbase);
		if ($get_dbclient)
		{
			$student = $this->UserModel->getOne(array('memberid' => $student_id));
			
			$this->load->model("client/SchoolYearModel");
			$this->load->model("client/ClassroomModel");
			$this->load->model("client/ClassroomStudentModel");
			$this->load->model("client/EducationLevelModel");
			
			$studentclassroom = $this->ClassroomStudentModel->getOne(array('student_id' => $student_id), array('classroom_id'));
			
			if (isset($studentclassroom) && is_object($studentclassroom) && $studentclassroom != false)
			{
				$classroom_id = $studentclassroom->classroom_id;
			
				$fields = array('*, DATE_FORMAT(datez, "%d %b %Y (%h:%i %p)") AS datez_ok, DATE_FORMAT(lastupdate, "%d %b %Y (%h:%i %p)") AS lastupdate_ok');
				$criteria = array(
				  'classroomid' => $classroom_id	  
				);
				$classroom = $this->ClassroomModel->getOne($criteria, $fields);
				
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
				
				$scyear_name = "";
				$scyear = $this->SchoolYearModel->getOne(array('scyearid' => $classroom->scyear_id));
				if (isset($scyear) && is_object($scyear) && $scyear != false) $scyear_name = "$scyear->scyear_name";
				$classroom->scyear_name = $scyear_name;
			}
			
			
		}
		
		$get_dbmaster = $this->connectdb($this->basedb . 'school_master');
		
		if ($menu_type <> "")
		{
			$class_menu_active = "2";
			$this->session->set_userdata("class_menu_active", $class_menu_active);
		}
		
		$cnt = array(
		  'menu_id' => $menu_id, 
		  'menu_name' => $menu_name,
		  'school' => $school,
		  'classroom' => $classroom,
		  'student' => $student
		);
		
		$this->load_content("admin/student/student_detail", $cnt);
    }
	
	public function nik()
    {
		$menu_id = "-1";
		$menu_name = "Complete Parent NIK";
		
		$parent_id = $this->session->userdata("schoolp_member_id");
				
		$cnt = array(
		  'menu_id' => $menu_id, 
		  'menu_name' => $menu_name
		);
		
		$this->load_content("admin/school/nik_add", $cnt);
    }
	
	public function save_nik()
    {
		$menu_id = "-1";
		$menu_name = "Insert Parent NIK";
		
		$datez = date('Y-m-d H:i:s');
		$parent_id = $this->session->userdata("schoolp_member_id");
		
        $parent_nik = $this->input->post('parent_nik');
		$parent_nik = trim($parent_nik);
		
		$query_db = array(
			'parent_nik' => $parent_nik,		
			'lastupdate' => $datez
		);
		$upd_parent_db = $this->UserModel->save($query_db, array('memberid' => $parent_id));
		
		$member = $this->UserModel->getOne(array('memberid' => $parent_id));
		$menu_title = "PARENT PROFILE";
		$menu_desc =  "Add NIK <br> Name: $member->fullname <br> NIK: $parent_nik";
		$menu_detail = "";
		$menu_action = "EDIT";
		$this->activitydb($menu_title, $menu_desc, $menu_detail, $menu_action);
		
		redirect('school');
    }
	
	function get_kabupaten($provinsi_id = '')
	{
		$get_kabupaten = $this->db->query("
			SELECT * FROM kabupaten
			WHERE provinsi_id = '$provinsi_id' ORDER BY nama_kabupaten ASC
		");
		
		$kabupatens = $get_kabupaten->result();
		
		$cnt = array(
		  'tb_kabupaten' => $kabupatens
		);
		
		$this->load->view("contents/admin/school/get_kabupaten", $cnt);
		
	}

	function get_kecamatan($kabupaten_id = '')
	{	
		$get_kecamatan = $this->db->query("
			SELECT * FROM kecamatan
			WHERE kabupaten_id = '$kabupaten_id'
			ORDER BY nama_kecamatan ASC
		");
		
		$kecamatan = $get_kecamatan->result();
		
		$cnt = array(
		  'tb_kecamatan' => $kecamatan
		);
		
		$this->load->view("contents/admin/school/get_kecamatan", $cnt);
	}
	
	function get_school($kecamatan_id = '', $edulevel_id = '')
	{	
		$get_school = $this->db->query("
			SELECT b_school.* FROM b_school, b_school_detail
			WHERE b_school.schoolid = b_school_detail.school_id
			AND school_publish = '1'
			AND b_school_detail.kecamatan_id = '$kecamatan_id'
			AND b_school_detail.edulevel_id = '$edulevel_id'
			ORDER BY school_name ASC LIMIT 0, 5000
		");
		$schools = $get_school->result();
		
		$cnt = array(
		  'schools' => $schools
		);
		
		$this->load->view("contents/admin/school/get_school", $cnt);
	}
	
	public function waiting()
    {      
        $this->load->view('contents/error/waiting');
    }

}
