<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tugas extends Learn_Controller {

	public function __construct(){
		parent::__construct();	
		$this->load->model(array('tugas_model','jawaban_model'));
		date_default_timezone_set('Asia/Jakarta');
	}
	
	public function index(){
		
		global $SConfig;
		$kelas = $this->session->userdata('kelas');
		$data['tugas'] = $this->tugas_model->get_custom(array('tugas_kelas' => $kelas), NULL, NULL, FALSE,'{PRE}tugas.*,nama_matakuliah,nama_kelas');
		$this->libs->view('daftar-tugas',$data);

	}
	public function jawab($id_tugas=NULL,$action=NULL){
		global $SConfig;
		$id_penjawab = $this->session->userdata('id_user');
		$sudah_menjawab = $this->jawaban_model->count(array("tugas_id LIKE" => "%$id_tugas%","penjawab LIKE" => "%$id_penjawab%"));
		$tugas = $this->tugas_model->get_tugas($id_tugas);

		$start = strtotime(date('Y-m-d H:i:s'));
		$end = strtotime($tugas->waktu_berakhir);
		$deadlines=$end-$start;

		if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'){ 
			if($action=='jawab'){
				$post = $this->input->post();
				
				if(!empty($_FILES['filejawaban']) && $deadlines >= 0){
					$type = 'jawaban-tugas';
					$this->libs->create_dir($type);
					$this->load->library('upload', $this->libs->file_upload_config($type));
					$exp_point = 100;
					if($this->upload->do_upload('filejawaban')){
						$upload_data = $this->upload->data();
						$data = array(				
			 				'tugas_id' =>$id_tugas,
							'penjawab'=> $id_penjawab,
							'jawaban' => $upload_data['file_name'],
							'nilai' => '0',
							'waktu_menjawab'=> date('Y-m-d H:i:s')
						); 
						$this->jawaban_model->insert($data);

						$levelup = $this->gamifikasi->leveling($exp_point);	
						$result = array('status' => 'success','levelup'=> $levelup);
					}
					else{
						$result = array('status' => 'gagal_upload');
					}
				}
				else if(empty($_FILES['filetugas']) && $deadlines >= 0){
					$result = array('status' => 'empty');
				}
				else if($deadlines <= 0){
					$result = array('status' => 'waktu_habis');
				}
				else{
					$result = array('status' => 'failed');
				}
				echo json_encode($result);
			}
		}
		else if($deadlines <= 0){
			$this->session->set_flashdata('waktu_habis', 'Waktu Sudah Habis...');
			$data['pengingat'] = 'Waktu Sudah Habis!';
			$data['waktu'] = $deadlines;
			$data['tugas'] = $this->tugas_model->get_tugas($id_tugas);
			$this->libs->view('kerjakan-tugas',$data);
		}
		
		else if($sudah_menjawab > 0){
			$this->session->set_flashdata('sudah_menjawab', 'Sudah Dijawab...');
			$data['pengingat'] = 'Waktu hingga '.$tugas->waktu_berakhir.' :';
			$data['waktu'] = $deadlines;
			$data['tugas'] = $this->tugas_model->get_tugas($id_tugas);
			$this->libs->view('kerjakan-tugas',$data);
		}
		
		else{
			$data['pengingat'] = 'Waktu hingga '.$tugas->waktu_berakhir.' :';
			$data['waktu'] = $deadlines;
			$data['tugas'] = $this->tugas_model->get_tugas($id_tugas);
			$this->libs->view('kerjakan-tugas',$data);
		}
	}






}