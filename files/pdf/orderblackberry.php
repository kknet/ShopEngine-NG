<!-- <br><br><br><br> -->
<div style='margin: 0 80px;'>
	<p style='font-size: 10px;'>Внимание! Оплата данного счета означает согласие с условиями поставки товара. Соблюдение сроков оплаты и уведомление
	об оплате обязательно, в противном случае не гарантируется наличие товара на складе. В случает нарушения сроков оплаты
	счета цена на товар может быть изменена без уведомления. Товар отпускается по факту прихода денег на р/с Поставщика.</p>
	<p style='text-align: center; font-weight: bold; margin-top: 30px; font-size: 12px;'>Образец заполнения платежного поручения</p>

	<table style='width: 100%;'>
		<tr>
			<td style='border: 2px solid #000; width: 30%;'>ИНН 7715750413</td>
			<td style='border: 2px solid #000; width: 30%;'>КПП 771501001</td>
			<td rowspan="2" style='border: 2px solid #000; width: 10%; vertical-align: bottom; text-align: center;'>Сч. №</td>
			<td rowspan="2" style='border: 2px solid #000; vertical-align: bottom;'>40702810100000113800</td>
		</tr>
		<tr>
			<td colspan="2" style='border: 2px solid #000;'>Получатель<br>ООО "Блэкфон"</td>
		</tr>
		<tr>
			<td colspan="2" rowspan="2" style='border: 2px solid #000;'>Банк получателя<br>ВТБ 24 (ПАО), Г МОСКВА</td>
			<td style='border: 2px solid #000; width: 10%; vertical-align: bottom; text-align: center;'>БИК</td>
			<td style='border: 2px solid #000; vertical-align: bottom;'>044525716</td>
		</tr>
		<tr>

			<td style='border: 2px solid #000; width: 10%; vertical-align: bottom; text-align: center;'>Сч. №</td>
			<td style='border: 2px solid #000; vertical-align: bottom;'>30101810100000000716</td>
		</tr>
	</table>
	<p style='font-weight: bold; font-size: 12px;'>Наименование платежа: Оплата по СЧЕТУ № {{ORDERID}} от {{DATE}} НДС не облагается.</p>
	<h1 style='text-align: center; margin-top: 25px; margin-bottom: 0; font-size: 18px;'>ООО "Блэкфон"</h1>
	<p style='text-align: center; font-weight: bold; font-size: 10px;'>СЧЕТ ДЕЙСТВИТЕЛЕН К ОПЛАТЕ В ТЕЧЕНИЕ ДВУХ БАНКОВСКИХ ДНЕЙ</p>
	<h1 style='text-align: center; margin-top: 25px; margin-bottom: 0; font-size: 18px;'>СЧЕТ № {{ORDERID}} от {{DATE}}</h1>
	<table style="margin-top: 15px;">
		<tr>
			<td style='width: 150px;'>Плательщик</td>
			<td style='border-bottom: 2px solid #000; width: 500px;'>{{CUSTOMERNAME}}</td>
		</tr>
		<tr>
			<td style='width: 150px;'>Грузополучатель</td>
			<td style='border-bottom: 2px solid #000; width: 500px;'>{{CUSTOMERNAME}}</td>
		</tr>
	</table>

	<table style='width: 100%; border-collapse: collapse; margin-top: 20px;'>
		<tr>
			<th style='border: 2px solid #000; height: 36px;'>№</th>
			<th style='border: 2px solid #000; height: 36px;'>Наименование товара</th>
			<th style='border: 2px solid #000; height: 36px;'>Цена</th>
			<th style='border: 2px solid #000; height: 36px;'>Кол-во</th>
			<th style='border: 2px solid #000; height: 36px;'>Ед. изм.</th>
			<th style='border: 2px solid #000; height: 36px;'>Сумма</th>
		</tr>
		<tbody>
			{{ITEMS}}
		</tbody>
		<tr>
			<td colspan="5" style='text-align: right;'>Итого:</td>
			<td style='text-align: right; border: 2px solid #000;'>{{ALLPRICE}}</td>
		</tr>
		<tr>
			<td colspan="5" style='text-align: right;'>В том числе НДС:</td>
			<td style='text-align: right; border: 2px solid #000;'>Без НДС</td>
		</tr>
	</table>
	<p style='font-weight: bold; font-size: 12px; margin-top: 20px;'>Итого к оплате: {{ALLPRICESTRING}}</p>
	<table style="margin-top: 15px; width: 100%;">
		<tr>
			<td style='width: 220px; padding: 2px 0;'>Руководитель предприятия</td>
			<td>
				<img src="lib/views/img/venzel.png" alt="подпись" width='150px'>
			</td>
			<td style='width: 200px; padding: 2px 0;'>(Чиннов С.С.)</td>
		</tr>
		<tr>
			<td style='width: 220px; padding: 2px 0;'>Главный бухгалтер</td>
			<td>&nbsp;</td>
			<td style='width: 200px; padding: 2px 0;'>(Чиннов С.С.)</td>
		</tr>
		<tr>
			<td colspan="3" style="text-align: left;">
				<img src="lib/views/img/shtempel.png" alt="печать компании" width='150px'>
			</td>
		</tr>
		<tr>
			<td colsapn="3">
				 {{CUSTOMERNAMETWO}} {{CUSTOMERPHONE}}
			</td>
		</tr>
	</table>
</div>