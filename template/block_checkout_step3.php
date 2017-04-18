<div id="checkout_title" style=""><p><span>Оформление заказа</span></p>
		<div id="checkout_step_one" class="active_step">Личные данные</div><div id="checkout_step_two" class="active_step">Способ доставки и оплаты</div><div id="checkout_step_three" class="active_step">Подтверждение заказа</div>
		</div>
<div style="margin-left:30px" id="user_checkout_final_block">
<p id="user_checkout_information_title_final">Подтверждение заказа</p>

<ul id="user_checkout_final">
	<li>Электронная почта: <span><?php GetSESSCheckoutEmail();?></span></li>
	<li>Фамилия: <span><?php GetSESSCheckoutSurname();?></span></li>
	<li>Имя: <span><?php GetSESSCheckoutName();?></span></li>
	<li>Отчество: <span><?php GetSESSCheckoutPatronymic();?></span></li>
	<li>Мобильный телефон: <span><?php GetSESSCheckoutPhone();?></span></li>
	<li>Адрес доставки: <span><?php GetSESSCheckoutAddress();?></span></li>
	<li>Способ доставки: <span><?php GetSESSCheckoutDel();?></span></li>
	<li>Способ оплаты: <span><?php GetSESSCheckoutPay();?></span></li>
	<li>Примечания: <span><?php GetSESSCheckoutInfo();?></span></li>
</ul>
<span id="final_price"><strong>Итоговая стоимость: </strong><?php GetSESSCheckoutFinal();?></span>
<?php GetPaymentMethod();?>
	<div style="clear:both;"></div>
</div>

<div style="clear:both;"></div>