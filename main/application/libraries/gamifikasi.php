<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class gamifikasi {

	function leveling($exp_gathered=NULL){
		$_this =& get_instance();

		//prepare 
		$id_session=$_this->session->userdata('id_user');
		$user = $_this->mahasiswa_model->get_mahasiswa($id_session);
		$levelup = FALSE;

		// get current data
		$recent_exp   = $user->point_exp;
		$recent_level = $user->level;
		$recent_max_exp   = $user->max_exp;

		//calculating experience point
		if ($recent_level>5){
			$calculated_exp = $recent_exp+ ($exp_gathered * 2.5) ;
		}
		else if ($recent_level>10){
			$calculated_exp = $recent_exp+ ($exp_gathered * 10) ;
		} 
		else{
			$calculated_exp = $recent_exp+$exp_gathered;
		}

		//do this while exp same or more than exp cap
		if ($calculated_exp >= $recent_max_exp) {

		   // level UP!
		   $level = $recent_level + 1;

		   // update exp cap for new user level 
		   $max_exp = $recent_max_exp * 2;

		   $levelup = TRUE;
		}

		if($levelup==TRUE){
			$data_detail = array('point_exp' => $calculated_exp ,'level' =>  $level,'max_exp' => $max_exp);
			$status = $level;
		}
		else{
			$data_detail = array('point_exp' => $calculated_exp);
			$status = 0;
		}

		//update user data
		$_this->detailmahasiswa_model->update($data_detail, array('identitas' => $id_session));
		return $status;
	}

	function progress(){
		$_this =& get_instance();

		//prepare 
		$id_session=$_this->session->userdata('id_user');
		$user = $_this->mahasiswa_model->get_mahasiswa($id_session);

		// get current data
		$recent_exp   = $user->point_exp;
		$recent_level = $user->level;
		$recent_max_exp   = $user->max_exp;

		$progress = ($recent_exp/$recent_max_exp)*100;
		return $progress;
	}

	function rewards($exp_gathered=NULL,$nim=NULL){
		$_this =& get_instance();

		//prepare 
		$user = $_this->mahasiswa_model->get_mahasiswa($nim);
		$levelup = FALSE;

		// get current data
		$recent_exp   = $user->point_exp;
		$recent_level = $user->level;
		$recent_max_exp   = $user->max_exp;

		//calculating experience point
		if ($recent_level>5){
			$calculated_exp = $recent_exp+ ($exp_gathered * 2.5) ;
		}
		else if ($recent_level>10){
			$calculated_exp = $recent_exp+ ($exp_gathered * 10) ;
		} 
		else{
			$calculated_exp = $recent_exp+$exp_gathered;
		}

		//do this while exp same or more than exp cap
		if ($calculated_exp >= $recent_max_exp) {

		   // level UP!
		   $level = $recent_level + 1;

		   // update exp cap for new user level 
		   $max_exp = $recent_max_exp * 2;

		   $levelup = TRUE;
		}

		if($levelup==TRUE){
			$data_detail = array('point_exp' => $calculated_exp ,'level' =>  $level,'max_exp' => $max_exp);
		}
		else{
			$data_detail = array('point_exp' => $calculated_exp);
		}

		//update user data
		$_this->detailmahasiswa_model->update($data_detail, array('identitas' => $nim));
		return $levelup;
	}

}
// this library develop by Muhamad Ilham firdaus 