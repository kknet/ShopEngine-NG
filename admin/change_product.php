<?php 
define('shopengine',true);
include("includes/db_connect.php"); 
include("functions/functions.php");
include("functions/variables.php");
session_start(); 

if ($_SESSION['admin_autorization'] == 'autorization_yes') {
$uri = $_SERVER['REQUEST_URI'];

if(isset($_GET['logout'])) {
	unset($_SESSION['admin_autorization']);
	header('Location: login.php', true, 301);
    exit();
}

$pr_id = clear_string($_GET['product']);
if ($_GET['product']) {

if($_POST['add_product_button']) {
		$cat = clear_string($_POST['product_cat']);
		$subcat = clear_string($_POST['product_subcat']);
		$brand = clear_string($_POST['product_brand']);
		$title = clear_string($_POST['product_title']);

		$description = nl2br(mysql_real_escape_string($_POST['editor1']));
		$mini_features = nl2br(mysql_real_escape_string($_POST['editor2']));

		$features_left = nl2br(mysql_real_escape_string($_POST['editor3']));
		$features_right = nl2br(mysql_real_escape_string($_POST['editor4']));

		$old_price = clear_string($_POST['old_price']);
		$price = clear_string($_POST['price']);

		$seo_desc = clear_string($_POST['seo_description']);
		$seo_keys = clear_string($_POST['seo_keys']);

		if (clear_string($_POST['sale'])) {
			$sale = '1';
		}
		else {
			$sale = '0';
		}
		if (clear_string($_POST['visible'])) {
			$visible = '1';
		}
		else {
			$visible = '0';
		}
		if (clear_string($_POST['available'])) {
			$available = '1';
		}
		else {
			$available = '0';
		}
		if (clear_string($_POST['news'])) {
			$news = '1';
		}
		else {
			$news = '0';
		}
		if (clear_string($_POST['popular'])) {
			$popular = '1';
		}
		else {
			$popular = '0';
		}

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


							if (mysql_query("UPDATE table_products SET title='$title',old_price='$old_price',price='$price',brand='$brand_name',mini_features='$mini_features',description='$description',features_left='$features_left',features_right='$features_right',new='$news',leader='$popular',sale='$sale',visible='$visible',availability='$available',type_of_product='$subcat',brand_id='$brand',seo_words='$seo_keys',seo_description='$seo_desc' WHERE products_id='$pr_id'",$link)) {
										$_SESSION['good_message'] = "Изменения сохранены";
							}
							else {
								$_SESSION['error_message'] = "Произошла ошибка. Убедитесь, что обязательные поля заполнены (обязательные поля отмечены звездочкой).";
							}
					}

		}
		else {
			$_SESSION['error_message'] = "Произошла ошибка. Убедитесь, что обязательные поля заполнены (обязательные поля отмечены звездочкой).";
		}
			if(empty($_POST['main_image'])) {
				if(empty($_FILES['main_image'])) {
					unset($_POST['main_image']);
				}
				else {
			$error_img = array();
			if ($_FILES['main_image']['error'] > 0) {
				switch($_FILES['main_image']['error']) {
					case 1:$error_img[] = "Размер файла превышает допустимое значение UPLOAD_MAX_FILE_SIZE"; break;
					case 2:$error_img[] = "Размер файла превышает допустимое значение MAX_FILE_SIZE"; break;
					case 3:$error_img[] = "Не удалось загрузить часть файла"; break;
					case 4:$error_img[] = "Файл не был загружен"; break;
					case 5:$error_img[] = "Отсутствует временная папка"; break;
					case 6:$error_img[] = "Отсутствует временная папка"; break;
					case 7:$error_img[] = "Не удалось записать файл на диск"; break;
					case 8:$error_img[] = "PHP-расширение остановило загрузку файла"; break;
				}
			}
			else {	

					if($_FILES['main_image']['type'] == 'image/jpeg' OR $_FILES['main_image']['type'] == 'image/jpg' OR $_FILES['main_image']['type'] == 'image/png') {
					$imagename = $_FILES['main_image']['name'];
					$path_info = pathinfo($imagename);
    				$img_extension = $path_info['extension'];
    				if ($img_extension != 'jpg' AND $img_extension != 'jpeg' AND $img_extension != 'png') {
    				}

    				if(file_exists('../products_img/'.$subcat.'/')) {
    					$uploaddir = '../products_img/'.$subcat.'/';
    				}
    				else {
    					mkdir("../products_img/".$subcat, 0777);
    					$uploaddir = '../products_img/'.$subcat.'/';
    				}

    					$newimagename = $subcat.$id.rand(10,1000).'.'.$img_extension;

    					$uploadedfile = $uploaddir.$newimagename;

    					if(move_uploaded_file($_FILES['main_image']['tmp_name'], $uploadedfile)) {
    						$update = mysql_query("UPDATE table_products SET image='$newimagename' WHERE products_id='$pr_id'",$link);
    					}
    					else {
    						$_SESSION['error_img_2'] = "Главное изображение: ошибка загрузки изображения. Убедитесь, что оно имеет нужный формат и не размер, который не превышает 2 МБ.";
    					}
    				}
    				else {
    					$_SESSION['error_img_2'] = "Главное изображение: допустимые расширения - jpeg, jpg, png";
    				}
    			}
    			if(count($error_img)) {
    				$_SESSION['error_img'] = implode('<br/>',$error_img);
    			}
    			unset($_POST['main_image']);
			}
		}
				if(empty($_POST['add_image'])) {

					if($_FILES['add_image']['name'][0]) {

					for ($i = 0; $i < count($_FILES['add_image']['name']); $i++) {
						if(!empty($_FILES['add_image']['type'][$i])) {
					if($_FILES['add_image']['type'][$i] == 'image/jpeg' OR $_FILES['add_image']['type'][$i] == 'image/jpg' OR $_FILES['add_image']['type'][$i] == 'image/png') {

					$imagename = $_FILES['add_image']['name'][$i];
					$path_info = pathinfo($imagename);
    				$img_extension = $path_info['extension'];

    				if(file_exists('../products_img/'.$subcat.'/')) {
    					$uploaddir = '../products_img/'.$subcat.'/';
    				}
    				else {
    					mkdir("../products_img/".$subcat, 0777);
    					$uploaddir = '../products_img/'.$subcat.'/';
    				}

    					$newimagename = $subcat.$id.rand(10,1000).$i.'.'.$img_extension;

    					$uploadedfile = $uploaddir.$newimagename;

    					if(@move_uploaded_file($_FILES['add_image']['tmp_name'][$i], $uploadedfile)) {
    						$update = mysql_query("INSERT INTO additional_images (products_id,add_img_link) VALUES('".$pr_id."','".$newimagename."')",$link);
    					}
    					else {
    						$_SESSION['error_add'] = "Дополнительные изображения: ошибка загрузки файла";
    					}
    				}
    				else {
    					$_SESSION['error_add'] = "Дополнительные изображения: допустимые расширения - jpeg, jpg, png";
    				}
    			}
    		}
    	
    			unset($_POST['add_image']);
			}
		}
	}
if(isset($_GET['delete'])) {
		$type = $_GET['type'];
		$id = $_GET['id'];
	if(file_exists('../products_img/'.$type.'/'.$_GET['delete'])) {
		unlink('../products_img/'.$type.'/'.$_GET['delete']);
		mysql_query("UPDATE table_products SET image='' WHERE products_id='$id'",$link);
		header('Location: change_product.php', true, 301);
    	exit();
	}
}	

if(isset($_GET['delete_add'])) {
		$type = $_GET['type'];
		$id = $_GET['id'];
	if(file_exists('../products_img/'.$type.'/'.$_GET['delete_add'])) {
		unlink('../products_img/'.$type.'/'.$_GET['delete_add']);
		mysql_query("DELETE FROM additional_images WHERE add_img_id='$id'",$link);
		header('Location: change_product.php', true, 301);
    	exit();
	}	
}


$result = mysql_query("SELECT * FROM table_products WHERE products_id='$pr_id'",$link);
		if (mysql_num_fields($result) > 0) {
			$row = mysql_fetch_array($result);

			$brand_id = $row['brand_id'];
			$subcat_id = $row['type_of_product'];
			$result = mysql_query("SELECT * FROM category_middle_level WHERE middle_id='$subcat_id'",$link);
			$subrow = mysql_fetch_array($result);
			$cat_hign = $subrow['table_id'];
			//$result = mysql_query("SELECT * FROM category_high_level WHERE high_id='$cat_hign'",$link);
			//$catrow = mysql_fetch_array($result);

		}

?>
<!DOCTYPE html>
<html> 
<head>
	<title>Панель управления - изменение товара</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="css/css.css">
    <!--<link href='https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900' rel='stylesheet' type='text/css'>-->
	<link rel="stylesheet" type="text/css" href="../fonts/fonts.css">
    <script type="text/javascript" src="js/jquery-1.7.1.min.js"></script>
    <script type="text/javascript" src="js/js.js"></script>
    <script type="text/javascript" src="plugins/ckeditor/ckeditor.js"></script>
    <script type="text/javascript" src="js/scriptjava.js"></script>
</head>
<body>
<?php include("includes/header.php"); ?>
<div id="admin_great_container">
<?php
	$active1 = 'class="active"';
	include("includes/left_sidebar.php"); 
?>
	<div id="admin_center_block">
		<p id="center_title"><a href="index.php">Главная</a> / <a href="products.php">товары</a> / изменение товара</p>
		<p id="center_header">Изменение товара: <a class="product_link" href="../product.php?id=<?php echo $row['products_id'];?>"><?php echo $row['title']?></a></p>
<?php
	if($_SESSION['chk_products'] == '1') {
?>
		<form enctype="multipart/form-data" id="add_product_form" method="post">
				<?php 
					if($_SESSION['error_img_2']) {
						echo '<p class="error_message">'.$_SESSION["error_img_2"].'</p><br/>';
						unset($_SESSION['error_img_2']);
					}
					if($_SESSION['error_img']) {
						echo '<p class="error_message">'.$_SESSION["error_img"].'</p><br/>';
						unset($_SESSION['error_img']);
					}
					if($_SESSION['error_message']) {
						echo '<p class="error_message">'.$_SESSION["error_message"].'</p><br/>';
						unset($_SESSION['error_message']);
					}
					if($_SESSION['error_add']) {
						echo '<p class="error_message">'.$_SESSION["error_add"].'</p><br/>';
						unset($_SESSION['error_add']);
					}
					if($_SESSION['good_message']) {
						echo '<p class="ok_message">'.$_SESSION["good_message"].'</p><br/>';
						unset($_SESSION['good_message']);
					} 
				?>
				<p class="form_title_cat">Категория добавляемого товара</p>
				<select id="product_cat" name="product_cat">
					<option disabled selected>Выберите категорию</option>

					<?php 

						$cat = mysql_query("SELECT * FROM category_high_level",$link);
							$cat_row = mysql_fetch_array($cat);

							do {
									$checked = "";
									if ($cat_row['high_id'] == $cat_hign) {
										$checked = 'selected';
									}
									echo '<option brand="'.$row['products_id'].'" value="'.$cat_row['high_id'].'" '.$checked.'>'.$cat_row['hign_disp_name'].'</option>';
							}
							while ($cat_row = mysql_fetch_array($cat));
					?>
				</select>
				<span id="product_add_cat">Добавить категорию</span><br/><br/>

				<select id="product_subcat" name="product_subcat">
					<option disabled selected>Выберите подкатегорию</option>
					<?php 

					$cat = mysql_query("SELECT * FROM category_middle_level WHERE table_id='$cat_hign'",$link);
						if (mysql_num_rows($cat) > 0) {
							$cat_row = mysql_fetch_array($cat);
							do {
									$checked = "";
									if ($cat_row['middle_id'] == $subcat_id) {
										$checked = 'selected';
									}	
									echo '<option value="'.$cat_row["middle_id"].'" '.$checked.'>'.$cat_row["middle_disp_name"].'</option>';
							}
							while ($cat_row = mysql_fetch_array($cat));
						}

					?>
				</select>
				<span id="product_add_subcat">Добавить подкатегорию</span><br/>

				<p class="form_title_cat">Производитель добавляемого товара и его название</p>
				<select id="product_brand" name="product_brand">
					<option disabled selected>Выберите бренд</option>
					<?php 
						$brand = mysql_query("SELECT * FROM brands",$link);
							$brand_row = mysql_fetch_array($brand);

							do {
								$checked = "";
									if ($brand_row['brand_id'] == $brand_id) {
										$checked = 'selected';
									}	
								echo '<option value="'.$brand_row['brand_id'].'"" '.$checked.'>'.$brand_row['brand_name'].'</option>';
							}
							while ($brand_row = mysql_fetch_array($brand));
					?>
				</select>
				<span id="product_add_cat">Добавить производителя</span><br/><br/><br/><br/>

				<label for="product_title">Введите наименование товара</label><br/>
				<input type="text" id="product_title" name="product_title" value="<?php echo $row['title'];?>"/>

				<p class="form_title_cat">Краткие характеристики товара</p>

				<div class="editor">
				<?php $mini_features = str_replace(array("\r","\n","\\n","\\r","\\"),"",$row['mini_features']); ?>
				<textarea id="editor2" name="editor2"><?php echo $mini_features;?></textarea>
				<script type="text/javascript">
					// Replace the <textarea id="editor2"> with a CKEditor
                	// instance, using default configuration.
                				CKEDITOR.replace( 'editor2' );
				</script>
				</div>


				<p class="form_title_cat">Описание товара</p>

				<div class="editor">
				<?php $description = str_replace(array("\r","\n","\\n","\\r","\\"),"",$row['description']); ?>
				<textarea id="editor1" name="editor1"><?php echo $description;?></textarea>
				<script type="text/javascript">
					// Replace the <textarea id="editor1"> with a CKEditor
                	// instance, using default configuration.
                				CKEDITOR.replace( 'editor1' );
				</script>
				</div>

				<p class="form_title_cat">Характеристики товара<span>Левая колонка</span></p>

				<div class="editor">
				<?php $features_left = str_replace(array("\r","\n","\\n","\\r","\\"),"",$row['features_left']); ?>
				<textarea id="editor3" name="editor3"><?php echo $features_left;?></textarea>
				<script type="text/javascript">
					// Replace the <textarea id="editor3"> with a CKEditor
                	// instance, using default configuration.
                				CKEDITOR.replace( 'editor3' );
				</script>
				</div>

				<p class="form_title_cat">Характеристики товара<span>Правая колонка</span></p>

				<div class="editor">
				<?php $features_right = str_replace(array("\r","\n","\\n","\\r","\\"),"",$row['features_right']); ?>
				<textarea id="editor4" name="editor4"><?php echo $features_right;?></textarea>
				<script type="text/javascript">
					// Replace the <textarea id="editor3"> with a CKEditor
                	// instance, using default configuration.
                				CKEDITOR.replace( 'editor4' );
				</script>
				</div>

				<p class="form_title_cat">Стоимость товара</p>
				<?php 

						if($row['sale'] == 1) {
							$checked = 'checked';
							$disabled = '';
						}
						else {
							$checked = '';
							$disabled = 'disabled';
						}

				?>
				<input type="checkbox" name="sale" id="sale" <?php echo $checked; ?>/>
				<label for="sale">На товар действует скидка</label>
				<br/>
				<label for="old_price">Старая цена</label><br/>
				<input type="text" id="old_price" name="old_price" value="<?php echo $row['old_price'];?>" <?php echo $disabled; ?> />
				<br/>
				<label for="price">Актуальная цена</label><br/>
				<input type="text" id="price" name="price" value="<?php echo $row['price'];?>"/>

				<p class="form_title_cat">Изображения</p>

				<p id="main_img_title">Главное изображение</p><br/>

				<?php 
					if(!empty($row['image'])) {

					if ($row["image"] != "" && file_exists("../products_img/".$row["type_of_product"]."/".$row["image"])) {
							$img_path = '../products_img/'.$row["type_of_product"].'/'.$row["image"];
							$max_width = 195;
							$max_height = 195;
							list($width, $height) = getimagesize($img_path);
							$ratioh = $max_height/$height;
							$ratiow = $max_width/$width;
							$ratio = min($ratioh, $ratiow);
							$width = intval($ratio*$width);
							$height = intval($ratio*$height);
						}
							else {
								$img_path = "../img/no_image.png";
								$width = 200;
								$height = 200;
							}

							echo '<div class="user_help" id="user_help"><img src="img/left_g.png" />Максимальный размер загружаемых изображений - 2 МБ</div>
							<div class="image_box" id="main_image"><img src="'.$img_path.'" width="'.$width.'" height="'.$height.'"/><a href="change_product.php?product='.$pr_id.'&delete='.$row["image"].'&type='.$row['type_of_product'].'&id='.$row["products_id"].'"><img src="../img/cancel.png" /></a></div>
								<input type="file" id="main_image" name="main_image" style="display:none" disabled/>';

							} else {
							echo '
							<div class="user_help" id="user_help"><img src="img/left_g.png" />Максимальный размер загружаемых изображений - 2 МБ</div>
							<input type="hidden" id="MAX_FILE_SIZE" value="5000000" />
							<input type="file" id="main_image" name="main_image" />
							';

						}

				?>
				<p id="add_img_title">Дополнительные изображения <span>Максимум 5</span></p><br/>
				<ul id="add_image">

				<?php 

						$images = mysql_query("SELECT * FROM additional_images WHERE products_id='$pr_id'",$link);
							if (mysql_num_rows($images) > 0) {
								$image_row = mysql_fetch_array($images);
								$js_id = 1;

								do {

									if ($image_row["add_img_link"] != "" && file_exists("../products_img/".$row["type_of_product"]."/".$image_row["add_img_link"])) {
							$img_path = '../products_img/'.$row["type_of_product"].'/'.$image_row["add_img_link"];
							$max_width = 145;
							$max_height = 145;
							list($width, $height) = getimagesize($img_path);
							$ratioh = $max_height/$height;
							$ratiow = $max_width/$width;
							$ratio = min($ratioh, $ratiow);
							$width = intval($ratio*$width);
							$height = intval($ratio*$height);
						}
							else {
								$img_path = "../img/no_image.png";
								$width = 150;
								$height = 150;
							}

							echo '<li js_id="'.$js_id.'" class="image_box"><a href="change_product.php?product='.$pr_id.'&delete_add='.$image_row["add_img_link"].'&type='.$row['type_of_product'].'&id='.$image_row["add_img_id"].'"><img src="../img/cancel.png" /></a><img src="'.$img_path.'" width="'.$width.'" height="'.$height.'"/></li>';
								$js_id++;
								}
								while ($image_row = mysql_fetch_array($images));
							}
						

				?>

				</ul>
				<input type="hidden" id="MAX_FILE_SIZE" value="5000000" />
				<input class="add_image" type="file" id="add_image1" name="add_image[]" /><br/>
				<span class="product_add_images">Добавить изображение</span>

				<p class="form_title_cat">Различные опции</p>
       				<?php 
						if($row['visible'] == 1) {
							$checked = 'checked';
						}
						else {
							$checked = '';
						}
				?>
				<input type="checkbox" name="visible" id="visible" <?php echo $checked; ?>/>
				<label for="visible">Показывать товар на сайте</label><br/>
				<?php 
						if($row['availability'] == 1) {
							$checked = 'checked';
						}
						else {
							$checked = '';
						}
				?>
				<input type="checkbox" name="available" id="available" <?php echo $checked; ?>/>
				<label for="available">Товар есть в наличии</label><br/>
				<?php 
						if($row['new'] == 1) {
							$checked = 'checked';
						}
						else {
							$checked = '';
						}
				?>
				<input type="checkbox" name="news" id="news"  <?php echo $checked; ?>/>
				<label for="news">Товар относится к новинкам</label><br/>
				<?php 
						if($row['leader'] == 1) {
							$checked = 'checked';
						}
						else {
							$checked = '';
						}
				?>
				<input type="checkbox" name="popular" id="popular" <?php echo $checked; ?>/>
				<label for="popular">Товар относится к хитам</label><br/>

				<p class="form_title_cat" style="margin-bottom:30px">SEO</p>
				<label for="seo_description">Описание</label><br/>
				<textarea id="seo_description" name="seo_description"><?php echo $row["seo_description"]?></textarea><br/>
				<label for="seo_keys">Ключевые слова</label><br/>
				<textarea id="seo_keys" name="seo_keys"><?php echo $row["seo_words"]?></textarea>

				<input type="submit" name="add_product_button" id="add_product_button" value="Сохранить"/>
		</form>
	</div>
	<div style="clear:both;"></div>
	<?php 
			}
			else {
				echo '<p class="error_message">У вас нет прав на просмотр данного раздела</p>';
			}
	?>
	</div>
</div>
<div class="black"></div>
<div id="add_category">
	<p id="add_category_title">Добавить новую категорию</p>
	<form id="add_category_form" action="javascript:void(null);" method="post">
		<label for="add_category_input">Название категории</label>
		<input type="text" id="add_category_input" name="add_category_input" /></br>
		<input type="submit" id="add_category_button" name="add_category_button" value="Отправить"/>
	</form>
	<div class="add_category_cancel"><img src="../img/cancel.png" /></div>
</div>
<div id="add_subcategory">
	<p id="add_subcategory_title">Добавить новую категорию</p>
	<form id="add_subcategory_form" action="javascript:void(null);" method="post">
	<label for="select_cat">Название категории</label>
		<select id="select_cat">
						<option value="" selected>...</option>
			<?php 
				$cat_vari = mysql_query("SELECT * FROM category_high_level");
				$cat_row = mysql_fetch_array($cat_vari);
				do {
					echo '<option value="'.$cat_row["high_id"].'">'.$cat_row["hign_disp_name"].'</option>';
				}
				while ($cat_row = mysql_fetch_array($cat_vari));
			?>
		</select>
		<label for="add_subcategory_input">Название подкатегории</label>
		<input type="text" id="add_subcategory_input" name="add_subcategory_input" /></br>
		<input type="submit" id="add_subcategory_button" name="add_subcategory_button" value="Отправить"/>
	</form>
	<div class="add_category_cancel"><img src="../img/cancel.png" /></div>
</div>
<div id="add_brand">
	<p id="add_brand_title">Добавить производителя</p>
	<form id="add_brand_form" action="javascript:void(null);" method="post">
		<label for="add_brand_input">Название производителя</label>
		<input type="text" id="add_brand_input" name="add_brand_input" /></br>
		<input type="submit" id="add_brand_button" name="add_brand_button" value="Отправить"/>
	</form>
	<div class="add_category_cancel"><img src="../img/cancel.png" /></div>
</div>

</body>
</html>

<?php 
}
else {
	header('Location: products.php', true, 301);
    exit();
}
}
else {
	header('Location: login.php', true, 301);
    exit();
}
?>