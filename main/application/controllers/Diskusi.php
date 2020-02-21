<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Diskusi extends Learn_Controller {

	public function __construct(){
		parent::__construct();	
		$this->load->model(array('diskusi_model','materi_model'));
	}

	public function index($id=NULL,$param=NULL){
		global $SConfig; 
		if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER ['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'){ 
			if($param=='komentari' ){

				$rules=$this->diskusi_model->create_rules;
				$this->form_validation->set_rules($rules); 				

				if($this->form_validation->run() == TRUE){  			
					$post = $this->input->post();   
					$data = array(    									
							'materi_id'=>$id,
							'komentar' => $post['komentar'],
							'dari'=> $this->session->userdata('id_user')
					); 
						
					if($this->diskusi_model->insert($data)){   		
						$result=array('status' =>'success');
					}
					else{ 											
						$result=array('status' =>'failed');
					}	
				}
				else{
					$result=array('status' =>'failed','errors'=> $this->form_validation->error_array());
				}
				echo json_encode($result);
			}

			else if ($param =='delete'){
				$post= $this->input->post(NULL,TRUE);
				if(!empty($post['hidden-id'])){
					$this->matakuliah_model->delete($post['hidden-id']);
					echo json_encode(array('status' =>'success'));
				}
				else{
					echo json_encode($result);
				}
			}
		}
		else{
			$data['materi'] = $this->materi_model->get($id);
			$data['count'] = $this->diskusi_model->count(array('materi_id' => $id));
			$data['komentar'] = $this->diskusi_model->get_komentar(array('materi_id' => $id),NULL, NULL, FALSE, "{PRE}diskusi.*, nama_mahasiswa, nim,gambar_mahasiswa");
			$this->libs->view('diskusi',$data);
		}

	}


}
