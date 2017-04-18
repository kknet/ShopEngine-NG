<?php
		define('shopengine',true);
		if($_SERVER['REQUEST_METHOD'] == 'POST') {
		include("../includes/db_connect.php"); 
		include("functions.php");
		include("variables.php");

			$id = clear_string($_POST['id']);
			$result = mysql_query("SELECT * FROM templates WHERE id='$id'",$link);
			$row = mysql_fetch_array($result);
				if(file_exists('../../templates/'.$id)) {
					rmdir('../../style');
					$src = '../../templates/'.$id;
					$dst = '../../';
					my_copy_all($src,$dst,true); 
					do {
						$update = mysql_query("UPDATE templates SET active='0'",$link);
					}
					while ($row = mysql_fetch_array($result));

						$update = mysql_query("UPDATE templates SET active='1' WHERE id='$id'",$link);

					echo 'Тема активирована';
				}
				else {
					echo 'Произошла ошибка';
				}
			}

?>