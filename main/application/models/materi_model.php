<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Materi_Model extends Main_Model {
	
	protected $_table_name = 'materi';
	protected $_primary_key = 'id_materi';
	protected $_order_by = 'id_materi';
	protected $_order_by_type = 'DESC';

	public $create_rules = array(
		'judul_materi' => array(
            'field' => 'judul-materi',
            'label' => 'Judul Materi',
            'rules' => 'trim|required'
		), 
		'keterangan' => array(
			'field' => 'keterangan', 
			'label' => 'Keterangan', 
			'rules' => 'trim|required'
        ),
		'matakuliah_id' => array(
			'field' => 'matakuliah', 
			'label' => 'Matakuliah', 
			'rules' => 'trim|required'
        )
	);	

	


	function __construct(){
		parent::__construct();
	}	

	function get_materi_bydosen($where = NULL, $limit = NULL, $offset= NULL, $single=FALSE, $select=NULL){
		$this->db->join('{PRE}matakuliah', '{PRE}materi.matakuliah_id  = {PRE}matakuliah.id_matakuliah' ,'LEFT' );
		$this->db->join('{PRE}dosen', '{PRE}matakuliah.dosen_pengampu  = {PRE}dosen.nama_dosen', 'LEFT' );
		return parent::get_by($where,$limit,$offset,$single,$select);
	}

	function get_materi_dan_matakuliah($where = NULL, $limit = NULL, $offset= NULL, $single=FALSE, $select=NULL){
		$this->db->join('{PRE}matakuliah', '{PRE}materi.matakuliah_id  = {PRE}matakuliah.id_matakuliah' ,'LEFT' );
		return parent::get_by($where,$limit,$offset,$single,$select);
	}

}