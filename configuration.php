<?php
	define('url', "http://" . $_SERVER['SERVER_NAME'] . '/dev-ci/engilearning');
	define('doc_root', str_replace('\\', "/", dirname(__FILE__)) );

	class SConfig{
		var $_site_url = url;
		var $_document_root = doc_root;
		var $_host_name = "localhost";
		var $_site_name = "Engilearning";
		var $_database_name = "db_engilearning";
		var $_database_user = "root";
		var $_database_password = "";
		var $_table_prefix = "tb_";
		var $_cms_name = "Informatika";
		var $_backend_perpage = 6;
		var $_frontend_perpage = 4;
		var $_hal_aktor = 10;
	}
?>

