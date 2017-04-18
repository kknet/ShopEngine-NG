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

if(isset($_GET['allow'])) {
	$id = clear_string($_GET['allow']);
	$update = mysql_query("UPDATE reviews_table SET moderation='1' WHERE id='$id'",$link);
}
if(isset($_GET['delete'])) {
	$id = clear_string($_GET['delete']);
	$delete = mysql_query("DELETE FROM reviews_table WHERE id='$id'",$link);
}
?>
<!DOCTYPE html>
<html> 
<head>
	<title>Панель управления - главная</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="css/css.css">
	<script type="text/javascript" href="js/js.js"></script>
    <!--<link href='https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900' rel='stylesheet' type='text/css'>-->
	<link rel="stylesheet" type="text/css" href="../fonts/fonts.css">
    <script type="text/javascript" src="js/jquery-1.7.1.min.js"></script>
</head>
<body>
<?php include("includes/header.php"); ?>
<div id="admin_great_container" style="background-color:#fff">
<?php
	$active3 = 'class="active"';
	include("includes/left_sidebar.php"); 
?>
	<div id="admin_center_block">
		<p id="center_title"><a href="index.php">Главная</a> / отзывы</p>
		<?php 


			$num = 24;
			$page = (int)$_GET["page"];

			$count = mysql_query("SELECT COUNT(*) FROM reviews_table",$link);
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


			$result = mysql_query("SELECT * FROM reviews_table WHERE moderation='0' $query_start_num");
				if (mysql_num_rows($result) > 0) {
					$row = mysql_fetch_array($result);
					$count = mysql_num_rows($result);
				}
				else {
					$count = 0;
				}
		?>
		<p id="center_header">Непроверенных отзывов - <span><?php echo $count;?></span></p>
<?php
	if($_SESSION['chk_reviews'] == '1') {
?>

		<ul id="reviews_list">

		<?php 
		do {
				$products_id = $row['products_id'];
							$result_product = mysql_query("SELECT * FROM table_products WHERE products_id='$products_id'",$link);
								if(mysql_num_rows($result_product) > 0) {
									$row_product = mysql_fetch_array($result_product);
			echo '
				<li>
				<p class="review_for">Отзыв к товару: <span><a href="../product/'.$row_product["products_id"].'">'.$row_product["title"].'</a></span></p>
				<p class="review_name"><img src="../style/img/profile.png" />'.$row['name'].'</p>
				<h4 class="review_plus">Достоинства</h4>
				<p class="review_plus_p">'.$row['dignities'].'</p>
				<h4 class="review_minus">Недостатки</h4>
				<p class="review_minus_p">'.$row['limitations'].'</p>
				<h4 class="review_comment">Комментарий</h4>
				<p class="review_comment_p">'.$row['comment'].'</p>
				<p class="review_mark">Оценка: <span>'.$row['vote'].'</span></p>
				<span class="date">'.$row['datetime'].'</span><br/><br/><br/>
				<a class="good" href="reviews.php?allow='.$row['id'].'">Одобрить</a><a class="bad" href="reviews.php?delete='.$row['id'].'">Удалить</a>
			</li>
			';
		}
		else {
			echo '<p class="review_empty">Новых отзывов нет</p>';
		}
	}



		while ($row = mysql_fetch_array($result));


		if ($page != 1) {
				$pstr_prev = '<li><a class="pstr_prev" href="reviews.php?page='.($page - 1).'">&#60;</a></li>';
			}
			if ($page != $total) {
				$pstr_next = '<li><a class="pstr_next" href="reviews.php?page='.($page + 1).'">&#62;</a></li>';
			}

			if($page - 5 > 0) $page5left = '<li><a class="pstr_prev" href="reviews.php?page='.($page - 5).'">'.($page-5).'</a></li>';
			if($page - 4 > 0) $page4left = '<li><a class="pstr_prev" href="reviews.php?page='.($page - 4).'">'.($page-4).'</a></li>';
			if($page - 3 > 0) $page3left = '<li><a class="pstr_prev" href="reviews.php?page='.($page - 3).'">'.($page-3).'</a></li>';
			if($page - 2 > 0) $page2left = '<li><a class="pstr_prev" href="reviews.php?page='.($page - 2).'">'.($page-2).'</a></li>';
			if($page - 1 > 0) $page1left = '<li><a class="pstr_prev" href="reviews.php?page='.($page - 1).'">'.($page-1).'</a></li>';

			if($page + 5 <= $total) $page5right = '<li><a class="pstr_prev" href="reviews.php?page='.($page + 5).'">'.($page+5).'</a></li>';
			if($page + 4 <= $total) $page4right = '<li><a class="pstr_prev" href="reviews.php?page='.($page + 4).'">'.($page+4).'</a></li>';
			if($page + 3 <= $total) $page3right = '<li><a class="pstr_prev" href="reviews.php?page='.($page + 3).'">'.($page+3).'</a></li>';
			if($page + 2 <= $total) $page2right = '<li><a class="pstr_prev" href="reviews.php?page='.($page + 2).'">'.($page+2).'</a></li>';
			if($page + 1 <= $total) $page1right = '<li><a class="pstr_prev" href="reviews.php?page='.($page + 1).'">'.($page+1).'</a></li>';

			if ($page+5 < $total) {
				$strtotal = '<li><p class="nav-point">...</p></li><li><a href="reviews.php?page='.$total.'">'.$total.'</a></li>';
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