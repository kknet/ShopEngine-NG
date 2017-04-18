<p class="form_title_cat" style="font-weight:400;margin-bottom:30px;border-bottom:none">Спасибо! Ваш заказ будет обработан в ближайшее время.</p>
<p class="order buyer_pay_status">Статуc заказа: <?php GetOrderStatus(); ?></p>
<p class="order buyer_pay_status">Статуc оплаты<?php GetOrderPayStatus(); ?></p>
<p class="order buyer_pay_status">Время оплаты: <span><?php GetOrderPayTime(); ?></span></p>
<p class="form_title_cat" style="font-weight:400;margin-bottom:30px">Информация о заказе</p>

<p class="order buyer_name">Полное имя: <span><?php GetOrderName(); ?></span></p>
<p class="order buyer_phone">Номер телефона: <span><?php GetOrderPhone(); ?></span></p>
<p class="order buyer_email">Электронная почта: <span><?php GetOrderEmail(); ?></span></p>
<p class="order buyer_address">Адрес доставки: <span><?php GetOrderAddress(); ?></span></p>
<p class="order buyer_delivery">Способ доставки: <span><?php GetOrderDel(); ?></span></p>
<p class="order buyer_payment">Способ оплаты: <span><?php GetOrderPay(); ?></span></p>
<p class="order buyer_sum">Общая сумма заказа: <span><?php GetOrderSum(); ?></span></p>
<p class="order buyer_date">Дата заказа: <span><?php GetOrderDatetime(); ?></span></p>
<p class="order buyer_id">Номер заказа: <span><?php GetOrderid(); ?></span></p>

<p class="form_title_cat" style="font-weight:400;margin-bottom:30px;border-bottom:none">Информация о покупаемом товаре</p>
	<ul class="order_product_header">
		<li class="order_title">Наименование</li>
		<Li class="order_count">Количество</Li>
		<li class="order_price">Цена</li>
	</ul>
<ul class="order_product_list">
	<?php 
		$array = GetOrderProducts(); 
			foreach($array as $key) {
	?>
		<li>
			<div class="product_title"><a class="link_to_product" href="/product/<?php echo $key['id']?>"><?php echo $key['title']?></a></div>
			<div class="product_count"><?php echo $key['count']?></div>
			<div class="product_price"><?php echo $key['price']?></div>
		</li>	
	<?php } ?>
	<div style="clear:both;"></div>
</ul>