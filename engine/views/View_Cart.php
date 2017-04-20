<?php
    $array = GetProducts();
?>
<h1 class="small--text-center">Корзина покупателя</h1>
  <form action="/cart" method="post" novalidate class="cart">
    <table class="responsive-table cart-table">
      <thead class="cart__row visually-hidden">
        <th colspan="2">Товар</th>
        <th>Количество</th>
        <th>Всего</th>
      </thead>
      <tbody id="CartProducts">
        <?php if($array) { ?>
          <?php foreach ($array as $cur) { ?>
            <tr class="cart__row responsive-table__row">
            <td class="cart__cell--image text-center">
              <a href="/products/<?=$cur['handle']?>" class="cart__image">
                  <?=ShopEngine::Help()->ImageReSize($cur['image'], 120, 220, $cur['title'], 'px')?>
              </a>
            </td>
            <td>
                <p class="cart-vendor-title">Marvis</p>
              <a href="/products/<?=$cur['handle']?>" class="h5">
                    <?=$cur['title']?>
              </a>
            </td>
            <td class="cart__cell--quantity">
              <label for="CartUpdate" class="cart__quantity-label medium-up--hide">Количество</label>
                <div class="js-qty">
                    <input data-temp-id="<?=$cur['cart_id']?>" data-csrf="<?= ShopEngine::Help()->generateToken() ?>" type="text" value="<?=$cur['cart_count']?>" id="CartUpdate_<?=$cur['cart_id']?>" name="updates[]" pattern="[0-9]*" data-line="1" class="js-qty__input cart_update" aria-live="polite">
                    <button data-temp-id="<?=$cur['cart_id']?>" data-csrf="<?= ShopEngine::Help()->generateToken()?>" type="button" class="js-qty__adjust js-qty__adjust--minus cart_minus" aria-label="Уменьшить количество">
                        <svg aria-hidden="true" focusable="false" role="presentation" viewBox="0 0 22 3" class="icon icon-minus"><path fill="#000" d="M21.5.5v2H.5v-2z" fill-rule="evenodd"></path></svg>
                        <span class="icon__fallback-text">−</span>
                    </button>
                    <button data-temp-id="<?=$cur['cart_id']?>" data-csrf="<?= ShopEngine::Help()->generateToken()?>" type="button" class="js-qty__adjust js-qty__adjust--plus cart_plus" aria-label="Увеличить количество">
                        <svg aria-hidden="true" focusable="false" role="presentation" viewBox="0 0 22 21" class="icon icon-plus"><path d="M12 11.5h9.5v-2H12V0h-2v9.5H.5v2H10V21h2v-9.5z" fill="#000" fill-rule="evenodd"></path></svg>
                        <span class="icon__fallback-text">+</span>
                    </button>
                </div>
              </td>
            <td class="cart__cell--total">
              
              <span class="cart__item-total">
                <?=ShopEngine::Help()->AsPrice($cur['cart_price'])?>
              </span>
              
            </td>
          </tr>
          <?php } ?>
        <?php } ?>
          
      </tbody>
    </table>
    <div class="grid cart__row">
      
        <div class="grid__item medium-up--one-half">
          <label for="CartSpecialInstructions">Комментарий к заказу</label>
          <textarea name="note" id="CartSpecialInstructions" class="cart__note"><?= Request::GetSession('note')?></textarea>
        </div>
      
      <div class="grid__item cart__buttons text-right small--text-center medium-up--one-half">
          <p class="h3 cart__subtotal" id="CartSubtotal"><?= GetCartSum()?></p>
        <p id="cartDiscountTotal">
        
        </p>
        <p class="cart__taxes">Доставка рассчитывается при оформлении заказа</p>
<!--        <input type="submit" name="update" class="btn--secondary update-cart" value="Обновить корзину">-->
        <input type="submit" name="checkout" class="btn" value="Оформление заказа">
        <input type="hidden" name="csrf" value="<?= ShopEngine::Help()->generateToken()?>" />
      </div>
    </div>
  </form>
	

<!--<div id="shipping-calculator">
    
  <h3>Рассчитать стоимость доставки</h3>

  <div>
    <p class="field">
      <select id="address_country" name="address[country]" data-default="Russia"><option value="Russia" data-provinces="[[&quot;Republic of Adygeya&quot;,&quot;Адыгея (респ)&quot;],[&quot;Altai Republic&quot;,&quot;Алтай (респ)&quot;],[&quot;Altai Krai&quot;,&quot;Алтайский (край)&quot;],[&quot;Amur Oblast&quot;,&quot;Амурская (обл)&quot;],[&quot;Arkhangelsk Oblast&quot;,&quot;Архангельская (обл)&quot;],[&quot;Astrakhan Oblast&quot;,&quot;Астраханская (обл)&quot;],[&quot;Republic of Bashkortostan&quot;,&quot;Башкортостан (респ)&quot;],[&quot;Belgorod Oblast&quot;,&quot;Белгородская (обл)&quot;],[&quot;Bryansk Oblast&quot;,&quot;Брянская (обл)&quot;],[&quot;Republic of Buryatia&quot;,&quot;Бурятия (респ)&quot;],[&quot;Vladimir Oblast&quot;,&quot;Владимирская (обл)&quot;],[&quot;Volgograd Oblast&quot;,&quot;Волгоградская (обл)&quot;],[&quot;Vologda Oblast&quot;,&quot;Вологодская (обл)&quot;],[&quot;Voronezh Oblast&quot;,&quot;Воронежская (обл)&quot;],[&quot;Republic of Dagestan&quot;,&quot;Дагестан (респ)&quot;],[&quot;Jewish Autonomous Oblast&quot;,&quot;Еврeйская (Аобл)&quot;],[&quot;Zabaykalsky Krai&quot;,&quot;Забайкальский край&quot;],[&quot;Ivanovo Oblast&quot;,&quot;Ивановская (обл)&quot;],[&quot;Republic of Ingushetia&quot;,&quot;Ингушетия (респ)&quot;],[&quot;Irkutsk Oblast&quot;,&quot;Иркутская (обл)&quot;],[&quot;Kabardino-Balkarian Republic&quot;,&quot;Кабардино-Балкарская (респ)&quot;],[&quot;Kaliningrad Oblast&quot;,&quot;Калининградская (обл)&quot;],[&quot;Republic of Kalmykia&quot;,&quot;Калмыкия (респ)&quot;],[&quot;Kaluga Oblast&quot;,&quot;Калужская (обл)&quot;],[&quot;Kamchatka Krai&quot;,&quot;Камчатский (край)&quot;],[&quot;Karachay–Cherkess Republic&quot;,&quot;Карачаево-Черкесская (респ)&quot;],[&quot;Republic of Karelia&quot;,&quot;Карелия (респ)&quot;],[&quot;Kemerovo Oblast&quot;,&quot;Кемеровская (обл)&quot;],[&quot;Kirov Oblast&quot;,&quot;Кировская (обл)&quot;],[&quot;Komi Republic&quot;,&quot;Коми (респ)&quot;],[&quot;Kostroma Oblast&quot;,&quot;Костромская (обл)&quot;],[&quot;Krasnodar Krai&quot;,&quot;Краснодарский (край)&quot;],[&quot;Krasnoyarsk Krai&quot;,&quot;Красноярский (край)&quot;],[&quot;Kurgan Oblast&quot;,&quot;Курганская (обл)&quot;],[&quot;Kursk Oblast&quot;,&quot;Курская (обл)&quot;],[&quot;Leningrad Oblast&quot;,&quot;Ленинградская (обл)&quot;],[&quot;Lipetsk Oblast&quot;,&quot;Липецкая (обл)&quot;],[&quot;Magadan Oblast&quot;,&quot;Магаданская (обл)&quot;],[&quot;Mari El Republic&quot;,&quot;Марий Эл (респ)&quot;],[&quot;Republic of Mordovia&quot;,&quot;Мордовия (респ)&quot;],[&quot;Moscow&quot;,&quot;Москва (г)&quot;],[&quot;Moscow Oblast&quot;,&quot;Московская (обл)&quot;],[&quot;Murmansk Oblast&quot;,&quot;Мурманская (обл)&quot;],[&quot;Nizhny Novgorod Oblast&quot;,&quot;Нижегородская (обл)&quot;],[&quot;Novgorod Oblast&quot;,&quot;Новгородская (обл)&quot;],[&quot;Novosibirsk Oblast&quot;,&quot;Новосибирская (обл)&quot;],[&quot;Omsk Oblast&quot;,&quot;Омская (обл)&quot;],[&quot;Orenburg Oblast&quot;,&quot;Оренбургская (обл)&quot;],[&quot;Oryol Oblast&quot;,&quot;Орловская (обл)&quot;],[&quot;Penza Oblast&quot;,&quot;Пензенская (обл)&quot;],[&quot;Perm Krai&quot;,&quot;Пермский (край)&quot;],[&quot;Primorsky Krai&quot;,&quot;Приморский (край)&quot;],[&quot;Pskov Oblast&quot;,&quot;Псковская (обл)&quot;],[&quot;Rostov Oblast&quot;,&quot;Ростовская (обл)&quot;],[&quot;Ryazan Oblast&quot;,&quot;Рязанская (обл)&quot;],[&quot;Samara Oblast&quot;,&quot;Самарская (обл)&quot;],[&quot;Saint Petersburg&quot;,&quot;Санкт-Петербург (г)&quot;],[&quot;Saratov Oblast&quot;,&quot;Саратовская (обл)&quot;],[&quot;Sakha Republic (Yakutia)&quot;,&quot;Саха (респ)&quot;],[&quot;Sakhalin Oblast&quot;,&quot;Сахалинская (обл)&quot;],[&quot;Sverdlovsk Oblast&quot;,&quot;Свердловская (обл)&quot;],[&quot;Republic of North Ossetia–Alania&quot;,&quot;Северная Осетия (респ)&quot;],[&quot;Smolensk Oblast&quot;,&quot;Смоленская (обл)&quot;],[&quot;Stavropol Krai&quot;,&quot;Ставропольский (край)&quot;],[&quot;Tambov Oblast&quot;,&quot;Тамбовская (обл)&quot;],[&quot;Republic of Tatarstan&quot;,&quot;Татарстан (респ)&quot;],[&quot;Tver Oblast&quot;,&quot;Тверская (обл)&quot;],[&quot;Tomsk Oblast&quot;,&quot;Томская (обл)&quot;],[&quot;Tula Oblast&quot;,&quot;Тульская (обл)&quot;],[&quot;Tyva Republic&quot;,&quot;Тыва (респ)&quot;],[&quot;Tyumen Oblast&quot;,&quot;Тюменская (обл)&quot;],[&quot;Udmurtia&quot;,&quot;Удмуртская (респ)&quot;],[&quot;Ulyanovsk Oblast&quot;,&quot;Ульяновская (обл)&quot;],[&quot;Khabarovsk Krai&quot;,&quot;Хабаровский (край)&quot;],[&quot;Republic of Khakassia&quot;,&quot;Хакасия (респ)&quot;],[&quot;Khanty-Mansi Autonomous Okrug&quot;,&quot;Ханты-Мансийский (АО)&quot;],[&quot;Chelyabinsk Oblast&quot;,&quot;Челябинская (обл)&quot;],[&quot;Chechen Republic&quot;,&quot;Чеченская (респ)&quot;],[&quot;Chuvash Republic&quot;,&quot;Чувашская (респ)&quot;],[&quot;Chukotka Autonomous Okrug&quot;,&quot;Чукотский (АО)&quot;],[&quot;Yamalo-Nenets Autonomous Okrug&quot;,&quot;Ямaло-Нeнецкий (АО)&quot;],[&quot;Yaroslavl Oblast&quot;,&quot;Ярослaвская (обл)&quot;]]">Россия</option></select>
    </p>
    <p class="field" id="address_province_container">
      <select id="address_province" name="address[province]" data-default=""></select>
    </p>  
    <p class="field" style="display:none;">
      <input type="text" id="address_zip" name="address[zip]" value="111"/>
    </p>
    <p class="field">
      <input type="button" class="get-rates btn button" value="Рассчитать" />
    </p>
  </div>

  <div id="wrapper-response"></div>
  
</div>-->

