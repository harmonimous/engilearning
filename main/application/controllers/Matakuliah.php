<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Matakuliah extends Frontend_Controller {
	 
	public function __construct(){
		parent::__construct();	
		$this->load->model(array('matakuliah_model','kategori_model'));	
		$this->load->helper('inflector');
	}

	public function index()
	{
		$data['kategori'] = $this->kategori_model->get();
		$this->libs->view('daftar-matakuliah',$data);
	}

	public function kategori()
	{
		$data['kategori'] = $this->kategori_model->get();
		$this->libs->view('kategori-matakuliah',$data);
	}

	public function detail($id)
	{
		$related=$this->matakuliah_model->get($id);
		$related_kategori = $related->kategori_matakuliah;

		$data['kategori'] = $this->kategori_model->get();
		$data['matakuliah']=$this->matakuliah_model->get_detail_matakuliah($id);
		$data['related'] = $this->matakuliah_model->get_matakuliah(array("kategori_matakuliah LIKE" => "%$related_kategori%"),3,NULL,FALSE);
		$this->libs->view('detail-matakuliah',$data);
	}













}

