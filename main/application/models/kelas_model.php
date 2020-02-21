<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Kelas_Model extends Main_Model {
	
	protected $_table_name = 'kelas';
	protected $_primary_key = 'id_kelas';
	protected $_order_by = 'id_kelas';
	protected $_order_by_type = 'ASC';

	public $create_rules = array(
		'nama_kelas' => array(
            'field' => 'nama-kelas',
            'label' => 'Nama Kelas',
            'rules' => 'trim|required|max_length[10]'
		), 
		'tahun_angkatan' => array(
			'field' => 'tahun-angkatan', 
			'label' => 'Tahun Angkatan', 
			'rules' => 'trim|required|numeric|max_length[4]'
        ),
		'semester' => array(
			'field' => 'semester', 
			'label' => 'Semester', 
			'rules' => 'trim|required|numeric|max_length[2]'
        )
	);

	public $update_rules = array(
		'tahun_angkatan' => array(
			'field' => 'tahun-angkatan', 
			'label' => 'Tahun Angkatan', 
			'rules' => 'trim|required|numeric|max_length[4]'
	    ),
		'semester' => array(
			'field' => 'semester', 
			'label' => 'Semester', 
			'rules' => 'trim|required|numeric|max_length[2]'
	    )
	);	
	


	function __construct(){
		parent::__construct();
	}	
}