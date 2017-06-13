<ul id="product_reviews_list">
	<?php
		$array = GetComments();
			foreach($array as $key) { 
	 ?>
	 	<li><p class="product_reviews_product_title">Отзыв о товаре: <a href="/product/<?php echo $key['products_id']; ?>" ><?php echo $key['title']; ?></a></p>
			<p class="product_reviews_name"><img src="/style/img/profile.png" /><?php echo $key['name']; ?></p>
			<h4 class="span_dignities">Достоинства</h4>
			<p class="dignities"><?php echo $key['dignities']; ?></p>
			<h4 class="span_limitations">Недостатки</h4>
			<p class="limitations"><?php echo $key['limitations']; ?></p>
			<h4 class="span_comment">Комментарий</h4>
			<p class="comment"><?php echo $key['comment']; ?></p>
			<h4 class="span_rating">Оценка</h4>
			<p class="rating"><?php echo $key['vote']; ?></p>
			<p class="review_date"><?php echo $key['datetime']; ?></p>
		</li>
	 <?php } ?>
</ul>