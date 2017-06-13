<div id="checkout_title"><p><span>Оформление заказа</span></p>
<div id="checkout_step_one" class="active_step">Личные данные</div><div id="checkout_step_two" class="active_step">Способ доставки и оплаты</div><div id="checkout_step_three" >Подтверждение заказа</div>
</div>

<div style="margin-left:30px" id="user_checkout_block">
<p id="user_checkout_information_title">Выбрать способ доставки</p>
<form id="checkout_form" action="javascript:void(null);" method="post">
<ul id="user_chackout_radio_delivery">
<li>
<input type="radio" name="radio_delivery" id="radio_one" class="radio_delivery" value="По почте" <?php GetCheckbox1(); ?> />
<label for="radio_one">По почте<div class="user_error" id="checkout_error_delivery"><img src="/style/img/left.png" />Следует выбрать один из предложенных вариантов</div></label></label>
</li>
<li>
<input type="radio" name="radio_delivery" id="radio_two" class="radio_delivery" value="Курьером"  <?php GetCheckbox2(); ?>/>
<label for="radio_two">Курьером</label>
</li>
<li>
<input type="radio" name="radio_delivery" id="radio_three" class="radio_delivery" value="Самовывоз"  <?php GetCheckbox3(); ?> />
<label for="radio_three">Самовывоз</label>
</li>
</ul>
<p id="user_checkout_information_title_two">Выбрать способ оплаты</p>
<ul id="user_chackout_radio_payment">
<li><input type="radio" name="radio_payment" id="radio_payment_two" class="radio_payment" value="Оплата онлайн"  <?php GetCheckbox4(); ?> />
<label for="radio_payment_two">Оплата онлайн<div class="user_error" id="checkout_error_payment"><img src="/style/img/left.png" />Следует выбрать один из предложенных вариантов</div></label></li>
<li><input type="radio" name="radio_payment" id="radio_payment_three" class="radio_payment" value="Оплата при получении" <?php GetCheckbox5(); ?> />
<label for="radio_payment_three">Оплата при получении</label></li>
</ul>

<input type="submit" name="checkout_submit_two" id="checkout_submit_two" value="Далее" />
</form><a href="checkout.php?step=1" id="go_back_to_cart">Вернуться назад</a>
<div style="clear:both;"></div>
</div>

<div style="clear:both;"></div>