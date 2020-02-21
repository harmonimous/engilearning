<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Progress_Model extends Main_Model {
	
	protected $_table_name = 'progress';
	protected $_primary_key = 'id_progress';
	protected $_order_by = 'id_progress';
	protected $_order_by_type = 'ASC';


	function __construct(){
		parent::__construct();
	}


}
