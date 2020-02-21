<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Mahasiswa_Model extends Main_Model {
	
	protected $_table_name = 'mahasiswa';
	protected $_primary_key = 'nim';
	protected $_order_by = 'nim';
	protected $_order_by_type = 'ASC';

	public $create_rules = array(
		'nim' => array(
            'field' => 'nim',
            'label' => 'NIM',
            'rules' => 'trim|required|callback_nim_check'
		), 
		'password' => array(
			'field' => 'password', 
			'label' => 'Password', 
			'rules' => 'trim|required'
		)
	);

	public $update_rules = array(
		'nim' => array(
            'field' => 'nim',
            'label' => 'NIM',
            'rules' => 'trim|required'
		), 
		'password' => array(
			'field' => 'password', 
			'label' => 'Password', 
			'rules' => 'trim|required'
		)
	);		

	public $login_rules = array(
		'nim' => array(
            'field' => 'nim',
            'label' => 'NID',
            'rules' => 'trim|required'
		), 
		'password' => array(
			'field' => 'password', 
			'label' => 'Password', 
			'rules' => 'trim|required|callback_password_check'
		)
	);	

	function __construct(){
		parent::__construct();
	}	

	function get_mahasiswa($id=NULL){
		$this->db->select('{PRE}mahasiswa.*, {PRE}detail_mahasiswa.*,{PRE}kelas.*');
		$this->db->join('{PRE}detail_mahasiswa', '{PRE}mahasiswa.nim  = {PRE}detail_mahasiswa.identitas' ,'LEFT' );
		$this->db->join('{PRE}kelas', '{PRE}detail_mahasiswa.kelas_id  = {PRE}kelas.id_kelas', 'LEFT' );
		return parent::get($id);
	}

	function get_custom($where = NULL, $limit = NULL, $offset= NULL, $single=FALSE, $select=NULL){
		$this->db->join('{PRE}detail_mahasiswa', '{PRE}mahasiswa.nim  = {PRE}detail_mahasiswa.identitas' ,'LEFT' );
		$this->db->join('{PRE}kelas', '{PRE}detail_mahasiswa.kelas_id  = {PRE}kelas.id_kelas', 'LEFT' );
		return parent::get_by($where,$limit,$offset,$single,$select);
	}


}