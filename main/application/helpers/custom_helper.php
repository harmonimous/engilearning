<?php
	global $data_matakuliah;
	global $detail_data;

	//mengambil directory file//
	function get_directory($dir_file){
		global $SConfig;
		$_this =& get_instance();
		return $SConfig->_site_url.'/'.$dir_file.'/'.$_this->libs->side.'/';
	}

	//mengambil directori file view//
	function get_view($view){
		$_this =& get_instance();
		return $_this->libs->view($view);
	}

	//menentukan url//
	function set_url($sub){
		$_this =& get_instance();
		if($_this->libs->side == 'backend'){
			return site_url('dosen/'.$sub);
		}
		else if($_this->libs->side == 'frontend'){
			return site_url($sub);
		}
		else if($_this->libs->side == 'learn'){
			return site_url('mahasiswa/learn/'.$sub);
		}
		else{ 
			return site_url($sub);
		}
	}

	function is_active_page_print($page,$class){
		$_this =& get_instance();
		if($_this->libs->side == 'frontend' && $page == $_this->uri->segment(1)){
			return $class;
		}
		else if($_this->libs->side == 'frontend' && $page == $_this->uri->segment(2)){
			return $class;
		}
		else if($_this->libs->side == 'backend' && $page == $_this->uri->segment(2)){
			return $class;
		}
	}

	function is_login_link(){
		$_this =& get_instance();
		$user_session = $_this->session->userdata;

		if(!empty($user_session['mahasiswa'])){
			return site_url('mahasiswa/profile');
		}
		else if (!empty($user_session['hak_akses'])){
			return site_url('dosen/profile');
		}
		else{
			return set_url('login');
		}
	}

	function is_login_print(){
		$_this =& get_instance();
		$user_session = $_this->session->userdata;

		if(!empty($user_session['log_status'])){
			return 'PROFIL SAYA';
		}else{
			return 'LOGIN';
		}
	}

	//memberi title website//
	function title(){
		$_this =& get_instance();
		global $SConfig;

		$array = array( 'dashboard' => 'Dashboard',
						'mahasiswa' => 'Kelola Mahasiswa',
						'dosen'=>'Kelola Dosen',
						'kelas'=>'Kelola Kelas',
						'matakuliah'=>'Kelola Matakuliah',
						'materi'=>'Kelola Materi',
						'materi/isi'=>'Kelola isi Materi',
						'tugas'=>'Kelola Tugas',
						'kategori'=>'Kelola Kategori',
					);
		$title = NULL;
		if(array_key_exists($_this->uri->segment(2), $array)){
			return $array[$_this->uri->segment(2)].' | '.'Engilearning';
		}
	}

	//memberi header tittle website//
	function header_title(){
		$_this =& get_instance();
		global $SConfig;

		$array = array( 'dashboard' => 'Dashboard',
						'mahasiswa' => 'Kelola Mahasiswa',
						'dosen'=>'Kelola Dosen',
						'kelas'=>'Kelola Kelas',
						'matakuliah'=>'Kelola Matakuliah',
						'materi'=>'Kelola Materi',
						'materi/isi'=>'Kelola isi Materi',
						'tugas'=>'Kelola Tugas',
						'kategori'=>'Kelola Kategori',
					);
		$title = NULL;
		if(array_key_exists($_this->uri->segment(2), $array)){
			return $array[$_this->uri->segment(2)];
		}
	}
	
	//dropdown untuk hak_akses//
	function dropdown_hak_akses(){
		$options = array(
			''	=> 'Pilih',
	        'admin'	=> 'Admin',
	        'dosen'	=> 'Dosen',
		);
		
		return form_dropdown('group', $options, 0, 'id="group"');	
	}

	//dropdown untuk kategori matakuliah//
	function dropdown_kategori(){
		$options = array(
			''	=> 'Pilih Kategori',
	        'pemrograman'	=> 'Pemrograman',
	        'analisis_desain_sistem'	=> 'Analis dan Desain Sistem',
	        'kecerdasan_buatan'	=> 'Kecerdasan Buatan',
	        'matematika'	=> 'Matematika',
	        'jaringan'	=> 'Jaringan',
	        'algoritma'	=> 'Algoritma',
	        'etika_hukum_cyber'	=> 'Etika dan Hukum Cyber',
	        'statiska'	=> 'Statistika',
	        'kalkulus'	=> 'Kalkulus',
	        'keamanan'	=> 'Keamanan',
	        'data'	=> 'Management Data',
		);
		
		return form_dropdown('kategori-matakuliah', $options, '0','class="custom-select form-control"', 'id="kategori-matakuliah"');	
	}
	
	function dropdown_semester(){
		$options = array(
			''	=> 'Pilih Semester',
	        '1'	=> 'Semester 1',
	        '2'	=> 'Semester 2',
	        '3'	=> 'Semester 3',
	        '4'	=> 'Semester 4',
	        '5'	=> 'Semester 5',
	        '6'	=> 'Semester 6',
	        '7'	=> 'Semester 7',
	        '8'	=> 'Semester 8'
		);
		
		return form_dropdown('semester', $options, '0','class="custom-select form-control"', 'id="semester"');	
	}

	/* ************************************************ */
	/* **************** FRONT END ********************* */
	/* ************************************************ */

    function resize_img($image=NULL, $width=NULL, $height=NULL, $type=NULL){
    	$_this =& get_instance();

    	if(empty($image)){
    		$image = set_url('assets/images').'/no_image.jpg';
    	}

    	return $_this->libs->resize_img($image, $width, $height, $type);
    }	

    function rupiah($price){
    	return "Rp ".number_format(@$price,0,".", ".");
    }

    function have_data($tipe=NULL){
		global $data_matakuliah;
		global $SConfig;
		$_this =& get_instance();	

		$perpage = $SConfig->_frontend_perpage;	
		$have_data = FALSE;
		$result = '';		
		$offset = 0 ;

		if($_this->uri->segment(2) == 'hal'){
			(!empty($_this->uri->segment(3))) ? $offset = ($_this->uri->segment(3) - 1) * $perpage : $offset = 0;
			$array_where = NULL;
		}
		else{
			(!empty($_this->uri->segment(4))) ? $offset = ($_this->uri->segment(4) - 1) * $perpage : $offset = 0;
			$kategori = $_this->uri->segment(2);
			$array_where = array("kategori_matakuliah LIKE" => "%$kategori%");
		}
		
		/* yang ini digunakan ketika tipe dan kategori telah disetting ditemplate */
		if(!empty($tipe)){
			$result = $_this->matakuliah_model->get_matakuliah($array_where,$perpage,$offset); 						
		}

		/* jika resultnya lebih dari 0 isi arraynya */
		if(count($result) > 0) {
			$data_matakuliah = $result;
			$have_data = TRUE;
		}


		return $have_data;
	}

	function data_matakuliah(){
		global $data_matakuliah;
		return $data_matakuliah;		
	}

	function pagination_data($type=NULL){
		global $SConfig;
		$_this =& get_instance();
		$_this->load->library('pagination');
		$load_model = $type.'_model';
		$perpage = $SConfig->_frontend_perpage;			

		/* pagination config for post category */
		if($_this->uri->segment(2) == 'hal'){
			$base_url = set_url($type).'/hal';
			$total_rows = $_this->$load_model->count();
		}
		else{
			$kategori = $_this->uri->segment(2);
			$total_rows = $_this->$load_model->count(array("kategori_matakuliah LIKE" => "%$kategori%"));
			$base_url = set_url($type).'/'.$kategori.'/hal';
		}

		$config['base_url'] = $base_url;
        $config['total_rows'] = $total_rows;
        $config['per_page'] = $perpage;
        $config['full_tag_open'] = '<ul class="pagination-box">';
        $config['full_tag_close'] = '</ul>';            
        $config['prev_link'] = '&laquo;';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';
        $config['next_link'] = '&raquo;';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';	
        $config['first_link'] = FALSE;
		$config['first_tag_open'] = '<li><a class="Previous" href="#"><i class="zmdi zmdi-chevron-left"></i></a>';
		$config['first_tag_close'] = '</li>';
        $config['last_link'] = FALSE;
		$config['last_tag_open'] = '<li><a class="Next" href="#"><i class="zmdi zmdi-chevron-right"></i> </a>';
		$config['last_tag_close'] = '</li>';
		$config['use_page_numbers'] = TRUE ;


		$_this->pagination->initialize($config);

		return $_this->pagination->create_links();		
	}

	function kategori_matakuliah($data=NULL){
		global $detail_data;		
		$_this =& get_instance();

		if(empty($post)){
			$post = $detail_data;
		}

		if(!empty($data->kategori_matakuliah)){
			$allkategori = explode(',',$data->kategori_matakuliah);
			if(count($allkategori) > 0){
				foreach($allkategori as $kategori){
					return '<a href="'.permalink($data,$kategori).'">'.humanize($data->kategori).'</a>';
				}
			}
			else{
				return '<a href="'.permalink($data,$kategori).'">'.humanize($data->kategori).'</a>';
			}			
		}
	}

	function permalink($data=NULL,$kategori=NULL){
		$url = NULL;
		
		$url = set_url('matakuliah/').$kategori;

		return $url;
	}











?>