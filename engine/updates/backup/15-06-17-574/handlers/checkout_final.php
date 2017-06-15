<?php defined('shopengine') or die('something wrong');
if(isset($_POST['checkout_submit_final'])) {
	$surname = $_SESSION["checkout_surname"];
	$name = $_SESSION["checkout_name"];
	$patronymic = $_SESSION["checkout_patronymic"];

	$full_name = $surname.' '.$name.' '.$patronymic;
	$email = $_SESSION["checkout_email"];
	$phone = $_SESSION["checkout_phone"];
	$address = $_SESSION["checkout_address"];
	$delivery_method = $_SESSION["radio_delivery"];
	$payment_method = $_SESSION["radio_payment"];
	$note = $_SESSION['checkout_information'];
	$sum = $_SESSION["final_price"];
	$buyer_id = $_SESSION['autorization_id'];
	$order_type = 'del';

	mysql_query("INSERT INTO orders(buyer_id,buyer_email,buyer_full_name,buyer_address,buyer_phone,buyer_sum,delivery_method,payment_method,datetime,completed,	type) VALUES ('".$buyer_id."','".$email."','".$full_name."','".$address."','".$phone."','".$sum."','".$delivery_method."','".$payment_method."',NOW(),'1','".$order_type."')");
	$order_id = mysql_insert_id();

	$order_encoded_id = md5($order_id);
	$order_encoded_id = strrev($order_encoded_id);
	$order_encoded_id = '3f54f'.$order_encoded_id.'4fd5e3f';

	mysql_query("UPDATE orders SET order_encoded_id='$order_encoded_id' WHERE id='$order_id'");

	$result = mysql_query("SELECT * FROM cart WHERE cart_ip = '{$_SERVER["REMOTE_ADDR"]}'");
		$cart_row = mysql_fetch_array($result);
		do {
			$products_id = $cart_row["cart_id_products"];
			$cart_price = $cart_row["cart_price"];
			$cart_count = $cart_row["cart_count"];
				$products = mysql_query("SELECT * FROM table_products WHERE products_id='$products_id'");
				$product_row = mysql_fetch_array($products);
				$product_title = $product_row["title"];
				$product_price = $product_row["price"];
				mysql_query("INSERT INTO order_products(order_id,order_encoded_id,product_name,product_count,product_price,products_id) VALUES('".$order_id."','".$order_encoded_id."','".$product_title."','".$cart_count."','".$product_price."','".$products_id."')");
		}
		while($cart_row = mysql_fetch_array($result));

		$delete = mysql_query("DELETE FROM cart WHERE cart_ip='{$_SERVER["REMOTE_ADDR"]}'");

		header('Location: /order_page/?status=del&id='.$order_encoded_id.'', true, 301);
  		exit();
}
?>