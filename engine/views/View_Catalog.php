<header class="grid medium-up--grid--table section-header small--text-center">
    <div class="grid__item medium-up--one-half section-header__item">
      <h1 class="section-header__title">
        <?= ShopEngine::GetController()::GetCategoryName() ?>
      </h1>
        <!---->
      
      
        <div class="section-header__subtext rte">
          <p>Если Вы не нашли товар на сайте, Вы можете посмотреть полный список <a href="https://docs.google.com/spreadsheets/d/14GKCiq4wVA5IK1V81vrkNEcOVS-WzaZmNzspoQb2LTc/edit#gid=0">тут</a></p>
<p>А менеджер поможет и подскажет, если вы позвоните по телефону: <span> 8-495-740-66-09</span></p>
        </div>
      
    </div>
    <div class="grid__item medium-up--one-half medium-up--text-right section-header__item">

      
      
        <div class="collection-sort">
          <label for="SortBy" class="collection-sort__label">Сортировать</label>
          <select name="SortBy" id="SortBy" data-default-sort="title-ascending" class="collection-sort__input">
            <option value="manual">Рекомендуем</option>
            <option value="best-selling">Лидеры продаж</option>
            <option value="title-ascending">Алфавитный порядок ↓</option>
            <option value="title-descending">Алфавитный порядок ↑</option>
            <option value="price-ascending">Цена по возрастанию</option>
            <option value="price-descending">Цена по убыванию</option>
            <option value="created-descending">Дата добавления ↓</option>
            <option value="created-ascending">Дата добавления ↑</option>
          </select>
        </div>
      
    </div>
    <!---->
</header>
<div class="grid grid--no-gutters grid--uniform">
    <?php $array = GetProducts();
        foreach ($array as $cur) { ?>
        <div class="grid__item small--one-half medium-up--one-fifth">
            <!-- /snippets/product-card.liquid -->
        <a href="/products/<?=$cur['handle']?>" class="product-card">
            <div class="product-card__image-wrapper">
                <?=$cur['image']?>
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
    <?php } ?>
</div>
<div class="pagination">
    <?= GetPagination()?>
</div>

