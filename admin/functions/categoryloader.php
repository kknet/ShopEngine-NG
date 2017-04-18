<?php
		define('shopengine',true);
		if($_SERVER['REQUEST_METHOD'] == 'POST') {
		include("../includes/db_connect.php"); 
		include("functions.php");
		include("variables.php");
			$category = clear_string($_POST['cat']);
				$cat = mysql_query("SELECT * FROM category_middle_level WHERE table_id='$category'",$link);
						if (mysql_num_rows($cat) > 0) {
							$cat_row = mysql_fetch_array($cat);
									echo '<option disabled selected>Выберите подкатегорию</option>';
							do {
									echo '<option value="'.$cat_row["middle_id"].'">'.$cat_row["middle_disp_name"].'</option>';
							}
							while ($cat_row = mysql_fetch_array($cat));
						}
				else {
					echo '<option disabled selected>Выберите подкатегорию</option>';
				}
		}
?>