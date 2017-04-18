<?php
		define('shopengine',true);
		if($_SERVER['REQUEST_METHOD'] == 'POST') {
		include("../includes/db_connect.php"); 
		include("functions.php");
		include("variables.php");

			$id = clear_string($_POST['id']);
			$result = mysql_query("SELECT * FROM templates WHERE id='$id'",$link);
			$row = mysql_fetch_array($result);
			if($row['active'] == '1') {
				echo 'Нельзя удалять активную тему.';
			}
			else {
			if(file_exists('../../templates/'.$id)) {
				removeDirectory('../../templates/'.$id);
				unlink('../../templates/'.$id);
				$delete = mysql_query("DELETE FROM templates WHERE id='$id'");
				echo 'Тема удалена';
			}
			else {
				echo 'Файл темы не существует или перемещен';
			}
		}
	}
?>