<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class login  extends Core_Controller
{
	
    function __construct()
    {
      parent::__construct();
      $this->load->model("UserModel");
	  $this->load->model("ForgetPasswordModel");
	  $this->load->library('user_agent');
    }
 
    function index()
    {
		if ($this->agent->is_mobile("android")) {
			$this->session->set_userdata("schoolp_mobile", 1);	
		}
		else if ($this->agent->is_mobile("iphone")) {
			$this->session->set_userdata("schoolp_mobile", 1);	
		}
		else if ($this->agent->is_mobile("gt-p")) {
			$this->session->set_userdata("schoolp_mobile", 1);	
		}
		
		if ($this->session->userdata("schoolp_mobile"))	redirect("mobile/page");
		
		$email = "";
		$paswd = "";
		
		$cnt = array(
          'email' => $email, 
          'paswd' => $paswd,
		  'err_message'=> ""
        );
		$this->load_login("admin/login/index", $cnt);
    }

	public function signin()
	{
		$userEmail = $this->session->userdata('userEmail');

		$criteria = array(
		  'email' => $userEmail,
		);
		$cek_mbr_id = $this->UserModel->getOne($criteria);

		$member_id = $cek_mbr_id->memberid;
		$username = $cek_mbr_id->username;
		$full_name = $cek_mbr_id->fullname;
		$member_type = $cek_mbr_id->member_type;
		$datez = date('Y-m-d H:i:s');
		
		$query_db = array(
			'lastlogin' => $datez
		);
			
		$upd_mbr_into_db = $this->UserModel->save($query_db, array('memberid' => $member_id));
		
		$this->session->set_userdata("schoolp_logged_in", true);
		$this->session->set_userdata("schoolp_member_id", $member_id);
		$this->session->set_userdata("schoolp_member_type", $member_type);
		$this->session->set_userdata("schoolp_uname", $username);
		$this->session->set_userdata("schoolp_fname", $full_name);
		
		$this->session->set_userdata("schoolp_children_id", -1);
		$cek_parent = $this->db->query("SELECT student_id FROM b_parent_student	WHERE parent_id = '$member_id' ORDER BY parstdid ASC LIMIT 0, 1");
		
		if ($cek_parent->num_rows() <> 0)
		{
			$parent_ok = $cek_parent->result();
			foreach ($parent_ok AS $parent_ok)
			$this->session->set_userdata("schoolp_children_id", $parent_ok->student_id);
			
			if ($this->agent->is_mobile("android")) {
				$this->session->set_userdata("schoolp_mobile", 1);	
			}
			else if ($this->agent->is_mobile("iphone")) {
				$this->session->set_userdata("schoolp_mobile", 1);	
			}
			else if ($this->agent->is_mobile("gt-p")) {
				$this->session->set_userdata("schoolp_mobile", 1);	
			}
			redirect("children/profile");
		}
		redirect("profile");
	}

	public function signout() {
		$this->session->unset_userdata("schoolp_logged_in");
		$this->session->unset_userdata("schoolp_member_id");
		$this->session->unset_userdata("schoolp_uname");
		$this->session->unset_userdata("schoolp_fname");

		redirect("admin");
	}
	
	
	public function forget_pass()
	{		
		$randomString = $this->RandomString(30);
	
		$quez_ok = $randomString;
		$datez = date('Y-m-d H:i:s');		
		
		$dt = Time();
		$date_expired = $this->DateAdd($dt, "d", 7);
		$expired_date = $this->cDatePL($date_expired);
						
		$email = $this->input->post("email", true);
		
		$cek_email = $this->UserModel->getOne(array('email' => $email, 'publish' => 1));
		
		if (isset($cek_email) && $cek_email != false)
		{
			$domain_now = $_SERVER['SERVER_NAME'];
			$current_url = $_SERVER['REQUEST_URI'];
			$url_ok = explode("/", $current_url);
			$total_array = sizeof($url_ok);
			$url_file = $url_ok[1];		 
		 
			$actual_link = "";
			for($j = 0; $j < $total_array - 1; $j++)
			{
			  $actual_link = "$actual_link$url_ok[$j]/";
			}
			$actual_link = "http://$_SERVER[HTTP_HOST]$actual_link" . "chgpss/$quez_ok";
			
			$member_id_ok = $cek_email->memberid;
			$username_ok = $cek_email->username;
			
			$menu_title = "EMPLOYEE";
			$menu_desc =  "Forget Password: $cek_email->fullname";
			$menu_detail = "Name: $cek_email->fullname <br> Username: $cek_email->username <br> Email: $cek_email->email";
			$menu_action = "FORGET PASSWORD";
			$this->activitydb($menu_title, $menu_desc, $menu_detail, $menu_action);
			
			$query_db = array(
				'member_id' => $cek_email->memberid,
				'email' => $email,
				'quez' => $quez_ok,
				'datez' => $datez,
				'expired_date' => $expired_date
			);	
			 
			$ins_changepass_db = $this->ForgetPasswordModel->save($query_db);
			
			 
			$err_message = "Kata Sandi telah dikirim ke email Anda.";
			$this->session->set_userdata("err_message_stat", 1);
			
			// Send Email
			$email_to = "$email";
			$subject_ok = "Lupa Kata Sandi";
			$message_ok = "Halo $cek_email->fullname, <br><br>Kami telah menerima permintaan perubahan kata sandi untuk Akun Anda. Jika Anda membuat permintaan ini, silakan klik tautan di bawah ini: <br><br> ================================================== <br><br> $actual_link <br><br> ================================================== <br><br> Jika Anda tidak meminta perubahan kata sandi baru, silahkan abaikan email ini. <br><br>Terima kasih,<br><br>KES (Kids Education System)";
			
			$from_name = "KES - ORANGTUA";
			$from_email = "info@kes.co.id";
				
			$this->sendEmail();
			
			$this->email->from($from_email, $from_name);
			$this->email->to($email_to);
			$this->email->subject($subject_ok);
			$this->email->message($message_ok);
			 
			$this->email->send();
			
		}
		else
		{	
			$err_message = "Maaf, Email anda tidak ada, silahkan coba lagi.";	
		}
		
		$this->session->set_userdata("err_message", $err_message);	
		redirect("login");
	}
	
	public function chgpss($uidp = "")
	{
		$cek_key = $this->db->query("SELECT * FROM b_forgot_pass WHERE quez='$uidp' AND status='0' AND expired_date >= now()");
        $keys = $cek_key->result();
				
		if (isset($keys) && count($keys) > 0)
		{			
			$cnt = array (
				'uidp' => $uidp
			);
		}
		else
		{			
			$err_message = "<div class='alert alert-warning'><span>GANTI KATA SANDI &nbsp;&nbsp; </span> Tautan Anda Berakhir, Silahkan coba lagi</div>";
			
			$cnt = array (
				'uidp' => $uidp,
				'err_message' => $err_message
			);			
		}
		
		$this->load_page("admin/login/chgpass", $cnt);
	}
	
	public function change_forgetpassword()
	{
		$uidp = $this->input->post("uidp", true);
		$password_new = $this->input->post("password_new", true);
		
		$cek_keypass = $this->ForgetPasswordModel->getOne(array('quez' => $uidp));
		
		if (isset($cek_keypass) && $cek_keypass != false)
		{
			$member_ok = $this->UserModel->getOne(array('memberid' => $cek_keypass->member_id));
			
			$member_id_ok = $member_ok->memberid;
			$username_ok = $member_ok->username;
			
			$menu_title = "EMPLOYEE";
			$menu_desc =  "Change Password: $member_ok->fullname";
			$menu_detail = "Name: $member_ok->fullname <br> Username: $member_ok->username <br> Email: $member_ok->email";
			$menu_action = "CHANGE FORGET PASSWORD";
			$this->activitydb($menu_title, $menu_desc, $menu_detail, $menu_action);
			
			$upd_password_db = $this->ForgetPasswordModel->save(array('status' => 1), array('quez' => $uidp));
			
			$upd_member_db = $this->UserModel->save(array('password' => $password_new), array('memberid' => $member_id_ok));
			
			$fin_message = "<div align='left' style='width: 600px' class='alert alert-success'>Kata sandi Anda berhasil diubah.</div>";
		}
		else
		{
			$fin_message= "<div align='left' style='width: 600px' class='alert alert-warning'>Akun Anda tidak valid.</div>";
		}
		
		$cnt = array (
			'fin_message' => $fin_message
		);	
		$this->load_page("admin/login/chgpass", $cnt);
	}
	
	public function captcha() {
		$captcha_image = "assets/images/imgcaptcha.jpg"; //gambar untuk background
		//warna
		$red = "0"; // range nya dari 0 - 255
		$green = "0"; //range nya = diatas :D
		$blue = "0";
  
		$acak1 = mt_rand(0,9); // nilai acak 1
		$acak2 = mt_rand(0,9); // nilai acak 2
		$acak3 = mt_rand(0,9); // nilai acak 3
		$acak4 = mt_rand(0,9); // nilai acak 4
		$strview = "$acak1 $acak2 $acak3 $acak4";
		$result = "$acak1$acak2$acak3$acak4";
		$bikingbr =imagecreatefromjpeg($captcha_image);
		$teks = imagecolorallocate($bikingbr, $red, $green, $blue);
		imagestring($bikingbr, 5, 15, 9, $strview, $teks);
		$this->session->set_userdata("captcha_keystring", $result);
		header("Content-type: image/jpeg");
		imagejpeg($bikingbr);
	}
 
}
?>
