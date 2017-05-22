<div class="grid">

  <div class="grid__item medium-up--one-half medium-up--push-one-quarter">
    <div class="content-block text-center">
      <div class="form-success hide" id="ResetSuccess">
        Мы отправили Вам письмо по электронной почте со ссылкой для обновления Вашего пароля.
      </div>
      <div id="CustomerLoginForm" class="form-vertical">
        <form method="post" action="/user/login" id="customer_login" accept-charset="UTF-8">
            <input type="hidden" name="login" value="1" />
            <input type="hidden" name="csrf" value="<?=ShopEngine::Help()->generateToken()?>" />
            <input type="hidden" name="utf8" value="✓">

          <h1>Логин</h1>

        <?php if(Request::GetSession('error_login_message') === 'error') { ?>
            <div class="errors" id="ResetSuccess">
                <p>Ошибка авторизации. Проверьте, пожалуйста, вводимые данные.</p>
            </div>
        <?php } ?>
        <?php if(Request::GetSession('success_password')) { ?>
            <div class="form-success" id="ResetSuccess">
                <?=Request::GetSession('success_password')?>
            </div>   
        <?php }  ?>
        <?php Request::EraseFullSession('success')?>

          <label for="CustomerEmail" class="label--hidden">Email</label>
          <input type="email" name="login_email" id="CustomerEmail" class="" placeholder="Email" autocorrect="off" autocapitalize="off" autofocus="">

          
            <label for="CustomerPassword" class="label--hidden">Пароль</label>
            <input type="password" value="" name="login_password" id="CustomerPassword" class="" placeholder="Пароль">
          

          <p>
            <input type="submit" class="btn" value="Войти">
          </p>
          <p><a href="<?=ShopEngine::GetHost()?>">Вернуться к магазину</a></p>
          
            <p><a href="<?=ShopEngine::GetHost()?>/user/restore" id="RecoverPassword">Забыли пароль?</a></p>
          

          <p><a href="<?=ShopEngine::GetHost()?>/user/signup" id="customer_register_link">Создать аккаунт</a></p>

        </form>
      </div>

      
      <div id="RecoverPasswordForm" class="hide">

        <h2 class="h1">Сброс пароля</h2>
        <p>Мы отправим Вам ссылку для сброса пароля.</p>

        <div class="form-vertical">
          <form method="post" action="https://poterpite.ru/account/recover" accept-charset="UTF-8"><input type="hidden" value="recover_customer_password" name="form_type"><input type="hidden" name="utf8" value="✓">

            

            
            

            <label for="RecoverEmail" class="label--hidden">Email</label>
            <input type="email" value="" name="email" id="RecoverEmail" placeholder="Email" autocorrect="off" autocapitalize="off">

            <p>
              <input type="submit" class="btn" value="Отправить">
            </p>

            <button type="button" id="HideRecoverPasswordLink" class="text-link link-accent-color">Отмена</button>
          </form>
        </div>

      </div>

    </div>

    
    
  </div>

</div>
