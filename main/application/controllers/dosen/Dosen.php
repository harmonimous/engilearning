<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dosen extends Backend_Controller {

	protected $login_detail;

	public function __construct(){
		parent::__construct();	
		$this->load->helper('cookie');
		$this->load->model(array('dosen_model'));
	}

	public function index(){
		if($this->session->userdata('hak_akses') !='admin'){
			redirect(set_url('dashboard'));
		}
		$data = array();
		$this->libs->view('dosen',$data);		
	}

	public function crud($param){
		global $SConfig;
		if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'){
			
			if($param == 'read'){
				$post = $this->input->post();

				if(!empty($post['nid'])){
					$record = $this->dosen_model->get($post['nid']);
					$record->gambar_dosen = json_decode($record->gambar_dosen);
					echo json_encode(array('status' => 'success', 'data' => $record));
				}
				else{
					$offset = NULL;
					
					if(!empty($post['hal_aktif']) && $post['hal_aktif'] > 1){
						$offset = ($post['hal_aktif'] - 1) * $SConfig->_hal_aktor ;
					}

					if(!empty($post['hak']) && ($post['hak'] != 'null')){
						$hak = $post['hak'];
						$total_rows = $this->dosen_model->count(array("hak_akses LIKE" => "%$hak%"));
						@$record = $this->dosen_model->get_by(array("hak_akses LIKE" => "%$hak%"),$SConfig->_hal_aktor, $offset);
					}
					else if(!empty($post['cari']) && ($post['cari'] != 'null')){
						$search = $post['cari'];
						$total_rows = $this->dosen_model->count(array("nama_dosen LIKE" => "%$search%"));
						@$record = $this->dosen_model->get_dosen(array("nama_dosen LIKE" => "%$search%"),$SConfig->_hal_aktor, $offset, FALSE, "nid, nama_dosen, hak_akses, email, handphone");
					}
					else{
						$record = $this->dosen_model->get_dosen(NULL,$SConfig->_hal_aktor,$offset,FALSE, "nid,nama_dosen, hak_akses, email, handphone,gambar_dosen");	
						$total_rows = $this->dosen_model->count();						
					}

					echo json_encode(array(
						'record' => $record,
						'total_rows' => $total_rows, 
						'perpage' => $SConfig->_hal_aktor,
					) );					
				}			
			}

			else if($param == 'create' || $param == 'update'){

				if($param == 'update'){
					$rules = $this->dosen_model->rules_update;					
				}
				else{
					$rules = $this->dosen_model->rules_create;
				}
				
				$this->form_validation->set_rules($rules);

				$post = $this->input->post();
				$defaultimg = 'default.png';

				if ($this->form_validation->run() == TRUE){
					$data = array(
							'nid' => $post['nid'],
							'password' => bCrypt($post['password'],12),
							'nama_dosen' => $post['nama-dosen'] ,							
							'hak_akses' => (!empty($post['hak-akses'])) ? $hak_akses = $post['hak-akses'] : $hak_aksess = '',
							'email' => $post['email'],
							'handphone' => $post['handphone'],
							'gambar_dosen' => $defaultimg
					);

					unset($data['log_status']);

					if($param == 'update'){
						unset($data['email']);
						unset($data['nid']);
						if(!empty($post['password'])) { 
							$data['password'] = bCrypt($post['password'],12);
						}
						else{
							unset($data['password']);
						}
						$this->dosen_model->update($data, array('nid' => $post['hidden-id']));
						$getID = $post['hidden-id'];
					}
					else{
						$getID = $this->dosen_model->insert($data);
					}
					$result = array('status' => 'success');
				}
				else{
					$result = array('status' => 'failed');
				}

				echo json_encode($result);			
			}

			else if($param == 'delete'){
				$post = $this->input->post();
				if(!empty($post['hidden-id'])){
					$this->dosen_model->delete($post['hidden-id']);
					$result = array('status' => 'success');
				}
				echo json_encode($result);
			}			
		}
	}

	public function login(){

		//==== Mengambil data yang di post ====//
		$post = $this->input->post(NULL, TRUE);	
		
		if(isset($post['nid'])){
		$this->login_detail = $this->dosen_model->get_by(array('nid' => $post['nid']), 1, NULL, TRUE);	
		}
		else{
		$this->form_validation->set_message('required', '%s kosong');
		}

		//=== Setting Rules ===//
		$rules = $this->dosen_model->rules_login;
		$this->form_validation->set_rules($rules);

		//=== Validasi ===//
		if($this->form_validation->run() == FALSE){	
			$this->libs->view('login');
	    }
	    else{
	    	$login_data = array(
				'id_user' => $this->login_detail->nid,
		        'nama_user' => $this->login_detail->nama_dosen,
		        'email' => $this->login_detail->email,
		        'hak_akses' => $this->login_detail->hak_akses,
		        'picture' =>   $this->login_detail->gambar_dosen,
		        'log_status' => TRUE
			);
			$this->session->set_userdata($login_data);
			if(isset($post['ingat']) ){
				$expire = time() + (86400 * 7);
				set_cookie('nid', $post['nid'], $expire , "/");
				set_cookie('password', $post['password'], $expire , "/" );
			}
			
			if($login_data['hak_akses']=='admin'){
				redirect(set_url('dashboard'));
			}
			else{
				redirect(set_url('dashboard'));
			}
	    }
	}

	public function logout(){
		$this->session->sess_destroy();
		delete_cookie('nid'); delete_cookie('password');
		redirect(set_url('dosen/login'));
	}

	public function password_check($str){
    	$login_detail =  $this->login_detail;  	
    	if (@$login_detail->password == crypt($str,@$login_detail->password)){
			return TRUE;
		}
		else if(@$login_detail->password){
			$this->form_validation->set_message('password_check', 'Password yang Anda masukan salah, silahkan coba lagi.');
			return FALSE;
		}
		else{
			$this->form_validation->set_message('password_check', 'Anda tidak memiliki hak akses');
			return FALSE;	
		}		
	}
	
	public function temporary(){
			$data = array(
					'nid' => '14045',
					'password' => bCrypt('admin',12),
					'nama_dosen' => 'Harmonimous' ,							
					'hak_akses' => 'admin',
					'email' => 'harmonimous@gmail.com',
					'handphone' => '081912949885'
			);
			$this->dosen_model->insert($data);
	}




























































































}