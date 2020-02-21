<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Isimateri_Model extends Main_Model {
	
	protected $_table_name = 'isi_materi';
	protected $_primary_key = 'id_isi';
	protected $_order_by = 'isi_sort';
	protected $_order_by_type = 'ASC';

	public $create_rules = array(
		'sub_judul' => array(
            'field' => 'sub-judul',
            'label' => 'Sub Judul',
            'rules' => 'trim|required'
		), 
		'tipe_isi' => array(
			'field' => 'tipe-isi', 
			'label' => 'Tipe', 
			'rules' => 'trim|required'
        )
	);	

	function __construct(){
		parent::__construct();
	}

	function get_pembahasan($id=NULL){
		$this->db->select('{PRE}isi_materi.id_isi, {PRE}isi_materi.sub_judul, {PRE}isi_materi.tipe_isi, {PRE}isi_materi.isi_sort, {PRE}pembahasan.*');
		$this->db->join('{PRE}pembahasan', '{PRE}isi_materi.id_isi  = {PRE}pembahasan.isi_id', 'LEFT');
		return parent::get($id);
	}
	function get_soal($id=NULL){
		$this->db->select('{PRE}isi_materi.id_isi, {PRE}isi_materi.sub_judul, {PRE}isi_materi.tipe_isi, {PRE}soal.*');
		$this->db->join('{PRE}soal', '{PRE}isi_materi.id_isi  = {PRE}soal.isi_id', 'LEFT');
		return parent::get($id);
	}
	function get_all_isi($id=NULL){
		$this->db->select('{PRE}isi_materi.id_isi, {PRE}isi_materi.sub_judul, {PRE}isi_materi.tipe_isi, {PRE}soal.*,{PRE}pembahasan.*');
		$this->db->join('{PRE}soal', '{PRE}isi_materi.id_isi  = {PRE}soal.isi_id', 'LEFT');
		$this->db->join('{PRE}pembahasan', '{PRE}isi_materi.id_isi  = {PRE}pembahasan.isi_id', 'LEFT');

		return parent::get_by($id);
	}

	function pembahasan_where($where=NULL){
	$this->db->select('{PRE}isi_materi.id_isi, {PRE}isi_materi.sub_judul, {PRE}isi_materi.tipe_isi, {PRE}isi_materi.isi_sort, {PRE}pembahasan.*');
	$this->db->join('{PRE}pembahasan', '{PRE}isi_materi.id_isi  = {PRE}pembahasan.isi_id', 'LEFT');
	return parent::get_by($where);
	}
	
	function soal_where($id=NULL){
		$this->db->select('{PRE}isi_materi.id_isi, {PRE}isi_materi.sub_judul, {PRE}isi_materi.tipe_isi, {PRE}soal.*');
		$this->db->join('{PRE}soal', '{PRE}isi_materi.id_isi  = {PRE}soal.isi_id', 'LEFT');
		return parent::get_bye($where);
	}
}