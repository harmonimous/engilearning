<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Tugas_Model extends Main_Model {
	
	protected $_table_name = 'tugas';
	protected $_primary_key = 'id_tugas';
	protected $_order_by = 'waktu_berakhir';
	protected $_order_by_type = 'ASC';

	public $create_rules = array(
		'matakuliah_id' => array(
            'field' => 'matakuliah',
            'label' => 'Matakuliah',
            'rules' => 'trim|required'
		), 
		'tugas_kelas' => array(
			'field' => 'kelas', 
			'label' => 'Kelas', 
			'rules' => 'trim|required'
        ),
        'nama_tugas' => array(
            'field' => 'nama-tugas',
            'label' => 'Nama / Judul Tugas',
            'rules' => 'trim|required'
		), 
		'deskripsi_tugas' => array(
			'field' => 'deskripsi', 
			'label' => 'Deskripsi Tugas', 
			'rules' => 'trim|required'
        ), 
		'waktu_berakhir' => array(
			'field' => 'waktu-berakhir', 
			'label' => 'Waktu Tugas Berakhir', 
			'rules' => 'trim|required'
        )
	);	

	public $update_rules = array(
		'matakuliah_id' => array(
            'field' => 'matakuliah',
            'label' => 'Matakuliah',
            'rules' => 'trim|required'
		), 
		'tugas_kelas' => array(
			'field' => 'kelas', 
			'label' => 'Kelas', 
			'rules' => 'trim|required'
        ),
        'nama_tugas' => array(
            'field' => 'nama-tugas',
            'label' => 'Nama / Judul Tugas',
            'rules' => 'trim|required'
		), 
		'deskripsi_tugas' => array(
			'field' => 'deskripsi', 
			'label' => 'Deskripsi Tugas', 
			'rules' => 'trim|required'
        ), 
		'waktu_berakhir' => array(
			'field' => 'waktu-berakhir', 
			'label' => 'Waktu Tugas Berakhir', 
			'rules' => 'trim|required'
        )
	);

	function __construct(){
		parent::__construct();
	}

	function get_tugas($id=NULL){
		$this->db->select('{PRE}tugas.*,nama_matakuliah,nama_kelas,nama_dosen');
		$this->db->join('{PRE}matakuliah', '{PRE}tugas.matakuliah_id  = {PRE}matakuliah.id_matakuliah', 'LEFT');
		$this->db->join('{PRE}kelas', '{PRE}tugas.tugas_kelas  = {PRE}kelas.id_kelas', 'LEFT');
		$this->db->join('{PRE}dosen', '{PRE}tugas.dibuat_oleh  = {PRE}dosen.nid', 'LEFT');
		return parent::get($id);
	}

	function get_custom($where = NULL, $limit = NULL, $offset= NULL, $single=FALSE, $select=NULL){
		$this->db->join('{PRE}matakuliah', '{PRE}tugas.matakuliah_id  = {PRE}matakuliah.id_matakuliah', 'LEFT');
		$this->db->join('{PRE}kelas', '{PRE}tugas.tugas_kelas  = {PRE}kelas.id_kelas', 'LEFT');
		$this->db->join('{PRE}dosen', '{PRE}tugas.dibuat_oleh  = {PRE}dosen.nid', 'LEFT');
		return parent::get_by($where,$limit,$offset,$single,$select);
	}
}
