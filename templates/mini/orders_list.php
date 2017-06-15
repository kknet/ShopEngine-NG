<ul id="order_list">
	<?php 
		$array = GetOrders(); 
		foreach($array as $key) {
	?>
	<li>
		<a href="order_page/?status=<?php echo $key['type']; ?>&id=<?php echo $key['id']; ?>" class="order_more">Подробнее</a>
		<p class="order_date"><?php echo $key['datetime']; ?></p>
		<p class="order_id">Номер заказа: <?php echo $key['id']; ?></p>
		<p class="order_status">Статус: <?php echo $key['status']; ?></p>
		<p class="order_sum">Сумма: <span><?php echo $key['sum']; ?></span></p>
	</li>
	<?php } ?>
</ul>