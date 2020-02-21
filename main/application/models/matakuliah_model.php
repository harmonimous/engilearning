<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Matakuliah_Model extends Main_Model {
	
	protected $_table_name = 'matakuliah';
	protected $_primary_key = 'id_matakuliah';
	protected $_order_by = 'id_matakuliah';
	protected $_order_by_type = 'DESC';

	public $create_rules = array(
		'nama_matakuliah' => array(
            'field' => 'nama-matakuliah',
            'label' => 'Nama Matakuliah',
            'rules' => 'trim|required'
		), 
		'kategori_matakuliah' => array(
			'field' => 'kategori-matakuliah', 
			'label' => 'Kategori', 
			'rules' => 'trim|required'
        ),
        'semester' => array(
            'field' => 'semester',
            'label' => 'Semester',
            'rules' => 'trim|required'
		), 
		'dosen_pengampu' => array(
			'field' => 'dosen-pengampu', 
			'label' => 'Dosen Pengampu', 
			'rules' => 'trim|required'
        )
	);	

	function __construct(){
		parent::__construct();
	}	

	function get_matakuliah($where = NULL, $limit = NULL, $offset= NULL, $single=FALSE, $select=NULL){
		$this->db->select('{PRE}matakuliah.*, kategori');
		$this->db->join('{PRE}kategori', '{PRE}matakuliah.kategori_matakuliah  = {PRE}kategori.id_kategori' ,'LEFT' );
		$this->db->join('{PRE}dosen', '{PRE}matakuliah.dosen_pengampu  = {PRE}dosen.nid', 'LEFT' );
		return parent::get_by($where,$limit,$offset,$single,$select);
	}

	function get_detail_matakuliah($id=NULL){
		$this->db->select('{PRE}matakuliah.*, kategori, nama_dosen');
		$this->db->join('{PRE}kategori', '{PRE}matakuliah.kategori_matakuliah  = {PRE}kategori.id_kategori' ,'LEFT' );
		$this->db->join('{PRE}dosen', '{PRE}matakuliah.dosen_pengampu  = {PRE}dosen.nid', 'LEFT' );
		return parent::get($id);
	}
}