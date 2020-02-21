<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Leaderboard extends Frontend_Controller {
	 
	public function __construct(){
		parent::__construct();	

		$this->load->model(array('mahasiswa_model','detailmahasiswa_model'));	
	}

	public function index()
	{
		global $SConfig;
		$data['mahasiswa'] = $this->detailmahasiswa_model->get_mahasiswa();
		$this->libs->view('leaderboard',$data);
	}













}

