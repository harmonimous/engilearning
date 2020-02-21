<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Materi extends Backend_Controller {

	public function __construct(){
		parent::__construct();	
		$this->load->model(array('isimateri_model','pembahasan_model','soal_model'));	
	}

	public function index(){
		$data['matakuliah'] = $this->matakuliah_model->get();
		$this->libs->view('materi', $data);
	}

	public function crud($param){
		global $SConfig; 
		if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER ['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'){ 
			//jika button di click dengan form action create/update
			if($param=='create' || $param=='update'){ 					

				//memakai rules yang ada pada materi model
				$rules=$this->materi_model->create_rules;

				//mengatur rules untuk form validation 						
				$this->form_validation->set_rules($rules); 				

				//jika data yang di inputkan sesuai dengan form validation/rules (BENAR)
				if($this->form_validation->run() == TRUE){  			
					$post = $this->input->post();   

					//memasukan data yang ada pada post ke dalam database
					$data = array(    									
			 				'judul_materi' =>$post['judul-materi'],
							'matakuliah_id'=>$post['matakuliah'],
							'keterangan'=>$post['keterangan'],
							'status_materi' =>'Belum Tersedia'
					); 


					$is_exist = $this->materi_model->count(array('judul_materi LIKE' => $data['judul_materi']));

					//jika ada hidden id maka lakukan update
					if(!empty($post['hidden-id'])){
						$this->materi_model->update($data, array('id_materi'=> $post['hidden-id']));
						$result=array('status' =>'success');
					}
					else if ($is_exist > 0){
						$this->materi_detail = $this->materi_model->get_by(array('judul_materi' => $data['judul_materi']), 1, NULL, TRUE);
						$this->materi_model->update($data, array('judul_materi'=> $data['judul_materi']));
						$result=array('status' =>'success');
					}

					//jika hidden id kosong maka lakukan create/insert
					else{
						//jika sesuai dengan form validation maka status ajax success dan create data
						if($this->materi_model->insert($data)){   		
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

				//=== read post id dari url materi untuk form update===//
				if(!empty($post['id'])){
					$record = $this->materi_model->get($post['id']);
					echo json_encode(array('status' => 'success', 'data' => $record));
				}
				//=== read semua data materi ===//
				else{
					$total_rows = $this->materi_model->count();
					$offset = NULL;

					if(!empty($post['hal_aktif']) && $post > 1 ){
						$offset = ($post['hal_aktif'] - 1) * $SConfig->_backend_perpage;
					}
						if (!empty($post['matakuliah']) && ($post['matakuliah'] != 'null')){
							$filter =$post['matakuliah'];
							$total_rows = $this->materi_model->count(array("matakuliah_id LIKE" => "%$filter%"));
							@$record =$this->materi_model->get_materi_dan_matakuliah(array("matakuliah_id LIKE"=> "%$filter%"),$SConfig->_backend_perpage,$offset);
						}
						else if (!empty($post['cari']) && ($post['cari'] != 'null')){
							$cari =$post['cari'];
							$total_rows = $this->materi_model->count(array("judul_materi LIKE" => "%$cari%"));
							@$record =$this->materi_model->get_materi_dan_matakuliah(array("judul_materi LIKE"=> "%$cari%"),$SConfig->_backend_perpage,$offset);
						}
						else{
							$record = $this->materi_model->get_materi_dan_matakuliah(NULL,$SConfig->_backend_perpage,$offset,FALSE,"{PRE}materi .*,nama_matakuliah");
						}
						echo json_encode(
							array(
								'total_rows' => $total_rows,
								'perpage' => $SConfig ->_backend_perpage,
								'record' => $record,
								'matakuliah' => $this->matakuliah_model->get_by(
									array('id_matakuliah'),
									NULL,NULL,FALSE, 'id_matakuliah, nama_matakuliah')
							)
						);
					}
			}

			else if ($param =='delete'){
				$post= $this->input->post(NULL,TRUE);
				if(!empty($post['hidden-id'])){
					$this->materi_model->delete($post['hidden-id']);
					echo json_encode(array('status' =>'success'));
				}
				else{
					echo json_encode($result);
				}
			}
		}
	}

    public function isi($id_materi='',$action=''){
    	global $SConfig; 
		if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'){ 
			if($action=='create' || $action=='update'){
				$post = $this->input->post();
				$rulesisi=$this->isimateri_model->create_rules;
				$rules_pembahasan=$this->pembahasan_model->create_rules;
				$rules_soal=$this->soal_model->create_rules;

				if($post['tipe-isi']=="pembahasan"){
					$this->form_validation->set_rules($rulesisi);
					$this->form_validation->set_rules($rules_pembahasan);
					if($this->form_validation->run() == TRUE){
						$dataprimary = array(
			 				'sub_judul' =>$post['sub-judul'],
							'tipe_isi'=>$post['tipe-isi'],
							'materi_id'=>$id_materi
						); 			
						$datapembahasan = array('isi_pembahasan' =>$post['isi-pembahasan']);

						//jika tidak ada hidden id maka lakukan update
						if(empty($post['hidden-id'])){
							$id = $this->isimateri_model->insert($dataprimary);
							$datapembahasan['isi_id'] = $id;

							if(!empty($_FILES['filemateri'])){
								$type = 'materi';
								$this->libs->create_dir($type);
								$this->load->library('upload', $this->libs->media_upload_config($type));

								if($this->upload->do_upload('filemateri')){
									$upload_data = $this->upload->data();
									$datapembahasan['lampiran_materi'] = $upload_data['file_name'];
								}		
							}
							else{
								$datapembahasan['lampiran_materi']='no file';
							}
							$this->pembahasan_model->insert($datapembahasan);	
							$result=array('status' =>'success');
						}
						else{

							if(!empty($_FILES['filemateri'])){
								$type = 'materi';
								$this->libs->create_dir($type);
								$this->load->library('upload', $this->libs->media_upload_config($type));

								if($this->upload->do_upload('filemateri')){
									unlink($SConfig->_document_root.'/uploaded/materi/'.$post['filelama']);
									$upload_data = $this->upload->data();
									$datapembahasan['lampiran_materi'] = $upload_data['file_name'];
								}			
							}
							else{
								unset($data['lampiran_materi']);
							}

							$this->isimateri_model->update($dataprimary, array('id_isi'=> $post['hidden-id']));
							$this->pembahasan_model->update($datapembahasan, array('id_pembahasan'=> $post['hidden-id2']));
							$result=array('status' =>'success');
						}
					}
					else{
						$result=array('status' =>'failed','errors'=> $this->form_validation->error_array());
					}
				}
				else if($post['tipe-isi']=="soal"){
					$this->form_validation->set_rules($rulesisi);
					$this->form_validation->set_rules($rules_soal);
					if($this->form_validation->run() == TRUE){
						$dataprimary = array(
			 				'sub_judul' =>$post['sub-judul'],
							'tipe_isi'=>$post['tipe-isi'],
							'materi_id'=>$id_materi
						); 			
						$datasoal = array(
							'jenis_soal' =>$post['jenis-soal'],
							'pertanyaan' =>$post['pertanyaan'],
							'jawaban' =>$post['jawaban']
						);

						//jika ada hidden id maka lakukan create
						if(empty($post['hidden-id'])){
							$id = $this->isimateri_model->insert($dataprimary);
								if($post['jenis-soal'] =="pg"){

									$datasoal['pilihan_1'] = $post['pilihan1'];
									$datasoal['pilihan_2'] = $post['pilihan2'];
									$datasoal['pilihan_3'] = $post['pilihan3'];
									$datasoal['pilihan_4'] = $post['pilihan4'];
									$datasoal['isi_id'] = $id;
									
								}else{
									$datasoal['isi_id'] = $id;
								}
							$this->soal_model->insert($datasoal);	
							$result=array('status' =>'success');
						}
						else{
							if($post['jenis-soal'] =="pg"){
								$datasoal['pilihan_1'] = $post['pilihan1'];
								$datasoal['pilihan_2'] = $post['pilihan2'];
								$datasoal['pilihan_3'] = $post['pilihan3'];
								$datasoal['pilihan_4'] = $post['pilihan4'];
							}else{
								$datasoal['pilihan_1'] = '';
								$datasoal['pilihan_2'] = '';
								$datasoal['pilihan_3'] = '';
								$datasoal['pilihan_4'] = '';
							}
							$this->isimateri_model->update($dataprimary, array('id_isi'=> $post['hidden-id']));
							$this->soal_model->update($datasoal, array('id_soal'=> $post['hidden-id2']));
							$result=array('status' =>'success');
						}
					}
					else{
						$result=array('status' =>'failed','errors'=> $this->form_validation->error_array());
					}
				}
				else{
					$result=array('status' =>'failed');
				}				
				echo json_encode($result);
			}
			else if($action =='read'){
				$post= $this->input->post(NULL,TRUE);

				//=== read post id dari url materi untuk form update===//
				if(!empty($post['id'])){
					$record = $this->isimateri_model->get_pembahasan($post['id']);
					$record2 = $this->isimateri_model->get_soal($post['id']);
					echo json_encode(array('status' => 'success', 'data' => $record, 'data_soal'=> $record2));
				}
				//=== read semua data  ===//
				else{
					$total_rows = $this->isimateri_model->count();
					$offset = NULL;

					if(!empty($post['hal_aktif']) && $post > 1 ){
						$offset = ($post['hal_aktif'] - 1) * $SConfig->_backend_perpage;
					}
						 if (!empty($post['cari']) && ($post['cari'] != 'null')){
							$cari =$post['cari'];
							$total_rows = $this->isimateri_model->count(array("judul_materi LIKE" => "%$cari%"));
							@$record =$this->isimateri_model->get_by(array("judul_materi LIKE"=> "%$cari%"),$SConfig->_backend_perpage,$offset);
						}
						else{
							$record = $this->isimateri_model->get_by(array('materi_id' => $id_materi));
						}
						echo json_encode(
							array(
								'total_rows' => $total_rows,
								'perpage' => $SConfig ->_backend_perpage,
								'record' => $record,
								'matakuliah' => $this->matakuliah_model->get_by(
									array('id_matakuliah'),
									NULL,NULL,FALSE, 'id_matakuliah, nama_matakuliah')
							)
						);
					}
			}
			else if ($action =='delete'){
				$post= $this->input->post(NULL,TRUE);
				if(!empty($post['hidden-id'])){
    				$isi_detail = $this->isimateri_model->get_by(array('id_isi' => $post['hidden-id']), 1, NULL, TRUE);

					if($isi_detail->tipe_isi =="pembahasan"){

						if(!empty($post['filelama'])){
							$this->load->helper('file');
							unlink($SConfig->_document_root.'/uploaded/materi/'.$post['filelama']);
						}
					
					$this->pembahasan_model->delete_by(array('isi_id' => $post['hidden-id']));
					}
					else if($isi_detail->tipe_isi=="soal"){
					$this->soal_model->delete_by(array('isi_id' => $post['hidden-id']));
					}
					
					$this->isimateri_model->delete($post['hidden-id']);
					echo json_encode(array('status' =>'success'));
				}
				else{
					echo json_encode(array('status' =>'failed'));
				}
			}
			else if($action == 'sort'){
				$post = $this->input->post(NULL, TRUE);
				foreach($post['ID'] as $sort => $id)
				$this->isimateri_model->update(array('isi_sort' => $sort+1),array('id_isi' => $id));								
			}
		}
		else{
			$get_data = $this->materi_model->get($id_materi);
			$showdata=array(
				'id_materi' =>set_value('id_materi', $id_materi),
				'judul_materi' => set_value('judul_materi', $get_data->judul_materi)
			);
    		$this->libs->view('isi-materi', $showdata);
		}
    }	
    
}