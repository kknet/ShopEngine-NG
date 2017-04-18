<?php 

	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		define('shopengine',true);
		session_start();
		unset($_SESSION["admin_autorization"]);
		echo 'logout';
	}

?>