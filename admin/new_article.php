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
$id_vari = clear_string($_GET['id']);

if(isset($_POST['article_button'])) {
	$mini_title = clear_string($_POST['article_mini_title']);
	$title = clear_string($_POST['article_title']);
	$text = nl2br(mysql_real_escape_string($_POST['editor1']));
	$seo_description = clear_string($_POST['seo_description']);
	$seo_keys = clear_string($_POST['seo_keys']);

	if($mini_title != "" AND $title != "" AND $text != "") {
		mysql_query("INSERT INTO articles(name,title,text,seo_description,seo_keys,datetime,block_id) VALUES('".$mini_title."','".$title."','".$text."','".$seo_description."','".$seo_keys."',NOW(),'".$id_vari."')",$link);
		$_SESSION['good_message'] = "Статья добавлена";
		echo '<meta http-equiv="refresh" content="0; url=articles.php">';
	}
	else {
		$_SESSION['error'] = "Обязательные поля должны быть заполнены";
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
    <script type="text/javascript" src="plugins/ckeditor/ckeditor.js"></script>
    <!--<link href='https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900' rel='stylesheet' type='text/css'>-->
	<link rel="stylesheet" type="text/css" href="../fonts/fonts.css">
</head>
<body>
<?php include("includes/header.php"); ?>
<div id="admin_great_container">
	<?php $active7 = 'class="active"'; 
	include("includes/left_sidebar.php"); 
?>

	<?php $slider = mysql_query("SELECT * FROM slider_set",$link);
		$slider_row = mysql_fetch_array($slider);
		$pause = $slider_row['speed'];
		$pause = $pause / 1000;
	?>

<div id="admin_center_block">
	<p id="center_title"><a href="index.php">Главная</a> / <a href="articles.php">статьи</a> / добавить статью</p>
	<p id="center_header">Просмотр раздела со статьями</p>
	<?php
		if($_SESSION['good_message']) {
			echo '<p class="ok_message">'.$_SESSION["good_message"].'</p><br/>';
			unset($_SESSION['good_message']);
		}
		if($_SESSION['error']) {
			echo '<p class="error_message">'.$_SESSION["error"].'</p><br/>';
			unset($_SESSION['error']);
		}
		?>
<?php
	if($_SESSION['chk_articles'] == '1') {
		echo '<p class="form_title_cat" style="margin-bottom:30px">Наименование статьи*</p>
		<form id="article" method="post" >
				<label for="article_mini_title">Краткое название (отображается в футере сайта)</label><br/>
				<input type="text" id="article_mini_title" name="article_mini_title" value=""/><br/>
				<label for="article_title">Полное название</label><br/>
				<input type="text" id="article_title" name="article_title" value=""/>
				<p class="form_title_cat" style="margin-bottom:30px">Основной текст статьи*</p>
				<div class="editor">
				<?php $mini_features = str_replace(array("\r","\n","\\n","\\r","\\"),"",$row["mini_features"]); ?>
				<textarea id="editor1" name="editor1"></textarea>
				<script type="text/javascript">
					// Replace the <textarea id="editor1"> with a CKEditor
                	// instance, using default configuration.
                				CKEDITOR.replace( "editor1" );
				</script>
				</div>
				<p class="form_title_cat" style="margin-bottom:30px">SEO</p>
				<label for="seo_description">Описание</label><br/>
				<textarea id="seo_description" name="seo_description"></textarea><br/>
				<label for="seo_keys">Ключевые слова</label><br/>
				<textarea id="seo_keys" name="seo_keys"></textarea>
				<div style="clear:both;"></div>
				<input type="submit" name="article_button" id="article_button" value="Сохранить"/>
		</form>
			';

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