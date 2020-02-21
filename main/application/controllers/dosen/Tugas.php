<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tugas extends Backend_Controller {

	public function __construct(){
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');
		$this->load->model(array('jawaban_model'));
	}

	public function index(){
		global $SConfig;	
		$saya = $this->session->userdata('id_user');

		$data['matakuliah'] = $this->matakuliah_model->get_by(array('dosen_pengampu' =>$saya));
		$data['kelas'] = $this->kelas_model->get();
		$this->libs->view('tugas', $data);
	}

	public function crud($param){
		global $SConfig; 
		$saya = $this->session->userdata('id_user');
		if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER ['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'){ 
			//jika button di click dengan form action create/update
			if($param=='create' || $param=='update'){ 					

				if($param == 'update'){
					$rules = $this->tugas_model	->update_rules;					
				}
				else{
					$rules = $this->tugas_model	->create_rules;
				}

				//mengatur rules untuk form validation 						
				$this->form_validation->set_rules($rules); 				

				//jika data yang di inputkan sesuai dengan form validation/rules (BENAR)
				if($this->form_validation->run() == TRUE){  			
					$post = $this->input->post();   

					//memasukan data yang ada pada post ke dalam database
					$data = array(    									
			 				'matakuliah_id' =>$post['matakuliah'],
							'tugas_kelas'=>$post['kelas'],
			 				'nama_tugas' =>$post['nama-tugas'],
			 				'deskripsi_tugas' =>$post['deskripsi'],
							'waktu_berakhir'=>$post['waktu-berakhir'],
							'dibuat_oleh' => $saya
					); 


					//jika ada hidden id maka lakukan update
					if(!empty($post['hidden-id'])){
						if(!empty($_FILES['filetugas'])){
								$type = 'tugas';
								$this->libs->create_dir($type);
								$this->load->library('upload', $this->libs->media_upload_config($type));

								if($this->upload->do_upload('filetugas')){
									unlink($SConfig->_document_root.'/uploaded/tugas/'.$post['filelama']);
									$upload_data = $this->upload->data();
									$data['file_tugas'] = $upload_data['file_name'];
								}			
						}
						else{
							unset($data['file_tugas']);
						}
						$this->tugas_model->update($data, array('id_tugas'=> $post['hidden-id']));
						$result=array('status' =>'success');
					}

					//jika hidden id kosong maka lakukan create/insert
					else{

						if(!empty($_FILES['filetugas'])){
								$type = 'tugas';
								$this->libs->create_dir($type);
								$this->load->library('upload', $this->libs->media_upload_config($type));

								if($this->upload->do_upload('filetugas')){
									$upload_data = $this->upload->data();
									$data['file_tugas'] = $upload_data['file_name'];
								}			
						}
						else{
							$data['lampiran_materi']='no file';
						}
						if($this->tugas_model->insert($data)){   		
						$result=array('status' =>'success');
						}
						//jika tidak sesuai dengan form validation maka status ajax failed dan membatalkan insert
						else{ 											
							$result=array('status' =>'failed');
						}
					}
				}
				else{
					$result=array('status' =>'failed','errors'=> $this->form_validation->error_array());
				}
				echo json_encode($result);
			}

			else if($param =='read'){
				$post= $this->input->post(NULL,TRUE);

				//=== read post id dari url tugas untuk form update===//
				if(!empty($post['id'])){
					$record = $this->tugas_model->get_tugas($post['id']);
					echo json_encode(array('status' => 'success', 'data' => $record));
				}
				//=== read semua data tugas ===//
				else{
					$total_rows = $this->tugas_model->count(array('dibuat_oleh' =>$saya));
					$offset = NULL;

					if(!empty($post['hal_aktif']) && $post > 1 ){
						$offset = ($post['hal_aktif'] - 1) * $SConfig->_backend_perpage;
					}
						 if (!empty($post['cari']) && ($post['cari'] != 'null')){
							$cari =$post['cari'];
							$total_rows = $this->tugas_model->count(array("nama_tugas LIKE" => "%$cari%"));
							@$record =$this->tugas_model->get_custom(array("nama_tugas LIKE"=> "%$cari%"),$SConfig->_backend_perpage,$offset);
						}
						else if (!empty($post['kelas']) && ($post['kelas'] != 'null')){
							$kelas =$post['kelas'];
							$total_rows = $this->tugas_model->count(array("nama_kelas LIKE" => "%$kelas%"));
							@$record =$this->tugas_model->get_custom(array("nama_kelas LIKE"=> "%$kelas%"),$SConfig->_backend_perpage,$offset);
						}
						else if (!empty($post['matakuliah']) && ($post['matakuliah'] != 'null')){
							$matakuliah =$post['matakuliah'];
							$total_rows = $this->tugas_model->count(array("nama_matakuliah LIKE" => "%$matakuliah%"));
							@$record =$this->tugas_model->get_custom(array("nama_matakuliah LIKE"=> "%$matakuliah%"),$SConfig->_backend_perpage,$offset);
						}
						else{
							$record = $this->tugas_model->get_custom(array('dosen_pengampu' =>$saya),$SConfig->_backend_perpage,$offset,FALSE,'{PRE}tugas.*,nama_matakuliah,nama_kelas,nama_dosen');
							}
						echo json_encode(
							array(
								'total_rows' => $total_rows,
								'perpage' => $SConfig ->_backend_perpage,
								'record' => $record
							)
						);
					}
			}

			else if ($param =='delete'){
				$post= $this->input->post(NULL,TRUE);
				if(!empty($post['hidden-id'])){
					if(!empty($post['filelama'])){
						$this->load->helper('file');
						unlink($SConfig->_document_root.'/uploaded/tugas/'.$post['filelama']);
						$this->tugas_model->delete($post['hidden-id']);
						echo json_encode(array('status' =>'success'));
					}else{
						$this->tugas_model->delete($post['hidden-id']);
						echo json_encode(array('status' =>'success'));
					}
				}
				else{
					echo json_encode(array('status' =>'failed'));
				}
			}	
		}
	}

	public function review($id_tugas=NULL,$param=NULL){
		global $SConfig; 
		$saya = $this->session->userdata('id_user');
		if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER ['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'){ 
			//jika button di click dengan form action create/update
			if($param=='update'){ 					
				
				//mengatur rules untuk form validation 	
				$rules = $this->jawaban_model->nilai_rules;						
				$this->form_validation->set_rules($rules); 				

				//jika data yang di inputkan sesuai dengan form validation/rules (BENAR)
				if($this->form_validation->run() == TRUE){  			
					$post = $this->input->post();   

					//memasukan data yang ada pada post ke dalam database
					$data = array('nilai' =>$post['nilai-tugas']); 

					$this->jawaban_model->update($data, array('id_jawaban'=> $post['hidden-id']));
					$result=array('status' =>'success');
				}
				else{
					$result=array('status' =>'failed','errors'=> $this->form_validation->error_array());
				}
				echo json_encode($result);
			}

			else if($param =='read'){
				$post= $this->input->post(NULL,TRUE);

				//=== read post id dari url tugas untuk form update===//
				if(!empty($post['id'])){
					$record = $this->jawaban_model->get_jawaban_mahasiswa($post['id']);
					echo json_encode(array('status' => 'success', 'data' => $record));
				}
				//=== read semua data tugas ===//
				else{
					$total_rows = $this->jawaban_model->count(array('tugas_id' => $id_tugas));
					$offset = NULL;

					if(!empty($post['hal_aktif']) && $post > 1 ){
						$offset = ($post['hal_aktif'] - 1) * $SConfig->_backend_perpage;
					}
					if (!empty($post['cari']) && ($post['cari'] != 'null')){
						$cari =$post['cari'];
						$total_rows = $this->jawaban_model->count(array('tugas_id' => $id_tugas,"penjawab LIKE"=> "%$cari%"));
						@$record =$this->jawaban_model->get_by(array('tugas_id' => $id_tugas,"penjawab LIKE"=> "%$cari%"),$SConfig->_backend_perpage,$offset);
					}
					else{
						$record = $this->jawaban_model->get_jawaban_Custom(array('tugas_id' => $id_tugas),$SConfig->_backend_perpage,$offset,FALSE,"{PRE}jawaban.* ,nim,nama_mahasiswa");
					}
					echo json_encode(
						array(
							'total_rows' => $total_rows,
							'perpage' => $SConfig ->_backend_perpage,
							'record' => $record
						)
					);
				}
			}

			else if ($param =='delete'){
				$post= $this->input->post(NULL,TRUE);
				if(!empty($post['hidden-id'])){
					if(!empty($post['filelama'])){
						$this->load->helper('file');
						unlink($SConfig->_document_root.'/uploaded/tugas/'.$post['filelama']);
						$this->jawaban_model->delete($post['hidden-id']);
						echo json_encode(array('status' =>'success'));
					}else{
						$this->tugas_model->delete($post['hidden-id']);
						echo json_encode(array('status' =>'success'));
					}
				}
				else{
					echo json_encode(array('status' =>'failed'));
				}
			}
		}
		else{
			$data['tugas'] = $this->tugas_model->get_tugas($id_tugas);
			$this->libs->view('review', $data);
		}
	}









}