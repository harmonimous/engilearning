<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kategori extends Backend_Controller {

	public function __construct(){
		parent::__construct();		
	}

	public function index(){
		if($this->session->userdata('hak_akses') !='admin'){
			redirect(set_url('dashboard'));
		}
		$data = array();
		$this->libs->view('kategori', $data);
	}

	public function crud($param){
		global $SConfig; 
		if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER ['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'){ 
			//jika button di click dengan form action create/update
			if($param=='create' || $param=='update'){ 					

				if($param == 'update'){
					$rules = $this->kategori_model->update_rules;					
				}
				else{
					$rules = $this->kategori_model->create_rules;
				}

				//mengatur rules untuk form validation 						
				$this->form_validation->set_rules($rules); 				

				//jika data yang di inputkan sesuai dengan form validation/rules (BENAR)
				if($this->form_validation->run() == TRUE){  			
					$post = $this->input->post();   

					//memasukan data yang ada pada post ke dalam database
					$data = array(
						'kode_kategori' =>$post['kode-kategori'],
						'kategori' =>$post['nama-kategori']
					); 

					$is_exist = $this->kategori_model->count(array('kode_kategori LIKE' => $data['kode_kategori']));

					//jika ada hidden id maka lakukan update
					if(!empty($post['hidden-id'])){
						unset($data['kode_kategori']);
						$this->kategori_model->update($data, array('id_kategori'=> $post['hidden-id']));
						$result=array('status' =>'success');
					}
					else if ($is_exist > 0){
						$result=array('status' =>'duplicate');
					}

					//jika hidden id kosong maka lakukan create/insert
					else{
						$this->kategori_model->insert($data);	
						$result = array('status' =>'success');
					}
				}
				else{
					$result=array('status' =>'failed','errors'=> $this->form_validation->error_array());
				}
				echo json_encode($result);
			}

			else if($param =='read'){
				$post= $this->input->post(NULL,TRUE);

				//=== read post id dari url kelas untuk form update===//
				if(!empty($post['id'])){
					$record = $this->kategori_model->get($post['id']);
					echo json_encode(array('status' => 'success', 'data' => $record));
				}
				//=== read semua data ===//
				else{
					$total_rows = $this->kategori_model->count();
					$offset = NULL;

					if(!empty($post['hal_aktif']) && $post > 1 ){
						$offset = ($post['hal_aktif'] - 1) * $SConfig->_backend_perpage;
					}
						if (!empty($post['cari']) && ($post['cari'] != 'null')){
							$cari =$post['cari'];
							$total_rows = $this->kategori_model->count(array("kategori LIKE" => "%$cari%"));
							@$record =$this->kategori_model->get_by(array("kategori LIKE" => "%$cari%"),$SConfig->_backend_perpage,$offset);
						}
						else{
							$record = $this->kategori_model->get_by(NULL,$SConfig->_backend_perpage,$offset);
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
					$this->kategori_model->delete($post['hidden-id']);
					echo json_encode(array('status' =>'success'));
				}
				else{
					echo json_encode($result);
				}
			}
		}
	}




}