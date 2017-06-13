<div id="user_hello"><p>Добро пожаловать в Ваш личный кабинет, <span><?php echo $_SESSION["autorization_name"]; ?>.</span><br/><a style="color:#000;font-size:14px" href="/profile/">Вернуться назад</a></p></div>
<div id="user_information_block">
	<div id="user_information_name">
		<p id="user_information_name_p"><?php echo $_SESSION["autorization_name"]; ?> <?php echo $_SESSION["autorization_surname"]; ?></p>
	</div>
	<div id="counts">

		<p>Количество заказов: <a href="/profile/user_orders/"><?php GetProfileCount();?></a></p>
		<p>Комментариев: <a href="/profile/comments/"><?php echo $_SESSION['autorization_comments'];?></a></p>
	</div>
</div>
<div id="user_change_information_block">
<?php GetCommentsList(); ?>
</div>