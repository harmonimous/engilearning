<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Pembahasan_Model extends Main_Model {
	
	protected $_table_name = 'pembahasan';
	protected $_primary_key = 'id_pembahasan';
	protected $_order_by = 'id_pembahasan';
	protected $_order_by_type = 'ASC';

	public $create_rules = array(
		'pembahasan' => array(
            'field' => 'isi-pembahasan',
            'label' => 'Pembahasan Materi',
            'rules' => 'trim|required'
		)
	);	

	function __construct(){
		parent::__construct();
	}	
}