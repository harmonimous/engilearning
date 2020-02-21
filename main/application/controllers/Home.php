<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends Frontend_Controller {

	public function __construct(){
		parent::__construct();	
		$this->load->model(array('dosen_model','matakuliah_model','mahasiswa_model','materi_model','kategori_model'));	
	}

	public function index()
	{
		$data['dosen'] = $this->dosen_model->count();
		$data['matakuliah'] = $this->matakuliah_model->count();
		$data['mahasiswa'] = $this->mahasiswa_model->count();
		$data['materi'] = $this->materi_model->count();
		$data['kategori'] =$this->kategori_model->count();
		$this->libs->view('home',$data);
	}
}
