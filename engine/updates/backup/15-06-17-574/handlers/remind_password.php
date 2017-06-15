<?php defined('shopengine') or die('something wrong'); 
 	class remind_password {
 		public function __construct() {
	if($_SERVER["REQUEST_METHOD"] == "POST") {

		$email = clear_string($_POST["email"]);

		if ($email != "") {
			$result = mysql_query("SELECT user_email FROM users WHERE user_email='$email'");
			if (mysql_num_rows($result) > 0) {
				$new_password = generate_random();

				$password = md5($new_password);
				$password = strrev($password);
				$password = strtolower("9fdns932nfsd".$password."23rfsdafaw3af");

				$update = mysql_query("UPDATE users SET user_password='$password' WHERE user_email='$email'");
			
				send_mail('noreply@infiniteworld.ru',
					$email,
					'Новый пароль для сайта ShopEngine',
					'Ваш новый пароль: '.$new_password.'<br/>Никому не сообщайте его');

				echo 1;

			}
			else {
				echo 0;
				}
			}
		}
	}
}

?>