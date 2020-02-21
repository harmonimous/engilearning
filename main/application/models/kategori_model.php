<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Kategori_Model extends Main_Model {
	
	protected $_table_name = 'kategori';
	protected $_primary_key = 'id_kategori';
	protected $_order_by = 'id_kategori';
	protected $_order_by_type = 'ASC';

	public $create_rules = array(
		'kode_kategori' => array(
            'field' => 'kode-kategori',
            'label' => 'Kode Kategori',
            'rules' => 'trim|required'
		),
		'kategori' => array(
            'field' => 'nama-kategori',
            'label' => 'Nama Kategori',
            'rules' => 'trim|required'
		)
	);

	public $update_rules = array(
		'kategori' => array(
            'field' => 'nama-kategori',
            'label' => 'Nama Kategori',
            'rules' => 'trim|required'
		)
	);	
	


	function __construct(){
		parent::__construct();
	}	
}