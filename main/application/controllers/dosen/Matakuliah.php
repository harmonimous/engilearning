<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Matakuliah extends Backend_Controller {

	public function __construct(){
		parent::__construct();		
	}

	public function index(){
		if($this->session->userdata('hak_akses') !='admin'){
			redirect(set_url('dashboard'));
		}
		$data['dosen'] = $this->dosen_model->get();
		$data['kategori'] = $this->kategori_model->get();
		$this->libs->view('matakuliah', $data);
	}

	public function crud($param){
		global $SConfig; 
		if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER ['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'){ 
			//jika button di click dengan form action create/update
			if($param=='create' || $param=='update'){ 					

				//memakai rules yang ada pada matakuliah model
				$rules=$this->matakuliah_model->create_rules;

				//mengatur rules untuk form validation 						
				$this->form_validation->set_rules($rules); 				

				//jika data yang di inputkan sesuai dengan form validation/rules (BENAR)
				if($this->form_validation->run() == TRUE){  			
					$post = $this->input->post();   

					//memasukan data yang ada pada post ke dalam database
					$data = array(    									
							'kode_matakuliah'=>$post['kode-matakuliah'],
			 				'nama_matakuliah' =>$post['nama-matakuliah'],
							'kategori_matakuliah'=>$post['kategori-matakuliah'],
							'semester' => $post['semester'],
							'dosen_pengampu'=> $post['dosen-pengampu'],
							'deskripsi_matakuliah'=>$post['editorvalue']
					); 


					$is_exist = $this->matakuliah_model->count(array('kode_matakuliah LIKE' => $data['kode_matakuliah']));

					//jika ada hidden id maka lakukan update
					if(!empty($post['hidden-id'])){
						if(!empty($_FILES['gambar'])){
								$type = 'images';
								$this->libs->create_dir($type);
								$this->load->library('upload', $this->libs->media_upload_config($type));

								if($this->upload->do_upload('gambar')){
									unlink($SConfig->_document_root.'/uploaded/images/'.$post['filelama']);
									$upload_data = $this->upload->data();
									$data['gambar_matakuliah'] = $upload_data['file_name'];
								}			
						}
						else{
							unset($data['gambar_matakuliah']);
						}
						unset($data['kode_matakuliah']);
						$this->matakuliah_model->update($data, array('id_matakuliah'=> $post['hidden-id']));
						$result=array('status' =>'success');
					}
					else if ($is_exist > 0){
						$result=array('status' =>'duplicate');
					}

					//jika hidden id kosong maka lakukan create/insert
					else{

						if(!empty($_FILES['gambar'])){
								$type = 'images';
								$this->libs->create_dir($type);
								$this->load->library('upload', $this->libs->media_upload_config($type));

								if($this->upload->do_upload('gambar')){
									$upload_data = $this->upload->data();
									$data['gambar_matakuliah'] = $upload_data['file_name'];;
								}			
						}
						else{
							$data['gambar_matakuliah']='No image';
						}
						if($this->matakuliah_model->insert($data)){   		
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

				//=== read post id dari url matakuliah untuk form update===//
				if(!empty($post['id'])){
					$record = $this->matakuliah_model->get($post['id']);
					echo json_encode(array('status' => 'success', 'data' => $record));
				}
				//=== read semua data matakuliah ===//
				else{
					$total_rows = $this->matakuliah_model->count();
					$offset = NULL;

					if(!empty($post['hal_aktif']) && $post > 1 ){
						$offset = ($post['hal_aktif'] - 1) * $SConfig->_backend_perpage;
					}
						if (!empty($post['cari']) && ($post['cari'] != 'null')){
							$cari =$post['cari'];
							$total_rows = $this->matakuliah_model->count(array("nama_matakuliah LIKE" => "%$cari%"));
							@$record =$this->matakuliah_model->get_by(array("nama_matakuliah LIKE"=> "%$cari%"),$SConfig->_backend_perpage,$offset);
						}
						else{
							$record = $this->matakuliah_model->get_by(NULL,$SConfig->_backend_perpage,$offset);
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
						unlink($SConfig->_document_root.'/uploaded/images/'.$post['filelama']);
					}

					$this->matakuliah_model->delete($post['hidden-id']);
					echo json_encode(array('status' =>'success'));
				}
				else{
					echo json_encode($result);
				}
			}
		}
	}


	


}