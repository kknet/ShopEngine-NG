<?php defined('shopengine') or die('something wrong'); 

	class profile_set {
		public function __construct() {

	if ($_SERVER["REQUEST_METHOD"] == "POST") {

		session_start();

		$email = clear_string($_POST['email']);
		$surname = clear_string($_POST['surname']);
		$name = clear_string($_POST['name']);
		$patronymic = clear_string($_POST['patronymic']);
		$phone = clear_string($_POST['phone']);
		$address = clear_string($_POST['address']);
		$information = clear_string($_POST['information']);

		$error_email = 0;
		$error_name = 0;
		$error_surname = 0;
		$error_address = 0;
		$error_phone = 0;

		if (!preg_match("/^[-a-z0-9~!$%^&*_=+}{\'?]+(\.[-a-z0-9~!$%^&*_=+}{\'?]+)*@([a-z0-9_][-a-z0-9_]*(\.[-a-z0-9_]+)*\.(aero|arpa|biz|com|coop|edu|gov|info|int|mil|museum|name|net|org|pro|travel|mobi|[a-z][a-z])|([0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}))(:[0-9]{1,5})?$/i", trim($email))) {
			$error_email = 1;
			}
			if(strlen($surname) < 3 or strlen($surname) > 30) {
				$error_surname = 1;
			}
			if(strlen($name) < 3 or strlen($name) > 30) {
				$error_name = 1;
			}
			if(strlen($address) < 3 or strlen($address) > 100) {
				$error_address = 1;
			}
			if (!preg_match("/^\d[\d\(\)\ -]{4,14}\d$/", trim($phone))) {
				$error_phone = 1;
			}

		if ($_POST['password']) {
			$error_password = 0;
			$error_sec_password = 0;
			$error_current_password = 0;

			$password = clear_string($_POST['password']);
			$sec_password = clear_string($_POST['sec_password']);
			$current_password = clear_string($_POST['current_password']);
			$current_user_password = clear_string($_SESSION['autorization_password']);

			$current_password = md5($current_password);
			$current_password = strrev($current_password);
			$current_password = strtolower("9fdns932nfsd".$current_password."23rfsdafaw3af");

			if($password == "" OR strlen($password) < 3 OR strlen($password) > 30) {
				$error_password = 1;
			}
			if($password != $sec_password ) {
				$error_sec_password = 1;
			}
			if($current_password != $current_user_password) {
				$error_current_password = 1;

				echo 'no_pass';
			}

			if ($error_email == 0 AND $error_name == 0 AND $error_surname == 0 AND $error_address == 0 AND $error_phone == 0 AND $error_password == 0 AND $error_sec_password == 0 AND $error_current_password == 0) {
				$result = mysql_query("SELECT * FROM users WHERE user_email='$email' AND user_password='$current_password'");
				if (mysql_num_rows($result) > 0) {
					$password = md5($password);
					$password = strrev($password);
					$password = strtolower("9fdns932nfsd".$password."23rfsdafaw3af");

					$update = mysql_query("UPDATE users SET user_password='$password',user_surname='$surname', user_name='$name',user_patronymic='$patronymic', user_phone='$phone',user_address='$address',user_information='$information' WHERE user_email='$email' AND user_password='$current_password'");

					$_SESSION['autorization_password'] = $password;
					$_SESSION['autorization_name'] = $name;
					$_SESSION['autorization_surname'] = $surname;
					$_SESSION['autorization_phone'] = $phone;
					$_SESSION['autorization_address'] = $address;
					$_SESSION['autorization_patronymic'] = $patronymic;
					$_SESSION['autorization_information'] = $information;

					echo 1;
				}
			}
		}
		else {
			$password = $_SESSION['autorization_password'];


			if ($error_email == 0 AND $error_name == 0 AND $error_surname == 0 AND $error_address == 0 AND $error_phone == 0) {
				$result = mysql_query("SELECT * FROM users WHERE user_email='$email' AND user_password='$password'");

				if (mysql_num_rows($result) > 0) {
					$update = mysql_query("UPDATE users SET user_surname='$surname', user_name='$name',user_patronymic='$patronymic', user_phone='$phone',user_address='$address',user_information='$information' WHERE user_email='$email' AND user_password='$password'");

					$_SESSION['autorization_name'] = $name;
					$_SESSION['autorization_surname'] = $surname;
					$_SESSION['autorization_phone'] = $phone;
					$_SESSION['autorization_address'] = $address;
					$_SESSION['autorization_patronymic'] = $patronymic;
					$_SESSION['autorization_information'] = $information;

					echo 'yes';
				} 
					else {
					echo 'no';	
				}

			}  
				else {
					echo 'no';
				}
			}
		}
	}
}

?>