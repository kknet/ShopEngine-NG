<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	define('shopengine',true);
			
		include("../includes/db_connect.php"); 
		include("functions.php");
		include("variables.php");

			$id = clear_string($_POST['id']);
			$title = clear_string($_POST['title']);
			$link = clear_string($_POST['link']);

		$update = mysql_query("UPDATE slider SET title='$title', piclink='$link' WHERE id='$id'");
			echo true;
		}
?>