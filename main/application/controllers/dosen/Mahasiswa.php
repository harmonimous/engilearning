<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mahasiswa extends Backend_Controller {

	protected $login_detail;

	public function __construct(){
		parent::__construct();	
		$this->load->helper('cookie');
		$this->load->model(array('mahasiswa_model','detailmahasiswa_model'));
	}

	public function index(){
		if($this->session->userdata('hak_akses') !='admin'){
			redirect(set_url('dashboard'));
		}
		$data['kelas'] = $this->kelas_model->get();
		$this->libs->view('mahasiswa',$data);	
	}

	public function crud($param){
		global $SConfig;
		if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'){
			
			if($param == 'read'){
				$post = $this->input->post();

				if(!empty($post['nim'])){
					$record = $this->mahasiswa_model->get_mahasiswa($post['nim']);
					$record->gambar_mahasiswa = json_decode($record->gambar_mahasiswa);
					echo json_encode(array('status' => 'success', 'data' => $record));
				}
				else{	
					$offset = NULL;
					
					if(!empty($post['hal_aktif']) && $post['hal_aktif'] > 1){
						$offset = ($post['hal_aktif'] - 1) * $SConfig->_hal_aktor ;
					}

					if(!empty($post['cari']) && ($post['cari'] != 'null')){
						$search = $post['cari'];
						$total_rows = $this->mahasiswa_model->count(array("nama_mahasiswa LIKE" => "%$search%"));
						@$record = $this->mahasiswa_model->get_custom(array("nama_mahasiswa LIKE" => "%$search%"),$SConfig->_hal_aktor, $offset, FALSE, "{PRE}mahasiswa.*, {PRE}detail_mahasiswa.*, nama_kelas");
					}
					else{
						$record = $this->mahasiswa_model->get_custom(
							NULL,$SConfig->_hal_aktor,$offset,FALSE,"nim,nama_mahasiswa, nama_kelas");
						$total_rows = $this->mahasiswa_model->count();						
					}

					echo json_encode(array(
						'record' => $record,
						'total_rows' => $total_rows, 
						'perpage' => $SConfig->_hal_aktor
					) );					
				}			
			}

			else if($param == 'create' || $param == 'update'){

				if($param == 'update'){
					$rules = $this->mahasiswa_model->update_rules;		
				}else{
					$rules = $this->mahasiswa_model->create_rules;	
				}
							
				$this->form_validation->set_rules($rules);
				$post = $this->input->post();
				

				if ($this->form_validation->run() == TRUE){
					$data = array(
						'nim' => $post['nim'],
				        'password' => bCrypt($post['password'],12),
				        'nama_mahasiswa' => $post['nama-mahasiswa'],
				        'email' => $post['email']
					);
					

					if($param == 'update'){
						unset($data['nim']);
						if(!empty($post['password'])) { 
							$data['password'] = bCrypt($post['password'],12);
						}
						else{
							unset($data['password']);
						}

						$this->mahasiswa_model->update($data, array('nim' => $post['hidden-id']));
					}
					else{

						$defaultimg = 'default.png';
						$data['gambar_mahasiswa']=$defaultimg;
						
						$data_detail_baru = array(	
							'identitas' => $post['nim'],		
							'kelas_id' => $post['kelas'],
							'point_exp' => '0' ,
							'level' =>  '1',
							'max_exp' => '50'					
						);

						$this->mahasiswa_model->insert($data);
						$this->detailmahasiswa_model->insert($data_detail_baru);
					}
					$result = array('status' => 'success');
				}
				else{
					$result=array('status' =>'failed','errors'=> $this->form_validation->error_array());
				}

				echo json_encode($result);			
			}

			else if($param == 'delete'){
				$post = $this->input->post();
				if(!empty($post['hidden-id'])){
					$data_detail = $this->detailmahasiswa_model->get_by(array('identitas' => $post['hidden-id']), 1, NULL, TRUE);
					$this->detailmahasiswa_model->delete($data_detail->id_detail_mahasiswa);
					$this->mahasiswa_model->delete($post['hidden-id']);
					$result = array('status' => 'success');
				}

				echo json_encode($result);
			}
		}
	}

	public function nim_check($nim){
    	$is_exist = $this->mahasiswa_model->count(array('nim LIKE' => $nim)); 	
    	if ($is_exist > 0){		
    		$this->form_validation->set_message('nim_check', ' NIM Sudah ada!');
    		return FALSE;
    	}
		else{
			return TRUE;	
		}		
	}



}