<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Error extends Frontend_Controller{

	public function __construct(){
		parent::__construct();		
	}

	public function error404()
	{
		$this->load->view('frontend/404');
	}
}
