<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bantuan extends Backend_Controller {

	public function __construct(){
		parent::__construct();		
	}

	public function index(){
		$data = array();
		$this->libs->view('bantuan', $data);
	}

	


}