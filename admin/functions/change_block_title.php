<?php
		define('shopengine',true);
		if($_SERVER['REQUEST_METHOD'] == 'POST') {
		include("../includes/db_connect.php"); 
		include("functions.php");
		include("variables.php");

		$title = clear_string($_POST["title"]);
		$id = clear_string($_POST["id"]);


		mysql_query("UPDATE article_blocks SET title='$title' WHERE id='$id'",$link);
	}
?>