<?php
		define('shopengine',true);
		if($_SERVER['REQUEST_METHOD'] == 'POST') {
		include("../includes/db_connect.php"); 
		include("functions.php");
		include("variables.php");

		$name = clear_string($_POST['subcat']);
		$cat = clear_string($_POST['cat_name']);
			if($name != "" AND $cat != "") {
				$update = mysql_query("INSERT INTO category_middle_level(table_id,middle_disp_name) VALUES('".$cat."','".$name."')",$link);
				echo 'true';
		}
		else {
			echo 'false';
		}
	}
?>