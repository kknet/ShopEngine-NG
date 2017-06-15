<div class="medium-up--hide">
  <ul class="drawer__nav drawer__nav--template-index">

        <li class="drawer__nav-item">
          <div class="drawer__nav-has-sublist">
            <a href="/catalog/all" class="drawer__nav-link" id="DrawerLabel-a-o"> Каталог</a>
              <div class="drawer__nav-toggle">
                <button type="button" data-aria-controls="IndexLinklist-a-o" class="text-link drawer__nav-toggle-btn index__meganav-toggle meganav--active" aria-expanded="false" aria-controls="IndexLinklist-a-o">
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

          <div class="meganav meganav--index  meganav--active" id="IndexLinklist-a-o" aria-labelledby="DrawerLabel-a-o" role="navigation">
            <ul class="meganav__nav">
              
















<div class="grid grid--no-gutters meganav__scroller meganav__scroller--has-list">
 
     <div class="grid__item meganav__list one-fifth">

        <?php 
            $menu = $this->widgets->WidgetMenu->GetMenu();
            for($i = 0; $i < 7; $i++) { ?>
            <li>
                <a href="<?=ShopEngine::GetHost().'/catalog/'.$menu[$i]['category_handle']?>" class="meganav__link"><?=$menu[$i]['name']?></a>
            </li>    
        <?php   }   ?>

        </div>
        <div class="grid__item meganav__list one-fifth">     
        <?php 
            for($i = 7; $i < count($menu); $i++) { ?>
            <li>
                <a href="<?=ShopEngine::GetHost().'/catalog/'.$menu[$i]['category_handle']?>" class="meganav__link"><?=$menu[$i]['name']?></a>
            </li>    
        <?php   }   ?>
        </div>
  

<!--      <div class="grid__item one-fifth meganav__product">
         /snippets/product-card.liquid 



<a href="/products/1560-soft" class="product-card">
  <div class="product-card__image-wrapper">
    <img src="//cdn.shopify.com/s/files/1/1339/0281/products/uraprox1560-poterpite_large.jpg?v=1477553374" alt="1560 Soft Зубная щётка мягкая (Soft) - Потерпите, пожалуйста!" class="product-card__image">
  </div>
  <div class="product-card__info">
    
      <div class="product-card__brand">Curaprox</div>
    

    <div class="product-card__name">1560 Soft Зубная щётка мягкая (Soft)</div>
    
      <div class="product-card__price">
        
          
          
            649 р.
          

        
      </div>
    
    	<span class="spr-badge" id="spr_badge_7046352451" data-rating="0.0"><span class="spr-starrating spr-badge-starrating"><i class="spr-icon spr-icon-star-empty" style="color: #46b000;"></i><i class="spr-icon spr-icon-star-empty" style="color: #46b000;"></i><i class="spr-icon spr-icon-star-empty" style="color: #46b000;"></i><i class="spr-icon spr-icon-star-empty" style="color: #46b000;"></i><i class="spr-icon spr-icon-star-empty" style="color: #46b000;"></i></span><span class="spr-badge-caption"></span>
</span>

    
  </div>

  
  <div class="product-card__overlay">
    
    <span class="btn product-card__overlay-btn  btn--narrow">Посмотреть</span>
  </div>
</a>

      </div>
    
      <div class="grid__item one-fifth meganav__product">
         /snippets/product-card.liquid 



<a href="/products/6-professional" class="product-card">
  <div class="product-card__image-wrapper">
    <img src="//cdn.shopify.com/s/files/1/1339/0281/products/386655477_large.jpg?v=1483612935" alt="6 Professional" class="product-card__image">
  </div>
  <div class="product-card__info">
    
      <div class="product-card__brand">Emmi-Dent</div>
    

    <div class="product-card__name">6 Professional</div>
    
      <div class="product-card__price">
        
          
          
        	<span class="visually-hidden">Цена со скидкой</span>
            13,399 р.
        
            <span class="visually-hidden">Обычная цена</span>
            <s class="product-card__regular-price">13,699 р.</s>
          

        
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
    
      <div class="grid__item one-fifth meganav__product">
         /snippets/product-card.liquid 



<a href="/products/6-metallik" class="product-card">
  <div class="product-card__image-wrapper">
    <img src="//cdn.shopify.com/s/files/1/1339/0281/products/371437955_large.jpg?v=1483626394" alt="6 Металлик" class="product-card__image">
  </div>
  <div class="product-card__info">
    
      <div class="product-card__brand">Emmi-Dent</div>
    

    <div class="product-card__name">6 Металлик</div>
    
      <div class="product-card__price">
        
          
          
        	<span class="visually-hidden">Цена со скидкой</span>
            13,399 р.
        
            <span class="visually-hidden">Обычная цена</span>
            <s class="product-card__regular-price">13,699 р.</s>
          

        
      </div>
    
    	<span class="spr-badge" id="spr_badge_9249004611" data-rating="0.0"><span class="spr-starrating spr-badge-starrating"><i class="spr-icon spr-icon-star-empty" style="color: #46b000;"></i><i class="spr-icon spr-icon-star-empty" style="color: #46b000;"></i><i class="spr-icon spr-icon-star-empty" style="color: #46b000;"></i><i class="spr-icon spr-icon-star-empty" style="color: #46b000;"></i><i class="spr-icon spr-icon-star-empty" style="color: #46b000;"></i></span><span class="spr-badge-caption"></span>
</span>

    
  </div>

  
    
    <div class="product-tag product-tag--absolute" aria-hidden="true">
      %
    </div>
  
  <div class="product-card__overlay">
    
    <span class="btn product-card__overlay-btn  btn--narrow">Посмотреть</span>
  </div>
</a>

      </div>-->
    
  
</div>

            </ul>
          </div>
        </li>
      
    
      
      
      
      
      
        <li class="drawer__nav-item">
          <a href="/section/children" class="drawer__nav-link">Для детей</a>
        </li>
      
    
      
      
      
      
      
        <li class="drawer__nav-item">
          <a href="/section/dentist" class="drawer__nav-link">Для стоматологов</a>
        </li>
      
    
      
      
      
      
      
        <li class="drawer__nav-item">
          <a href="http://dental.poterpite.ru/" class="drawer__nav-link">Теории и практики</a>
        </li>
      
    
      
      
      
      
      
        <li class="drawer__nav-item">
          <a href="http://clinic.poterpite.ru" class="drawer__nav-link">Стоматологическая клиника</a>
        </li>
      
    
  </ul>
</div>


  <div class="slider_lineup index-section small--hide">
    
    

    

    

    
      <div class="grid grid--no-gutters">
        
          
          
            
            
            
            <div class="grid__item medium-up--one-quarter">
              <a href="/catalog/all" title="Посмотреть нашу Для красивой улыбки коллекцию" class="featured-card">
                <div class="featured-card__header">
                  <p class="h1 featured-card__title">Каталог</p>
                  <span class="featured-card__action">Показать все</span>
                </div>
                
                  <div class="featured-card__image-wrapper">
                      <img src="/style/assets/catalog_all.jpg" alt="" class="image-absolute featured-card__image">
                  </div>
                
              </a>
            </div>
          
        
          
          
            
            
            
            <div class="grid__item medium-up--one-quarter">
              <a href="/section/children" title="Посмотреть нашу Для детей коллекцию" class="featured-card">
                <div class="featured-card__header">
                  <p class="h1 featured-card__title">Детям</p>
                  <span class="featured-card__action">Показать все</span>
                </div>
                
                  <div class="featured-card__image-wrapper">
                      <img src="/style/assets/section_children.jpg" alt="" class="image-absolute featured-card__image">
                  </div>
                
              </a>
            </div>
          
        
          
          
            
            
            
            <div class="grid__item medium-up--one-quarter">
              <a href="/section/dentist" title="Посмотреть нашу Для стоматологов коллекцию" class="featured-card">
                <div class="featured-card__header">
                  <p class="h1 featured-card__title">Врачам</p>
                  <span class="featured-card__action">Показать все</span>
                </div>
                
                  <div class="featured-card__image-wrapper">
                      <img src="/style/assets/section_dentist.jpg" alt="" class="image-absolute featured-card__image">
                  </div>
                
              </a>
            </div>
          
        
          
          
            
            
            
            <div class="grid__item medium-up--one-quarter">
              <a href="catalog/all" title="Посмотреть нашу  коллекцию" class="featured-card">
                <div class="featured-card__header">
                  <p class="h1 featured-card__title"></p>
                  <span class="featured-card__action">Показать все</span>
                </div>
                
                  <div class="featured-card__image-wrapper">
                    <img src="//cdn.shopify.com/s/assets/no-image-2048-5e88c1b20e087fb7bbe9a3771824e743c244f437e4f8ba93bbf7b11b53f7824c_large.gif" alt="" class="featured-card__image">
                  </div>
                
              </a>
            </div>
          
        
          
          
        
          
          
        
      </div>
    
  </div>



  <div class="rid index-section index-section--page-content text-center">
    <div class="">
      <div class="rte">
        
      </div>
    </div>
  </div>



  <div class="index-section small--hide">
    
   <div class="grid grid--no-gutters grid--uniform">
    <?php 
    if($main_products) { 
        foreach ($main_products as $cur) { ?>
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
      
  </div>




