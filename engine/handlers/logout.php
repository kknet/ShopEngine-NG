<?php defined('shopengine') or die('something wrong'); 
	class logout {
		public function __construct() {

	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		session_start();
		unset($_SESSION["autorization"]);
		setcookie('remember_me','',0,'/');
		echo 'logout';
		}
	}
}

?>