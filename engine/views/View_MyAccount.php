<div class="myaccount_body">
    <h1>Профиль</h1>
    <form action="" method="post">
        <div class="myaccount_first">
            <div class="myaccount_first_left left">
                <h4>Личная информация</h4>
                <p>Логин: 2342</p>
                <ul>
                    <li>
                        <label for="myaccount_name">Имя*</label>
                        <input value="<?=Request::GetSession('user_name')?>" placeholder="Имя" id="myaccount_name" type="text" name="myaccount_name" />
                        <p style="color:red" class="field__message--error"><?=Request::GetSession('error_account_name')?></p>
                    </li>
                    <li>
                        <label for="myaccount_patr">Отчество</label>
                        <input value="<?=Request::GetSession('user_patronymic')?>" placeholder="Отчество" id="myaccount_patr" type="text" name="myaccount_patr" />
                    </li>
                    <li>
                        <label for="myaccount_name">Фамилия</label>
                        <input value="<?=Request::GetSession('user_last_name')?>" placeholder="Фамилия" id="myaccount_name" type="text" name="myaccount_last_name" />
                    </li>
                    <li>
                        <div class="myaccount_first_left_left left">
                            <label for="myaccount_gender">Ваш пол</label>
                            <select id="myaccount_gender" name="myaccount_gender">
                                <?php if(Request::GetSession('user_gender') === 'm') $male   = "selected" ?>
                                <?php if(Request::GetSession('user_gender') === 'w') $female = "selected" ?>
                                <option <?=$male?> value="m">Мужской</option>
                                <option <?=$female?> value="w">Женский</option>
                            </select>
                        </div>
                        <div class="myaccount_first_left_right right">
                            <label for="myaccount_name">Дата рождения</label>
                            <input value="<?=Request::GetSession('user_date_of_birth')?>" id="myaccount_date" type="date" name="myaccount_date" />   
                        </div>
                    </li>
                </ul>
            </div>
            <div class="myaccount_first_right right">
                <h4>Аватар</h4>
                <div class="myaccount_first_left_image">
                    <p>Функция добавится в дальнейшем</p>
                </div>
                <div class="myaccount_first_left_select"></div>
            </div>
        <div class="clear"></div>
        </div>
        <div class="myaccount_second">
            <div class="myaccount_second_left left">
                <h4>Контактная информация</h3>
                <ul>
                    <li>
                        <label for="myaccount_email">Электронная почта*</label>
                        <input value="<?=Request::GetSession('user_email')?>" type="text" name="myaccount_email" placeholder="Электронная почта" />
                        <p style="color:red" class="field__message--error"><?=Request::GetSession('error_account_email')?></p>
                    </li>
                    <li>
                        <label for="myaccount_phone">Мобильный телефон</label>
                        <input value="<?=Request::GetSession('user_phone')?>" type="text" name="myaccount_phone" placeholder="Мобильный телефон" />
                        <p style="color:red" class="field__message--error"><?=Request::GetSession('error_account_phone')?></p>
                    </li>
                    <li>
                        <label for="myaccount_act_phone">Телефон для связи</label>
                        <input value="<?=Request::GetSession('user_act_phone')?>" type="text" name="myaccount_act_phone" placeholder="Телефон для связи" />
                        <p style="color:red" class="field__message--error"><?=Request::GetSession('error_account_act_phone')?></p>
                    </li>
                </ul>
            </div>
             <div class="myaccount_second_right right">
                 <h4>Изменение пароля</h3>
                 <ul>
                    <li>
                        <label for="myaccount_old_password">Старый пароль</label>
                        <input type="password" name="myaccount_old_password" placeholder="Старый пароль" />
                        <p style="color:red" class="field__message--error"><?=Request::GetSession('error_account_old_password')?></p>
                        <p style="color:green" class="field__message--error"><?=Request::GetSession('error_account_new_repassword_success')?></p>
                    </li>
                    <li>
                        <label for="myaccount_new_password">Новый пароль</label>
                        <input type="password" name="myaccount_new_password" placeholder="Новый пароль" />
                        <p style="color:red" class="field__message--error"><?=Request::GetSession('error_account_new_password')?></p>
                    </li>
                    <li>
                        <label for="myaccount_new_repassword">Подтвердите пароль</label>
                        <input type="password" name="myaccount_new_repassword" placeholder="Подтвердите пароль" />
                        <p style="color:red" class="field__message--error"><?=Request::GetSession('error_account_new_repassword')?></p>
                    </li>
                </ul>
             </div>
            <div class="clear"></div>
        </div>
        <p>* - обязательные поля</p>
        <div class="submit">
            <input type="submit" class="btn" value="Сохранить информацию" />
        </div>
        <input type="hidden" name="user_account_change" value="1" />
        <input type="hidden" name="csrf" value="<?= ShopEngine::Help()->generateToken()?>" />
    </form>
</div>

