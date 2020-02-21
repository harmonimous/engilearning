<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends Backend_Controller {

	public function __construct(){
		parent::__construct();	
		$this->load->model(array('dosen_model','matakuliah_model','mahasiswa_model','materi_model','kategori_model','diskusi_model'));	
	}

	public function index()
	{

		$id_saya = $this->session->userdata('id_user');

		$data['count_dosen'] = $this->dosen_model->count();
		$data['count_matakuliah'] = $this->matakuliah_model->count();
		$data['count_mahasiswa'] = $this->mahasiswa_model->count();
		$data['count_materi'] = $this->materi_model->count();
		$data['count_kategori'] =$this->kategori_model->count();
		$data['count_diskusi'] =$this->kategori_model->count();

		$data['diskusi']= $this->diskusi_model->get_by(array('dari' =>$id_saya));
		$data['matakuliah']= $this->matakuliah_model->get_by(array('dosen_pengampu' =>$id_saya));
		
		$this->libs->view('index',$data);
	}



}
