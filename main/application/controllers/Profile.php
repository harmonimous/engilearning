<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends Frontend_Controller {

	public function __construct(){
		parent::__construct();	
		$this->load->model(array('mahasiswa_model','dosen_model','tugas_model'));	
	}

	public function index()
	{
		global $SConfig;
		$kelas = $this->session->userdata('kelas');
		$data['tugas'] = $this->tugas_model->get_custom(array('tugas_kelas' => $kelas), 5, NULL, FALSE,'{PRE}tugas.*,nama_matakuliah,nama_kelas');
		$this->libs->view('profile',$data);
	}
}
