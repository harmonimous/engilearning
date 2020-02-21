<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Media extends Backend_Controller {

	public function __construct(){
		parent::__construct();	
	}


	public function action($param,$type){
		global $SConfig;

		if($param == 'add'){
			$date = date('d-m-Y');
			$this->libs->create_dir($type,$date);
			$this->load->library('upload', $this->libs->media_upload_config($type,$date));

			if($this->upload->do_upload('filemateri')){
				$upload_data = $this->upload->data();
				$file_dir = $SConfig->_document_root.'/uploaded/'.$type.'/'.$date.'/'.$upload_data['file_name'];
				$status = array(
					'success' => 'TRUE',
					'lampiran'	=> $filefullpath
				);
			}
			else if($this->upload->do_upload('userfile')){
				$upload_data = $this->upload->data();
				$filefullpath = base_url().'uploaded/'.$type.'/'.$date.'/'.$upload_data['file_name'];
				$file_dir = $SConfig->_document_root.'/uploaded/'.$type.'/'.$date.'/'.$upload_data['file_name'];
				$status = array(
					'success' => 'TRUE',
					'file_original'	=> $filefullpath,
					'file_dir_original' =>$file_dir,
					'file_thumbnail' => $this->libs->resize_img($filefullpath,150,150,1)
				);
			}

			exit(json_encode($status));					
		}

		else if($param == 'hapus'){
			$post= $this->input->post(NULL,TRUE);

			if(!empty($post['file_dir_original'])){

				$file_dir_original   = $post['file_dir_original'];
				$this->load->helper('file');
					unlink($file_dir_original);
					echo json_encode(array('status' =>'success'));
			}
			else{
					echo json_encode(array('status' =>'failed'));
			}									
		}
	}

	public function file($param,$type){
		global $SConfig;
		/* jika aksinya adalah tambah ... */
		if($param == 'add'){
			$date = date('d-m-Y');
			$this->libs->create_dir($type,$date);
			$this->load->library('upload', $this->libs->media_upload_config($type,$date));

			if($this->upload->do_upload('filemateri')){
				$upload_data = $this->upload->data();
				$file_dir = $SConfig->_document_root.'/uploaded/'.$type.'/'.$date.'/'.$upload_data['file_name'];
				$status = array(
					'success' => 'TRUE',
					'lampiran'	=> $filefullpath
				);
			}else{
				$status = array('success' => 'FALSE');
			}
			
			exit(json_encode($status));					
		}

		else if($param == 'hapus'){
			$post= $this->input->post(NULL,TRUE);

			if(!empty($post['file_dir_original'])){

				$file_dir_original   = $post['file_dir_original'];
				$this->load->helper('file');
					unlink($file_dir_original);
					echo json_encode(array('status' =>'success'));
			}
			else{
					echo json_encode(array('status' =>'failed'));
			}									
		}	
	}
		
}
