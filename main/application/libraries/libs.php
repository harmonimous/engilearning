<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class libs {

	public $side; 
	public $website_setting;
	public $_isHome = FALSE;
	public $_isCategory = FALSE;
	public $_isSearch = FALSE;
	public $_isDetail = FALSE;

	function view($pages, $data=NULL){
		$_this =& get_instance();

		$data ? 
			$_this->load->view($this->side.'/'.$pages, $data)
							// backend/index
				: 
					$_this->load->view($this->side.'/'.$pages);
	}

	function is_logged_in(){
		$_this =& get_instance();

		$user_session = $_this->session->userdata;

		if ($this->side == 'frontend'){
			if($_this->uri->segment(1) == 'login'){
				if(isset($user_session['log_status']) && $user_session['log_status'] == TRUE){
					redirect(set_url('profile'));
				}
			}
			else if($_this->uri->segment(1) == 'profile'){
				if(!isset($user_session['log_status']) && $user_session['log_status'] == ''){
					$_this->session->sess_destroy();
					redirect(set_url('login'));
				}
			}
		}
		if($this->side == 'backend'){
			if($_this->uri->segment(2) == 'login'){
				if(isset($user_session['hak_akses']) && $user_session['log_status'] == TRUE){
					redirect(set_url('dashboard'));
				}
			}
			else{
				if(!isset($user_session['log_status'])){
					$_this->session->sess_destroy();
					redirect(set_url('login'));
				}
				else if(!isset($user_session['hak_akses'])){
					redirect(site_url('error'));
				}
			}
		}
		else if ($this->side == 'learn'){
			if($_this->uri->segment(2) == 'learn'){
				if(!isset($user_session['log_status']) && $user_session['log_status'] == ''){
					$_this->session->sess_destroy();
					redirect(site_url('login'));
				}
			}
			else if($_this->uri->segment(2) == 'tugas'){
				if(!isset($user_session['log_status']) && $user_session['log_status'] == ''){
					$_this->session->sess_destroy();
					redirect(site_url('login'));
				}
			}
		}

	}

	function create_dir($type){
		global $SConfig;
		$_this =& get_instance();
		$path = $SConfig->_document_root.'/uploaded';
		
		/* jika folder user ada */
		if(is_dir($path.'/'.$type)){
			if(!is_dir($path.'/'.$type.'/')){
				mkdir($path.'/'.$type, 0755);
				touch($path.'/'.$type.'/'.'index.php');
			}
		}
		
		else{
			mkdir($path.'/'.$type, 755);
			touch($path.'/'.$type.'/'.'index.php');
			mkdir($path.'/'.$type, 0755);
			touch($path.'/'.$type.'/index.php');
		}		
	}	

	function media_upload_config($type){

		global $SConfig;
		$_this =& get_instance();		
		$path = $SConfig->_document_root.'/uploaded/';
		$realpath = $path.'/'.$type;
		
		$config['upload_path'] = $realpath;
		$config['allowed_types'] = 'jpg|png|jpeg|pdf|doc|docx|ppt|pptx|zip';
		$config['overwrite']='TRUE';
		$config['remove_spaces']='TRUE';
		$config['max_size']	= '2048';
		$config['max_width']  = '0';
		$config['max_height']  = '0';
		
		return $config;		
	}

	function file_upload_config($type){

		global $SConfig;
		$_this =& get_instance();		
		$path = $SConfig->_document_root.'/uploaded/';
		$realpath = $path.'/'.$type;
		
		$config['upload_path'] = $realpath;
		$config['allowed_types'] = 'pdf|doc|docx|ppt|pptx|zip';
		$config['overwrite']='TRUE';
		$config['remove_spaces']='TRUE';
		$config['max_size']	= '2048';
		$config['max_width']  = '0';
		$config['max_height']  = '0';
		
		return $config;		
	}		

	function resize_img($image=NULL, $width=NULL, $height=NULL, $type=NULL){
		global $SConfig;
		$_this =& get_instance();
		$_this->load->library('image_lib'); 
		
		/* definite globalvar */
		$hostname = $SConfig->_host_name; 
		$docroot = $SConfig->_document_root;
		$siteurl = $SConfig->_site_url;
		
		/* jika kosong maka jadikan nilai default */
		(!empty($width)) ? $width_image = $width : $width_image = 75;
		(!empty($height)) ? $height_image = $height : $height_image = 50;		
		
		/* change path to directory */
		$directory = str_replace($siteurl,$docroot,$image);
		
		/* change files name to new name */
		$get_latest_slash = strrpos($directory, '/');
		$file_name = substr($directory,	$get_latest_slash+1 );
		$extension = substr($file_name, strrpos($file_name, '.'));
		$file_name_without_ext = substr($directory,	$get_latest_slash+1, strrpos($file_name, '.') );
		$new_name = $file_name_without_ext.'_'.$width_image.'x'.$height_image.$extension;
		
		/* path baru */
		$new_path = str_replace($file_name, $new_name, $directory);
		
		/* new url */
		$new_url = str_replace($docroot,$siteurl, $new_path);
		
		$file_is_exist = file_exists($new_path);
		
		if($file_is_exist == TRUE){
			return $new_url;
		}
		else{
			/* configuration */
			$config['image_library'] = 'gd2';
			$config['source_image']	= $directory;
			$config['create_thumb'] = TRUE;
			$config['thumb_marker'] = '';
			$config['maintain_ratio'] = TRUE;
			
			if(file_exists($config['source_image'])){
				$img_size = getimagesize($config['source_image']);
				$t_ratio = $width/$height;
		      	$o_width = $img_size[0];
		      	$o_height = $img_size[1];
			
				if ((!empty($img_size)) && ($t_ratio > $o_width/$o_height)){
					$config['width'] = $width;
					$config['height'] = round( $width * ($o_height / $o_width));
					$y_axis = round(($config['height']/2) - ($height/2));
					$x_axis = 0;
				}
				else{
					$config['width'] = round( $height * ($o_width / $o_height));
					$config['height'] = $height;
					$y_axis = 0;
					$x_axis = round(($config['width']/2) - ($width/2));
				}				
			}
			
			else{
				$config['width'] = $width;
				$config['height'] = $height;
				$y_axis = 0;
				$x_axis = round(($config['width']/2) - ($width/2));				
			}

	  		
			$config['new_image'] = $new_path;
			
			/* load library image */
			$_this->image_lib->clear();
			$_this->image_lib->initialize($config);
			
			/* jika tidak ada masalah maka lakukan resize */
			$_this->image_lib->resize();
			
			$source_img01 = $config['new_image'];
			$config['image_library'] = 'gd2';
			$config['source_image'] = $source_img01;
			$config['create_thumb'] = false;
			$config['maintain_ratio'] = false;
			$config['width'] = $width;
			$config['height'] = $height;
			$config['y_axis'] = $y_axis ;
			$config['x_axis'] = $x_axis ;
			
			$_this->image_lib->clear();
			$_this->image_lib->initialize($config);
			$_this->image_lib->crop();
			/* return value */			
		}		

		return $new_url;
	}

	function is_url_admin(){
		$_this =& get_instance();
		if($_this->uri->total_segments() == 1 && $_this->uri->segment(1) == 'admin'){
			redirect(set_url('dashboard'));
		}
	}
	
}