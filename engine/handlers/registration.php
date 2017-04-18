<?php defined('shopengine') or die('something wrong'); 
	class registration {
		public function __construct() {

	session_start();

		$error = array();

			$name = clear_string($_POST['name']);
			$surname = clear_string($_POST['surname']);

			$phone = clear_string($_POST['phone']);
			$address = clear_string($_POST['address']);

			$email = clear_string($_POST['email']);
			$password = clear_string($_POST['password']);
			$sec_password = clear_string($_POST['sec_password']);

			if (strlen($name) < 3 or strlen($name)> 30) {
	$error[] = "Имя должно иметь длину от 3 до 30 символов";
}
			if (strlen($surname) < 3 or strlen($surname) > 30) {
	$error[] = "Фамилия должна иметь длину от 3 до 30 символов";
}
			if (!preg_match("/^\d[\d\(\)\ -]{4,14}\d$/", trim($phone))) {
	$error[] = "Номер введен некорректно";
}
			if (strlen($address) < 3 or strlen($address) > 100) {
	$error[] = "Адрес введен некорректно";
}
			if (!preg_match("/^[-a-z0-9~!$%^&*_=+}{\'?]+(\.[-a-z0-9~!$%^&*_=+}{\'?]+)*@([a-z0-9_][-a-z0-9_]*(\.[-a-z0-9_]+)*\.(aero|arpa|biz|com|coop|edu|gov|info|int|mil|museum|name|net|org|pro|travel|mobi|[a-z][a-z])|([0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}))(:[0-9]{1,5})?$/i", trim($email))) {
	$error[] = "Email введен некорректно";
}
			else {
	$result = mysql_query("SELECT user_email FROM users WHERE user_email='$email'");
	if (mysql_num_rows($result) > 0) {
		$error[] = "E-Mail уже зарегистрирован";
	}
			}
			if (strlen($password) < 3 or strlen($password) > 30) {
				$error[] = "Пароль введен некорректно";
			}
			if ($password != $sec_password) {
				$error[] = "Пароли не совпадают";
			}

			if (count($error)) {
				echo "Ошибка регистрации. Проверьте данные и повторите попытку.";
			}

			else {
				$password = md5($password);
				$password = strrev($password);
				$password = strtolower("9fdns932nfsd".$password."23rfsdafaw3af");

				$ip = $_SERVER['REMOTE_ADDR'];

				mysql_query("    INSERT INTO users(user_name,user_surname,user_phone,user_address,user_email,user_password,datetime,user_ip)
					VALUES (

						'".$name."',
						'".$surname."',
						'".$phone."',
						'".$address."',
						'".$email."',
						'".$password."',
						NOW(),
						'".$ip."'
					)");

				echo 'true';	

			}
		}
	}
?>