<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Team extends Frontend_Controller {
	 
	public function __construct(){
		parent::__construct();	

		$this->load->model(array('dosen_model'));	
	}

	public function index()
	{
		global $SConfig;
		$data['dosen'] = $this->dosen_model->get();
		$this->libs->view('daftar-dosen',$data);
	}













}

