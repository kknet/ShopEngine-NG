<?php defined('shopengine') or die('something wrong'); 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	define('shopengine',true);
			
		include("../includes/db_connect.php"); 
		include("functions.php");
		include("variables.php");

		$id_vari = clear_string($_POST['id']);
		$rating = clear_string($_POST['rating']);

	}

?>