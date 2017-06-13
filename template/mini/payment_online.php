<form id="checkout_form" method="post" action="https://wl.walletone.com/checkout/checkout/Index">
	<input type="hidden" name="WMI_MERCHANT_ID"    value="177267643795"/>
	<input type="hidden" name="WMI_PAYMENT_AMOUNT" value="1.00"/>
	<input type="hidden" name="WMI_CURRENCY_ID"    value="643"/>
	<input type="hidden" name="WMI_PAYMENT_NO"     value="<?php echo $_SESSION['order_id']; ?>"/>
	<input type="hidden" name="WMI_DESCRIPTION"    value="Оплата демонстрационного заказа"/>
	<input type="hidden" name="WMI_SUCCESS_URL"    value="order_page.php?status=true"/>
	<input type="hidden" name="WMI_FAIL_URL"       value="order_page.php?status=false"/>
	<input type="submit" value="Оплатить" id="checkout_submit_final" name="checkout_submit_final_pay"/>
</form><a href="/checkout/step2" id="go_back_to_step">Вернуться назад</a>