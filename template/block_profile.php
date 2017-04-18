<div id="user_hello"><p>Добро пожаловать в Ваш личный кабинет, <span><?php echo $_SESSION["autorization_name"]; ?>.</span></p></div>
<div id="user_information_block">
	<div id="user_information_name">
		<p id="user_information_name_p"><?php echo $_SESSION["autorization_name"]; ?> <?php echo $_SESSION["autorization_surname"]; ?></p>
	</div>
	<div id="counts">

		<p>Количество заказов: <a href="/profile/user_orders/"><?php GetProfileCount();?></a></p>
		<p>Комментариев: <a href="/profile/comments/"><?php echo $_SESSION['autorization_comments'];?></a></p>
	</div>
</div>
<div style="margin-left:30px" id="user_change_information_block">
	<p id="user_change_information_title">Редактировать данные</p>
	<form id="user_change_form" action="javascript:void(null);" method="post">
		<label for="user_change_email">Электронная почта</label>
		<input type="text" name="user_change_email" id="user_change_email" value="<?php echo $_SESSION['autorization_email'];?>" disabled /><br/><br/>
		<label for="user_change_current_password">Текущий пароль<span id="show_hide_pass_one" class="show-active">Показать</span><div class="user_error" id="user_error_current_pass"><img src="/style/img/left.png" />Неверный формат</div><div class="user_help" id="user_help"><img src="/style/img/left_g.png" />Оставьте поля пустыми, если не собираетесь менять пароль</div></label>
		<input type="password" name="user_change_current_password" id="user_change_current_password" /><br/><br/>
		<label for="user_change_password">Новый пароль<span id="show_hide_pass_two" class="show-active" >Показать</span><div class="user_error" id="user_error_pass"><img src="img/left.png" />Неверный формат</div></label>
		<input type="password" name="user_change_password" id="user_change_password" /><br/><br/>
		<label for="user_change_sec_password">Подтвердите пароль<span id="show_hide_pass_three" class="show-active" >Показать</span><div class="user_error" id="user_error_sec_pass"><img src="/style/img/left.png" />Пароли не совпадают</div></label>
		<input type="password" name="user_change_sec_password" id="user_change_sec_password" /><br/><br/><br/><br/><br/><br/>
		<label for="user_change_surname">Фамилия*<div class="user_error" id="user_error_surname"><img src="/style/img/left.png" />Обязательное поле</div></label>
		<input type="text" name="user_change_surname" id="user_change_surname" value="<?php echo $_SESSION['autorization_surname'];?>" /><br/><br/>
		<label for="user_change_name">Имя*<div class="user_error" id="user_error_name"><img src="/style/img/left.png" />Обязательное поле</div></label>
		<input type="text" name="user_change_name" id="user_change_name" value="<?php echo $_SESSION['autorization_name'];?>"/><br/><br/>
		<label for="user_change_patronymic">Отчество</label>
		<input type="text" name="user_change_patronymic" id="user_change_patronymic" value="<?php echo $_SESSION['autorization_patronymic'];?>"/><br/><br/>
		<label for="user_change_phone">Номер телефона*<div class="user_error" id="user_error_phone"><img src="/style/img/left.png" />Обязательное поле</div></label>
		<input type="text" name="user_change_phone" id="user_change_phone" value="<?php echo $_SESSION['autorization_phone'];?>" /><br/><br/>
		<label for="user_change_address">Адрес*<div class="user_error" id="user_error_address"><img src="/style/img/left.png" />Обязательное поле</div></label>
		<input type="text" name="user_change_address" id="user_change_address" value="<?php echo $_SESSION['autorization_address'];?>"/><br/><br/>
		<label for="user_change_information">Интересы</label>
		<textarea name="user_change_information" id="user_change_information" ><?php echo $_SESSION['autorization_information'];?></textarea><br/><br/><br/><br/><br/>
		<p class="forms_star">* - обязательные поля</p>
		<input type="submit" name="user_change_submit" id="user_change_submit" value="Сохранить" />
	</form>
</div>