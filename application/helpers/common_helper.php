<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

function url($url = "", $echoed = true, $index_file = "")
{
	if ($echoed) {
		echo base_url() . $index_file . $url;
	} else {
		return base_url() . $index_file . $url;
	}

	return true;
}

function date_str_to_db($dateStr = "") {
	$dar = explode("-", $dateStr);
	return $dar[2] . "-" . $dar[1] . "-" . $dar[0];
}

function date_db_to_str($dateDb = "") {
	$dar = explode("-", $dateDb);
	return $dar[2] . "-" . $dar[1] . "-" . $dar[0];
}

function pagination() {

}