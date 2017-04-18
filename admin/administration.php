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
	$id = clear_string($_GET['delete']);
	$delete = mysql_query("DELETE FROM table_products WHERE products_id='$id'",$link);
}

?>
<!DOCTYPE html>
<html> 
<head>
	<title>Панель управления - главная</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="css/css.css">
    <!--<link href='https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900' rel='stylesheet' type='text/css'>-->
	<link rel="stylesheet" type="text/css" href="../fonts/fonts.css">
    <script type="text/javascript" src="js/jquery-1.7.1.min.js"></script>
    <script type="text/javascript" src="js/js.js"></script>
</head>
<body>
<?php include("includes/header.php"); ?>
<div id="admin_great_container">
<?php
	include("includes/left_sidebar.php"); 
?>
	<div id="admin_center_block">
	<p id="center_title"><a href="index.php">Главная</a> / администраторы</p>
	<p id="center_header">Просмотр администраторов</p>
<?php
	if($_SESSION['chk_administration'] == '1') {
?>
	<ul id="admin_list">
	<?php 



			$num = 24;
			$page = (int)$_GET["page"];

			$count = mysql_query("SELECT COUNT(*) FROM admins",$link);
			$temp = mysql_fetch_array($count);

			if ($temp[0] > 0) {
				$tempcount = $temp[0];

				$total = (($tempcount - 1) / $num) +1;
				$total = intval($total);

				$page = intval($page);

				if (empty($page) or $page < 0) {
					$page = 1;
				}
				if($page > $total) {
					$page = $total;
				}

				$start = $page * $num - $num;

				$query_start_num = " LIMIT $start, $num";

			}

				$result = mysql_query("SELECT * FROM admins",$link);
						if(mysql_num_rows($result) > 0) {
							$row = mysql_fetch_array($result);
						}

				do {
						if($row['chk_products'] == 1 AND $row['chk_reviews'] == 1 AND $row['chk_orders'] == 1 AND $row['chk_settings'] == 1 AND $row['chk_slider'] == 1 AND $row['chk_users'] == 1 AND $row['chk_articles'] == 1) {
							$rights = ": полные права";
						}

						if($row['chk_products'] == 1) {
							$products = "товары, ";
						}
						else {
							$products = "";
						}

						if($row['chk_reviews'] == 1) {
							$reviews = "отзывы, ";
						}
						else {
							$reviews = "";
						}

						if($row['chk_orders'] == 1) {
							$orders = "заказы, ";
						}
						else {
							$orders = "";
						}

						if($row['chk_settings'] == 1) {
							$settings = "настройки, ";
						}
						else {
							$settings = "";
						}

						if($row['chk_administration'] == 1) {
							$administration = "администраторы, ";
						}
						else {
							$administration = "";
						}
						if($row['chk_slider'] == 1) {
							$slider = "слайдер, ";
						}
						else {
							$slider = "";
						}
						if($row['chk_users'] == 1) {
							$users = "пользователи, ";
						}
						else {
							$users = "";
						}
						if($row['chk_articles'] == 1) {
							$articles = "статьи, ";
						}
						else {
							$articles = "";
						}

						$rights_string = $products.$reviews.$orders.$settings.$administration.$slider.$users.$articles;
						$rights_string = substr($rights_string, 0, -2);

							echo '

									<li>
										<a aid="'.$row["id"].'" class="admin_delete">Удалить</a>
										<a href="change_admin.php?id='.$row["id"].'" class="admin_change">Изменить</a>
										<p class="admin_name">'.$row["name"].'</p>
										<p class="admin_position">'.$row["position"].$rights.'</p>
										<p class="admin_login">Логин: <span>'.$row["login"].'</span></p>
										<p class="admin_email">Почта: <span>'.$row["email"].'</span></p>
										<p class="admin_phone">Телефон: <span>'.$row["phone"].'</span></p>
										<p class="admin_rights">Права: <span>'.$rights_string.'</span></p>
									</li>			

							';

				}
				while ($row = mysql_fetch_array($result));

				if ($page != 1) {
				$pstr_prev = '<li><a class="pstr_prev" href="administration.php?page='.($page - 1).'">&#60;</a></li>';
			}
			if ($page != $total) {
				$pstr_next = '<li><a class="pstr_next" href="administration.php?page='.($page + 1).'">&#62;</a></li>';
			}

			if($page - 5 > 0) $page5left = '<li><a class="pstr_prev" href="administration.php?page='.($page - 5).'">'.($page-5).'</a></li>';
			if($page - 4 > 0) $page4left = '<li><a class="pstr_prev" href="administration.php?page='.($page - 4).'">'.($page-4).'</a></li>';
			if($page - 3 > 0) $page3left = '<li><a class="pstr_prev" href="administration.php?page='.($page - 3).'">'.($page-3).'</a></li>';
			if($page - 2 > 0) $page2left = '<li><a class="pstr_prev" href="administration.php?page='.($page - 2).'">'.($page-2).'</a></li>';
			if($page - 1 > 0) $page1left = '<li><a class="pstr_prev" href="administration.php?page='.($page - 1).'">'.($page-1).'</a></li>';

			if($page + 5 <= $total) $page5right = '<li><a class="pstr_prev" href="administration.php?page='.($page + 5).'">'.($page+5).'</a></li>';
			if($page + 4 <= $total) $page4right = '<li><a class="pstr_prev" href="administration.php?page='.($page + 4).'">'.($page+4).'</a></li>';
			if($page + 3 <= $total) $page3right = '<li><a class="pstr_prev" href="administration.php?page='.($page + 3).'">'.($page+3).'</a></li>';
			if($page + 2 <= $total) $page2right = '<li><a class="pstr_prev" href="administration.php?page='.($page + 2).'">'.($page+2).'</a></li>';
			if($page + 1 <= $total) $page1right = '<li><a class="pstr_prev" href="administration.php?page='.($page + 1).'">'.($page+1).'</a></li>';

			if ($page+5 < $total) {
				$strtotal = '<li><p class="nav-point">...</p></li><li><a href="administration.php?page='.$total.'">'.$total.'</a></li>';
			}
			else {
				$strtotal = "";
			}

			if ($total > 1) {
				echo '
						<div class="pagination">
						<ul>';
						echo $pstr_prev.$page5left.$page4left.$page3left.$page2left.$page1left.'<li><a class="page_active" href="'.$uri.'&sort='.$sorting.'&page='.$page.'">'.$page.'</a></li>'.$page1right.$page2right.$page3right.$page4right.$page5right.$strtotal.$pstr_next;
						echo '
						</div>
						</ul>';

			}

	?>
	</ul>
	<a id="new_admin" href="new_admin.php">Добавить администратора</a>
	<?php 
			}
			else {
				echo '<p class="error_message">У вас нет прав на просмотр данного раздела</p>';
			}
	?>
	</div>
		
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