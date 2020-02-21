<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kelas extends Backend_Controller {

	public function __construct(){
		parent::__construct();		
	}

	public function index(){
		if($this->session->userdata('hak_akses') !='admin'){
			redirect(set_url('dashboard'));
		}
		$data = array();
		$this->libs->view('kelas', $data);
	}

	public function crud($param){
		global $SConfig; 
		if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER ['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'){ 
			//jika button di click dengan form action create/update
			if($param=='create' || $param=='update'){ 					

				if($param == 'update'){
					$rules = $this->kelas_model	->update_rules;					
				}
				else{
					$rules = $this->kelas_model	->create_rules;
				}

				//mengatur rules untuk form validation 						
				$this->form_validation->set_rules($rules); 				

				//jika data yang di inputkan sesuai dengan form validation/rules (BENAR)
				if($this->form_validation->run() == TRUE){  			
					$post = $this->input->post();   

					//memasukan data yang ada pada post ke dalam database
					$data = array(    									
			 				'nama_kelas' =>$post['nama-kelas'],
							'tahun_angkatan'=>$post['tahun-angkatan'],
							'semester' => $post['semester']
					); 

					$is_exist = $this->kelas_model->count(array('nama_kelas LIKE' => $data['nama_kelas']));

					//jika ada hidden id maka lakukan update
					if(!empty($post['hidden-id'])){
						unset($data['nama_kelas']);
						$this->kelas_model->update($data, array('id_kelas'=> $post['hidden-id']));
						$result=array('status' =>'success');
						echo json_encode($result);
					}
					else if ($is_exist > 0){
						echo json_encode(array('status' =>'failed', 'error' => 'is_exist'));
					}

					//jika hidden id kosong maka lakukan create/insert
					else{
						if($this->kelas_model->insert($data)){   		
						$result=array('status' =>'success');
						echo json_encode($result);
						}
						//jika tidak sesuai dengan form validation maka status ajax failed dan membatalkan insert
						else{ 											
							$result=array('status' =>'failed');
							echo json_encode($result);
						}
					}
				}
				else{
					$result=array('status' =>'failed','errors'=> $this->form_validation->error_array());
					echo json_encode($result);
				}			
			}

			else if($param =='read'){
				$post= $this->input->post(NULL,TRUE);

				//=== read post id dari url kelas untuk form update===//
				if(!empty($post['id'])){
					$record = $this->kelas_model->get($post['id']);
					echo json_encode(array('status' => 'success', 'data' => $record));
				}
				//=== read semua data kelas ===//
				else{
					$total_rows = $this->kelas_model->count();
					$offset = NULL;

					if(!empty($post['hal_aktif']) && $post > 1 ){
						$offset = ($post['hal_aktif'] - 1) * $SConfig->_backend_perpage;
					}
						if (!empty($post['cari']) && ($post['cari'] != 'null')){
							$cari =$post['cari'];
							$total_rows = $this->kelas_model->count(array("nama_kelas LIKE" => "%$cari%"));
							@$record =$this->kelas_model->get_by(array("nama_kelas LIKE"=> "%$cari%"),$SConfig->_backend_perpage,$offset);
						}
						else{
							$record = $this->kelas_model->get_by(NULL,$SConfig->_backend_perpage,$offset);
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
					$this->kelas_model->delete($post['hidden-id']);
					echo json_encode(array('status' =>'success'));
				}
				else{
					echo json_encode($result);
				}
			}
		}
	}




}