<?php 
    $array = GetFinalProducts();
    if(!$start) 
    {
        //return Route::ErrorPage404();
    }
?>

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
          <span class="total-recap__final-price" data-checkout-payment-due-target=""><?= GetFinalPrice()?></span>
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
          <?php foreach ($array as $cur) { ?>
                <tr class="product" data-product-id="" data-variant-id="" data-product-type="<?=$cur['name']?>">
                    <td class="product__image">
                        <div class="product-thumbnail">
                            <div class="product-thumbnail__wrapper">
                                <?= ShopEngine::Help()->ImageReSize($cur['image'], 95, 95, $cur['title'], '%', 'product-thumbnail__image')?>
                    <!--    <img alt="6 Металлик" class="product-thumbnail__image" src="//cdn.shopify.com/s/files/1/1339/0281/products/371437955_small.jpg?5300525480014731583">-->
                            </div>
                            <span class="product-thumbnail__quantity" aria-hidden="true">1</span>
                        </div>

                    </td>
                        <td class="product__description">
                            <span class="product__description__name order-summary__emphasis"><?=$cur['title']?></span>
                            <span class="product__description__variant order-summary__small-text"></span>
                        </td>
                    <td class="product__quantity visually-hidden"><?=$cur['orders_count']?></td>
                    <td class="product__price">
                        <span class="order-summary__emphasis"><?= ShopEngine::Help()->AsPrice($cur['orders_price'])?></span>
                    </td>
                </tr>
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
              <?= GetFinalPrice()?>
            </span>
          </td>
        </tr>


          <tr class="total-line total-line--shipping">
            <td class="total-line__name">Доставка</td>
            <td class="total-line__price">
              <span class="order-summary__emphasis" data-checkout-total-shipping-target="0">
               <?= ShopEngine::Help()->AsPrice(Request::GetSession('shipper_price')) ?>
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
            <?= ShopEngine::Help()->AsPrice(Request::GetSession('full_price')) ?>
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
            Заказ #<?=$start['orders_id']?>
        </span>
        <h2 class="os-header__title">
            Спасибо<?php echo $start['orders_name'] !== "" ? ' , '. $start['orders_name'] : ''?>!
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
    <div class="blockPayment payMoscow">
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
    </div>
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
    <div class="blockPayment getOrderUr">
        <div class="imgPaument">
            <img src="//cdn.shopify.com/s/files/1/1339/0281/t/2/assets/get_order_ur.png?5300525480014731583" alt="">
        </div>
        <div class="textPayment">
            <p class="h1">Скачать счет (комиссия 5% для юр.лиц)</p>
            <p>Вы можете заполнить реквизиты и скачать счет для оплаты<br>
            Подтверждение оплаты и отправка товара произойдет на следующий рабочий день, при условии наличия товара на складе</p>
            <a class="button" target="_blank" href="http://order.blackberryrussia.com/pdf/index.php?id=4802676291&amp;site=poterpite&amp;ur=1">Скачать счет для юр.лиц</a>
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
          A confirmation was sent to <span class="emphasis"><?= $start['orders_email']?></span>
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
              <p><?= $start['orders_name']?> <?= $start['orders_last_name']?><br><?= $start['orders_address']?><br><?= $start['orders_city']?><br>YEV<br><?= $start['orders_index']?><br><?= $start['orders_country']?><br><?= $start['orders_phone']?></p>
              <h3>Способ доставки</h3>
              <p><?= $start['orders_shipping']?></p>
          </div>
          <div class="section__content__column section__content__column--half">
              <h3>Платежный адрес</h3>
              <?php 
                if($start['orders_billing_status'] === '0') { ?>
              <p><?= $start['orders_name']?> <?= $start['orders_last_name']?><br><?= $start['orders_address']?><br><?= $start['orders_city']?><br>YEV<br><?= $start['orders_index']?><br><?= $start['orders_country']?><br><?= $start['orders_phone']?></p>
                <?php } else { ?>
                    <p><?= $start['orders_billing_name']?> <?= $start['orders_billing_last_name']?><br><?= $start['orders_billing_address']?><br><?= $start['orders_billing_city']?><br>YEV<br><?= $start['orders_billing_index']?><br><?= $start['orders_billing_country']?><br><?= $start['orders_billing_phone']?></p>
               <?php } ?>                        
                <h3>Способ оплаты
              <ul class="payment-method-list">
                <li class="payment-method-list__item">
    <span class="payment-method-list__item__info"><?= $start['payment_name']?></span>
  <span class="payment-method-list__item__amount emphasis"><?= ShopEngine::Help()->AsPrice($start['orders_price'])?></span>
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
          
<!--<div class="main" role="main">
          <div class="main__header">
            
<a href="<?= ShopEngine::GetHost()?>" class="logo logo--left">
    <h1 class="logo__text">Потерпите, пожалуйста!</h1>
</a>

            <ul class="breadcrumb ">
    <li class="breadcrumb__item breadcrumb__item--completed">
      <a class="breadcrumb__link" href="/cart">Корзина</a>
      <svg class="icon-svg icon-svg--size-10 breadcrumb__chevron-icon rtl-flip" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 10 10"><path d="M2 1l1-1 4 4 1 1-1 1-4 4-1-1 4-4"></path></svg>
    </li>

    <li class="breadcrumb__item breadcrumb__item--completed">
      <a class="breadcrumb__link" href="/checkout/step1">Информация о покупателе</a>
        <svg class="icon-svg icon-svg--size-10 breadcrumb__chevron-icon rtl-flip" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 10 10"><path d="M2 1l1-1 4 4 1 1-1 1-4 4-1-1 4-4"></path></svg>
    </li>
    <li class="breadcrumb__item breadcrumb__item--completed">
      <a class="breadcrumb__link" href="/checkout/step2">Способ доставки</a>
        <svg class="icon-svg icon-svg--size-10 breadcrumb__chevron-icon rtl-flip" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 10 10"><path d="M2 1l1-1 4 4 1 1-1 1-4 4-1-1 4-4"></path></svg>
    </li>
    <li class="breadcrumb__item breadcrumb__item--current">
      <span class="breadcrumb__text">Способ оплаты</span>
    </li>
</ul>

            <div data-alternative-payments="">
</div>

          </div>
          <div class="main__content">
            <div class="step" data-step="payment_method">
  
  <form data-payment-form="" class="edit_checkout animate-floating-labels" action="/checkout/step3" accept-charset="UTF-8" method="post"><input name="utf8" type="hidden" value="✓"><input type="hidden" name="_method" value="patch"><input type="hidden" name="authenticity_token" value="brmFCpyveNm13m/FJL+9taPUHs7dFLTlbodU0vAv2xeRGsI8DVvCSMUldVrM+QSjlzz9U1babZw1sQWrcLa6ug==">

    <input type="hidden" name="previous_step" id="previous_step" value="payment_method">
    <input type="hidden" name="step">
    <input type="hidden" name="s" id="s">


      <div class="step__sections">
        <div class="section">
  <div class="content-box">
    <div class="content-box__row content-box__row--tight-spacing-vertical content-box__row--secondary">
      <div class="review-block">
        <div class="review-block__inner">
          <div class="review-block__label">
              Адрес доставки
          </div>
          <div class="review-block__content">
            Москва, Москва, Россия
          </div>
        </div>
        <div class="review-block__link">
          <a class="link--small" href="/checkout/step1">
            <span aria-hidden="">Редактировать</span>
            <span class="visually-hidden">Редактировать адрес доставки</span>
</a>        </div>
      </div>

        <hr class="content-box__hr content-box__hr--tight">
        <div class="review-block">
          <div class="review-block__inner">
            <div class="review-block__label">
              Способ доставки
            </div>
            <div class="review-block__content">
              <?= Request::GetSession('shipper_name')?>
               · 
             <?= ShopEngine::Help()->AsPrice(Request::GetSession('shipper_price')) ?>
            </div>
          </div>
          <div class="review-block__link">
            <a class="link--small" href="/checkout/step2">
              <span aria-hidden="">Редактировать</span>
              <span class="visually-hidden">Редактировать способ доставки</span>
</a>          </div>
        </div>
    </div>
  </div>
</div>

          <div class="section section--payment-method" data-payment-method="">
  <div class="section__header">
    <h2 class="section__title">Способ оплаты</h2>
      <p class="section__text">
        Все транзакции безопасны и зашифрованы. Информация о кредитной карте не сохраняется.
      </p>
  </div>

  <div class="section__content">

    <div data-payment-subform="required">
      <div class="content-box">
          <div class="radio-wrapper content-box__row " data-gateway-group="manual" data-select-gateway="84194051">
              <div class="radio__input">
                <input class="input-radio" id="checkout_payment_gateway_84194051" data-backup="payment_gateway_84194051" aria-expanded="true" aria-controls="payment-gateway-subfields-84194051" type="radio" value="1" checked="checked" name="checkout_payment_gateway">
              </div>

            <label class="radio__label content-box__emphasis " for="checkout_payment_gateway_84194051">
              <div class="radio__label__primary">
                  Банковский перевод (для физических лиц)
              </div>

              <div class="radio__label__accessory">
              </div>
</label>          </div>

              <div class="radio-wrapper content-box__row content-box__row--secondary" data-subfields-for-gateway="84194051" id="payment-gateway-subfields-84194051">
    <div class="blank-slate">
      <p>Для оплаты банковским переводом мы пришлем квитанцию на оплату. Дополнительных комиссий с нашей стороны нет.</p>
    </div>
  </div>

                  <div class="radio-wrapper content-box__row " data-gateway-group="manual" data-select-gateway="84194179">
              <div class="radio__input">
                <input class="input-radio" id="checkout_payment_gateway_84194179" data-backup="payment_gateway_84194179" aria-expanded="false" aria-controls="payment-gateway-subfields-84194179" type="radio" value="2" name="checkout_payment_gateway">
              </div>

            <label class="radio__label content-box__emphasis " for="checkout_payment_gateway_84194179">
              <div class="radio__label__primary">
                  Банковский перевод (для юридических лиц, комиссия 5%)
              </div>

              <div class="radio__label__accessory">
              </div>
</label>          </div>

              <div class="radio-wrapper content-box__row content-box__row--secondary hidden" data-subfields-for-gateway="84194179" id="payment-gateway-subfields-84194179">
    <div class="blank-slate">
      <p>При оплате счета от юридического лица в стоимость товара и услуг будет добавлена комиссия в размере 5%. НДС не облагается.</p>
    </div>
  </div>

                  <div class="radio-wrapper content-box__row " data-gateway-group="manual" data-select-gateway="84194307">
              <div class="radio__input">
                <input class="input-radio" id="checkout_payment_gateway_84194307" data-backup="payment_gateway_84194307" aria-expanded="false" aria-controls="payment-gateway-subfields-84194307" type="radio" value="3" name="checkout_payment_gateway">
              </div>

            <label class="radio__label content-box__emphasis " for="checkout_payment_gateway_84194307">
              <div class="radio__label__primary">
                  Наличная оплата
              </div>

              <div class="radio__label__accessory">
              </div>
</label>          </div>

              <div class="radio-wrapper content-box__row content-box__row--secondary hidden" data-subfields-for-gateway="84194307" id="payment-gateway-subfields-84194307">
    <div class="blank-slate">
      <p>Вы сможете оплатить товар наличными в офисе или курьеру в Москве.</p>
    </div>
  </div>

         
      </div>
    </div> 

    <div data-payment-subform="gift_cards" class="hidden">
      <input value="free" disabled="disabled" size="30" type="hidden" name="checkout[payment_gateway]" aria-expanded="false">
      <div class="content-box blank-slate">
        <div class="content-box__row">
          <i class="blank-slate__icon icon icon--free-tag"></i>
          <p>Ваш заказ может быть оплачен вашей подарочной картой</p>
        </div>
      </div>
</div>
    <div data-payment-subform="free" class="hidden">
      <input value="free" disabled="disabled" size="30" type="hidden" name="checkout[payment_gateway]" aria-expanded="false">
      <div class="content-box blank-slate">
        <div class="content-box__row">
          <i class="blank-slate__icon icon icon--free-tag"></i>
          <p>Ваш заказ <strong>free</strong>. Оплата не требуется.</p>
        </div>
      </div>
</div>  </div> 
</div>

  <div class="section section--billing-address" data-billing-address="">
    <div class="section__header">
      <h2 class="section__title">Платежный адрес</h2>
    </div>

    <div class="section__content">
      <div class="content-box">
        <div class="radio-wrapper content-box__row">
          <div class="radio__input">
            <input class="input-radio" data-backup="different_billing_address_false" type="radio" value="0" name="checkout_billing_address_payment" id="checkout_different_billing_address_false">
          </div>

          <label class="radio__label content-box__emphasis" for="checkout_different_billing_address_false">
            Такой же как адрес доставки
</label>        </div>

        <div class="radio-wrapper content-box__row">
          <div class="radio__input">
            <input class="input-radio" data-backup="different_billing_address_true" checked="checked" aria-expanded="false" aria-controls="section--billing-address__different" type="radio" value="1" name="checkout_billing_address_payment" id="checkout_different_billing_address_true">
          </div>
          <label class="radio__label content-box__emphasis" for="checkout_different_billing_address_true">
            Используйте другой платежный адрес
        </label>        </div>

        <div class="radio-group__row content-box__row content-box__row--secondary" id="section--billing-address__different">
          <div class="fieldset" data-address-fields="">
            
              
<input class="visually-hidden" autocomplete="billing given-name" tabindex="-1" data-autocomplete-field="first_name" size="30" type="text" name="checkout[billing_address][first_name" disabled="">

<input class="visually-hidden" autocomplete="billing family-name" tabindex="-1" data-autocomplete-field="last_name" size="30" type="text" name="checkout[billing_address][last_name]" disabled="">

  <input class="visually-hidden" autocomplete="billing organization" tabindex="-1" data-autocomplete-field="company" size="30" type="text" name="checkout[billing_address][company]" disabled="">
  
<input class="visually-hidden" autocomplete="billing address-line1" tabindex="-1" data-autocomplete-field="address1" size="30" type="text" name="checkout[billing_address][address1]" disabled="">

  <input class="visually-hidden" autocomplete="billing address-line2" tabindex="-1" data-autocomplete-field="address2" size="30" type="text" name="checkout[billing_address][address2]" disabled="">
  
<input class="visually-hidden" autocomplete="billing address-level2" tabindex="-1" data-autocomplete-field="city" size="30" type="text" name="checkout[billing_address][city]" disabled="">

<input class="visually-hidden" autocomplete="billing country" tabindex="-1" data-autocomplete-field="country" size="30" type="text" name="checkout[billing_address][country]" disabled="">

<input class="visually-hidden" autocomplete="billing address-level1" tabindex="-1" data-autocomplete-field="province" size="30" type="text" name="checkout[billing_address][province]" disabled="">

<input class="visually-hidden" autocomplete="billing postal-code" tabindex="-1" data-autocomplete-field="zip" size="30" type="text" name="checkout[billing_address][zip]" disabled="">

  <input class="visually-hidden" autocomplete="billing tel" tabindex="-1" data-autocomplete-field="phone" size="30" type="text" name="checkout[billing_address][phone]" disabled="">
  
          <div class="field field--optional field--half" data-address-field="first_name">
  
  <div class="field__input-wrapper"><label class="field__label" for="checkout_billing_address_first_name">Имя</label>
    <input placeholder="Имя" autocomplete="billing given-name" data-backup="first_name" class="field__input" size="30" type="text" name="checkout_billing_first_name" id="checkout_billing_address_first_name">
  </div>
</div><div class="field field--required field--half <?=$error['billing_last_name']['class']?>" data-address-field="last_name">
  
  <div class="field__input-wrapper"><label class="field__label" for="checkout_billing_address_last_name">Фамилия</label>
    <input placeholder="Фамилия" autocomplete="billing family-name" data-backup="last_name" class="field__input" size="30" type="text" name="checkout_billing_last_name" id="checkout_billing_address_last_name">
  </div>
    <?=$error['billing_last_name']['message']?>
</div><div data-address-field="company" class="field field--optional">
    
    <div class="field__input-wrapper"><label class="field__label" for="checkout_billing_address_company">Компания</label>
      <input placeholder="Компания" autocomplete="billing organization" data-backup="company" class="field__input" size="30" type="text" name="checkout_billing_company" id="checkout_billing_address_company">
    </div>
</div><div class="field field--required field--two-thirds <?=$error['billing_address']['class']?>" data-address-field="address1">
  
  <div class="field__input-wrapper"><label class="field__label" for="checkout_billing_address_address1">Адрес</label>
    <input placeholder="Адрес" autocomplete="billing address-line1" data-backup="address1" data-google-places="name" class="field__input" size="30" type="text" name="checkout_billing_address" id="checkout_billing_address_address1">
  </div>
    <?=$error['billing_address']['message']?>
</div><div class="field field--optional field--third" data-address-field="address2">
    
    <div class="field__input-wrapper"><label class="field__label" for="checkout_billing_address_address2">Квартира, корпус и тд</label>
      <input placeholder="Квартира, корпус и тд" autocomplete="billing address-line2" data-backup="address2" class="field__input" size="30" type="text" name="checkout_billing_flat" id="checkout_billing_address_address2">
    </div>
</div><div data-address-field="city" class="field field--required <?=$error['billing_city']['class']?>">
  
  <div class="field__input-wrapper"><label class="field__label" for="checkout_billing_address_city">Город</label>
    <input placeholder="Город" autocomplete="billing address-level2" data-backup="city" data-google-places="locality" class="field__input" size="30" type="text" name="checkout_billing_city" id="checkout_billing_address_city">
  </div>
    <?=$error['billing_city']['message']?>
</div><div data-address-field="country" class="field field--required field--show-floating-label field--half">
  
  <div class="field__input-wrapper field__input-wrapper--select"><label class="field__label" for="checkout_billing_address_country">Страна</label>
    <select size="1" autocomplete="billing country" data-backup="country" class="field__input field__input--select" name="checkout_billing_country" id="checkout_billing_address_country">
        <option data-code="AF" value="Afghanistan">Афганистан</option>
<option data-code="AX" value="Aland Islands">Аландские о-ва</option>
<option data-code="AL" value="Albania">Албания</option>
<option data-code="DZ" value="Algeria">Алжир</option>
<option data-code="AD" value="Andorra">Андорра</option>
<option data-code="AO" value="Angola">Ангола</option>
<option data-code="AI" value="Anguilla">Ангилья</option>
<option data-code="AG" value="Antigua And Barbuda">Антигуа и Барбуда</option>
<option data-code="AR" value="Argentina">Аргентина</option>
<option data-code="AM" value="Armenia">Армения</option>
<option data-code="AW" value="Aruba">Аруба</option>
<option data-code="AU" value="Australia">Австралия</option>
<option data-code="AT" value="Austria">Австрия</option>
<option data-code="AZ" value="Azerbaijan">Азербайджан</option>
<option data-code="BS" value="Bahamas">Багамские о-ва</option>
<option data-code="BH" value="Bahrain">Бахрейн</option>
<option data-code="BD" value="Bangladesh">Бангладеш</option>
<option data-code="BB" value="Barbados">Барбадос</option>
<option data-code="BY" value="Belarus">Беларусь</option>
<option data-code="BE" value="Belgium">Бельгия</option>
<option data-code="BZ" value="Belize">Белиз</option>
<option data-code="BJ" value="Benin">Бенин</option>
<option data-code="BM" value="Bermuda">Бермудские о-ва</option>
<option data-code="BT" value="Bhutan">Бутан</option>
<option data-code="BO" value="Bolivia">Боливия</option>
<option data-code="BA" value="Bosnia And Herzegovina">Босния и Герцеговина</option>
<option data-code="BW" value="Botswana">Ботсвана</option>
<option data-code="BV" value="Bouvet Island">о-в Буве</option>
<option data-code="BR" value="Brazil">Бразилия</option>
<option data-code="IO" value="British Indian Ocean Territory">Британская территория в Индийском океане</option>
<option data-code="BN" value="Brunei">Бруней-Даруссалам</option>
<option data-code="BG" value="Bulgaria">Болгария</option>
<option data-code="BF" value="Burkina Faso">Буркина-Фасо</option>
<option data-code="BI" value="Burundi">Бурунди</option>
<option data-code="KH" value="Cambodia">Камбоджа</option>
<option data-code="CA" value="Canada">Канада</option>
<option data-code="CV" value="Cape Verde">Кабо-Верде</option>
<option data-code="KY" value="Cayman Islands">Каймановы о-ва</option>
<option data-code="CF" value="Central African Republic">ЦАР</option>
<option data-code="TD" value="Chad">Чад</option>
<option data-code="CL" value="Chile">Чили</option>
<option data-code="CN" value="China">Китай</option>
<option data-code="CX" value="Christmas Island">о-в Рождества</option>
<option data-code="CC" value="Cocos (Keeling) Islands">Кокосовые о-ва</option>
<option data-code="CO" value="Colombia">Колумбия</option>
<option data-code="KM" value="Comoros">Коморские о-ва</option>
<option data-code="CG" value="Congo">Конго - Браззавиль</option>
<option data-code="CD" value="Congo, The Democratic Republic Of The">Конго - Киншаса</option>
<option data-code="CK" value="Cook Islands">о-ва Кука</option>
<option data-code="CR" value="Costa Rica">Коста-Рика</option>
<option data-code="HR" value="Croatia">Хорватия</option>
<option data-code="CU" value="Cuba">Куба</option>
<option data-code="CW" value="Curaçao">Кюрасао</option>
<option data-code="CY" value="Cyprus">Кипр</option>
<option data-code="CZ" value="Czech Republic">Чехия</option>
<option data-code="CI" value="Côte d'Ivoire">Кот-д’Ивуар</option>
<option data-code="DK" value="Denmark">Дания</option>
<option data-code="DJ" value="Djibouti">Джибути</option>
<option data-code="DM" value="Dominica">Доминика</option>
<option data-code="DO" value="Dominican Republic">Доминиканская Республика</option>
<option data-code="EC" value="Ecuador">Эквадор</option>
<option data-code="EG" value="Egypt">Египет</option>
<option data-code="SV" value="El Salvador">Сальвадор</option>
<option data-code="GQ" value="Equatorial Guinea">Экваториальная Гвинея</option>
<option data-code="ER" value="Eritrea">Эритрея</option>
<option data-code="EE" value="Estonia">Эстония</option>
<option data-code="ET" value="Ethiopia">Эфиопия</option>
<option data-code="FK" value="Falkland Islands (Malvinas)">Фолклендские о-ва</option>
<option data-code="FO" value="Faroe Islands">Фарерские о-ва</option>
<option data-code="FJ" value="Fiji">Фиджи</option>
<option data-code="FI" value="Finland">Финляндия</option>
<option data-code="FR" value="France">Франция</option>
<option data-code="GF" value="French Guiana">Французская Гвиана</option>
<option data-code="PF" value="French Polynesia">Французская Полинезия</option>
<option data-code="TF" value="French Southern Territories">Французские Южные Территории</option>
<option data-code="GA" value="Gabon">Габон</option>
<option data-code="GM" value="Gambia">Гамбия</option>
<option data-code="GE" value="Georgia">Грузия</option>
<option data-code="DE" value="Germany">Германия</option>
<option data-code="GH" value="Ghana">Гана</option>
<option data-code="GI" value="Gibraltar">Гибралтар</option>
<option data-code="GR" value="Greece">Греция</option>
<option data-code="GL" value="Greenland">Гренландия</option>
<option data-code="GD" value="Grenada">Гренада</option>
<option data-code="GP" value="Guadeloupe">Гваделупа</option>
<option data-code="GT" value="Guatemala">Гватемала</option>
<option data-code="GG" value="Guernsey">Гернси</option>
<option data-code="GN" value="Guinea">Гвинея</option>
<option data-code="GW" value="Guinea Bissau">Гвинея-Бисау</option>
<option data-code="GY" value="Guyana">Гайана</option>
<option data-code="HT" value="Haiti">Гаити</option>
<option data-code="HM" value="Heard Island And Mcdonald Islands">о-ва Херд и Макдональд</option>
<option data-code="VA" value="Holy See (Vatican City State)">Ватикан</option>
<option data-code="HN" value="Honduras">Гондурас</option>
<option data-code="HK" value="Hong Kong">Гонконг (особый район)</option>
<option data-code="HU" value="Hungary">Венгрия</option>
<option data-code="IS" value="Iceland">Исландия</option>
<option data-code="IN" value="India">Индия</option>
<option data-code="ID" value="Indonesia">Индонезия</option>
<option data-code="IR" value="Iran, Islamic Republic Of">Иран</option>
<option data-code="IQ" value="Iraq">Ирак</option>
<option data-code="IE" value="Ireland">Ирландия</option>
<option data-code="IM" value="Isle Of Man">О-в Мэн</option>
<option data-code="IL" value="Israel">Израиль</option>
<option data-code="IT" value="Italy">Италия</option>
<option data-code="JM" value="Jamaica">Ямайка</option>
<option data-code="JP" value="Japan">Япония</option>
<option data-code="JE" value="Jersey">Джерси</option>
<option data-code="JO" value="Jordan">Иордания</option>
<option data-code="KZ" value="Kazakhstan">Казахстан</option>
<option data-code="KE" value="Kenya">Кения</option>
<option data-code="KI" value="Kiribati">Кирибати</option>
<option data-code="KP" value="Korea, Democratic People's Republic Of">КНДР</option>
<option data-code="XK" value="Kosovo">Косово</option>
<option data-code="KW" value="Kuwait">Кувейт</option>
<option data-code="KG" value="Kyrgyzstan">Киргизия</option>
<option data-code="LA" value="Lao People's Democratic Republic">Лаос</option>
<option data-code="LV" value="Latvia">Латвия</option>
<option data-code="LB" value="Lebanon">Ливан</option>
<option data-code="LS" value="Lesotho">Лесото</option>
<option data-code="LR" value="Liberia">Либерия</option>
<option data-code="LY" value="Libyan Arab Jamahiriya">Ливия</option>
<option data-code="LI" value="Liechtenstein">Лихтенштейн</option>
<option data-code="LT" value="Lithuania">Литва</option>
<option data-code="LU" value="Luxembourg">Люксембург</option>
<option data-code="MO" value="Macao">Макао (особый район)</option>
<option data-code="MK" value="Macedonia, Republic Of">Македония</option>
<option data-code="MG" value="Madagascar">Мадагаскар</option>
<option data-code="MW" value="Malawi">Малави</option>
<option data-code="MY" value="Malaysia">Малайзия</option>
<option data-code="MV" value="Maldives">Мальдивские о-ва</option>
<option data-code="ML" value="Mali">Мали</option>
<option data-code="MT" value="Malta">Мальта</option>
<option data-code="MQ" value="Martinique">Мартиника</option>
<option data-code="MR" value="Mauritania">Мавритания</option>
<option data-code="MU" value="Mauritius">Маврикий</option>
<option data-code="YT" value="Mayotte">Майотта</option>
<option data-code="MX" value="Mexico">Мексика</option>
<option data-code="MD" value="Moldova, Republic of">Молдова</option>
<option data-code="MC" value="Monaco">Монако</option>
<option data-code="MN" value="Mongolia">Монголия</option>
<option data-code="ME" value="Montenegro">Черногория</option>
<option data-code="MS" value="Montserrat">Монтсеррат</option>
<option data-code="MA" value="Morocco">Марокко</option>
<option data-code="MZ" value="Mozambique">Мозамбик</option>
<option data-code="MM" value="Myanmar">Мьянма (Бирма)</option>
<option data-code="NA" value="Namibia">Намибия</option>
<option data-code="NR" value="Nauru">Науру</option>
<option data-code="NP" value="Nepal">Непал</option>
<option data-code="NL" value="Netherlands">Нидерланды</option>
<option data-code="AN" value="Netherlands Antilles">Нидерландские Антильские о-ва</option>
<option data-code="NC" value="New Caledonia">Новая Каледония</option>
<option data-code="NZ" value="New Zealand">Новая Зеландия</option>
<option data-code="NI" value="Nicaragua">Никарагуа</option>
<option data-code="NE" value="Niger">Нигер</option>
<option data-code="NG" value="Nigeria">Нигерия</option>
<option data-code="NU" value="Niue">Ниуэ</option>
<option data-code="NF" value="Norfolk Island">о-в Норфолк</option>
<option data-code="NO" value="Norway">Норвегия</option>
<option data-code="OM" value="Oman">Оман</option>
<option data-code="PK" value="Pakistan">Пакистан</option>
<option data-code="PS" value="Palestinian Territory, Occupied">Палестинские территории</option>
<option data-code="PA" value="Panama">Панама</option>
<option data-code="PG" value="Papua New Guinea">Папуа – Новая Гвинея</option>
<option data-code="PY" value="Paraguay">Парагвай</option>
<option data-code="PE" value="Peru">Перу</option>
<option data-code="PH" value="Philippines">Филиппины</option>
<option data-code="PN" value="Pitcairn">Питкэрн</option>
<option data-code="PL" value="Poland">Польша</option>
<option data-code="PT" value="Portugal">Португалия</option>
<option data-code="QA" value="Qatar">Катар</option>
<option data-code="CM" value="Republic of Cameroon">Камерун</option>
<option data-code="RE" value="Reunion">Реюньон</option>
<option data-code="RO" value="Romania">Румыния</option>
<option data-code="RU" value="Russia">Россия</option>
<option data-code="RW" value="Rwanda">Руанда</option>
<option data-code="BL" value="Saint Barthélemy">Сен-Бартельми</option>
<option data-code="SH" value="Saint Helena">О-в Св. Елены</option>
<option data-code="KN" value="Saint Kitts And Nevis">Сент-Китс и Невис</option>
<option data-code="LC" value="Saint Lucia">Сент-Люсия</option>
<option data-code="MF" value="Saint Martin">Сен-Мартен</option>
<option data-code="PM" value="Saint Pierre And Miquelon">Сен-Пьер и Микелон</option>
<option data-code="WS" value="Samoa">Самоа</option>
<option data-code="SM" value="San Marino">Сан-Марино</option>
<option data-code="ST" value="Sao Tome And Principe">Сан-Томе и Принсипи</option>
<option data-code="SA" value="Saudi Arabia">Саудовская Аравия</option>
<option data-code="SN" value="Senegal">Сенегал</option>
<option data-code="RS" value="Serbia">Сербия</option>
<option data-code="SC" value="Seychelles">Сейшельские о-ва</option>
<option data-code="SL" value="Sierra Leone">Сьерра-Леоне</option>
<option data-code="SG" value="Singapore">Сингапур</option>
<option data-code="SX" value="Sint Maarten">Синт-Мартен</option>
<option data-code="SK" value="Slovakia">Словакия</option>
<option data-code="SI" value="Slovenia">Словения</option>
<option data-code="SB" value="Solomon Islands">Соломоновы о-ва</option>
<option data-code="SO" value="Somalia">Сомали</option>
<option data-code="ZA" value="South Africa">ЮАР</option>
<option data-code="GS" value="South Georgia And The South Sandwich Islands">Южная Георгия и Южные Сандвичевы о-ва</option>
<option data-code="KR" value="South Korea">Республика Корея</option>
<option data-code="ES" value="Spain">Испания</option>
<option data-code="LK" value="Sri Lanka">Шри-Ланка</option>
<option data-code="VC" value="St. Vincent">Сент-Винсент и Гренадины</option>
<option data-code="SD" value="Sudan">Судан</option>
<option data-code="SR" value="Suriname">Суринам</option>
<option data-code="SJ" value="Svalbard And Jan Mayen">Шпицберген и Ян-Майен</option>
<option data-code="SZ" value="Swaziland">Свазиленд</option>
<option data-code="SE" value="Sweden">Швеция</option>
<option data-code="CH" value="Switzerland">Швейцария</option>
<option data-code="SY" value="Syria">Сирия</option>
<option data-code="TW" value="Taiwan">Тайвань</option>
<option data-code="TJ" value="Tajikistan">Таджикистан</option>
<option data-code="TZ" value="Tanzania, United Republic Of">Танзания</option>
<option data-code="TH" value="Thailand">Таиланд</option>
<option data-code="TL" value="Timor Leste">Восточный Тимор</option>
<option data-code="TG" value="Togo">Того</option>
<option data-code="TK" value="Tokelau">Токелау</option>
<option data-code="TO" value="Tonga">Тонга</option>
<option data-code="TT" value="Trinidad and Tobago">Тринидад и Тобаго</option>
<option data-code="TN" value="Tunisia">Тунис</option>
<option data-code="TR" value="Turkey">Турция</option>
<option data-code="TM" value="Turkmenistan">Туркменистан</option>
<option data-code="TC" value="Turks and Caicos Islands">О-ва Тёркс и Кайкос</option>
<option data-code="TV" value="Tuvalu">Тувалу</option>
<option data-code="UG" value="Uganda">Уганда</option>
<option data-code="UA" value="Ukraine">Украина</option>
<option data-code="AE" value="United Arab Emirates">ОАЭ</option>
<option data-code="GB" value="United Kingdom">Великобритания</option>
<option data-code="US" value="United States">Соединенные Штаты</option>
<option data-code="UM" value="United States Minor Outlying Islands">Внешние малые о-ва (США)</option>
<option data-code="UY" value="Uruguay">Уругвай</option>
<option data-code="UZ" value="Uzbekistan">Узбекистан</option>
<option data-code="VU" value="Vanuatu">Вануату</option>
<option data-code="VE" value="Venezuela">Венесуэла</option>
<option data-code="VN" value="Vietnam">Вьетнам</option>
<option data-code="VG" value="Virgin Islands, British">Виргинские о-ва (Британские)</option>
<option data-code="WF" value="Wallis And Futuna">Уоллис и Футуна</option>
<option data-code="EH" value="Western Sahara">Западная Сахара</option>
<option data-code="YE" value="Yemen">Йемен</option>
<option data-code="ZM" value="Zambia">Замбия</option>
<option data-code="ZW" value="Zimbabwe">Зимбабве</option></select>
  </div>
</div><div data-address-field="zip" class="field field--required field--half <?=$error['billing_index']['class']?>">
  
  <div class="field__input-wrapper"><label class="field__label" for="checkout_billing_address_zip">Почтовый индекс</label>
    <input placeholder="Индекс" autocomplete="billing postal-code" data-backup="zip" data-google-places="postal_code" class="field__input field__input--zip" size="30" type="text" name="checkout_billing_index" id="checkout_billing_address_zip">
  </div>
    <?=$error['billing_index']['message']?>
</div><div data-address-field="phone" class="field field--required <?=$error['billing_phone']['class']?>">
    
    <div class="field__input-wrapper"><label class="field__label" for="checkout_billing_address_phone">Тел.</label>
      <input placeholder="Тел." autocomplete="billing tel" data-backup="phone" data-phone-formatter="true" data-phone-formatter-country-select="[name='checkout[billing_address][country]']" class="field__input field__input--numeric" size="30" type="tel" name="checkout_billing_phone" id="checkout_billing_address_phone" data-phone-formatter-country-code="93">
    </div>
    <?=$error['billing_phone']['message']?>
</div></div>
        </div>
      </div>
    </div>
  </div>



      </div>

      

<div class="step__footer">
    <input type="hidden" name="checkout[total_price]" id="checkout_total_price" value="1519900">
    <input type="hidden" name="checkout_step3" value="1" />

  <button name="button" type="submit" class="step__footer__continue-btn btn ">
  <span class="btn__content">Завершить заказ</span>
  <i class="btn__spinner icon icon--button-spinner"></i>
</button>
    <a class="step__footer__previous-link" href="/checkout/step2"><svg class="icon-svg icon-svg--color-accent icon-svg--size-10 previous-link__icon rtl-flip" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 10 10"><path d="M8 1L7 0 3 4 2 5l1 1 4 4 1-1-4-4"></path></svg><span class="step__footer__previous-link-content">Вернуться к доставке</span></a>
</div>


<input type="hidden" name="checkout[client_details][browser_width]" value="1519"><input type="hidden" name="checkout[client_details][browser_height]" value="735"><input type="hidden" name="checkout[client_details][javascript_enabled]" value="1"></form>
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
        </div>-->
