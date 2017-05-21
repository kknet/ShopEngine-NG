<button class="order-summary-toggle order-summary-toggle--show" data-drawer-toggle="[data-order-summary]">
  <div class="wrap">
    <div class="order-summary-toggle__inner">
      <div class="order-summary-toggle__icon-wrapper">
        <svg width="20" height="19" xmlns="http://www.w3.org/2000/svg" class="order-summary-toggle__icon">
          <path d="M17.178 13.088H5.453c-.454 0-.91-.364-.91-.818L3.727 1.818H0V0h4.544c.455 0 .91.364.91.818l.09 1.272h13.45c.274 0 .547.09.73.364.18.182.27.454.18.727l-1.817 9.18c-.09.455-.455.728-.91.728zM6.27 11.27h10.09l1.454-7.362H5.634l.637 7.362zm.092 7.715c1.004 0 1.818-.813 1.818-1.817s-.814-1.818-1.818-1.818-1.818.814-1.818 1.818.814 1.817 1.818 1.817zm9.18 0c1.004 0 1.817-.813 1.817-1.817s-.814-1.818-1.818-1.818-1.818.814-1.818 1.818.814 1.817 1.818 1.817z"/>
        </svg>
      </div>
      <div class="order-summary-toggle__text order-summary-toggle__text--show">
        <span>Показать итоговый заказ</span>
        <svg width="11" height="6" xmlns="http://www.w3.org/2000/svg" class="order-summary-toggle__dropdown" fill="#000"><path d="M.504 1.813l4.358 3.845.496.438.496-.438 4.642-4.096L9.504.438 4.862 4.534h.992L1.496.69.504 1.812z" /></svg>
      </div>
      <div class="order-summary-toggle__text order-summary-toggle__text--hide">
        <span>Скрыть итоговый заказ</span>
        <svg width="11" height="7" xmlns="http://www.w3.org/2000/svg" class="order-summary-toggle__dropdown" fill="#000"><path d="M6.138.876L5.642.438l-.496.438L.504 4.972l.992 1.124L6.138 2l-.496.436 3.862 3.408.992-1.122L6.138.876z" /></svg>
      </div>
      <div class="order-summary-toggle__total-recap total-recap" data-order-summary-section="toggle-total-recap">
          <span class="total-recap__final-price" data-checkout-payment-due-target=""><?= ShopEngine::Help()->AsPrice($info['orders_price']) ?></span>
      </div>
    </div>
  </div>
</button>
      
    <div class="content" data-content="">
      <div class="wrap">
        <div class="sidebar" role="complementary">
          <div class="sidebar__header">
            
<a href="<?=ShopEngine::GetHost()?>" class="logo logo--left">
    <h1 class="logo__text">Потерпите, пожалуйста!</h1>
</a>

          </div>
          <div class="sidebar__content">
            <div class="order-summary order-summary--is-collapsed" data-order-summary="">
  <h2 class="visually-hidden">Итог заказа</h2>

  <div class="order-summary__sections">
    <div class="order-summary__section order-summary__section--product-list">
  <div class="order-summary__section__content">
    <table class="product-table">
      <caption class="visually-hidden">Корзина</caption>
      <thead>
        <tr>
          <th scope="col"><span class="visually-hidden">Изображение товара</span></th>
          <th scope="col"><span class="visually-hidden">Описание</span></th>
          <th scope="col"><span class="visually-hidden">Количество</span></th>
          <th scope="col"><span class="visually-hidden">Цена</span></th>
        </tr>
      </thead>
      <tbody data-order-summary-section="line-items">
          <?php if($checkout_products) { ?>
            <?php foreach ($checkout_products as $cur) { ?>
                  <tr class="product" data-product-id="" data-variant-id="" data-product-type="<?=$cur['name']?>">
                      <td class="product__image">
                          <div class="product-thumbnail">
                              <div class="product-thumbnail__wrapper">
                                  <?= ShopEngine::Help()->ImageReSize($cur['image'], 95, 95, $cur['title'], '%', 'product-thumbnail__image')?>
                      <!--    <img alt="6 Металлик" class="product-thumbnail__image" src="//cdn.shopify.com/s/files/1/1339/0281/products/371437955_small.jpg?5300525480014731583">-->
                              </div>
                              <span class="product-thumbnail__quantity" aria-hidden="true"><?=$cur['orders_count']?></span>
                          </div>

                      </td>
                          <td class="product__description">
                              <span class="product__description__name order-summary__emphasis"><?=$cur['title']?></span>
                              <span class="product__description__variant order-summary__small-text"></span>
                          </td>
                      <td class="product__quantity visually-hidden"><?=$cur['orders_count']?></td>
                      <td class="product__price">
                          <span class="order-summary__emphasis"><?= ShopEngine::Help()->AsPrice($cur['price'])?></span>
                      </td>
                  </tr>
            <?php } ?>
          <?php } ?>
      </tbody>
    </table>

    <div class="order-summary__scroll-indicator">
      Scroll for more items
      <svg xmlns="http://www.w3.org/2000/svg" width="10" height="12" viewBox="0 0 10 12"><path d="M9.817 7.624l-4.375 4.2c-.245.235-.64.235-.884 0l-4.375-4.2c-.244-.234-.244-.614 0-.848.245-.235.64-.235.884 0L4.375 9.95V.6c0-.332.28-.6.625-.6s.625.268.625.6v9.35l3.308-3.174c.122-.117.282-.176.442-.176.16 0 .32.06.442.176.244.234.244.614 0 .848"></path></svg>
    </div>
  </div>
</div>



    <div class="order-summary__section order-summary__section--total-lines" data-order-summary-section="payment-lines">
  <table class="total-line-table">
    <caption class="visually-hidden">Итоговая стоимость</caption>
    <thead>
      <tr>
        <th scope="col"><span class="visually-hidden">Описание</span></th>
        <th scope="col"><span class="visually-hidden">Цена</span></th>
      </tr>
    </thead>
      <tbody class="total-line-table__tbody">
        <tr class="total-line total-line--subtotal">
          <td class="total-line__name">Промежуточный итог</td>
          <td class="total-line__price">
            <span class="order-summary__emphasis" data-checkout-subtotal-price-target="">
              <?= ShopEngine::Help()->AsPrice($final) ?>
            </span>
          </td>
        </tr>


          <tr class="total-line total-line--shipping">
            <td class="total-line__name">Доставка</td>
            <td class="total-line__price">
              <span class="order-summary__emphasis" data-checkout-total-shipping-target="0">
               <?= ShopEngine::Help()->AsPrice($info['orders_shipping_price']) ?>
              </span>
            </td>
          </tr>

          <tr class="total-line total-line--taxes hidden" data-checkout-taxes="">
            <td class="total-line__name">Налоги</td>
            <td class="total-line__price">
              <span class="order-summary__emphasis" data-checkout-total-taxes-target="0">0.00 р.</span>
            </td>
          </tr>

      </tbody>
    <tfoot class="total-line-table__footer">
      <tr class="total-line">
        <td class="total-line__name payment-due-label">
          <span class="payment-due-label__total">Всего</span>
        </td>
        <td class="total-line__price payment-due">
          <span class="payment-due__currency">RUB</span>
          <span class="payment-due__price" data-checkout-payment-due-target="">
            <?= ShopEngine::Help()->AsPrice($info['orders_price']) ?>
          </span>
        </td>
      </tr>
    </tfoot>
  </table>
</div>

  </div>
</div>

          </div>
        </div>

    <div class="main" role="main">
          <div class="main__header">
            
<a href="<?= ShopEngine::GetHost()?>" class="logo logo--left">
    <h1 class="logo__text">Потерпите, пожалуйста!</h1>
</a>

<!--            <ul class="breadcrumb ">
    <li class="breadcrumb__item breadcrumb__item--completed">
      <a class="breadcrumb__link" href="https://poterpite.ru/cart">Корзина</a>
      <svg class="icon-svg icon-svg--size-10 breadcrumb__chevron-icon rtl-flip" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 10 10"><path d="M2 1l1-1 4 4 1 1-1 1-4 4-1-1 4-4"></path></svg>
    </li>

    <li class="breadcrumb__item breadcrumb__item--completed">
      <a class="breadcrumb__link" href="https://checkout.shopify.com/13390281/checkouts/38f5d2d8c2aae7887ee77a15a7f2b688?step=contact_information">Информация о покупателе</a>
        <svg class="icon-svg icon-svg--size-10 breadcrumb__chevron-icon rtl-flip" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 10 10"><path d="M2 1l1-1 4 4 1 1-1 1-4 4-1-1 4-4"></path></svg>
    </li>
    <li class="breadcrumb__item breadcrumb__item--completed">
      <a class="breadcrumb__link" href="https://checkout.shopify.com/13390281/checkouts/38f5d2d8c2aae7887ee77a15a7f2b688?step=shipping_method">Способ доставки</a>
        <svg class="icon-svg icon-svg--size-10 breadcrumb__chevron-icon rtl-flip" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 10 10"><path d="M2 1l1-1 4 4 1 1-1 1-4 4-1-1 4-4"></path></svg>
    </li>
    <li class="breadcrumb__item breadcrumb__item--completed">
      <a class="breadcrumb__link" href="https://checkout.shopify.com/13390281/checkouts/38f5d2d8c2aae7887ee77a15a7f2b688?step=payment_method">Способ оплаты</a>
    </li>
</ul>-->

            <div data-alternative-payments="">
</div>

          </div>
          <div class="main__content">
              <div class="section">
    <div class="section__header os-header">
      <svg width="50" height="50" xmlns="http://www.w3.org/2000/svg" fill="none" stroke="#000" stroke-width="2" class="os-header__hanging-icon os-header__hanging-icon--animate checkmark">
  <path class="checkmark__circle" d="M25 49c13.255 0 24-10.745 24-24S38.255 1 25 1 1 11.745 1 25s10.745 24 24 24z"></path>
  <path class="checkmark__check" d="M15 24.51l7.307 7.308L35.125 19"></path>
</svg>

      <div class="os-header__heading">
        <span class="os-order-number">
            Заказ #<?=$info['orders_id']?>
        </span>
        <h2 class="os-header__title">
            Спасибо<?php echo $info['orders_name'] !== "" ? ' , '. $info['orders_name'] : ''?>!
        </h2>
      </div>
    </div>
  </div>

  <div class="thank-you__additional-content">
    <script src="https://widget.cloudpayments.ru/bundles/cloudpayments"></script>
<style>
    div.mainPayment p+p{margin-top: 0px;}
    div.mainPayment{width: 110%; margin-top: 40px; margin-left: -55px;}
    div.blockPayment:after{content: ''; display: block; clear: both; margin-bottom: 50px; }
    div.blockPayment div{float: left; display: inline-block; width: 480px;}
    div.blockPayment div.imgPaument{width: 110px; padding-top: 6px; margin-right: 30px; text-align: right;}
    @media (max-width: 767px) {div.blockPayment div.imgPaument{margin-bottom: 30px;}}
    div.blockPayment div.textPayment{font-family: 'Arial'; font-weight: 400; font-style: normal; font-size: 18px; line-height: 26px;}
    button, .button{background-color: rgb(0,120,255); border-radius: 5px; border-width: 0px; border-color: rgb(0,0,0); font-family: Arial; font-weight: 400; font-style: normal; color: rgb(255,255,255); font-size: 16px; letter-spacing: 0px; min-width: 168px; height: 39px; display: inline-block; line-height: 39px; text-align: center; text-decoration: none; transition: 1s; cursor: pointer; margin-top: 15px; padding: 0 20px;}
    button:hover, .button:hover{background-color: rgba(0,120,255,.6);}
    div.mainPayment p{color: #333333; margin: 0; padding-bottom: 1px;line-height: 18px; font-size: 14px; padding-top: 0px;}
    div.mainPayment p.h1{font-family: Arial; font-size: 18px;}
</style>

<div class="mainPayment">
<!--    <div class="blockPayment payMoscow">
        <div class="imgPaument">
            <img src="//cdn.shopify.com/s/files/1/1339/0281/t/2/assets/pay.png?5300525480014731583" alt="">
        </div>
        <div class="textPayment">
            <p class="h1">Оплата наличными в Москве</p>
            <p>Оплата наличными возможна в Москве при доставке товара курьером по Москве в пределах МКАД или самовывозе из офиса</p>
        </div>    
    </div>
    <div class="blockPayment getOrder">
        <div class="imgPaument">
            <img src="//cdn.shopify.com/s/files/1/1339/0281/t/2/assets/pay_cards.png?5300525480014731583" alt="">
        </div>
        <div class="textPayment">
            <p class="h1">Оплата по счету (без комиссии для физ.лиц)</p>
            <p>Вы можете скачать и оплатить счет в банке<br>
            Подтверждение оплаты и отправка товара произойдет на следующий рабочий день, при условии наличия товара на складе</p>
            <a class="button" target="_blank" href="http://order.blackberryrussia.com/pdf/index.php?id=4802676291&amp;site=poterpite">Скачать счет для физ.лиц</a>
        </div>    
    </div>-->
    <!--<div class="blockPayment payCard">
        <div class="imgPaument">
            <img src="//cdn.shopify.com/s/files/1/1339/0281/t/2/assets/get_order.png?5300525480014731583" alt="">
        </div>
        <div class="textPayment">
            <p class='h1'>Оплата картой (комиссия 5%)</p>
            <p>Вы можете произвести оплату банковской картой<br>
            Подтверждение оплаты и отправка товара произойдет в этот же рабочий день, при условии наличия товара на складе</p>
            <button onClick='payHandler();'>Оплатить картой</button>
        </div>    
    </div>-->
    <div class="order_block">
         
    </div>
    <div class="blockPayment getOrderUr">
<!--        <div class="imgPaument">
            <img src="/style/assets/get_order_ur.png" alt="">
        </div>-->
        <div class="textPayment">
            <p class="h1">Скачать счет</p>
            <p>Вы можете заполнить реквизиты и скачать счет для оплаты<br>
            Подтверждение оплаты и отправка товара произойдет на следующий рабочий день, при условии наличия товара на складе</p>
            <a class="button" target="_blank" href="<?=ShopEngine::GetHost().'/checkout/download?orderid='.$info['orders_key']?>">Скачать счет</a>
        </div>    
    </div>
</div>


<!--<script type="text/javascript">
  var payHandler = function () {
        //требуется библиотека jquery
        var widget = new cp.CloudPayments();
        widget.charge({ // options
                publicId: 'pk_3185f5959840fbc5dc11c760ea605',
                description: 'Оплата в BLACKBERRY RUSSIA',
                amount: 15958.95, //сумма
                currency: 'RUB',
                invoiceId: '4802676291', //номер заказа
                accountId: 'alexandergrachyov@gmail.com', //плательщик
            },
            function (options) { // success
                //действие при успешном платеже
            },
            function (reason, options) { // fail
                //действие при неуспешном платеже
            });
    };
</script>-->
  </div>

<div class="section">
  <div class="section__content">
    <div class="content-box">
    <div class="content-box__row content-box__row--no-padding">
<!--    <div class="map leaflet-container leaflet-retina leaflet-fade-anim" data-token="pk.eyJ1Ijoic2hvcGlmeSIsImEiOiJRS1hjczRZIn0.-QXj2pCqs2oirQ6KaP0c1A" data-mapbox="" tabindex="0" style="position: relative;">
<div style="display: none;" data-type="shipping" data-marker="true" data-lat="55.74429989999999" data-lng="37.5750343" data-label="Москва, Jewish Autonomous Oblast"><span class="small-text">Адрес доставки</span><br>
<span class="emphasis">
  Москва, Jewish Autonomous Oblast
</span>

</div>
      <a class="mapbox-logo" target="_blank" title="Mapbox" href="http://mapbox.com/about/maps"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 60 18"><path d="M59.34 12.5l-2.59-3.62 2.4-3.38c.64-.89-.12-2.38-1.21-2.38h-2.16c-.47 0-.94.24-1.22.63l-.72 1.03-.75-1.03c-.27-.39-.74-.63-1.22-.63h-2.16c-.49 0-.97.25-1.25.66-.86-.51-1.84-.81-2.91-.81-2.03 0-3.83 1.08-4.88 2.69-1.04-1.63-2.87-2.69-4.95-2.69V1.5c0-.39-.16-.79-.44-1.06C35 .16 34.61 0 34.22 0h-1.75c-.71 0-1.5.83-1.5 1.5v3.16c-1.06-1.06-2.48-1.69-4.06-1.69h-3.34c-.77.02-1.47.72-1.47 1.5v.31c-1.02-1.12-2.46-1.81-4.09-1.81s-3.07.7-4.09 1.81l-.01-3.28c0-.79-.71-1.5-1.5-1.5h-1.38c-.95 0-2.22.37-2.84 1.44l-1 1.69-1-1.69C5.56.37 4.3 0 3.34 0H1.81C1.07.06.43.75.44 1.5v11.88c.02.77.72 1.47 1.5 1.47h1.75c.78 0 1.48-.69 1.5-1.47V9.1l.72 1.19c.53.87 2.03.87 2.56 0l.72-1.19v4.28c.02.76.7 1.45 1.47 1.47h1.75c.78 0 1.48-.69 1.5-1.47v-.16c1.02 1.12 2.46 1.81 4.09 1.81h4.09v1.47c0 .78.69 1.48 1.47 1.5h1.75c.79 0 1.5-.71 1.5-1.5l.02-1.47c1.72 0 3.08-.64 4.14-1.69v.19c0 .39.16.79.44 1.06.28.28.67.44 1.06.44h3.31c2.03 0 3.85-1.06 4.91-2.69 1.05 1.61 2.84 2.69 4.88 2.69 1.03 0 1.98-.27 2.81-.75.28.35.73.57 1.19.56h2.12c.48.01.97-.23 1.25-.62l.91-1.28.91 1.28c.28.39.74.63 1.22.62h2.16c1.06-.01 1.81-1.45 1.2-2.34zm-40.4-2.22H18c-.52 0-.94-.38-.94-1.28s.42-1.28.94-1.28c.53 0 .94.35.94 1.28v1.28zm7.87 0V7.72c.83 0 1.18.68 1.19 1.28.01.94-.62 1.28-1.19 1.28zm8.72 0V7.72c.72 0 1.37.6 1.37 1.28 0 .77-.51 1.28-1.37 1.28zm10.03 0c-.58 0-1.12-.5-1.12-1.28s.54-1.28 1.12-1.28 1.09.5 1.09 1.28-.51 1.28-1.09 1.28z" opacity=".25"></path><path d="M18 4.47c-2.44 0-4.19 1.91-4.19 4.53s1.75 4.53 4.19 4.53h4.19V9c0-2.62-1.75-4.53-4.19-4.53zm2.44 7.31H18c-1.4 0-2.44-1.21-2.44-2.78S16.6 6.22 18 6.22 20.44 7.41 20.44 9v2.78zM9.47 2.19l-2.28 3.9-2.28-3.9c-.31-.53-.87-.69-1.57-.69h-1.4v12h1.75V3.59l3.5 5.94 3.47-5.94v9.91h1.75v-12h-1.38c-.7 0-1.25.16-1.56.69zm36.09 2.28c-2.41 0-4.38 2.03-4.38 4.53s1.97 4.53 4.38 4.53S49.9 11.5 49.9 9s-1.94-4.53-4.34-4.53zm0 7.31c-1.44 0-2.62-1.24-2.62-2.78 0-1.54 1.18-2.78 2.62-2.78S48.15 7.46 48.15 9c0 1.54-1.15 2.78-2.59 2.78z" fill="#fff"></path><path d="M54.91 8.88l3.03-4.38h-2.16l-1.94 2.81-1.97-2.81h-2.15l3.03 4.38-3.19 4.62h2.12l2.16-3.09 2.13 3.09h2.15m-31.22-9h-3.34v12h1.75v-2.97h1.59c2.44 0 4.34-1.91 4.34-4.53s-1.9-4.5-4.34-4.5zm0 7.28h-1.59V6.25h1.59c1.59 0 2.59 1.28 2.59 2.75s-1.13 2.78-2.59 2.78zm8.88-7.25c-.55 0-.93-.03-1.5-.03v-3h-1.75v12.03h3.25c2.44 0 4.38-1.91 4.38-4.53s-1.93-4.47-4.38-4.47zm0 7.25h-1.5V6.25h1.5c1.47 0 2.62 1.28 2.62 2.75s-1.04 2.78-2.62 2.78z" fill="#fff"></path></svg></a>
    <div class="leaflet-map-pane" style="transform: translate3d(-14px, 22px, 0px);"><div class="leaflet-tile-pane"><div class="leaflet-layer"><div class="leaflet-tile-container"></div><div class="leaflet-tile-container leaflet-zoom-animated"><img class="leaflet-tile leaflet-tile-loaded" src="https://a.tiles.mapbox.com/v4/mapbox.streets/13/4950/2560@2x.png?access_token=pk.eyJ1Ijoic2hvcGlmeSIsImEiOiJRS1hjczRZIn0.-QXj2pCqs2oirQ6KaP0c1A" style="height: 256px; width: 256px; left: 20px; top: -234px;"><img class="leaflet-tile leaflet-tile-loaded" src="https://b.tiles.mapbox.com/v4/mapbox.streets/13/4951/2560@2x.png?access_token=pk.eyJ1Ijoic2hvcGlmeSIsImEiOiJRS1hjczRZIn0.-QXj2pCqs2oirQ6KaP0c1A" style="height: 256px; width: 256px; left: 276px; top: -234px;"><img class="leaflet-tile leaflet-tile-loaded" src="https://b.tiles.mapbox.com/v4/mapbox.streets/13/4950/2561@2x.png?access_token=pk.eyJ1Ijoic2hvcGlmeSIsImEiOiJRS1hjczRZIn0.-QXj2pCqs2oirQ6KaP0c1A" style="height: 256px; width: 256px; left: 20px; top: 22px;"><img class="leaflet-tile leaflet-tile-loaded" src="https://a.tiles.mapbox.com/v4/mapbox.streets/13/4951/2561@2x.png?access_token=pk.eyJ1Ijoic2hvcGlmeSIsImEiOiJRS1hjczRZIn0.-QXj2pCqs2oirQ6KaP0c1A" style="height: 256px; width: 256px; left: 276px; top: 22px;"><img class="leaflet-tile leaflet-tile-loaded" src="https://b.tiles.mapbox.com/v4/mapbox.streets/13/4949/2560@2x.png?access_token=pk.eyJ1Ijoic2hvcGlmeSIsImEiOiJRS1hjczRZIn0.-QXj2pCqs2oirQ6KaP0c1A" style="height: 256px; width: 256px; left: -236px; top: -234px;"><img class="leaflet-tile leaflet-tile-loaded" src="https://a.tiles.mapbox.com/v4/mapbox.streets/13/4952/2560@2x.png?access_token=pk.eyJ1Ijoic2hvcGlmeSIsImEiOiJRS1hjczRZIn0.-QXj2pCqs2oirQ6KaP0c1A" style="height: 256px; width: 256px; left: 532px; top: -234px;"><img class="leaflet-tile leaflet-tile-loaded" src="https://a.tiles.mapbox.com/v4/mapbox.streets/13/4949/2561@2x.png?access_token=pk.eyJ1Ijoic2hvcGlmeSIsImEiOiJRS1hjczRZIn0.-QXj2pCqs2oirQ6KaP0c1A" style="height: 256px; width: 256px; left: -236px; top: 22px;"><img class="leaflet-tile leaflet-tile-loaded" src="https://b.tiles.mapbox.com/v4/mapbox.streets/13/4952/2561@2x.png?access_token=pk.eyJ1Ijoic2hvcGlmeSIsImEiOiJRS1hjczRZIn0.-QXj2pCqs2oirQ6KaP0c1A" style="height: 256px; width: 256px; left: 532px; top: 22px;"></div></div></div><div class="leaflet-objects-pane"><div class="leaflet-shadow-pane"></div><div class="leaflet-overlay-pane"></div><div class="leaflet-marker-pane"><div class="leaflet-marker-icon shipping-location-indicator leaflet-zoom-animated leaflet-clickable" tabindex="0" style="margin-left: -9px; margin-top: -11.5px; width: 18px; height: 23px; transform: translate3d(286px, 100px, 0px); z-index: 100;"></div></div><div class="leaflet-popup-pane"><div class="leaflet-popup  leaflet-zoom-animated" style="opacity: 1; transform: translate3d(286px, 100px, 0px); bottom: -7px; left: -134px;"><div class="leaflet-popup-content-wrapper"><div class="leaflet-popup-content" style="width: 268px;"><span class="small-text">Адрес доставки</span><br>
<span class="emphasis">
  Москва, Jewish Autonomous Oblast
</span>

</div></div><div class="leaflet-popup-tip-container"><div class="leaflet-popup-tip"></div></div></div></div></div></div><div class="leaflet-control-container"><div class="leaflet-top leaflet-left"><div class="leaflet-control-zoom leaflet-bar leaflet-control"><a class="leaflet-control-zoom-in" href="#" title="Zoom in">+</a><a class="leaflet-control-zoom-out" href="#" title="Zoom out">-</a></div></div><div class="leaflet-top leaflet-right"><div class="leaflet-control-grid map-tooltip leaflet-control" style="display: none;"><a class="close" href="#" title="close">close</a><div class="map-tooltip-content"></div></div></div><div class="leaflet-bottom leaflet-left"><div class="mapbox-logo leaflet-control"></div></div><div class="leaflet-bottom leaflet-right"><div class="map-legends wax-legends leaflet-control" style="display: none;"></div><div class="leaflet-control-attribution leaflet-control leaflet-compact-attribution"><a href="https://www.mapbox.com/about/maps/" target="_blank">© Mapbox</a> <a href="https://openstreetmap.org/about/" target="_blank">© OpenStreetMap</a></div></div></div></div>
  </div>-->

  <div class="content-box__row">
    <h2 class="os-step__title">Ваш заказ подтвержден</h2>
          <div class="os-step__special-description">
            <p>Квитанция на оплату будет направлена на Вашу электронную почту.</p>
          </div>
  </div>
</div>

    <div class="content-box">
  <div class="content-box__row">
    <h2 class="os-step__title">Order updates</h2>
      <p class="os-step__description">
          A confirmation was sent to <span class="emphasis"><?= $info['orders_email']?></span>
      </p>
  </div>
</div>

    <div class="content-box">
  <div class="content-box__row content-box__row--no-border">
    <h2>Информация пользователя</h2>
  </div>
  <div class="content-box__row">
    <div class="section__content">
          <div class="section__content__column section__content__column--half">
              <h3>Адрес доставки</h3>
              <p><?= $info['orders_name']?> <?= $info['orders_last_name']?><br><?= $info['orders_address']?><br><?= $info['orders_city']?><br><!--<?php /* echo $info['orders_region'] */?><br>--><?= $info['orders_index']?><br><?= $info['orders_country']?><br><?= $info['orders_phone']?></p>
              <h3>Способ доставки</h3>
              <p><?= $info['orders_shipping']?></p>
          </div>
          <div class="section__content__column section__content__column--half">
              <h3>Платежный адрес</h3>
              <?php 
                if($info['orders_billing_status'] === '0') { ?>
              <p><?= $info['orders_name']?> <?= $info['orders_last_name']?><br><?= $info['orders_address']?><br><?= $info['orders_city']?><br><!--<?php /* echo $info['orders_region'] */?><br>--><?= $info['orders_index']?><br><?= $info['orders_country']?><br><?= $info['orders_phone']?></p>
                <?php } else { ?>
                    <p><?= $info['orders_billing_name']?> <?= $info['orders_billing_last_name']?><br><?= $info['orders_billing_address']?><br><?= $info['orders_billing_city']?><br><!--<?php /* echo $info['orders_region'] */?><br>--><?= $info['orders_billing_index']?><br><?= $info['orders_billing_country']?><br><?= $info['orders_billing_phone']?></p>
               <?php } ?>                        
                <h3>Способ оплаты
              <ul class="payment-method-list">
                <li class="payment-method-list__item">
    <span class="payment-method-list__item__info"><?= $info['payment_name']?></span>
  <span class="payment-method-list__item__amount emphasis"><?= ShopEngine::Help()->AsPrice($info['orders_price'])?></span>
</li>


              </ul>
          </h3></div>
    </div>
  </div>
</div>

  </div>
</div>

<div class="step__footer">
    <a href="<?= ShopEngine::GetHost()?>" class="step__footer__continue-btn btn">
      <span class="btn__content">Продолжить покупку</span>
      <i class="btn__spinner icon icon--button-spinner"></i>
    </a>
  <p class="step__footer__info">
    <i class="icon icon--os-question"></i>
    <span>
      Нужна помощь? <a href="mailto:info@poterpite.ru">Свяжитесь с нами</a>
    </span>
  </p>
</div>

          </div>
          <div class="main__footer">
            <div class="modals">
</div>


<div role="contentinfo" aria-label="Нижний колонтитул">
    <p class="copyright-text">
      Все права защищены Потерпите, пожалуйста!
    </p>
</div>

<div id="dialog-close-title" class="hidden">Закрыть</div>

          </div>
        </div> 
        
        <!-- trash/final.php -->
         
