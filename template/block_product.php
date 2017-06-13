	<p id="product_title"><?php GetProductInfoTitle();?></p>
		<div id="product_image"><?php GetProductInfoImage();?></div>
		<div id="product_fearutes">
			<ul>
				<?php GetProductInfoMiniFeat(); ?>
			</ul>

			<div id="product_vote"><p id="product_mark"><?php GetProductInfoMark(); ?></p><br/>
				<p id="product_reviews">Отзывы: <?php GetProductInfoCountOfReviews(); ?></p>
				<p id="product_reviews">Просмотры: <?php GetProductInfoCount(); ?></p>
			</div>
			<div style="clear:both;"></div>
				<span id="product_avail"><?php GetProductInfoAvail(); ?></span>
				<span id="product_key">Код товара: <?php GetProductInfoId(); ?></span>
			</div>
			<div id="additional_images">
				<ul id="additional_images_list">
					<?php GetProductInfoGallery(); ?>
				</ul>
			</div>
			<div id="product_price">
			
				<p id="product_p"><span><?php GetProductInfoOldPrice(); ?></span><?php GetProductInfoPrice(); ?></p>
				<a class="js_product_to_cart" brid="<?php GetProductInfoId(); ?>">Купить</a>
			</div>
			<div style="clear:both;"></div>

				<div id="product_menu_header">
					<ul id="product_description_list">
						<li class="product_active" id="product_menu_description">Описание</li>
						<li id="product_menu_features">Характеристики</li>
						<li id="product_menu_reviews">Отзывы</li>
						<!--<li id="product_menu_overviews">Обзор</li>-->
					</ul>
				</div>
				<div id="product_description_text">
					<p><?php GetProductInfoDescription();?></p>
				</div>
				<div id="product_features_text">
					<div id="product_features_float_left"><?php GetProductInfoFeatLeft();?></div>
						<div id="product_features_float_right"><?php GetProductInfoFeatRight();?></div>
						<div style="clear:both;"></div>
				</div>
				<div id="product_reviews_text">
						<?php AddReview();?>
					<ul id="product_reviews_list">
						<?php 
							$reviews = GetReviews();
							if ($reviews[0]['ok'] === true) {
								foreach($reviews as $key) {
						?>
						<li>
							<p class="product_reviews_name"><img src="/style/img/profile.png" /><?=$key['name']; ?></p>
							<h4 class="span_dignities">Достоинства</h4>
							<p class="dignities"><?=$key['dignities']; ?></p>
							<h4 class="span_limitations">Недостатки</h4>
							<p class="limitations"><?=$key['limitations']; ?></p>
							<h4 class="span_comment">Комментарий</h4>
							<p class="comment"><?=$key['comment']; ?></p>
							<h4 class="span_rating">Оценка</h4>
							<p class="rating"><?=$key['rating']; ?></p>
							<p class="review_date"><?=$key['review_date']; ?></p>
						</li>
						<?php 	}
						}
						else { ?>
							<span id="add_review_empty_message" style="display:block">Здесь пока нет ни одного отзыва. Станьте первым!</span>
						<?php } ?>
					</ul>
				</div>
				<!--<div id="product_overviews_text">Это блок с обзорами</div>-->
				<p id="product_similar_header">Похожие товары</p>

				<div id="product_similar">
				<ul id="product_similar_list">
					<?php 
						$similar = GetSimilar();
						if($similar[0]['ok'] === true) {
							foreach($similar as $key) {
					?>
					<li>
						<div class="product_similar_img"><?php echo $key['image']; ?></div>
						<p class="product_similar_title"><a href="/product/<?php echo $key['id']; ?>"><?php echo $key['title']; ?></a></p>
						<p class="product_similar_price"><span><?php echo $key['price']; ?></span>₽</p>
					</li>			
					<?php 	}
					}
					else { ?>
						<p id="similar_empty">Похожие товары не найдены</p>
					<?php } ?>
				</ul>				
				</div>
				<?php 

					$history = GetHistory();
					if($history[0]['ok'] === true) {

				?>
				<p id="product_history_header">Вы недавно смотрели</p>
				<div id="product_history">
					<ul id="product_history_list">
					<?php 
						foreach($history as $key) 
						{
					?>
						<li>
							<div class="product_history_img">
								<?php echo $key['image']; ?>
							</div>
								<p class="product_history_title"><a href="/product/<?php echo $key['id']; ?>"><?php echo $key['title']; ?></a></p>
								<p class="product_history_price"><span><?php echo $key['price']; ?></span>₽</p>
						</li>	

					<?php } ?>

					</ul>
				</div>
				<?php 
					}
				?>