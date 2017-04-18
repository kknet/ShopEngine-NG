<?php 
		define('shopengine',true);
		if($_SERVER['REQUEST_METHOD'] == 'POST') {
		include("../includes/db_connect.php"); 
		include("functions.php");
		include("variables.php");

		$id = clear_string($_POST['id']);

		$result = mysql_query("SELECT * FROM table_products WHERE products_id='$id'",$link);
			$row = mysql_fetch_array($result);

			if ($row['image'] != "") {
			if(file_exists('../../products_img/'.$row['type_of_product'].'/'.$row['image'])) {
				unlink('../../products_img/'.$row['type_of_product'].'/'.$row['image']);
				mysql_query("UPDATE table_products SET image='' WHERE products_id='$id'",$link);
			}
		}
			$image = mysql_query("SELECT * FROM additional_images WHERE products_id='$id'");
				if (mysql_num_rows($image) > 0) {
					$image_row = mysql_fetch_array($image);

					do {
						$img_link = $image_row['add_img_id'];
						if(file_exists('../../products_img/'.$row['type_of_product'].'/'.$image_row['add_img_link'])) {
							unlink('../../products_img/'.$row['type_of_product'].'/'.$image_row['add_img_link']);
							mysql_query("DELETE FROM additional_images WHERE add_img_id='$img_link'",$link);
						}
					}
					while ($image_row = mysql_fetch_array($image));
				}
				mysql_query("DELETE FROM table_products WHERE products_id='$id'",$link);
				echo 'true';
			}
?>