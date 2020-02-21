<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Jawaban_Model extends Main_Model {
	
	protected $_table_name = 'jawaban';
	protected $_primary_key = 'id_jawaban';
	protected $_order_by = 'waktu_menjawab';
	protected $_order_by_type = 'ASC';

	public $jawab_rules = array(
		'jawaban' => array(
            'field' => 'jawaban-tugas',
            'label' => 'Jawaban Tugas',
            'rules' => 'required'
		)
	);	

	public $nilai_rules = array(
		'nilai' => array(
            'field' => 'nilai-tugas',
            'label' => 'Nilai Tugas Mahasiswa',
            'rules' => 'trim|required'
		)
	);

	function __construct(){
		parent::__construct();
	}

	function get_jawaban_mahasiswa($id=NULL){
		$this->db->select('{PRE}jawaban.*,nim,nama_mahasiswa');
		$this->db->join('{PRE}mahasiswa', '{PRE}jawaban.penjawab  = {PRE}mahasiswa.nim', 'LEFT');
		return parent::get($id);
	}

	function get_jawaban_custom($where = NULL, $limit = NULL, $offset= NULL, $single=FALSE, $select=NULL){
		$this->db->join('{PRE}mahasiswa', '{PRE}jawaban.penjawab  = {PRE}mahasiswa.nim', 'LEFT');
		return parent::get_by($where,$limit,$offset,$single,$select);
	}

}
