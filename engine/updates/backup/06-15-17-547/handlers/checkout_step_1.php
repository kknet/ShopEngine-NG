<?php defined('shopengine') or die('something wrong'); 
 	class checkout_step_1 {
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
		$error_patronymic = 0;
		$error_information = 0;
		$error_message = "";


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

			if(strlen($patronymic) > 30) {
				$error_patronymic = 1;
			}
			if(strlen($information) > 150) {
				$error_information = 1;
			}

			if ($error_email == 0 AND $error_name == 0 AND $error_surname == 0 AND $error_address == 0 AND $error_phone == 0 AND $error_patronymic == 0 AND $error_information == 0) {



		$_SESSION['checkout_email'] = $email;
		$_SESSION['checkout_surname'] = $surname;
		$_SESSION['checkout_name'] = $name;
		$_SESSION['checkout_patronymic'] = $patronymic;
		$_SESSION['checkout_phone'] = $phone;
		$_SESSION['checkout_address'] = $address;
		$_SESSION['checkout_information'] = $information;

		echo 'checkout_yes';
	}
		else {
			echo 'checkout_no';
			}
		}
	}
}
?>