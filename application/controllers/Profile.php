<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class profile extends Core_Controller
{

    function __construct()
    {
        parent::__construct();
		
		$this->checkAuth();
        $this->load->model("UserModel");
		$this->load->model("ReligionModel");
    }

    public function index()
    {
		$menu_id = "-1";
		$menu_name = "Profile";
		
		$fields = array('*, DATE_FORMAT(lastlogin,"%d %M %Y (%h:%i %p)") as lastlogin_ok');
		$criteria = array(
		  'memberid' => $this->session->userdata("schoolp_member_id")
		);
		$member = $this->UserModel->getOne($criteria, $fields);
		$loginFrom = $this->session->userdata('loginFrom');			
		$cnt = array(
			'menu_id' => $menu_id, 
			'menu_name' => $menu_name,
			'member' => $member,
			'login_from' => $loginFrom
		);
		
		$this->load_content("admin/profile/index", $cnt);
    }
	
	public function editprofile()
    {
		$menu_id = "-1";
		$menu_name = "Edit Profile";
		
		$fields = array('*');
		$criteria = array(
		  'memberid' => $this->session->userdata("schoolp_member_id")	  
		);
		$member = $this->UserModel->getOne($criteria, $fields);
		
		$religions = $this->ReligionModel->getByCriteria(array('religion_status' => 1), null, 0, 0, null, array('religion_name', 'ASC'));
		
		$cnt = array(
		  'menu_id' => $menu_id, 
		  'menu_name' => $menu_name,
		  'religions' => $religions,
		  'member' => $member
		);
		
		$this->load_content("admin/profile/profile_edit", $cnt);
    }
	
	public function updatedb()
    {
		$menu_id = "-1";
		$menu_name = "Edit Profile";
		$upload_dir = './assets/images/profile';
		
		$fullname = $this->input->post('fullname');
		$parent_nik = $this->input->post('parent_nik');
        $email = $this->input->post('email');
        $mobile_phone = $this->input->post('mobile_phone');
		$gender = $this->input->post('gender');
		$religion = $this->input->post('religion');
		$address = $this->input->post('address');
		$relation = $this->input->post('relation');
		$birth_place = $this->input->post('birth_place');
		
		$birth_day = $this->input->post('birth_day');
		$birth_month = $this->input->post('birth_month');
		$birth_year = $this->input->post('birth_year');
		$birth_date_txt = "$birth_day-$birth_month-$birth_year";
		$birth_date = "$birth_year-$birth_month-$birth_day";
		
		$parent_nik = trim($parent_nik);
		$email = trim($email);
		$mobile_phone = trim($mobile_phone);
		
		$picture_old = $this->input->post('picture_old');
		$member_id = $this->session->userdata("schoolp_member_id");
		
		$cek_member = $this->db->query("SELECT memberid FROM b_member WHERE memberid <> $member_id AND (parent_nik='$parent_nik' OR email='$email')");
		
		$total_member = $cek_member->num_rows();
		if ($total_member == 0)
		{
			if(!empty($_FILES['picture']['name']))
			{
				$randomString = $this->RandomString(20);
				$file_name = "$randomString.jpg";
                $config['upload_path'] = $upload_dir;
                $config['allowed_types'] = 'jpg|jpeg|png|gif';
				$config['file_name'] = "mm_$file_name";
				
                //Load upload library and initialize configuration
                $this->load->library('upload');
                $this->upload->initialize($config);
                
                if ($this->upload->do_upload('picture'))
				{
					$uploadData = $this->upload->data();
					
					$file_size = $uploadData['file_size'];
					$file_path = $uploadData['file_path'];
					$path_source = $uploadData['full_path'];
					
					$new_thumb = $file_path . "ss_$file_name";
					copy($path_source, $new_thumb);					  
					//print_r($uploadData);

					$config['image_library'] = 'gd2';
					$config['source_image'] = $path_source;
					$config['quality'] = '80';
					$config['maintain_ratio'] = TRUE;
					$config['width'] = 300;
					$config['height'] = 300;                    
				  
					$this->load->library('image_lib');
					$this->image_lib->initialize($config);
					$this->image_lib->resize();
					$this->image_lib->clear();
					
					$config['image_library'] = 'gd2';
					$config['source_image'] = $new_thumb;
					$config['quality'] = '80';
					$config['maintain_ratio'] = TRUE;
					$config['width'] = 100;
					$config['height'] = 100;                    
				  
					$this->load->library('image_lib');
					$this->image_lib->initialize($config);
					$this->image_lib->resize();
					$this->image_lib->clear();
					
					$picture = $file_name;
					
					if (isset($picture_old) && $picture_old <> "")
					{
						$fileglobss = $upload_dir."/"."ss_$picture_old";
						if (file_exists($fileglobss)) unlink ("assets/images/profile/ss_$picture_old");						
						$fileglobmm = $upload_dir."/"."mm_$picture_old";
						if (file_exists($fileglobmm)) unlink ("assets/images/profile/mm_$picture_old");
					}
                }
				else
				{
                    $picture = '';
                }
				
            }
			else
			{
                $picture = $picture_old;
            }
			
			$remove_file  = $this->input->post('remove_file');
			if (isset($remove_file))
			{
				$fileglobss = $upload_dir."/"."ss_$picture_old";
				if (file_exists($fileglobss)) unlink ("assets/images/profile/ss_$picture_old");
				$fileglobmm = $upload_dir."/"."mm_$picture_old";
				if (file_exists($fileglobmm)) unlink ("assets/images/profile/mm_$picture_old");
				$picture = '';
			}
			
			$datez = date('Y-m-d H:i:s');
		
			$query_db = array(
				'fullname' => $fullname,
				'parent_nik' => $parent_nik,
				'email' => $email,
				'mobile_phone' => $mobile_phone,
				'relation' => $relation,
				'gender' => $gender,
				'religion' => $religion,
				'birth_date' => $birth_date,
				'birth_place' => $birth_place,
				'address' => $address,
				'picture' => $picture,				
				'lastupdate' => $datez
			);
			
			$member = $this->UserModel->getOne(array('memberid' => $member_id));
			$menu_title = "PARENT PROFILE";
			$menu_desc =  "Edit Profile";
			$menu_detail = "OLD<br>---<br> Name: $member->fullname <br> NIK: $member->parent_nik <br> Email: $member->email <br> Mobile Phone: $member->mobile_phone <br> Relation: $member->relation <br> Gender: $member->gender <br> Religion: $member->religion <br> Birth Place: $member->birth_place <br> Birth Date: $member->birth_date <br> Address: $member->address <br><br>NEW<br>---<br> Name: $fullname <br> NIK: $parent_nik <br> Email: $email <br> Mobile Phone: $mobile_phone <br> Relation: $relation <br> Gender: $gender <br> Religion: $religion <br> Birth Place: $birth_place <br> Birth Date: $birth_date_txt <br> Address: $address";
			$menu_action = "EDIT";
			$this->activitydb($menu_title, $menu_desc, $menu_detail, $menu_action);
			 
			$delivery_id = $this->UserModel->save($query_db, array('memberid' => $member_id));
			 
			$err_message = "<div class='alert-box success'><span>berhasil &nbsp;&nbsp; </span> profil telah di Ubah.</div>";			
			$this->session->set_userdata("err_message", $err_message);
			
			redirect('profile');
		}
		else
		{
			$err_message = "<div class='alert-box warning'><span>Peringatan &nbsp;&nbsp; </span> NIK / Email sudah ada, silahkan masukkan NIK / Email yang lain.</div>";
		}
		
		$member = $this->UserModel->getOne(array('memberid' => $member_id));
		
		$cnt = array(
		  'menu_id' => $menu_id, 
		  'menu_name' => $menu_name,
		  'member' => $member,
		  'err_message' => $err_message
		);
		
		$this->load_content("admin/profile/profile_edit", $cnt);
		
    }
	
	public function change_password()
    {
		$menu_id = "-1";
		$menu_name = "Home";		
		
		$cnt = array(
		  'menu_id' => $menu_id, 
		  'menu_name' => $menu_name
		);
		
		$this->load_content("admin/profile/changepassword", $cnt);     
    }
	
	public function changepassdb()
    {
		$menu_id = "-1";
		$menu_name = "Home";
		
		$old_password  = $this->input->post('old_password');
		$new_password  = $this->input->post('new_password');
		$verify_password  = $this->input->post('new_password_confirm');
		if($new_password != $verify_password)
		{
			$err_message = "<div class='alert-box warning'><span>peringatan &nbsp;&nbsp; </span> Kata Sandi baru dan kata sandi verifikasi tidak cocok.</div>";				
			$this->session->set_userdata("err_message", $err_message);
		}
		else
		{
			$criteria = array(
				'memberid' => $this->session->userdata("schoolp_member_id"),
			  );
			$cek_user = $this->UserModel->getOne($criteria);	
			$userPassword = $cek_user->password;	
			if (password_verify(base64_encode($old_password), $userPassword)) 
			{
				$query_db = array(
					'password' => password_hash(base64_encode($new_password), PASSWORD_DEFAULT)
				);
				 
				$upd_db_id = $this->UserModel->save($query_db, array('memberid' => $this->session->userdata("schoolp_member_id")));
				
				$employee = $this->UserModel->getOne(array('memberid' => $this->session->userdata("schoolp_member_id")));
				$menu_title = "CHANGE PASSWORD";
				$menu_desc =  "Edit Member from backend: $employee->fullname";
				$menu_detail = "";
				$menu_action = "CHANGE";
				$this->activitydb($menu_title, $menu_desc, $menu_detail, $menu_action);
				
				$err_message = "<div class='alert-box success'><span>berhasil &nbsp;&nbsp; </span> Kata Sandi telah berubah.</div>";		
				$this->session->set_userdata("err_message", $err_message);
			}
			else
			{
				$err_message = "<div class='alert-box warning'><span>peringatan &nbsp;&nbsp; </span> Kata Sandi lama yang anda masukkan salah.</div>";				
				$this->session->set_userdata("err_message", $err_message);
			}
		}	
		redirect('profile/change_password');   
    }
}
