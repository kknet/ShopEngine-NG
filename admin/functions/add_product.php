<?php
	define('shopengine',true);
		if($_SERVER['REQUEST_METHOD'] == 'POST') {
		include("../includes/db_connect.php"); 
		include("functions.php");
		include("variables.php");

		$cat = clear_string($_POST['cat']);
		$subcat = clear_string($_POST['subcat']);
		$brand = clear_string($_POST['brand']);
		$title = clear_string($_POST['title']);

		$feat1 = clear_string($_POST['feat1']);
		$feat2 = clear_string($_POST['feat2']);
		$feat3 = clear_string($_POST['feat3']);
		$feat4 = clear_string($_POST['feat4']);
		$feat5 = clear_string($_POST['feat5']);
		$feat6 = clear_string($_POST['feat6']);
		$feat7 = clear_string($_POST['feat7']);
		$feat8 = clear_string($_POST['feat8']);
		$feat9 = clear_string($_POST['feat9']);
		$feat10 = clear_string($_POST['feat10']);

		$description = clear_string($_POST['description']);

		$feat_header1 = clear_string($_POST['feat_header1']);
		$feat_header2 = clear_string($_POST['feat_header2']);
		$feat_header3 = clear_string($_POST['feat_header3']);
		$feat_header4 = clear_string($_POST['feat_header4']);
		$feat_header5 = clear_string($_POST['feat_header5']);
		$feat_header6 = clear_string($_POST['feat_header6']);
		$feat_header7 = clear_string($_POST['feat_header7']);
		$feat_header8 = clear_string($_POST['feat_header8']);
		$feat_header9 = clear_string($_POST['feat_header9']);
		$feat_header10 = clear_string($_POST['feat_header10']);
		$feat_header11 = clear_string($_POST['feat_header11']);

		$feat_text1 = clear_string($_POST['feat_text1']);
		$feat_text2 = clear_string($_POST['feat_text2']);
		$feat_text3 = clear_string($_POST['feat_text3']);
		$feat_text4 = clear_string($_POST['feat_text4']);
		$feat_text5 = clear_string($_POST['feat_text5']);
		$feat_text6 = clear_string($_POST['feat_text6']);
		$feat_text7 = clear_string($_POST['feat_text7']);
		$feat_text8 = clear_string($_POST['feat_text8']);
		$feat_text9 = clear_string($_POST['feat_text9']);
		$feat_text10 = clear_string($_POST['feat_text10']);
		$feat_text11 = clear_string($_POST['feat_text11']);


		$old_price = clear_string($_POST['old_price']);
		$price = clear_string($_POST['price']);

		$sale = clear_string($_POST['sale']);
		$visible = clear_string($_POST['visible']);
		$available = clear_string($_POST['available']);
		$news = clear_string($_POST['news']);
		$popular = clear_string($_POST['popular']);

		if ($cat !== "" && $subcat !== "" && $brand !== "" && $title !== "" && $feat1 !== "" && $description !== "" && $feat_header1 !== "" && $feat_text1 !== "") {

				if ($sale == '1') {
					if($old_price == "") {
						$error = 1;
					}
					else {
						$error = 0;
					}
				}
				else {
					$error = 0;
				}

					if ($error == 0) {

						$brand_query = mysql_query("SELECT * FROM brands WHERE brand_id='$brand'");
							$brand_arrow = mysql_fetch_array($brand_query);
								$brand_name = $brand_arrow['brand_name'];


							mysql_query("INSERT INTO table_products(title,old_price,price,brand,description,features_field_1,features_field_2,features_field_3,features_field_4,features_field_5,features_field_6,features_field_7,features_field_8,features_field_9,features_field_10,features_header_1,features_header_2,features_header_3,features_header_4,features_header_5,features_header_6,features_header_7,features_header_8,features_header_9,features_header_10,features_header_11,features_text_1,features_text_2,features_text_3,features_text_4,features_text_5,features_text_6,features_text_7,features_text_8,features_text_9,features_text_10,features_text_11,datetime,new,leader,sale,visible,availability,type_of_product,brand_id) 
								VALUES (
									'".$title."',
									'".$old_price."',
									'".$price."',
									'".$brand_name."',
									'".$description."',	
									'".$feat1."',
									'".$feat2."',
									'".$feat3."',
									'".$feat4."',
									'".$feat5."',
									'".$feat6."',
									'".$feat7."',
									'".$feat8."',
									'".$feat9."',
									'".$feat10."',
									'".$feat_header1."',
									'".$feat_header2."',
									'".$feat_header3."',	
									'".$feat_header4."',
									'".$feat_header5."',
									'".$feat_header6."',
									'".$feat_header7."',
									'".$feat_header8."',
									'".$feat_header9."',
									'".$feat_header10."',
									'".$feat_header11."',
									'".$feat_text1."',
									'".$feat_text2."',
									'".$feat_text3."',
									'".$feat_text4."',
									'".$feat_text5."',	
									'".$feat_text6."',
									'".$feat_text7."',
									'".$feat_text8."',
									'".$feat_text9."',
									'".$feat_text10."',
									'".$feat_text11."',
									NOW(),
									'".$news."',
									'".$popular."',
									'".$sale."',
									'".$visible."',
									'".$available."',
									'".$subcat."',
									'".$brand."')",$link);
							$id = mysql_insert_id();
							echo $id;
					}

		}
		else {
			echo 'false';
		}
	}
?>