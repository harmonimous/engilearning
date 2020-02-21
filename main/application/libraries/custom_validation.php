<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Custom_Validation extends CI_Form_validation{
	public function __construct($rules = array()){
		parent::__construct($rules);
	}

	//untuk menghasilkan notification atau array error
	function error_array(){ 
		if(count($this->_error_array)===0)
			return FALSE;
		else
			return $this->_error_array;
	}
}