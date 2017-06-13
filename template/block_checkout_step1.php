<div id="checkout_title"><p><span>Оформление заказа</span></p>
<div id="checkout_step_one" class="active_step">Личные данные</div><div id="checkout_step_two">Способ доставки и оплаты</div><div id="checkout_step_three" >Подтверждение заказа</div>
</div>
<div style="margin-left:30px" id="user_checkout_block">
	<form id="checkout_form" action="javascript:void(null);" method="post">
		<label for="checkout_email">Электронная почта*<div class="user_error" id="checkout_error_email"><img src="/style/img/left.png" />Обязательное поле</div></label>
		<input type="text" name="checkout_email" id="checkout_email" placeholder="example@example.com" value="<?php GetSESSCheckoutEmail(); ?>"/><br/><br/>
		<label for="checkout_surname">Фамилия*<div class="user_error" id="checkout_error_surname"><img src="/style/img/left.png" />Обязательное поле</div></label>
		<input type="text" name="checkout_surname" id="checkout_surname" value="<?php GetSESSCheckoutSurname(); ?>" /><br/><br/>
		<label for="checkout_name">Имя*<div class="user_error" id="checkout_error_name"><img src="/style/img/left.png" />Обязательное поле</div></label>
		<input type="text" name="checkout_name" id="checkout_name" value="<?php GetSESSCheckoutName(); ?>"/><br/><br/>
		<label for="checkout_patronymic">Отчество<div class="user_error" id="checkout_error_patronymic"><img src="/style/img/left.png" />Неверный формат</div></label>
		<input type="text" name="checkout_patronymic" id="checkout_patronymic" value="<?php GetSESSCheckoutPatronymic(); ?>"/><br/><br/>
		<label for="checkout_phone">Номер телефона*<div class="user_error" id="checkout_error_phone"><img src="/style/img/left.png" />Обязательное поле</div></label>
		<input type="text" name="checkout_phone" placeholder="В удобном формате без +" id="checkout_phone" value="<?php GetSESSCheckoutPhone(); ?>" /><br/><br/>
		<label for="checkout_address">Адрес*<div class="user_error" id="checkout_error_address"><img src="/style/img/left.png" />Обязательное поле</div></label>
		<input type="text" name="checkout_address" id="checkout_address" value="<?php GetSESSCheckoutAddress(); ?>"/><br/><br/>
		<label for="checkout_information">Примечания<div class="user_help" id="user_help"><img src="/style/img/left_g.png" />Укажите здесь любую информацию о доставке. Например, удобное для Вас время звонка.</div><div class="user_error" id="checkout_error_information"><img src="/style/img/left.png" />Максимальное количество символов - 150</div></label>
		<textarea name="checkout_information" id="checkout_information" ><?php GetSESSCheckoutInfo(); ?></textarea><br/><br/><br/><br/><br/>
		<p class="forms_star">* - обязательные поля</p>
		<input type="submit" name="checkout_submit" id="checkout_submit" value="Далее" />
	</form>
	<a href="cart.php" id="go_back_to_cart">Вернуться назад</a><div style="clear:both;"></div>
</div>

<div style="clear:both;"></div>
