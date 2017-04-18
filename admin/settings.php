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

if(isset($_GET['delete'])) {
	mysql_query("UPDATE information SET logotype='' WHERE chck='1'");
	unlink('./logotype/'.clear_string($_GET['delete']));
	header('Location: settings.php', true, 301);
    exit();
}

if(isset($_GET['deleteicon'])) {
	mysql_query("UPDATE information SET icon='' WHERE chck='1'");
	unlink('./icon/'.clear_string($_GET['deleteicon']));
	header('Location: settings.php', true, 301);
    exit();
}

if(isset($_POST['new_template_submit'])) {
	$template_title = clear_string($_POST['new_template_title']);
	if($template_title != "") {
		mysql_query("INSERT INTO templates(name) VALUES('".$template_title."')",$link);
		$id = mysql_insert_id();

			if(empty($_POST['new_template_zip'])) {
				if(empty($_FILES['new_template_zip'])) {
				$_SESSION['error_img_2'] = "Файл не выбран";
					unset($_POST['new_template_zip']);
				}
				else {
					if($_FILES['new_template_zip']['type'] == 'application/zip' OR $_FILES['new_template_zip']['type'] == 'application/x-zip-compressed') {
					$filename = $_FILES['new_template_zip']['name'];
					$path_info = pathinfo($filename);
    				$file_extension = $path_info['extension'];

    				if(file_exists('temp/')) {
    					$uploaddir = 'temp/';
    				}
    				else {
    					mkdir("temp/", 0777);
    					$uploaddir = 'temp/';
    				}

    					$newfilename = 'temp'.$id.'.'.$file_extension;

    					$uploadedfile = $uploaddir.$newfilename;

    					if(move_uploaded_file($_FILES['new_template_zip']['tmp_name'], $uploadedfile)) {
    							$zip = new ZipArchive;
							if ($zip->open($uploadedfile) === TRUE) {
								@mkdir('../templates/'.$id, 0777);
    							$zip->extractTo('../templates/'.$id);
    							$zip->close();
    								if(file_exists('../templates/'.$id.'/style/style.css') AND file_exists('../templates/'.$id.'/style/basic.css')) {
    								$_SESSION['good_message'] = "Данные сохранены";
    								mysql_query("UPDATE templates SET ready='1' WHERE id='$id'",$link);
    								removeDirectory('temp/');
    								header('Location: settings.php', true, 301);
    								exit();
    								} else {
    									$_SESSION['error_img_2'] = "Загружаемый файл не является темой Infinite ShopEngine";
    									mysql_query("DELETE FROM templates WHERE id='$id'",$link);
    									removeDirectory('temp/');
    									removeDirectory('../templates/'.$id);
    								}
								} else {
    								$_SESSION['error_img_2'] = "Загружаемый файл должен быть с расширением .zip";
    								mysql_query("DELETE FROM templates WHERE id='$id'",$link);
    								removeDirectory('temp/');
								}
    					}
    					else {
    						$_SESSION['error_img_2'] = "Файл не был загружен. Повторите попытку или обратитесь в службу поддержки";
    					}
    				}
    				else {
    					$_SESSION['error_img_2'] = "Загружаемый файл должен быть с расширением .zip";
    				}
    			unset($_POST['new_template_zip']);
			}
		}
	}
	else {
		$_SESSION['error_img_2'] = "Необходимо ввести название для новой темы";
	}
}

if(isset($_POST['save_settings'])) {
	$name = clear_string($_POST['shop_title']);
	$phone_title = clear_string($_POST['shop_phone_title']);
	$phone = clear_string($_POST['shop_phone']);
	$copy_title = clear_string($_POST['shop_copy_title']);
	$copy_text = clear_string($_POST['shop_copy']);
	$seo_description = clear_string($_POST['seo_description']);
	$seo_keys = clear_string($_POST['seo_keys']);

	if($name != "" AND $phone != "" AND $copy_title != "" AND $copy_text != "") {
		mysql_query("UPDATE information SET name='$name',phone_title='$phone_title',phone='$phone',copy_title='$copy_title',copy_text='$copy_text',seo_description='$seo_description',seo_keys='$seo_keys' WHERE chck='1'");
		$_SESSION['good_message'] = "Данные сохранены";
	}
	else {
		$_SESSION['error_message'] = "Произошла ошибка. Убедитесь, что обязательные поля заполнены (обязательные поля отмечены звездочкой).";
	}

		if(empty($_POST['logotype'])) {
			if(empty($_FILES['logotype'])) {
					unset($_POST['logotype']);
				}
				else {
			$error_img = array();
			if ($_FILES['logotype']['error'] > 0) {
				switch($_FILES['logotype']['error']) {
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

					if($_FILES['logotype']['type'] == 'image/jpeg' OR $_FILES['logotype']['type'] == 'image/jpg' OR $_FILES['logotype']['type'] == 'image/png') {
					$imagename = $_FILES['logotype']['name'];
					$path_info = pathinfo($imagename);
    				$img_extension = $path_info['extension'];
    				if ($img_extension != 'jpg' AND $img_extension != 'jpeg' AND $img_extension != 'png') {
    				}

    				if(file_exists('./logotype/')) {
    					$uploaddir = './logotype/';
    				}
    				else {
    					mkdir('./logotype/', 0777);
    					$uploaddir = './logotype/';
    				}

    					$newimagename = 'logo'.rand(10,1000).'.'.$img_extension;

    					$uploadedfile = $uploaddir.$newimagename;

    					if(move_uploaded_file($_FILES['logotype']['tmp_name'], $uploadedfile)) {
    						$update = mysql_query("UPDATE information SET logotype='$newimagename' WHERE chck='1'");
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

		if(empty($_POST['icon'])) {
			if(empty($_FILES['icon'])) {
					unset($_POST['icon']);
				}
				else {
			$error_img = array();
			if ($_FILES['icon']['error'] > 0) {
				switch($_FILES['icon']['error']) {
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

					if($_FILES['icon']['type'] == 'image/jpeg' OR $_FILES['icon']['type'] == 'image/jpg' OR $_FILES['icon']['type'] == 'image/png') {
					$imagename = $_FILES['icon']['name'];
					$path_info = pathinfo($imagename);
    				$img_extension = $path_info['extension'];
    				if ($img_extension != 'jpg' AND $img_extension != 'jpeg' AND $img_extension != 'png') {
    				}

    				if(file_exists('./icon/')) {
    					$uploaddir = './icon/';
    				}
    				else {
    					mkdir('./icon/', 0777);
    					$uploaddir = './icon/';
    				}

    					$newimagename = 'icon'.rand(10,1000).'.'.$img_extension;

    					$uploadedfile = $uploaddir.$newimagename;

    					if(move_uploaded_file($_FILES['icon']['tmp_name'], $uploadedfile)) {
    						$update = mysql_query("UPDATE information SET icon='$newimagename' WHERE chck='1'");
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


}

$result = mysql_query("SELECT * FROM information WHERE chck='1'");
		$row = mysql_fetch_array($result);

?>
<!DOCTYPE html>
<html> 
<head>
	<title>Панель управления - главная</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="css/css.css">
	<script type="text/javascript" src="js/jquery-1.7.1.min.js"></script>
    <script type="text/javascript" src="js/js.js"></script>
    <!--<link href='https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900' rel='stylesheet' type='text/css'>-->
	<link rel="stylesheet" type="text/css" href="../fonts/fonts.css">
</head>
<body>
<?php include("includes/header.php"); ?>
<div id="admin_great_container">
<?php $active5 = 'class="active"'; 
	include("includes/left_sidebar.php"); 
?>

<div id="admin_center_block">
	<p id="center_title"><a href="index.php">Главная</a> / настройки</p>
	<p id="center_header">Настройки интернет-магазина</p>
<?php
	if($_SESSION['chk_settings'] == '1') {
?>

	<form enctype="multipart/form-data" id="settings_form" method="post" >
	<?php 
	if($_SESSION['good_message']) {
		echo '<p class="ok_message">'.$_SESSION['good_message'].'</p><br/>';
		unset($_SESSION['good_message']);
	}
	if($_SESSION['error_img_2']) {
		echo '<p class="error_message">'.$_SESSION["error_img_2"].'</p><br/>';
		unset($_SESSION['error_img_2']);
	}
	if($_SESSION['error_message']) {
		echo '<p class="error_message">'.$_SESSION["error_message"].'</p><br/>';
		unset($_SESSION['error_message']);
	}
	?>
		<p class="form_title_cat" style="margin-bottom:30px">Название интернет-магазина*</p>
		<label for="shop_title">Введите название</label><br/>
		<input type="text" id="shop_title" name="shop_title" value="<?php echo $row['name']?>"/>
		<p class="form_title_cat" style="margin-bottom:30px">Логотип интернет-магазина*</p>
		<?php 

			if(!empty($row['logotype'])) {

					if ($row["logotype"] != "" && file_exists("./logotype/".$row["logotype"])) {
							$img_path = './logotype/'.$row["logotype"];
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
								$width = 195;
								$height = 195;
							}

				echo '
					<div class="image_box"><a href="settings.php?delete='.$row["logotype"].'"><img src="../img/cancel.png" /></a><img src="'.$img_path.'" width="'.$width.'" height="'.$height.'"/></div>
				';
			}
			else {
				echo '
				<input type="hidden" id="MAX_FILE_SIZE" value="5000000" />
				<input type="file" id="logotype" name="logotype" />
				';
			}

		?>
		<p class="form_title_cat" style="margin-bottom:30px">Иконка интернет-магазина</p>
		<?php 

			if(!empty($row['icon'])) {

					if ($row["icon"] != "" && file_exists("./icon/".$row["icon"])) {
							$img_path = './icon/'.$row["icon"];
							$max_width = 100;
							$max_height = 100;
							list($width, $height) = getimagesize($img_path);
							$ratioh = $max_height/$height;
							$ratiow = $max_width/$width;
							$ratio = min($ratioh, $ratiow);
							$width = intval($ratio*$width);
							$height = intval($ratio*$height);
						}
							else {
								$img_path = "../img/no_image.png";
								$width = 100;
								$height = 100;
							}

				echo '
					<div class="image_box"><a href="settings.php?deleteicon='.$row["icon"].'"><img src="../img/cancel.png" /></a><img src="'.$img_path.'" width="'.$width.'" height="'.$height.'"/></div>
				';
			}
			else {
				echo '
				<input type="hidden" id="MAX_FILE_SIZE" value="5000000" />
				<input type="file" id="icon" name="icon" />
				';
			}

		?>
		<p class="form_title_cat" style="margin-bottom:30px">Внешний вид</p>
		<ul style="margin-bottom:60px" id="template_list">
		<?php 
			$template = mysql_query("SELECT * FROM templates WHERE ready='1'",$link);
				$row_temp = mysql_fetch_array($template);
				do {
					if($row_temp["id"] != '1') {
						$delete = '<a id="'.$row_temp["id"].'" class="delete_template">Удалить</a>';
					}
					else {
						$delete = '';
					}
					if($row_temp["active"] == '1') {
						$active = '<div class="template_active">Активна</div>';
					}
					else {
						$active = '';
					}
					if ($row_temp["img"] != "" && file_exists('../templates/'.$row_temp["id"].'/'.$row_temp["img"])) {
							$img_path = '../templates/'.$row_temp["id"].'/'.$row_temp["img"];
							$max_width = 200;
							$max_height = 200;
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
							echo '<li><div class="image_box">'.$active.'<div class="template_name">'.$row_temp["name"].'</div><img src="'.$img_path.'" width="'.$width.'" height="'.$height.'" alt="template" /><a id="'.$row_temp["id"].'" class="apply_template">Применить</a>'.$delete.'</div></li>';
				}
				while($row_temp = mysql_fetch_array($template));
		?>
		</ul>
		<a id="new_template">Загрузить</a>
		<div id="new_template_div">
			<form enctype="multipart/form-data" method="post">
				<p style="margin-left:30px">Пожалуйста, ознакомьтесь с <a href="http://infiniteworld.ru/instructions.php?id=32">инструкцией</a> по загрузке новых тем.</p><br/>
				<input type="text" name="new_template_title" id="new_template_title" placeholder="Введите название новой темы" style="width:400px" />
				<input type="hidden" id="MAX_FILE_SIZE" value="5000000" />
				<input type="file" id="new_template_zip" name="new_template_zip" />
				<div style="clear:both;"></div>
				<input type="submit" name="new_template_submit" style="float:left" value="Загрузить" /><br/>
				<div style="clear:both;"></div>
			</form>
		</div>
		<p class="form_title_cat" style="margin-bottom:30px">Контактный телефон*</p>
		<label for="shop_phone_title">Заголовок</label><br/>
		<input type="text" id="shop_phone_title" name="shop_phone_title" value="<?php echo $row['phone_title']?>"/><br/>
		<label for="shop_phone">Номер</label><br/>
		<input type="text" id="shop_phone" name="shop_phone" value="<?php echo $row['phone']?>"/>
		<p class="form_title_cat" style="margin-bottom:30px">Копирайт*</p>
		<label for="shop_copy_title">Заголовок</label><br/>
		<input type="text" id="shop_copy_title" name="shop_copy_title" value="<?php echo $row['copy_title']?>"/><br/>
		<label for="shop_copy">Текст</label><br/>
		<textarea type="text" id="shop_copy" name="shop_copy"><?php echo $row['copy_text']?></textarea><br/>
		<p class="form_title_cat" style="margin-bottom:30px">SEO</p>
		<label for="seo_description">Описание</label><br/>
		<textarea id="seo_description" name="seo_description"><?php echo $row['seo_description']?></textarea><br/>
		<label for="seo_keys">Ключевые слова</label><br/>
		<textarea id="seo_keys" name="seo_keys"><?php echo $row['seo_keys']?></textarea>
		<div style="clear:both;"></div>
		<input type="submit" name="save_settings" id="save_settings" value="Сохранить" />
	</form>

	<?php 
			}
			else {
				echo '<p class="error_message">У вас нет прав на просмотр данного раздела</p>';
			}
	?>
	
</div>
<div style="clear:both;"></div>
</div>
</body>
</html>

<?php 
}
else {
	header('Location: login.php', true, 301);
    exit();
}
?>