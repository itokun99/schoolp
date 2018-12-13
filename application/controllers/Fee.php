<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class fee extends Core_Controller
{

    function __construct()
    {
        parent::__construct();		
		
		$this->checkAuth();
        $this->load->model("UserModel");
		$this->load->model("SchoolModel");
		$this->load->model("ParentStudentModel");
		
		if ($this->session->userdata("schoolp_member_type") == 3) { } else redirect('home');
    }

    public function index()
    {
		$this->load->view('contents/error/error_page');        
    }
	
	public function history_payment()
    {
		$menu_id = "34";
		$menu_name = "Student Payment History";  
		
		$student_id = $this->session->userdata("schoolp_children_id");
		
		$dataDetail = $this->ParentStudentModel->getOne(array('student_id' => $student_id));
		$school_id = $dataDetail->school_id;
		
		$year_ok = $this->input->post("year_ok", true);
		
		if (!isset($student_id)) $student_id = "";
		if (!isset($year_ok)) $year_ok = $this->year_ok;
		
		$date_now = date("Y-m-d");
		$date_now_stamp = strtotime($date_now);
			
		$studentDetail = $this->UserModel->getOne(array('memberid' => $student_id));
		
		$school = $this->SchoolModel->getOne(array('schoolid' => $school_id));
		
		$school_code = $school->school_code;
		$school_code_tb = strtolower($school_code);
		$school_dbase = $this->basedb . "school_client_$school_code_tb";
		$get_dbclient = $this->connectdb($school_dbase);
		if ($get_dbclient)
		{
			$this->load->model("client/EducationLevelModel");
			$this->load->model("client/StudentFeeModel");
			$this->load->model("client/StudentPaymentModel");			
			
			for ($j = 1; $j <= 12; $j++)
			{
				$monthName = date("F", mktime(0, 0, 0, $j, 10));
				
				$dataDetails->months[$j] = new stdClass();
				$dataDetails->months[$j]->month_name = "$monthName";
				$dataDetails->months[$j]->month_id = "$j";
				
				$student_fee = 0;
				$get_last_fee = $this->db->query("
					SELECT student_fee FROM b_student_fee
					WHERE student_id='$student_id'
					ORDER BY fee_date DESC, feeid DESC LIMIT 0, 1
				");
				if ($get_last_fee->num_rows() <> 0)
				{
					$last_fee = $get_last_fee->result();
					foreach ($last_fee AS $last_fee)
					$student_fee = $last_fee->student_fee;
				}
				
				$payment_status = 0;
				$payment = $this->StudentPaymentModel->getOne(array('student_id' => $student_id, 'payment_month' => $j, 'payment_year' => $year_ok));
				if (isset($payment) && is_object($payment) && $payment != false)
				{
					$payment_status = 1;
					$student_fee = $payment->payment_total;
				}
				
				$date_from_pay = "$year_ok-$j-1";
				$date_stamp = strtotime($date_from_pay);
				
				$notify_status = 0;
				if ($date_now_stamp > $date_stamp) $notify_status = 1;			
							
				$dataDetails->months[$j]->student_fee = $student_fee;
				$dataDetails->months[$j]->payment_status = $payment_status;
				$dataDetails->months[$j]->notify_status = $notify_status;
				
			}	
		}
		
		
		$get_dbmaster = $this->connectdb($this->basedb . 'school_master');
		
		//echo "<pre>";
		//var_dump($dataDetails);
				
		$cnt = array(
		  'menu_id' => $menu_id, 
		  'menu_name' => $menu_name,
		  'dataDetails' => $dataDetails,
		  'studentDetail' => $studentDetail,
		  'student_id' => $student_id,
		  'school_id' => $school_id,
		  'year_ok' => $year_ok
		);
		
		$this->load_content("admin/student/payment_history", $cnt);
        
    }
	

}
