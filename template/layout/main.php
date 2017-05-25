<?php
    $nav = Controller::IsActive();
?>
<!DOCTYPE HTML>
<!--[if IE 9]> <html class="ie9 supports-no-js" lang="{{ shop.locale }}"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <html class="supports-no-js" lang="ru"> <!--<![endif]-->
    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <meta name="theme-color" content="#ffffff">
        <meta name="google-site-verification" content="43MkG2mf5P4-hOul0Xph58Y5noiWNgBumJQDU0-PBAc">
        <link rel="shortcut icon" href="/style/assets/favicon.png" type="image/png">
        <link rel="canonical" href="<?= ShopEngine::GetURL()?>">
        <link href="/css/shopengine.all.css" rel="stylesheet" type="text/css" media="all">
        <title><?=$this->controller->title?></title>
        <?=SEO::GetSEO($this->controller)?>
        <script type="text/javascript" src="/js/shopengine.libs.js"></script>
    </head>
    <body id="" class="template-collection">

    <a class="in-page-link visually-hidden skip-link" href="<?=ShopEngine::GetHost()?>/catalog/all">Перейти к содержанию</a>
    <div id="NavDrawer" class="drawer drawer--left">
    <div class="drawer__inner">
    <div style="padding: 11px;">
    <img src="/style/assets/poterpite-logo-mobile.png" alt="Потерпите" style="
        float: left;
        margin-right: 10px;
        width: 60px;
    ">
<p style="
    font-size: 11px;
">Москва, ул. Бутырская, д.77  <br>с 10:00 до 22:00 — ежедневно</p>
<p style="
    font-size: 18px;
">+7 (495) 740 66 09</p>
</div>
        <form action="<?= ShopEngine::GetHost()?>/search/" method="get" class="drawer__search" role="search" style="position: relative;">

            <input type="search" name="q" placeholder="Поиск" aria-label="Поиск" data-csrf="<?=ShopEngine::Help()->generateToken()?>" class="drawer__search-input" autocomplete="off">

        <button type="submit" class="text-link drawer__search-submit">
          <svg aria-hidden="true" focusable="false" role="presentation" viewBox="0 0 32 32" class="icon icon-search"><path fill="#444" d="M21.84 18.77a10.012 10.012 0 0 0 1.57-5.39c0-5.547-4.494-10.047-10.035-10.047-5.548 0-10.04 4.5-10.04 10.048s4.492 10.05 10.033 10.05c2.012 0 3.886-.595 5.456-1.61l.455-.318 7.164 7.165 2.223-2.263-7.158-7.165.33-.47zM18.994 7.768c1.498 1.498 2.322 3.49 2.322 5.608s-.825 4.11-2.322 5.608c-1.498 1.498-3.49 2.322-5.608 2.322s-4.11-.825-5.608-2.322c-1.5-1.498-2.323-3.49-2.323-5.608s.825-4.11 2.322-5.608c1.497-1.498 3.49-2.322 5.607-2.322s4.11.825 5.608 2.322z"></path></svg>
          <span class="icon__fallback-text">Поиск</span>
        </button>
      <ul class="search-results" id="search-results3" style="position: absolute; left: 0px; top: 0px; display: none;"></ul></form>
      <ul class="drawer__nav">



            <li class="drawer__nav-item">
              <div class="drawer__nav-has-sublist">
                  <a href="<?= ShopEngine::GetHost()?>/catalog/all" class="drawer__nav-link" id="DrawerLabel-a-o"> Взрослым</a>
                <div class="drawer__nav-toggle">
                  <button type="button" data-aria-controls="DrawerLinklist-a-o" class="text-link drawer__nav-toggle-btn drawer__meganav-toggle" aria-expanded="false" aria-controls="DrawerLinklist-a-o">
                    <span class="drawer__nav-toggle--open">
                      <svg aria-hidden="true" focusable="false" role="presentation" viewBox="0 0 22 21" class="icon icon-plus"><path d="M12 11.5h9.5v-2H12V0h-2v9.5H.5v2H10V21h2v-9.5z" fill="#000" fill-rule="evenodd"></path></svg>
                      <span class="icon__fallback-text">Расширить меню</span>
                    </span>
                    <span class="drawer__nav-toggle--close">
                      <svg aria-hidden="true" focusable="false" role="presentation" viewBox="0 0 22 3" class="icon icon-minus"><path fill="#000" d="M21.5.5v2H.5v-2z" fill-rule="evenodd"></path></svg>
                      <span class="icon__fallback-text">Свернуть меню</span>
                    </span>
                  </button>
                </div>
              </div>

              <div class="meganav meganav--drawer" id="DrawerLinklist-a-o" aria-labelledby="DrawerLabel-a-o" role="navigation">
                <ul class="meganav__nav">

        <div class="grid grid--no-gutters meganav__scroller meganav__scroller--has-list">
  
        <div class="grid__item meganav__list one-fifth">

        <?php 
            $menu = GetMenu();
            for($i = 0; $i < 7; $i++) { ?>
            <li>
                <a href="<?=ShopEngine::GetHost().'/catalog/'.$menu[$i]['category_handle']?>" class="meganav__link"><?=$menu[$i]['name']?></a>
            </li>    
        <?php   }   ?>

        </div>
        <div class="grid__item meganav__list one-fifth">     
        <?php 
            $menu = GetMenu();
            for($i = 7; $i < count($menu); $i++) { ?>
            <li>
                <a href="<?=ShopEngine::GetHost().'/catalog/'.$menu[$i]['category_handle']?>" class="meganav__link"><?=$menu[$i]['name']?></a>
            </li>    
        <?php   }   ?>
        </div>
        </div>
        </ul>
        </div>
        </li>
            <li class="drawer__nav-item">
                <a href="<?= ShopEngine::GetHost()?>/section/children" class="drawer__nav-link">Детям</a>
            </li>




            <li class="drawer__nav-item">
              <a href="<?= ShopEngine::GetHost()?>/section/dentist" class="drawer__nav-link">Врачам</a>
            </li>




            <li class="drawer__nav-item">
              <a href="http://dental.poterpite.ru/" class="drawer__nav-link">Теории и практики</a>
            </li>




            <li class="drawer__nav-item">
              <a href="http://clinic.poterpite.ru/" class="drawer__nav-link">Стоматологическая клиника</a>
            </li>





            <li class="drawer__nav-item">
                <a href="<?= ShopEngine::GetHost()?>/user/login" class="drawer__nav-link">Аккаунт</a>
                <?php if(Request::GetSession('user_is_logged')) { ?>
                    <a href="/user/logout" id="customer_logout_link">Выйти</a>
                <?php } ?>
            </li>


      </ul>
    </div>
  </div>

  <div id="PageContainer" class="page-container is-moved-by-drawer">
    <header class="site-header" role="banner">
      <div class="site-header__upper page-width">
        <div class="grid grid--table">
          <div class="grid__item small--one-quarter medium-up--hide">
            <button type="button" class="text-link site-header__link js-drawer-open-left" aria-expanded="false">
              <span class="site-header__menu-toggle--open">
                <svg aria-hidden="true" focusable="false" role="presentation" viewBox="0 0 32 32" class="icon icon-hamburger"><path fill="#444" d="M4.89 14.958h22.22v2.222H4.89v-2.222zM4.89 8.292h22.22v2.222H4.89V8.292zM4.89 21.625h22.22v2.222H4.89v-2.222z"></path></svg>
              </span>
              <span class="site-header__menu-toggle--close">
                <svg aria-hidden="true" focusable="false" role="presentation" viewBox="0 0 32 32" class="icon icon-close"><path fill="#444" d="M25.313 8.55L23.45 6.688 16 14.138l-7.45-7.45L6.69 8.55 14.14 16l-7.45 7.45 1.86 1.862 7.45-7.45 7.45 7.45 1.863-1.862-7.45-7.45z"></path></svg>
              </span>
              <span class="icon__fallback-text">Навигация по сайту</span>
            </button>
          </div>
          <div class="grid__item small--one-half medium-up--two-thirds small--text-center">


              <div class="site-header__logo h1" itemscope="" itemtype="http://schema.org/Organization">


                  <a href="<?= ShopEngine::GetHost()?>" itemprop="url" class="site-header__logo-link">
                    <img src="/style/assets/logo.png" alt="<?= Config::$config['site_name']?>" itemprop="logo">
                </a>


              </div>

          </div>
<div class="grid__item small--hide">Магазин-клиника. Ежедневно: с 10:00 до 22:00
<br>Телефон: 8-495-740-66-09              </div>
          <div class="grid__item small--one-quarter medium-up--one-third text-right">
            <div id="SiteNavSearchCart">
              <form action="<?= ShopEngine::GetHost()?>/search/" method="get" class="site-header__search small--hide" role="search" style="position: relative;">

                <div class="site-header__search-inner">
                  <label for="SiteNavSearch" class="visually-hidden">Поиск</label>
                  <input type="search" name="q" id="SiteNavSearch" placeholder="Поиск" aria-label="Поиск" data-csrf="<?=ShopEngine::Help()->generateToken()?>" class="site-header__search-input" autocomplete="off">
                </div>

                <button type="submit" class="text-link site-header__link site-header__search-submit">
                  <svg aria-hidden="true" focusable="false" role="presentation" viewBox="0 0 32 32" class="icon icon-search"><path fill="#444" d="M21.84 18.77a10.012 10.012 0 0 0 1.57-5.39c0-5.547-4.494-10.047-10.035-10.047-5.548 0-10.04 4.5-10.04 10.048s4.492 10.05 10.033 10.05c2.012 0 3.886-.595 5.456-1.61l.455-.318 7.164 7.165 2.223-2.263-7.158-7.165.33-.47zM18.994 7.768c1.498 1.498 2.322 3.49 2.322 5.608s-.825 4.11-2.322 5.608c-1.498 1.498-3.49 2.322-5.608 2.322s-4.11-.825-5.608-2.322c-1.5-1.498-2.323-3.49-2.323-5.608s.825-4.11 2.322-5.608c1.497-1.498 3.49-2.322 5.607-2.322s4.11.825 5.608 2.322z"></path></svg>
                  <span class="icon__fallback-text">Поиск</span>
                </button>
              <ul class="search-results" id="search-results1" style="position: absolute; left: -210px; top: 34px; display: none;"></ul></form>

              <a href="/cart" class="site-header__link site-header__cart" id="cartIndicatorAjax" data-csrf="<?=ShopEngine::Help()->generateToken()?>">
                <svg aria-hidden="true" focusable="false" role="presentation" viewBox="0 0 31 32" class="icon icon-cart"><path d="M14.568 25.63c-1.222 0-2.11.888-2.11 2.11 0 1.11 1 2.11 2.11 2.11 1.222 0 2.11-.888 2.11-2.11s-.888-2.11-2.11-2.11zm10.22 0c-1.222 0-2.11.888-2.11 2.11 0 1.11 1 2.11 2.11 2.11 1.222 0 2.11-.888 2.11-2.11s-.888-2.11-2.11-2.11zm2.555-3.778H12.457L7.347 7.078c-.222-.333-.555-.667-1-.667H1.792c-.667 0-1.11.445-1.11 1s.443 1 1.11 1H5.57l5.11 14.886c.11.444.554.666 1 .666H27.34c.555 0 1.11-.444 1.11-1 0-.666-.554-1.11-1.11-1.11zm2.333-11.442l-18.44-1.555h-.11c-.556 0-.778.333-.668.89l3.222 9.22c.222.554.89 1 1.444 1h13.44c.556 0 1.112-.445 1.223-1l.778-7.444c.11-.554-.333-1.11-.89-1.11zm-2 7.443H15.568l-2.333-6.776L28.343 12.3l-.666 5.553z"></path></svg>
                <span class="icon__fallback-text">Корзина</span>
                <span class="site-header__cart-indicator hide"></span>
              </a>
            </div>
          </div>
        </div>
      </div>

      <div id="StickNavWrapper" style="height: 59.4px;">
        <div id="StickyBar" class="sticky">
          <nav class="nav-bar small--hide" role="navigation" id="StickyNav">
            <div class="page-width">
              <div class="grid grid--table">
                <div class="grid__item four-fifths" id="SiteNavParent">
                  <button type="button" class="hide text-link site-nav__link site-nav__link--compressed js-drawer-open-left" id="SiteNavCompressed" aria-expanded="false">
                    <svg aria-hidden="true" focusable="false" role="presentation" viewBox="0 0 32 32" class="icon icon-hamburger"><path fill="#444" d="M4.89 14.958h22.22v2.222H4.89v-2.222zM4.89 8.292h22.22v2.222H4.89V8.292zM4.89 21.625h22.22v2.222H4.89v-2.222z"></path></svg>
                    <span class="site-nav__link-menu-label">Меню</span>
                    <span class="icon__fallback-text">Навигация по сайту</span>
                  </button>
                  <ul class="site-nav list--inline" id="SiteNav">

                        <li class="site-nav__item <?= $nav['catalog']?>" aria-haspopup="true">
                            <a href="<?= ShopEngine::GetHost().'/catalog/all'?>" class="site-nav__link site-nav__meganav-toggle" id="SiteNavLabel-a-o" data-aria-controls="SiteNavLinklist-a-o" aria-expanded="false" aria-controls="SiteNavLinklist-a-o"> Взрослым
                            <svg aria-hidden="true" focusable="false" role="presentation" viewBox="0 0 32 32" class="icon icon-arrow-down"><path fill="#444" d="M26.984 8.5l1.516 1.617L16 23.5 3.5 10.117 5.008 8.5 16 20.258z"></path></svg>
                          </a>

                          <div class="site-nav__dropdown meganav" id="SiteNavLinklist-a-o" aria-labelledby="SiteNavLabel-a-o" role="navigation">
                            <ul class="meganav__nav page-width">
<div class="grid grid--no-gutters meganav__scroller--has-list">

    <div class="grid__item meganav__list one-fifth meganav__list--has-title">


        <h5 class="h1 meganav__title"> Взрослым</h5>
        <?php 
            $menu = GetMenu();
            for($i = 0; $i < 6; $i++) { ?>
            <li>
                <a href="<?=ShopEngine::GetHost().'/catalog/'.$menu[$i]['category_handle']?>" class="meganav__link"><?=$menu[$i]['name']?></a>
            </li>    
        <?php   }   ?>
              </div>
              <div class="grid__item meganav__list one-fifth meganav__list--has-title">
        <?php 
            $menu = GetMenu();
            for($i = 6; $i < count($menu); $i++) { ?>
            <li>
                <a href="<?=ShopEngine::GetHost().'/catalog/'.$menu[$i]['category_handle']?>" class="meganav__link"><?=$menu[$i]['name']?></a>
            </li>    
        <?php   }   ?>
            <li>
                <a href="<?=ShopEngine::GetHost().'/catalog/all'?>" class="meganav__link">Всё</a>
            </li> 
    </div>
  
<?php 
    $products = GetMenuProducts();
    
    foreach ($products as $cur) { ?>
        <div class="grid__item one-fifth meganav__product">
        <!-- /snippets/product-card.liquid -->

<a href="/products/<?=$cur['handle']?>" class="product-card">
  <div class="product-card__image-wrapper">
      <?= $cur['image'] ?>
  </div>
  <div class="product-card__info">

      <div class="product-card__brand"><?=$cur['brand']?></div>


    <div class="product-card__name"><?=$cur['title']?></div>

      <div class="product-card__price">



            <span class="visually-hidden">Цена со скидкой</span>
                <?=$cur['price']?>
            <span class="visually-hidden">Обычная цена</span>
            <s class="product-card__regular-price"><?=$cur['old_price']?></s>



      </div>

    	<span class="spr-badge" id="spr_badge_9249056259" data-rating="0.0"><span class="spr-starrating spr-badge-starrating"><i class="spr-icon spr-icon-star-empty" style="color: #46b000;"></i><i class="spr-icon spr-icon-star-empty" style="color: #46b000;"></i><i class="spr-icon spr-icon-star-empty" style="color: #46b000;"></i><i class="spr-icon spr-icon-star-empty" style="color: #46b000;"></i><i class="spr-icon spr-icon-star-empty" style="color: #46b000;"></i></span><span class="spr-badge-caption"></span>
</span>


  </div>



    <div class="product-tag product-tag--absolute" aria-hidden="true">
      %
    </div>

  <div class="product-card__overlay">

    <span class="btn product-card__overlay-btn  btn--narrow">Посмотреть</span>
  </div>
</a>

</div>
<?php   }
?>
    
</div>

                            </ul>
                          </div>
                        </li>
                        <li class="site-nav__item <?= $nav['children']?>">
                            <a href="<?= ShopEngine::GetHost()?>/section/children" class="site-nav__link">Детям</a>
                        </li>
                        <li class="site-nav__item <?= $nav['dentist']?>">
                          <a href="<?= ShopEngine::GetHost()?>/section/dentist" class="site-nav__link">Врачам</a>
                        </li>

                        <li class="site-nav__item">
                          <a href="http://dental.poterpite.ru/" class="site-nav__link">Теории и практики</a>
                        </li>

                        <li class="site-nav__item">
                          <a href="http://clinic.poterpite.ru/" class="site-nav__link">Стоматологическая клиника</a>
                        </li>
                  </ul>
                </div>
                <div class="grid__item one-fifth text-right">
                  <div class="sticky-only" id="StickyNavSearchCart">
              <form action="/search/" method="get" class="site-header__search small--hide" role="search" style="position: relative;">

                <div class="site-header__search-inner">
                  <label for="SiteNavSearch" class="visually-hidden">Поиск</label>
                  <input type="search" name="q" id="SiteNavSearch" placeholder="Поиск" aria-label="Поиск" data-csrf="<?=ShopEngine::Help()->generateToken()?>" class="site-header__search-input" autocomplete="off">
                </div>

                <button type="submit" class="text-link site-header__link site-header__search-submit">
                  <svg aria-hidden="true" focusable="false" role="presentation" viewBox="0 0 32 32" class="icon icon-search"><path fill="#444" d="M21.84 18.77a10.012 10.012 0 0 0 1.57-5.39c0-5.547-4.494-10.047-10.035-10.047-5.548 0-10.04 4.5-10.04 10.048s4.492 10.05 10.033 10.05c2.012 0 3.886-.595 5.456-1.61l.455-.318 7.164 7.165 2.223-2.263-7.158-7.165.33-.47zM18.994 7.768c1.498 1.498 2.322 3.49 2.322 5.608s-.825 4.11-2.322 5.608c-1.498 1.498-3.49 2.322-5.608 2.322s-4.11-.825-5.608-2.322c-1.5-1.498-2.323-3.49-2.323-5.608s.825-4.11 2.322-5.608c1.497-1.498 3.49-2.322 5.607-2.322s4.11.825 5.608 2.322z"></path></svg>
                  <span class="icon__fallback-text">Поиск</span>
                </button>
              <ul class="search-results" id="search-results2" style="position: absolute; left: -210px; top: 0px; display: none;"></ul>
              </form>

              <a href="<?=ShopEngine::GetHost()?>/cart" id="cartIndicatorAjax2" class="site-header__link site-header__cart">
                <svg aria-hidden="true" focusable="false" role="presentation" viewBox="0 0 31 32" class="icon icon-cart"><path d="M14.568 25.63c-1.222 0-2.11.888-2.11 2.11 0 1.11 1 2.11 2.11 2.11 1.222 0 2.11-.888 2.11-2.11s-.888-2.11-2.11-2.11zm10.22 0c-1.222 0-2.11.888-2.11 2.11 0 1.11 1 2.11 2.11 2.11 1.222 0 2.11-.888 2.11-2.11s-.888-2.11-2.11-2.11zm2.555-3.778H12.457L7.347 7.078c-.222-.333-.555-.667-1-.667H1.792c-.667 0-1.11.445-1.11 1s.443 1 1.11 1H5.57l5.11 14.886c.11.444.554.666 1 .666H27.34c.555 0 1.11-.444 1.11-1 0-.666-.554-1.11-1.11-1.11zm2.333-11.442l-18.44-1.555h-.11c-.556 0-.778.333-.668.89l3.222 9.22c.222.554.89 1 1.444 1h13.44c.556 0 1.112-.445 1.223-1l.778-7.444c.11-.554-.333-1.11-.89-1.11zm-2 7.443H15.568l-2.333-6.776L28.343 12.3l-.666 5.553z"></path></svg>
                <span class="icon__fallback-text">Корзина</span>
                <span class="site-header__cart-indicator sticky_indicator hide"></span>
              </a>
                </div>

                    <div class="customer-login-links sticky-hidden">

                        <a href="<?= ShopEngine::GetHost()?>/user/login" id="customer_login_link">Аккаунт</a>
                        <?php if(Request::GetSession('user_is_logged')) { ?>
                            <a href="/user/logout" id="customer_logout_link">Выйти</a>
                        <?php } ?>
                    </div>

                </div>
              </div>
            </div>
          </nav>
          <div id="NotificationSuccess" class="notification notification--success" aria-hidden="true">
            <div class="page-width notification__inner notification__inner--has-link">
              <a href="/cart" class="notification__link">
                <span class="notification__message">Товар добавлен в корзину. <span> Посмотреть корзину и оформить </span>.</span>
              </a>
              <button type="button" class="text-link notification__close">
                <svg aria-hidden="true" focusable="false" role="presentation" viewBox="0 0 32 32" class="icon icon-close"><path fill="#444" d="M25.313 8.55L23.45 6.688 16 14.138l-7.45-7.45L6.69 8.55 14.14 16l-7.45 7.45 1.86 1.862 7.45-7.45 7.45 7.45 1.863-1.862-7.45-7.45z"></path></svg>
                <span class="icon__fallback-text">Закрыть</span>
              </button>
            </div>
          </div>
          <div id="NotificationError" class="notification notification--error" aria-hidden="true">
            <div class="page-width notification__inner">
              <span class="notification__message notification__message--error" aria-live="assertive" aria-atomic="true"></span>
              <button type="button" class="text-link notification__close">
                <svg aria-hidden="true" focusable="false" role="presentation" viewBox="0 0 32 32" class="icon icon-close"><path fill="#444" d="M25.313 8.55L23.45 6.688 16 14.138l-7.45-7.45L6.69 8.55 14.14 16l-7.45 7.45 1.86 1.862 7.45-7.45 7.45 7.45 1.863-1.862-7.45-7.45z"></path></svg>
                <span class="icon__fallback-text">Закрыть</span>
              </button>
            </div>
          </div>
        </div>
      </div>
    </header>

<!-- START CONTENT -->
<main class="<?= ShopEngine::GetController() === 'Controller_Main' ? 'no_margin_top' : '' ?> main-content " id="MainContent" role="main">
    <!-- Temporary -->
    <?php if(ShopEngine::GetController() === 'Controller_Main') { ?>
        <div class="hero-wrapper">
            <div class="owl-carousel">
                <div class="slider_item">
                    <div id="img_slider2" class="img_slider"></div>
                    <div class="hero__text-wrap">
                <div class="page-width">
                    <div class="hero__text-content">
                      <div class="hero__title-wrap">
                        <h1 class="hero__title hero__title--has-link">
                            <a href="<?=ShopEngine::GetHost()?>/products/zoom-4-whitespeed" class="hero__link" tabindex="-1">
                              Несомненно лучшие!     
                            </a>
                        </h1>
                        </div>
                        <a href="<?=ShopEngine::GetHost()?>/products/zoom-4-whitespeed" class="hero__subtitle hero__link" tabindex="-1">
                            Лучший результат - в простоте
                        </a>
                    </div>
                </div>
                </div>
                </div>
                <div class="slider_item">
                <div id="img_slider1" class="img_slider"></div>
                <div class="hero__text-wrap">
                <div class="page-width">
                    <div class="hero__text-content">
                      <div class="hero__title-wrap">
                        <h1 class="hero__title hero__title--has-link">
                            <a href="<?=ShopEngine::GetHost()?>/products/zoom-4-whitespeed" class="hero__link" tabindex="-1">
                              Новинка!       
                            </a>
                        </h1>
                        </div>
                        <a href="<?=ShopEngine::GetHost()?>/products/zoom-4-whitespeed" class="hero__subtitle hero__link" tabindex="-1">
                            Отбеливание Philips Zoom WhiteSpeed (Zoom 4) у нас в клинике!
                        </a>
                    </div>
                </div>
                </div>
                </div>
            </div>
        </div>
    <?php } ?>
    <div class="page-width">
        <?php require_once $view_path ?>
    </div>
</main>
<!-- END CONTENT -->


    <footer class="site-footer" role="contentinfo">
      <div class="page-width">
        <div class="grid grid--rev">

          <div class="grid__item large-up--two-fifths site-footer__section">

              <h4 class="site-footer__section-title h1">Прайс-лист для оптовых закупок</h4>


                <form action="https://poterpite.us14.list-manage.com/subscribe/post?u=f315896e0ea72e4de5e198061&amp;id=5a1e5bbaf3" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" target="_blank" class="form-vertical">
                  <label for="NewsletterEmail" class="site-footer__newsletter-label">Для регулярных закупок вы можете получать наш прайс-лист</label>
                  <div class="input-group">
                    <input type="email" value="" placeholder="Ваш email" name="EMAIL" id="NewsletterEmail" class="input-group__field site-footer__newsletter-input" autocorrect="off" autocapitalize="off">
                    <div class="input-group__btn">
                      <button type="submit" class="btn btn--narrow" name="subscribe" id="Subscribe">
                        <svg aria-hidden="true" focusable="false" role="presentation" viewBox="0 0 32 32" class="icon icon-arrow-right"><path fill="#444" d="M7.667 3.795L9.464 2.11 24.334 16 9.464 29.89l-1.797-1.676L20.73 16z"></path></svg>
                        <span class="icon__fallback-text">Подписаться</span>
                      </button>
                    </div>
                  </div>
                </form>




            <div class="site-footer__subsection">
              <ul class="list--inline social-icons">

                  <li>
                    <a href="https://www.facebook.com/poterpite" title="Потерпите, пожалуйста! на Facebook">
                      <svg aria-hidden="true" focusable="false" role="presentation" viewBox="0 0 32 32" class="icon icon-facebook"><path fill="#444" d="M18.222 11.556V8.91c0-1.194.264-1.8 2.118-1.8h2.326V2.668h-3.882c-4.757 0-6.326 2.18-6.326 5.924v2.966H9.333V16h3.125v13.333h5.764V16h3.917l.527-4.444h-4.444z"></path></svg>
                      <span class="icon__fallback-text">Facebook</span>
                    </a>
                  </li>


                  <li>
                    <a href="https://twitter.com/poterpite" title="Потерпите, пожалуйста! на Twitter">
                      <svg aria-hidden="true" focusable="false" role="presentation" viewBox="0 0 32 32" class="icon icon-twitter"><path fill="#444" d="M30.75 6.844c-1.087.48-2.25.806-3.475.956a6.08 6.08 0 0 0 2.663-3.35 12.02 12.02 0 0 1-3.844 1.47A6.044 6.044 0 0 0 21.674 4a6.052 6.052 0 0 0-6.05 6.056c0 .475.05.938.157 1.38a17.147 17.147 0 0 1-12.474-6.33 6.068 6.068 0 0 0 1.88 8.088 5.91 5.91 0 0 1-2.75-.756v.075a6.056 6.056 0 0 0 4.857 5.937 6.113 6.113 0 0 1-1.594.212c-.39 0-.77-.038-1.14-.113a6.06 6.06 0 0 0 5.657 4.205 12.132 12.132 0 0 1-8.963 2.507A16.91 16.91 0 0 0 10.516 28c11.144 0 17.23-9.23 17.23-17.238 0-.262-.005-.525-.018-.78a12.325 12.325 0 0 0 3.02-3.14z"></path></svg>
                      <span class="icon__fallback-text">Twitter</span>
                    </a>
                  </li>



                  <li>
                    <a href="https://www.instagram.com/poterpite/" title="Потерпите, пожалуйста! на Instagram">
                      <svg aria-hidden="true" focusable="false" role="presentation" viewBox="0 0 512 512" class="icon icon-instagram"><path d="M256 49.5c67.3 0 75.2.3 101.8 1.5 24.6 1.1 37.9 5.2 46.8 8.7 11.8 4.6 20.2 10 29 18.8s14.3 17.2 18.8 29c3.4 8.9 7.6 22.2 8.7 46.8 1.2 26.6 1.5 34.5 1.5 101.8s-.3 75.2-1.5 101.8c-1.1 24.6-5.2 37.9-8.7 46.8-4.6 11.8-10 20.2-18.8 29s-17.2 14.3-29 18.8c-8.9 3.4-22.2 7.6-46.8 8.7-26.6 1.2-34.5 1.5-101.8 1.5s-75.2-.3-101.8-1.5c-24.6-1.1-37.9-5.2-46.8-8.7-11.8-4.6-20.2-10-29-18.8s-14.3-17.2-18.8-29c-3.4-8.9-7.6-22.2-8.7-46.8-1.2-26.6-1.5-34.5-1.5-101.8s.3-75.2 1.5-101.8c1.1-24.6 5.2-37.9 8.7-46.8 4.6-11.8 10-20.2 18.8-29s17.2-14.3 29-18.8c8.9-3.4 22.2-7.6 46.8-8.7 26.6-1.3 34.5-1.5 101.8-1.5m0-45.4c-68.4 0-77 .3-103.9 1.5C125.3 6.8 107 11.1 91 17.3c-16.6 6.4-30.6 15.1-44.6 29.1-14 14-22.6 28.1-29.1 44.6-6.2 16-10.5 34.3-11.7 61.2C4.4 179 4.1 187.6 4.1 256s.3 77 1.5 103.9c1.2 26.8 5.5 45.1 11.7 61.2 6.4 16.6 15.1 30.6 29.1 44.6 14 14 28.1 22.6 44.6 29.1 16 6.2 34.3 10.5 61.2 11.7 26.9 1.2 35.4 1.5 103.9 1.5s77-.3 103.9-1.5c26.8-1.2 45.1-5.5 61.2-11.7 16.6-6.4 30.6-15.1 44.6-29.1 14-14 22.6-28.1 29.1-44.6 6.2-16 10.5-34.3 11.7-61.2 1.2-26.9 1.5-35.4 1.5-103.9s-.3-77-1.5-103.9c-1.2-26.8-5.5-45.1-11.7-61.2-6.4-16.6-15.1-30.6-29.1-44.6-14-14-28.1-22.6-44.6-29.1-16-6.2-34.3-10.5-61.2-11.7-27-1.1-35.6-1.4-104-1.4z"></path><path d="M256 126.6c-71.4 0-129.4 57.9-129.4 129.4s58 129.4 129.4 129.4 129.4-58 129.4-129.4-58-129.4-129.4-129.4zm0 213.4c-46.4 0-84-37.6-84-84s37.6-84 84-84 84 37.6 84 84-37.6 84-84 84z"></path><circle cx="390.5" cy="121.5" r="30.2"></circle></svg>
                      <span class="icon__fallback-text">Instagram</span>
                    </a>
                  </li>





                  <li>
                    <a href="https://vk.com/poterpite" title="Потерпите, пожалуйста! на Vimeo">
                      <svg aria-hidden="true" focusable="false" role="presentation" viewBox="0 0 32 32" class="icon icon-vimeo"><path fill="#444" d="M.343 10.902l1.438 1.926q2-1.487 2.414-1.487 1.584 0 2.95 5.047.365 1.39 1.193 4.52t1.292 4.815q1.803 5.046 4.533 5.046 4.34 0 10.53-8.336 6.07-7.922 6.288-12.528v-.536q0-5.606-4.484-5.752h-.34q-6.02 0-8.288 7.385 1.316-.56 2.29-.56 2.073 0 2.073 2.145 0 .268-.023.56-.146 1.732-2.047 4.73-1.95 3.144-2.9 3.144-1.268 0-2.243-4.778-.293-1.12-1.243-7.24-.414-2.63-1.536-3.9-.975-1.096-2.437-1.12-.194 0-.413.024Q7.85 4.152 4.83 6.81 3.27 8.27.343 10.903z"></path></svg>
                      <span class="icon__fallback-text">Vimeo</span>
                    </a>
                  </li>


              </ul>
            </div>
          </div>

          <div class="grid__item large-up--three-fifths site-footer__section">
            <div class="grid">



                <div class="grid__item medium-up--one-third site-footer__subsection">
                  <h4 class="h1 site-footer__section-title">Как купить?</h4>
                  <ul class="site-footer__list">

                      <li class="site-footer__list-item"><a href="<?= ShopEngine::GetHost()?>/pages/pickup">Самовывоз</a></li>

                      <li class="site-footer__list-item"><a href="<?= ShopEngine::GetHost()?>/pages/delivery">Доставка</a></li>

                      <li class="site-footer__list-item"><a href="<?= ShopEngine::GetHost()?>/pages/payment">Оплата</a></li>

                      <li class="site-footer__list-item"><a href="<?= ShopEngine::GetHost()?>/pages/garanty">Гарантия</a></li>

                      <li class="site-footer__list-item"><a href="<?= ShopEngine::GetHost()?>/pages/contact">Контакты</a></li>

                  </ul>
                </div>



                <div class="grid__item medium-up--one-third site-footer__subsection">
                  <h4 class="h1 site-footer__section-title">Контакты</h4>
                  <ul class="site-footer__list">

                      <li class="site-footer__list-item"><a href="http://help.poterpite.ru/">Поддержка</a></li>

                      <li class="site-footer__list-item"><a href="<?= ShopEngine::GetHost()?>/pages/about">О компании</a></li>

                      <li class="site-footer__list-item"><a href="<?= ShopEngine::GetHost()?>/pages/review">Отзывы</a></li>

                  </ul>
                </div>

            </div>
          </div>
        </div>
      </div>
      <div class="site-footer__copyright">
        <div class="page-width">
          <div class="grid medium-up--grid--table">
            <div class="grid__item medium-up--one-half">
                <small>© 2017, <a href="<?= ShopEngine::GetHost()?>" title="">Потерпите, пожалуйста!</a>. При поддержке Infinite ShopEngine</small>
            </div>
            <div class="grid__item medium-up--one-half medium-up--text-right">

            </div>
          </div>
        </div>
      </div>
    </footer>
  </div>

<!-- Some styles to get you started. -->

<!--<script type="text/javascript">
    $('body').on('click', '.filter-menu .mobile-header a', function(e){
        if(e.handled !== true) {
          $('.filter-menu .filter-group').not('.has_group_selected').find('h4, ul,.filter-clear').toggle('fast');
          e.preventDefault();
          e.handled = true;
        }
    });

    var windowWidth = $(window).width();
    $(window).resize(function() {
      if ($(window).width() != windowWidth) {
      windowWidth = $(window).width();

          if ($( window ).width() > 767) {
            $('.filter-menu .filter-group').find('h4, ul, .filter-clear').show();
          } /* else {
            $('.filter-menu .filter-group').not('.has_group_selected').find('h4, ul, .filter-clear').hide();
          } */
      }
    });

     $('body').on('click', '#nav-toggle', function() { $(this).find('#nav-toggle').toggleClass('active'); } );
</script>-->


<!--<script>
  $(document).ready(function() {
    var page = location.href;
    if(page == "https://poterpite.ru/")
      $(".einstein_helper").remove();
  });
</script>-->

<link rel="stylesheet" type="test/css" href="/style/assets/font-awesome.min.css">
<link rel="stylesheet" href="/plugins/owlcarousel/assets/owl.carousel.min.css">
<link rel="stylesheet" href="/plugins/owlcarousel/assets/owl.theme.default.min.css">

<script src="/js/shopengine.all.js" type="text/javascript"></script>
<script src="/plugins/owlcarousel/owl.carousel.min.js"></script>

<script type="text/javascript">
    $(".owl-carousel").owlCarousel({
        items : 1,
        autoHeight : true,
        center: true,
        loop: true,
        autoplay : true, 
        autoplayTimeout : 8000,
        autoplaySpeed : 750
    });
</script>

</body></html>
