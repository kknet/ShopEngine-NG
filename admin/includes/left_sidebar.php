<div id="admin_left_sidebar">
		<div id="main_page">
			<img src="img/menu.png" />
			<a href="index.php">Главная</a>
		</div>
 		<ul id="main_menu">
 			<a href="products.php"><li <?php echo $active1;?> >Товары</li></a>

			<?php
 				$orders = mysql_query("SELECT * FROM orders WHERE allowed='0' AND completed='1'",$link);
 				$orders = mysql_num_rows($orders);
 				if ($orders != 0 OR $orders != "") {
 					$orders = '+'.$orders;
 				}
 				else {
 					$orders = "";
 				}
 			?>	

 			<a href="orders.php"><li <?php echo $active2;?> >Заказы<span class="notice"><?php echo $orders; ?></span></li></a>
 			<?php
 				$reviews = mysql_query("SELECT * FROM reviews_table WHERE moderation='0'",$link);
 				$reviews = mysql_num_rows($reviews);
 				if ($reviews != 0 OR $reviews != "") {
 					$reviews = '+'.$reviews;
 				}
 				else {
 					$reviews = "";
 				}
 			?>
 			<a href="reviews.php"><li <?php echo $active3;?> >Отзывы<span class="notice"><?php echo $reviews; ?></span></li></a>
 			<a href="users.php"><li <?php echo $active4;?> >Пользователи</li></a>
 			<a href="settings.php"><li <?php echo $active5;?> >Настройки</li></a>
 			<a href="slider.php"><li <?php echo $active6;?> >Слайдер</li></a>
 			<a href="articles.php"><li <?php echo $active7;?> >Статьи</li></a>
 		</ul>
	</div>