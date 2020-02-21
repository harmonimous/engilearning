<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Diskusi_Model extends Main_Model {
	
	protected $_table_name = 'diskusi';
	protected $_primary_key = 'id_diskusi';
	protected $_order_by = 'id_diskusi';
	protected $_order_by_type = 'ASC';

	public $create_rules = array(
		'komentar' => array(
			'field' => 'komentar', 
			'label' => 'Komentar', 
			'rules' => 'trim|required'
		)
	);

	function __construct(){
		parent::__construct();
	}	

	function get_komentar($where = NULL, $limit = NULL, $offset= NULL, $single=FALSE, $select=NULL){
		$this->db->join('{PRE}mahasiswa', '{PRE}diskusi.dari  = {PRE}mahasiswa.nim', 'LEFT' );
		return parent::get_by($where,$limit,$offset,$single,$select);
	}
}