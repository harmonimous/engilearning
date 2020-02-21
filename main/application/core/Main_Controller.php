<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main_Controller extends CI_Controller {

	public $data = array();

	function __construct(){
		parent::__construct();

		$this->load->helper(array('custom_helper','user_helper'));
		$this->load->library(array('libs','session'));
		$this->load->model(array('mahasiswa_model'));

	}
	













}