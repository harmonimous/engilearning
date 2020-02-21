<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Dosen_Model extends Main_Model {
	
	protected $_table_name = 'dosen';
	protected $_primary_key = 'nid';
	protected $_order_by = 'nama_dosen';
	protected $_order_by_type = 'ASC';

	public $rules_login = array(
		'nid' => array(
            'field' => 'nid',
            'label' => 'NID',
            'rules' => 'trim|required'
		), 
		'password' => array(
			'field' => 'password', 
			'label' => 'Password', 
			'rules' => 'trim|required|callback_password_check'
		)
	);	

	public $rules_create = array(
		'nid' => array(
            'field' => 'nid',
            'label' => 'NID',
            'rules' => 'trim|required|numeric|min_length[6]'
		), 
		'nama_dosen' => array(
			'field' => 'nama-dosen', 
			'label' => 'Nama Dosen', 
			'rules' => 'trim|required'
		),
		'password' => array(
			'field' => 'password', 
			'label' => 'Password', 
			'rules' => 'trim|required|min_length[5]'
		),
		'email' => array(
            'field' => 'email',
            'label' => 'Email',
            'rules' => 'trim|required|valid_email'
		), 
		'handphone' => array(
            'field' => 'handphone',
            'label' => 'Handphone',
            'rules' => 'trim|required|numeric|min_length[11]'
		)
	);

	public $rules_update = array(
		'nama_dosen' => array(
			'field' => 'nama-dosen', 
			'label' => 'Nama Dosen', 
			'rules' => 'trim|required'
		),
		'email' => array(
            'field' => 'email',
            'label' => 'Email',
            'rules' => 'trim|required|valid_email'
		),
	);

	function __construct(){
		parent::__construct();
	}	

	function get_dosen($where = NULL, $limit = NULL, $offset= NULL, $single=FALSE, $select=NULL){
		return parent::get_by($where,$limit,$offset,$single,$select);
	}

	/*
	function get_user($where = NULL, $limit = NULL, $offset= NULL, $single=FALSE, $select=NULL){
		$this->db->join('{PRE}user_detail', '{PRE}user.id_user  = {PRE}user_detail.id_tbuser', 'LEFT' );
		$this->db->group_by('{PRE}user.id_user');
		return parent::get_by($where,$limit,$offset,$single,$select);
	}

	function get_user_detail($id=NULL){
		$this->db->select('{PRE}user.nik, {PRE}user.email, {PRE}user.group, {PRE}user.nama_lengkap, {PRE}user_detail.*');
		$this->db->join('{PRE}user_detail', '{PRE}user.id_user  = {PRE}user_detail.id_tbuser', 'LEFT');
		return parent::get($id);
	}
	*/
}