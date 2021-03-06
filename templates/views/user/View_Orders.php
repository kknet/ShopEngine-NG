<h1>Профиль</h1>

<div class="grid">
  <div class="grid__item medium-up--two-thirds">
    <div class="content-block content-block--large">
      <h2>История заказов</h2>
      
        <?php if($orders) { ?>

          <table class="responsive-table">
            <thead>
              <tr>
                <th>Заказ</th>
                <th>Дата</th>
                
                <th>Статус</th>
                <th>Всего</th>
                <th>Счет / оплата</th>
              </tr>
            </thead>
            
            <tbody>
              
                <?php foreach($orders as $order) { ?>
                
                <tr>
                  <td data-label="Заказ"><a href="<?=ShopEngine::GetHost()?>/checkout/thank_you?orderid=<?=$order['orders_key']?>" title="">#<?=$order['orders_id']?></a></td>
                  <td data-label="Дата"><?=$order['orders_date']?></td>
                  
                  <td data-label="">
                    
                      
                      <?php if($order['orders_status'] === '0' OR !$order['orders_status']) $status = 'Не завершён'?>
                      <?php if($order['orders_status'] === '1')    $status = 'Выполняется'?>
                      <?php if($order['orders_status'] === '2')    $status = 'Завершён'?>
                      
                    	<?= $status ?>
                    
                  </td>
                  <td data-label="Всего"><?=ShopEngine::Help()->AsPrice($order['orders_price'])?></td>
                  <td>
                    <a target="_blank" href="<?=ShopEngine::GetHost()?>/checkout/download?orderid=<?=$order['orders_key']?>">Скачать счет</a>
                    
                    <span class="paymentLink_old" data-id="<?=$order['orders_id']?>"></span>
                  </td>
                </tr>
                
                <?php } ?>
              
            </tbody>
          </table>

        <?php } else { ?>
            <h4>История заказов пуста</h4>
        <?php } ?>
        
      
    </div>
  </div>
  <div class="grid__item medium-up--one-third">
    <div class="content-block">
      <h6 class="content-block__title">Информация Вашего Аккаунта</h6>

      <p><?= Request::GetSession('user_name')?> <?= Request::GetSession('user_last_name')?> <?= Request::GetSession('user_patronymic')?></p>

      <?php if($addresses) { ?>
      
      
        <p>
          <?=$addresses[0]['address']?><br>

          

          
            <?=$addresses[0]['address_city']?><br>
          

          
            <?=$addresses[0]['region_name']?><br>
          

          
            <?=$addresses[0]['address_index']?><br>
          

          
            <?=$addresses[0]['country_name']?><br>
          

          
            <?=$addresses[0]['address_phone']?>
          
        </p>
        
      <?php }  ?>
      

      <p><a href="/user/addresses">Просмотреть Адреса</a></p>
    </div>
  </div>
</div>
