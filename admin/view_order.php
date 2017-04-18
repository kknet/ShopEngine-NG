<?php 
define('shopengine',true);
include("includes/db_connect.php"); 
include("functions/functions.php");
include("functions/variables.php");
session_start(); 

if ($_SESSION['admin_autorization'] == 'autorization_yes') {
$uri = $_SERVER['REQUEST_URI'];


if($_GET["id"]) {

$id_vari = clear_string($_GET["id"]);

if(isset($_POST['allow_order'])) {
	mysql_query("UPDATE orders SET allowed='1' WHERE id='$id_vari'",$link);
}
if(isset($_POST['reject_order'])) {
	mysql_query("DELETE FROM orders WHERE id='$id_vari'",$link);
}

$result = mysql_query("SELECT * FROM orders WHERE id='$id_vari'",$link);
	if(mysql_num_rows($result)) {
		$row = mysql_fetch_array($result);
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
	$active2 = 'class="active"';
	include("includes/left_sidebar.php"); 
?>
	<div id="admin_center_block">

		<p id="center_title"><a href="index.php">Главная</a> / <a href="orders.php">заказы</a> / просмотр заказа</p>
		<p id="center_header">Информация о заказе</p>
<?php
	if($_SESSION['chk_orders'] == '1') {
?>
		<p class="form_title_cat" style="margin-bottom:30px">Общая информация</p>
		<?php 

			if($row["allowed"] == 1) {
						$status = '<span class="order_yes">обработан</span>';
					}
					else {
						$status = '<span class="order_no">не обработан</span>';
					}
			if($row["payed"] == 1) {
						$pay_status = '<span class="order_yes">оплачено</span>';
						$pay_time = $row["pay_date"];
					}
					else {
						$pay_status = '<span class="order_no">не оплачено</span>';
						$pay_time = "";
					}

		?>
		<p class="order buyer_pay_status">Статуз заказа: <?php echo $status; ?></p>
		<p class="order buyer_pay_status">Статуз оплаты: <?php echo $pay_status; ?></p>
		<p class="order buyer_pay_status">Время оплаты: <span><?php echo $pay_time;?></span></p>
		<p class="form_title_cat" style="margin-bottom:30px">Информация о клиенте</p>
		<?php 
					echo '
						<p class="order buyer_name">Полное имя: <span>'.$row["buyer_full_name"].'</span></p>
						<p class="order buyer_phone">Номер телефона: <span>'.$row["buyer_phone"].'</span></p>
						<p class="order buyer_email">Электронная почта: <span>'.$row["buyer_email"].'</span></p>
						<p class="order buyer_address">Адрес доставки: <span>'.$row["buyer_address"].'</span></p>
						<p class="order buyer_delivery">Способ доставки: <span>'.$row["delivery_method"].'</span></p>
						<p class="order buyer_payment">Способ оплаты: <span>'.$row["payment_method"].'</span></p>
						<p class="order buyer_sum">Общая сумма заказа: <span>'.$row["buyer_sum"].'</span></p>
						<p class="order buyer_date">Время заказа: <span>'.$row["datetime"].'</span></p>
					';

				
		?>
		<p class="form_title_cat" style="margin-bottom:30px;border-bottom:none">Информация о покупаемом товаре</p>
		<ul class="order_product_header">
			<li class="order_number">№</li>
			<li class="order_title">Наименование</li>
			<Li class="order_count">Количество</Li>
			<li class="order_price">Цена</li>
		</ul>
		<ul class="order_product_list">

		<?php 

				$products = mysql_query("SELECT * FROM order_products WHERE order_id='$id_vari'",$link);
					$product_row = mysql_fetch_array($products);
					$number = 1;
					do {
							echo '
								<li>
									<div class="product_number">'.$number.'</div>
									<div class="product_title">'.$product_row["product_name"].'</div>
									<div class="product_count">'.$product_row["product_count"].'</div>
									<div class="product_price">'.$product_row["product_price"].'</div>
								</li>	
								<div style="clear:both;"></div>
							';
							$number++;
					}
					while($product_row = mysql_fetch_array($products));

		?>
		</ul>
		<form id="alloworreject" method="post">
			<input type="submit" id="allow_order" name="allow_order" value="Подтвердить заказ"/>
			<input type="submit" id="reject_order" name="reject_order" value="Удалить заказ"/>
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
	header('Location: orders.php', true, 301);
    exit();
}
}
else {
	header('Location: index.php', true, 301);
    exit();
}
}
else {
	header('Location: login.php', true, 301);
    exit();
}
?>