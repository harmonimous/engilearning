<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Backend_Controller extends Main_Controller{

	function __construct(){
		parent::__construct();
		$this->load->helper(array('user_helper','date_helper'));
		$this->load->library(array('form_validation'));
		$this->load->model(array('dosen_model','matakuliah_model','materi_model','kelas_model','tugas_model','kategori_model'));
		$this->libs->side = 'backend';
		$this->libs->is_logged_in();
	}
















}