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
	$delete = clear_string($_GET['delete']);
	$result = mysql_query("SELECT * FROM slider WHERE id='$delete'");
	$row = mysql_fetch_array($result);
	if(file_exists('../slider/'.$row["img"])) {
		unlink('../slider/'.$row["img"]);
	}
	mysql_query("DELETE FROM slider WHERE id='$delete'");
	header('Location: slider.php', true, 301);
    exit();
}

if(isset($_POST['slider_but'])) {
	$height = clear_string($_POST['slider_height']);
	$speed = clear_string($_POST['slider_speed']);
	$speed = $speed * 1000;
	mysql_query("UPDATE slider_set SET height='$height',speed='$speed' WHERE chck='1'",$link);
}

if(isset($_POST['slider_add'])) {
	if(empty($_POST['slider_img_add'])) {
					$error_add = array();

					if($_FILES['slider_img_add']['name'][0]) {

					for ($i = 0; $i < count($_FILES['slider_img_add']['name']); $i++) {

					if($_FILES['slider_img_add']['type'][$i] == 'image/jpeg' OR $_FILES['slider_img_add']['type'][$i] == 'image/jpg' OR $_FILES['slider_img_add']['type'][$i] == 'image/png') {

					$imagename = $_FILES['slider_img_add']['name'][$i];
					$path_info = pathinfo($imagename);
    				$img_extension = $path_info['extension'];

    				if(file_exists('../slider/')) {
    					$uploaddir = '../slider/';
    				}
    				else {
    					mkdir("../slider", 0777);
    					$uploaddir = '../slider/';
    				}

    					$count = mysql_query("SELECT * FROM slider");
    					$count = mysql_num_rows($count);
    					$count = $count + 1;

    					$newimagename = $count.rand(10,10000).$i.'.'.$img_extension;

    					$uploadedfile = $uploaddir.$newimagename;

    					if(@move_uploaded_file($_FILES['slider_img_add']['tmp_name'][$i], $uploadedfile)) {
    						mysql_query("INSERT INTO slider(img) VALUES('".$newimagename."')",$link);
    						$id = mysql_insert_id();

    							if($_POST['slider_title_add'][$i]) {
    								$title = clear_string($_POST['slider_title_add'][$i]);
    								mysql_query("UPDATE slider SET title='$title' WHERE id='$id'",$link);
    							}
    							if($_POST['slider_link_add'][$i]) {
    								$piclink = clear_string($_POST['slider_link_add'][$i]);
    								mysql_query("UPDATE slider SET piclink='$piclink' WHERE id='$id'",$link);
    							}

    					}
    					else {
    						$_SESSION['error_add'] = "Дополнительные изображения: ошибка загрузки файла";
    					}
    				}
    				else {
    					$_SESSION['error_add'] = "Дополнительные изображения: допустимые расширения - jpeg, jpg, png";
    				}
    			}
    			unset($_POST['slider_img_add']);
			}
		}
	}

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
	<?php $active6 = 'class="active"'; 
	include("includes/left_sidebar.php"); 
?>

	<?php $slider = mysql_query("SELECT * FROM slider_set",$link);
		$slider_row = mysql_fetch_array($slider);
		$pause = $slider_row['speed'];
		$pause = $pause / 1000;
	?>

<div id="admin_center_block">
	<p id="center_title"><a href="index.php">Главная</a> / слайдер</p>
	<p id="center_header">Управление центральным слайдером</p>
<?php
	if($_SESSION['chk_slider'] == '1') {
?>
	<div class="settings"><p>Параметры</p>
	<form method='post'>
	<label for="slider_width">Ширина (пикс)</label><input type="text" id="slider_width" name="slider_width" value="750" disabled/>
	<label for="slider_height">Высота (пикс)</label><input type="text" id="slider_height" name="slider_height" value="<?php echo $slider_row['height'];?>"/>
	<label for="slider_speed">Пауза (сек)</label><input type="text" id="slider_speed" name="slider_speed" value="<?php echo $pause; ?>"/>
	<input type="submit" name="slider_but" id="slider_but" value="Применить" /></form></div>

<form enctype="multipart/form-data" id="slider" method="post">
<ul id="slider_images">
<?php $slider = mysql_query("SELECT * FROM slider",$link);
		$slider_row = mysql_fetch_array($slider);
				$slider_id = 1;

		do {
					if ($slider_row["img"] != "" && file_exists("../slider/".$slider_row["img"])) {
							$img_path = "../slider/".$slider_row["img"];
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
					<li class="static" id="'.$slider_id .'"" slide_id="'.$slider_row["id"].'"">
						<div class="slider_image"><img src="'.$img_path.'" width="'.$width.'" height="'.$height.'"/></div>
							<label class="label_title" for="slider_title'.$slider_id .'">Подпись</label><input type="text" id="slider_title'.$slider_id .'" name="slider_title[]" class="slider_title" value="'.$slider_row["title"].'"/><br/>
							<label class="label_link"for="slider_link'.$slider_id .'">Ссылка</label><input type="text" id="slider_link'.$slider_id .'" name="slider_link[]" class="slider_link" value="'.$slider_row["piclink"].'"/>
							<a href="slider.php?delete='.$slider_row["id"].'"><img src="../img/cancel.png" /></a>
					</li>	
				';
				$slider_id++;
		}
		while ($slider_row = mysql_fetch_array($slider));
		
?>
<input type="submit" id="slider_apply" name="slider_apply" value="Сохранить"/>
<p class="form_title_cat" style="width:913px;">Добавить новые слайды</p>
</ul>
<p id="add_slide">Добавить слайд</p>
<input type="submit" id="slider_add" name="slider_add" value="Добавить"/>
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