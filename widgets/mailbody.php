<?php 
    $session = Request::GetSession();
    
$body = '
<table class="m_-1216999618458073902body" style="border-collapse:collapse;border-spacing:0;height:100%!important;width:100%!important">
      <tbody><tr>
        <td style="font-family:-apple-system,BlinkMacSystemFont, \''.'Segoe UI'.'\',\''.'Roboto'.'\',\''.'Oxygen'.'\',\''.'Ubuntu'.'\',\''.'Cantarell'.'\',\''.'Fira Sans'.'\',\''.'Droid Sans'.'\',\''.'Helvetica Neue'.'\',sans-serif">
          
<table class="m_-1216999618458073902header m_-1216999618458073902row" style="border-collapse:collapse;border-spacing:0;margin:40px 0 20px;width:100%">
  <tbody><tr>
    <td class="m_-1216999618458073902header__cell" style="font-family:-apple-system,BlinkMacSystemFont,\''.'Segoe UI'.'\',\''.'Roboto'.'\',\''.'Oxygen'.'\',\''.'Ubuntu'.'\',\''.'Cantarell'.'\',\''.'Fira Sans'.'\',\''.'Droid Sans'.'\',\''.'Helvetica Neue'.'\',sans-serif;">
      <center>

        <table class="m_-1216999618458073902container" style="border-collapse:collapse;border-spacing:0;margin:0 auto;text-align:left;width:560px">
          <tbody><tr>
            <td style="font-family:-apple-system,BlinkMacSystemFont,\''.'Segoe UI'.'\',\''.'Roboto'.'\',\''.'Oxygen'.'\',\''.'Ubuntu'.'\',\''.'Cantarell'.'\',\''.'Fira Sans'.'\',\''.'Droid Sans'.'\',\''.'Helvetica Neue'.'\',sans-serif">

              <table class="m_-1216999618458073902row" style="border-collapse:collapse;border-spacing:0;width:100%">
                <tbody><tr>
                  <td class="m_-1216999618458073902shop-name__cell" style="font-family:-apple-system,BlinkMacSystemFont,\''.'Segoe UI'.'\',\''.'Roboto'.'\',\''.'Oxygen'.'\',\''.'Ubuntu'.'\',\''.'Cantarell'.'\',\''.'Fira Sans'.'\',\''.'Droid Sans'.'\',\''.'Helvetica Neue'.'\',sans-serif">
                    
                      <h1 class="m_-1216999618458073902shop-name__text" style="color:#333;font-size:30px;font-weight:normal;margin:0">
                        <a href="https://poterpite.ru" style="color:#333;font-size:30px;text-decoration:none" target="_blank" data-saferedirecturl="https://www.google.com/url?hl=ru&amp;q=https://poterpite.ru&amp;source=gmail&amp;ust=1492001236248000&amp;usg=AFQjCNHtFL473WacTOe_Id2YdHVQSTe40g"><span class="il">Потерпите</span>, пожалуйста!</a>
                      </h1>
                    
                  </td>

                    <td class="m_-1216999618458073902order-number__cell" style="color:#999;font-family:-apple-system,BlinkMacSystemFont,"Segoe UI","Roboto","Oxygen","Ubuntu","Cantarell","Fira Sans","Droid Sans","Helvetica Neue",sans-serif;font-size:14px;text-transform:uppercase" align="right">
                      <span class="m_-1216999618458073902order-number__text" style="font-size:16px">
                        Order #'.$id.'
                      </span>
                    </td>
                </tr>
              </tbody></table>

            </td>
          </tr>
        </tbody></table>

      </center>
    </td>
  </tr>
</tbody></table>

  <table class="m_-1216999618458073902row m_-1216999618458073902content" style="border-collapse:collapse;border-spacing:0;width:100%;padding:40px 0">
  <tbody><tr>
    <td class="m_-1216999618458073902content__cell" style="padding:40px 0;">
      <center>
        <table class="m_-1216999618458073902container" style="border-collapse:collapse;border-spacing:0;margin:0 auto;text-align:left;width:560px">
          <tbody><tr>
            <td style="font-family:-apple-system,BlinkMacSystemFont,\''.'Segoe UI'.'\',\''.'Roboto'.'\',\''.'Oxygen'.'\',\''.'Ubuntu'.'\',\''.'Cantarell'.'\',\''.'Fira Sans'.'\',\''.'Droid Sans'.'\',\''.'Helvetica Neue'.'\',sans-serif">
              
            <h2 style="font-size:24px;font-weight:normal;margin:0 0 10px">Спасибо, '.$session['checkout_name'].' '.$session['checkout_last_name'].', за Ваш заказ! </h2>
            <p style="color:#777;font-size:16px;line-height:150%;margin:0">Здравствуйте, '.$session['checkout_name'].' '.$session['checkout_last_name'].', мы получили Ваш заказ и готовим его к отгрузке. Мы сообщим Вам, когда заказ будет отправлен.</p>
            
              <table class="m_-1216999618458073902row m_-1216999618458073902actions" style="border-collapse:collapse;border-spacing:0;margin-top:20px;width:100%">
  <tbody><tr>
    <td class="m_-1216999618458073902actions__cell" style="font-family:-apple-system,BlinkMacSystemFont,\''.'Segoe UI'.'\',\''.'Roboto'.'\',\''.'Oxygen'.'\',\''.'Ubuntu'.'\',\''.'Cantarell'.'\',\''.'Fira Sans'.'\',\''.'Droid Sans'.'\',\''.'Helvetica Neue'.'\',sans-serif">
      <table class="m_-1216999618458073902button m_-1216999618458073902main-action-cell" style="border-collapse:collapse;border-spacing:0;float:left;margin-right:15px">
        <tbody><tr>
          <td class="m_-1216999618458073902button__cell" style="border-radius:4px;font-family:-apple-system,BlinkMacSystemFont,\''.'Segoe UI'.'\',\''.'Roboto'.'\',\''.'Oxygen'.'\',\''.'Ubuntu'.'\',\''.'Cantarell'.'\',\''.'Fira Sans'.'\',\''.'Droid Sans'.'\',\''.'Helvetica Neue'.'\',sans-serif" align="center" bgcolor="#1990C6"><a href="'.ShopEngine::GetHost().'/checkout/thank_you?orderid='.$key.'" class="m_-1216999618458073902button__text" style="color:#fff;display:block;font-size:16px;padding:20px 25px;text-decoration:none" target="_blank" data-saferedirecturl="https://www.google.com/url?hl=ru&amp;q=https://checkout.shopify.com/13390281/orders/7e8c10de2c39eccd224f04ab650df0dd/authenticate?key%3D07708ac71aa6c458a21fdbf70e7bc749&amp;source=gmail&amp;ust=1492001236248000&amp;usg=AFQjCNFKdcjmwW5rC9Fn2hKqDN79pOVVQQ">Посмотреть / оплатить заказ</a></td>
        </tr>
      </tbody></table>
      
    <table class="m_-1216999618458073902link m_-1216999618458073902secondary-action-cell" style="border-collapse:collapse;border-spacing:0;margin-top:19px">
      <tbody><tr>
        <td class="m_-1216999618458073902link__cell" style="font-family:-apple-system,BlinkMacSystemFont,\''.'Segoe UI'.'\',\''.'Roboto'.'\',\''.'Oxygen'.'\',\''.'Ubuntu'.'\',\''.'Cantarell'.'\',\''.'Fira Sans'.'\',\''.'Droid Sans'.'\',\''.'Helvetica Neue'.'\',sans-serif"><a href="https://poterpite.ru" class="m_-1216999618458073902link__text" style="color:#1990c6;font-size:16px;text-decoration:none" target="_blank" data-saferedirecturl="https://www.google.com/url?hl=ru&amp;q=https://poterpite.ru&amp;source=gmail&amp;ust=1492001236248000&amp;usg=AFQjCNHtFL473WacTOe_Id2YdHVQSTe40g"><span class="m_-1216999618458073902or" style="color:#999;display:inline-block;font-size:16px;margin-right:10px">или</span> Посетите наш магазин</a></td>
      </tr>
    </tbody></table>


    </td>
  </tr>
</tbody></table>

            

            </td>
          </tr>
        </tbody></table>
      </center>
    </td>
  </tr>
</tbody></table>

          <table class="m_-1216999618458073902row m_-1216999618458073902section" style="border-collapse:collapse;border-spacing:0;border-top-color:#e5e5e5;border-top-style:solid;border-top-width:1px;width:100%">
  <tbody><tr>
    <td class="m_-1216999618458073902section__cell" style="font-family:-apple-system,BlinkMacSystemFont,\''.'Roboto'.'\',\''.'Oxygen'.'\',\''.'Ubuntu'.'\',\''.'Cantarell'.'\',\''.'Fira Sans'.'\',\''.'Droid Sans'.'\',\''.'Helvetica Neue'.'\',sans-serif; padding:40px 0">
      <center>
        <table class="m_-1216999618458073902container" style="border-collapse:collapse;border-spacing:0;margin:0 auto;text-align:left;width:560px">
          <tbody><tr>
            <td style="font-family:-apple-system,BlinkMacSystemFont,\''.'Segoe UI'.'\',\''.'Roboto'.'\',\''.'Oxygen'.'\',\''.'Ubuntu'.'\',\''.'Cantarell'.'\',\''.'Fira Sans'.'\',\''.'Droid Sans'.'\',\''.'Helvetica Neue'.'\',sans-serif">
              <h3 style="font-size:20px;font-weight:normal;margin:0 0 25px">Итог</h3>
            </td>
          </tr>
        </tbody></table>
        <table class="m_-1216999618458073902container" style="border-collapse:collapse;border-spacing:0;margin:0 auto;text-align:left;width:560px">
          <tbody><tr>
            <td style="font-family:-apple-system,BlinkMacSystemFont,\''.'Segoe UI'.'\',\''.'Roboto'.'\',\''.'Oxygen'.'\',\''.'Ubuntu'.'\',\''.'Cantarell'.'\',\''.'Fira Sans'.'\',\''.'Droid Sans'.'\',\''.'Helvetica Neue'.'\',sans-serif">
              
            
<table class="m_-1216999618458073902row" style="border-collapse:collapse;border-spacing:0;width:100%">
  

  
  <tbody>';

    $array = Controller_Checkout::GetOrderProducts();
    
    foreach ($array as $cur)
    {
        $body .= '<tr class="m_-1216999618458073902order-list__item m_-1216999618458073902order-list__item" style="width:100%">'
                . '<td class="m_-1216999618458073902order-list__item__cell" style="font-family:-apple-system,BlinkMacSystemFont,\''.'Segoe UI'.'\',\''.'Roboto'.'\',\''.'Oxygen'.'\',\''.'Ubuntu'.'\',\''.'Cantarell'.'\',\''.'Fira Sans'.'\',\''.'Droid Sans'.'\',\''.'Helvetica Neue'.'\',sans-serif">
            <table style="border-collapse:collapse;border-spacing:0">
              <tbody><tr><td style="font-family:-apple-system,BlinkMacSystemFont,\''.'Roboto'.'\',\''.'Oxygen'.'\',\''.'Ubuntu'.'\',\''.'Cantarell'.'\',\''.'Fira Sans'.'\',\''.'Droid Sans'.'\',\''.'Helvetica Neue'.'\',sans-serif;">

                <div style=" width:50px; height:50px; border:1px solid #e5e5e5;border-radius:8px;margin-right:15px;" >
                  <img src="cid:'.$cur['handle'].'" align="left" width="60" height="60" class="m_-1216999618458073902order-list__product-image CToWUd" style="width:100%; height:auto; max-width:100%; max-height:100%">
                </div>
              </td>
              <td class="m_-1216999618458073902order-list__product-description-cell" style="font-family:-apple-system,BlinkMacSystemFont,\''.'Roboto'.'\',\''.'Oxygen'.'\',\''.'Ubuntu'.'\',\''.'Cantarell'.'\',\''.'Fira Sans'.'\',\''.'Droid Sans'.'\',\''.'Helvetica Neue'.'\',sans-serif;width:75%">

                <span class="m_-1216999618458073902order-list__item-title" style="color:#555;font-size:16px;font-weight:600;line-height:1.4">'.$cur['title'].'&nbsp;×&nbsp;'.$cur['orders_count'].'</span><br>

              </td>
                <td class="m_-1216999618458073902order-list__price-cell" style="font-family:-apple-system,BlinkMacSystemFont,\''.'Roboto'.'\',\''.'Oxygen'.'\',\''.'Ubuntu'.'\',\''.'Cantarell'.'\',\''.'Fira Sans'.'\',\''.'Droid Sans'.'\',\''.'Helvetica Neue'.'\',sans-serif;white-space:nowrap">

                  <p class="m_-1216999618458073902order-list__item-price" style="color:#555;font-size:16px;font-weight:600;line-height:150%;margin:0 0 0 15px" align="right">'.ShopEngine::Help()->AsPrice($cur['orders_price']).'</p>
                </td>
            </tr></tbody></table>
          </td></tr>';
    }
                  
$body .= '
                  
</tbody></table>

            <table class="m_-1216999618458073902row m_-1216999618458073902subtotal-lines" style="border-collapse:collapse;border-spacing:0;border-top-color:#e5e5e5;border-top-style:solid;border-top-width:1px;margin-top:15px;width:100%">
  <tbody><tr>
    <td class="m_-1216999618458073902subtotal-spacer" style="font-family:-apple-system,BlinkMacSystemFont,"Segoe UI","Roboto","Oxygen","Ubuntu","Cantarell","Fira Sans","Droid Sans","Helvetica Neue",sans-serif;width:40%"></td>
    <td style="font-family:-apple-system,BlinkMacSystemFont,\''.'Segoe UI'.'\',\''.'Roboto'.'\',\''.'Oxygen'.'\',\''.'Ubuntu'.'\',\''.'Cantarell'.'\',\''.'Fira Sans'.'\',\''.'Droid Sans'.'\',\''.'Helvetica Neue'.'\',sans-serif">
      <table class="m_-1216999618458073902row m_-1216999618458073902subtotal-table" style="border-collapse:collapse;border-spacing:0;margin-top:20px;width:100%">
        

        
<tbody>
        
<tr class="m_-1216999618458073902subtotal-line">
  <td class="m_-1216999618458073902subtotal-line__title" style="font-family:-apple-system,BlinkMacSystemFont,"Segoe UI","Roboto","Oxygen","Ubuntu","Cantarell","Fira Sans","Droid Sans","Helvetica Neue",sans-serif;padding:5px 0">
    <p style="color:#777;font-size:16px;line-height:1.2em;margin:0">
      <span style="font-size:16px">Доставка</span>
    </p>
  </td>
  <td class="m_-1216999618458073902subtotal-line__value" style="font-family:-apple-system,BlinkMacSystemFont,"Segoe UI","Roboto","Oxygen","Ubuntu","Cantarell","Fira Sans","Droid Sans","Helvetica Neue",sans-serif;padding:5px 0" align="right">
    <strong style="color:#555;font-size:16px">'.ShopEngine::Help()->AsPrice($session['shipper_price']).'</strong>
  </td>
</tr>


        
      </tbody></table>
      <table class="m_-1216999618458073902row m_-1216999618458073902subtotal-table m_-1216999618458073902subtotal-table--total" style="border-collapse:collapse;border-spacing:0;border-top-color:#e5e5e5;border-top-style:solid;border-top-width:2px;margin-top:20px;width:100%">
        
<tbody><tr class="m_-1216999618458073902subtotal-line">
  <td class="m_-1216999618458073902subtotal-line__title" style="font-family:-apple-system,BlinkMacSystemFont,"Segoe UI","Roboto","Oxygen","Ubuntu","Cantarell","Fira Sans","Droid Sans","Helvetica Neue",sans-serif;padding:20px 0 0">
    <p style="color:#777;font-size:16px;line-height:1.2em;margin:0">
      <span style="font-size:16px">Всего</span>
    </p>
  </td>
  <td class="m_-1216999618458073902subtotal-line__value" style="font-family:-apple-system,BlinkMacSystemFont,"Segoe UI","Roboto","Oxygen","Ubuntu","Cantarell","Fira Sans","Droid Sans","Helvetica Neue",sans-serif;padding:20px 0 0" align="right">
    <strong style="color:#555;font-size:24px">'.ShopEngine::Help()->AsPrice($session['full_price']).'</strong>
  </td>
</tr>

      </tbody></table>

      
      

      
    </td>
  </tr>
</tbody></table>


            </td>
          </tr>
        </tbody></table>
      </center>
    </td>
  </tr>
</tbody></table>

          <table class="m_-1216999618458073902row m_-1216999618458073902section" style="border-collapse:collapse;border-spacing:0;border-top-color:#e5e5e5;border-top-style:solid;border-top-width:1px;width:100%">
  <tbody><tr>
    <td class="m_-1216999618458073902section__cell" style="font-family:-apple-system,BlinkMacSystemFont,\''.'Segoe UI'.'\',\''.'Roboto'.'\',\''.'Oxygen'.'\',\''.'Ubuntu'.'\',\''.'Cantarell'.'\',\''.'Fira Sans'.'\',\''.'Droid Sans'.'\',\''.'Helvetica Neue'.'\',sans-serif;padding:40px 0">
      <center>
        <table class="m_-1216999618458073902container" style="border-collapse:collapse;border-spacing:0;margin:0 auto;text-align:left;width:560px">
          <tbody><tr>
            <td style="font-family:-apple-system,BlinkMacSystemFont,\''.'Segoe UI'.'\',\''.'Roboto'.'\',\''.'Oxygen'.'\',\''.'Ubuntu'.'\',\''.'Cantarell'.'\',\''.'Fira Sans'.'\',\''.'Droid Sans'.'\',\''.'Helvetica Neue'.'\',sans-serif">
              <h3 style="font-size:20px;font-weight:normal;margin:0 0 25px">Информация для покупателя</h3>
            </td>
          </tr>
        </tbody></table>
        <table class="m_-1216999618458073902container" style="border-collapse:collapse;border-spacing:0;margin:0 auto;text-align:left;width:560px">
          <tbody><tr>
            <td style="font-family:-apple-system,BlinkMacSystemFont,\''.'Segoe UI'.'\',\''.'Roboto'.'\',\''.'Oxygen'.'\',\''.'Ubuntu'.'\',\''.'Cantarell'.'\',\''.'Fira Sans'.'\',\''.'Droid Sans'.'\',\''.'Helvetica Neue'.'\',sans-serif">
              
            <table class="m_-1216999618458073902row" style="border-collapse:collapse;border-spacing:0;width:100%">
              <tbody><tr>
                
                <td class="m_-1216999618458073902customer-info__item" style="font-family:-apple-system,BlinkMacSystemFont,"Segoe UI","Roboto","Oxygen","Ubuntu","Cantarell","Fira Sans","Droid Sans","Helvetica Neue",sans-serif;padding-bottom:40px;width:50%">
                  <h4 style="color:#555;font-size:16px;font-weight:500;margin:0 0 5px">Адрес доставки</h4>
                  <p style="color:#777;font-size:16px;line-height:150%;margin:0">
  '.$session['checkout_name'].' '.$session['checkout_last_name'].'<br>
  '.$session['checkout_address'].'
  
  <br>
  
  <br>'.$session['checkout_city'].', '.$session['checkout_region'].' '.$session['checkout_index'].'
  <br>Россия
</p>

                </td>
                
                ';

if($session['checkout_billing_address_payment'] === 0) {
    $body .= '<td class="m_-1216999618458073902customer-info__item" style="font-family:-apple-system,BlinkMacSystemFont,"Segoe UI","Roboto","Oxygen","Ubuntu","Cantarell","Fira Sans","Droid Sans","Helvetica Neue",sans-serif;padding-bottom:40px;width:50%">'
            . '<h4 style="color:#555;font-size:16px;font-weight:500;margin:0 0 5px">Платёжный адрес</h4>'
            . ''.$session['checkout_name'].' '.$session['checkout_last_name'].'<br>'
            . ''.$session['checkout_address'].''
            . '<br>
            <br>'.$session['checkout_city'].', '.$session['checkout_region'].' '.$session['checkout_inder'].'
            <br>Россия
            </p>
            </td>';
}
else {
        $body .= '<td class="m_-1216999618458073902customer-info__item" style="font-family:-apple-system,BlinkMacSystemFont,"Segoe UI","Roboto","Oxygen","Ubuntu","Cantarell","Fira Sans","Droid Sans","Helvetica Neue",sans-serif;padding-bottom:40px;width:50%">'
            . '<h4 style="color:#555;font-size:16px;font-weight:500;margin:0 0 5px">Платёжный адрес</h4>'
            . ''.$session['checkout_billing_first_name'].' '.$session['checkout_billing_last_name'].'<br>'
            . ''.$session['checkout_billing_address'].''
            . '<br>
            <br>'.$session['checkout_billing_city'].', '.$session['checkout_billing_country'].' '.$session['checkout_billing_index'].'
            <br>Россия
            </p>
            </td>';
}
      
$body .= '
                
              </tr>
            </tbody></table>
            <table class="m_-1216999618458073902row" style="border-collapse:collapse;border-spacing:0;width:100%">
              <tbody><tr>
                <td class="m_-1216999618458073902customer-info__item" style="font-family:-apple-system,BlinkMacSystemFont,"Segoe UI","Roboto","Oxygen","Ubuntu","Cantarell","Fira Sans","Droid Sans","Helvetica Neue",sans-serif;padding-bottom:40px;width:50%">
                  <h4 style="color:#555;font-size:16px;font-weight:500;margin:0 0 5px">Способ доставки</h4>
                  <p style="color:#777;font-size:16px;line-height:150%;margin:0">'.$session["shipper_name"].'</p>
                </td>
                <td class="m_-1216999618458073902customer-info__item" style="font-family:-apple-system,BlinkMacSystemFont,"Segoe UI","Roboto","Oxygen","Ubuntu","Cantarell","Fira Sans","Droid Sans","Helvetica Neue",sans-serif;padding-bottom:40px;width:50%">
                </td>
              </tr>
            </tbody></table>

            </td>
          </tr>
        </tbody></table>
      </center>
    </td>
  </tr>
</tbody></table>

          <table class="m_-1216999618458073902row m_-1216999618458073902footer" style="border-collapse:collapse;border-spacing:0;border-top-color:#e5e5e5;border-top-style:solid;border-top-width:1px;width:100%">
  <tbody><tr>
    <td class="m_-1216999618458073902footer__cell" style="font-family:-apple-system,BlinkMacSystemFont,"Segoe UI","Roboto","Oxygen","Ubuntu","Cantarell","Fira Sans","Droid Sans","Helvetica Neue",sans-serif;padding:35px 0">
      <center>
        <table class="m_-1216999618458073902container" style="border-collapse:collapse;border-spacing:0;margin:0 auto;text-align:left;width:560px">
          <tbody><tr>
            <td style="font-family:-apple-system,BlinkMacSystemFont,\''.'Segoe UI'.'\',\''.'Roboto'.'\',\''.'Oxygen'.'\',\''.'Ubuntu'.'\',\''.'Cantarell'.'\',\''.'Fira Sans'.'\',\''.'Droid Sans'.'\',\''.'Helvetica Neue'.'\',sans-serif">
              <p class="m_-1216999618458073902disclaimer__subtext" style="color:#999;font-size:14px;line-height:150%;margin:0">Если у Вас есть вопросы, ответьте на это письмо, либо свяжитесь с нами по адресу <a href="mailto:info@poterpite.ru" style="color:#1990c6;font-size:14px;text-decoration:none" target="_blank">info@poterpite.ru</a></p>
            </td>
          </tr>
        </tbody></table>
      </center>
    </td>
  </tr>
</tbody></table>

<img src="https://ci6.googleusercontent.com/proxy/z1Tc_YePGMPwgHoI7gVzk6JZIwXTurLXXxMGAcNoO3o1SAWp65BR18QpoOo42yugUqBBsT7BGOhxCQDF6eXUNs1B5GGvOjPMZ-1vqwdDMFQDNczhIUW2ZICbSrMoEOCiMhC1s2bpdoXRryZac-6HI0MTFg4s4G4EJfnB0MC4K2aElJ73By-bAkepiXAbchCkmmdPWUtr3N7L7bXeEapTxg=s0-d-e1-ft#https://cdn.shopify.com/s/assets/themes_support/notifications/spacer-1a26dfd5c56b21ac888f9f1610ef81191b571603cb207c6c0f564148473cab3c.png" class="m_-1216999618458073902spacer CToWUd" height="1" style="height:0;min-width:600px">

        </td>
      </tr>
    </tbody></table>
        
        ';