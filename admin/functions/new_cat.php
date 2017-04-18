<?php
		define('shopengine',true);
		if($_SERVER['REQUEST_METHOD'] == 'POST') {
		include("../includes/db_connect.php"); 
		include("functions.php");
		include("variables.php");

		$name = clear_string($_POST['cat_name']);
			if($name != "") {
				$update = mysql_query("INSERT INTO category_high_level(hign_disp_name) VALUES('".$name."')",$link);
				echo 'true';
		}
		else {
			echo 'false';
		}
	}
?>