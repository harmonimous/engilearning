<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Frontend_Controller extends Main_Controller{

	function __construct(){
		parent::__construct();
		$this->load->helper(array('user_helper','date_helper'));
		$this->load->library(array('form_validation'));
		$this->libs->side = 'frontend';
		$this->libs->is_logged_in();
	}
















}