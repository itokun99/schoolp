<?php defined('BASEPATH') OR exit('No direct script access allowed');

class SchoolModelTest extends CI_Model  {
	
	function __construct() {
		parent::__construct();
	}
	
	public function getAllSchool(){
		$this->db->select('school_name');
		$this->db->from('b_school');
		$query = $this->db->get();
		return $data = $query->result_array();
	}

 }