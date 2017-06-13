<?php 
	$array = GetProducts(); 
	if (!empty($array)) { // Открытие условия
?>
<div id="crumbs">
			<p><a href="">Главная страница</a> / <?php GetPageName(); ?></p>
</div>
	<?php include("block_catselect.php"); ?>
<div id="center_product_block">
		<ul id="product_list_grid">
						<?php foreach ($array as $key) { ?>
						<li>
							<?php echo $key['sales'];?>
							<div class="product_image"><?php echo $key['image'];?></div>
							<div class="product_title"><p><a href="/product/<?php echo $key['id'];?>"><?php echo $key['title'];?></a></p></div>
							<div class="product_mark"><p><?php echo $key['mark'];?></p></div>
							<div class="product_reviews">
								<div class="views_div">
									<p class="views"><?php echo $key['count'];?></p>
									<img class="views_img" src="/style/img/eye-icon.png" alt="image"/>
								</div>
								<div class="reviews_div">
									<p class="reviews"><?php echo $key['count_of_views'];?></p>
									<img class="reviews_img" src="/style/img/chat-icon.png" alt="image"/>
								</div>
							</div>
							<div style="clear:both;"></div>
								<p class="product_price_p"><?php echo $key['old_price'];?><span><?php echo $key['price'];?></span>₽</p>
								<a class="js_product_to_cart" brid="<?php echo $key['id'];?>"></a>
								<span class="avail"><?php echo $key['avail'];?></span>
						</li>

						<?php } ?>
				<div style="clear:both;"></div>
		</ul>
		<ul id="product_list_list">
				<?php 
					foreach ($array as $key) { ?>
							<li>
							<?php echo $key['sales'];?>
							<div class="product_image"><?php echo $key['image'];?></div>
							<div class="product_information_div">
								<p class="product_title" ><a href="/product/<?php echo $key['id'];?>"><?php echo $key['title'];?></a></p>
								<div class="product_mark"><p><?php echo $key['mark'];?></p></div>
								<div class="product_reviews">
									<div class="views_div">
										<p class="views"><?php echo $key['count'];?></p>
										<img class="views_img" src="/style/img/eye-icon.png" alt="image"/>
									</div>
									<div class="reviews_div">
										<p class="reviews"><?php echo $key['count_of_views'];?></p>
										<img class="reviews_img" src="/style/img/chat-icon.png" alt="image"/>
									</div>
								</div><br/><br/>
								<p class="product_id">Код товара: <?php echo $key['id'];?></p><br/>
								<div class="product_description"><p><?php echo $key['mimi_desc'];?></p></div>
							</div>
							<div class="product_price">
								<p class="product_price_p"><?php echo $key['old_price'];?><span><?php echo $key['price'];?></span>₽</p>
								<a class="js_product_to_cart" brid="<?php echo $key['id'];?>"></a>
								<span class="avail"><?php echo $key['avail'];?></span>
							</div>
						</li>

					<?php } ?>
				<div style="clear:both;"></div>
		</ul>
</div>
	<div class="pagination">
		<?= GetPagination(); ?>
	</div>
<?php 
	} // Закрытие условия 
	else { ?>
		<h3 class="category_empty">Товары не найдены. <a href="/main/">Вернуться на главную</a></h3>
<?php } ?>