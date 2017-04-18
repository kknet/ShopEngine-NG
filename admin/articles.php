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
	<?php $active7 = 'class="active"'; 
	include("includes/left_sidebar.php"); 
?>
<div id="admin_center_block">
	<p id="center_title"><a href="index.php">Главная</a> / статьи</p>
	<p id="center_header">Просмотр раздела со статьями</p>
<?php
	if($_SESSION['chk_articles'] == '1') {
		$result = mysql_query("SELECT * FROM article_blocks",$link);
			if(mysql_num_rows($result)) {
				$row = mysql_fetch_array($result);
				$count = 1;

				do {

					echo '<p class="form_title_cat" style="width:913px;border-bottom:none;font-size:18px">Блок '.$count.': '.$row["title"].'<input type="text" class="change_block" id="'.$row["id"].'" placeholder="Введите новое название" /><span  class="change_block_title" aid="'.$row["id"].'">Изменить</span><span  class="save_block_title" aid="'.$row["id"].'" style="display:none">Сохранить</span></p>	';
						$id = $row["id"];
						$articles = mysql_query("SELECT * FROM articles WHERE block_id='$id'",$link);
							if(mysql_num_rows($articles) > 0) {
								$articles_row = mysql_fetch_array($articles);
								echo '<ul class="art_list">';
								do {
									echo'
									<li>
										<a href="article.php?id='.$articles_row["id"].'" class="art_more">Подробнее</a>
										<p class="art_date">'.$articles_row["datetime"].'</p>
										<p class="art_title">'.$articles_row["name"].'</p>
									</li>
									';
								}
								while($articles_row = mysql_fetch_array($articles));
								echo '<a class="new_article" href="new_article.php?id='.$id.'">Добавить статью</a>';
								echo '</ul>';
							}
							else {
								echo '<p class="form_title_cat" style="width:913px;border-bottom:none;margin-left:60px;font-size:14px">Статьи в данном разделе не найдены</p>';
							}

					$count++;
				}
				while ($row = mysql_fetch_array($result));
			}
			else {
				echo '<p class="form_title_cat" style="width:913px;border-bottom:none">Разделы не созданы</p>';
			}
?>
<?php 

	}
	else {
		echo '<p class="error_message">У вас нет прав на просмотр данного раздела</p>';
	}

?>
</div>
<div style="clear:both;"></div>
</div>
<div class="black"></div>
</body>
</html>

<?php 
}
else {
	header('Location: login.php', true, 301);
    exit();
}
?>