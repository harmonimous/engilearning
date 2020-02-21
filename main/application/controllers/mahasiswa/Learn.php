<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Learn extends Learn_Controller {

	public function __construct(){
		parent::__construct();	
	}

	public function index($id_matakuliah=NULL,$param=NULL){
		global $SConfig; 
		if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'){ 
			if($param =='read'){
				$post= $this->input->post(NULL,TRUE);
				$total_rows = $this->materi_model->count(array('matakuliah_id' => $id_matakuliah));
				$offset = NULL;

				if(!empty($post['hal_aktif']) && $post > 1 ){
					$offset = ($post['hal_aktif'] - 1) * $SConfig->_backend_perpage;
				}
				$record = $this->materi_model->get_materi_dan_matakuliah(array('matakuliah_id' => $id_matakuliah),$SConfig->_backend_perpage,$offset,FALSE,"{PRE}materi .*,nama_matakuliah,id_matakuliah");
				echo json_encode(
					array(
						'total_rows' => $total_rows,
						'perpage' => $SConfig ->_backend_perpage,
						'record' => $record
					)
				);	
			}
		}
		else{
			$data = array();
			$this->libs->view('index', $data);
		}
	}

	public function start($id_matakuliah,$id_materi='',$action=''){
		global $SConfig; 
		$id_saya = $this->session->userdata('id_user');
		$levelup = 0;
		if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'){ 
			$post = $this->input->post();
			if( $action =='final' && isset($post['hidden-jenis-soal']) ){
				$id = $post['hidden-id'];
				if($post['hidden-jenis-soal'] == 'pg'){
					$jawabanmahasiswa = $post['jawaban-pg'];
				}
				else if($post['hidden-jenis-soal'] == 'essay'){
					$jawabanmahasiswa = $post['jawaban-essay'];
				}
				$jawabanbenar= $this->soal_model->count(array("id_soal"=>"$id","jawaban LIKE"=> "%$jawabanmahasiswa%"));

				if($jawabanmahasiswa==''){
					$result = array('status' => 'empty');
				}
				else if($jawabanbenar>0){
					$exp_point = 50;
					$cek_progress = $this->progress_model->count(array("identity_user" =>"$id_saya","materi_id"=>"$id_materi","status"=> "selesai"));
					$data = array('identity_user' => $id_saya,'materi_id'=> $id_materi,'status' => 'selesai');

					if($cek_progress == 0){
						$this->progress_model->insert($data);
						$levelup = $this->gamifikasi->leveling($exp_point);
					}
					$result = array('status' => 'benar','direct_to' => $id_matakuliah,'levelup'=>$levelup);
				}
				else{
					$result = array('status' => 'salah');
				}

				echo json_encode($result);
			}
			else if( $action == 'jawab' && isset($post['hidden-jenis-soal']) ){
				$id = $post['hidden-id'];
				if($post['hidden-jenis-soal'] == 'pg'){
					$jawabanmahasiswa = $post['jawaban-pg'];
				}
				else if($post['hidden-jenis-soal'] == 'essay'){
					$jawabanmahasiswa = $post['jawaban-essay'];
				}
				$jawabanbenar= $this->soal_model->count(array("id_soal"=>"$id","jawaban LIKE"=> "%$jawabanmahasiswa%"));

				if($jawabanmahasiswa==''){
					$result = array('status' => 'empty');
				}
				else if($jawabanbenar>0){
					$result = array('status' => 'benar');
				}
				else{
					$result = array('status' => 'salah');
				}
				echo json_encode($result);
			}
			else if( $action == 'read' ){
				$post= $this->input->post(NULL,TRUE);

				//=== read post berdasarkan id ===//
				if(!empty($post['id'])){
					$record = $this->isimateri_model->get_pembahasan($post['id']);
					$record2 = $this->isimateri_model->get_soal($post['id']);
					echo json_encode(array('status' => 'success', 'data' => $record, 'data_soal'=> $record2));
				}
				//=== read semua data  ===//
				else{
					$total_rows = $this->isimateri_model->count();
					$record = $this->isimateri_model->get_all_isi(array('materi_id' => $id_materi));
				}
				echo json_encode(array(
					'total_rows' => $total_rows,
					'perpage' => $SConfig ->_backend_perpage,
					'record' => $record
				));
			}
		}
		else{
			$data['data'] = $this->isimateri_model->get_all_isi(array('materi_id' => $id_materi));
			$this->libs->view('start',$data);
		}	
	}


	

}