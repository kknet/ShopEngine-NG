<!DOCTYPE html>
<html lang="ru"> 
<head>
	<title><?php GetName(); ?> - <?php GetPageName(); ?></title>
	<meta charset="utf-8">
	<?php 
            GetSeoKeywords();
            GetSeoDescription();
	 ?>
	<meta name="w1-verification" content="177267643795" />
        <meta name="session-token" content="<?= ShopEngine::Help()->GenerateToken() ?>" />
	<link rel="shortcut icon" type="image/png" href="/admin/icon/<?php GetTheIcon();?>">
	<link rel="stylesheet" type="text/css" href="/style/style.css">
	<link rel="stylesheet" type="text/css" href="/style/basic.css">
	<link rel="stylesheet" type="text/css" href="/fonts/fonts.css">
	<link href="https://fonts.googleapis.com/css?family=PT+Sans:400,700&subset=cyrillic,cyrillic-ext,latin-ext" rel="stylesheet">
	<script type="text/javascript" src="/js/jquery-1.9.1.min.js"></script>
        <script type="text/javascript" src="/js/jquery-migrate-1.1.0.js"></script>
	<script type="text/javascript" src="/plugins/carhartl-jquery-cookie-92b7715/jquery.cookie.js"></script>
	<script type="text/javascript" src="/js/textchange.js"></script>
	<script type="text/javascript" src="/engine/javascript/system.js"></script>
	<script type="text/javascript" src="/js/js.js"></script>


	<link rel="stylesheet" href="/plugins/nivo-slider3.0.1/css/nivo-slider.css" type="text/css" media="screen" />

</head>
<div id="hide_block" class="slider_block_passive"></div>
<div id="registration_black"></div>
<div id="autorization_black"></div>
<div id="message_black"></div>
<div id="cart_black"></div>
<div id="pre_loading">
	<img src="/img/loading.gif" alt="image"/>
</div>
<div id="body_block">
<header id="m_header">
<div id="m_overhead">
	<div id="l_authorization">
		<div id="l_auto_div">
	<?php LoginRegister();?>
		<img src="/style/img/user.png" alt="image"/>
		</div>
		<div id="p_city_div"><p id="p_city">Язык: <span id="s_city">русский</span></p><img id="i_city" src="/style/img/city.png" alt="image"/></div>
	</div>
</div>
<div id="main_header">
<div id="user_inform" class="user_passive">
	<a href="/profile/" id="user_profile">Личный кабинет</a>
	<span id="user_exit">Выйти</span>
</div>
	<a href="<?php $_SERVER['SERVER_NAME']; ?>/"><img id="m_logo" src="/admin/logotype/<?php GetTheLogo();?>" height="70" alt="image"/></a>
	<div id="m_phone">
		<p id="p_phone"><?php GetThePhoneTitle();?></p>
		<p id="n_phone"><?php GetThePhone();?></p>
		<img id="i_phone" src="/style/img/phone.png" alt="image"/>
	</div>
	<form id="m_search" action="/search/" method="GET">
		<img src="/style/img/tool.png" alt="image"/>
		<input type="text" name="search" id="search" placeholder="Поиск среди <?php CountOfProducts();?> товаров..." />
		<input type="submit" name="go_search" id="go_search" value="Поиск"/>
		<ul id="search_list"></ul>
	</form>
</div>
</header>

<div id="registration">
	<p id="registration_title">Создать аккаунт</p>
	<form id="registration_form" action="javascript:void(null);" method="post">
		<label for="registration_surname">Фамилия*</label><br/>
		<input type="text" id="registration_surname" name="registration_surname" /><br/>
		<div id="surname_error"><img src="/style/img/left.png" alt="image"/>Фамилия должна иметь длину от 3 до 30 символов</div>
		<label for="registration_name">Имя*</label><br/>
		<input type="text" id="registration_name" name="registration_name" /><br/>
		<div id="name_error"><img src="/style/img/left.png" alt="image"/>Имя должно иметь длину от 3 до 20 символов</div>
		<label for="registration_phone">Мобильный телефон*</label><br/>
		<input type="text" placeholder="В удобном формате без '+'" id="registration_phone" name="registration_phone" /><br/>
		<div id="phone_error"><img src="/style/img/left.png" alt="image"/>Введите корректный номер</div>
		<label for="registration_address">Адрес*</label><br/>
		<input type="text" id="registration_address" name="registration_address" /><br/>
		<div id="address_error"><img src="/style/img/left.png" alt="image"/>Введите корректный адрес</div>
		<label for="registration_email">E-Mail*</label><br/>
		<input type="text" placeholder="example@example.com" id="registration_email" name="registration_email" /><br/>
		<div id="email_error"><img src="/style/img/left.png" alt="image"/>Введите корректный E-Mail</div>
		<label for="registration_password">Пароль*</label><br/>
		<input type="password" id="registration_password" name="registration_password" /><br/>
		<div id="password_error"><img src="/style/img/left.png" alt="image"/>Пароль должен иметь длину от 3 до 20 символов</div>
		<label for="registration_password_two">Повторите пароль*</label><br/>
		<input type="password" id="registration_password_two" name="registration_password_two" /><br/>
		<div id="password_error_two"><img src="/style/img/left.png" alt="image"/>Пароли не совпадают</div>
		<input type="submit" id="registration_button" name="registration_button" value="Зарегистрироваться"/>
	</form>
	<div id="have_account">
		<p id="account_p">Есть аккаунт?</p>
		<p id="account_a">Войти</p>
	</div>
	<div class="registration_cancel"><img src="/img/cancel.png" alt="image"/></div>
</div>

<div id="autorization">
	<p id="autorization_title">Войти в аккаунт</p>
	<form id="autorization_form" action="javascript:void(null);" method="post">
		<label for="autorization_email">Ваш E-Mail</label>
		<input type="text" id="autorization_email" name="autorization_email" placeholder="example@example.com" /><br/>
		<div id="a_email_error"><img src="/style/img/left.png" alt="image"/>Некорректно введен E-Mail</div>
		<label for="autorization_password">Ваш пароль</label>
		<input type="password" id="autorization_password" name="autorization_password" /><br/>
		<div id="a_password_error"><img src="/style/img/left.png" alt="image"/>Некорректно введен пароль</div>
		<span id="show-hide" class="show-active">Показать</span>
		<div id="remember">
			<input type="checkbox" id="remember_me" />
			<label for="remember_me">Запомнить меня</label>
			<span id="forgot_pass">Забыли пароль?</span>
		</div>
		<input type="submit" id="autorization_button" name="autorization_button" value="Войти"/>
	</form>
	<div id="dont_have_account">
		<p id="dont_have_account_p">Нет аккаунта?</p>
		<p id="dont_have_account_a">Регистрация</p>
	</div>
	<div class="autorization_cancel"><img src="/img/cancel.png" alt="image"/></div>
</div>

<div id="registration_message"><p class="reg_message"></p></div>
<div id="registration_error_message"><p class="reg_error_message"></p></div>

<div id="forgotten">
	<p id="forgotten_title">Выслать забытый пароль</p>
	<form id="forgotten_form" action="javascript:void(null);" method="post">
		<label for="autorization_email">Ваш E-Mail</label>
		<input type="text" id="forgotten_email" name="forgotten_email" placeholder="example@example.com" /><br/>
		<div id="f_email_error"><img src="/style/img/left.png" alt="image" />Некорректно введен E-Mail</div>
		<input type="submit" id="forgotten_button" name="forgotten_button" value="Отправить"/>
	</form>
	<div id="i_remember_account">
		<p id="i_remember_account_p">Вернуться назад</p>
	</div>
	<div class="forgotten_cancel"><img src="/img/cancel.png" alt="image"/></div>
</div>

<div id="cart_message">
			
</div>