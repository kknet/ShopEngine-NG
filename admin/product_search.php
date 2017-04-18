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

if($_GET['product_key']) {

	$id = clear_string($_GET['product_key']);

?>
<!DOCTYPE html>
<html> 
<head>
	<title>Панель управления - поиск</title>
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
	$active1 = 'class="active"';
	include("includes/left_sidebar.php"); 
?>
	<div id="admin_center_block">
		<p id="center_title"><a href="index.php">Главная</a> / <a href="products.php">товары</a> / поиск по коду товара</p>
		<?php

			$num = 24;
			$page = (int)$_GET["page"];

			$count = mysql_query("SELECT COUNT(*) FROM table_products",$link);
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


	if($_SESSION['chk_products'] == '1') {


			$result = mysql_query("SELECT * FROM table_products WHERE products_id='$id' $query_start_num",$link);
				if (mysql_num_rows($result) > 0) {
					$row = mysql_fetch_array($result);
					$count = mysql_num_rows($result);
					?>
		<p id="center_header">Искомый ключ: <span><?php echo $id;?></span><a href="new_product.php">Добавить</a><form id="search_form" action="product_search.php" method="GET"><label for="product_key" id="label_product"></label><input type="text" name="product_key" id="product_key" placeholder="Поиск по коду товара" /><input type="submit" id="go_search" value="Поиск"/></form></p>
		<div id="product_block">
		<ul id="product_list">
		<?php 
					do {
							if ($row["image"] != "" && file_exists("../products_img/".$row["type_of_product"]."/".$row["image"])) {
							$img_path = '../products_img/'.$row["type_of_product"].'/'.$row["image"];
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

								echo '

									<li>
										<div class="product_img"><img src="'.$img_path.'" width="'.$width.'" height="'.$height.'"/></div>
										<div class="product_title"><a href="../product.php?id='.$row["products_id"].'" class="product_name">'.$row["title"].'</a></div>
										<a class="product_change" href="change_product.php?product='.$row["products_id"].'">Изменить</a><a class="product_delete" id="'.$row["products_id"].'">Удалить</a>
									</li>

								';



					}
					while ($row = mysql_fetch_array($result));

			if ($page != 1) {
				$pstr_prev = '<li><a class="pstr_prev" href="products.php?page='.($page - 1).'">&#60;</a></li>';
			}
			if ($page != $total) {
				$pstr_next = '<li><a class="pstr_next" href="products.php?page='.($page + 1).'">&#62;</a></li>';
			}

			if($page - 5 > 0) $page5left = '<li><a class="pstr_prev" href="products.php?page='.($page - 5).'">'.($page-5).'</a></li>';
			if($page - 4 > 0) $page4left = '<li><a class="pstr_prev" href="products.php?page='.($page - 4).'">'.($page-4).'</a></li>';
			if($page - 3 > 0) $page3left = '<li><a class="pstr_prev" href="products.php?page='.($page - 3).'">'.($page-3).'</a></li>';
			if($page - 2 > 0) $page2left = '<li><a class="pstr_prev" href="products.php?page='.($page - 2).'">'.($page-2).'</a></li>';
			if($page - 1 > 0) $page1left = '<li><a class="pstr_prev" href="products.php?page='.($page - 1).'">'.($page-1).'</a></li>';

			if($page + 5 <= $total) $page5right = '<li><a class="pstr_prev" href="products.php?page='.($page + 5).'">'.($page+5).'</a></li>';
			if($page + 4 <= $total) $page4right = '<li><a class="pstr_prev" href="products.php?page='.($page + 4).'">'.($page+4).'</a></li>';
			if($page + 3 <= $total) $page3right = '<li><a class="pstr_prev" href="products.php?page='.($page + 3).'">'.($page+3).'</a></li>';
			if($page + 2 <= $total) $page2right = '<li><a class="pstr_prev" href="products.php?page='.($page + 2).'">'.($page+2).'</a></li>';
			if($page + 1 <= $total) $page1right = '<li><a class="pstr_prev" href="products.php?page='.($page + 1).'">'.($page+1).'</a></li>';

			if ($page+5 < $total) {
				$strtotal = '<li><p class="nav-point">...</p></li><li><a href="products.php?page='.$total.'">'.$total.'</a></li>';
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

				}
				else {
					$count = 0;
					echo '
					<p id="center_header">Искомый ключ: <span>'.$id.'</span><a href="new_product.php">Добавить</a></p>
					<p class="review_empty">Товары отсутствуют</p>';
				}
			?>
		</ul>
	</div>
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
	header('Location: products.php', true, 301);
    exit();
}
}
else {
	header('Location: login.php', true, 301);
    exit();
}
?>