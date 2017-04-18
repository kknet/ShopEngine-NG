<?php
		define('shopengine',true);
		if($_SERVER['REQUEST_METHOD'] == 'POST') {
		include("../includes/db_connect.php"); 
		include("functions.php");
		include("variables.php");

		$del = clear_string($_POST['del']);
		$sub = clear_string($_POST['sub']);
		if ($del != "" AND $sub != "") {
			mysql_query("DELETE FROM category_middle_level WHERE table_id='$del' AND middle_id='$sub'",$link);
			echo 'true';
		}
		else {
			echo 'false';
		}
	}
?>