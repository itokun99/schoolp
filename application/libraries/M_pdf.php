<?php defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . 'third_party/mpdf/mpdf.php';

class M_pdf {
	
	private $mpdf;
	
	function __construct() {
		$this->mpdf = new mPDF();
	}
}
