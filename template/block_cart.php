<div id="cart_container">
	<p id="cart_title">Корзина</p>
		<ul id="cart_headers">
			<!--<li id="cart_h_img">Изображение</li>-->
			<li id="cart_h_name">Наименование</li>
			<li id="cart_h_price">Цена</li>
			<li id="cart_h_count">Количество</li>
			<li id="cart_h_sum">Сумма</li>
			<li id="cart_h_erase">Удалить</li>
		</ul>
		<div style="clear:left;"></div>
		<ul id="cart_products">
		<?php 
			$array = GetCart();
				foreach($array as $key) {
		?>
			<li>
				<div class="cart_image"><?php echo $key['image'];?></div>
				<div class="cart_name">
					<p class="cart_p_name"><a href="/product/<?php echo $key['id'];?>" ><?php echo $key['title'];?></a></p>
					<p class="cart_p_key">Код товара: <?php echo $key['id'];?></p>
					<span class="cart_p_availability"><?php echo $key['avail'];?></span>
				</div>
				<div class="cart_price"><span><?php echo $key['price'];?>₽</span></div>
				<div class="cart_count"><span class="count_minus" id="<?php echo $key['id'];?>">-</span><input type="text" name="cart_p_count" id="<?php echo $key['id'];?>" value="<?php echo $key['count'];?>" class="cart_p_count"/><span class="count_plus" id="<?php echo $key['id'];?>">+</span></div>
				<div class="cart_sum"><span><?php echo $key['int'];?>₽</span></div>
				<div class="cart_erase"><a class="cart_a" href="/cart/?id=<?php echo $key['cart_id'];?>&action=delete"><img src="/img/cancel.png" /></a></div>
			</li>
			<?php 
				}
			?>
		</ul>
	<p id="cart_count">Уникальных товаров в корзине: <span><?php GetCartUniqueCount();?></span></p>
	<div id="cart_sum"><p>Итого к оплате: <span><?php GetCartSum();?></span>₽</p></div>
	<div style="clear:left;"></div>
	<p id="cart_all_count">Всего товаров: <span><?php GetCartCount();?></span></p>
	<a id="cart_order" href="/checkout/step1">Оформить заказ</a>		
</div>

<div style="clear:both;"></div>
