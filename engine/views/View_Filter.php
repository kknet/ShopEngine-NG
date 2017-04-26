<header class="grid medium-up--grid--table section-header small--text-center">
    <div class="grid__item medium-up--one-half section-header__item">
      <h1 class="section-header__title">
        Каталог товаров
      </h1>
        <!---->
      
      
        <div class="section-header__subtext rte">
          <p>Если Вы не нашли товар на сайте, Вы можете посмотреть полный список <a href="https://docs.google.com/spreadsheets/d/14GKCiq4wVA5IK1V81vrkNEcOVS-WzaZmNzspoQb2LTc/edit#gid=0">тут</a></p>
<p>А менеджер поможет и подскажет, если вы позвоните по телефону: <span> 8-495-740-66-09</span></p>
        </div>
      
    </div>
    <div class="grid__item medium-up--one-half medium-up--text-right section-header__item">

      
        <button class="btn" value="Фильтр товаров" id="show_filter" >Фильтр товаров</button>
<!--        <div class="collection-sort">
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
        </div>-->
      
    </div>
    <!---->
</header>
<div class="filter_contailer">
    <form action="/filter/" method="get" >
        <div class="filter_flex">
            <div class="filter_item_block">
                <label for="filter_category">Категория</label>
                <select name="filter_category" id="filter_category">
                    <option value="1">Зубные щётки</option>
                    <option value="2">Ёршики</option>
                    <option value="3">Нити</option>
                </select>
            </div>
            <div class="filter_item_block">
                <label for="filter_brand">Производитель</label>
                <select name="filter_brand" id="filter_brand">
                    <option value="cuparox">Cuparox</option>
                </select>
            </div>
            <div class="filter_item_block">
                <label>Ключевые слова</label>
                <input name="filter_keys" type="text" placeholder="Слова через запятую"/>
            </div>
        </div>
        
        <div class="filter_flex">
            <div class="filter_item_block">
                <label for="filter_price">Стоимость</label>
                <input type="text" name="filter_price" id="filte_price" placeholder="Цена до, &#8381;" >
<!--                <div id="filter_slider"></div>
                <script>
                    $("#filter_slider").rangeSlider();
                </script>-->
            </div>
            <div class="filter_item_block">
                <label for="filter_brand">Сортировать по</label>
                <select name="filter_brand" id="filter_brand">
                    <option value="cuparox">Стоимость (по возрастанию)</option>
                    <option value="cuparox">Стоимость (по убыванию)</option>
                    <option value="cuparox">Просмотры (по возрастанию)</option>
                    <option value="cuparox">Просмотры (по убыванию)</option>
                </select>
            </div>
            <div class="filter_item_block">
                
            </div>
        </div>
        <div class="filter_footer">
            <input type="submit" name="filter_submit" class="btn" value="Поиск" />
        </div>
        
    </form>
</div>
<div class="grid grid--no-gutters grid--uniform">
    <?php $array = $start['products'];
    if($array) { 
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
    <?php } 
    } else { ?>
    <p>По данному запросу товары не найдены</p>
    <?php } ?>
</div>
<div class="pagination">
    <?= GetPagination()?>
</div>

