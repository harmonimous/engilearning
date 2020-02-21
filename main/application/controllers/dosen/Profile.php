<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends Backend_Controller {

	public function __construct(){
		parent::__construct();	
		$this->load->helper('cookie');	
	}

	public function index(){
		$saya = $this->session->userdata('id_user');
		$data['matakuliah']= $this->matakuliah_model->get_by(array('dosen_pengampu' =>$saya));
		$this->libs->view('profile', $data);
	}

	public function edit($param=NULL){
		global $SConfig; 
		$saya = $this->session->userdata('id_user');
		if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'){
			if($param == 'update'){
				$rules = $this->dosen_model->rules_update;									
				$this->form_validation->set_rules($rules);

				$post = $this->input->post();

				if ($this->form_validation->run() == TRUE){
					$data = array(
							'password' => bCrypt($post['password'],12),
							'nama_dosen' => $post['nama-dosen'] ,							
							'email' => $post['email'],
							'handphone' => $post['handphone']
					);
					//-----------Gambar-----------//
					if(!empty($_FILES['gambar'])){
						$type = 'images';
						$this->libs->create_dir($type);
						$this->load->library('upload', $this->libs->media_upload_config($type));

						if($this->upload->do_upload('gambar')){

							if($post['filelama'] != 'default.png'){
								unlink($SConfig->_document_root.'/uploaded/images/'.$post['filelama']);
							}

							$upload_data = $this->upload->data();
							$data['gambar_dosen'] = $upload_data['file_name'];
						}
						else{
							$result = array('status' => 'failed', 'error' =>'upload_gagal');
						}
					}
					else{
						unset($data['gambar_dosen']);
					}
					//-----------Gambar berakhir-----------//


					//-----------password-----------//
					if(!empty($post['password']) && $post['password'] != $post['ulangipassword']) { 
						$result = array('status' => 'failed', 'error' =>'different');
					}
					else if(!empty($post['password']) && $post['password'] == $post['ulangipassword']){
						$data['password'] = bCrypt($post['password'],12);
					}
					else if(!empty($post['password'])){
						unset($data['password']);
					}
					//-----------password berakhir-----------//

					$this->dosen_model->update($data, array('nid' => $saya));
					$result = array('status' => 'success');
				}
				else{
					$result = array('status' => 'failed');
				}
				$this->session->sess_destroy();
				delete_cookie('nid'); delete_cookie('password');
				echo json_encode($result);
			}		
		}
		else{
			$data['dosen'] = $this->dosen_model->get($saya);
			$this->libs->view('edit-profile', $data);
		}
	}

	


}