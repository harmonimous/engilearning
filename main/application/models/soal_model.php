<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Soal_Model extends Main_Model {
	
	protected $_table_name = 'soal';
	protected $_primary_key = 'id_soal';
	protected $_order_by = 'id_soal';
	protected $_order_by_type = 'ASC';

	public $create_rules = array(
		'jenis_soal' => array(
            'field' => 'jenis-soal',
            'label' => 'Judul Materi',
            'rules' => 'trim|required'
		), 
		'pertanyaan' => array(
			'field' => 'pertanyaan', 
			'label' => 'Pertanyaan', 
			'rules' => 'trim|required'
        ),
		'jawaban' => array(
			'field' => 'jawaban', 
			'label' => 'Jawaban Soal', 
			'rules' => 'trim|required'
        )
	);	

	function __construct(){
		parent::__construct();
	}	

	public function check_jawaban($where = NULL, $jawaban_mahasiswa = NULL){
		$this->db->where($where);
        $this->db->like('jawaban', $jawaban_mahasiswa);
	    $this->db->from('{PRE}'.$this->_table_name);
	    return $this->db->count_all_results();
	}
}