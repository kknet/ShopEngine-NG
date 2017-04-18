<?php 
define('shopengine',true);
include("includes/db_connect.php"); 
include("functions/functions.php");
include("functions/variables.php");
session_start(); 

if ($_SESSION['admin_autorization'] == 'autorization_yes') {
$uri = $_SERVER['REQUEST_URI'];


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
<?php include("includes/left_sidebar.php"); ?>
<div id="admin_center_block">
	<p id="center_title">Добро пожаловать в панель управления магазином</p>
	<?php 
		$engine_info = mysql_query("SELECT * FROM engine_settings WHERE chck='1'",$link);
			$engine_info_row = mysql_fetch_array($engine_info);
	?>
	<p id="center_version">Версия продукта: <?php echo $engine_info_row["version"];?></p>

	<p class="form_title_cat" style="margin-bottom:30px">Общая статистика</p>
	<p class="canter_parametr">Уникальных посетилелей <span><?php echo $engine_info_row["count_of_views"];?></span></p>
	<?php
		$count_of_products = mysql_query("SELECT * FROM table_products",$link);
		$count_of_products = mysql_num_rows($count_of_products);
	?>
	<p class="canter_parametr">Всего товаров <span><?php echo $count_of_products;?></span></p>
	<?php
		$count_of_reviews = mysql_query("SELECT * FROM reviews_table",$link);
		$count_of_reviews = mysql_num_rows($count_of_reviews);
	?>
	<p class="canter_parametr">Отзывов <span><?php echo $count_of_reviews;?></span></p>
	<?php
		$count_of_users = mysql_query("SELECT * FROM users",$link);
		$count_of_users = mysql_num_rows($count_of_users);
	?>
	<p class="canter_parametr">Зарегистированных пользователей  <span><?php echo $count_of_users;?></span></p>
	<?php
		$count_of_orders = mysql_query("SELECT * FROM orders WHERE allowed='1'",$link);
		$count_of_orders = mysql_num_rows($count_of_orders);
	?>
	<p class="canter_parametr">Подтвержденных заказов <span><?php echo $count_of_orders;?></span></p>
	<p class="form_title_cat" style="margin-bottom:30px">Недавние продажи</p>
	<ul class="order_product_header">
			<li class="center_date">Дата</li>
			<li class="center_title">Наименование</li>
			<Li class="center_count">Кол-во</Li>
			<li class="center_price">Цена</li>
			<li class="center_status">Статус</li>
		</ul>
		<ul class="center_product_list">
		<?php 

				$products = mysql_query("SELECT * FROM order_products LIMIT 30",$link);
					$product_row = mysql_fetch_array($products);
					do {
							$id = $product_row["order_id"];
							$order = mysql_query("SELECT * FROM orders WHERE id='$id'",$link);
							$order_row = mysql_fetch_array($order);
							if($order_row["payed"] == 1) {
								$status = '<span class="ok">Оплачено</span>';
							}
							else {
								$status = '<span class="not_ok">Не оплачено</span>';
							}
							if($order_row["completed"] == 1 AND $order_row["allowed"] == 1) {
							echo '
								<li>
									<div class="center_date_div">'.$order_row["datetime"].'</div>
									<div class="center_title_div"><a href="../product.php?id='.$product_row["products_id"].'">'.$product_row["product_name"].'</a></div>
									<div class="center_count_div">'.$product_row["product_count"].'</div>
									<div class="center_price_div">'.$product_row["product_price"].'</div>
									<div class="center_status_div">'.$status.'</div>
								</li>	
								<div style="clear:both;"></div>
							';
							$number++;
						}
					}
					while($product_row = mysql_fetch_array($products));

		?>
	<?php ?>
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