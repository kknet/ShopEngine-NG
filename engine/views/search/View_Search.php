<header class="grid medium-up--grid--table section-header small--text-center">
    <div class="grid__item medium-up--two-thirds section-header__item">
      <h1 class="section-header__title">Результаты поиска</h1>
      
      <p class="section-header__subtext"><?=$search_count ? $search_count : "0"?> соответствует <strong><?= Request::GetSession('query')?></strong></p>
      
    </div>
    <div class="grid__item medium-up--one-third section-header__item">
      <form action="/search/" method="get" class="input-group" role="search" style="position: relative;">
        
          <input type="search" name="q" value="<?= Request::GetSession('query')?>" placeholder="Поиск" aria-label="Поиск" class="input-group__field input--content-color" autocomplete="off" data-old-term="Щетка ополаскиватель">

        <div class="input-group__btn">
          <button type="submit" class="btn btn--narrow">
            <svg aria-hidden="true" focusable="false" role="presentation" viewBox="0 0 32 32" class="icon icon-arrow-right"><path fill="#444" d="M7.667 3.795L9.464 2.11 24.334 16 9.464 29.89l-1.797-1.676L20.73 16z"></path></svg>
            <span class="icon__fallback-text">Поиск</span>
          </button>
        </div>
<!--      <ul class="search-results" style="position: absolute; left: 0px; top: 48px; display: block;"><li><a href="/collections/potierpitie-pozhaluista/products/product-1"><span class="thumbnail"><img src="//cdn.shopify.com/s/files/1/1339/0281/products/poterpite-box_thumb.jpg?v=1472714589"></span><span class="title"><strong>Потерпите, пожалуйста!</strong> Набор "Против курения"</span><span class="price">5,000 р.</span></a></li></ul></form>
    </div>-->
  </header>

<div class="grid grid--no-gutters grid--uniform">
    <?php  if($search_products) { 
        foreach ($search_products as $cur) { ?>
        <div class="grid__item small--one-half medium-up--one-fifth">
            <!-- /snippets/product-card.liquid -->
        <a href="/products/<?=$cur['handle']?>" class="product-card">
            <div class="product-card__image-wrapper">
                <?=$cur['image_thumb']?>
            </div>
            <div class="product-card__info">
                <div class="product-card__brand"><?=$cur['brand']?></div>
                <div class="product-card__name"><?=$cur['title']?></div>
                <div class="product-card__price">
                    <?=$cur['price']?>
                    <s class="product-card__regular-price"><?=$cur['old_price']?></s>
                </div>
                <span class="shopify-product-reviews-badge" data-id="7046352451"></span>
            </div>
            <?=$cur['sales']?>
            <div class="product-card__overlay">
                <span class="btn product-card__overlay-btn  btn--narrow">Посмотреть</span>
            </div>
        </a>
    </div>
    <?php } 
    } else { ?>
    <p>Товары не найдены</p>
 <?php    }
    ?>
</div>
<div class="pagination">
    <?= $this->controller->GetPagination()?>
</div>

