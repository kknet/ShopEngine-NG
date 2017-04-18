<?php
		define('shopengine',true);
		if($_SERVER['REQUEST_METHOD'] == 'POST') {
		include("../includes/db_connect.php"); 
		include("functions.php");
		include("variables.php");

		$del = clear_string($_POST['del']);
		if ($del != "") {
			mysql_query("DELETE FROM brands WHERE brand_id='$del'",$link);
			echo 'true';
		}
		else {
			echo 'false';
		}
	}
?>