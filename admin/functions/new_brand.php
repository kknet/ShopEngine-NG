<?php
		define('shopengine',true);
		if($_SERVER['REQUEST_METHOD'] == 'POST') {
		include("../includes/db_connect.php"); 
		include("functions.php");
		include("variables.php");

		$name = clear_string($_POST['brand_name']);
			if($name != "") {
				$update = mysql_query("INSERT INTO brands(brand_name) VALUES('".$name."')",$link);
				echo 'true';
		}
		else {
			echo 'false';
		}
	}
?>