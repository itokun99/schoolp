<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class children extends Core_Controller
{

    function __construct()
    {
        parent::__construct();
		
		$this->checkAuth();
        $this->load->model("UserModel");
		$this->load->model("SchoolModel");
		$this->load->model("ParentStudentModel");
		$this->load->library('user_agent');
		
		$this->scyear_id = $this->session->userdata("schoolp_scyear_id");
    }

    public function index()
    {
		$this->load->view('contents/error/error_page');
    }
	
	
	public function profile()
    {			
		$menu_id = "30";
		$menu_name = "Children Profile";
		
		$children_id = $this->session->userdata("schoolp_children_id");
		
		$student = array();
		$school_name = "-";
		
		$dataDetail = $this->ParentStudentModel->getOne(array('student_id' => $children_id));
		$school_id = $dataDetail->school_id;		
				
		$school = $this->SchoolModel->getOne(array('schoolid' => $dataDetail->school_id));
		$school_code = $school->school_code;
		$school_code_tb = strtolower($school_code);
		$school_dbase = $this->basedb . "school_client_$school_code_tb";
		$get_dbclient = $this->connectdb($school_dbase);
		if ($get_dbclient)
		{			
			$this->load->model("client/StudentDetailModel");
			$this->load->model("client/StudentParentModel");
			$this->load->model("client/ClassroomModel");
			$this->load->model("client/EducationLevelModel");
			
			$student = $this->UserModel->getOne(array('memberid' => $children_id), array('*, DATE_FORMAT(lastlogin,"%d %M %Y (%h:%i %p)") as lastlogin_ok'));
						
			$get_class = $this->db->query("
				SELECT classroomid FROM b_classroom, b_classroom_student
				WHERE b_classroom.classroomid = b_classroom_student.classroom_id
				AND b_classroom.classroom_publish = '1'
				AND b_classroom_student.student_id = '$children_id'
			");

			$classroom_id = 0;
			$classroom_name = "-";
			if ($get_class->num_rows() <> 0)
			{
				$class_ok = $get_class->result();
				foreach ($class_ok AS $class_ok)
				$classroom_id = $class_ok->classroomid;
			
				$classroom = $this->ClassroomModel->getOne(array('classroomid' => $classroom_id));
				
				$classroom_name = "$classroom->classroom_name";
			}
			
			$edulevel_name = "-";
			$edulevel = $this->EducationLevelModel->getOne(array('edulevelid' => $student->edulevel_id));
			if (isset($edulevel) && is_object($edulevel) && $edulevel != false) $edulevel_name = "$edulevel->edulevel_name";

			$school_name = "$school->school_name";
			
			$student->school_name = $school_name;
			$student->classroom_name = $classroom_name;
			$student->edulevel_name = $edulevel_name;
			
			$student_detail = $this->StudentDetailModel->getOne(array('student_id' => $children_id));
			$parent_details = $this->StudentParentModel->getByCriteria(array('student_id' => $children_id));
			
		}
		$get_dbmaster = $this->connectdb($this->basedb . 'school_master');
	
		$cnt = array(
			'menu_id' => $menu_id, 
			'menu_name' => $menu_name,
			'data' => $student,
			'student_detail' => $student_detail,
			'parent_details' => $parent_details
		);
		
		$this->load_content("admin/student/profile", $cnt);
    }
	
	public function edit_profile()
    {
		$menu_id = "-1";
		$menu_name = "Edit Children";
		
		$student_id = $this->session->userdata("schoolp_children_id");
		
		$school_name = "-";
		
		$dataDetail = $this->ParentStudentModel->getOne(array('student_id' => $student_id));
		$school_id = $dataDetail->school_id;		
				
		$school = $this->SchoolModel->getOne(array('schoolid' => $dataDetail->school_id));
		$school_code = $school->school_code;
		$school_code_tb = strtolower($school_code);
		$school_dbase = $this->basedb . "school_client_$school_code_tb";
		$get_dbclient = $this->connectdb($school_dbase);
		if ($get_dbclient)
		{			
			$this->load->model("client/StudentDetailModel");
			$this->load->model("client/StudentParentModel");
			$this->load->model("client/ReligionModel");
			$this->load->model("client/EducationLevelModel");
						
			$student = $this->UserModel->getOne(array('memberid' => $student_id));
			$studentDetail = $this->StudentDetailModel->getOne(array('student_id' => $student_id));
			$parentAyah = $this->StudentParentModel->getOne(array('student_id' => $student_id, 'parent_type' => 'Ayah'));
			$parentIbu = $this->StudentParentModel->getOne(array('student_id' => $student_id, 'parent_type' => 'Ibu'));
			$parentWali = $this->StudentParentModel->getOne(array('student_id' => $student_id, 'parent_type' => 'Wali'));
			
			$religions = $this->ReligionModel->getByCriteria(array('religion_status' => 1), null, 0, 0, null, array('religion_name', 'ASC'));
			
			$edulevel_name = "-";
			$edulevel = $this->EducationLevelModel->getOne(array('edulevelid' => $student->edulevel_id));
			if (isset($edulevel) && is_object($edulevel) && $edulevel != false) $edulevel_name = "$edulevel->edulevel_name";

			$student->edulevel_name = $edulevel_name;
			
		}
		$get_dbmaster = $this->connectdb($this->basedb . 'school_master');
				
		
		$cnt = array(
		  'menu_id' => $menu_id, 
		  'menu_name' => $menu_name,
		  'student' => $student,
		  'studentDetail' => $studentDetail,
		  'parentAyah' => $parentAyah,
		  'parentIbu' => $parentIbu,
		  'parentWali' => $parentWali,
		  'religions' => $religions,
		  'student_id' => $student_id
		);
		
		$this->load_content("admin/student/student_edit", $cnt);        
    }
	
	public function updatedb()
    {
		$menu_id = "-1";
        $menu_name = "Edit Student";
		
		$student_id  = $this->input->post('student_id');
        $fullname  = $this->input->post('fullname');
        $email  = $this->input->post('email');
        $mobile_phone  = $this->input->post('mobile_phone');
		$gender = $this->input->post('gender');
		$religion = $this->input->post('religion');
		$address = $this->input->post('address');
				
		$birth_day = $this->input->post('birth_day');
		$birth_month = $this->input->post('birth_month');
		$birth_year = $this->input->post('birth_year');
		$birth_date_txt = "$birth_day-$birth_month-$birth_year";
		$birth_date = "$birth_year-$birth_month-$birth_day";
        
		$birth_place = $this->input->post('birth_place');
		$citizen_status	= $this->input->post('citizen_status');
		$nik = $this->input->post('nik');
		
		$rombel = $this->input->post('rombel');
		$special_needs = $this->input->post('special_needs');
		$rt = $this->input->post('rt');
		$rw = $this->input->post('rw');
		$dusun = $this->input->post('dusun');
		$kelurahan = $this->input->post('kelurahan');
		$kecamatan = $this->input->post('kecamatan');
		$post_code = $this->input->post('post_code');
		$jenis_tinggal = $this->input->post('jenis_tinggal');
		$transportasi = $this->input->post('transportasi');
		$latitude = $this->input->post('latitude');
		$longitude = $this->input->post('longitude');
		$home_phone = $this->input->post('home_phone');
		$skhun = $this->input->post('skhun');
		$penerima_kps = $this->input->post('penerima_kps');
		$no_kps = $this->input->post('no_kps');
		$map_detail_parent = $this->input->post("surveymap",true);
		
		$school_name = "-";
		
		$dataDetail = $this->ParentStudentModel->getOne(array('student_id' => $student_id));
		$school_id = $dataDetail->school_id;		
				
		$school = $this->SchoolModel->getOne(array('schoolid' => $dataDetail->school_id));
		$school_code = $school->school_code;
		$school_code_tb = strtolower($school_code);
		$school_dbase = $this->basedb . "school_client_$school_code_tb";
		$get_dbclient = $this->connectdb($school_dbase);
		if ($get_dbclient)
		{			
			$this->load->model("client/StudentDetailModel");
			$this->load->model("client/StudentParentModel");
			$this->load->model("client/ReligionModel");
			$this->load->model("client/EducationLevelModel");
			
			$cek_student = $this->db->query("SELECT memberid FROM b_member WHERE memberid <> '$student_id' AND (nik = '$nik' OR email = '$email') AND email <> ''");
		
			$total_student = $cek_student->num_rows();
			if ($total_student == 0)
			{
				$datez = date('Y-m-d H:i:s');
			
				$query_db = array(
					'username' => $fullname,
					'fullname' => $fullname,
					'email' => $email,
					'mobile_phone' => $mobile_phone,
					'gender' => $gender,
					'religion' => $religion,
					'address' => $address,
					'edulevel_id' => $edulevel_id,
					'birth_date' => $birth_date,
					'birth_place' => $birth_place,
					'nik' => $nik,
					'citizen_status' => $citizen_status,
					'lastupdate' => $datez
				);	
				
				$edulevel_name = "";
				$edulevel = $this->EducationLevelModel->getOne(array('edulevelid' => $edulevel_id));
				if (isset($edulevel) && is_object($edulevel) && $edulevel != false) $edulevel_name = "$edulevel->edulevel_name";
				
				$student = $this->UserModel->getOne(array('memberid' => $student_id));
				$edulevel_name_old = "";
				$edulevel_old = $this->EducationLevelModel->getOne(array('edulevelid' => $student->edulevel_id));
				if (isset($edulevel_old) && is_object($edulevel_old) && $edulevel_old != false) $edulevel_name_old = "$edulevel_old->edulevel_name";
				
				$parent_detail_text = "<br><br><b>Data Orangtua</b>:<br>---";			
				foreach ($map_detail_parent as $map_detail)
				{
					$parent_type = $map_detail['parent_type'];
					$parent_name = $map_detail['parent_name'];
					$type_warga = $map_detail['type_warga'];
					$parent_nik = $map_detail['parent_nik'];
					$parent_birth_place = $map_detail['parent_birth_place'];
					$pbirth_day = $map_detail['pbirth_day']; 
					$pbirth_month = $map_detail['pbirth_month'];
					$pbirth_year = $map_detail['pbirth_year'];
					$parent_home_phone = $map_detail['parent_home_phone'];
					$parent_phone = $map_detail['parent_phone'];
					$parent_email = $map_detail['parent_email'];
					$parent_education = $map_detail['parent_education'];
					$employment = $map_detail['employment'];
					$company_name = $map_detail['company_name'];
					$workplace_address = $map_detail['workplace_address'];
					$office_latitude = $map_detail['office_latitude'];
					$office_longitude = $map_detail['office_longitude'];
					$parent_income = $map_detail['parent_income'];
					$parent_address = $map_detail['parent_address'];
					$parent_latitude = $map_detail['parent_latitude'];
					$parent_longitude = $map_detail['parent_longitude'];
					$pbirth_date = "$pbirth_year-$pbirth_month-$pbirth_day";
					
					$parent_detail_text = "$parent_detail_text <br><br> <b>$parent_type</b><br>----- <br> Name: $parent_name <br> Kewarganegaraan: $type_warga <br> NIK / NIORA: $parent_nik <br> Tempat Lahir : $parent_birth_place <br> Tanggal Lahir : $pbirth_date <br> Telephone Rumah : $parent_home_phone <br> Handphone : $parent_phone <br> Email : $parent_email <br> Pendidikan : $parent_education <br> Jabatan Pekerjaan : $employment <br> Nama Perusahaan : $company_name <br> Alamat Tempat Kerja : $workplace_address <br> Lintang Bujur: ($office_latitude, $office_longitude) <br> Penghasilan Perbulan : $parent_income <br> Alamat Tempat Tinggal : $parent_address <br> Lintang Bujur: ($parent_latitude, $parent_longitude)";
					
					$query_parent_db = array(
						'parent_name' => $parent_name,
						'type_warga' => $type_warga,
						'parent_nik' => $parent_nik,
						'parent_birth_place' => $parent_birth_place,
						'parent_birth_date' => $pbirth_date,
						'parent_home_phone' => $parent_home_phone,
						'parent_phone' => $parent_phone,
						'parent_email' => $parent_email,
						'parent_education' => $parent_education,
						'employment' => $employment,
						'company_name' => $company_name,
						'workplace_address' => $workplace_address,
						'office_latitude' => $office_latitude,
						'office_longitude' => $office_longitude,
						'parent_income' => $parent_income,
						'parent_address' => $parent_address,
						'parent_latitude' => $parent_latitude,
						'parent_longitude' => $parent_longitude	
					);
					
					$cek_parent = $this->StudentParentModel->getOne(array('student_id' => $student_id, 'parent_type' => $parent_type));
					if (isset($cek_parent) && is_object($cek_parent) && $cek_parent != false)
					{
						$upd_parent_into_db = $this->StudentParentModel->save($query_parent_db, array('student_id' => $student_id, 'parent_type' => $parent_type));
					}
					else
					{
						$query_parent_db = array(
							'student_id' => $student_id,
							'parent_type' => $parent_type,
							'parent_name' => $parent_name,
							'type_warga' => $type_warga,
							'parent_nik' => $parent_nik,
							'parent_birth_place' => $parent_birth_place,
							'parent_birth_date' => $pbirth_date,
							'parent_home_phone' => $parent_home_phone,
							'parent_phone' => $parent_phone,
							'parent_email' => $parent_email,
							'parent_education' => $parent_education,
							'employment' => $employment,
							'company_name' => $company_name,
							'workplace_address' => $workplace_address,
							'office_latitude' => $office_latitude,
							'office_longitude' => $office_longitude,
							'parent_income' => $parent_income,
							'parent_address' => $parent_address,
							'parent_latitude' => $parent_latitude,
							'parent_longitude' => $parent_longitude	
						);
						$upd_parent_into_db = $this->StudentParentModel->save($query_parent_db);
					}
					
				}
				
				$upd_query_db = $this->UserModel->save($query_db, array('memberid' => $student_id));
				
				$query_detail_db = array(
					'rombel' => $rombel,
					'special_needs' => $special_needs,
					'rt' => $rt,
					'rw' => $rw,
					'dusun' => $dusun,
					'kelurahan' => $kelurahan,
					'kecamatan' => $kecamatan,
					'post_code' => $post_code,
					'jenis_tinggal' => $jenis_tinggal,
					'transportasi' => $transportasi,
					'latitude' => $latitude,
					'longitude' => $longitude,
					'home_phone' => $home_phone,
					'skhun' => $skhun,
					'penerima_kps' => $penerima_kps,
					'no_kps' => $no_kps
				);
				 
				$cek_detail = $this->StudentDetailModel->getOne(array('student_id' => $student_id));
				if (isset($cek_detail) && is_object($cek_detail) && $cek_detail != false)		
				{
					$upd_detail_into_db = $this->StudentDetailModel->save($query_detail_db, array('student_id' => $student_id));
				}
				else
				{
					$query_detail_db = array(
						'student_id' => $student_id,
						'rombel' => $rombel,
						'special_needs' => $special_needs,
						'rt' => $rt,
						'rw' => $rw,
						'dusun' => $dusun,
						'kelurahan' => $kelurahan,
						'kecamatan' => $kecamatan,
						'post_code' => $post_code,
						'jenis_tinggal' => $jenis_tinggal,
						'transportasi' => $transportasi,
						'latitude' => $latitude,
						'longitude' => $longitude,
						'home_phone' => $home_phone,
						'skhun' => $skhun,
						'penerima_kps' => $penerima_kps,
						'no_kps' => $no_kps
					);
					$upd_detail_into_db = $this->StudentDetailModel->save($query_detail_db);
				}
				
				$get_dbmaster = $this->connectdb($this->basedb . 'school_master');
		
				$menu_title = "PARENT - CHILDREN";
				$menu_desc =  "Edit Children Profile: $fullname ($student->member_code)";
				$menu_detail = "<b>Data Siswa</b>:<br>---<br> Education Level: $edulevel_name <br> Name: $fullname <br> Gender: $gender <br> Nomor Induk Siswa (NIS): $nis <br> Nomor Induk Siswa Nasional (NISN): $nisn <br> Rombel: $rombel <br> Tempat Lahir: $birth_place <br> Tanggal Lahir: $birth_date_txt <br> Status Kewarganegaraan: $citizen_status <br> NIK / NIORA: $nik <br> Agama: $religion <br> Kebutuhan Khusus: $special_needs <br><br> <b>Alamat Tempat Tinggal</b>:<br>---<br> RT: $rt &nbsp;&nbsp;&nbsp;&nbsp; RW: $rw <br> Dusun: $dusun <br> Kelurahan: $kelurahan <br> Kecamatan: $kecamatan <br> Kode Pos: $post_code <br> Jenis Tinggal: $jenis_tinggal <br> Transportasi Menuju Sekolah: $transportasi <br> Alamat: $address <br> Lintang: $latitude <br> Bujur: $longitude <br><br> <b>Kontak Siswa</b>:<br>---<br> Telephone Rumah: $home_phone <br> Handphone: $mobile_phone <br> Email: $email <br> Surat Keterangan Ujian Negara: $skhun <br> Penerimaan KPS: $penerima_kps <br> Nomor KPS: $no_kps $parent_detail_text";
				$menu_action = "EDIT";
				$this->activitydb($menu_title, $menu_desc, $menu_detail, $menu_action);
				
				$err_message = "<div class='alert-box success'><span>success &nbsp;&nbsp; </span> Children Profile <b>$fullname ($student->member_code)</b> has been Updated.</div>";
					
				$this->session->set_userdata("err_message", $err_message);
				
				redirect('children/profile');
			
			}
			else
			{
				$err_message = "<div class='alert-box warning'><span>warning &nbsp;&nbsp; </span> NIK is already exist, please input another NIK.</div>";
				
				$student = $this->UserModel->getOne(array('memberid' => $student_id));
				$studentDetail = $this->StudentDetailModel->getOne(array('student_id' => $student_id));
				$parentAyah = $this->StudentParentModel->getOne(array('student_id' => $student_id, 'parent_type' => 'Ayah'));
				$parentIbu = $this->StudentParentModel->getOne(array('student_id' => $student_id, 'parent_type' => 'Ibu'));
				$parentWali = $this->StudentParentModel->getOne(array('student_id' => $student_id, 'parent_type' => 'Wali'));
				
				$religions = $this->ReligionModel->getByCriteria(array('religion_status' => 1), null, 0, 0, null, array('religion_name', 'ASC'));
				
				$edulevel_name = "-";
				$edulevel = $this->EducationLevelModel->getOne(array('edulevelid' => $student->edulevel_id));
				if (isset($edulevel) && is_object($edulevel) && $edulevel != false) $edulevel_name = "$edulevel->edulevel_name";
	
				$student->edulevel_name = $edulevel_name;
				
				$cnt = array(
				  'menu_id' => $menu_id, 
				  'menu_name' => $menu_name,
				  'student' => $student,
				  'studentDetail' => $studentDetail,
				  'parentAyah' => $parentAyah,
				  'parentIbu' => $parentIbu,
				  'parentWali' => $parentWali,
				  'student_id' => $student_id,
				  'religions' => $religions,
				  'err_message' => $err_message
				);
						
				$this->load_content("admin/student/student_edit", $cnt);
			}
			
		}
		
		
		
		
    }
	
	function map($latitude = "", $longitude = "")
	{
		$menu_id = "-1";
		$menu_name = "Map";
		
		$cnt = array(
		  'menu_id' => $menu_id, 
		  'menu_name' => $menu_name,
		  'latitude' => $latitude,
		  'longitude' => $longitude
		);
		
		$this->load_page_cont("admin/student/map", $cnt);
	}
	

}
