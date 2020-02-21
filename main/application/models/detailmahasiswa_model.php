<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Detailmahasiswa_Model extends Main_Model {
	
	protected $_table_name = 'detail_mahasiswa';
	protected $_primary_key = 'id_detail_mahasiswa';
	protected $_order_by = 'point_exp';
	protected $_order_by_type = 'DESC';

	function __construct(){
		parent::__construct();
	}	

	function get_mahasiswa($id=NULL){
		$this->db->select('{PRE}mahasiswa.*, {PRE}detail_mahasiswa.*, {PRE}kelas.*');
		$this->db->join('{PRE}mahasiswa', '{PRE}detail_mahasiswa.identitas  = {PRE}mahasiswa.nim' ,'LEFT' );
		$this->db->join('{PRE}kelas', '{PRE}detail_mahasiswa.kelas_id  = {PRE}kelas.id_kelas', 'LEFT' );
		$this->db->limit(20);
		return parent::get($id);
	}



	

}