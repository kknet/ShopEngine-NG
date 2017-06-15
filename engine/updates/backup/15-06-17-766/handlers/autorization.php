<?php defined('shopengine') or die('something wrong'); 
ob_start();

	class autorization {
		public function __construct() {

	if($_SERVER["REQUEST_METHOD"] == "POST") {

		$email = clear_string($_POST['email']);

		$password = clear_string($_POST['password']);

		$password = md5($password);
		$password = strrev($password);
		$password = strtolower("9fdns932nfsd".$password."23rfsdafaw3af");

		$remember_me = clear_string($_POST['remember_me']);

		if($remember_me == 'yes') {
			setcookie('remember_me',$email.'+'.$password,time()+3600*24*31, "/");
		}

		$result = mysql_query("SELECT * FROM users WHERE user_email='$email' AND user_password='$password'");
		if (mysql_num_rows($result) > 0) {
			$row = mysql_fetch_array($result);
			session_start();
			$_SESSION['autorization'] = 'autorization_yes';
			$_SESSION['autorization_id'] = $row["user_id"];
			$_SESSION['autorization_password'] = $row["user_password"];
			$_SESSION['autorization_email'] = $row["user_email"];
			$_SESSION['autorization_name'] = $row["user_name"];
			$_SESSION['autorization_surname'] = $row["user_surname"];
			$_SESSION['autorization_patronymic'] = $row["user_patronymic"];
			$_SESSION['autorization_phone'] = $row["user_phone"];
			$_SESSION['autorization_address'] = $row["user_address"];
			$_SESSION['autorization_history'] = $row["user_history"];
			$_SESSION['autorization_comments'] = $row["user_comments"];
			$_SESSION['autorization_information'] = $row["user_information"];
			echo 1;
		}
		else {
			echo 0;
			}
		}
	}
}

?>

