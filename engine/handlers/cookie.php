<?php defined('shopengine') or die('something wrong'); 

	if($_SESSION['autorization'] != 'autorization_yes' && $_COOKIE["remember_me"]) {
		define('shopengine',true);
	$str = $_COOKIE["remember_me"];
	$all_len = strlen($str);

	$email_len = strpos($str,'+');
	$email = clear_string(substr($str,0,$email_len));

	$password = clear_string(substr($str,$email_len+1,$all_len));


	$result = mysql_query("SELECT * FROM users WHERE user_email='$email' AND user_password='$password'",$link);
	if (mysql_num_rows($result) > 0) {
		$row = mysql_fetch_array($result);
		session_start();
			$_SESSION['autorization'] = 'autorization_yes';
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
	} 
}

?>