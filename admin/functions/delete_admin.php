<?php

define('shopengine',true);
		if($_SERVER['REQUEST_METHOD'] == 'POST') {
		include("../includes/db_connect.php"); 
		include("functions.php");
		include("variables.php");

		$id = clear_string($_POST['id']);
		mysql_query("DELETE FROM admins WHERE id='$id'");
		echo 'true';
		}
?>