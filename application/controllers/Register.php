<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class register extends Core_Controller
{

    function __construct()
    {
        parent::__construct();
		
        $this->load->model("UserModel");
		$this->load->model("SchoolModel");
		$this->load->model("ParentStudentModel");
    }

    public function index($school_code = '', $student_quez = '')
    {
		$menu_id = "1";
		$menu_name = "Register";
		
		$fullname = "";
		$email = "";
		$mobile_phone = "";
		$gender = "";
		$address = "";
		$relation = "";		
		
		$cnt = array(
		  'menu_id' => $menu_id, 
		  'menu_name' => $menu_name,
		  'fullname' => $fullname,
		  'email' => $email,
		  'mobile_phone' => $mobile_phone,
		  'gender' => $gender,
		  'relation' => $relation,
		  'address' => $address
		);
		
		$this->load_page("admin/login/register", $cnt);
    }
	
	public function save()
    {
		$menu_id = "1";
		$menu_name = "Register";
		
		$fullname = $this->input->post("fullname", true);
		$email = $this->input->post("email", true);
		$mobile_phone = $this->input->post("mobile_phone", true);
		$gender = $this->input->post("gender", true);
		$address = $this->input->post("address", true);
		
		$relation = $this->input->post("relation", true);
		
		$cek_parent = $this->db->query("SELECT memberid FROM b_member WHERE email = '$email' OR  	mobile_phone = '$mobile_phone'");
		
		$total_parent = $cek_parent->num_rows();
		if ($total_parent == 0)
		{			
			$get_top_parent = $this->db->query("SELECT parent_count FROM b_member WHERE member_type = 3 ORDER BY memberid DESC LIMIT 0, 1");
			$pad = 4;
			if ($get_top_parent->num_rows() <> 0)
			{
				$top_parent = $get_top_parent->result();
				foreach ($top_parent AS $top_parent)
				$parent_count = $top_parent->parent_count;
				$parent_count = round($parent_count);		  
				$parent_count = $parent_count + 1;
				
				$code_new = str_pad($parent_count, $pad, "0", STR_PAD_LEFT);
			}
			else
			{
				$parent_count = 1;
				$code_new = str_pad($parent_count, $pad, "0", STR_PAD_LEFT);
			}
			$member_code = "PR$code_new";
			//echo $member_code;
			
			$password = $this->RandomString(10);			
			$datez = date('Y-m-d H:i:s');
			
			$parent_quez = $this->RandomString(30);
			
			$parent_student = $this->ParentStudentModel->getByCriteria(array('parstd_quez' => $children_code));
			if (count($parent_student) > 1)
			{
				$err_message = "<div class='alert-box warning'><span>peringatan &nbsp;&nbsp; </span>Akses anak telah digunakan. hanya maksimum <b>2</b> akun akses.</div>";
				$this->session->set_userdata("err_message", $err_message);						
			}
			else
			{
				$ins_db = array(
					'member_code' => $member_code,
					'username' => $fullname,
					'fullname' => $fullname,
					'email' => $email,
					'password' => $password,
					'mobile_phone' => $mobile_phone,
					'gender' => $gender,
					'relation' => $relation,
					'address' => $address,
					'member_type' => 3,
					'publish' => 1,
					'parent_count' => $parent_count,
					'datez' => $datez,
					'lastupdate' => $datez				
				);
				 
				$ins_parent_into_db = $this->UserModel->save($ins_db);
				
				// Send Email			
				$from_name = "KES - ORANGTUA";
				$from_email = "info@kes.co.id";
				
				$email_to = "$email";
				$subject_ok = "Informasi Akun";
				$message_ok = "Hi $fullname, <br><br>Dibawah ini adalah perincian akun anda. <br><br> Email : $email <br>Kata Sandi : $password <br><br> Silahkan gunakan email dan kata sandi untuk Login Akun Anda. <br><br>Terima Kasih,<br><br>KES (Kids Education System)";
				//echo $message_ok;
				
				$this->sendEmail();
				
				$this->email->from($from_email, $from_name);
				$this->email->to($email_to);
				$this->email->subject($subject_ok);
				$this->email->message($message_ok);
				 
				$this->email->send();
				
				$err_message = "<div class='alert-box success'><span>berhasil &nbsp;&nbsp; </span> Orangtua <b>$fullname </b>telah ditambahkan.</div>";
							
				redirect('register/message');
			}
		}
		else
		{
			 $err_message = "<div class='alert-box warning'><span>peringatan &nbsp;&nbsp; </span> Email / Nomor Handphone sudah ada, silahkan masukkan email / nomor handphone lain.</div>";
		}
		
		$cnt = array(
          'menu_id' => $menu_id, 
          'menu_name' => $menu_name,
		  'fullname' => $fullname,
		  'email' => $email,
		  'mobile_phone' => $mobile_phone,
		  'gender' => $gender,
		  'relation' => $relation,
		  'address' => $address,
		  'err_message' => $err_message
        );
		
		$this->load_page("admin/login/register", $cnt);
    }
	
	public function message()
    {
		$cnt = array();
		$this->load_page("admin/login/register_message", $cnt);
	}

}
