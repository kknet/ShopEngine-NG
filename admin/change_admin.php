<?php 
define('shopengine',true);
include("includes/db_connect.php"); 
include("functions/functions.php");
include("functions/variables.php");
session_start(); 

if ($_SESSION['admin_autorization'] == 'autorization_yes') {
$uri = $_SERVER['REQUEST_URI'];

if(isset($_GET['logout'])) {
	unset($_SESSION['admin_autorization']);
	header('Location: login.php', true, 301);
    exit();
}

$id_vari = clear_string($_GET['id']);

if(isset($_POST['admin_submit'])) {
	$login = clear_string($_POST['admin_login']);
	$password = clear_string($_POST['admin_password']);
	$repassword = clear_string($_POST['admin_repassword']);
	$admin_name = clear_string($_POST['admin_name']);
	$admin_email = clear_string($_POST['admin_email']);
	$admin_phone = clear_string($_POST['admin_phone']);
	$admin_position = clear_string($_POST['admin_position']);

	$chck_products = clear_string($_POST['chk_products']);
	$chk_reviews = clear_string($_POST['chk_reviews']);
	$chk_orders = clear_string($_POST['chk_orders']);
	$chk_settings = clear_string($_POST['chk_settings']);
	$chk_administration = clear_string($_POST['chk_administration']);
	$chk_slider = clear_string($_POST['chk_slider']);
	$chk_users = clear_string($_POST['chk_users']);
	$chk_articles = clear_string($_POST['chk_articles']);

	$_SESSION['login'] = $login;
	$_SESSION['admin_name'] = $admin_name;
	$_SESSION['admin_email'] = $admin_email;
	$_SESSION['admin_phone'] = $admin_phone;
	$_SESSION['admin_position'] = $admin_position;

	if ($login != "" AND $admin_name != "" AND $admin_email != "" AND $admin_phone != "" AND $admin_position != "") {

				if (mysql_query("UPDATE admins SET login='$login',name='$admin_name',email='$admin_email',phone='$admin_phone',position='$admin_position',chk_products='$chck_products',chk_reviews='$chk_reviews',chk_orders='$chk_orders',chk_settings='$chk_settings',chk_administration='$chk_administration',chk_slider='$chk_slider',chk_users='$chk_users',chk_articles='$chk_articles' WHERE id='$id_vari'",$link)) {
							$_SESSION['good_message'] = "Данные сохранены (пароль не был изменен)";

								if ($password != "") {
										if($password == $repassword) {
											$password = md5($password);
            								$password = strrev($password);
            								$password = strtolower('wejkfgiq23thsdsdfhauiw3yrtisudyfgaksf'.$password.'skdfjgqi83wyrgfdagskfaywtekjgkfuyst');
           										 if(mysql_query("UPDATE admins SET password='$password'",$link)) {
           										 		$_SESSION['good_message'] = "Данные сохранены (пароль был изменен)";
           										 }	
												}
												else {
													$_SESSION['error'] = "Пароли не совпадают";
												}
												}


				}
				else {
					$_SESSION['error'] = "Произошла ошибка";
				}
			}
	else {
		$_SESSION['error'] = "Все поля обязательно должны быть заполнены";
	}

}

$result = mysql_query("SELECT * FROM admins WHERE id='$id_vari'",$link);
		$row = mysql_fetch_array($result);
?>
<!DOCTYPE html>
<html> 
<head>
	<title>Панель управления - главная</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="css/css.css">
    <!--<link href='https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900' rel='stylesheet' type='text/css'>-->
	<link rel="stylesheet" type="text/css" href="../fonts/fonts.css">
    <script type="text/javascript" src="js/jquery-1.7.1.min.js"></script>
    <script type="text/javascript" src="js/js.js"></script>
</head>
<body>
<?php include("includes/header.php"); ?>
<div id="admin_great_container">
<?php
	include("includes/left_sidebar.php"); 
?>
	<div id="admin_center_block">
	<p id="center_title"><a href="index.php">Главная</a> / <a href="administration.php">администраторы</a> / изменение администратора</p>
	<p id="center_header">Изменить информацию об администраторе</p>
<?php
	if($_SESSION['chk_administration'] == '1') {
?>

		<form id="settings_form" method="post" >
		<?php
		if($_SESSION['good_message']) {
			echo '<p class="ok_message">'.$_SESSION["good_message"].'</p><br/>';
			unset($_SESSION['good_message']);
		}
		if($_SESSION['error']) {
			echo '<p class="error_message">'.$_SESSION["error"].'</p><br/>';
			unset($_SESSION['error']);
		}
		?>
		<p class="form_title_cat" style="margin-bottom:30px">Контактные данные*</p>
		<ul>
		<li>
		<label for="admin_login">Логин</label>
		<input type="text" id="admin_login" name="admin_login" value="<?php echo $row["login"];?>"/><br/>
		</li>
		<li>
		<label for="admin_password">Пароль</label>
		<input type="password" id="admin_password" name="admin_password" /><br/>
		</li>
		<li>
		<label for="admin_repassword">Повторите пароль</label>
		<input type="password" id="admin_repassword" name="admin_repassword" /><br/>
		</li>
		<li>
		<label for="admin_name">ФИО</label>
		<input type="text" id="admin_name" name="admin_name" value="<?php echo $row["name"];?>"/><br/>
		</li>
		<li>
		<label for="admin_email">Электронная почта</label>
		<input type="text" id="admin_email" name="admin_email" value="<?php echo $row["email"];?>"/><br/>
		</li>
		<li>
		<label for="admin_phone">Номер телефона</label>
		<input type="text" id="admin_phone" name="admin_phone" value="<?php echo $row["phone"];?>"/><br/>
		</li>
		<li>
		<label for="admin_position">Должность</label>
		<input type="text" id="admin_position" name="admin_position" value="<?php echo $row["position"];?>"/><br/>
		</li>
		</ul>

		<p class="form_title_cat" style="margin-bottom:30px">Права*</p>
		<?php 

			if($row['chk_products'] == 1) {
							$products = "checked";
						}
						else {
							$products = "";
						}

						if($row['chk_reviews'] == 1) {
							$reviews = "checked";
						}
						else {
							$reviews = "";
						}

						if($row['chk_orders'] == 1) {
							$orders = "checked";
						}
						else {
							$orders = "";
						}

						if($row['chk_settings'] == 1) {
							$settings = "checked";
						}
						else {
							$settings = "";
						}

						if($row['chk_administration'] == 1) {
							$administration = "checked";
						}
						else {
							$administration = "";
						}
						if($row['chk_slider'] == 1) {
							$slider = "checked";
						}
						else {
							$slider = "";
						}
						if($row['chk_users'] == 1) {
							$users = "checked";
						}
						else {
							$users = "";
						}
						if($row['chk_articles'] == 1) {
							$articles = "checked";
						}
						else {
							$articles = "";
						}

		?>
		<input type="checkbox" name="chk_products" id="chk_products" value="1" <?php echo $products;?>/><label for="chk_products">Управление товарами</label><br/>
		<input type="checkbox" name="chk_reviews" id="chk_reviews" value="1" <?php echo $reviews;?>/><label for="chk_reviews">Модерирование отзывов</label><br/>
		<input type="checkbox" name="chk_orders" id="chk_orders" value="1" <?php echo $orders;?>/><label for="chk_orders">Модерирование заказов</label><br/>
		<input type="checkbox" name="chk_settings" id="chk_settings" value="1" <?php echo $settings;?>/><label for="chk_settings">Управление настройками</label><br/>
		<input type="checkbox" name="chk_administration" id="chk_administration" value="1" <?php echo $administration;?>/><label for="chk_administration">Просмотр администраторов</label><br/>
		<input type="checkbox" name="chk_slider" id="chk_slider" value="1" <?php echo $slider;?>/><label for="chk_slider">Управление слайдером</label><br/>
		<input type="checkbox" name="chk_users" id="chk_users" value="1" <?php echo $users;?>/><label for="chk_users">Просмотр пользователей</label><br/>
		<input type="checkbox" name="chk_articles" id="chk_articles" value="1"<?php echo $articles;?>/><label for="chk_articles">Управление статьями</label><br/>
		<input type="submit" name="admin_submit" id="admin_submit" value="Сохранить" />

		</form>

		<?php 
			}
			else {
				echo '<p class="error_message">У вас нет прав на просмотр данного раздела</p>';
			}
	?>

	</div>
		
</div>

</body>
</html>

<?php 
}
else {
	header('Location: login.php', true, 301);
    exit();
}
?>