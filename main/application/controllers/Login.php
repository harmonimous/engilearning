<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends Frontend_Controller {

	protected $detail_data;

	public function __construct(){
		parent::__construct();		
		$this->load->model(array('mahasiswa_model','dosen_model'));
		$this->load->helper('cookie');
	}

	public function index(){

		//==== Mengambil data yang di post ====//
		$post = $this->input->post(NULL, TRUE);	
		if(isset($post['nim'])){
		$this->detail_data = $this->mahasiswa_model->get_mahasiswa($post['nim']);
		}
		else{
		$this->form_validation->set_message('required', '%s kosong');
		}

		//=== Setting Rules ===//
		$rules = $this->mahasiswa_model->login_rules;
		$this->form_validation->set_rules($rules);

		//=== Validasi ===//
		if($this->form_validation->run() == FALSE){	
			$this->libs->view('login');
	    }
	    else{

	    	$login_data = array(
				'id_user' => $post['nim'],
		        'nama_user' => $this->detail_data->nama_mahasiswa,
		        'email' => $this->detail_data->email,   
		        'log_status' => TRUE,
		        'kelas' => $this->detail_data->kelas_id,  
		        'mahasiswa' => TRUE,
		        'picture' => $this->detail_data->gambar_mahasiswa 
			);

			$this->session->set_userdata($login_data);
			if(isset($post['ingat']) ){
				$expire = time() + (86400 * 7);
				set_cookie('nim', $post['nim'], $expire , "/");
				set_cookie('password', $post['password'], $expire , "/");
			}
			redirect(site_url('mahasiswa/profile'));
	    }
	}

	public function logout(){
		$this->session->sess_destroy();
		delete_cookie('nim'); delete_cookie('password');
		redirect(set_url('home'));
	}

	public function password_check($str){
    	$detail_data =  $this->detail_data;  	
    	if (@$detail_data->password == crypt($str,@$detail_data->password)){
			return TRUE;
		}
		else if(@$detail_data->password){
			$this->form_validation->set_message('password_check', 'Password yang Anda masukan salah, silahkan coba lagi.');
			return FALSE;
		}
		else{
			$this->form_validation->set_message('password_check', 'Anda Belum Terdaftar');
			return FALSE;	
		}		
	}	
































































































}