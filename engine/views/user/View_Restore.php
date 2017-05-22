<h1>Восстановление пароля</h1>
<div class="restore_block">
    <?php if(isset($status) AND $status === 'new_password') { ?>
    <?php if(isset($errors) AND $errors) { ?>
        <div class="errors" id="ResetSuccess">
            <?= $errors ?>
        </div>
    <?php } ?>
        <form method="post" action="">
            <ul>
                <li>
                    <label for="restore_password">Введите новый пароль</label>
                    <input id="restore_name" type="password" name="restore_password" placeholder="Введите новый пароль" />
                </li>
                <li>
                    <label for="restore_repassword">Введите пароль еще раз</label>
                    <input id="restore_name" type="password" name="restore_repassword" placeholder="Введите пароль еще раз" />
                </li>
                <li>
                    <input type="submit" name="restore_button_new" class="btn" />
                </li>
            </ul>
            <input type="hidden" name="restore_new" value="1" />
            <input type="hidden" name="csrf" value="<?=ShopEngine::Help()->generateToken()?>" />
        </form>
    <?php } else { ?>
        <form method="post" action="">
            <?php if($start === true) { ?>
                <div class="form-success" id="ResetSuccess">
                    Инструкции по восстановлению пароля выстаны на ваш электронный адрес
                </div>
            <?php } ?>

            <?php if($errors AND is_string($errors)) { ?>
                <div class="errors" id="ResetSuccess">
                    <?= $errors ?>
                </div>
            <?php } ?>
            <ul>
                <li>
                    <label for="restore_email">Введите Ваш E-Mail</label>
                    <input id="restore_name" type="text" name="restore_email" placeholder="Введите Ваш E-Mail" />
                </li>
                <li>
                    <input type="submit" name="restore_button" class="btn" />
                </li>
            </ul>
            <input type="hidden" name="restore" value="1" />
            <input type="hidden" name="csrf" value="<?=ShopEngine::Help()->generateToken()?>" />
        </form> 
    <?php } ?>
</div>

