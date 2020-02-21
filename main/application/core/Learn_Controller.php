<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Learn_Controller extends Main_Controller{

	function __construct(){
		parent::__construct();
		$this->load->helper(array('user_helper','date_helper'));
		$this->load->library(array('form_validation','gamifikasi'));
		$this->load->model(array('matakuliah_model','materi_model','isimateri_model','pembahasan_model','soal_model','mahasiswa_model','tugas_model','detailmahasiswa_model','progress_model'));
		$this->libs->side = 'learn';
		$this->libs->is_logged_in();
	}


	













}